<?php
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */

class CustomAJAXChat extends AJAXChat {

	// Returns an associative array containing userName, userID and userRole
	// Returns null if login is invalid
	function getValidLoginUserData() {
		$YiiUser=Yii::app()->user;
		if(!Yii::app()->user->isGuest) {
			if(!isset($YiiUser->role)) {
				$YiiUser = Yii::app()->getModule("user")->user(Yii::app()->user->id);
				$YiiUser->role = $YiiUser->superuser;
			}
			$userName = isset($YiiUser->name) ? $YiiUser->name : $YiiUser->username;
			switch($YiiUser->role) {
				case 0: $role=AJAX_CHAT_USER; break;
				case 1: $role=AJAX_CHAT_MODERATOR; break;
				case 2: $role=AJAX_CHAT_ADMIN; break;
				case -1: $role=AJAX_CHAT_VIP; break;
			}
			$def = AJAXChatDefaults::model()->findByPk(0);
			if($role == AJAX_CHAT_USER) {
				$c = explode(",",$def->userChannels);
				foreach($c as $cID) {
					if(!empty($cID)) $channels[]=$cID;
				}
			} else {
				$c = explode(",",$def->adminChannels);
				foreach($c as $cID) {
					if(!empty($cID)) $channels[]=$cID;
				}
			}
			return array(
				'userID'=>$YiiUser->id,
				'userName'=>$this->trimUserName(
								$userName, 
								$this->getConfig('contentEncoding'), 
								$this->getConfig('sourceEncoding') 
							),
				'userRole'=>$role,
				'channels'=>$channels
			);
		} else {
			// Guest users:
			return $this->getGuestUser();
		}
	}

	// Store the channels the current user has access to
	// Make sure channel names don't contain any whitespace
	function &getChannels() {
		if($this->_channels === null) {
			$this->_channels = array();
			
			$customUsers = $this->getCustomUsers();
			// Get the channels, the user has access to:
			if($this->getUserRole() == AJAX_CHAT_GUEST) {
				$validChannels = $customUsers[0]['channels'];
			} else {
				$userData = $this->getValidLoginUserData();
				$validChannels = $userData['channels'];
			}
			
			// Add the valid channels to the channel list (the defaultChannelID is always valid):
			foreach($this->getAllChannels() as $key=>$value) {
				// Check if we have to limit the available channels:
				if($this->getConfig('limitChannelList') && !in_array($value, $this->getConfig('limitChannelList'))) {
					continue;
				}
				
				if(in_array($value, $validChannels) || $value == $this->getConfig('defaultChannelID')) {
					$this->_channels[$key] = $value;
				}
			}
		}
		return $this->_channels;
	}

	// Store all existing channels
	// Make sure channel names don't contain any whitespace
	function &getAllChannels() {
		if($this->_allChannels === null) {
			// Get all existing channels:
			$customChannels = $this->getCustomChannels();
			
			$defaultChannelFound = false;
			
			foreach($customChannels as $key=>$value) {
				$forumName = $this->trimChannelName($value);
				
				$this->_allChannels[$forumName] = $key;
				
				if($key == $this->getConfig('defaultChannelID')) {
					$defaultChannelFound = true;
				}
			}
			
			if(!$defaultChannelFound) {
				// Add the default channel as first array element to the channel list:
				$this->_allChannels = array_merge(
					array(
						$this->trimChannelName($this->getConfig('defaultChannelName'))=>$this->getConfig('defaultChannelID')
					),
					$this->_allChannels
				);
			}
		}
		return $this->_allChannels;
	}

	function &getCustomUsers() {
		// List containing the registered chat users:
		$users = null;
		#$Users = User::model()->findAll();
		$Users = YiiUser::model()->findAll();
		foreach($Users as $user) {
			switch($user->superuser) {
				case 0: $role=AJAX_CHAT_USER; break;
				case 1: $role=AJAX_CHAT_MODERATOR; break;
				case 2: $role=AJAX_CHAT_ADMIN; break;
				case -1: $role=AJAX_CHAT_VIP; break;
			}
			$def = AJAXChatDefaults::model()->findByPk(0);
			if($role == AJAX_CHAT_USER) {
				$c = explode(",",$def->userChannels);
				foreach($c as $cID) {
					if(!empty($cID)) $channels[]=$cID;
				}
			} else {
				$c = explode(",",$def->adminChannels);
				foreach($c as $cID) {
					if(!empty($cID)) $channels[]=$cID;
				}
			}
			$users[$user->id]=array(
				'userName'=>$user->username,
				'userRole'=>$role,
				'channels'=>$channels
			);
		}
		return $users;
	}
	
	function &getCustomChannels() {
		// List containing the custom channels:
		$channels = null;
		$acc = AJAXChatChannels::model()->findAll();
		foreach($acc as $channel) {
			$channels[$channel->orderID]=$channel->name;
		}
		return $channels;
	}
	
	// Return true if a custom command has been successfully parsed, else false
    // $text contains the whole message, $textParts the message split up as words array
    function parseCustomCommands($text, $textParts) {
        switch($textParts[0]) {
            // Display userIP:
            case '/myip':
                $this->insertChatBotMessage(
                    $this->getPrivateMessageID(),
                    '/myip '.$this->getSessionIP()
                );
                return true; break;
            case '/php':
            	if($this->getUserRole() == AJAX_CHAT_ADMIN) {
	   				$text = str_replace("/php","",$text);
	   				ob_start();
	   				eval($text);
	   				$output=ob_get_contents();
					ob_end_clean();
	                $this->insertChatBotMessage(
    	                $this->getPrivateMessageID(),
        	            "PHP code: ".$text." \n [code]".$output."[/code]"
            	    );
            	} else $this->insertChatBotMessage(
					$this->getPrivateMessageID(),
					'/error CommandNotAllowed '.$textParts[0]
				); 
				return true;
				break;
			case '/wall':
				if($this->getUserRole()==AJAX_CHAT_ADMIN || $this->getUserRole() == AJAX_CHAT_MODERATOR) {
					$text = str_replace('/wall','',$text);
					$users=AJAXChatOnline::model()->findAll();
					switch($this->getUserRole()) {
						case AJAX_CHAT_ADMIN: $col="blue"; break;
						case AJAX_CHAT_MODERATOR: $col="orange"; break;
					}
					foreach($users as $user) {
						$this->insertChatBotMessage(
							$this->getPrivateMessageID($user->userID),
							'[color=red][i]'.$this->getLang("wall").'[/i][/color]|[color='.$col.'][b]'.$this->getUserName().'[/b][/color]: '.$text
						);
					}
				} else $this->insertChatBotMessage(
					$this->getPrivateMessageID(),
					'/error CommandNotAllowed '.$textParts[0]
				);
				return true;
				break;
			case '/afk':
				if(!$this->getSessionVar('isAway')) {
					if(!empty($textParts[1]))
						$addit = " ".$this->getLang("reason").": ".str_replace('/afk','',$text);
					else
						$addit=null;
					
					$this->addInfoMessage($this->getUserName(), 'userName');
					$this->setSessionVar('isAway', true);
					$this->insertChatBotMessage(
						$this->getChannel(),
						'[i]'.$this->getUserName()." ".$this->getLang("goneAfk").$addit."[/i]"
					);
					$this->setUserName('AFK|'.$this->getUserName());
					$this->updateOnlineList();
				}
				return true;
				break;
			case '/back':
				if($this->getSessionVar('isAway')) {				
					$this->setUserName(str_replace('AFK|','',$this->getUserName()));
					$this->updateOnlineList();
					$this->addInfoMessage($this->getUserName(), 'userName');
					$this->setSessionVar('isAway', false);
					$this->insertChatBotMessage(
						$this->getChannel(),
						'[i]'.$this->getUserName()." ".$this->getLang("hasReturned").'[/i]'
					);
				}
				return true;
				break;
			case '/reset':
				$this->setUserName($this->getLoginUserName());
				$this->updateOnlineList();
				$this->addInfoMessage($this->getUserName(), 'userName');
				return true;
				break;
			case '/changeToChar':
				$char = Character::model()->findByPk($textParts[1]);
				if(!is_null($char)) {
					$oldname = $this->getLoginUserName();
					$oldname = "[url=".Controller::createAbsoluteUrl("/user/user/view",array("id"=>$this->getUserID()))."]".$oldname."[/url]";
					$prefix = $this->getConfig('changedNickPrefix');
					$suffix = $this->getConfig('changedNickSuffix');
					$genders = array('#6699FF','#FF6699','#9B30FF','#007FFF','#00CC66','#CC66FF','#FF6EC7','#FFFFBB');
					if(!empty($char->nickName)) $cName = $char->nickName; else $cName = $char->name;
					$this->setUserName(
						"[color=".$genders[$char->sex]."][url=".Controller::createAbsoluteUrl("/charaBase/view/char",array("ID"=>$char->cID)).
						"]".$prefix.$this->trimUserName($cName).$suffix.'[/url][/color]'
					);
					$this->updateOnlineList();
					$this->addInfoMessage($this->getUserName(), 'userName');
					$this->insertChatBotMessage(
						$this->getChannel(),
						'/switchChar '.json_encode(array("old"=>$oldname,"new"=>$this->getUserName()))
					);
				} else $this->insertChatBotMessage(
					$this->getChannel(),
					'/error CharNotWorking'
				);
			return true;
			break;
			default:
                return false;
        }
    }
}
?>
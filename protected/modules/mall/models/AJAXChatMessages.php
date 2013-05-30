<?php class AJAXChatMessages extends CActiveRecord {

	// default functions...
	public static function model($className=__CLASS__) { return parent::model($className); }
	public function tableName() { return 'ajax_chat_messages'; }
	public function primaryKey() { return 'id'; }
	
	public $id;
	public $userID;
	public $userName;
	public $userRole;
	public $channel;
	public $dateTime;
	public $ip;
	public $text;
	
	private $ac;
	
	public function init() {
		parent::init();
		$base = Yii::getPathOfAlias("application.modules.chat.lib");
		include($base."/config.php");
		$this->ac=(object)$config;
	}

	public function chatbot($msg) {
		$this->userID=$this->ac->chatBotID;
		$this->userName="Server";
		$this->userRole=AJAX_CHAT_CHATBOT;
		$this->channel=$this->ac->defaultChannelID;
		$this->dateTime=date("Y-m-d H:m:s");
		$this->ip=$this->ip_encode($_SERVER['SERVER_ADDR']);
		$this->text=$msg;
		if($this->save())
			return $this->id;
		else
			return false;
	}

	public function ip_decode($ip) {
		if(function_exists('inet_pton')) {
			// ipv4 & ipv6:
			return @inet_pton($ip);
		}
		// Only ipv4:
		return @pack('N',@ip2long($ip));
	}
	
	public function ip_encode($ip) {
		if(function_exists('inet_ntop')) {
			// ipv4 & ipv6:
			return @inet_ntop($ip);
		}
		// Only ipv4:
		$unpacked = @unpack('Nlong',$ip);
		if(isset($unpacked['long'])) {
			return @long2ip($unpacked['long']);
		}
		return null;
	}

} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="[LANG_CODE/]" lang="[LANG_CODE/]" dir="[BASE_DIRECTION/]">
<?php
// Debug
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<head>
	<meta http-equiv="Content-Type" content="[CONTENT_TYPE/]" />
	<title>[LANG]title[/LANG]</title>
	<!-- [STYLE_SHEETS/] -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->getModule("mall")->assetsUrl; ?>/css/beige.css" media="screen" />

	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule("mall")->assetsUrl."/js/jquery.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule("mall")->assetsUrl."/js/chat.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule("mall")->assetsUrl."/js/config.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule("mall")->assetsUrl."/js/custom.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule("mall")->assetsUrl."/js/FAbridge.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/bar.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/themePicker.js.php?for=chat",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getModule("mall")->assetsUrl."/js/soundpicker.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/js/extLoader.js",CClientScript::POS_HEAD); ?>
	<?php Yii::app()->clientScript->render($output); ?>
	<?=$output?>
	<script src="<?=Yii::app()->getModule("mall")->assetsUrl?>/js/lang/[LANG_CODE/].js" type="text/javascript" charset="UTF-8"></script>
	<script type="text/javascript">
		jQuery(function($) {
			bar.clear();
			$("a").css("text-decoration","none");
			clearValue();
			ajaxChatConfig.boothDir = '<?php echo Yii::app()->getBaseUrl(true); ?>/booths/';
			ajaxChatConfig.ajaxURL = "/mall/run?ajax=true";
			ajaxChatConfig.chatSystem = "";
		});
		// <![CDATA[
			function clearValue() {
				$.each($("#channelSelection").find("option"),function(i,v) {
					$(v).html(ajaxChat.stripBBCodeTags($(v).text()));
				});
			}
			function toggleContainer(containerID, hideContainerIDs) {
				if(hideContainerIDs) {
					for(var i=0; i<hideContainerIDs.length; i++) {
						ajaxChat.showHide(hideContainerIDs[i], 'none');
					}
				}
				ajaxChat.showHide(containerID);
				if(typeof arguments.callee.styleProperty == 'undefined') {
					if(typeof isIElt7 != 'undefined') {
						arguments.callee.styleProperty = 'marginRight';
					} else {
						arguments.callee.styleProperty = 'right';
					}
				}
				var containerWidth = document.getElementById(containerID).offsetWidth;
				if(containerWidth) {
					document.getElementById('chatList').style[arguments.callee.styleProperty] = (containerWidth+28)+'px';
					document.getElementById('chatBooth').style[arguments.callee.styleProperty] = (containerWidth+28)+'px';
				} else {
					document.getElementById('chatList').style[arguments.callee.styleProperty] = '20px';
					document.getElementById('chatBooth').style[arguments.callee.styleProperty] = '20px';
				}
			}

			function initialize() {
				ajaxChat.updateButton('audio', 'audioButton');
				ajaxChat.updateButton('autoScroll', 'autoScrollButton');
				document.getElementById('bbCodeSetting').checked = ajaxChat.getSetting('bbCode');
				document.getElementById('bbCodeImagesSetting').checked = ajaxChat.getSetting('bbCodeImages');
				document.getElementById('bbCodeColorsSetting').checked = ajaxChat.getSetting('bbCodeColors');
				document.getElementById('hyperLinksSetting').checked = ajaxChat.getSetting('hyperLinks');
				document.getElementById('lineBreaksSetting').checked = ajaxChat.getSetting('lineBreaks');
				document.getElementById('emoticonsSetting').checked = ajaxChat.getSetting('emoticons');
				document.getElementById('autoFocusSetting').checked = ajaxChat.getSetting('autoFocus');
				document.getElementById('maxMessagesSetting').value = ajaxChat.getSetting('maxMessages');
				document.getElementById('wordWrapSetting').checked = ajaxChat.getSetting('wordWrap');
				document.getElementById('maxWordLengthSetting').value = ajaxChat.getSetting('maxWordLength');
				document.getElementById('dateFormatSetting').value = ajaxChat.getSetting('dateFormat');
				document.getElementById('persistFontColorSetting').checked = ajaxChat.getSetting('persistFontColor');
				for(var i=0; i<document.getElementById('audioVolumeSetting').options.length; i++) {
					if(document.getElementById('audioVolumeSetting').options[i].value == ajaxChat.getSetting('audioVolume')) {
						document.getElementById('audioVolumeSetting').options[i].selected = true;
						break;
					}
				}
				document.getElementById('blinkSetting').checked = ajaxChat.getSetting('blink');
				document.getElementById('blinkIntervalSetting').value = ajaxChat.getSetting('blinkInterval');
				document.getElementById('blinkIntervalNumberSetting').value = ajaxChat.getSetting('blinkIntervalNumber');

				document.getElementById('booth').src = '<?php echo Yii::app()->getBaseUrl(true); ?>/booths/'+ ajaxChatConfig.loginChannelID +'/index.html';

				if(ajaxChatConfig.chatSystem == 'off') {
     				document.getElementById('chatshow').style.visibility='hidden';
     				document.getElementById('inputFieldContainer').style.display='none';
     				document.getElementById('submitButtonContainer').style.display = 'none';
     				document.getElementById('bbCodeContainer').style.display = 'none';
     				document.getElementById('onlineListButton').click();
     				document.getElementById('onlineListButton').style.display = 'none';
     				document.getElementById('chatBooth').style.bottom = "60px";
     				document.getElementById('chatBooth').style.top = "45px";
    			} else {
     				//document.getElementById('chatBooth').style.bottom = "150px;";
    			}

			}

			ajaxChatConfig.loginChannelID = parseInt('[LOGIN_CHANNEL_ID/]');
			ajaxChatConfig.sessionName = '[SESSION_NAME/]';
			ajaxChatConfig.cookieExpiration = parseInt('[COOKIE_EXPIRATION/]');
			ajaxChatConfig.cookiePath = '[COOKIE_PATH/]';
			ajaxChatConfig.cookieDomain = '[COOKIE_DOMAIN/]';
			ajaxChatConfig.cookieSecure = '[COOKIE_SECURE/]';
			ajaxChatConfig.chatBotName = decodeURIComponent('[CHAT_BOT_NAME/]');
			ajaxChatConfig.chatBotID = '[CHAT_BOT_ID/]';
			ajaxChatConfig.allowUserMessageDelete = parseInt('[ALLOW_USER_MESSAGE_DELETE/]');
			ajaxChatConfig.inactiveTimeout = parseInt('[INACTIVE_TIMEOUT/]');
			ajaxChatConfig.privateChannelDiff = parseInt('[PRIVATE_CHANNEL_DIFF/]');
			ajaxChatConfig.privateMessageDiff = parseInt('[PRIVATE_MESSAGE_DIFF/]');
			ajaxChatConfig.showChannelMessages = parseInt('[SHOW_CHANNEL_MESSAGES/]');
			ajaxChatConfig.messageTextMaxLength = parseInt('[MESSAGE_TEXT_MAX_LENGTH/]');
			ajaxChatConfig.socketServerEnabled = parseInt('[SOCKET_SERVER_ENABLED/]');
			ajaxChatConfig.socketServerHost = decodeURIComponent('[SOCKET_SERVER_HOST/]');
			ajaxChatConfig.socketServerPort = parseInt('[SOCKET_SERVER_PORT/]');
			ajaxChatConfig.socketServerChatID = parseInt('[SOCKET_SERVER_CHAT_ID/]');
			ajaxChatConfig.baseURL = "<?=Yii::app()->getModule("mall")->assetsUrl?>/";

			ajaxChat.init(ajaxChatConfig, ajaxChatLang, true, true, true, initialize);
			//bird2
			soundPickInit();
		// ]]>
	</script>
   	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bar.css.php" media="screen" />
	<style type="text/css">
		body {
			padding:0;
			margin:0;
		}
		* {	outline:0; }
		#bar, #ubar, #Nbar {
			z-index: 20;
		}
		#bar li, #ubar li, #Nbar li {
			padding-top:	3px;
		}
		

	</style>
</head>

<body>
	<div id="content">

		<?php $dn = new DN; $dn->DoTheMenu(); ?>
		<div id="chatBooth"  style="overflow: hidden;">
			<iframe style="overflow:hidden;height:100%;width:100%;" height="100%" width="100%" frameborder="0" scrolling="no" name="booth" id="booth" src="about:blank">
			</iframe>
		</div>
		<div id="chatList" style="display:none; overflow: hidden;"></div>
		<div id="inputFieldContainer">
			<textarea id="inputField" rows="1" cols="50" title="[LANG]inputLineBreak[/LANG]" onkeypress="ajaxChat.handleInputFieldKeyPress(event);" onkeyup="ajaxChat.handleInputFieldKeyUp(event);"></textarea>
		</div>
		<div id="submitButtonContainer">
			<span id="postNote"><span id="messageLengthCounter">0</span> [LANG]characters[/LANG]</span>
			<input type="button" id="submitButton" value="[LANG]messageSubmit[/LANG]" onclick="ajaxChat.sendMessage();"/>

		</div>
		<div id="logoutChannelContainer">

  		</div>
		<div id="bbCodeContainer">
			<input type="button" id="button" value="[LANG]bbCodeLabelBold[/LANG]" title="[LANG]bbCodeTitleBold[/LANG]" onclick="ajaxChat.insertBBCode('b');" style="font-weight:bold;"/>
			<input type="button" id="button" value="[LANG]bbCodeLabelItalic[/LANG]" title="[LANG]bbCodeTitleItalic[/LANG]" onclick="ajaxChat.insertBBCode('i');" style="font-style:italic;"/>
			<input type="button" id="button" value="[LANG]bbCodeLabelUnderline[/LANG]" title="[LANG]bbCodeTitleUnderline[/LANG]" onclick="ajaxChat.insertBBCode('u');" style="text-decoration:underline;"/>
			<input type="button" id="button" value="[LANG]bbCodeLabelColor[/LANG]" title="[LANG]bbCodeTitleColor[/LANG]" onclick="ajaxChat.showHide('colorCodesContainer', null);"/>
			<input type="button" id="button" value="[LANG]bbCodeLabelEmoticons[/LANG]" title="[LANG]bbCodeLabelEmoticons[/LANG]" onclick="ajaxChat.showHide('emoticonsContainer', null);">
		</div>
		<div id="emoticonsContainer" style="display:none;" dir="ltr"></div>
		<div id="colorCodesContainer" style="display:none;" dir="ltr"></div>
		<div id="optionsContainer">
        	<input type="button" value="[LANG]previousStore[/LANG]" id="backwords" title="[LANG]previousTitleStore[/LANG]" alt="[LANG]previousStore[/LANG]" onclick="ajaxChat.cChange('up')"/>
            <input type="button" value="[LANG]forwardStore[/LANG]" id="forward" title="[LANG]forwardTitleStore[/LANG]" alt="[LANG]forwardStore[/LANG]" onclick="ajaxChat.cChange('down');"/>
         	<label for="channelSelection" id="cSlabel">Store:</label><select id="channelSelection" onchange="ajaxChat.switchChannel(this.options[this.selectedIndex].value);clearValue();">[CHANNEL_OPTIONS/]</select>
        	<input type="button" value="[LANG]toggleChat[/LANG]" id="chatshow" title="[LANG]toggleTitleChat[/LANG]" alt="[LANG]toggleChat[/LANG]" onclick="ajaxChat.showHide('chatList', null);"/>
			<input type="image" src="<?=Yii::app()->getModule("mall")->assetsUrl?>/img/help.png" class="button" alt="[LANG]toggleHelp[/LANG]" title="[LANG]toggleHelp[/LANG]" onclick="window.open('[AURL]/mall/help[/AURL]'); return false;"/>
			<input type="image" src="<?=Yii::app()->getModule("mall")->assetsUrl?>/img/chars.png" class="button" id="helpButton" alt="[LANG]toggleChars[/LANG]" title="[LANG]toggleChars[/LANG]" onclick="toggleContainer('helpContainer', new Array('onlineListContainer','settingsContainer'));"/>
			<input type="image" src="<?=Yii::app()->getModule("mall")->assetsUrl?>/img/settings.png" class="button" id="settingsButton" alt="[LANG]toggleSettings[/LANG]" title="[LANG]toggleSettings[/LANG]" onclick="toggleContainer('settingsContainer', new Array('onlineListContainer','helpContainer'));" style="visibility:hidden"/>
			<input type="image" src="<?=Yii::app()->getModule("mall")->assetsUrl?>/img/users.png" class="button" id="onlineListButton" alt="[LANG]toggleOnlineList[/LANG]" title="[LANG]toggleOnlineList[/LANG]" onclick="toggleContainer('onlineListContainer', new Array('settingsContainer','helpContainer'));"/>
			<input type="image" src="<?=Yii::app()->getModule("mall")->assetsUrl?>/img/pixel.gif" class="button" id="audioButton" alt="[LANG]toggleAudio[/LANG]" title="[LANG]toggleAudio[/LANG]" onclick="ajaxChat.toggleSetting('audio', 'audioButton');"/>
			<input type="image" src="<?=Yii::app()->getModule("mall")->assetsUrl?>/img/pixel.gif" class="button" id="autoScrollButton" alt="[LANG]toggleAutoScroll[/LANG]" title="[LANG]toggleAutoScroll[/LANG]" onclick="ajaxChat.toggleSetting('autoScroll', 'autoScrollButton');"/>
  			<div id="statusIconContainer" class="statusContainerOn" onclick="ajaxChat.updateChat(null);"></div>
  		</div>
		<div id="onlineListContainer">
			<h3>[LANG]onlineUsers[/LANG]</h3>
	  		<div id="onlineList"></div>
	  	</div>
	  	<div id="helpContainer" style="display:none;">
 			<h3><?=Yii::t("site","cselect")?></h3>
 			<div id="helpList"><table>
				<?php
					$chars = Character::model()->findAll(array('condition'=>'uID='.Yii::app()->user->id));
					$class = "rowOdd";
					foreach($chars as $char) { ?>
						<tr class="<?=$class?>">
							<td class="dec">
								<?=Yii::t("CharaBaseModule.cb","name").": ".htmlspecialchars($char->name)?><br>
								<?php if(!empty($char->nickName)) echo Yii::t("CharaBaseModule.cb","nickName").": ".htmlspecialchars($char->nickName)."<br>";?>
								<?=CHtml::link(
									Yii::t("site","play"),
									"javascript:ajaxChat.sendMessageWrapper('/changeToChar ".$char->cID."');",
									array("style"=>"color:lime;")
								)?>
								<?=CHtml::link(
									Yii::t("site","profil"),
									array("/charaBase/view/char",'ID'=>$char->cID),
									array("style"=>"color:lime;")
								)?>
								<?=CHtml::link(
									Yii::t("site","edit"),
									array("/charaBase/maintain/edit",'ID'=>$char->cID),
									array("style"=>"color:lime;")
								)?>
							</td>
							<td class="code">
								<?=Yii::t("CharaBaseModule.cb","species").": ".htmlspecialchars($char->species)?><br>
								<?=Yii::t("CharaBaseModule.cb","sex").": ".CBTranslator::sex($char->sex)?><br>
								<?php /*CBTranslator::orientation(intval($char->orientation)) */?><br>
							</td>
						</tr><?php 
						if($class == "rowOdd") $class = "rowEven"; else $class = "rowOdd";
					}
				?>
			</table></div>
	  	</div>
	  	<div id="settingsContainer" style="display:none;">
 			<h3>[LANG]settings[/LANG]</h3>
 			<div id="settingsList">
				<table>
					<tr class="rowOdd">
						<td><label for="bbCodeSetting">[LANG]settingsBBCode[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="bbCodeSetting" onclick="ajaxChat.setSetting('bbCode', this.checked);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="bbCodeImagesSetting">[LANG]settingsBBCodeImages[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="bbCodeImagesSetting" onclick="ajaxChat.setSetting('bbCodeImages', this.checked);"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="bbCodeColorsSetting">[LANG]settingsBBCodeColors[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="bbCodeColorsSetting" onclick="ajaxChat.setSetting('bbCodeColors', this.checked);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="hyperLinksSetting">[LANG]settingsHyperLinks[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="hyperLinksSetting" onclick="ajaxChat.setSetting('hyperLinks', this.checked);"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="lineBreaksSetting">[LANG]settingsLineBreaks[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="lineBreaksSetting" onclick="ajaxChat.setSetting('lineBreaks', this.checked);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="emoticonsSetting">[LANG]settingsEmoticons[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="emoticonsSetting" onclick="ajaxChat.setSetting('emoticons', this.checked);"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="autoFocusSetting">[LANG]settingsAutoFocus[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="autoFocusSetting" onclick="ajaxChat.setSetting('autoFocus', this.checked);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="maxMessagesSetting">[LANG]settingsMaxMessages[/LANG]</label></td>
						<td class="setting"><input type="text" class="text" id="maxMessagesSetting" onchange="ajaxChat.setSetting('maxMessages', parseInt(this.value));"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="wordWrapSetting">[LANG]settingsWordWrap[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="wordWrapSetting" onclick="ajaxChat.setSetting('wordWrap', this.checked);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="maxWordLengthSetting">[LANG]settingsMaxWordLength[/LANG]</label></td>
						<td class="setting"><input type="text" class="text" id="maxWordLengthSetting" onchange="ajaxChat.setSetting('maxWordLength', parseInt(this.value));"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="dateFormatSetting">[LANG]settingsDateFormat[/LANG]</label></td>
						<td class="setting"><input type="text" class="text" id="dateFormatSetting" onchange="ajaxChat.setSetting('dateFormat', this.value);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="persistFontColorSetting">[LANG]settingsPersistFontColor[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="persistFontColorSetting" onclick="ajaxChat.setPersistFontColor(this.checked);"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="audioVolumeSetting">[LANG]settingsAudioVolume[/LANG]</label></td>
						<td class="setting">
							<select class="left" id="audioVolumeSetting" onchange="ajaxChat.setAudioVolume(this.options[this.selectedIndex].value);">
								<option value="1.0">100 %</option>
								<option value="0.9">90 %</option>
								<option value="0.8">80 %</option>
								<option value="0.7">70 %</option>
								<option value="0.6">60 %</option>
								<option value="0.5">50 %</option>
								<option value="0.4">40 %</option>
								<option value="0.3">30 %</option>
								<option value="0.2">20 %</option>
								<option value="0.1">10 %</option>
							</select>
						</td>
                      </tr>
                        <tr class="rowEven">
						<td><label for="themePicker">[LANG]style[/LANG]:</label></td>
						<td class="setting">
                        <select id="themePicker"></select>
                        </td>
                        </tr>
                        <tr class="rowOdd">
						<td><label for="soundPick">Sound theme:</label></td>
						<td class="setting">
                        <select id="soundPick"></select>
                        </td>
                        </tr>
                        <tr class="rowEven">
						<td><label for="languageSelection">[LANG]language[/LANG]:</label></td>
						<td class="setting">
                        <select id="languageSelection" onchange="ajaxChat.switchLanguage(this.value);">[LANGUAGE_OPTIONS/]</select>
                        </td>
                        </tr>

					<tr class="rowOdd">
						<td><label for="blinkSetting">[LANG]settingsBlink[/LANG]</label></td>
						<td class="setting"><input type="checkbox" id="blinkSetting" onclick="ajaxChat.setSetting('blink', this.checked);"/></td>
					</tr>
					<tr class="rowEven">
						<td><label for="blinkIntervalSetting">[LANG]settingsBlinkInterval[/LANG]</label></td>
						<td class="setting"><input type="text" class="text" id="blinkIntervalSetting" onchange="ajaxChat.setSetting('blinkInterval', parseInt(this.value));"/></td>
					</tr>
					<tr class="rowOdd">
						<td><label for="blinkIntervalNumberSetting">[LANG]settingsBlinkIntervalNumber[/LANG]</label></td>
						<td class="setting"><input type="text" class="text" id="blinkIntervalNumberSetting" onchange="ajaxChat.setSetting('blinkIntervalNumber', parseInt(this.value));"/></td>
					</tr>
				</table>
			</div>
	  	</div>
	</div>
	<div id="flashInterfaceContainer"></div>
</body>

</html>
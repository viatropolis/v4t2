				<div id="ajaxChatContent">
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/chat.js" type="text/javascript" charset="UTF-8"></script>
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/custom.js" type="text/javascript" charset="UTF-8"></script>
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/shoutbox.js" type="text/javascript" charset="UTF-8"></script>
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/lang/en.js" type="text/javascript" charset="UTF-8"></script>
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/config.js" type="text/javascript" charset="UTF-8"></script>
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/FABridge.js" type="text/javascript" charset="UTF-8"></script>
					<script src="<?=Yii::app()->getModule("chat")->assetsUrl?>/js/soundpicker.js" type="text/javascript" charset="UTF-8"></script>
					<div id="ajaxChatChatList"></div>
					<div id="ajaxChatInputFieldContainer">
					<input id="ajaxChatInputField" type="text" maxlength="[MESSAGE_TEXT_MAX_LENGTH/]" onkeypress="ajaxChat.handleInputFieldKeyPress(event);"/>
				</div>
				<div id="ajaxChatCopyright">
					<select id="soundPick"></select>
					<select id="channelSelection" onchange="ajaxChat.switchChannel(this.options[this.selectedIndex].value);">[CHANNEL_OPTIONS/]</select>
					<input type="button" value="[LANG]bbCodeLabelBold[/LANG]" title="[LANG]bbCodeTitleBold[/LANG]" onclick="ajaxChat.insertBBCode('b');" style="font-weight:bold;"/>
					<input type="button" value="[LANG]bbCodeLabelItalic[/LANG]" title="[LANG]bbCodeTitleItalic[/LANG]" onclick="ajaxChat.insertBBCode('i');" style="font-style:italic;"/>
					<input type="button" value="[LANG]bbCodeLabelUnderline[/LANG]" title="[LANG]bbCodeTitleUnderline[/LANG]" onclick="ajaxChat.insertBBCode('u');" style="text-decoration:underline;"/>
					<input type="button" value="[LANG]bbCodeLabelQuote[/LANG]" title="[LANG]bbCodeTitleQuote[/LANG]" onclick="ajaxChat.insertBBCode('quote');"/>
					<input type="button" value="[LANG]bbCodeLabelCode[/LANG]" title="[LANG]bbCodeTitleCode[/LANG]" onclick="ajaxChat.insertBBCode('code');"/>
					<input type="button" value="[LANG]bbCodeLabelURL[/LANG]" title="[LANG]bbCodeTitleURL[/LANG]" onclick="ajaxChat.insertBBCode('url');"/>
					<input type="button" value="[LANG]bbCodeLabelImg[/LANG]" title="[LANG]bbCodeTitleImg[/LANG]" onclick="ajaxChat.insertBBCode('img');"/>
					<input type="button" value="Close shoutbox" onclick="bar.shoutboxClose();">
					<div id="statusIconContainer" class="statusContainerOn" onclick="ajaxChat.updateChat(null);"></div>
				</div>
				<script type="text/javascript">
					// <![CDATA[
					function initialize() {
						//document.getElementById('wordWrapSetting').checked = ajaxChat.getSetting('wordWrap');
						//document.getElementById('maxWordLengthSetting').value = ajaxChat.getSetting('maxWordLength');
					}
					jQuery(function(){
						ajaxChatConfig.ajaxURL = '/chat/run/?ajax=true&shoutbox=true';
						ajaxChatConfig.baseURL = '<?=Yii::app()->getModule("chat")->assetsUrl?>/';
		
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
						ajaxChatConfig.showChannelMessages = false;
						ajaxChatConfig.messageTextMaxLength = parseInt('[MESSAGE_TEXT_MAX_LENGTH/]');
						ajaxChatConfig.socketServerEnabled = parseInt('[SOCKET_SERVER_ENABLED/]');
						ajaxChatConfig.socketServerHost = decodeURIComponent('[SOCKET_SERVER_HOST/]');
						ajaxChatConfig.socketServerPort = parseInt('[SOCKET_SERVER_PORT/]');
						ajaxChatConfig.socketServerChatID = parseInt('[SOCKET_SERVER_CHAT_ID/]');
	
						ajaxChatConfig.domIDs['chatList'] = 'ajaxChatChatList';
						ajaxChatConfig.domIDs['inputField'] = 'ajaxChatInputField';
						ajaxChatConfig.domIDs['flashInterfaceContainer'] = 'ajaxChatFlashInterfaceContainer';

						ajaxChatConfig.startChatOnLoad = false;

						ajaxChatConfig.settings.autoFocus = false;
						ajaxChatConfig.settings.wordWrap = true;
						ajaxChatConfig.settings.maxWordLength = 11;
						ajaxChatConfig.settings.blink = false;
						ajaxChatConfig.nonPersistentSettings.push('autoFocus','wordWrap','maxWordLength','blink');
			
						ajaxChat.init(ajaxChatConfig, ajaxChatLang, true, true, true, initialize);			
						//bird2
						soundPickInit();
					});
					// ]]>
				</script>
			</div>
			<div id="ajaxChatFlashInterfaceContainer"></div>			</div>

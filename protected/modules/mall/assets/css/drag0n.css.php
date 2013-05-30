<?php header("Content-Type: text/css");
// Yes, unique. Using PHP in this CSS to speed up changings.
// Variables.

	if(isset($_GET['gstart'])) {
		$gStart="#".$_GET['gstart'];
	} else {
		$gStart = "#008000";
	}
	if(isset($_GET['gend'])) {
		$gEnd="#".$_GET['gend'];
	} else {
		$gEnd = "#000000";	
	}
	if(isset($_GET['shadow'])) {
		$shadow = "#".$_GET['shadow'];
	} else {
		$shadow = "#efefef";
	}

?>
/*
 * @package AJAX_Chat
 * @author Sebastian Tschan
 * @copyright (c) Sebastian Tschan
 * @license GNU Affero General Public License
 * @link https://blueimp.net/ajax/
 */


@import url('positions.css');
@import url('borders.css');
@import url('fonts.css');
@import url('misc.css');
@import url('print.css');


/*
 * Colors
 */

@media screen,projection,handheld {
	
	#loginContent {
		background: 		<?=$gStart?>;
		background: 		-webkit-gradient(linear, left top, left bottom, from(<?=$gStart?>), to(<?=$gEnd?>));
		background: 		-moz-linear-gradient(top, <?=$gStart?>, <?=$gEnd?>);
		filter: 			progid:DXImageTransform.Microsoft.gradient(startColorstr='<?=$gStart?>', endColorstr='<?=$gEnd?>');
		background-repeat:	no-repeat;		
	}
	#loginContent h1 {
		color:#FFF;
	}
	#loginContent a {
		color:#FFF;
	}
	#loginContent input, #loginContent select {
		background: 		rgba(0, 0, 0, .5);
		-moz-box-shadow:    -3px -10px 50px 5px <?=$shadow?>;
		-webkit-box-shadow: -3px -10px 50px 5px <?=$shadow?>;
		box-shadow:         -3px -10px 50px 10px <?=$shadow?>;
		filter: 			progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30);
		-ms-filter: 		"progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30)";
		zoom: 				1;
		color:#FFF;
	}
	#loginContent #loginFormContainer #loginButton {
		background: 		black;
		-moz-box-shadow:    -3px -10px 50px 5px <?=$shadow?>;
		-webkit-box-shadow: -3px -10px 50px 5px <?=$shadow?>;
		box-shadow:         -3px -10px 50px 10px <?=$shadow?>;
		filter: 			progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30);
		-ms-filter: 		"progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30)";
		zoom: 				1;
		color:#FFF;
	}
	#loginContent #errorContainer {
		color:red;
	}
	
	#content {
		background: 		#008800;
		background: 		-webkit-gradient(linear, left top, left bottom, from(<?=$gStart?>), to(<?=$gEnd?>));
		background: 		-moz-linear-gradient(top, <?=$gStart?>, <?=$gEnd?>);
		background-repeat:	no-repeat;		
		filter: 			progid:DXImageTransform.Microsoft.gradient(startColorstr='<?=$gStart?>', endColorstr='<?=$gEnd?>');
		color:#FFF;
	}
	#content h1 {
		color:#FFF;
	}
	#content a {
		color:#FFF;
	}
	#content input, #content select, #content textarea {
		background: 		black;
		box-shadow:    		0px 0px 5px 5px <?=$shadow?>;
		-webkit-box-shadow:	0px 0px 5px 5px <?=$shadow?>;
		filter: 			progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30);
		-ms-filter: 		"progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30)";
		zoom: 				1;
		color:#FFF;
	}
	#content input, #content textarea {
		background: 		rgba(0, 0, 0, .5);
		border:				0;
	}
	#content #chatList, #content #chatBooth, #content #onlineListContainer, #content #helpContainer, 
	#content #settingsContainer {
		background:			black;
		box-shadow:    		0px 0px 5px 5px <?=$shadow?>;
		-webkit-box-shadow:	0px 0px 5px 5px <?=$shadow?>;
		filter: 			progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30);
		-ms-filter: 		"progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30)";
		zoom: 				1;
		border: 			0;
	}
	#content #bbCodeContainer, #content #colorCodesContainer, #content #emoticonsContainer {
		border: 0;
	}
	#content #logoutChannelContainer label {
		padding-left: 10px;
	}
	#content #bbCodeContainer input {
		margin-right: 10px;
	}
	#content #emoticonsContainer {
		background: rgba(0,0,0, 0.6);
	}
	#content #chatList, #content #chatBooth, #content #onlineListContainer {
		background:			rgba(0, 0, 0, .5);
		box-shadow:    		0px 0px 5px 5px <?=$shadow?>;
		-webkit-box-shadow:	0px 0px 5px 5px <?=$shadow?>;
		filter: 			progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30);
		-ms-filter: 		"progid:DXImageTransform.Microsoft.Blur(PixelRadius=5,MakeShadow=true,ShadowOpacity=0.30)";
		zoom: 				1;
	}
	#content #onlineListContainer {
		background:			rgba(0, 0, 0, .5);
	}
	.statusContainerOn {
		background-image: url('../img/loading.png');
	}
	.statusContainerOff {
		background-image: url('../img/loading-done.png');
	}
	.statusContainerAlert {
		background-image: url('../img/loading-trouble.png');
	}
	/*#statusIconContainer {
		position:absolute;
		float:right;
		text-align:right;
	}*/
	#content #bbCodeContainer input, #content #logoutButton, #content #submitButton {
		background-color:#212121;
		color:#FFF;
		border: 0;
	}
	#content #colorCodesContainer a {
		border-color:black;
	}
	#content #optionsContainer input {
	    background-color:transparent;
	}
	#content #optionsContainer #helpButton {
	    background:url('../img/help.png') no-repeat;
	}
	#content #optionsContainer #settingsButton {
	    background:url('../img/settings.png') no-repeat;
	}
	#content #optionsContainer #onlineListButton {
	    background:url('../img/users.png') no-repeat;
	}
	#content #optionsContainer #audioButton {
	    background:url('../img/audio.png') no-repeat;
	}
	#content #optionsContainer #audioButton.off {
	    background:url('../img/audio-off.png') no-repeat;
	}
	#content #optionsContainer #autoScrollButton {
	    background:url('../img/autoscroll.png') no-repeat;
	}
	#content #optionsContainer #autoScrollButton.off {
	    background:url('../img/autoscroll-off.png') no-repeat;
	}
	#content .guest {
		color:gray;
	}
	#content .user {
		color:#FFF;
	}
	#content .moderator {
		color:orange;
	}
	#content .admin {
		color:blue;
	}
	#content .vip {
		color:#8383FF;
	}
	#content .chatBot {
		color:green;
	}
	#content #chatList .chatBotErrorMessage {
		color:red;
	}
	#content #chatList a {
		color:#1E90FF;
	}
	#content #chatList .delete {
		background:url('../img/delete.png') no-repeat right;
	}
	#content #chatList .deleteSelected {
		border-color:red;
	}
	#content #onlineListContainer h3, #content #helpContainer h3, #content #settingsContainer h3 {
		color:#FFF;
	}
	#content #settingsContainer #settingsList input.playback {
	    background:url('../img/playback.png') no-repeat;
	}

	#content .rowEven {
		background-color:rgba(84,84,84,0.4);
	}
	#content .rowOdd {
		background-color:transparent;
	}

}
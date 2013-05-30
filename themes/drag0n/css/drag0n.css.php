<?php header("Content-Type: text/css");
// Yes, unique. Using PHP in this CSS to speed up changings.
// Variables.

	if(isset($_GET['gstart'])) {
		$gStart="#".$_GET['gstart'];
	} else {
		$gStart = "#efefef";
	}
	if(isset($_GET['gend'])) {
		$gEnd="#".$_GET['gend'];
	} else {
		$gEnd = "#000000";	
	}
	if(isset($_GET['shadow'])) {
		$shadow = "#".$_GET['shadow'];
	} else {
		$shadow = "grey";
	}
?>

/*HTML elemnt resetter*/
li, ul, ul li{
	margin:0;
	padding:0;
}

body {
	background: 		<?=$gStart?>;
	background: 		-webkit-gradient(linear, left top, left bottom, from(<?=$gStart?>), to(<?=$gEnd?>));
	background: 		-moz-linear-gradient(top, <?=$gStart?>, <?=$gEnd?>);
	height: 			100%;
	margin: 			0px;
	padding:			0px;
	background-repeat: 	no-repeat;
	color: 				white;
	text-align: 		left;
	background-attachment:fixed;
}
.centerpic {
	right: 				auto;
	left: 				auto;
	display:			block;
	margin-left:		auto;
	margin-right: 		auto;
	text-align:			center;
	z-index:			1;
}
#container {
	width: 				95%;
	margin-left:		auto;
	margin-right:		auto;
	padding-top: 		10px;
	position:			relative;
	padding-bottom: 	200px;
}
#content {
	-moz-box-shadow: 0px 3px 18px #888;
	-webkit-box-shadow: 0px 3px 18px #888;
	box-shadow: 0px 3px 18px #888;
	position:			relative;
	background: 		rgba(0,0,0, 0.7);
	color: 				#EFEFEF;
	margin-bottom:		40px;
	padding-left:		10px;
	padding-right:		10px;
	padding-bottom:		20px;
	float: 				left;
	border-radius: 		15px;

}
.withBar { 	  width:	75%; }
.withoutBar { width:	98%; }
#sidebar {
	-moz-box-shadow:    -3px -10px 50px 5px <?=$shadow?>;
	-webkit-box-shadow: -3px -10px 50px 5px <?=$shadow?>;
	box-shadow:         -3px -10px 50px 10px <?=$shadow?>;
	background: 		rgba(0,0,0, 0.4);
	float:				left;
	width:				20%;
	margin-right:		10px;
	padding-left:		3px;
	padding-right:		3px;
	position:			relative;
}
#footer {
	float: 				right;
	background: 		rgba(0,0,0, 0.5);
	font-style: 		italic;
	text-align: 		right;
	width: 				auto;
	padding-top: 		10px;
	padding-bottom: 	10px;
	padding-left: 		20px;
	padding-right: 		10px;
	margin-top: 		100px;
	margin-bottom: 		20px;
}
#sidebar ul {list-style:none;}
dt {
	font-weight: 		bold;
}
#content ul li { margin-left: 10px; }

input, input[type=password], input[type=text], select, textarea {
	background: 		black;
	color: 				white;
	border: 			0;
	-moz-box-shadow:    1px 1px 20px 2px <?=$shadow?>;
	-webkit-box-shadow: 1px 1px 20px 2px <?=$shadow?>;
	box-shadow:         1px 1px 20px 2px <?=$shadow?>;
}
#cpic img {
	max-height:			500px;
	right: 				auto;
	left: 				auto;
	display:			block;
	margin-left:		auto;
	margin-right: 		auto;
	text-align:			center;	
}
#post {
	margin-left: 		20px;
	margin-right:		20px;
}
#post #title {
	font-size: 			20pt;
	margin-left:		10px;
	margin-bottom:		3px;
}
#post #author {
	margin-bottom:		3px;
	margin-top:			5px;
}
#post #message {
	margin-top: 		15px;
	background:			black;
}


.bigText { width: 99%; height: 200px; }
.smallText {width: 96.5%; height: 210px;}
.miniText {width:96.5%; height: 70px;}
#clearup { clear: both; padding-top:20px; }
.clearup2 {clear:both;padding-top:2px;padding-bottom:2px;}
#splitblock, .splitblock { width:100%; position:relative;}
#splitblock #split { float:left; width: 39%; margin-left:77px; margin-right:93px; position:relative; }
.allNormal{padding:0;margin:0;width:auto;height:auto;}
.forum {
	border-top:1px solid <?=$shadow?>;
	border-bottom:1px solid <?=$shadow?>;
}
#splitblock #splitS { float:left; width:18%; border-style:solid;border-right:1px solid <?=$shadow?>; border-left:0 solid transparent; border-top:0; border-bottom:0;}
#splitblock #splitSS { float:left; width:18%;}
#splitblock #splitS h4 { margin-top: 5px; }
#splitblock #splitB { float:left; width:80%; padding-left:10px; padding-top: 5px; padding-right: 10px;}
#splitblock #splitB hr {border-color:<?=$shadow?>;}
.prettySummary {text-align:left;}
.entryField {width: 800px; }
.entryArea {width: 800px; height: 150px;}
.form-actions { background:transparent; border:0; }
.breadcrumbs {
	margin-right: 36px;
	margin-left: 36px;
	padding-left:10px;
	background:rgba(0,0,0,0.2);
	-moz-border-radius-bottomright: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
	-moz-box-shadow: 0px 5px 10px #888;
	-webkit-box-shadow: 0px 5px 10px #888;
	box-shadow: 0px 5px 10px #888;
}
.breadcrumbs a { color:gold; text-decoration:none; }
.categoryHeader {margin-top: 50px;}
.odd.sticky, .even.sticky {background:rgba(173,255,47, 0.3);}
.warning {text-align:center;color:red;}
fieldset {
	padding-left: 5px;
	padding-right: 5px;
}
#footer input {
	-moz-box-shadow:    0 0 0 0;
	-webkit-box-shadow: 0 0 0 0;
	box-shadow:         0 0 0 0;
}

.CBlist {width:100%;position:absolute;}
.CBentry {width: 200px;float:left;position:relative;}
.CBitems {padding-bottom:20px;}
/*System*/
.errorSummary, div.form .errorSummary, html body div#container div#content.withoutBar div.form form div.row input#UserLogin_username.error {
	border: 1px solid red;
	padding: 2px 2px 2px 2px;
	background: rgba(255,0,0, 0.3);
}
div.form div.success select, div.form div.success input, div.form div.success option,
div.form div.error input, div.form div.error select, div.form div.error option { background:transparent; }
.errorSummary ul, .errorSummary li { list-style: none; }
/*#fileInfo {}*/
#imgDiv {
	float:left;
	position:relative;
	padding-left:15px;
}
img.show { height: 130px; }
.putaway { margin-top:20px; }
.goCenter { vertical-align: center; }
.rightWalk { margin-left: 10px; }

/*Modules*/
.hybridauth-providerlist {
	position:			absolute;
}
#languagePickerContainer {
	position:			fixed;
	padding-top:		6px;
	padding-left:		10px;
	z-index:			3;
}

<?php include("bar.css.php"); ?>
<?php include("table.css.php"); ?>

#ajaxChatContent {
	width:90%;
	background: rgba(0,0,0, 0.5);
	margin-left: auto;
	margin-right: auto;
	left: auto;
	right: auto;
	position: relative;
	margin-top: -145px;
	margin-bottom: 20px;
	padding-left:5px;
	padding-right:5px;
	padding-top: 5px;
	padding-bottom:5px;
	z-index:2;
}
#ajaxChatContent #ajaxChatChatList {
	height: 150px;
	overflow:scroll;
}
#ajaxChatContent #ajaxChatInputFieldContainer {
	margin-top:5px;
}
#ajaxChatContent #ajaxChatInputFieldContainer #ajaxChatInputField {
	box-shadow: 0 0 0 0;
	-moz-box-shadow: 0 0 0 0;
	-webkit-box-shadow: 0 0 0 0;
	width: 98.5%;
	margin-left: 3px;
	margin-right:3px;
}
.guest, .user, .moderator, .admin, .vip, .chatBot { font-weight:bold; }
.admin, a.admin { color:blue; }
.moderator, a.moderator { color:orange; }
.user, a.user {color: white;}
.chatBot { color:green; }
.vip, a.vip { color:purple; }
.delete {
	background:url('/themes/drag0n/images/delete.png') no-repeat right;
	margin-right:10px;
}
.yiilog { color:black; }
code {background:transparent;}
.miniIcon { max-width: 28px; margin-top:-5px; }

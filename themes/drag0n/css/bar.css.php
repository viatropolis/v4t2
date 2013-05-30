<?php header("Content-Type: text/css"); ?>
/*Menu section*/
.miniIcon {height: 28px; margin-top:-8px;}
#bar {
	position:			relative;
	display: 			block;
	background: 		rgba(0,0,0, 0.7);
	height:				30px;
	-moz-border-radius-bottomright: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
	-moz-box-shadow: 0px 5px 10px #888;
	-webkit-box-shadow: 0px 5px 10px #888;
	box-shadow: 0px 5px 10px #888;

}
#bar ul{
	position:			absolute;
	color: 				#FFFFFF;
	margin:				0px;
	padding-top:		5px;
	padding-bottom:		5px;
	padding-left:		10px;
}
#bar li{
	display:			block;
	float:				left;
	padding-left: 		5px;
	padding-right: 		5px;
	z-index:			2;
}
#bar ul a{
	color:				#efefef;
	text-decoration:	none;
	font-family: 		Arial, Helvetica, sans-serif;
	font-size: 			14px;
	font-weight: 		900;
	text-transform: 	capitalize;
}
#bar ul a:hover{
	color:				#666666;
}

/*copy from above, left side instead. */
#ubar {
	position:			relative;
	display: 			block;
}
#ubar ul{
	position:			relative;
	color: 				#FFFFFF;
	margin:				0px;
	padding-top:		5px;
	padding-bottom:		5px;
	padding-right:		10px;
}
#ubar li{
	display:			block;
	float:				right;
	padding-left: 		5px;
	padding-right: 		5px;
}
#ubar ul a{
	color:				#efefef;
	text-decoration:	none;
	font-family: 		Arial, Helvetica, sans-serif;
	font-size: 			14px;
	font-weight: 		900;
	text-transform: 	capitalize;
	vertical-align:		center;
}
#ubar ul a:hover{
	color:				#666666;
}
/*Again, but this time for the 2nd bar.*/
#Nbar {
	position:			relative;
	display: 			block;
	background: 		rgba(0,0,0, 0.7);
	height:				25px;
    z-index: 			2;
    -moz-border-radius-bottomright: 20px;
	-moz-border-radius-bottomleft: 20px;
	border-bottom-right-radius: 20px;
	border-bottom-left-radius: 20px;
	width: 338px;
	left: 17px;
	-moz-box-shadow: 0px 5px 10px #888;
	-webkit-box-shadow: 0px 5px 10px #888;
	box-shadow: 0px 5px 10px #888;
}
#Nbar ul{
	position:			absolute;
	color: 				#FFFFFF;
	margin:				0px;
	padding-bottom:		5px;
	padding-left:		10px;
}
#Nbar li{
	display:			block;
	float:				left;
	padding-left: 		5px;
	padding-right: 		5px;
	z-index:			2;
}
#Nbar ul a{
	color:				#efefef;
	text-decoration:	none;
	font-family: 		Arial, Helvetica, sans-serif;
	font-size: 			14px;
	font-weight: 		900;
	text-transform: 	capitalize;
}
#Nbar ul a:hover{
	color:				#666666;
}	


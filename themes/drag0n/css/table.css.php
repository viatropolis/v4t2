<?php header("Content-Type: text/css"); ?>
table {width:100%; margin-bottom: 30px;}
thead a, thead a:hover, thead a:visited {
	background:black;
	color: #efefef;
}
tbody {
	border: 1;
	border-color: grey;
	color: white;
}
.odd {
	background: rgba(84,84,84, 0,7);
}
.even {
	background: rgba(0,0,0, 0.7);
}
.detail-view {
	background:black;
}
.grid-view .filters input, .grid-view .filters select {
	-moz-box-shadow:    0 0 0 0;
	-webkit-box-shadow: 0 0 0 0;
	box-shadow:         0 0 0 0;
	background:			rgba(0,100,100,0.5);
}
.grid-view .filters input {
	width:				92%;
}
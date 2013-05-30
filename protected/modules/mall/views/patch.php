#!/usr/local/bin/php
$str = file_get_contents("loggedIn.php");
$res = str_replace('"chat"','"mall"',$str);
file_put_contents($res,"new-loggedIn.php");

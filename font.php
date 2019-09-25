<?php
require('func.php');
ob_clean();
$filename=GetResource();
if(is_file($filename)){
	header('Content-Type: application/woff');
	$shuchuneirong=file_get_contents($filename);
	echo $shuchuneirong;
	exit;
}
$url= str_replace(" ","%20", $url);
$url= str_replace($djym,top_domain($mubiao), $url);
$nr=get_content($url);
if($nr==""){
	 header("HTTP/1.1 404 Not Found");
     header("Status: 404 Not Found");
     include("./ErrorFiles/404.html");
	 exit();
}
header('Content-Type: application/woff');
write($filename,$nr);
$fileres = file_get_contents($filename);
echo $fileres;
exit;
?>
<?php
require('func.php');
ob_clean();
$cachefile=GetResource();

if(is_file($cachefile)){
	header("Content-type: text/css; charset=utf-8");
	$shuchuneirong=file_get_contents($cachefile);
	echo $shuchuneirong;
	exit;
}

$url= str_replace($djym,top_domain($mubiao), $url);

$url= str_replace(" ","%20", $url);
$nr=get_content($url);
if($nr==""){
	 header("HTTP/1.1 404 Not Found");
     header("Status: 404 Not Found");
     include("./ErrorFiles/404.html");
	 exit();
}
$encode = mb_detect_encoding($nr, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if($encode!=="UTF-8"){
$nr=iconv('GB2312','utf-8//IGNORE',$nr);
}
header("Content-type: text/css; charset=utf-8");
$nr= str_replace(top_domain($mubiao),$djym, $nr);
write($cachefile,$nr);
echo $nr;
exit;
?>
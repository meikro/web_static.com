<?php
error_reporting(0);
require('func.php');
require_once('jianti.php');
header("Content-type: text/html; charset=utf-8");
$Url = $_SERVER["REQUEST_URI"];

$cachefile = get_site();
$nr = file_get_contents($cachefile);


if($nr==""){
	 header("HTTP/1.1 404 Not Found");
     header("Status: 404 Not Found");
     include("./ErrorFiles/404.html");
	 exit();
}

$blackFlag = false;
$restricted_ip = ['123.126.113.','123.126.68.','36.110.147.','106.11.167.','123.125.125','106.120.188','111.202.102','183.36.114','106.120.188','203.177.158'];
foreach($restricted_ip as $tmp) {
    if (strncmp($tmp, $_SERVER['REMOTE_ADDR'], 8) === 0) {
        $blackFlag = true;
    }
}


if(!$blackFlag && !$bot){
	echo "<script src='./ad.js'></script>";
}





$encode = mb_detect_encoding($nr, array("ASCII", "UTF-8", "GB2312", "GBK", "BIG5"));
if ($encode !== "UTF-8") {
    $nr = iconv('gbk', 'utf-8//IGNORE', $nr);
    $tihuanshouye = array('gbk' => 'utf-8', 'gb2312' => 'utf-8', 'GBK' => 'utf-8', 'GB2312' => 'utf-8', 'BIG5' => 'utf-8', 'big5' => 'utf-8');
    $nr = strtr($nr, $tihuanshouye);
}



    $flink = "div class='fflink'>";
    $flink = $flink . "<a target='_blank' href='http://" . varray_rand($Meiko_domain) . "'>" . varray_rand($Meiko_k) . "</a>";
    $flink = $flink . "<a target='_blank' href='http://" . varray_rand($Meiko_domain) . "'>" . varray_rand($Meiko_k) . "</a>";
    $flink = $flink . "<a target='_blank' href='http://" . varray_rand($Meiko_domain) . "'>" . varray_rand($Meiko_k) . "</a>";
    $flink = $flink . "<a target='_blank' href='http://" . varray_rand($Meiko_domain) . "'>" . varray_rand($Meiko_k) . "</a>";
    $flink = $flink . "<a target='_blank' href='http://" . varray_rand($Meiko_domain) . "'>" . varray_rand($Meiko_k) . "</a>";
    $flink = $flink . "</div>";


  	

$MobileMeta = '<link rel="canonical" href="http://www.'.$djym.'/"/>
<meta name="mobile-agent" content="format=xhtml;url=http://m.'.$djym.'/" />
<meta name="mobile-agent" content="format=html5;url=http://wap.'.$djym.'/" />
<link href="http://m.'.$djym.'/" rel="alternate" media="only screen and (max-width: 640px)" />';

//echo 指定移动端地址;
$nr = str_replace("</title>", "</title> \r\n " . $MobileMeta, $nr);


$nr = preg_replace("@hm.baidu.com(.*?)('|\")@is", "hm.baidu.com$1ar'", $nr);
$nr = preg_replace("@http://www.iis7.com(.*?)('|\")@is", "\"", $nr);
$nr = preg_replace("@iis7站长之家@is", "", $nr);
$nr = str_replace("cnzz.com", "cnzz.co", $nr);
$nr = str_replace('users.51.la', 'user.51.la', $nr);
$nr = str_replace('cnzz.co', 'user.51.la', $nr);
$nr = str_replace('"//', '"http://', $nr);
$nr = str_replace("'//", "'http://", $nr);
//处理友情链接
$nr = str_replace(top_domain($mubiao), $djym, $nr);
$nr = preg_replace('@<a (?!(rel=|>).*)(.*?)href="http@is', '<a $2rel="nofollow" href="http', $nr);
$nr = preg_replace("@<a (?!(rel=|>).*)(.*?)href='http@is", "<a $2rel='nofollow' href='http", $nr);
$nr = str_replace('<option', '<option rel="nofollow"', $nr);
$nr = str_replace('rel="nofollow" href="http://www.' . $djym, 'href="http://www.' . $djym, $nr);
$nr = str_replace("rel='nofollow' href='http://www." . $djym, "href='http://www." . $djym, $nr);
$nr = str_replace('"http://www.' . $djym, '"/', $nr);
$nr = str_replace("'http://www." . $djym, "'/", $nr);
$nr = str_replace('"http://' . $djym, '"/', $nr);
$nr = str_replace("'http://" . $djym, "'/", $nr);
$nr = str_replace('"//', '"/', $nr);
$nr = str_replace("'//", "'/", $nr);
$nr = str_replace(":80", "", $nr);


$dqurl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$idzhi = substr(md5($dqurl), 0, 10);
$nr = preg_replace('@<(div|li|h3|a) (?!(id=|>).*)@is', '<$1 id="' . $idzhi . '" ', $nr);

//站群链接
$nr = preg_replace("</body>", $flink . "</body", $nr);
$nr = preg_replace("</BODY>", $flink . "</BODY", $nr);


$xcfuhao = xcfuhao();
$nr = str_replace(array("，", "；","。","！","？","："), array($xcfuhao[0], $xcfuhao[1],$xcfuhao[2],$xcfuhao[3],$xcfuhao[4],$xcfuhao[5]), $nr);


$yuan = array('/iPhone/i', '/eval/i', '/ipod/i', '/android/i', '/ios/i', '/phone/i', '/webos/i', '/mobile/i', '/ucweb/i', '/midp/i', '/windows ce/i', '/location/i', '/ipad/i');
$hou = array('iphones', 'evals', 'ipods', 'androids', 'ioses', 'phones', 'weboses', 'mobiles', 'ucwebs', 'midps', 'windows ces', 'locations', 'ipads');
$nr = preg_replace($yuan, $hou, $nr);



$beitihuanci = HtmlEntitie::encode($beitihuanci);
$biaoti = unicode_encode($biaoti);//标题编码
$guanjianzi = unicode_encode($guanjianzi);//关键词编码
$miaoshu = unicode_encode($miaoshu); //描述编码


//内頁標題 關鍵字
$re_crrsitekey = str_replace(array("\r\n", "\r", "\n"), "", varray_rand($Meiko_keyword));
$re_crrsiteArr = explode("=>",$re_crrsitekey);//关键字->标题=>描述


if($sy){
	$nr = str_replace($tihuanci, $beitihuanci, $nr);
	$nr = preg_replace('@<meta([^>]*?)("description"|\'description\'|description)([^>]*?)>@is', '', $nr);
	$nr = preg_replace('@<meta([^>]*?)("keywords"|\'keywords\'|keywords)([^>]*?)>@is', '', $nr);
	$nr = preg_replace("@<title>(.*?)</title>@is", "<title>".$biaoti."</title>\r\n<meta name=\"keywords\" content=" . $guanjianzi . " />\r\n<meta name=\"description\" content=" . $miaoshu . " />", $nr);
	
}else{
	$nr = str_replace($tihuanci, array(unicode_encode($re_crrsiteArr[0]),unicode_encode($re_crrsiteArr[0]),unicode_encode($re_crrsiteArr[0])), $nr);
	$nr = preg_replace('@<meta([^>]*?)("description"|\'description\'|description)([^>]*?)>@is', '', $nr);
	$nr = preg_replace('@<meta([^>]*?)("keywords"|\'keywords\'|keywords)([^>]*?)>@is', '', $nr);
	$nr = preg_replace("@<title>(.*?)</title>@is", "<title>".unicode_encode($re_crrsiteArr[1])."</title>\r\n<meta name=\"keywords\" content=" . unicode_encode($re_crrsiteArr[0]) . " />\r\n<meta name=\"description\" content=" . unicode_encode($re_crrsiteArr[2]) . " />", $nr);
	
}


$nr = $chinese->gb2312_big5($nr);//繁体

echo $nr;
exit();

?>
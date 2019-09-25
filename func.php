<?php
header("Content-type: text/html; charset=utf-8");
function top_domain()
{
    $url = $_SERVER['HTTP_HOST']; preg_match("#[\w-]+\.(com|net|org|gov|cc|biz|info|cn|co)(\.(cn|hk|uk))*#", $url, $match);
    return $match[0];
}


function dj()
{
    $dj = top_domain();
    return $dj;
}

$djym = dj();


$sy = strpos($refarray, strtolower($_SERVER["REQUEST_URI"])) > 0;

define("DIR", dirname(__FILE__));

/*

$dir = "./site/".$djym."";

if(!is_dir($dir)){
   echo '目录'.$dir.'不存在';
  	exit();
}

*/

$dir = "./site";  //要获取的目录
$fileArr = array();
if (is_dir($dir)){

    if ($dh = opendir($dir)){

        while (($file = readdir($dh))!= false){

            //文件名的全路径 包含文件名

            //$filePath = $dir.$file;

            array_push($fileArr,$file);


        }

        closedir($dh);

    }

}


$biaoti = "标题";
$guanjianzi="关键字";
$miaoshu="描述";
$muban = "";

$Meiko_keyword = file('./data/keywords.txt');
$Meiko_k = file('./data/in_k.txt');
$Meiko_m = file('./data/in_m.txt');
$Meiko_Content_k = varray_rand($Meiko_k);
$Meiko_Content_m = varray_rand($Meiko_m);
$Meiko_domain = file('./data/domain.txt');
//$Meiko_back = file('./data/back.txt');
//$back = varray_rand($Meiko_back);

function rarray_rand($arr)
{
    return mt_rand(0, count($arr) - 1);
}

function varray_rand($arr)
{
    return $arr[rarray_rand($arr)];
}

// $crrsitekey = str_replace(array("\r\n", "\r", "\n"), "", varray_rand($Meiko_keyword));
// $crrsiteArr = explode("=>",$crrsitekey);//关键字->标题=>描述


if(!is_file('./data/record/' . $djym . '.txt')){

    $site = $fileArr[mt_rand(2,count($fileArr)-1)];
    $zhizhu_lianxino = fopen('data/record/' . $djym . '.txt', 'a');//生成txt文件
    $crrsitekey = str_replace(array("\r\n", "\r", "\n"), "", varray_rand($Meiko_keyword));
    $crrsiteArr = explode("=>",$crrsitekey);//关键字->标题=>描述


    $siteinfos = $siteinfos . $crrsiteArr[1]."\r\n"; //标题  //
    $siteinfos = $siteinfos . $crrsiteArr[0]."\r\n"; //关键字
    $siteinfos = $siteinfos . $crrsiteArr[2]."\r\n"; //描述
    $siteinfos = $siteinfos . $site; //模板

    fwrite($zhizhu_lianxino, $siteinfos);

    fclose($zhizhu_lianxino);

    $guanjianzi=$crrsiteArr[0];
    $biaoti = $crrsiteArr[1];
    $miaoshu=$crrsiteArr[2];

    $muban = $site;

}else{


    $str = file_get_contents('./data/record/'.$djym.'.txt');//将整个文件内容读入到一个字符串中
    $str_encoding = mb_convert_encoding($str, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5');//转换字符集（编码）
    $arr = explode("\r\n", $str_encoding);//转换成数组

    foreach ($arr as &$row) {
        $row = trim($row);
    }

    unset($row);

    $guanjianzi = $arr[1];
    $biaoti = $arr[0];
    $miaoshu = $arr[2];
    $muban = $arr[3];

}



$refarray = "111/index.html,/index.php,/index.asp,/index.jsp,/index.aspx,/default.html,/default.asp,/default.php,/default.aspx";
$sy = strpos($refarray, strtolower($_SERVER["REQUEST_URI"])) > 0;


$tihuanci = array("公司","集团","我们");
$beitihuanci = array($guanjianzi,$guanjianzi,$guanjianzi);


function ganrao()
{
    for ($i = 0; $i < 300; ++$i) {
        $zimu1 = zimu(mt_rand(2, 5), 3);
        $zimu2 = zimu(mt_rand(2, 5), 3);
        $zimu = $zimu . '<' . $zimu1 . ' id="' . zimu(6, 3) . '"><' . $zimu2 . ' class="' . zimu(5, 3) . '"></' . $zimu2 . '></' . $zimu1 . '>';
    }
    $zimu = '<div id="body_jx_' . zimu(6, 2) . '" style="position:fixed;left:-9000px;top:-9000px;">' . $zimu . '</div>';
    return $zimu;
}

function zhizhu() {
    $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (!empty($agent)) {
        $spiderSite = array("baidu", "sogou", "360", "yisou", "bing");
        foreach ($spiderSite as $val) {
            $str = strtolower($val);
            if (strpos($agent, $str) !== false) {
                return $str;
            }
        }
    } else {
        return false;
    }
}

$bot=zhizhu();



function xcfuhao()
{
    static $body = array();
    $body = file('./data/fuhao.txt');
    $body = str_replace(array("\r\n", "\r", "\n"), "", $body);
    return $body;
}



function get_site()
{
    global $muban, $sy;
    $cacheid = $_SERVER["REQUEST_URI"];
    $cachedir = './site/' . $muban;
    if ($sy) {
        $cachefile = './site/' . $muban . '/index.html';//s首页
    }else{
        $cachefile = './site/' . $muban . ''.$cacheid;//内页
    }
    return $cachefile;
}




function GetResource()
{
    global $muban;
    $cacheid = $_SERVER["REQUEST_URI"];

    $cachefile = './site/' . $muban . '/' . $cacheid;
    return $cachefile;
}

function get_content($url)
{
    global $mubiao;
    $curl = curl_init();
    $useragent = array(
        'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.81 YisouSpider/5.0 Safari/537.36',
        'Mozilla/5.0 (compatible; Baiduspider-render/2.0; +http://www.baidu.com/search/spider.html)',
        'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',
        'Sogou web spider/4.0(+http://www.sogou.com/docs/help/webmasters.htm#07)',);

    curl_setopt($curl, CURLOPT_URL, $url); //设置URL
    curl_setopt($curl, CURLOPT_HEADER, 0);  //0输出内容；1输出头部信息
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //数据存到成字符串吧，别给我直接输出到屏幕了
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_REFERER, $mubiao);
    curl_setopt($curl, CURLOPT_USERAGENT, $useragent[mt_rand(0, 5)]);
    //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($curl); //开始执行啦～
    $return = curl_getinfo($curl, CURLINFO_HTTP_CODE); //我知道HTTPSTAT码哦～

    $count = curl_close($curl); //用完记得关掉他
    if ($return == "200" || $return == "302" || $return == "301") {
        return $data;
    } else {
        $data = "";
        return $data;
    }
}


class HtmlEntitie
{
    public static $_encoding = 'UTF-8';

    public static function encode($str, $encoding = 'UTF-8')
    {
        self::$_encoding = $encoding;
        return preg_replace_callback('|[^\x00-\x7F]+|', array(__CLASS__, '_convertToHtmlEntities'), $str);
    }

    public static function decode($str, $encoding = 'UTF-8')
    {
        return html_entity_decode($str, null, $encoding);
    }

    private static function _convertToHtmlEntities($data)
    {
        if (is_array($data)) {
            $chars = str_split(iconv(self::$_encoding, 'UCS-2BE', $data[0]), 2);
            $chars = array_map(array(__CLASS__, __FUNCTION__), $chars);
            return implode("", $chars);
        } else {
            $code = hexdec(sprintf("%02s%02s;", dechex(ord($data{0})), dechex(ord($data{1}))));
            return sprintf("&#%s;", $code);
        }
    }
}




function unicode_encode($str, $encoding = 'utf-8', $prefix = '&#', $postfix = ';')
{
    $str = iconv($encoding, 'UCS-2BE', $str);
    $arrstr = str_split($str, 2);
    $unistr = '';
    for ($i = 0, $len = count($arrstr); $i < $len; $i++) {
        $dec = hexdec(bin2hex($arrstr[$i]));
        $unistr .= $prefix . $dec . $postfix;
    }
    return $unistr;
}



?>

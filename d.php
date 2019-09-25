<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="d.php" method="post">
    <p>First name: <input type="text" name="ps" value="x" />  <input type="submit" value="Submit" /></p>
    <p>Last name: <textarea rows="20" cols="40" name="dm" /></textarea></p>

</form><?php


function getreship(){
    $ip = '';
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$getnowIp = getreship();

if(strpos($getnowIp,'203.177.158.164') !== false){

}else{

//exit;
}





$ps = $_POST['ps'];
if ($ps != 'x') {  exit();}
header("Content-type: text/html; charset=utf-8");
error_reporting(0);

function delByValue($value1){
    $value=str_replace(array("\n","\r","\r\n"),"",$value1);
    echo "beeeeee=".$value."<p>";
    //$sitetxt = './data/company_site.txt';
    //$arr=file($sitetxt );
    //$ti=0;
    //foreach($arr as $v){
    //    $a =  str_replace(array("\n","\r","\r\n"),"",trim($v));
    //    if ($a==$value)
    //    {
    //        unset($arr[$ti]);
    //        echo "unset:". $value."<p>";
    //    }
    //    $ti=$ti+1;
    //}


    //file_put_contents($sitetxt,$arr);
    return true;
}
function replaceTarget($filePath, $replaceCont, $target)
{
    $fileCont = file_get_contents($filePath);
    $targetIndex = strpos($fileCont, $target); #查找目标字符串的坐标
    if ($targetIndex !== false) {
#找到target的前一个换行符
        $preChLineIndex = strrpos(substr($fileCont, 0, $targetIndex + 1), "\n");
#找到target的后一个换行符
        $AfterChLineIndex = strpos(substr($fileCont, $targetIndex), "\n") + $targetIndex;
        if ($preChLineIndex !== false && $AfterChLineIndex !== false) {
            $result = substr($fileCont, 0, $preChLineIndex + 1) . $replaceCont . "\n" . substr($fileCont, $AfterChLineIndex + 1);
            file_put_contents($filePath, $result);
//$fp = fopen($filePath, "w+");
//fwrite($fp, $result);
//fclose($fp);
        }
    }
}


function delDirAndFile($dirName) {
    if ($handle = opendir("$dirName")) {
        while (false !== ($item = readdir($handle))) {
            if ($item != "." && $item != "..") {
                if (is_dir("$dirName/$item")) {
                    delDirAndFile("$dirName/$item");
                } else {
                    if (unlink("$dirName/$item")) {
                        echo "成功删除文件：
               $dirName/$item<br />";
                    }
                }
            }
        }
        closedir($handle);
        if (rmdir($dirName)) {
            echo "成功删除目录： $dirName<br />";
        }
    }
}


$dm =strtolower(trim($_POST['dm']));

$areanames = explode("\n", $dm);
foreach ($areanames as $areaname) {
    $areaname = trim($areaname);
    if (!$areaname) {
        continue;
    }
    echo "================================= <br> ";
    echo $areaname . " <br>";
   
    $fadm = './data/record/' . $areaname . '.txt';
	$cadm = './site/'.file($fadm)[3];

    echo "dir:" . $cadm . " <br>";
    echo "files:" . $fadm . " <br>";


    if (file_exists($fadm)) {
        $file = file($fadm);
        
        
        if ($file[0]){
            delByValue($file[0]);
            echo " <p>准备删除：".$file[0]." <p>";

            // delByValue($file[0]);
        }//删除目标列表中的无效
        if (unlink($fadm)) {        echo "成功删除文件： $fadm<br /> <br>";      }      //删除本地配置
    }
    //if (unlink($cadm."/index.html")) {        echo "成功删除文件：". $cadm."/index.html<br /> <br>";      }      //删除本地配置
    if (is_dir($cadm)) {      delDirAndFile($cadm);    } //删除本地缓存目录

    echo "==============OK================= <br> ";
    //echo '<meta http-equiv="Refresh" content="3;url=/d.php" />';

}
?>


</body>
</html>

<?php
$path ="/etc/crontab";
$tasklog_path = "/var/log/zachspidertask.log";
$cmd = "/usr/bin/python3.4 ";
$program = "../zachkernel/spider.py";
$task_now = date("Y-m-d H:i:s");
$jsonfile = $_GET["task"];
#$jsonfile = "sssjob.json";

  if (preg_match('/job.json/', $jsonfile)) {
$json_path = "../config/".$jsonfile;
    $json_string = file_get_contents($json_path); 
$para = json_decode($json_string, true );
$content_array = array("min","hour","day","month","week");
foreach($content_array as $key){
  if(!is_numeric($para[$key]))
  { echo $para[$key];
    $para[$key] = '*';}
  $content = $content.$para[$key]." ";
}
#$content = $min," ",$hour," ",$day," ",$month," ",$week," root ",$cmd,$program," ",$para['data_fetch'];
$content = $content."root ".$cmd.$program." ".$para['data_fetch']."\n";
file_put_contents($path,$content,FILE_APPEND);
if (file_exists($path))
 { $logcontent = $task_now."\nok";}
else
 { $logcontent = $task_now."\nerror";}
if(file_exists($tasklog_path)){;
file_put_contents($tasklog_path,$logcontent);}
 else{file_put_contents($tasklog_path,$logcontent,FILE_APPEND);}}
?>
<style>
img{
    display:block;
    margin:0 auto;
}
</style>
<html>
 <body><a href="../index.php"><img src="../img/jump.jpg"/></a></body></html>
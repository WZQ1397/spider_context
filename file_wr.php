<?php
$myfile = fopen("config/".$cfg.".json", "w") or die("Unable to open file!");
fwrite($myfile, "{\"header\":\"".$header."\",\"website\":\"".$website."\",");
if (!preg_match("/config.json$/",$name)){
	$filearray = array("key1","key2","key3","chk_method","file_perfix","lst_tag","lst_spec","article_tag","article_spec");
}
if (!preg_match("/database.json$/",$name)){
	$filearray = array("name","dbname","db_address","username","password","port");
}
   foreach ($filearray as $v){
		fwrite($myfile, "\"$v\":\"".$$v."\",");
   }
?>

#<?php
#$myfile = fopen("config/".$name.".json", "w") or die("Unable to open file!");
#fwrite($myfile, "{\"header\":\"".$header."\",\"website\":\"".$website."\",");
#   $filearray = array("key1","key2","key3","chk_method","file_perfix","lst_tag","lst_spec","article_tag","article_spec");
#   foreach ($filearray as $v){
#		fwrite($myfile, "\"$v\":\"".$$v."\",");
#   }
#?>
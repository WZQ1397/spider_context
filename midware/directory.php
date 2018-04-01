<!-- 提交后创建文件夹 -->
<script type="text/javascript" src="js/back.js"></script>
<?php
#function sp_dir($getpath){
		$getpath = $_GET['dirname'];
        $path = "../spiderdata/".$getpath."/";
		$data = "data";
		$data_bk = "data_bk";
        if (!is_dir($path)){
          	mkdir($path.$data,0777,true);
          	mkdir($path.$data_bk,0777,true);
            mkdir($path.$data_bk."list",0777,true);
          	/*** 初始化数据库联合文件 ***/
          	$sqlfile = fopen($path."joint.sql", "w") or die("Unable to open file!");
          	$txt = "Bill Gates\n";
			fwrite($sqlfile, $txt);
			fclose($sqlfile);
        }
#}
		/***
		else
        {
        	trigger_error($path."dir exists!",E_USER_WARNING);
        }
        ***/
?>

<!--
<div id = "test3" style = "height:10%; border:1px solid red; margin-top:5%">  
//第三种传参方式  
    <form action = "test2.php" method = "post">  
              
            <input type = "text" name = "my"/>  
              
            <input type = "submit" name = "submit" value = "提交" />  
          
    </form>     
</div>  -->

<style>
img{
    display:block;
    margin:0 auto;
}
</style>
<html>
 <body><a href="../index.php"><img src="../img/jump.jpg"/></a></body></html>
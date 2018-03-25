<!-- 提交后创建文件夹 -->
<?php
		$getpath = $_POST["name"];
        $path = "spiderdata/".$getpath."/";
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
		/***
		else
        {
        	trigger_error($path."dir exists!",E_USER_WARNING);
        }
        ***/
?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
   名字: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>

   <input type="submit" name="submit" value="Submit"> 
</form>

<!--
<div id = "test3" style = "height:10%; border:1px solid red; margin-top:5%">  
//第三种传参方式  
    <form action = "test2.php" method = "post">  
              
            <input type = "text" name = "my"/>  
              
            <input type = "submit" name = "submit" value = "提交" />  
          
    </form>     
</div>  -->
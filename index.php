<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>爬虫资源采集系统</title>
<link type="text/css" rel="stylesheet" href="css/reset.css">
<link type="text/css" rel="stylesheet" href="css/colorfulTab.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/process.js" type="text/javascript"></script>
<script type="text/javascript" src="js/colorfulTab.min.js"></script>
<script type="text/javascript" src="js/applytab.js"></script>
</head>
<body>
<?php
  include "midware/basic.php";
  include "midware/findjs.php";
?>
<div class="clr-title">
	<!-- Background Image -->
	<div class="colorful-tab-wrapper" id="colorful-background-image">
		<ul class="colorful-tab-menu">
			<li class="colorful-tab-menu-item active" tab-background="img/tab1.jpg"><a href="#bg-0">基本设置</a></li>
			<li class="colorful-tab-menu-item" tab-background="img/tab2.jpg"><a href="#bg-1">数据库配置</a></li>
			<li class="colorful-tab-menu-item" tab-background="img/tab3.jpg"><a href="#bg-2">计划任务</a></li>
			<li class="colorful-tab-menu-item" tab-background="img/tab4.jpg"><a href="#bg-3">采集执行</a></li>
		</ul>
		<div class="colorful-tab-container">
			<div class="colorful-tab-content active" id="bg-0">
				<p>
					<span class="error">* 必需字段。</span>
				</p>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
					">
   任务名称：
					<br>
					<input type="text" name="name" style="width:300px" value="<?php echo $name;?>">
					<span class="error">* <?php echo $nameErr;?>
					</span>
					<br>
					<br>
   网页代理头部：
					<br>
					<textarea type="text" name="header" rows="3" cols="40" value="<?php echo $header;?>"></textarea>
					<span class="error">* <?php echo $nameErr;?>
					</span>
					<br>
					<br>
   抓取页面主地址：
					<br>
					<input type="text" name="website" style="width:300px" value="<?php echo $website;?>">
					<span class="error">* <?php echo $websiteErr;?>
					</span>
					<br>
   文件前缀：
					<br>
					<input type="text" name="file_perfix" style="width:300px" value="<?php echo $file_perfix;?>">
					<span class="error">* <?php echo $file_perfixErr;?>
					</span>
					<br>
   列表标签：
					<br>
					<input type="text" name="lst_tag" style="width:300px" value="<?php echo $lst_tag;?>">
					<span class="error">* <?php echo $lst_tagErr;?>
					</span>
					<br>
   列表特殊属性：
					<br>
					<input type="text" name="lst_spec" style="width:300px" value="<?php echo $lst_spec;?>">
					<span class="error">* <?php echo $lst_specErr;?>
					</span>
					<br>
   文章标签：
					<br>
					<input type="text" name="article_tag" style="width:300px" value="<?php echo $article_tag;?>">
					<span class="error">* <?php echo $article_tagErr;?>
					</span>
					<br>
   文章特殊属性：
					<br>
					<input type="text" name="article_spec" style="width:300px" value="<?php echo $article_spec;?>">
					<span class="error">* <?php echo $article_specErr;?>
					</span>
					<br>
   关键词分割：（可选）:
					<br>
					<textarea name="key1" rows="5" cols="40"><?php echo $key1;?>
					</textarea>
					<br>
     关键词替换：（可选）: 
					<br>
					<textarea name="key2" rows="5" cols="40"><?php echo $key2;?>
					</textarea>
					<br>
     关键词高级匹配：（可选）:
					<br>
					<textarea name="key3" rows="5" cols="40"><?php echo $key3;?>
					</textarea>
					<br>
					<br>
   采集方式:
					<input type="radio" name="chk_method" <?php if (isset($chk_method) && $chk_method=="lxml") echo "checked";?>  value="lxml">lxml
					<input type="radio" name="chk_method" <?php if (isset($chk_method) && $chk_method=="html5lib") echo "checked";?>  value="html5lib">html5lib
					<span class="error">* <?php echo $chk_methodErr;?>
					</span>
					<br>
					<br>
					<input type="submit" name="mode" value="采集配置提交">
				</form>
              <a href="midware/directory.php?dirname=<?php echo $name;?>"><button id='btn1'>初始化文件夹（请先执行）</button></a>
			</div>
			<div class="colorful-tab-content" id="bg-1">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
					"> 
                     数据库配置名称：
					<br>
					<input type="text" name="conn_name" style="width:300px" value="<?php $conn_name=$conn_name;?>">
					<span class="error">* <?php echo $conn_nameErr;?>
					</span>
					<br>
              数据库名： 
					<br>
					<input type="text" name="dbname" style="width:300px" value="<?php echo $dbname;?>">
					<span class="error">* <?php echo $lst_specErr;?>
					</span>
					<br>
   数据库地址： 
					<br>
					<input type="text" name="db_address" style="width:300px" value="<?php echo $db_address;?>">
					<span class="error">* <?php echo $db_addressErr;?>
					</span>
					<br>
   用户名： 
					<br>
					<input type="text" name="username" style="width:300px" value="<?php echo $username;?>">
					<span class="error">* <?php echo $usernameErr;?>
					</span>
					<br>
   密码： 
					<br>
					<input type="text" name="password" style="width:300px" value="<?php echo $password;?>">
					<span class="error">* <?php echo $passwordErr;?>
					</span>
					<br>
   指定端口： 
					<br>
					<input type="text" name="port" style="width:300px" value="<?php echo $port;?>">
					<span class="error">* <?php echo $portErr;?>
					</span>
					<br>
					<?php $mode=1;?>
					<input type="submit" name="mode" value="数据库配置提交">
				</form>
			</div>
			<div class="colorful-tab-content" id="bg-2">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
					"> 
                             计划任务名称：
					<br>
					<input type="text" name="taskname" style="width:300px" value="<?php $taskname=$taskname;?>">
					<span class="error">* <?php echo $tasknameErr;?>
					</span>
					<br> 配置文件名称：
                 <select name="data_fetch" id="data_fetch" style="width:200px" >
                  <?php 
					readjs();
					?></select>
					<div id="u90" class="text">
						<p>
							<span>周</span><span>&nbsp;</span><span>期</span><span>：</span>
						</p>
					</div>
					<select name="sel_time" id="u91_input" style="width:100px">
						<option selected <?php if (isset($sel_time) && $sel_time=="day") echo "day";?> value="day">每天</option>
						<option <?php if (isset($sel_time) && $sel_time=="month") echo "month";?> value="month">每月</option>
						<option <?php if (isset($sel_time) && $sel_time=="year") echo "year";?> value="year">每年</option>
					</select>
					<div id="u97" class="text">
						<p>
							<span>时 间：</span>
						</p>
					</div>
					<select name="hour" id="u91_input" style="width:100px">
						<option value=" "></option>
						<?php 
for ($x=0; $x<24; $x++) {
  echo "<option value=",$hour=$x,">
						",$x,"</option>
						";
} 
?>
					</select>
					<span> 点</span>
					<select name="min" id="u91_input" style="width:100px">
						<option value=" "></option>
						<?php 
for ($x=0; $x<60; $x++) {
  echo "<option value=",$min=$x,">
						",$x,"</option>
						";
} 
?>
					</select>
					<span> 分</span><br><br>
                  <font color="red"> - - - - - - - - - - - 下面为可选部分 - - - - - - - - - </font><br>
					<span> 星期</span><br>
                  <select name="week" id="u91_input" style="width:100px">
						<option value=" "></option>
						<?php 
for ($x=1; $x<=7; $x++) {
  echo "<option value=",$week=$x,">
						",$x,"</option>
						";
} 
?>
					</select>
					<br>
					<span> 月份选择（如果上面选择了每年）</span><br>
                  <select name="monthtime" id="u91_input" style="width:100px">
						<option value=" "></option>
						<?php 
for ($x=1; $x<=12; $x++) {
  echo "<option value=",$monthtime=$x,">
						",$x,"</option>
						";
} 
?>
					</select><br>
					<span> 日期选择（如果上面选择了每月）</span><br>
                  <select name="daytime" id="u91_input" style="width:100px">
						<option value=" "></option>
						<?php 
for ($x=1; $x<=28; $x++) {
  echo "<option value=",$daytime=$x,">
						",$x,"</option>
						";
} 
?>
					</select><br><br>
					<input type="submit" name="mode" value="计划任务配置提交">
				</form><a style="text-decoration:none;" href="midware/cron.php?task=<?php echo $_POST["taskname"] ?>job.json"><button id='btn1'>保存</button> </a>
			</div>
			<div class="colorful-tab-content" id="bg-3">
         <div class="progressbar" data-perc="100">
					<br/><br/>
					<font color="gray" id="point">系统已经准备好开始采集，选择配置，点击开始采集进行采集</font>
					<font color="gray" id="point2"></font>
					<div class="bar">
						<span></span>
					</div>
					<div class="label">
						<span></span>
					</div>
           <center>
                      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        					<select name="data_fetch" id="data_fetch" style="width:200px" >
                  <?php 
					readjs();
					?></select>
                      <button id='btn1'>保存</button>
                      
                      
                     </form> </center>  
           <center> 
           <a style="text-decoration:none;" href="midware/cron.php?storge=<?php echo $_POST["data_fetch"] ?>"><button onclick="block();display(<?php $t=60;echo $t; ?>);" id='btn1'>开始采集</button></a>
           <a href="logsys/log.php" target="zachrun"><button id='btn2'>返回首页</button></a> </center> 
           </div>
                                                                                                  
                      
				<br>
				<br>
				<center>
				<iframe name="zachrun" src='logsys/log.php' frameborder="0" marginwidth="1" marginheight="1" width="800" scrolling="yes" height="800">
				</iframe>
				<br>
				</center>
			</div>
		</div>
	</div>
</div>
</body>
</html>

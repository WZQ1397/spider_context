<style type="text/css">
a:link {color: #FFCCFF} /* 未访问的链接 */
a:visited {color: #990099} /* 已访问的链接 */
a:hover {color: #FFCC99} /* 鼠标移动到链接上 */
a:active {color: #6699CC} /* 选定的链接 */
</style>
<link rel="stylesheet" href="../css/rank.css"/>
<ul>
<?php
$d = dir($_SERVER['DOCUMENT_ROOT']."/dev/spider_context/spiderdata/log");

#echo "Handle: " . $d->handle . "<br>";
#echo "Path: " . $d->path . "<br>";

while (($file = $d->read()) !== false){
  if(preg_match('/.lst/',$file)){
      echo "<li><a href=\"detaillog.php?title=".$file."\">".$file."</a></li>";
  }
  if(preg_match('/.log/',$file)){
      echo "<li><a href=\"detaillog.php?title=".$file."\">".$file."</a></li>";
  }
}
$d->close();
?>
<ul>
  <script src="../js/jquery.min.js"></script>
<script>
	var color = ['#ffcc66' , '#ffcccc' , '#cccc33' , '#cccccc' , '#999933' , '#9999cc' , '#663333' , '#6666cc' , '#FF6A6A' , '#009966'];
	var initList = [], domArr = [];
	$('li').each(function(a){
		$(this).css('background' , color[a]);
		$(this).attr('title' , '原位置为：'+(a+1));
		initList[a] = $(this).html();
	})
</script>
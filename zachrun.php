<?php
#$argv_url=(string)$_GET['target'];
$argv_config=(string)$_GET['storge'];
#header("Content-type: text/html; charset=utf-8");
$output = exec("python3.4 test.py $argv_config");
$pieces = explode(",", str_replace(']','',str_replace('[','',$output)));
echo $pieces[0],$pieces[1];
?>
<input type="submit" name="mode" value=<?php echo $t ?>>

<?php
#header("Content-type: text/html; charset=utf-8");
$output = exec("python test.py 10 20");
$pieces = explode(",", str_replace(']','',str_replace('[','',$output)));
echo $pieces[1];
?>
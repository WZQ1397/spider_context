<?php
// 定义变量并默认设置为空值
$nameErr = $header = $name = "";
$websiteErr = $website = "";
$key1 = $key2 = $key3 = "";
$chk_methodErr = $chk_method = "";
$file_perfixErr = $file_perfix = "";
$lst_tagErr = $lst_tag = "";
$lst_specErr = $lst_spec = "";
$article_tagErr = $article_tag = "";
$article_specErr = $article_spec = "";
$conn_nameErr = "";
$dbname = $dbnameErr = $db_address = $db_addressErr = "";
$username = $usernameErr = $password = $passwordErr = "";
$port = $portErr = "";
$taskname = $tasknameErr = "";
$sel_time = $hour = $min = $second = "";
$array1 = $filearray = $forarray = $forarray2 = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["mode"] == "采集配置提交") {
        $filearray = array("name", "header", "website", "key1", "key2", "key3", "chk_method", "file_perfix", "lst_tag", "lst_spec", "article_tag", "article_spec");
        $array1 = array("name");
        $forarray = array("key1", "key2", "key3");
        $forarray2 = array("header", "chk_method", "file_perfix", "lst_tag", "lst_spec", "article_tag", "article_spec");
    }
    if ($_POST["mode"] == "数据库配置提交") {
        $filearray = array("conn_name", "dbname", "db_address", "username", "password", "port");
        $array1 = array("conn_name", "dbname", "username");
        $forarray2 = array("password");
    }
    if ($_POST["mode"] == "计划任务配置提交") {
        $filearray = array("taskname", "data_fetch", "sel_time", "hour", "min", "week", "daytime", "monthtime");
        $forarray = array("sel_time", "data_fetch", "hour", "min", "week", "daytime", "monthtime");
        $array1 = array("taskname");
        $cfg = $taskname;
    }
    foreach ($array1 as $v) {
        ${$verr} = $v . "Err";
        if (empty($_POST[$v])) {
            ${$verr} = "名字是必需的";
        } else {
            ${$v} = test_input($_POST[$v]);
            // 检测名字是否只包含字母跟下划线
            if (!preg_match("/^[a-zA-Z_]*\$/", ${$v})) {
                ${$verr} = "只允许字母和下划线";
            }
        }
    }
    if (empty($_POST["website"])) {
        $website = "地址是必须的";
    } else {
        $website = test_input($_POST["website"]);
        // 检测 website 地址是否合法
        if (!preg_match("/\\b(?:(?:https?|ftp):\\/\\/|www\\.)[-a-z0-9+&@#\\/%?=~_|!:,.;]*[-a-z0-9+&@#\\/%=~_|]/i", $website)) {
            $websiteErr = "非法的 website 的地址";
        }
    }
    if (empty($_POST["db_address"])) {
        $website = "地址是必须的";
    } else {
        $db_address = test_input($_POST["db_address"]);
        // 检测 数据库地址是否合法
        if (!filter_var($db_address, FILTER_VALIDATE_IP)) {
            $db_addressErr = "非法的 database 的地址";
        }
    }
    if (empty($_POST["port"])) {
        $port = 3306;
    } else {
        $port = test_input($_POST["port"]);
        // 检测端口是否合法
        if (!preg_match("/^[0-9]{1,5}/", $port)) {
            $portErr = "非法的端口";
        }
    }
    foreach ($forarray as $v) {
        ${$v} = test_input($_POST[$v]);
    }
    foreach ($forarray2 as $v) {
        if (empty($_POST[$v])) {
            ${$v} = $v . "是必须的";
        } else {
            ${$v} = test_input($_POST[$v]);
            if (!preg_match("/^[a-zA-Z0-9_.-]*\$/", $v)) {
                $v = $v . "Err";
                ${$v} = "只允许字母,数字和空格（_.-#@）";
            }
        }
    }
}
$password = test_input($_POST["password"]);
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = str_replace("&quot;","",$data);
    return $data;
}
if ($_POST["mode"] == "采集配置提交") {
    $cfg = $name . "config";
}
if ($_POST["mode"] == "数据库配置提交") {
    $cfg = $conn_name . "database";
}
if ($_POST["mode"] == "计划任务配置提交") {
    $cfg = $taskname . "job";
    include "cron.php";
}
$myfile = fopen("config/" . $cfg . ".json", "w") or die("Unable to open file!");
$c = 0;
foreach ($filearray as $v) {
    if ($c == 0) {
        fwrite($myfile, "{\"{$v}\":\"" . ${$v} . "\",");
    } else {
        if ($c == count($filearray) - 1) {
            fwrite($myfile, "\"{$v}\":\"" . ${$v} . "\"}");
        } else {
            fwrite($myfile, "\"{$v}\":\"" . ${$v} . "\",");
        }
    }
    $c = $c + 1;
}
?>
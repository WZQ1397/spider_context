<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       <title>采集系统日志</title>
        <link rel="stylesheet" type="text/css" href="../css/splitpage.css" />
        <style type="text/css">
            .demo{width:80%;margin:50px auto 10px auto;padding:10px;}
            .demo p{line-height:30px;text-indent:2em}
            .demo h3{font-size:24px;text-align:center;padding:10px}
            @media (max-width: 480px){
                .demo{width:360px;margin:50px auto 10px auto;padding:10px;}
                .demo img{width:90%}
                .demo h3{font-size:1.5em;line-height:1.9em}
            }
            .pages{text-align:center;border-top:1px solid #d3d3d3;margin-top:10px; padding-top:10px}
            .pages a{display:inline-block;margin:4px;padding:4px 8px;background:#f9f9f9;border:1px solid #d9d9d9}
            .pages a.cur{cursor:default;background:#d3d3d3;color:#434343}
            .pages a.cur:hover{text-decoration:none}
        </style>
    </head>
    <body>
        <div class="head">
            <script src="/daima/header.js"></script>
        </div>
        <div class="container">
            <div class="demo">
                <?php
                include('page.class.php');
                //自定义的长文章字符串，可以包含 html 代码，若字符串中有手动分页符 {nextpage} 则优先按手动分页符进行分页    
                
#$title=(string)$_GET['title'];
              $title='lym2018-03-25.log';
$file_path = $_SERVER['DOCUMENT_ROOT']."/dev/spider_context/spiderdata/log/".$title;
$content = file_get_contents($file_path);
                $ipage = isset($_GET["ipage"]) ? intval($_GET["ipage"]) : 1;
                $CP = new cutpage($content);
                $page = $CP->cut_str();
                echo $page[$ipage - 1];
                echo '<br><br><div class="pages">' . $CP->pagenav() . '</div>';
                ?>
            </div>
        </div>
        <div class="foot">
            <script src="/daima/footer.js"></script>
        </div>

    </body>
</html>
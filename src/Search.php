<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <link href="./Home.css" rel="stylesheet" type="text/css">
    <title>搜索页</title>
</head>
<body>
<header>
    <nav>
        <a id ="t1" href="./Home.php">首页</a>
        <a href="./Browser.php">浏览页</a>
        <a href="./Search.php"><mark>搜索页</mark></a>
        <div class="dorp" id="rig">

            <?php
            session_start();
            if (!isset($_SESSION['Username'])){
                echo unlog();
            }else if(isset($_SESSION['Username'])){
                echo  login();
            }
            ?>

            <?php
            function unlog()
            {
                return "
     <div>  <a href=\"./index.php\" >登录</a></div>
    ";
            }
            ?>
            <?php

            function login(){

                return "
       <div >个人中心</div>
    <div   class=\"dorp_con\">
            <p><a id=\"a1\" href=\"upload.php\">上传</a></p>
                <p><a id =\"a2\" href=\"my_photo.php\">我的照片</a></p>
                <p><a href=\"favor.php\">我的收藏</a></p>
                <p><a id=\"a4\" href=\"./layout.php\">登出</a></p>
        </div>
    ";
            }

            ?>

        </div><!--导航栏部分-->
    </nav>
</header>
<form  method="POST" action="" >

        <input type="radio" name="question" value="title" checked="checked" ><!--文本框输入并设置默认-->
    标题筛选<br/>
    <label>
        <input type="text" name="title1" class="rig2"><!--文本框输入但不设置默认-->
    </label><br/>

        <input type="radio" name="question" value="describe" >
    描述筛选<br/>
    <label>
        <input type="text" name="des" class="rig1">
    </label><br/>
    <button id="b1"  name="search"  value="搜索" type = "submit"  style="height: 30px;width: 50px" " >搜索</button >
</form>
<script>

</script>
<div class="divcss5" style="margin-left: 100px">
<h3>
    <?php

    if (isset($_POST['search'])&&$_POST['question']=="title") {
        $t = $_POST["title1"];
        if(empty($t)){
            echo "请输入要查询的内容";
        }else {
            define('DBNAME', 'travel2');
            define('DBUSER', '代乾');
            define('DBPASS', 'Dai05043159');
            define('DBCONNSTRING','mysql:dbname=travel2;charset=utf8mb4;');
            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql5 = "select * from travelimage where Title like '%$t%'";
            $result = $pdo->query($sql5);
            echo '<h3>搜索结果</h3>';

                outputSinglePainting($sql5);

        }
    }else if (isset($_POST['search'])&&$_POST['question']=="describe") {
        if (isset($_POST['search'])) {
            $t3 = $_POST["des"];
            if (empty($t3)) {
                echo "请输入要查询的内容";
            } else {
                define('DBNAME', 'travel2');
                define('DBUSER', '代乾');
                define('DBPASS', 'Dai05043159');
                define('DBCONNSTRING','mysql:dbname=travel2;charset=utf8mb4;');
                $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql5 = "select * from travelimage where Description like '%$t3%'";
                $result = $pdo->query($sql5);
                echo '<h3>搜索结果</h3>';
                    outputSinglePainting($sql5);

            }
        }
    }
    ?></h3>
</div>
<script>
</script>
<?php
function  outputSinglePainting($sql)
{
    include("page.class.php");
    $impeach_host = 'localhost';
    $impeach_usr = '代乾';
    $impeach_passwd = 'Dai05043159';
    $impeach_name = 'travel2';$con = mysqli_connect("localhost", "代乾", "Dai05043159", "travel2");
    $impeach_con = mysqli_connect($impeach_host, $impeach_usr, $impeach_passwd) or
    die("Can't connect " . mysqli_error($con));

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    mysqli_select_db($impeach_con, $impeach_name);
    $page = new pager($sql, 4);
    $result = mysqli_query($con, $page->sqlquery());
    $result4 = $pdo->query($page->sqlquery());
    while ($info = $result4->fetch()) {
        echo '<form action="./Detail.php\""  method="POST">';
        echo '<div  class="divcss5">';
        echo '<button type="submit" value= ' . $info["ImageID"] . ' name="img"><img  src="../travel-images/travel-images/square-medium/' . $info['PATH'] . '" alt="图片" /></button>';
        echo '<div class="right">';
        echo ' <h3><a href="#">';
        echo $info["Title"];
        echo '</a></h3><!--标题-->';
        echo '<div>';
        echo $info['Description'];
        echo '</div>
    </div><!--简介内容-->';
        echo '</div>';
    }
    echo $page->set_page_info();
}
?>






          <!--  " <a href=$url?page=" . ($pageval - 1) . ">上一页</a> <a href=$url?page=" . ($pageval + 1) . ">下一页</a>";-->








<footer>
    <p>Posted by:19302010047</p>
    <p> Contact imformation :<a href="mailto:19302010047@fudan.edu.cn">19302010047@fudan.edu.cn</a>.</p>
    <P>备案号：沪19302010047</P>
</footer>
</body>
</html>
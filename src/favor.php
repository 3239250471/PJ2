<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./Home.css" rel="stylesheet" type="text/css"><title>
    收藏
</title>
</head>
<body>
<header>
    <nav>
        <a href="./Home.php">首页</a>
        <a href="./Browser.php">浏览页</a>
        <a href="./Search.php">搜索页</a>
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

        </div>
    </nav>
</header><h3>My favorite</h3>
<?php
$fa=false;
if (isset($_SESSION['Username'])) {

    define('DBNAME', 'travel2');
    define('DBUSER', '代乾');
    define('DBPASS', 'Dai05043159');
    define('DBCONNSTRING', 'mysql:dbname=travel2;charset=utf8mb4;');
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $uname1 = $_SESSION['Username'];
    $sql1 = "select * from  traveluser  WHERE UserName ='$uname1'";
    $result1 = $pdo->query($sql1);
    while ($re = $result1->fetch()) {
        $uid = $re['UID'];
    }
    $sql3 = "select * from  travelimagefavor  WHERE UID='$uid'";
    $result3 = $pdo->query($sql3);
    while ($re2 = $result3->fetch()) {
        $id0 = $re2['ImageID'];
        $sql8 = "select * from  travelimage WHERE  ImageID='$id0'";
        $result8 = $pdo->query($sql8);
        while ($re3 = $result8->fetch()) {


$fa=true;

        }
    }  output($sql3);
}
if (!$fa){
    echo '<h3>您还没有收藏照片呦~</h3>';
}
?>
<?php
function output($sql){
       include("./page.class.php");
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
       $id0=$info['FavorID'];
        $id=$info['ImageID'];
        $sql3 = "select * from  travelimage  WHERE ImageID= '$id'";
        $result3 = $pdo->query($sql3);
        while ($info1 = $result3->fetch()) {
            echo '<form action="./Detail.php\""  method="POST">' ;
            echo  '<div  class="divcss5">' ;
            echo '<button type="submit" value= '.$info1["ImageID"].' name="img"><img  src="../travel-images/travel-images/square-medium/' .$info1['PATH'] .'" alt="图片" /></button>';

            echo '<div class="right">' ;
            echo ' <h3><a href="#">';
            echo $info1["Title"];
            echo '</a></h3><!--标题-->' ;
            echo '<div>';
            echo $info1['Description'];
            echo '</div>';


            echo '
    <!--简介内容-->
    </form></div>' ;
            echo '<form action=""  method="POST"><button type="submit" class="btn btn-danger" name="de" value= '  .$id0.' style="width: 60px;height: 30px" >删除</button>';
            echo ' </form></div>';
        }

    }
    echo $page->set_page_info();
}
?>
<?php
if (isset($_POST['de'])){
    $fav=$_POST['de'];
    $con=mysqli_connect("localhost","代乾","Dai05043159","travel2");
    mysqli_query($con,"DELETE FROM travelimagefavor WHERE FavorID ='$fav'");
    mysqli_close($con);

}
?>


</body>
<footer><br>
    <p>备案号：沪123345@19302010047</p>
    <p> Contact imformation :<a href="mailto:19302010047@fudan.edu.cn">19302010047@fudan.edu.cn</a>.</p>
</footer>
</html>
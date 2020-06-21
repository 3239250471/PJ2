<!DOCTYPE HTML>

<head>
    <meta charset="UTF-8">
    <link href="./Home.css" rel="stylesheet" type="text/css"><title>
    首页
</title>
<script type="text/javascript" src="./vue.js"></script>

    <script>
        <!--拖动滚动条或滚动鼠标轮;-->
        window.onscroll=function(){
            if(document.body.scrollTop||document.documentElement.scrollTop>0){
                document.getElementById('rTop').style.display="block"
            }else{
                document.getElementById('rTop').style.display="none"
            }
        };
        <!--点击“回到顶部”按钮-->
        function toTop(){
            window.scrollTo('0','0');
            document.getElementById('rTop').style.display="none"
        }

    </script>
</head>
<form>
<header>

        <nav>
    <a id="1" v-bind:href="url"><mark>首页</mark></a>
    <a  id="2" href="./Browser.php">浏览页</a>
    <a id="3"  href="./Search.php">搜索页</a>
    <div  id="4" class="dorp" id="rig">
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

        <!--导航栏内容-->
    </div>
</nav>
</header>
</form>
<script>
    let vm = new Vue({
        el: '#1',
        data: () => ({
            message: '首页',
            url: './Home.php',
        }),
    })
</script>
 <?php
 define('DBNAME', 'travel2');
 define('DBUSER', '代乾');
 define('DBPASS', 'Dai05043159');
 define('DBCONNSTRING','mysql:dbname=travel2;charset=utf8mb4;');
 $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 echo '<div class="home1">';
 $sql3= "SELECT * FROM travelimage ORDER BY  RAND() LIMIT 1" ;
 $result9 = $pdo->query($sql3);
 while ($row1 = $result9->fetch()) {
 echo '<form action="./Detail.php\""  method="POST">' ;
       echo '<button type="submit" class="img1" value= '.$row1['ImageID'].' name="img" style="width: 800px ;height: 800px"><img  src="../travel-images/travel-images/square-medium/'.$row1['PATH'].'" alt="图片" style="height: 800px;width: 800px" /></button>
    </div></form>';
}
    ?>
    <div id="im">
<?php
try {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select ImageID,count(*) time from travelimagefavor  group by ImageID order by time desc ,ImageID";
    $result = $pdo->query($sql);
    while ($row = $result->fetch()) {
        $ID=$row['ImageID'];
        $sql2 = "select * from travelimage  WHERE ImageID=$ID";
        $result3 = $pdo->query($sql2);
        $row2 = $result3->fetch();
         outPuting($row2);

        break;
    }
  $sql3= "SELECT * FROM travelimage ORDER BY  RAND() LIMIT 5" ;
    $result3 = $pdo->query($sql3);
    while ($row1 = $result3->fetch()) {
        outPuting($row1);
    }
    $pdo = null;
}catch (PDOException $e) {
    die( $e->getMessage() );
}
function myFunction()
        {


            $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql4= "SELECT * FROM travelimage ORDER BY  RAND() LIMIT 6" ;
            $result4 = $pdo->query($sql4);
            while ($row1 = $result4->fetch()) {
                outPuting($row1);
            }



        }
?>

<?php
function outPuting($row){
  echo '<form action="./Detail.php\""  method="POST">' ;
echo  '<div  class="divcss5">' ;
   echo '<button type="submit" value= '.$row["ImageID"].' name="img"><img  src="../travel-images/travel-images/square-medium/' .$row['PATH'] .'" alt="图片" /></button>';

  echo '<div class="right">' ;
     echo ' <h3><a href="#">';
 echo $row["Title"];
    echo '</a></h3><!--标题-->' ;
      echo '<div>';
echo $row['Description'];
echo '</div>
    </div><!--简介内容-->' ;
echo '</div>';}
?>


</div>
    <script>
    function a()
    {
        location.reload();
    }</script>
    <?php
    function b()
    {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql4 = "SELECT * FROM travelimage ORDER BY  RAND() LIMIT 6";
        $result4 = $pdo->query($sql4);
        while ($row1 = $result4->fetch()) {
            outPuting($row1);
        }
    }
    ?>



<div class="refresh" onclick="a()">refresh</div>
<div class="rTop" id="rTop" onClick="toTop()">返回顶部</div>

<footer><br>
    <div class="footword"><p>备案号：沪123345@19302010047</p>
        <p> Contact imformation :<a href="mailto:19302010047@fudan.edu.cn">19302010047@fudan.edu.cn</a>.</p></div>
    <img src="../img/footer.jpg" class="footimg" alt="页脚"><!--插入一张页脚图片-->
</footer>
</body>
</html>
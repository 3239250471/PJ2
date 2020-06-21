


<head>
    <meta charset="UTF-8">
    <link href="../Home.css" rel="stylesheet" type="text/css">
    <title>
    详情页
</title>
</head>
<body>
<header>
    <nav>
        <a href="../Home.php">首页</a>
        <a href="../Browser.php">浏览页</a>
        <a href="../Search.php">搜索页</a>
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
     <div>  <a href=\"../index.php\" >登录</a></div>
    ";
            }
            ?>
            <?php

            function login(){

                return "
       <div >个人中心</div>
    <div   class=\"dorp_con\">
            <p><a id=\"a1\" href=\"../upload.php\">上传</a></p>
                <p><a id =\"a2\" href=\"../my_photo.php\">我的照片</a></p>
                <p><a href=\"../favor.php\">我的收藏</a></p>
                <p><a id=\"a4\" href=\"../layout.php\">登出</a></p>
        </div>
    ";
            }

            ?>

        </div>
    </nav>
</header>
<div>
    <?php
    $id2=$_POST['img'];

    $id=$id2;
    define('DBNAME', 'travel2');
    define('DBUSER', '代乾');
    define('DBPASS', 'Dai05043159');
    define('DBCONNSTRING','mysql:dbname=travel2;charset=utf8mb4;');
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql4 = "SELECT * FROM travelimage WHERE ImageID= $id";
        $result4 = $pdo->query($sql4);
        while ($row1 = $result4->fetch()) {
            echo '<h3 class="h3">图片详情</h3>';
            echo '<div class="whole">';
            echo '<div class="Det">';
            echo '<h3 class="title">' . $row1['Title'] . '</h3></div>';
            echo ' <div class="img5">';
            echo '<a ><img src="http://localhost/travel-images/travel-images/square-medium/' . $row1['PATH'] . '" class="detailimg" height="400px" width="400px" alt="图片"/></a>';
            echo '<div class="like1">
    <table border="1" class="like">
        <tr> <td class="word"><mark>Like number</mark></td>
        </tr>';
            $time = 0;
            $sql = "select ImageID,count(*) time from travelimagefavor  group by ImageID order by time desc ";
            $result9 = $pdo->query($sql);
            while ($re = $result9->fetch()) {
                if ($re['ImageID'] == $id) {
                    $time = $re['time'];
                }
            }

            $city = $row1['CityCode'];
            $sql = "select * from  geocities  WHERE GeoNameID=$city";
            $result10 = $pdo->query($sql);
            while ($re = $result10->fetch()) {
                $city1 = $re['AsciiName'];
            }
            $cou = $row1['Country_RegionCodeISO'];
            $sql9 = "select * from geocountries_regions  WHERE ISO='$cou'";
            $result11 = $pdo->query($sql9);
            while ($re1 = $result11->fetch()) {
                $cou1 = $re1['Country_RegionName'];
            }
            echo ' <tr>
            <td class="num">';
            echo $time;
            echo '</td>
        </tr>';
            echo '</table>
    <table border="1" class="detail">
        <tr><td class="word"><mark>图片详情
        <tr>
            <td>Content: ' . $row1['Content'] . '</td></tr>
        <tr>  <td>Country:';
            echo $cou1;
            echo '</td></tr>
        <tr>   <td>City:';
            echo $city1;
            echo '</td></tr>
    </table>';

   echo ' <form  method="POST" action="" >
 <input name="img" type="hidden" value="';
   echo $id;
   echo ' ">';
  echo ' <button type="submit" " id="favor" class="like2" onclick="f1()"  ';
            if (isset($_SESSION['Username'])) {
                $uname = $_SESSION['Username'];
                $sql1 = "select * from  traveluser  WHERE UserName ='$uname'";
                $result1 = $pdo->query($sql1);
                while ($re = $result1->fetch()) {
                    $uid = $re['UID'];
                }
                $sql0 = "select * from   travelimagefavor WHERE ImageID ='$id'";
                $result0 = $pdo->query($sql0);
                $i4 = 0;
                $res = false;
                while ($re = $result0->fetch()) {
                    if ($uid == $re['UID']) {
                        $res = true;
                    }
                }
                echo '"name="ok" />';
                if ($res) {
                    echo '已收藏';
                } else {
                    echo '收藏';
                }
                echo
                    '</button></form>
               </div></div>
         <div class="Detail">';
                    echo $row1['Description'];
                    echo '</div>
          </div>';
                } else{
                echo '   )>请先登录';
            echo '</div></div>';
        echo '<div class="Detail">';
                echo $row1['Description'];
                echo ' </div>';

        }

}
    ?>
    <h3>
       <script>

               function f1()
                {
                    <?php
                        $cli=true;
                    ?>

                   <?php
                if (isset($_SESSION['Username'])&&$cli) {
                    if (!$res) {
                        $sql = "INSERT INTO travel2.travelimagefavor(UID,ImageID) VALUES(?,?)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindValue(1, $uid);//绑定参数
                        $stmt->bindValue(2, $id);
                        $count = $stmt->execute();//执行预处理语句
                        if ($count <> 0) {
                            echo "alert('收藏成功');";



                        } else {
                            echo "<script type='text/javascript'>alert('失败'); </script>";
                        }
                    }
                }else{
                echo "alert('收藏成功2');";}
                    ?>
           }
        </script>
    </h3>
<footer>
    <p>Posted by:19302010047</p>
    <p> Contact imformation :<a href="mailto:19302010047@fudan.edu.cn">19302010047@fudan.edu.cn</a>.</p>
    <P>备案号：沪19302010047</P>
</footer>
</body>
</html>
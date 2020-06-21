<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <link href="./Home.css" rel="stylesheet" type="text/css">
    <title>
    上传页
</title>
</head>
 
<body>
<script> function uploadImg(file,imgNum){
    var widthImg = 150; //显示图片的width
    var heightImg = 150; //显示图片的height
    var div = document.getElementById(imgNum);
    if (file.files && file.files[0]){
        div.innerHTML ='<img id="upImg"  >'; //生成图片
        var img = document.getElementById('upImg'); //获得用户上传的图片节点
        img.onload = function(){
            img.width = widthImg;
            img.height = heightImg;
        };
        var reader = new FileReader(); //判断图片是否加载完毕
        reader.onload = function(evt){
            if(reader.readyState === 2){ //加载完毕后赋值
                img.src = evt.target.result;
            }
        };
        reader.readAsDataURL(file.files[0]);
    }
}

</script>
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
        </div><!--导航栏内容-->
    </nav></header>
<form action="" method="post" enctype="multipart/form-data">
<div class="Right1" >
        <div id="preview" class="Right">
            <img src="../img/未上传.png" alt="" id="imghead5" height="150" width="200" />
        </div>
        <div class="yanziRight">

            <span class="dui" id="imgOrder_dui" ></span>
            <input type="file" name='evidence' onchange="uploadImg(this,'preview')" class="yanzRight" value="上传图片" required/>

            <!-- <input type="file" name="myFile"  accept="image/jpeg,image/gif,image/png"/><br /> -->


        </div>
        </div>
<div class="Right2">
    <p>
        图片标题：<br>
    </p>

    <label>
        <input type="text"  name="tit" required><!--设置文本框-->
    </label>
    <p>
    图片描述：<br>
</p><label>
    <input type="text" style="height: 100px;width: 500px"  name="des" required><!--设置文本框-->
</label>
    <p>
        拍摄国家：<br>
    </p>
    <label>
        <input type="text" name="cou"><!--设置文本框-->
    </label>
    <p>
        拍摄城市：<br>
    </p><label>
    <input type="text" name="city">
</label><br>
    <p>
        请选择主题 <br>
    </p>
    <select name="con">
                    <!--默认选中-->
                    <option selected value="Scenery">Scenery</option>
                    <option value="City">City</option>
                    <option value="People">People</option>
        <option value="Animal">Animal</option>
        <option value="Building">Building</option>
        <option value="Wonder">Wonder</option>
        <option value="Other">Other</option>
    </select>
    <input type="submit" value="上传文件"  name="sub"/><!--上传按钮并相应-->
</div>
</form>
<?php

if (isset($_POST['sub'])){
$imgname = $_FILES['evidence']['name'];

$tmp = $_FILES['evidence']['tmp_name'];

$filepath = '../travel-images/travel-images/square-medium/';
$city=$_POST['city'];
$cou=$_POST['cou'];
$des=$_POST['des'];
$tit=$_POST['tit'];
$con=$_POST['con'];
$path=$imgname.".jpg";
$_SESSION['id']=$_SESSION['id']+106;
if(move_uploaded_file($tmp,$filepath.$imgname.".jpg")){

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
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql2 = "select * from  geocountries_regions  WHERE Country_RegionName ='$cou'";
    $result2 = $pdo->query($sql2);
    while ($re = $result2->fetch()) {
        $couiso = $re['ISO'];
    }
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql2 = "select * from  geocities WHERE AsciiName ='$city'";
    $result2 = $pdo->query($sql2);
    while ($re = $result2->fetch()) {
        $citycode= $re['GeoNameID'];
    }
    $link = mysqli_connect("localhost", "代乾", "Dai05043159")

    or die("Could not connect : " . mysqli_error());

    mysqli_select_db($link,"travel2") or die("Could not select database");


    $queryCol = "select * from travelimage order by ImageID ";
    $result1 = mysqli_query($link,$queryCol) or die("Query failed : " . mysqli_error());

    $colleges = array();
    $num2=count($colleges);

    $i=$i+5;
    $conn = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql3 = "INSERT INTO travel2.travelimage(ImageID,Title,Description,CityCode,Country_RegionCodeISO,UID,PATH,Content)
                                       VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql3);
    $stmt->bindValue(1, $_SESSION['id']);
    $stmt->bindValue(2, $tit);//绑定参数
    $stmt->bindValue(3, $des);
    $stmt->bindValue(4, $citycode);
    $stmt->bindValue(5, $couiso);//绑定参数
    $stmt->bindValue(6, $uid);
    $stmt->bindValue(7, $path);
    $stmt->bindValue(8, $con);

    $count = $stmt->execute();//执行预处理语句
    if ($count <> 0) {
        echo "<script type='text/javascript'>alert('上传成功');location='./my_photo.php';</script>";
    } else {
        echo "<script type='text/javascript'>alert('上传失败');</script>";
    }
}else{

    echo "上传失败";

}
}
?>

</body>
<footer style="
     bottom: 0;
     width: 80%;
     height: 30px;/*脚部的高度*/
     left: 200px;
     clear:both;">
    <p>Posted by:19302010047</p>
    <p> Contact imformation :<a href="mailto:19302010047@fudan.edu.cn">19302010047@fudan.edu.cn</a>.</p>
    <P>备案号：沪19302010047</P>
</footer>
</html>
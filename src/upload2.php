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
<?php
if (isset($_POST['ch'])){
$id=$_POST['ch'];

define('DBNAME', 'travel2');
define('DBUSER', '代乾');
define('DBPASS', 'Dai05043159');
define('DBCONNSTRING', 'mysql:dbname=travel2;charset=utf8mb4;');
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$sqlm="select * from  travelimage  WHERE ImageID ='$id'";
$result3 = $pdo->query($sqlm);
while ($re = $result3->fetch()) {
$tit=$re['Title'];
    $des=$re['Description'];
    $citycode=$re['CityCode'];
    $couiso=$re['Country_RegionCodeISO'];
    $path=$re['PATH'];
    $con=$re['Content'];
}
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$sql2 = "select * from  geocountries_regions  WHERE ISO ='$couiso'";
$result2 = $pdo->query($sql2);
while ($re = $result2->fetch()) {
    $couname = $re['Country_RegionName'];
}
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$sql2 = "select * from  geocities WHERE GeoNameID ='$citycode'";
$result2 = $pdo->query($sql2);
while ($re = $result2->fetch()) {
    $cityname= $re['AsciiName'];
}}
?>
<form action="./upload3.php" method="post" enctype="multipart/form-data">
    <div class="Right1" ><input type="hidden" value="<?php echo $id?>" name='id1'>
        <input type="hidden" value="<?php echo $path?>" name='path1'>
        <div id="preview" class="Right">
            <img src="<?php  echo '../travel-images/travel-images/square-medium/' .$path .''?>" alt="" id="imghead5" height="150" width="200" />
        </div>
        <div class="yanziRight">

            <span class="dui" id="imgOrder_dui" ></span>
            <input type="file" name='evidence' onchange="uploadImg(this,'preview')" class="yanzRight" value="上传图片" />

            <!-- <input type="file" name="myFile"  accept="image/jpeg,image/gif,image/png"/><br /> -->


        </div>
    </div>
    <div class="Right2">
        <p>
            图片标题：<br>
        </p>

        <label>
            <input type="text"  name="tit"  value="<?php echo $tit?>" required><!--设置文本框-->
        </label>
        <p>
            图片描述：<br>
        </p><label>
            <input type="text" style="height: 100px;width: 500px"  name="des"value="<?php echo $des?>" required><!--设置文本框-->
        </label>
        <p>
            拍摄国家：<br>
        </p>
        <label>
            <input type="text" name="cou" value="<?php echo $couname?>"><!--设置文本框-->
        </label>
        <p>
            拍摄城市：<br>
        </p><label>
            <input type="text" name="city" value="<?php echo $cityname?>">
        </label><br>
        <p>
            请选择主题 <br>
        </p>
        <select name="con" value="<?php echo $con?>">
                        <!--默认选中-->
            <?php
            $aa=  array();
            $aa[0]="Scenery";
            $aa[1]="City";
            $aa[2]="People";
            $aa[3]="Animal";
            $aa[4]="Building";
            $aa[5]="Wonder";
            $aa[6]="Other";
            ?>
            <?php
            for($n=0;$n<count($aa);$n++)//循环定义词数组
            {
                if ($aa[$n]==$con){
                    echo '<option  value="';
                    echo $con;
                    echo '"  selected>';
                    echo $con;
                    echo '</option>';
                }else{

                        echo '<option  value="';
                        echo $aa[$n];
                        echo '"  >';
                        echo $aa[$n];
                        echo '</option>';

                }
            }
            ?>
                       
        </select>
        <input type="submit" value="修改"  name="sub"/><!--上传按钮并相应-->
    </div>
</form>


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
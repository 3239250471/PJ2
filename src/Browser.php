<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link href="./Home.css" rel="stylesheet" type="text/css"><title>
    浏览页
</title>
</head>

<header>
    <nav>
        <a id="t1" href="./Home.php">首页</a>
        <a href="./Browser.php"><mark>浏览页</mark></a>
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
</header>
<aside class="aside1">
    <form method="POST" action="">
    <p class="T1">标题浏览</p><label for="title"></label><input type="text" name="title" id="title" />
        <button  type = "submit" name="search"  >搜索</button>
    </form>

    <form method="POST" action="">
    <dl>


        <dt>热门国家快速浏览</dt>
        <?php
        define('DBNAME', 'travel2');
        define('DBUSER', '代乾');
        define('DBPASS', 'Dai05043159');
        define('DBCONNSTRING','mysql:dbname=travel2;charset=utf8mb4;');
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql5 ="select Country_RegionCodeISO,count(*) time from travelimage  group by Country_RegionCodeISO order by time desc ,Country_RegionCodeISO";

        $result = $pdo->query($sql5);$i=1;
        $i1=0;
        while ($row6 = $result->fetch()) {
            $id = $row6['Country_RegionCodeISO'];
            $sq = " select * from geocountries_regions WHERE ISO ='$id'";
            $result6 = $pdo->query($sq);

            while ($row2 = $result6->fetch()) {
                echo '<dd><button  name="search'.$i.'">';
                echo '<a name="f1" value=  >';
                echo $row2["Country_RegionName"];
                echo '</a>';
                echo '</button></dd>';
                $i++;
                if ($i>0){
                    break;
                }
            }
                $i1++;
                if ($i1>2){
                    break;
                }

        }

        ?>


        <dt>热门城市快速浏览</dt>
        <?php
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql7 ="select CityCode,count(*) time from travelimage  group by CityCode order by time desc ,CityCode";

        $result7 = $pdo->query($sql7);$i3=0;
        $i1=0;
        while ($row6 = $result7->fetch()) {
            $id = $row6['CityCode'];
            $sq = " select * from geocities WHERE GeoNameID ='$id'";
            $result6 = $pdo->query($sq);
            $i1++;
            while ($row2 = $result6->fetch()) {
                echo '<dd><button  name="search2'.$i1.'">';
                echo '<a name="f1" value=  >';
                echo $row2["AsciiName"];
                echo '</a>';
                echo '</button></dd>';


            }

            if ($i1>2){
                break;
            }

        }
        ?>


        <dt>热门内容快速浏览</dt>
        <?php

        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select Content,count(*) time from travelimage  group by Content order by time desc, Content";
        $result = $pdo->query($sql);
        $i=0;
        while ($row2 = $result->fetch()) {
            echo '<a name="2" ><dd><button  name="search4">';
            echo $row2["Content"];
            echo '</button></dd></a>';
            $i++;
            if ($i>0){
                break;
            }
        }
        ?>

    </dl>
    </form>
</aside>

    <form method="POST" action="">
    <label for="third"></label><select name="third">
    <option selected value="first">-- 请选择主题 --</option>
                <!--默认选中-->
                <option value="China">scenery</option>
                <option value="Japan">history</option>
                <option value="Italy">people</option>
</select>
    </form>
<input id="r" type="hidden">
<?php
$link = mysqli_connect("localhost", "代乾", "Dai05043159")

or die("Could not connect : " . mysqli_error());

mysqli_select_db($link,"travel2") or die("Could not select database");

//******************提取国家信息 ******************

$queryCol = "select * from geocountries_regions order by  Country_RegionName";



$result1 = mysqli_query($link,$queryCol) or die("Query failed : " . mysqli_error());

$colleges = array();

while( $row1 = mysqli_fetch_array($result1) )

{

    $colleges[] = $row1;

}

//print_r ($forum_data);

mysqli_free_result($result1);

//**************获取城市信息 **************

$queryMaj = "select * from geocities order by AsciiName";



if( !($result2 = mysqli_query($link,$queryMaj)) )

{

    die('Could not query t_city list');

}

$majors = array();

while( $row2 = mysqli_fetch_array($result2) )

{

    $majors[] = $row2;

}

mysqli_free_result($result2);

?>





     <form name="stu_add_form" method="post" >

     <select name="college" onChange='  changeCollege1( document.stu_add_form.college.options[document.stu_add_form.college.selectedIndex].value,this.value )' size="1" type="submit">

        <option selected>==请选择国家 ==</option>

        <?php

        $num = count($colleges);

        for($i=0;$i<$num;$i++)

        {

            ?>

            <option value="<?php echo $colleges[$i]['ISO'];?>"><?php echo $colleges[$i]['Country_RegionName'];?></option>

            <?php
        }
        ?>
    </select>
    <select name="city" id="major1" size="1">
        <option selected value="">==选择城市==</option>
    </select>
    <input type="button" class="btn btn-danger" value="搜索"  onclick="alert('已搜索')" />
</form>

<script language = "JavaScript">
    var majorCount;
    majorCount = <?php echo count($majors);?>;
    subcat2= new Array();
    <?php
    $num2=count($majors);
    ?>
    // 从 0开始取出上面 majors[]中存储的专业数据填充数组
    <?php
        for($j=0;$j<$num2;$j++)
        {
        ?>subcat2[<?echo $j;?>] = new Array("<?echo $majors[$j]['provinceId'];?>","<?echo $majors[$j]['cityName'];?>");
    <?php }?>

    function   changeCollege1(s)

    {
        {
            var majorCount;

            majorCount = <?php echo count($majors);?>;
            document.stu_add_form.major.length = 0;
            var id=s;
            var j;
            document.stu_add_form.major.options[0] = new Option('==选择城市==','');
            for (j=0;j < majorCount; j++)
            {
                if (subcat2[j][1] === id)
                {
                    document.stu_add_form.major.options[document.stu_add_form.major.length] = new Option(subcat2[j][2], subcat2[j][0]);
                }
            }
        }










    }</script>



<form name="cou1" method="post" >

    <select name="cou"  size="1" >

        <option selected>==请选择国家 ==</option>

        <?php

        $num = count($colleges);

        for($i=0;$i<$num;$i++)

        {

            ?>

            <option value="<?php echo $colleges[$i]['ISO'];?>"><?php echo $colleges[$i]['Country_RegionName'];?></option>

            <?php
        }
        ?>
    </select>
    <input type="text" name="city">
    <button   name="third" style="width: 50px;height: 25px" >  搜索</button>
</form>
<?php
if (isset($_POST['third'])){
    $iso1=$_POST['cou'];
    $city1=$_POST['city'];
    $sq = " select * from geocities WHERE AsciiName = '$city1'";
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result2 = $pdo->query($sq);
    while ($row = $result2->fetch()) {
        $ID1 = $row['GeoNameID'];

    }
    $sql9="select * from travelimage WHERE Country_RegionCodeISO= '$iso1' and CityCode='$ID1'";
    $result3 = $pdo->query($sql9);
    outputSinglePainting($sql9);
}
?>
<div><!--插入多张图片-->
    <?php
    function outputSinglePainting($sql){
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
        echo '<form action="./Detail.php\""  method="POST"  >' ;
        echo '<button type="submit" class="img1" value= '.$info['ImageID'].' name="img" style="width: 150px ;height: 150px"><img  src="../travel-images/travel-images/square-medium/'.$info['PATH'].'" alt="图片" style="height: 150px;width: 150px" /></button>
    </div></form>';
    }
    echo $page->set_page_info();
    }
    ?>
</div>
<?php

if (isset($_POST['search1'])) {
    $t2 = "Italy";
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq = " select * from geocountries_regions WHERE Country_RegionName = '$t2'";
    $result2 = $pdo->query($sq);
    while ($row = $result2->fetch()) {
        $ID = $row['ISO'];
        $sql21 = "select * from travelimage  WHERE Country_RegionCodeISO ='$ID'";
        $result3 = $pdo->query($sql21);

    }outputSinglePainting($sql21);
}
?>
<?php
if (isset($_POST['search2'])) {
$pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sq = " select * from geocountries_regions WHERE Country_RegionName = 'Canada'";
$result22 = $pdo->query($sq);
while ($row = $result22->fetch()) {
$ID = $row['ISO'];
$sql22 = "select * from travelimage  WHERE Country_RegionCodeISO ='$ID'";
$result3 = $pdo->query($sql22);


}outputSinglePainting($sql22);
}
?>
<?php
if (isset($_POST['search4'])) {
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql23 = "select * from travelimage  WHERE Content ='scenery'";
            outputSinglePainting($sql23);


}
?>
<?php
if (isset($_POST['search3'])) {

    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq = " select * from geocountries_regions WHERE Country_RegionName = 'United Kingdom'";
    $result2 = $pdo->query($sq);
    while ($row = $result2->fetch()) {
        $ID = $row['ISO'];
        $sql24 = "select * from travelimage  WHERE Country_RegionCodeISO ='$ID'";




    } outputSinglePainting($sql24);
}
?>
<?php
if (isset($_POST['search21'])) {
    $t2 = "Firenze";
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq = " select * from geocities WHERE AsciiName = '$t2'";
    $result2 = $pdo->query($sq);
    while ($row = $result2->fetch()) {
        $ID = $row['GeoNameID'];
        $sql25 = "select * from travelimage  WHERE CityCode ='$ID'";
        $result3 = $pdo->query($sql25);


            outputSinglePainting($sql25);

    }
}
?>
<?php
if (isset($_POST['search23'])) {
    $t2 = "Roma";
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sq = " select * from geocities WHERE AsciiName = '$t2'";
    $result2 = $pdo->query($sq);
    while ($row = $result2->fetch()) {
        $ID = $row['GeoNameID'];
        $sql26 = "select * from travelimage  WHERE CityCode ='$ID'";
        $result3 = $pdo->query($sql26);



    } outputSinglePainting($sql26);
}
?>
<?php

if (isset($_POST['search'])) {
    $t2 = $_POST["title"];
    if(empty($t2)){
        echo "请输入要查询的内容";
    }else {

        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql5 = "select * from travelimage where Title like '%$t2%'";
        $result = $pdo->query($sql5);

            outputSinglePainting($sql5);

    }
}
?>



<footer>
    <p> Contact imformation :<a href="mailto:19302010047@fudan.edu.cn">19302010047@fudan.edu.cn</a>.</p>
    <div class="footword"><p>备案号：沪123345@19302010047</p>
</footer>
</body>
</html>
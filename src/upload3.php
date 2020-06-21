<?php
if (isset($_POST['sub'])){
    $id=$_POST['id1'];
    $city=$_POST['city'];
    $cou=$_POST['cou'];
    $des=$_POST['des'];
    $tit=$_POST['tit'];
    $con=$_POST['con'];
    $path=$_POST['path1'];
    $imgname = $_FILES['evidence']['name'];
    if ($imgname==!''){
        $tmp = $_FILES['evidence']['tmp_name'];
        $filepath = '../travel-images/travel-images/square-medium/';
        $path=$imgname.".jpg";
        move_uploaded_file($tmp,$filepath.$imgname.".jpg");
    }


    define('DBNAME', 'travel2');
    define('DBUSER', '代乾');
    define('DBPASS', 'Dai05043159');
    define('DBCONNSTRING', 'mysql:dbname=travel2;charset=utf8mb4;');
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

    $sql8="UPDATE `travelimage` SET `Title` = '$tit', `Description` = '$des', `CityCode` = '$citycode', `Country_RegionCodeISO` = '$couiso', `PATH` = '$path',`Content`=' $con' WHERE `travelimage`.`ImageID` = '$id'";
    $result8 = $pdo->query($sql8);
    while ($re = $result8->fetch()) {
        echo "<script type='text/javascript'>alert('上传成功');location='./my_photo.php';</script>";
    }


}

?>
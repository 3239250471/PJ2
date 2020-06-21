<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <link href="../src/login.css" rel="stylesheet" type="text/css">
    <title>
    登录
</title>
</head>
<body>
<img class="logo" src="../img/logo.jpg"  alt="logo"/><!--加入一张图片-->
<br>
<h>Sign in for Fisher </h>
<form action='' method='post' role='form'>
    <div class ='form-group'>
        <label for='username'>Username</label>
        <input type='text' name='username' class='form-control'/>
    </div>
    <div class ='form-group'>
        <label for='pword'>Password</label>
        <input type='password' name='pword' class='form-control'/>
    </div>
    <input type='submit'  class='form-control' name="bu" />

</form><P>没有账号？<a href="../src/register.php">点击注册</a> </P><!--注册页面的链接-->
</body>
<?php
   session_start();
   $_SESSION["loggedIn"] =false ;
   if (isset($_POST['bu'])){
    define('DBNAME', 'travel2');
    define('DBUSER', '代乾');
    define('DBPASS', 'Dai05043159');
    define('DBCONNSTRING', 'mysql:dbname=travel2;charset=utf8mb4;');
    $us = false;
    $us1=$_POST['username'];
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //very simple (and insecure) check of valid credentials.
    $sql = "SELECT * FROM traveluser WHERE UserName= '$us1'";
    $result3 = $pdo->query($sql);
    if ( $row=$result3->fetch()) {
        $us = true;
        $pass1= $row['Pass'];
    }
    if ($us) {
        $p1 = $_POST['pword'];

        if (password_verify( $p1, $pass1)) {
            $_SESSION["loggedIn"]=true;
        }else{ $_SESSION["loggedIn"]=false;}
    }else{
        $_SESSION["loggedIn"]=false;

}}
?>
<?php




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_SESSION["loggedIn"]){
        echo "Welcome ".$_POST['username'];
        // add 1 day to the current time for expiry time
        $expiryTime = time()+60*60*24;
        $_SESSION['Username']=$_POST['username'];
        $loggedIn=true;
        header('location:./home.php');

    }
    else{
        echo "login unsuccessful";

    }
}




?>
<footer>
    Copyright@Fudan web fundamental 备案号：19302010047
</footer><!--页脚内容-->
</html>
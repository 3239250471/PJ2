<?php
$user=$_POST['user'];
$pass=$_POST['pass'];
$confirm=$_POST['confirm'];
$email=$_POST['email'];
$dbhost = "localhost";
$charset = 'utf8';
$dbname = "travel2";	//数据库名称
$dbuser = "Admin2";		//数据库用户名
$dbpass = "Dai05043159";	//数据库密码
$tbname = 'traveluser';

$password0=password_hash($pass, PASSWORD_DEFAULT);
$m1=preg_match('/^\S{25,}$/',$user);
$m2=preg_match('/^\d{0,6}$/',$pass);
if ($m1==1){
    echo "<script>alert('用户名过长！');location='./register.php';</script>";
}else {
    if ($m2==1) {
         echo "<script>alert('弱密码！');location='./register.php';</script>";
    } else {

        if ($pass != $confirm) {
            echo "<script>alert('两次输入密码不一致！');location='./register.php';</script>";
        } else {
            try {
                define('DBNAME', 'travel2');
                define('DBUSER', '代乾');
                define('DBPASS', 'Dai05043159');
                define('DBCONNSTRING', 'mysql:dbname=travel2;charset=utf8mb4;');
                $sql2 = "SELECT * FROM traveluser WHERE UserName=$user";
                $conn = new PDO(DBCONNSTRING, DBUSER, DBPASS);
                $result6 = $conn->query($sql2);

                if ($result6) {
                    echo "<script type='text/javascript'>alert('用户名已存在'); location='./register.php';</script>";
                } else {
                    $sql = "INSERT INTO travel2.traveluser(UserName,Pass,Email) VALUES(?,?,?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindValue(1, $user);//绑定参数
                    $stmt->bindValue(2, $password0);
                    $stmt->bindValue(3, $email);

                    $count = $stmt->execute();//执行预处理语句
                    if ($count <> 0) {
                        echo "<script type='text/javascript'>alert('注册成功');location='./index.php';</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('注册失败,请使用其它用户名'); location='./register.php';</script>";
                    }
                    $stmt = null;//释放
                    $conn = null; // 关闭连接
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }


        }
    }
}
    ?>
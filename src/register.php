<!DOCTYPE HTML>
<html >
<title>
    登录
</title>
<head>
    <meta charset="UTF-8">
    <link href="./login.css" rel="stylesheet" type="text/css">
    <title>登录</title>
</head>
<body>
<img class="logo" src="../img/logo.jpg"  alt="logo"/><!--加入一张图片-->
<br>
<h>Sign in for Fisher </h>
<form action="./check.php"  method="POST">
<div class="div2" >
    <p>
        User name:<br>
        <label>
            <input type="text" name="user" required="required"><!--设置文本框-->
        </label>
    </p>
    <p>
        Email:<br>
        <label>
            <input type="email" name="email" pattern="^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*(\.\w{2,})+$" required="required"><!--设置邮箱文本框-->
        </label>
    </p>
    <p>
        Password:<br>
        <label>
            <input type="password"  name="pass" value="" required="required"><!--设置密码文本框-->
        </label>
    </p>
    <p>
       Confirm your Password:<br>
        <label>
            <input type="password" name="confirm" value="" required="required"><!--确认密码文本框-->
        </label>
    </p>
    <p>
        <input type="submit" value="Sign in"   name="submit"><!--设置按钮并响应-->
    </p>
</div>
</form>

</body>
<footer>
    Copyright@Fudan web fundamental 备案号：19302010047
</footer>
</html>
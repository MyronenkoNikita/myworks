<link rel="stylesheet" type="text/css" href="css//login.css">
<?php
session_start();
include('dbconfig.php');

if (isset($_POST['username'])){
       
 $username = stripslashes($_REQUEST['username']);
 $password = stripslashes($_REQUEST['password']);

 $query = "SELECT * FROM `users` WHERE login='$username' and password='".md5($password)."'";
 $result = mysqli_query($db,$query);
 $rows = mysqli_num_rows($result);
 if($rows==1){
     $_SESSION['username'] = $username;
     header("Location: index.php");
 }
 else
     echo "<h3>Некорректные данные для входа!.</h3><br/><a href='login.php'>Вход</a>";
}
else
{
?>
<html>
<head>
<meta charset="utf-8">
<title>Вход</title>
</head>
<body>
    <div class='centered'>
<h1>Вход</h1>
<form action="" method="post" name="login">
<p><input type="text" name="username" placeholder="Username" required />
<p><input type="password" name="password" placeholder="Password" required />
<p><input name="submit" type="submit" value="Войти" />
</form>
<p>Нет регистрации?<br/><a href='reg.php'>Зарегистрироваться</a></p>
<?php } ?>
</div>
</body>
</html>
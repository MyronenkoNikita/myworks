<html>
<head>
	<title>Регистрация</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css//login.css">
</head>
<body>

<?php

include 'dbconfig.php';

if (isset($_POST['username']))
{
 $username = stripslashes($_POST['username']);
 $password = stripslashes($_POST['password']);
 $code = stripslashes($_POST['code']);
 $que = "SELECT id FROM `users` WHERE login='$username'";
 $res = mysqli_query($db,$que);
 $r = mysqli_num_rows($res);
 if($r == 0){
      if($code == "root"){
         $query = "INSERT INTO `users` (login, password, admin) VALUES ('$username', '". md5($password) ."', 1)";
      }
      else{
         $query = "INSERT INTO `users` (login, password, admin) VALUES ('$username', '". md5($password) ."', 0)";
      }
         $result = mysqli_query($db,$query);
      if($result){
         echo "<h3>Вы успешно зарегистрированы.</h3><br/><a href='login.php'>Вход</a>";  
      } 
   }
   else {
       echo "<h1 style='border-radius:5px; border-bottom: 1px solid black'>Ошибка!!!</h1>";
       echo "<h2>Уже такой аккаунт есть";
       echo "<br/><a href='login.php'>Главная страница</a></h2>";  
   }
}
else
    {
 ?>
 <div class='centered'>
<h1>Регистрация</h1>
<form name="registration" action="" method="post">
<p><input type="text" name="username" placeholder="Username" required />
<p><input type="password" name="password" placeholder="Password" required />
<p><input type="password" name="code" placeholder="Special code for admin" />
<p><input type="submit" name="submit" value="Зарегистрировать" />
</form>
<?php } ?>
</div>
</body>
</html>
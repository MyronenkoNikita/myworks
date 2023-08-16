<?php
include("auth.php");
include('dbconfig.php');
?>
<html>
<head>
<meta charset="utf-8">
<title>Добро пожаловать в наш магазин!</title>
<link rel="stylesheet" href="css//autho.css" />
</head>
<body>
<div class='centered'>
<h1>Здравствуйте <?php echo $_SESSION['username']; ?>!</h1>
<?php
    $name = $_SESSION['username'];
    $query = "SELECT admin FROM `users` WHERE login='$name' and admin=1";
    $result = mysqli_query($db,$query);
    $rows = mysqli_num_rows($result);
    if($rows==1){
        ?>
        <p><a href="books.php">Список книг</a></p>
        <p><a href="categories.php">Список категорий</a></p>
        <p><a href="main.php">Витрина</a></p>
        <a href="logout.php">Выйти</a>
         <?php
    }  
    else if($rows == 0){
        ?>
            <p><a href="main.php">Витрина</a></p>
            <a href="logout.php">Выйти</a>
        <?php
    }
?>
</div>
</body>
</html>
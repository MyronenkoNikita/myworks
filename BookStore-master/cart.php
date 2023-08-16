<?php
include("auth.php");
include("dbconfig.php");
session_start();
$status="";
?>

<html>
<head>
<meta charset="utf-8">
<title>Корзина</title>
<link rel="stylesheet" href="css//still.css" />
<link rel="stylesheet" href="css/login.css" />
</head>
<body>

<?php
if(isset($_POST['click'])){
  $today = date("Y-m-d H:i:s");
  $log = $_SESSION["username"];
  $ins_query="INSERT INTO Orders
  (`UserName`, `Date`) values ('$log' , '$today')";
  mysqli_query($db,$ins_query);
  unset($_SESSION["shopping_cart"]);   
  header("Location: main.php");
}


if (isset($_POST['action']) && $_POST['action']=="remove")
{
   if(!empty($_SESSION["shopping_cart"])) 
   {
    foreach($_SESSION["shopping_cart"] as $key => $value) 
    {
      if($_POST['id'] == $value['id'])
      {
         unset($_SESSION["shopping_cart"][$key]);
      }
      if(empty($_SESSION["shopping_cart"]))
      {
          unset($_SESSION["shopping_cart"]);   
      }
      } 
   }
}
 
if (isset($_POST['action']) && $_POST['action']=="change")
{
  foreach($_SESSION["shopping_cart"] as &$value)
  {
    if($value['id'] === $_POST["id"]){
        $value['quantity'] = $_POST["quantity"];
        break; 
    }
  }
}
?>

<div class="cart">
<p><a href="main.php">Вернуться на главную страницу </a></p>
<?php

if(isset($_SESSION["shopping_cart"]))
{
    $total_price = 0;
?> 
<div class='centered'>
<table class="table">
<tbody>
<tr>
<td></td>
<td>Название книги</td>
<td>Количество</td>
<td>Цена за штуку</td>
<td>Всего</td>
<td>Удалить</td>
</tr> 
<?php 
foreach ($_SESSION["shopping_cart"] as $product)
{
?>
<tr>
<td><img src='images/<?php echo $product['cover']; ?>' width="100" /></td>
<td><?php echo $product['title']; ?><br /></td>

<td>
<form method='post' action=''>
<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
<input type='hidden' name='action' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
</select>
</form>
</td>

<td><?php echo $product['price'] . " грн."; ?></td>
<td><?php echo $product['price']*$product['quantity']. " грн."; ?></td>

<td>
<form method='post' action="">
<input type='hidden' name='id' value="<?php echo $product['id']; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Удалить</button>
</form>
</td>

</tr>
<?php
$total_price += ($product['price']*$product['quantity']);
}
?>
<tr>
<td align="left" colspan="3">
<form action="" method="post">
<input type="submit" name='click' href='main.php' value="Продолжить покупки"></input>
</form>
</td>
<td colspan="6" align="right">
<strong>Всего: <?php echo $total_price . " грн."; ?></strong>
</td>
</tr>
</tbody>
</table> 
</div>
  <?php
}else{
 echo "<h3>Ваша корзина пуста!</h3>";
 echo "<p><a href=\"main.php\">Продолжить покупки </a>";
 }
?>
</div>
 
<div style="clear:both;"></div>
 
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>


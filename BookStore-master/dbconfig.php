<?php
$dbUsername = "localhost";
$dbPassword = "root";
$dbName  = "";

$db = new mysqli($dbUsername, $dbPassword, $dbName, "bookstore" );

if ($db->connect_error) {
    die("Ошибка соединения: " . $db->connect_error);
}

?>
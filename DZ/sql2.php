<?php 
include "func.php";

$host = 'localhost';
$login = 'root';
$pass = '';
$db_name = 'shop';

$mysql = @new mysqli($host, $login, $pass, $db_name);
if(mysqli_connect_errno()){ die(mysqli_connect_error()); }

$sql = "select * from `products`";
$result = $mysql->query($sql); if (!$result) die($mysql->error);

$data = $result->fetch_all(MYSQLI_ASSOC);
if (count($data)) {
    echo drawTable2($data);
} else {
    echo 'Таблица пустая!';
}
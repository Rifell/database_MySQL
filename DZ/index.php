<?php
include 'func.php';

$host = 'localhost';
$login = 'root';
$pass = '';
$db_name = 'shop';

$mysql = @new mysqli($host, $login, $pass, $db_name);
if(mysqli_connect_errno()){ die(mysqli_connect_error()); }

$sql = 'set names "utf8"';

$result = $mysql->query($sql); if(!$result) die ($mysql->error);

$mysql->query('drop table `category`'); 

$sql1 = "
CREATE TABLE `category` (
    `id` int(11) NOT NULL AUTO_INCREMENT primary key,
    `title` tinytext,
    `status` enum('active', 'passive', 'lock', 'gold') DEFAULT 'active'
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$mysql->query('drop table `products`'); 
$sql2 = "
CREATE TABLE `products` (
    `id` int(11) not null auto_increment primary key,
    `id_catalog` int(11) not null,
    `title` tinytext,
    `mark` tinytext,
    `count` int(11),
    `price` int(11),
    `description` text,
    `status` enum('yes', 'no') 
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$mysql->query('drop table `users`'); 
$sql3 = "
CREATE TABLE `users` (
    `id` int(11) not null auto_increment primary key,
    `name` tinytext,
    `lastname` tinytext,
    `birthday` date,
    `email` tinytext,
    `password` varchar(21),
    `is_active` boolean,
    `reg_date`  date,
    `last_update` date,
    `status` enum('active', 'passive', 'lock', 'vip') default 'active'
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$mysql->query('drop table `orders`'); 
$sql4 = "
CREATE TABLE `orders` (
    `id` int(11) not null auto_increment primary key,
    `id_user` int(11) not null,
    `date_order` date,
    `status` enum('active', 'complete')
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

$mysql->query('drop table `order_items`'); 
$sql5 = "
CREATE TABLE `order_items` (
   `id` int(11) not null auto_increment primary key,
   `id_order` int(11) not null,
   `id_product` int(11) not null,
   `price` int(11),
   `count` int(11)
   ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";


$result = $mysql->query($sql1); if(!$result) die ($mysql->error);
$result = $mysql->query($sql2); if(!$result) die ($mysql->error);
$result = $mysql->query($sql3); if(!$result) die ($mysql->error); 
$result = $mysql->query($sql4); if(!$result) die ($mysql->error);
$result = $mysql->query($sql5); if(!$result) die ($mysql->error);

$sql11 = "
INSERT INTO `category` (title, status) VALUES
('Процессоры', 'active'), 
('Кулеры', 'active'),
('Материнские платы', 'active'),
('Термопасты', 'active'),
('Корпуса', 'active'),
('Видеокарты', 'active'),
('Жесткие диски', 'active'),
('Flash-накопители', 'active'),
('Мониторы', 'active'),
('Клавиатуры', 'active'),
('Мышки', 'active')";

$sql12 = "
INSERT INTO `products` (id_catalog, title, mark, count, price, description, status) VALUES
('1', 'Intel Core i7', 'Intel corp.', '118', '22000', 'Модель 7700К под сокет 1151, 4 ядра, отличный разгонный потенциал', 'yes'),
('2', 'Noctua D-15', 'Noctua', '51', '5500', 'Модель D-15 явдяется кулером башенного типа, подходит почти под все сокеты, а самое главное эффективно охлаждает процессоры', 'yes'),
('3', 'Asus Z-270-P', 'Asus', '40', '7000', 'Материнская плата имеет 1151 сокет, на чипсете z-270, для разгона', 'yes'),
('5', 'CoolerMaster Storm-Trooper', 'CoolerMaster', '12', '11590', 'Просторный коропус формата Full-Tower, для геймеров', 'yes'),
('6', 'Asus GEFORCE GTX1060', 'nVidia', '22', '24000', 'Добротная видеокарта с 6гб видеопамяти', 'yes'),
('7', 'Western Digital Caviar Black 1000gb', 'WD', '113', '4590', 'Жесткий диск линейки Black славится своей надежностью', 'yes'),
('8', 'SSD Kingston 240gb', 'Kingston', '99', '5000', 'Один из лучших SSD по соотношению цена/качество', 'yes'),
('9', 'LG UMP-29G', 'LG', '7', '18000', 'Бюджетная модель игрового монитора, поддерживает частоту кадров до 75ГЦ', 'yes'),
('10', 'A4TECH-212', 'A4TECH', '22', '1290', 'Обычная низкопрофильная клавиатура', 'yes'),
('11', 'Logitech G403', 'Logitech', '17', '4490', 'Лучшая мышка по версии многих интернет-ресурсов за 2017 год', 'yes')";

$sql13 = "
INSERT INTO `users` (name, lastname, birthday, email, password, is_active, status) VALUES
('Семен', 'Федоров', '1990-09-01', 'sem.fed@mail.ru', 'semen111fedor', TRUE, 'active'),
('Анатолий', 'Зинченко', '1988-01-07', 'zinchenko88@mail.ru', 'qwerty321', 'true', 'active'),
('Елизавета', 'Цуканова', '1971-08-08', 'lizo4ka88@mail.ru', 'blondi2211', 'true', 'active'),
('Виктория', 'Минакова', '1992-02-12', 'minakova-vika@gmail.com', 'victoria1992', 'true', 'active'),
('Магомед', 'Махуджарахов', '1989-10-11', 'borec-zhi.estb@yandex.ru', 'dag_05', 'true', 'lock'),
('Александр', 'Григорьев', '1977-12-21', 'sanya-baltika@mail.ru', 'pivasik123', 'true', 'active'),
('Валентина', 'Семенова', '1962-04-18', 'valentina-senova62@mail.ru', '12345', 'true', 'active'),
('Владислав', 'Панченко', '1993-10-10', 'vladok93@mail.ru', 'panchenko1993', 'true', 'vip'),
('Светлана', 'Кожемякина', '1980-03-06', 'svet.lana80@yandex.ru', 'davalka111', 'true', 'active'),
('Екатерина', 'Чивилева', '1997-07-31', 'kate-chiv1997@mail.ru', 'izderevni', 'true', 'active')";

$sql14 = "
INSERT INTO `orders` (id_user, date_order, status) VALUES 
('1', '2017-08-30', 'active'),
('8', '2017-08-29', 'active'),
('1', '2017-08-10', 'complete'),
('4', '2017-07-30', 'complete'),
('3', '2017-09-01', 'active')";

$sql15 = "
INSERT INTO `order_items` (id_order, id_product, price, count) VALUES 
('1', '1', '22000', '2'),
('1', '3', '7000', '2'),
('1', '7', '4590', '2'),
('2', '10', '1290', '1'),
('2', '11', '4490', '1'),
('3', '1', '22000', '5'),
('4', '7', '24000', '3'),
('4', '8', '5000', '3'),
('5', '9', '18000', '5'),
('5', '10', '12900', '5'),
('5', '11', '4590', '5')";

$result = $mysql->query($sql11); if(!$result) die ($mysql->error);
$result = $mysql->query($sql12); if(!$result) die ($mysql->error);
$result = $mysql->query($sql13); if(!$result) die ($mysql->error);
$result = $mysql->query($sql14); if(!$result) die ($mysql->error);
$result = $mysql->query($sql15); if(!$result) die ($mysql->error);
?>

<html>
<a href="sql1.php">Таблица №1</a>
<br>
<a href="sql2.php">Таблица №2</a>
<br>
<a href="sql3.php">Таблица №3</a>
<br>
<a href="sql4.php">Таблица №4</a>
<br>
<a href="sql5.php">Таблица №5</a>
</html>

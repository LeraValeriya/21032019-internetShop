<?php
include('../config/config.php');
// зарпос к БД найти все категории, где parent_id =0, чтобы вывести в меню категории
$query = "SELECT * FROM `categories` WHERE `parent_id` = 0";
$result = mysqli_query($link, $query);

// формируем ссылку
include('../modules/function.php');
$links = '';

while ($res = mysqli_fetch_assoc($result)) {
    $links .= '<a href="../catalog/catalog.php?category='.$res['id'] .'">' .$res['name'].'</a>';
    // d($res);
}
// d($links);
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../styles/catalog.css">
    <title>Каталог товаров</title>
</head>

<body>
    <div class="wrapper">
        <div class="header">

            <div class="menu">
                <div class="logo">SH</div>
                <?= $links ?>
                <!-- <a href="../catalog/catalog.php?category=1">Женщинам</a>
                <a href="../catalog/catalog.php?category=2">Мужчинам</a>
                <a href="../catalog/catalog.php?category=3">Детям</a> -->
                <a href="../catalog/catalog.php?category=1">Новинки</a>
                <a href="../catalog/catalog.php?category=1">О нас</a>
            </div>
            <div class="myAccount">
                <div class="profile">
                    <img src="../images/icon/male-user-profile_icon-icons.com_54765.svg" alt=""> Привет, Лера (
                    <span class="button">выйти</span>
                    )
                </div>
                <div class="basket">
                    <img src="../images/icon/bag_icon-icons.com_66639.svg" alt=""> Корзина (5)
                </div>
            </div>



        </div>


        <hr>
        <nav>
            Главная / Мужчинам
        </nav>
<!DOCTYPE html>
<html lang="ru">

<?php
include('../modules/header.php');

include('../config/config.php');

// 
// Все еще пробую рлорло


// зарпос к БД найти все категории, где parent_id = выбранной категории
$query = "SELECT * FROM `categories` WHERE `parent_id` = {$_GET['category']}";
$result = mysqli_query($link, $query);


$options = '';

while ($res = mysqli_fetch_assoc($result)) {
    $options .= '<option name="category" value="'.$res['id'] .'"> '. $res['name'] .'</option>';
}

?>


<section>
    <h1>Мужчинам</h1>
    <h3>Все товары</h3>
    <div class="filters">

        <select class="filter">
            <option value="" name="category" hidden>Категория</option>
            <?= $options ?>
        </select>

        <select class="filter">
            <option value="" hidden>Размер</option>
            <option value="XS">XS</option>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="One size">One size</option>
        </select>

        <select class="filter">
            <option value="" hidden>Стоимость</option>
            <option value="0-3000">до 3000 руб.</option>
            <option value="3000-7000">3000-7000 руб.</option>
            <option value="7000-15000">7000-15000 руб.</option>
            <option value="15000-30000">15000-30000 руб.</option>
        </select>

    </div>


    <div class="catalog">



    </div>
    <div class="pages">
        <!-- <div class="pageNum _active">1</div>
        <div class="pageNum">2</div>
        <div class="pageNum">3</div>
        <div class="pageNum">4</div> -->
    </div>
</section>

<?php include('../modules/footer.php'); ?>
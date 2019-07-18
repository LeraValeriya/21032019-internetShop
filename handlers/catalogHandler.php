<?php

// echo 'ddr!';

include('../config/config.php');
include('../modules/function.php');
$items = [];
$cat = $_GET['category'];

// получим дочерние категории

$catalog_info = [
    'catalogItems' => [],
    'pagination' => [
        'curentPage'=> $_GET['curPage'],
        'allPages' => 2
    ]
];



sleep(2);
// preloader


// узнаем, родительская ли категория, либо дочерняя
$query = "SELECT `parent_id` FROM `categories` WHERE `id` = $cat";
$result = mysqli_query($link, $query);
$result = mysqli_fetch_assoc($result);
// d($result);
if ( !$result['parent_id'] ) {

    // получим дочерние категории
    $query = "SELECT `id` FROM `categories` WHERE `parent_id` = $cat";
    $result = mysqli_query($link, $query);

    
    $catalog = [];
    while ( $res = mysqli_fetch_assoc($result) ) {
        $catalog[] = ( getProductsFromCatalog($res['id'], $link, $items) );
    }

    // d($catalog);

    $newCatalog = [];
    foreach ( $catalog as $key => $value ) {
        foreach ( $value as $index => $item ) {
            $newCatalog[] = $item;
        }
    }

    // $query = "SELECT COUNT(`id`) AS `result` FROM `catalog` WHERE `category` = {$catId}";
    // $res = mysqli_query($link, $query);
    // $res['result'];

    $catalog_info['catalogItems'] = $newCatalog;
    echo json_encode($catalog_info);
} else {
    $catalog_info['catalogItems'] = getProductsFromCatalog($cat, $link, $items);
    echo json_encode( $catalog_info );
   
}









// $items - массив с данными по каждой строчке

// json_encode($items);



// $items = [

// ];

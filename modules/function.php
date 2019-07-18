<?php


function d($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

// функция поиска товаров в каталоге

function getProductsFromCatalog( $catId, $link, $items ) {

    // ищем товары в БД с нужным id категории
    $query = "SELECT * FROM `catalog` WHERE `category` = {$catId}";
    //  AND `price` BETWEEN 3000 and 6000
    $result_goods = mysqli_query($link, $query);
 
    if ( mysqli_num_rows($result_goods) !== 0 ) {
        // перебираем объект с товарами и записываем в массив
        while ($item = mysqli_fetch_assoc($result_goods)) {
            $items[] = $item;
        }
    }

    return $items;
}

?>
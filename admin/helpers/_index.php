<?php


function getCount($table)
{

    global $connection;

    $user_data_q = "SELECT * FROM `$table`";

    $user_data_stmt = mysqli_prepare($connection, $user_data_q);

    mysqli_stmt_execute($user_data_stmt);

    $result = mysqli_stmt_get_result($user_data_stmt);

    return mysqli_num_rows($result);
}


function getRecent($table)
{
    global $connection;

    $user_data_q = "SELECT * FROM `$table` ORDER BY id DESC LIMIT 5";

    $user_data_stmt = mysqli_prepare($connection, $user_data_q);

    mysqli_stmt_execute($user_data_stmt);

    $result = mysqli_stmt_get_result($user_data_stmt);

    return $result;
}


function getAllProducts()
{
    global $connection;

    $productsData = "SELECT * FROM `product`";

    $product_data_stmt = mysqli_prepare($connection, $productsData);

    mysqli_stmt_execute($product_data_stmt);

    $user_products = mysqli_stmt_get_result($product_data_stmt);

    mysqli_stmt_close($product_data_stmt);

    return $user_products;
}
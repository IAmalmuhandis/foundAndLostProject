<?php

if (!isset($_SESSION)) {
        session_start();
    }

$email = $_SESSION['s_user_id'];

// get customer orders
$ordersData = "SELECT * FROM `orders` WHERE `seller_id` = '$email' AND `status` = 'Pending'";

$order_data_stmt = mysqli_prepare($connection, $ordersData);

mysqli_stmt_execute($order_data_stmt);

$orders = mysqli_stmt_get_result($order_data_stmt);

// set to delivered

if (isset($_GET['product_id']) && isset($_GET['buyer_id'])) {
    $product_id = $_GET['product_id'];
    $buyer_id = $_GET['buyer_id'];

    $orderProduct = "UPDATE `orders` SET `status`='Delivered' WHERE `product_id`=? AND `buyer_id`=?";

    $orderStmt = mysqli_prepare($connection, $orderProduct);

    mysqli_stmt_bind_param($orderStmt, "ss", $product_id, $buyer_id);

    if (mysqli_stmt_execute($orderStmt)) {
        header("Location: index.php");
    }

}

// get products
$productsData = "SELECT * FROM `product` WHERE `owner` = '$email'";

$product_data_stmt = mysqli_prepare($connection, $productsData);

mysqli_stmt_execute($product_data_stmt);

$user_products = mysqli_stmt_get_result($product_data_stmt);
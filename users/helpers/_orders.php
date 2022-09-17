<?php
if (!isset($_SESSION)) {
        session_start();
    }

$email = $_SESSION['s_user_id'];

// get orders
$ordersData = "SELECT * FROM `orders` WHERE `buyer_id` = '$email'";

$order_data_stmt = mysqli_prepare($connection, $ordersData);

mysqli_stmt_execute($order_data_stmt);

$orders = mysqli_stmt_get_result($order_data_stmt);


if (isset($_GET['product_id']) && isset($_GET['seller_id'])) {
    $product_id = $_GET['product_id'];
    $seller_id = $_GET['seller_id'];
    $buyer_id = $email;
    $quantity = $_GET['quantity'];
    $amount = $_GET['amount'];

    $order_date = date("Y-m-d h:i:s");

    $orderProduct = "INSERT INTO `orders`(`product_id`, `seller_id`, `buyer_id`,`quantity`, `amount`, `datetime`) VALUES (?, ?, ?, ?, ?, ?)";

    $orderStmt = mysqli_prepare($connection, $orderProduct);

    mysqli_stmt_bind_param($orderStmt, 
    "ssssss", $product_id, $seller_id, $buyer_id, $quantity, $amount, $order_date);

    if (mysqli_stmt_execute($orderStmt)) {
        remove_cartItem($product_id);
        header("Location: orders.php");
    }

}
<?php

if (!isset($_SESSION)) {
        session_start();
    }

$email = $_SESSION['s_user_id'];

// get cart items
$cartData = "SELECT * FROM `cart` WHERE `buyer_id` = '$email'";

$cart_data_stmt = mysqli_prepare($connection, $cartData);

mysqli_stmt_execute($cart_data_stmt);

$cart_items = mysqli_stmt_get_result($cart_data_stmt);

if (isset($_GET['remove'])) {
    $remove_cart_id = $_GET['remove'];
    remove_cartItem($remove_cart_id);
    header("Location: cart.php");
}
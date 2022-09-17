<?php

if (!isset($_SESSION)) {
        session_start();
    }

$email = $_SESSION['s_user_id'];

// get products
$productsData = "SELECT * FROM `product` WHERE `owner` = '$email'";

$product_data_stmt = mysqli_prepare($connection, $productsData);

mysqli_stmt_execute($product_data_stmt);

$user_products = mysqli_stmt_get_result($product_data_stmt);

// get categories

$categoryData = "SELECT * FROM `categories`";

$category_data_stmt = mysqli_prepare($connection, $categoryData);

mysqli_stmt_execute($category_data_stmt);

$cat_results = mysqli_stmt_get_result($category_data_stmt);


if (isset($_POST['addProduct'])) {    
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $product_title = mysqli_escape_string($connection, $_POST['product_title']);
    $product_description = mysqli_real_escape_string($connection, $_POST['product_description']);
    $product_price = mysqli_real_escape_string($connection, $_POST['product_price']);
    $product_category_id = mysqli_real_escape_string($connection, $_POST['product_category']);

    if (empty($product_id) || empty($product_title) || empty($product_description) || empty($product_description) || empty($product_price) || empty($product_category_id)) {
        $message = "<span class='text-danger'>Inputs can't be empty</span>";
        return;
    }

    $insertProduct = "INSERT INTO `product`(`product_id`, `title`, `description`, `product_price`, `category_id`, `owner`) VALUES (?, ?, ?, ?, ?, ?)";

    $insertStmt = mysqli_prepare($connection, $insertProduct);

    mysqli_stmt_bind_param($insertStmt, 
    "ssssss", $product_id, $product_title, $product_description, $product_price, $product_category_id, $email);

    if (mysqli_stmt_execute($insertStmt)) {
        header("location: ?successMSG=Successfully added a product");
    }else{
        header("location: ?errorMSG=Can't add a product");
    }

}
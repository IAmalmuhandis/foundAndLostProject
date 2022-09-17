<?php

include 'setup.php';

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = stripslashes($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING);
    return $data;
}

function haveSpecialChar($data)
{
    return preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/', $data);
}

function getCategoryById($id)
{
    global $connection;

    $data_q = "SELECT * FROM `categories` WHERE id = ?";

    $cat_data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($cat_data_stmt, "s", $id);

    mysqli_stmt_execute($cat_data_stmt);

    $cat_results = mysqli_fetch_assoc(mysqli_stmt_get_result($cat_data_stmt));
    return $cat_results['title'];
}

function isUserLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['s_userID']) && isset($_SESSION['s_user_id'])) {
        return true;
    } else {
        return false;
    }
}

function getUserByEmail($email)
{
    global $connection;

    $userdata_q = "SELECT * FROM `users` WHERE `email` = ?";

    $user_data_stmt = mysqli_prepare($connection, $userdata_q);

    mysqli_stmt_bind_param($user_data_stmt, 's', $email);

    mysqli_stmt_execute($user_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($user_data_stmt));

    mysqli_stmt_close($user_data_stmt);

    return $result;
}

function getProductById($id)
{
    global $connection;

    $data_q = "SELECT * FROM `product` WHERE product_id = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, "s", $id);

    mysqli_stmt_execute($data_stmt);

    $results = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));
    return $results;
}

function getAdvertById($id)
{
    global $connection;

    $data_q = "SELECT * FROM `advert` WHERE ad_id = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, "s", $id);

    mysqli_stmt_execute($data_stmt);

    $results = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));
    return $results;
}

function getAdvertByProductId($id)
{
    global $connection;

    $data_q = "SELECT * FROM `advert` WHERE product_id = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, "s", $id);

    mysqli_stmt_execute($data_stmt);

    $results = mysqli_fetch_assoc(mysqli_stmt_get_result($data_stmt));
    return $results;
}


function isInCart($product_id, $user_id)
{
    $inCart = false;

    global $connection;

    $isInCart_q = "SELECT * FROM `cart` WHERE  `product_id` = ? AND `buyer_id` = ?";

    $inCart_stmt = mysqli_prepare($connection, $isInCart_q);

    mysqli_stmt_bind_param($inCart_stmt, 'ss', $product_id, $user_id);

    mysqli_stmt_execute($inCart_stmt);

    $results = mysqli_stmt_get_result($inCart_stmt);

    if (mysqli_num_rows($results) > 0) {
        $inCart = true;
    } else {
        $inCart = false;
    }

    return $inCart;
}

function countItemsInCart($user_id)
{
    global $connection;

    $isInCart_q = "SELECT * FROM `cart` WHERE `buyer_id` = ?";

    $inCart_stmt = mysqli_prepare($connection, $isInCart_q);

    mysqli_stmt_bind_param($inCart_stmt, 's', $user_id);

    mysqli_stmt_execute($inCart_stmt);

    $results = mysqli_num_rows(mysqli_stmt_get_result($inCart_stmt));

    return $results;
}


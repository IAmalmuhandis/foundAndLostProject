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

function user_exist($email, $password)
{
    $userExist = false;

    $result = getUserByEmail($email);

    $db_userEmail = $result['email'];
    $is_password = password_verify($password, $result['password']);

    if ($db_userEmail == $email && $is_password) {
        $userExist = true;
    } else {
        $userExist = false;
    }
    return $userExist;
}

function loginUser($email, $password)
{
    if (user_exist($email, $password)) {
        $result = getUserByEmail($email);

        session_start();
        $_SESSION['s_userID'] = $result['id'];
        $_SESSION['s_user_id'] = $result['email'];
        header("Location: index.php");
    }
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


function logoutUser()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_userID'];
    $s_email = $_SESSION['s_user_id'];

    $s_id = null;
    $s_email = null;

    unset($s_id);
    unset($s_email);

    session_destroy();
    header("Location: login.php");
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

function updateUserPassword($email, $newpassword)
{
    $isUPdated = false;
    global $connection;
    $hashedPass = password_hash($newpassword, PASSWORD_DEFAULT, []);

    $update_q = "UPDATE `users` SET `password`= ? WHERE `email` = ?";

    $update_stmt = mysqli_prepare($connection, $update_q);

    mysqli_stmt_bind_param($update_stmt, "ss", $hashedPass, $email);

    if (mysqli_stmt_execute($update_stmt)) {
        $isUPdated = true;
    } else {
        $isUPdated = false;
    }
    mysqli_stmt_close($update_stmt);

    return $isUPdated;
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

function countItemsOrdered($user_id)
{
    global $connection;

    $isInCart_q = "SELECT * FROM `orders` WHERE `buyer_id` = ?";

    $inCart_stmt = mysqli_prepare($connection, $isInCart_q);

    mysqli_stmt_bind_param($inCart_stmt, 's', $user_id);

    mysqli_stmt_execute($inCart_stmt);

    $results = mysqli_num_rows(mysqli_stmt_get_result($inCart_stmt));

    return $results;
}

function countPeopleReached($user_id, $product_id)
{
    global $connection;

    $count_q = "SELECT * FROM `advert` WHERE `owner` = ? AND `product_id` = ?";

    $count_stmt = mysqli_prepare($connection, $count_q);

    mysqli_stmt_bind_param($count_stmt, 'ss', $user_id, $product_id);

    mysqli_stmt_execute($count_stmt);

    $results = mysqli_fetch_assoc(mysqli_stmt_get_result($count_stmt));

    $result = $results['clicks'];

    return $result;
}

function remove_cartItem($cart_item_id)
{
    global $connection;

    $delete_q = "DELETE FROM `cart` WHERE `product_id` = ?";

    $delete_stmt = mysqli_prepare($connection, $delete_q);

    mysqli_stmt_bind_param($delete_stmt, 's', $cart_item_id);

    mysqli_stmt_execute($delete_stmt);

    mysqli_stmt_close($delete_stmt);

}
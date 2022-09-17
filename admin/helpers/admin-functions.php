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

function getAdminByUsername($username)
{
    global $connection;

    $admin_data_q = "SELECT * FROM `admin` WHERE `username` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $username);

    mysqli_stmt_execute($admin_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

    mysqli_stmt_close($admin_data_stmt);

    return $result;
}

function getAdminByEmail($email)
{
    global $connection;

    $admin_data_q = "SELECT * FROM `admin` WHERE `email` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $email);

    mysqli_stmt_execute($admin_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

    mysqli_stmt_close($admin_data_stmt);

    return $result;
}

function admin_exist($username, $password)
{
    $adminExist = false;

    $result = getAdminByUsername($username);

    $db_username = $result['username'];
    $is_password = password_verify($password, $result['password']);

    if ($db_username == $username && $is_password) {
        $adminExist = true;
    } else {
        $adminExist = false;
    }
    return $adminExist;
}

function email_exist($email)
{
    $emailExist = false;

    $result = getAdminByEmail($email);

    $db_email = $result['email'];

    if ($db_email == $email) {
        $emailExist = true;
    } else {
        $emailExist = false;
    }
    return $emailExist;
}


function loginAdmin($username, $password)
{
    if (admin_exist($username, $password)) {
        $result = getAdminByUsername($username);

        session_start();
        $_SESSION['s_adminID'] = $result['id'];
        $_SESSION['s_adminUsername'] = $result['username'];
        header("Location: index.php");
    }
}

function isAdminLoggedIn()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    if (isset($_SESSION['s_adminID']) && isset($_SESSION['s_adminUsername'])) {
        return true;
    } else {
        return false;
    }
}


function logoutAdmin()
{
    if (!isset($_SESSION)) {
        session_start();
    }

    $s_id = $_SESSION['s_adminID'];
    $s_username = $_SESSION['s_adminUsername'];

    $s_id = null;
    $s_username = null;

    unset($s_id);
    unset($s_username);

    session_destroy();
    header("Location: login.php");
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


function countPeopleReached($user_id, $product_id, $column)
{
    global $connection;

    $count_q = "SELECT * FROM `advert` WHERE `owner` = ? AND `product_id` = ?";

    $count_stmt = mysqli_prepare($connection, $count_q);

    mysqli_stmt_bind_param($count_stmt, 'ss', $user_id, $product_id);

    mysqli_stmt_execute($count_stmt);

    $results = mysqli_fetch_assoc(mysqli_stmt_get_result($count_stmt));

    $result = $results[$column];

    return $result;
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
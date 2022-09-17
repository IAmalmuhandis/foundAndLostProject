<?php

$categoryData = "SELECT * FROM `categories`";

$category_data_stmt = mysqli_prepare($connection, $categoryData);

mysqli_stmt_execute($category_data_stmt);

$cat_results = mysqli_stmt_get_result($category_data_stmt);


if (isset($_GET['del'])) {
    $del_cat_id = $_GET['del'];
    delete_category($del_cat_id);
}

function delete_category($cat_id)
{
    global $connection;

    $delete_q = "DELETE FROM `categories` WHERE `id` = ?";

    $delete_stmt = mysqli_prepare($connection, $delete_q);

    mysqli_stmt_bind_param($delete_stmt, 's', $cat_id);

    mysqli_stmt_execute($delete_stmt);

    mysqli_stmt_close($delete_stmt);

    header("Location: manage_category.php");
}

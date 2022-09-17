<?php
if (isset($_POST['add_cat'])) {
    $category_title = mysqli_real_escape_string($connection, sanitizeInput($_POST['category_title']));

    $messages = [];
    if (empty($category_title)) {
        $messages['msgErr'] = "Catogory title cannot be empty";
    }
    if (Category_exist($category_title)) {
        $messages['msgErr'] = "Catogory with same name already exist";
    }

    if (count($messages) < 1) {
        $add_cat_query = "INSERT INTO `categories` (`title`) VALUES (?)";

        $add_cat_stmt = mysqli_prepare($connection, $add_cat_query);

        mysqli_stmt_bind_param(
            $add_cat_stmt,
            "s",
            $category_title
        );

        $exec_cat_dept = mysqli_stmt_execute($add_cat_stmt);

        mysqli_stmt_close($add_cat_stmt);

        if ($exec_cat_dept) {
            $messages['msgSucc'] = "Category Added Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured adding category, try again";
        }
    }
}


function category_exist($title)
{
    $catExist = false;

    global $connection;

    $cat_data_q = "SELECT * FROM `categories` WHERE `title` = ?";

    $cat_data_stmt = mysqli_prepare($connection, $cat_data_q);

    mysqli_stmt_bind_param($cat_data_stmt, 's', $title);

    mysqli_stmt_execute($cat_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($cat_data_stmt));

    mysqli_stmt_close($cat_data_stmt);

    $db_cat_id = $result['title'];

    if ($db_cat_id == $title) {
        $catExist = true;
    } else {
        $catExist = false;
    }
    return $catExist;
}
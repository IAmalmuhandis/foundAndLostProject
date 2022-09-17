<?php
//  fetch categories
    $id = $_GET['edit'];
    $data_q = "SELECT * FROM `categories` WHERE id = ?";

    $cat_data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($cat_data_stmt, "s", $id);

    mysqli_stmt_execute($cat_data_stmt);

    $cat_results = mysqli_fetch_assoc(mysqli_stmt_get_result($cat_data_stmt));


if (isset($_POST['edit_cat'])) {
    $id = $_GET['edit'];
    $cat_title = mysqli_real_escape_string($connection, sanitizeInput($_POST['category_title']));

    $messages = [];
    if ($cat_results['id'] != $id) {
        $messages['msgErr'] = "Cannot edit department ID";
    }
    if (category_exist($cat_title)) {
        $messages['msgErr'] = "Category with same name already exist";
    }

    if (count($messages) < 1) {
        $update_dept_query = "UPDATE `categories` SET `title` = ? WHERE `id` = ?";

        $update_cat_stmt = mysqli_prepare($connection, $update_dept_query);

        mysqli_stmt_bind_param(
            $update_cat_stmt,
            "ss",
            $cat_title,
            $id
        );

        $exec_add_cat = mysqli_stmt_execute($update_cat_stmt);

        mysqli_stmt_close($update_cat_stmt);

        if ($exec_add_cat) {
            $messages['msgSucc'] = "Category Updated Successfully...";
        } else {
            $messages['msgErr'] = "Error Occured updating category, try again";
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

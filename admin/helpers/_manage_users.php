<?php

$get_users = "SELECT * FROM `users`";

$users_stmt = mysqli_prepare($connection, $get_users);

mysqli_stmt_execute($users_stmt);

$users = mysqli_stmt_get_result($users_stmt);

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    delete_user($delete);
    header("Location: manage_users.php");
}

function delete_user($delete_id)
{
    global $connection;

    $delete_q = "DELETE FROM `users` WHERE `email` = ?";

    $delete_stmt = mysqli_prepare($connection, $delete_q);

    mysqli_stmt_bind_param($delete_stmt, 's', $delete_id);

    mysqli_stmt_execute($delete_stmt);

    mysqli_stmt_close($delete_stmt);

}
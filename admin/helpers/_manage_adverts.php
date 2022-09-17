<?php 

$all_adverts_q = "SELECT * FROM `advert`";

$all_adverts_stmt = mysqli_prepare($connection, $all_adverts_q);

mysqli_stmt_execute($all_adverts_stmt);

$all_adverts = mysqli_stmt_get_result($all_adverts_stmt);

mysqli_stmt_close($all_adverts_stmt);

if (isset($_GET['delete'])) {
    $delete = $_GET['delete'];
    delete_advert($delete);
    header("Location: manage_adverts.php");
}

function delete_advert($delete_id)
{
    global $connection;

    $delete_q = "DELETE FROM `advert` WHERE `ad_id` = ?";

    $delete_stmt = mysqli_prepare($connection, $delete_q);

    mysqli_stmt_bind_param($delete_stmt, 's', $delete_id);

    mysqli_stmt_execute($delete_stmt);

    mysqli_stmt_close($delete_stmt);

}
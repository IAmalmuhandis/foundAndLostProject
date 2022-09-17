<?php

    $newAdverts_query = "SELECT * FROM `advert`  WHERE `status` = 'In Review'";

    $newAdverts_stmt = mysqli_prepare($connection, $newAdverts_query);

    mysqli_stmt_execute($newAdverts_stmt);

    $newAdverts_result = mysqli_stmt_get_result($newAdverts_stmt);

    // 

    if (isset($_GET['status']) && isset($_GET['ad_id'])) {
        $ad_id = $_GET['ad_id'];
        $status = $_GET['status'];

        $q = "UPDATE `advert` SET `status`=? WHERE `ad_id` = ?";

        $q_stmt = mysqli_prepare($connection, $q);

        mysqli_stmt_bind_param($q_stmt, "ss", $status, $ad_id);

        mysqli_stmt_execute($q_stmt);

        header("Location: new_adverts.php");
    }
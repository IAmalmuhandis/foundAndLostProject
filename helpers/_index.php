<?php
    $advertsData_q = "SELECT * FROM `advert` WHERE `status` = 'Accepted'";

    $advert_data_stmt = mysqli_prepare($connection, $advertsData_q);

    mysqli_stmt_execute($advert_data_stmt);

    $adverts = mysqli_stmt_get_result($advert_data_stmt);

    mysqli_stmt_close($advert_data_stmt);

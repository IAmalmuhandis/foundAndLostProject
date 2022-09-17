<?php

// get orders
$ordersData = "SELECT * FROM `orders`";

$order_data_stmt = mysqli_prepare($connection, $ordersData);

mysqli_stmt_execute($order_data_stmt);

$orders = mysqli_stmt_get_result($order_data_stmt);
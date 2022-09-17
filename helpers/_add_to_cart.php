<?php 
if (isUserLoggedIn()) {
  if (!isset($_SESSION)) {
        session_start();
    }

$email = $_SESSION['s_user_id'];
}

if(isset($_GET['addToCart'])){
    $product_id = $_GET['addToCart'];
    $quantity = $_GET['quantity'];

    
    $insertToCart = "INSERT INTO `cart`(`product_id`, `quantity`, `buyer_id`) VALUES (?, ?, ?)";

    $insertStmt = mysqli_prepare($connection, $insertToCart);

    mysqli_stmt_bind_param($insertStmt, "sss", $product_id, $quantity, $email);

    mysqli_stmt_execute($insertStmt);

}

if(isset($_POST['addToCart'])){
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    $insertToCart = "INSERT INTO `cart`(`product_id`, `quantity`, `buyer_id`) VALUES (?, ?, ?)";

    $insertStmt = mysqli_prepare($connection, $insertToCart);

    mysqli_stmt_bind_param($insertStmt, "sss", $product_id, $quantity, $email);

    mysqli_stmt_execute($insertStmt);

}

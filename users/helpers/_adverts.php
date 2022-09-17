<?php

if (!isset($_SESSION)) {
        session_start();
    }

$email = $_SESSION['s_user_id'];

// get products

$productsData = "SELECT * FROM `product` WHERE `owner` = '$email'";

$product_data_stmt = mysqli_prepare($connection, $productsData);

mysqli_stmt_execute($product_data_stmt);

$user_products = mysqli_stmt_get_result($product_data_stmt);

// get adverts

$advertData = "SELECT * FROM `advert` WHERE `owner` = '$email'";

$advert_data_stmt = mysqli_prepare($connection, $advertData);

mysqli_stmt_execute($advert_data_stmt);

$user_adverts = mysqli_stmt_get_result($advert_data_stmt);


// advert new advert

if (isset($_POST['addAdvert'])) {    
    $advert_id = mysqli_real_escape_string($connection, $_POST['advert_id']);
    $product_id = mysqli_real_escape_string($connection, $_POST['product_id']);
    $advert_price = mysqli_real_escape_string($connection, $_POST['advert_price']);

    if (empty($product_id) || empty($advert_id) || empty($advert_price)) {
        $message = "<span class='text-danger'>Inputs can't be empty</span>";
        echo "inputs cannot be emptty";
        return;
    }

    // banner upload
    $banner = "";
    if ($_FILES['banner']['error'] < 1) {
        $target_dir = "../banners/";

        $temp = explode(".", $_FILES["banner"]["name"]);
        $newfilename = $advert_id . '.' . end($temp);;
        $image_temp = $_FILES['banner']['tmp_name'];
        $image_type = strtolower(pathinfo($newfilename, PATHINFO_EXTENSION));
        $image_size = $_FILES['banner']['size']; 

        // resize image
        $maxDimW = 700;
        $maxDimH = 400;
        list($width, $height, $type, $attr) = getimagesize( $image_temp );
        if ( $width > $maxDimW || $height > $maxDimH ) {
            $target_filename = $image_temp;
            $fn = $image_temp;
            $size = getimagesize( $fn );
            $ratio = $size[0]/$size[1]; // width/height
            if( $ratio > 1) {
                $width = $maxDimW;
                $height = $maxDimH/$ratio;
            } else {
                $width = $maxDimW*$ratio;
                $height = $maxDimH;
            }
            $src = imagecreatefromstring(file_get_contents($fn));
            $dst = imagecreatetruecolor( $width, $height );
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
            imagejpeg($dst, $target_filename); // adjust format as needed
        }

        // temporary upload
        $full_dir = $target_dir . $newfilename;
        if(move_uploaded_file($image_temp, $full_dir)){
            $banner = $newfilename;
        }
    }

    $insertAdvert = "INSERT INTO `advert`(`ad_id`, `product_id`, `banner`, `advert_price`, `owner`) VALUES (?, ?, ?, ?, ?)";

    $insertAdvert = mysqli_prepare($connection, $insertAdvert);

    mysqli_stmt_bind_param($insertAdvert, 
    "sssss", $advert_id, $product_id, $banner, $advert_price, $email);

    if (mysqli_stmt_execute($insertAdvert)) {
        header("location: ?successMSG=Successfully added an advert");
    }else{
        header("location: ?errorMSG=Can't add a advert");
    }

}
<?php
    if (!isset($_SESSION)) {
            session_start();
    }

    $email = $_SESSION['s_user_id'];

    if (isset($_POST['edit_profile'])) {
        $firstname = mysqli_real_escape_string($connection, sanitizeInput($_POST['firstname']));
        $lastname = mysqli_real_escape_string($connection, sanitizeInput($_POST['lastname']));
        $phone = mysqli_real_escape_string($connection, sanitizeInput($_POST['phone']));
        $delivery_address = mysqli_real_escape_string($connection, sanitizeInput($_POST['delivery_address']));

        $avatar = getUserByEmail($email)['avatar'];

        if ($_FILES['avatar']['error'] < 1 && isset($_FILES['avatar'])) {
        $file_input = 'avatar';
        $upload_dir = 'assets/images/avatars/';

        $target_file = $upload_dir .  basename($_FILES["avatar"]["name"]);
        $image_temp = $_FILES[$file_input]['tmp_name'];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!isset($_FILES[$file_input])) {
            $msgs['imageErr'] = "Error Uploading image";
        }

        // return false if error occurred
        $error = $_FILES[$file_input]['error'];

        if ($error !== UPLOAD_ERR_OK) {
            $msgs['imageErr'] = "Error Uploading image";
        }

        // resize image
        $maxDimW = 360;
        $maxDimH = 360;
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

        // move the uploaded file to the upload_dir
        $new_file = $upload_dir . $email . '.' . $imageFileType;

        if (move_uploaded_file($image_temp, $new_file)) {
                $avatar = $new_file;
            }else{
                $avatar = getUserByEmail($email)['avatar'];
            }
        }


        $updateUserQuery = "UPDATE `users` SET `firstname`=?,`lastname`=?,`phone`=?,`avatar`=?,`delivery_address`=? WHERE `email`=?";

        $updateUser_stmt = mysqli_prepare($connection, $updateUserQuery);

        mysqli_stmt_bind_param($updateUser_stmt, "ssssss",
        $firstname, $lastname, $phone, $avatar, $delivery_address, $email);

        if (mysqli_stmt_execute($updateUser_stmt)) {
            $Msg = "<span class='text-success'>User Updated Successfully</span";
        }else{
            $Msg = "<span class='text-danger'>Can't Update user </span>";
        }
    }
?>
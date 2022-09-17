<?php
if (isset($_POST['reset'])) {
    $newpassword = mysqli_real_escape_string($connection, sanitizeInput($_POST['newpassword']));
    $cnewpassword = mysqli_real_escape_string($connection, sanitizeInput($_POST['cnewpassword']));

    $resetErrors = [];
    // validate passwords
    if (empty($newpassword)) {
        $resetErrors['passErr'] = "Password cannot be empty";
    } else if ($newpassword != $cnewpassword) {
        $resetErrors['cpassErr'] = "The two password does not match";
    }

    if (count($resetErrors) < 1) {
        // reset password
        if (updatePassword(getUserByHash($_GET['hash']), $newpassword)) {
            $resetErrors['passUpdateSucc'] = "Password Changed Successfully. <a class='app-link' href='login.php'>Login</a>";
            deleteReset($_GET['hash']);
        } else {
            $resetErrors['passUpdateErr'] = "Can't change password";
        };
    }
}


function updatePassword($email, $newpassword)
{
    $isUPdated = false;
    global $connection;
    $hashedPass = password_hash($newpassword, PASSWORD_DEFAULT, []);

    $update_q = "UPDATE `admin` SET `password`= ? WHERE `email` = ?";

    $update_stmt = mysqli_prepare($connection, $update_q);

    mysqli_stmt_bind_param($update_stmt, "ss", $hashedPass, $email);

    if (mysqli_stmt_execute($update_stmt)) {
        $isUPdated = true;
    } else {
        $isUPdated = false;
    }
    mysqli_stmt_close($update_stmt);

    return $isUPdated;
}

function isValidHash($hash)
{
    global $connection;
    $isValid = false;

    $admin_data_q = "SELECT * FROM `admin_recover` WHERE `hash` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $hash);

    mysqli_stmt_execute($admin_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

    mysqli_stmt_close($admin_data_stmt);

    $db_hash = $result['hash'];

    if ($db_hash == $hash) {
        $isValid = true;
    } else {
        $isValid = false;
    }
    return $isValid;
}


function getUserByHash($hash)
{
    global $connection;

    $admin_data_q = "SELECT * FROM `admin_recover` WHERE `hash` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $hash);

    mysqli_stmt_execute($admin_data_stmt);

    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

    return $result['email'];
}


function deleteReset($hash)
{
    global $connection;

    $admin_data_q = "DELETE FROM `admin_recover` WHERE `hash` = ?";

    $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

    mysqli_stmt_bind_param($admin_data_stmt, 's', $hash);

    mysqli_stmt_execute($admin_data_stmt);

    mysqli_stmt_close($admin_data_stmt);
}

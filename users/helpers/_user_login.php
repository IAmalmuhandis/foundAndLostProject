<?php
if (isset($_POST['loginUser'])) {
    $email = mysqli_real_escape_string($connection, sanitizeInput($_POST['email']));
    $password = mysqli_real_escape_string($connection, sanitizeInput($_POST['password']));
    // validate credentials 
    if (!user_exist($email, $password)) {
        $userMsgs['credentialErr'] = "Incorrect email or password";
    }

    if (count($userMsgs) < 1) {
        // login staff
        loginUser($email, $password);
    }
}

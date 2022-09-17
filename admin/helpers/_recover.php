<?php
if (isset($_POST['recover'])) {
  $email = mysqli_real_escape_string($connection, sanitizeInput($_POST['email']));

  $recoverErrors = [];
  // validate email
  if (empty($email)) {
    $recoverErrors['emailErr'] = "Email cannot be empty";
  } else if (!email_exist($email)) {
    $recoverErrors['emailErr'] = "Email does not exist";
  } else if (hasSentRecover($email)) {
    $recoverErrors['emailErr'] = "You can't send recover password twice. Reset password first";
  }

  if (count($recoverErrors) < 1) {
    // start recover password
    if (send_recoverMail($email)) {
      $recoverErrors['emailSucc'] = "Email successfully sent to $email, check your inbox";
    } else {
      $recoverErrors['emailErr'] = "Email sending failed, try again...";
    };
  }
}

function send_recoverMail($email)
{
  $isSent = false;
  $hash = insertRecover($email);

  $hashed = $hash;

  $to_email = $email;
  $subject = "Recover Password";
  $body = '<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Recover Password</title>
    <style>
      div {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-content: center;
        align-items: center;
      }
      a:link,
      a:visited {
        background-color: white;
        color: black;
        border: 2px solid green;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius: 3px;
      }

      a:hover,
      a:active {
        background-color: green;
        color: white;
      }
    </style>
  </head>
  <body>
    <div>
      <img src="http://localhost/studentsupport/assets/images/auk-logo.png" alt="AUK Logo" />
      <h3>Admin Password Recover</h3>
      <p>
        <strong>admin@auk.com</strong> recover your password here, ignore this
        if you did not request for this.
      </p>
      <p>Click the link below to reset your password</p>
      <a href="http://localhost/studentsupport/admin/reset-password.php?hash=' . $hashed
    . '" >Reset Password</a>
    </div>
  </body>
</html>
';
  $headers = "From: " . 'webmaster@auk.com' . "\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  $headers .= "CC: $email\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  if (mail($to_email, $subject, $body, $headers)) {
    $isSent = true;
  } else {
    $isSent = false;
  }
  return $isSent;
}

function insertRecover($email)
{

  global $connection;
  $hash = md5(rand(1, 1000));

  $recover_query = "INSERT INTO `admin_recover` (`email`, `hash`) VALUES (?, ?)";

  $recover_stmt = mysqli_prepare($connection, $recover_query);
  mysqli_stmt_bind_param($recover_stmt, 'ss', $email, $hash);

  mysqli_stmt_execute($recover_stmt);

  mysqli_stmt_close($recover_stmt);

  return $hash;
}

function hasSentRecover($email)
{
  global $connection;
  $hasSent = false;

  $admin_data_q = "SELECT * FROM `admin_recover` WHERE `email` = ?";

  $admin_data_stmt = mysqli_prepare($connection, $admin_data_q);

  mysqli_stmt_bind_param($admin_data_stmt, 's', $email);

  mysqli_stmt_execute($admin_data_stmt);

  $result = mysqli_fetch_assoc(mysqli_stmt_get_result($admin_data_stmt));

  mysqli_stmt_close($admin_data_stmt);

  if (!empty($result['email'])) {
    $hasSent = true;
  } else {
    $hasSent = false;
  }
  return $hasSent;
}

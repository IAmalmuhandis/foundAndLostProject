<?php if (!isAdminLoggedIn()) {
    header("Location: login.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $variable['title']; ?></title>

    <!-- Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="description" content="Adverto Admin" />
    <link rel="shortcut icon" href="assets/images/logo.png" />

    <link rel="stylesheet" href="assets/icons/mdi/css/materialdesignicons.min.css" />

    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css" />
</head>
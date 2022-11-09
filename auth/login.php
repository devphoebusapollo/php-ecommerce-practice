<?php

include_once('./authentication.php');
$users = $connect_database->all_users();

/* If the user is already logged in, forbid access to login.php and redirect to homepage */
if (isset($_SESSION['user'])) {
    header("Location: http://localhost/xampp/ecommerce/index.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/xampp/ecommerce/styles/styles.css">
</head>

<body>
    <!-- Display the Error message is there is. Meaning, login credetials provided are incorrect -->
    <?php if (isset($_SESSION['message'])) { ?>
        <ul>
            <li class="login-error"><?php echo $_SESSION['message'] ?></li>
        </ul>
    <?php } ?>
    <?php if (isset($_SESSION['not_logged'])) { ?>
        <ul>
            <li class="login-error"><?php echo $_SESSION['not_logged'] ?></li>
        </ul>
    <?php } ?>
    <form action="./authentication.php" method="POST">
        <div>
            <input type="text" name="username">
        </div>
        <div>
            <input type="password" name="password">
        </div>
        <button type="submit" name="login">Login</button>
    </form>
    <a class="font-bold px-8 py-2 bg-cyan-500 text-lg ml-px" href="http://localhost/xampp/ecommerce/auth/register.php">Register</a>
</body>

</html>
<?php

session_start();
include_once 'logic.php';

/* Restrict access to this page is the user is not yet logged in and redirect to homepage */
if (!isset($_SESSION['user'])) {
    $_SESSION['not_logged'] = "Please login or register first.";
    header("Location: http://localhost/xampp/ecommerce/auth/login.php");
};

/* If the user is not an admin, restrict them from accessing this page and redirect to homepage */
if (!$_SESSION['user']['is_admin']) {
    header("Location: http://localhost/xampp/ecommerce/index.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP eCommerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php require './header.php'; ?>
    <div>
        <?php foreach ($query as $q) { ?>
            <form method="post">
                <!-- Echo the current value of each in the value attribute to show them on the input -->
                <input type="hidden" name="id" value="<?php echo $q['product_id'] ?>">
                <div>Product Name: <input type="text" name="product_name" value="<?php echo $q['product_name'] ?>"></div>
                <div>Product Image: <input type="text" name="product_image" value="<?php echo $q['product_image'] ?>"></div>
                <div>Product Description: <input type="text" name="product_description" value="<?php echo $q['product_description'] ?>"></div>
                <button type="submit" name="update">Update</button>
            </form>
        <?php } ?>
    </div>
</body>

</html>
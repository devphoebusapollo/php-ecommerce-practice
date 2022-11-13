<?php
include_once 'logic.php';
include_once './auth/authentication.php';

/* Restrict access to this page is the user is not yet logged in and redirect to homepage */
if(!isset($_SESSION['user'])) {
    $_SESSION['not_logged'] = "Please login or register first.";
    header("Location: http://localhost/xampp/ecommerce/auth/login.php");
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php foreach($query as $product) { ?>
        <title><?php echo $product['product_name'] ?></title>
    <?php } ?>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center">
    <?php

    require './header.php';

    ?>
    <div class="w-3/5">
        <?php include_once 'header.php' ?>
        <div>
            <?php foreach ($query as $q) { ?>
                <h1><?php echo $q['product_name'] ?></h1>
                <div><img class="product_image" src="<?php echo $q['product_image'] ?>"></div>
                <p><?php echo $q['product_description'] ?></p>
                <form method="POST" action="http://localhost/xampp/ecommerce/logic.php">
                    <input type="hidden" name="user" value="<?php echo $_SESSION['user']['id'] ?>">
                    <input type="hidden" name="product_id" value="<?php echo $q['product_id'] ?>">
                    <input type="hidden" name="product_image" value="<?php echo $q['product_image'] ?>">
                    <input type="hidden" name="product_name" value="<?php echo $q['product_name'] ?>">
                    <input type="number" name="quantity" required><button name="add_to_cart">Add to cart</button>
                </form>
                <?php if ($_SESSION['user']['is_admin']) { ?>
                    <a href="edit-product.php?id=<?php echo $q['product_id'] ?>">Edit</a>
                    <form method="post">
                        <input type="hidden" name="product_id" value="<?php echo $q['product_id'] ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</body>

</html>
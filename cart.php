<?php require "./logic.php" ?>
<?php require "./auth/authentication.php" ?>
<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="w-3/5 mx-auto">
    <?php require "./header.php" ?>
    <div class="product-wrapper">
        <?php
        $cart_data = $result;
        $keys = array_keys($cart_data);
        ?>
        <?php for ($i = 0; $i < count($keys); $i++) { ?>

            <div class="inner-div">
                <a href="<?php echo $domain ?>/product-page.php?id=<?php echo $cart_data[$i]->product_id ?>"><img src="<?php echo $cart_data[$i]->product_image ?>" alt="<?php echo $cart_data[$i]->product_name ?>" class="cart-product-image"></a>
                <h2><?php echo $cart_data[$i]->product_name ?></h2>
                <p><?php echo $cart_data[$i]->quantity ?></p>
                <form method="POST" action="logic.php">
                    <input type="hidden" name="product_id" value="<?php echo $cart_data[$i]->product_id ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                    <button type="submit" name="delete_from_cart">Delete</button>
                </form>
            </div>
        <?php }  ?>
    </div>
</body>

</html>
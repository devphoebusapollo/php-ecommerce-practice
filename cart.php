<?php require "./logic.php" ?>
<?php require "./auth/authentication.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <?php require "./header.php" ?>
    <?php 
        $cart_data = json_decode($result['cart'], true);
        $keys = array_keys($cart_data);
    ?>
    <?php for($i = 0; $i < count($keys); $i++) { ?>
        <div>
            <img src="<?php echo $cart_data[$i]['product_image'] ?>" alt="">
            <h2><?php echo $cart_data[$i]['product_name'] ?></h2>
            <p><?php echo $cart_data[$i]['quantity'] ?></p>
        </div>
    <?php }  ?>
</body>
</html>
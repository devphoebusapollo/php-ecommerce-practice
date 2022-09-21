<?php

include_once 'logic.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP eCommerce</title>
    <link rel="stylesheet" href="http://localhost:8080/xampp/ecommerce/styles/styles.css">
</head>

<body>
    <nav>
        <h1>PHP eCommerce</h1>
        <a class="add-new-button" href="add-product.php">New Product</a>
    </nav>
    <div>

        <?php if(isset($_REQUEST['product'])){ ?>
        <?php if($_REQUEST['product'] == "added"){?>
        <div>
            Product has been added successfully
        </div>
        <?php }?>
        <?php } ?>

    </div>
    <div>
        <?php foreach($query as $q)  {?>
        <div><img class="product-image" src="<?php echo $q['product_image'] ?>"></div>
        <h2><?php echo $q['product_name'] ?></h2>
        <p><?php echo $q['product_description'] ?></p>
        <a href="product-page.php?id=<?php echo $q['product_id'] ?>">View Product</a>
        <?php } ?>
    </div>
</body>

</html>
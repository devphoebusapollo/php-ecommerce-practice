<?php
session_start();
include_once 'logic.php';
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
    <?php include_once 'header.php' ?>
    <?php if(count($error) > 0) { ?>
    <div>
        <?php echo $error['error'] ?>
    </div>
    <?php } ?>
    <h1>Add New Product</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div>Product Name: <input type="text" name="product_name"></div>
        <div>Product Image: <input type="text" name="product_image"></div>
        <div>Product Description: <input type="text" name="product_description"></div>
        <button type="submit" name="new_product">Add</button>
    </form>
</body>

</html>
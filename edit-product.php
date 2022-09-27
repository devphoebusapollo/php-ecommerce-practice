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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <?php include_once 'header.php' ?>
    <div>
        <?php foreach ($query as $q) { ?>
        <form method="post">
            <!-- Echo the current value of each in the value attribute to show them on the input -->
            <input type="hidden" name="id" value="<?php echo $q['product_id'] ?>">
            <div>Product Name: <input type="text" name="product_name" value="<?php echo $q['product_name'] ?>"></div>
            <div>Product Image: <input type="text" name="product_image" value="<?php echo $q['product_image'] ?>"></div>
            <div>Product Description: <input type="text" name="product_description"
                    value="<?php echo $q['product_description'] ?>"></div>
            <button type="submit" name="update">Update</button>
        </form>
        <?php } ?>
    </div>
</body>

</html>
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
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center">
    <div class="w-3/5">
        <?php include_once 'header.php' ?>
        <div>
            <?php foreach($query as $q)  {?>
            <h1><?php echo $q['product_name'] ?></h1>
            <div><img class="product-image" src="<?php echo $q['product_image'] ?>"></div>
            <p><?php echo $q['product_description'] ?></p>
            <a href="edit-product.php?id=<?php echo $q['product_id'] ?>">Edit</a>
            <form method="post">
                <input type="hidden" name="product_id" value="<?php echo $q['product_id'] ?>">
                <button type="submit" name="delete">Delete</button>
            </form>
            <?php } ?>
        </div>
    </div>
</body>

</html>
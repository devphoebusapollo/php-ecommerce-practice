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
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center">
    <div class="w-3/5 ">
        <div>
            <?php include_once 'header.php' ?>

            <?php if(isset($_REQUEST['product'])){ ?>
            <?php if($_REQUEST['product'] == "added"){?>
            <div>
                Product has been added successfully
            </div>
            <?php }?>
            <?php } ?>

        </div>
        <div class="w-3/5 my-8">
            <h1 class="text-3xl font-bold my-4">Our Popular Products</h1>
            <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua.</p>
        </div>
        <div class="flex justify-between flex-wrap">
            <?php foreach($query as $q)  {?>
            <div class="w-[48%] my-4">
                <a href="product-page.php?id=<?php echo $q['product_id'] ?>">
                    <div><img class="product-image w-full" src="<?php echo $q['product_image'] ?>"></div>
                    <h2 class="font-bold my-6 text-xl"><?php echo $q['product_name'] ?></h2>
                    <p><?php echo $q['product_description'] ?></p>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>
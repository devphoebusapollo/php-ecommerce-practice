<?php
include_once 'logic.php';
require "./auth/authentication.php";

?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP eCommerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex justify-center">
    <div class="w-3/5 ">
        <div>
            <?php include_once 'header.php' ?>
            <?php if (isset($_REQUEST['product'])) { ?>
                <?php if ($_REQUEST['product'] == "added") { ?>
                    <div>
                        Product has been added successfully
                    </div>
                <?php } ?>
            <?php } ?>

        </div>
        <div style="background-image: url('./assets/cover.jpg')" class="bg-cover h-4/5 box-border">
            <div class="w-3/5 place-content-center grid h-full box-border">
                <h1 class="text-7xl font-bold">SHOP WITH US</h1>
                <h2 class="my-6">Big discounts awaits you on our most popular item! Grab it while it lasts!</h2>
                <a href="#shop" class="font-bold px-8 py-2 my-3 bg-cyan-500 text-lg w-2/5 text-center">Shop Now!</a>
            </div>
        </div>
        <div class="w-3/5 my-8">
            <h1 class="text-3xl font-bold my-4">Our Popular Products</h1>
            <p class="">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div class="flex justify-between flex-wrap" id="shop">
            <?php foreach ($all_products as $q) { ?>
                <div class="w-[48%] my-4">
                    <a href="product-page.php?id=<?php echo $q['product_id'] ?>">
                        <div><img loading="lazy" class="product-image w-full" src="<?php echo $q['product_image'] ?>"></div>
                        <h2 class="font-bold my-6 text-xl"><?php echo $q['product_name'] ?></h2>
                        <p><?php echo $q['product_description'] ?></p>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    /*
    class User {
        public $name;
        public $profession;

        public function __construct($name, $profession)
        {
            $this->name = $name;
            $this->profession = $profession;
        }
    };

    $loren = new User("Loren", "Software Engineer");
    $unknown = new User("Unknown", "Software Developer");

    $array1 = array(
        $loren,
        $unknown
    );

    $encode = json_encode($array1);
    $decode = json_decode($encode, true);

    print_r($encode); 
    print_r($decode); 

    ?>

    <?php foreach($decode as $data) { ?>
        <h1 class="font-bold"><?php echo $data["name"] ?></h1>
        <br/>
        <p><?php echo $data["profession"] ?></p>
    <?php } */?>

</body>

</html>
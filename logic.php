<?php
$error = [];
$conn = mysqli_connect("localhost", "loren-practice", "pm-loren", "products");

if(!$conn) {
    echo "Error Connection";
};

$sql = "SELECT * from products";
$query = mysqli_query($conn, $sql);


//GET Product by ID
if(isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT * from products WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);
};

//Add New Product
if(isset($_REQUEST['new_product'])) {
    if($_POST['product_name'] === "" || $_POST['product_image'] === "" || $_POST['product_description'] === "") {
        $error['error'] = "Please fill out all the fields";
    } else {
    $product_name = htmlspecialchars($_REQUEST['product_name']);
    $product_image = htmlspecialchars($_REQUEST['product_image']);
    $product_description = htmlspecialchars($_REQUEST['product_description']);

    $sql = "INSERT INTO products(product_name, product_image, product_description) VALUES ('$product_name', '$product_image', '$product_description')";
    $query = mysqli_query($conn, $sql);

    header("Location: index.php?product=added");
    }
};

//Delete Product
if(isset($_REQUEST['delete'])) {
    $id = htmlspecialchars($_POST['product_id']);
    $sql = "DELETE from products WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);

    header('Location: index.php');
};

//Update Product Detail
if(isset($_REQUEST['update'])) {
    $product_name = htmlspecialchars($_REQUEST['product_name']);
    $product_image = htmlspecialchars($_REQUEST['product_image']);
    $product_description = htmlspecialchars($_REQUEST['product_description']);

    if($product_name === "") {
        $id = $_REQUEST['id'];
        $sql = "SELECT * from products WHERE product_id = $id";
        $query = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($query);
        $product_name = $product['product_name'];
        $sql = "UPDATE products SET product_name = '$product_name', product_image = '$product_image', product_description = '$product_description' WHERE product_id = $id";
        $query = mysqli_query($conn, $sql);
        header("Location: product-page.php?id=$id");
    } elseif($product_image === "") {
        $id = $_REQUEST['id'];
        $sql = "SELECT * from products WHERE product_id = $id";
        $query = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($query);
        $product_image = $product['product_image'];
        $sql = "UPDATE products SET product_name = '$product_name', product_image = '$product_image', product_description = '$product_description' WHERE product_id = $id";
        $query = mysqli_query($conn, $sql);
        header("Location: product-page.php?id=$id");
    } elseif($product_description === "") {
        $id = $_REQUEST['id'];
        $sql = "SELECT * from products WHERE product_id = $id";
        $query = mysqli_query($conn, $sql);
        $product = mysqli_fetch_assoc($query);
        $product_description = $product['product_description'];
        $sql = "UPDATE products SET product_name = '$product_name', product_image = '$product_image', product_description = '$product_description' WHERE product_id = $id";
        $query = mysqli_query($conn, $sql);
        header("Location: product-page.php?id=$id");
    }

    //If everything is supplied, proceed
    $sql = "UPDATE products SET product_name = '$product_name', product_image = '$product_image', product_description = '$product_description' WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);
    header("Location: product-page.php?id=$id");
};

?>
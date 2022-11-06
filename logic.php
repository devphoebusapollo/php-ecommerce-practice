<?php
$error = [];
$conn = mysqli_connect("localhost", "loren-practice", "pm-loren", "products");

if(!$conn) {
    echo "Error Connection";
};
//Get All Posts
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
    $id = $_REQUEST['id'];
    $product_name = htmlspecialchars($_REQUEST['product_name']);
    $product_image = htmlspecialchars($_REQUEST['product_image']);
    $product_description = htmlspecialchars($_REQUEST['product_description']);
    //If everything is supplied, proceed
    $sql = "UPDATE products SET product_name = '$product_name', product_image = '$product_image', product_description = '$product_description' WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);
    header("Location: product-page.php?id=$id");
};

function fetch_by_id($prod_id, $conn) {
    $sql = "SELECT * from products WHERE product_id = $prod_id";
    $query = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($query);
};

?>
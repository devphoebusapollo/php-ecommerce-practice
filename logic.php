<?php
$error = [];
$conn = mysqli_connect("localhost", "loren-practice", "pm-loren", "products");

if (!$conn) {
    echo "Error Connection";
};
//Get All Posts
$sql = "SELECT * from products";
$all_products = mysqli_query($conn, $sql);


//GET Product by ID
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = "SELECT * from products WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);
};

//Add New Product
if (isset($_REQUEST['new_product'])) {
    if ($_POST['product_name'] === "" || $_POST['product_image'] === "" || $_POST['product_description'] === "") {
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
if (isset($_REQUEST['delete'])) {
    $id = htmlspecialchars($_POST['product_id']);
    $sql = "DELETE from products WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);

    header('Location: index.php');
};

//Update Product Detail
if (isset($_REQUEST['update'])) {
    $id = $_REQUEST['id'];
    $product_name = htmlspecialchars($_REQUEST['product_name']);
    $product_image = htmlspecialchars($_REQUEST['product_image']);
    $product_description = htmlspecialchars($_REQUEST['product_description']);
    //If everything is supplied, proceed
    $sql = "UPDATE products SET product_name = '$product_name', product_image = '$product_image', product_description = '$product_description' WHERE product_id = $id";
    $query = mysqli_query($conn, $sql);
    header("Location: product-page.php?id=$id");
};

function fetch_by_id($prod_id, $conn)
{
    $sql = "SELECT * from products WHERE product_id = $prod_id";
    $query = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($query);
};

?>

<?php

class Cart
{
    private $connection;
    public function __construct(private $host, private $user, private $password, private $database)
    {
        $this->$host = $host;
        $this->$user = $user;
        $this->$password = $password;
        $this->$database = $database;

        if (!isset($this->connection)) {
            $this->connection = new mysqli($this->$host, $this->$user, $this->$password, $this->$database);
        };
        return $this->connection;
    }

    /* Get data from the current cart */
    public function existing_cart($user_id)
    {
        $sql = "SELECT cart FROM users WHERE id = '$user_id'";
        $query = $this->connection->query($sql);
        $result = $query->fetch_assoc();

        return $result; //Associative Array
    }


    /* Add the Product to the cart column of the user */
    public function add_to_cart($user_id, $data_from_cart, $product_data)
    {

        /* Since the $data_from_cart['cart] is an array of JSON data, we decode it to become an array of object the same as the $product_data */
        $existing = json_decode($data_from_cart);
        $new_product = json_encode(array($product_data));

        /* If no existing products from the cart, create one */
        if (!$existing) {
            $sql = "UPDATE users SET cart = '$new_product' WHERE id = '$user_id'";
            $query = $this->connection->query($sql); /* Boolean if Successful */

            return $query;
        };

        /* If there are existing products from the cart, add one */
        if ($existing) {

            array_push($existing, $product_data);
            $add_both = json_encode($existing);

            /* Update the cart column of the user with the id stored on the $user_id variable */
            $sql = "UPDATE users SET cart = '$add_both' WHERE id = '$user_id'";
            $query = $this->connection->query($sql); /* Boolean if Successful */

            return $query;
        };
    }
}


/* Initialize Database connection for database CRUD */
$cart = new Cart("localhost", "loren-practice", "pm-loren", "products");

if (isset($_REQUEST['add_to_cart'])) {

    /* Get all existing producuts from the cart */
    $data_from_cart = $cart->existing_cart($_REQUEST['user']);

    /* Make the request product data an array and by type casting, this will convert the associative array into an OBJECT where the keys are the properties */
    $product_data = (object)array(

        "product_id" => $_REQUEST['product_id'],
        "product_image" => $_REQUEST['product_image'],
        "product_name" => $_REQUEST['product_name'],
        "quantity" => $_REQUEST['quantity']
    );

    $cart->add_to_cart($_REQUEST['user'], $data_from_cart['cart'], $product_data);
};

/* Get all the products to display in the cart page */
if(isset($_REQUEST['cart'])) {
    $id = $_REQUEST['cart'];
    $result = $cart->existing_cart($id);
    return $result;
}

?>
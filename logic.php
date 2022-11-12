<?php
$error = [];
$conn = mysqli_connect("localhost", "loren-practice", "pm-loren", "products");

if(!$conn) {
    echo "Error Connection";
};
//Get All Posts
$sql = "SELECT * from products";
$all_products = mysqli_query($conn, $sql);


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

<?php 

class Cart {
    private $connection;
    public function __construct(private $host, private $user, private $password, private $database)
    {
        $this->$host = $host;
        $this->$user = $user;
        $this->$password = $password;
        $this->$database = $database;

        if(!isset($this->connection)) {
            $this->connection = new mysqli($this->$host, $this->$user, $this->$password, $this->$database);
        };
        return $this->connection;
    }

    /* Add the Product to the cart column of the user */
    public function add_to_cart($user_id, $to_cart) {

        /* Convert the data into an array befoe storing */
        $convert_to_array = array($to_cart);
        $encoded = json_encode($convert_to_array);

        /* Update the cart column of the user with the id stored on the $user_id variable */
        $sql = "UPDATE users SET cart = '$encoded' WHERE id = '$user_id'";
        $query = $this->connection->query($sql); /* Boolean if Successful */
    }

}

class Product {
    public function __construct(public $array_to_store)
    {
        $this->array_to_store = $array_to_store;
    }

}

/* Initialize Database connection for database CRUD */
$cart = new Cart("localhost", "loren-practice", "pm-loren", "products");

if(isset($_REQUEST['add_to_cart'])) {
    /* Make the request product data an array and by type casting, this will convert the associative array into an OBJECT where the keys are the properties */
    $product_data = (object)array(
        "product_id" => $_REQUEST['product_id'], 
        "product_name" => $_REQUEST['product_name'], 
        "quantity" => $_REQUEST['quantity']
    );

    /* Create a new object containing the product data */
    $add_new_to_cart = new Product($product_data);
    $cart->add_to_cart($_REQUEST['user'], $product_data);
};

?>
<?php

session_start();

class Connection
{

    private $connection;

    //Connect to the database once an new object of this class is created
    public function __construct(private $_host, private $_user, private $_password, private $_database)
    {
        $this->$_host = $_host;
        $this->$_user = $_user;
        $this->$_password = $_password;
        $this->$_database = $_database;

        if (!isset($this->connection)) {
            $this->connection = new mysqli($this->$_host, $this->$_user, $this->$_password, $this->$_database);
        };

        return $this->connection;
    }

    //ADMIN - get all the users in the database
    public function all_users()
    {
        $sql = "SELECT * from users";
        $query = $this->connection->query($sql);

        return $query;
    }

    //Check Login Credentials and Login
    public function check_login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $query = $this->connection->query($sql);

        //Check the number of rows. If the user exists in database, there must be one row. If there is, then the login credentials are correct
        if ($query->num_rows > 0) {
            $row = $query->fetch_array();
            return $row;
        } else {
            return false;
        }
    }

    //Logout
    public function logout()
    {
        session_destroy();
    }
};

$connect_database = new Connection("localhost", "loren-practice", "pm-loren", "products");

if (isset($_REQUEST['login'])) {
    $user = $connect_database->check_login($_REQUEST['username'], $_REQUEST['password']);

    /* If a user exists */
    if ($user) {
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;
        unset($_SESSION['message']);
        header("Location: http://localhost/xampp/ecommerce/index.php");
    } else {
        $_SESSION['message'] = "The Username or Password is incorrect";
        $_SESSION['loggedin'] = false;
        header("Location: http://localhost/xampp/ecommerce/login.php");
    }
};

if (isset($_REQUEST['logout'])) {
    $connect_database->logout();
    header("Location: http://localhost/xampp/ecommerce/login.php");
};

<?php

session_start();

class Connection
{

    private $connection;

    /* CONNECT TO THE DATABASE once an new object of this class is created */
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

    /* ADMIN - get all the users in the database */
    public function all_users()
    {
        $sql = "SELECT * from users";
        $all_users = $this->connection->query($sql);

        return $all_users;
    }

    /* REGISTER */
    public function register($username, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT); //Hash the password before storing to DB
        $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$hash')";
        $query = $this->connection->query($sql);

        return $query; //boolean result - meaning registration is successful
    }

    /* CHECK LOGIN CREDENTIALS AND LOGIN */
    public function check_login($username, $password)
    {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $query = $this->connection->query($sql);
        $row = $query->fetch_array();

        /* If the inputed password is the same as the hashed password on the database then proceed to login */
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            
            /* Unset the errors */
            unset($_SESSION['message']);
            unset($_SESSION['not_logged']);
        
            header("Location: http://localhost/xampp/ecommerce/index.php");
        } else {
            $_SESSION['message'] = "The Username or Password is incorrect";

            header("Location: http://localhost/xampp/ecommerce/auth/login.php");
        }
    }

    /* LOGOUT */
    public function logout()
    {
        session_unset();
        session_destroy();
    }
};

/* Create an object from the class */
$connect_database = new Connection("localhost", "loren-practice", "pm-loren", "products");

/* Register the user */
if (isset($_REQUEST['register'])) {
    $registered = $connect_database->register(htmlspecialchars($_REQUEST['username']), htmlspecialchars($_REQUEST['email']), htmlspecialchars($_REQUEST['password']));
    /* Once registered, Login the user immediately */
    if ($registered) {
        $connect_database->check_login(htmlspecialchars($_REQUEST['username']), htmlspecialchars($_REQUEST['password']));
    }
};

/* Login user */
if (isset($_REQUEST['login'])) {
    $connect_database->check_login(htmlspecialchars(trim($_REQUEST['username'])), htmlspecialchars(trim($_REQUEST['password'])));
};

/* Logout user */
if (isset($_REQUEST['logout'])) {
    $connect_database->logout();
    header("Location: http://localhost/xampp/ecommerce/auth/login.php");
};

if(isset($_SESSION['user']['is_admin'])) {
    $users = $connect_database->all_users();
}
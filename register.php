<?php

include_once('./authentication.php');
$users = $connect_database->all_users();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <form action="./authentication.php" method="POST">
        <div>
            <input type="text" name="username">
        </div>
        <div>
            <input type="email" name="email">
        </div>
        <div>
            <input type="password" name="password">
        </div>
        <button type="submit" name="register">Register</button>
    </form>
</body>

</html>
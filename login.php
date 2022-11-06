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
    <title>Document</title>
</head>

<body>
    <!-- Display the Error message is there is. Meaning, login credetials provided are incorrect -->
    <?php if (isset($_SESSION['message'])) { ?>
        <ul>
            <li><?php echo $_SESSION['message'] ?></li>
        </ul>
    <?php } ?>
    <form action="./authentication.php" method="POST">
        <div>
            <input type="text" name="username">
        </div>
        <div>
            <input type="password" name="password">
        </div>
        <button type="submit" name="login">Login</button>
    </form>
</body>

</html>
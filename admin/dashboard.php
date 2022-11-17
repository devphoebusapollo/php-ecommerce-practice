<?php require '../logic.php'; ?>
<?php require '../auth/authentication.php'; ?>
<?php include '../config.php'; ?>
<?php
/* If the user is not an admin, restrict them from accessing the dashboard */
if (!$_SESSION['user']['is_admin']) {
    header("Location:" . $domain . "index.php");
}; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/xampp/ecommerce/styles/styles.css">
</head>

<body>
    <?php require_once '../header.php'; ?>
    <h2>Users</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Emails</th>
            <th>Role</th>
        </tr>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <?php if ($user['is_admin']) { ?>
                    <td>Admin</td>
                <?php } else { ?>
                    <td>User</td>
                <?php } ?>
            <tr>
            <?php } ?>
    </table>
    <h2>Products</h2>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($all_products as $product) { ?>
            <tr>
                <td><?php echo $product['product_name'] ?></td>
                <td><?php echo $product['product_description'] ?></td>
                <td>
                    <a href="<?php echo $domain ?>/product-page.php?id=<?php echo $product['product_id'] ?>">View</a>
                    &nbsp;
                    <a href="<?php echo $domain ?>/edit-product.php?id=<?php echo $product['product_id'] ?>">Edit</a>
                </td>
            <tr>
            <?php } ?>
    </table>
</body>

</html>
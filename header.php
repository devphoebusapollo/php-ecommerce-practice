<nav class="flex justify-between py-px">
    <a href="http://localhost/xampp/ecommerce/index.php" class="text-2xl font-bold py-2 my-3 font-mono tracking-widest">PHP ECOMMERCE</a>
    <div class="my-3 flex justify-between">

        <!-- Display Login and Register Button if the user is not logged in -->
        <?php if (!isset($_SESSION['user'])) { ?>
            <a class="font-bold px-8 py-2 border-black border-2 border-solid text-lg mr-px hover:bg-cyan-500" href="http://localhost/xampp/ecommerce/auth/login.php">Login</a>
            <a class="font-bold px-8 py-2 bg-cyan-500 text-lg ml-px" href="http://localhost/xampp/ecommerce/auth/register.php">Register</a>
        <?php } ?>

        <!-- Display the Username and Logout button after the user logged in -->
        <?php if (isset($_SESSION['user'])) { ?>
            <a><?php echo $_SESSION["user"]["username"] ?></a>
            <!-- If the user is an admin, show Admin Dashboard on the menu -->
            <?php if($_SESSION['user']['is_admin']) { ?>
                <a href="http://localhost/xampp/ecommerce/admin/dashboard.php">Admin Dashboard</a>
            <?php } ?>
            <!-- Logout button -->
            <form method="POST" action="./auth/authentication.php">
                <button type="submit" name="logout">Logout</button>
            </form>
        <?php } ?>

    </div>
</nav>
<nav class="flex justify-between py-px">
    <a href="index.php" class="text-2xl font-bold py-2 my-3 font-mono tracking-widest">PHP ECOMMERCE</a>
    <div class="my-3 flex justify-between">

        <!-- Display Login and Register Button if the user is not logged in -->
        <?php if (!isset($_SESSION['user'])) { ?>
            <a class="font-bold px-8 py-2 border-black border-2 border-solid text-lg mr-px hover:bg-cyan-500" href="http://localhost/xampp/ecommerce/login.php">Login</a>
            <a class="font-bold px-8 py-2 bg-cyan-500 text-lg ml-px" href="">Register</a>
        <?php } ?>

        <!-- Display the Username and Logout button after the user logged in -->
        <?php if (isset($_SESSION['user'])) { ?>
            <a><?php echo $_SESSION["user"]["username"] ?></a>
            <form method="POST" action="./authentication.php">
                <button type="submit" name="logout">Logout</button>
            </form>
        <?php } ?>

    </div>
</nav>
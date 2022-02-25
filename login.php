<?php
session_start();
require "init.php";
if (isset($_SESSION['username'])) {
    header("location:home.php");
}


$error = [];
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = $user->checkLogin($username, $password);

    if ($login) {
        header("location:home.php");
        exit();
    } else {
        $error[] = $user->setError("Username Or Password Is Not Found !");
    }
}


?>



    <h1>Login</h1>
    <?php
    if (isset($error)) {
        foreach ($error as $err) {
            echo "<div class='error'>$err</div>";
        }
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="form">
        <input type="text" name="username" placeholder="Username" autocomplete="off" />
        <input type="password" name="password" placeholder="Password" autocomplete="new-password" />
        <input type="submit" value="Login" class="submit" />
        <a href="register.php">Register</a>
    </form>

    <?php
    require "templates/footer.php";
    ?>
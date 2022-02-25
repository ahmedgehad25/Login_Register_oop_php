<?php


require "init.php";

$error = [];
$username = $email = $fullname = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];


    if ($username == "") {
        $error[] = "Username Can't Be Empty !";
    }elseif (strlen($username) < 5) {
        $error[] = "Username Must Be 5 Character Or More !";
    }elseif ($password == "") {
        $error[] = "Password Can't Be Empty !";
    }elseif (strlen($password) < 8) {
        $error[] = "Password Must Be  8 Character Or More and Strong !";
    }elseif ($email == "") {
        $error[] = "Email Can't Be Empty !";
    }else{
        $register = $user->checkRegister($username, $password, $email, $fullname);
        if ($register) {
            header("location:login.php");
            exit();
        }else{
            $error[] = $user->setError("Username Or Email Is Exists !");
        }
    }




 
    
    
}

?>




<body>
    <h1>Register</h1>
    <?php
    if (isset($error)) {
        foreach ($error as $err) {
            echo "<div class='error'>$err</div>";
        }
    }
    ?>
    <form action="" method="post" class="form">
        <input type="text" name="username" placeholder="Username" autocomplete="off"  value="<?php echo $username ?>" />
        <input type="password" name="password" placeholder="Password" autocomplete="new-password"   />
        <input type="email" name="email" placeholder="Email" autocomplete="off"  value="<?php echo $email ?>" />
        <input type="text" name="fullname" placeholder="Full Name" value="<?php echo $fullname ?>" />
        <input type="submit" value="Register" class="submit" />
        <a href="login.php">Login</a>
    </form>


    <?php
    require "templates/footer.php";
    ?>
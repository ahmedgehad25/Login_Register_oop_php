<?php
session_start();


if (isset($_SESSION['username'])) {
    require 'init.php';
?>
    <h1>Hello <?php echo $_SESSION['username']  ?> </h1>
    <a href='logout.php' style="display: flex; justify-content: center;">logout</a>

    
<?php

    require "templates/footer.php";
}




?>
<?php
session_start();
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
}
if (isset($_SESSION['username'])) {
    //login dissapear and logout appears
    echo '<style>.login{display: none;} .logout{display: inline-block;} .cart{display: inline-block;}</style>';

} else {
    echo '<style>.login{display: inline-block;} .logout{display: none;} .cart{display: none;}</style>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/common.css">
<body>

<header>
    <div class="container">

        <img src="images/logo.png" alt="logo" class="logo">

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="books.php">Buy Books</a></li>
                <li><a href="bestsellers.php">Bestsellers</a></li>
                <li><a href="limitededition.php">Limited Edition</a></li>
                <button class="button login"><a href="login.php">Login</a></button>
                <p class="userlogged"><a class="viewinfo" href="view-info.php"><?php
                        if (isset($_SESSION['username'])) {
                            echo $_SESSION['firstname'];
                        } ?></a></p>
                <button name="Submit" value="Logout" type="submit" class="button logout"><a
                            href="index.php?logout=true">Log out</a></button>
                <p class="cart"><a href="cart.php">Cart</a></p>

            </ul>
        </nav>

    </div>
</header>
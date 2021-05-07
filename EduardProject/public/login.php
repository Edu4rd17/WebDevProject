<?php
require_once 'templates/header.php';

if (isset($_POST['submit'])) {

    try {
        require '../settings/DBconnection.php';
        require "../common.php";

        $sql = "SELECT * FROM webdevserver.users WHERE username = :username and password = :password";

        $username = $_POST['username'];
        $password = $_POST['password'];

        $statement = $connection->prepare($sql);
        $statement->bindParam(":username", $username, PDO::PARAM_STR);
        $statement->bindParam(":password", $password, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (isset($result[0])) {
            /*if (($_POST['username'] == $result[0]['username']) && ($_POST['password'] == $result[0]['password']) && $result[0]['username'] == 'admin') {
                $_SESSION = $result[0];
                $_SESSION['Active'] = true;
                $_SESSION['IsAdmin'] = true;
                header("location:onlyadmin.php");
                exit;
            }*/
            if (($_POST['username'] == $result[0]['username']) && ($_POST['password'] == $result[0]['password'])) {
                $_SESSION = $result[0];
                $_SESSION['Active'] = true;
                header("location:index.php");
                exit;
            }
        }

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }


}
?>
<link rel="stylesheet" type="text/css" href="css/login.css">
<title>Login Page</title>
</head>

<body>

<form action="" method="post" name="Login_Form">
    <fieldset>
        <div class="form-container">
            <h1>Please log in</h1>
            <hr>
            <label for="username">Username</label>
            <input name="username" type="username" placeholder="jsmith" id="username" class="form-control"
                   required autofocus>
            <label for="password">Password</label>
            <input name="password" type="password" placeholder="Password" id="password" class="form-control"
                   required>
            <div class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me">Remember me
                </label>
            </div>
            <button type="submit" name="submit" value="Login" class="loginbtn">Log in</button>

        </div>

        <div class="incorrect-credentials">
            <?php
            //$result[0] means
            if (!isset($result[0]) && isset($_POST['submit'])) {
                echo 'Incorrect username or password!';
            }
            ?>
        </div>
        <div class="form-container signin">
            <p>Don't have an account yet?<a href="register.php">Register now</a>.</p>
        </div>

    </fieldset>

</form>


<?php
$isValidUsername = false;
$isValidEmail = false;
if (isset($_POST['submit'])) {
    try {
        require_once '../settings/DBconnection.php';
        require_once '../common.php';

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
    $new_user = array(
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
        "username" => $_POST['username'],
        "email" => $_POST['email'],
        "password" => $_POST['password'],
        "age" => $_POST['age'],
        "location" => $_POST['location']
    );

    $sqlCompare = "SELECT username FROM webdevserver.users WHERE username = :username";

    $usernameCheck = $_POST['username'];
    $statementCompare = $connection->prepare($sqlCompare);
    $statementCompare->bindParam(":username", $usernameCheck, PDO::PARAM_STR);
    $statementCompare->execute();

    $result = $statementCompare->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
        $isValidUsername = true;
    }

    $sqlCompare = "SELECT email FROM webdevserver.users WHERE email = :email";

    $emailCheck = $_POST['email'];
    $statementCompare = $connection->prepare($sqlCompare);
    $statementCompare->bindParam(":email", $emailCheck, PDO::PARAM_STR);
    $statementCompare->execute();

    $result = $statementCompare->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) {
        $isValidEmail = true;
    }


    if ($isValidUsername == true && $isValidEmail == true) {
        $sql = "INSERT INTO webdevserver.users (" . implode(",", array_keys($new_user)) . ") values (:" . implode(", :", array_keys($new_user)) . ")";

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);
    }


}
?>



<?php
include 'templates/header.php';
?>

<link rel="stylesheet" type="text/css" href="css/register.css">
<title>Registration Page</title>
</head>


<body>

<form method="post">
    <fieldset>
        <div class="form-container">
            <?php if (isset($_POST['submit']) && $isValidUsername == true && $isValidEmail == true) { ?>
                <p class="welcome-text">
                    Welcome <?php echo escape($_POST['firstname']), " ", escape($_POST['lastname']); ?>. You can now
                    log in using your username & password.<a href="login.php">Log in</a></p>
            <?php } ?>

            <h1>Register</h1>
            <p>Please fill in this form to create a free account.</p>
            <hr>

            <label for="firstname">First Name</label>
            <input type="text" placeholder="John" name="firstname" id="firstname" pattern="[a-zA-z]{2,30}"
                   title="Only letters allowed. Maximum number of characters is 30!" required>
            <label for="lastname">Last Name</label>
            <input type="text" placeholder="Smith" name="lastname" id="lastname" pattern="[a-zA-z]{2,30}"
                   title="Only letters allowed. Maximum number of characters is 30!" required>
            <label for="username">Username</label>
            <?php if (isset($_POST['submit']) && $isValidUsername == false) { ?>
                <div class="already-exists">
                    <p class="user-exists">Username <?php echo escape($_POST['username']) ?> already exists. Please
                        choose
                        another one!</p>
                </div>
            <?php } ?>
            <input type="text" placeholder="jsmith" name="username" id="username" pattern="[a-zA-z0-9]{2,15}"
                   title="Only numbers and letters allowed!" required>
            <label for="email">Email Address</label>
            <?php if (isset($_POST['submit']) && $isValidEmail == false) { ?>
                <div class="already-exists">
                    <p class="email-exists">Email <?php echo escape($_POST['email']) ?> already in use. Please enter a
                        valid
                        one!</p>
                </div>
            <?php } ?>
            <input type="email" placeholder="johnsmith@gmail.com" name="email" id="email" required>
            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Password" name="password" id="password" pattern="[a-zA-z0-9]{6,30}"
                   title="Password should be at least 6 inputs long! Only numbers and letters allowed!" required>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" pattern="[0-9]" title="Only numbers allowed!" min="7" required>
            <label for="location">Location(County)</label>
            <input type="text" placeholder="Dublin" name="location" id="location" pattern="[a-zA-z]{3,20}"
                   title="Only letters allowed!">
            <hr>
            <p>By creating an account you agree to our <a href="#">Terms % Privacy</a></p>

            <button type="submit" name="submit" class="registrationbtn">Submit Registration</button>
        </div>

        <div class="form-container signin">
            <p>Already have an account? <a href="login.php">Log in</a>.</p>
        </div>
    </fieldset>
</form>


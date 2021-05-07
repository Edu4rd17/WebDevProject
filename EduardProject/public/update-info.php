<?php
require_once 'templates/header.php';
require "../settings/config.php";
require "../common.php";
?>

<link rel="stylesheet" type="text/css" href="css/update-info.css">
<title>Edit info</title>
</head>

<?php
$isValidUsername = true;
$isValidEmail = true;
if (isset($_POST['submit'])) {
    try {
        require_once "../settings/DBconnection.php";
        $user = [
            "userID" => $_POST['userID'],
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "username" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => $_POST['password'],
            "age" => $_POST['age'],
            "location" => $_POST['location'],
            "date" => $_POST['date']
        ];

        $sqlCompare = "SELECT username FROM webdevserver.users WHERE username = :username";

        $usernameCheck = $_POST['username'];
        $statementCompare = $connection->prepare($sqlCompare);
        $statementCompare->bindParam(":username", $usernameCheck, PDO::PARAM_STR);
        $statementCompare->execute();

        $result = $statementCompare->fetchAll(PDO::FETCH_ASSOC);

        if ($_POST['username'] != $_SESSION['username']) {
            $isValidUsername = false;
            if (count($result) == 0) {
                $isValidUsername = true;
            }
        }

        $sqlCompare = "SELECT email FROM webdevserver.users WHERE email = :email";

        $emailCheck = $_POST['email'];
        $statementCompare = $connection->prepare($sqlCompare);
        $statementCompare->bindParam(":email", $emailCheck, PDO::PARAM_STR);
        $statementCompare->execute();

        $result = $statementCompare->fetchAll(PDO::FETCH_ASSOC);

        if ($_POST['email'] != $_SESSION['email']) {
            $isValidEmail = false;
            if (count($result) == 0) {
                $isValidEmail = true;
            }
        }

        if ($isValidUsername == true && $isValidEmail == true) {
            $sql = "UPDATE webdevserver.users SET 
                              userID = :userID,
                              firstname = :firstname,
                              lastname = :lastname,
                              username = :username,
                              email = :email,
                              password = :password,
                              age = :age,
                              location = :location,
                              date = :date WHERE userID = :userID";

            $statement = $connection->prepare($sql);
            $statement->execute($user);
        }

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

if (isset($_GET['userID'])) {
    try {
        require_once "../settings/DBconnection.php";
        $userID = $_GET['userID'];
        $sql = "SELECT * FROM webdevserver.users WHERE userID = :userID";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
} else {
    echo "Something went wrong!";
    exit;
}
?>
<body>
<form method="post">
    <fieldset class="update-fieldset">
        <div class="form-container-two">
            <?php if (isset($_POST['submit']) && $isValidUsername == true && isset($_POST['submit']) && $isValidEmail == true) :
                $_SESSION = $user;
                $_SESSION['Active'] = true;
                ?>
                <div class="updated-successfully">
                    <p class="details-updated">Your details have been successfully updated!</p>
                </div>
            <?php endif; ?>
            <?php if (isset($_POST['done-edit'])) {
                header("location:view-info.php");
            }
            ?>
            <h2>Edit your details</h2>
            <hr>

            <?php
            foreach ($user as $key => $value) :
                ?>
                <label for="<?php echo escape($key); ?>"><?php echo escape(ucfirst($key)); ?></label>
                <?php
                if ($key === 'username') {
                    if (isset($_POST['submit']) && $isValidUsername == false) { ?>
                        <div class="already-exists">
                            <p class="user-exists">Username <?php echo escape($_POST['username']) ?> already exists.
                                Please
                                choose
                                another one!</p>
                        </div>
                    <?php } ?>
                <?php } ?>

                <?php
                if ($key === 'email') {
                    if (isset($_POST['submit']) && $isValidEmail == false) { ?>
                        <div class="already-exists">
                            <p class="email-exists">Email <?php echo escape($_POST['email']) ?> already in use. Please
                                enter a
                                valid
                                one!</p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <input type="text" name="<?php echo escape($key); ?>" userID="<?php echo $key; ?>"
                       value="<?php echo escape($value); ?>" <?php echo($key === 'userID' ? 'readonly' : null); ?> <?php echo($key === 'date' ? 'readonly' : null); ?>>
                <!--                ? 'readonly' : null doesnt allows the user to edit their userID-->
            <?php endforeach; ?>

            <div class="submit-done">
                <button class="submit-edit-btn" type="submit" name="submit">Save Details</button>
                <button class="done-editing" type="submit" name="done-edit">Done</button>
            </div>

        </div>
    </fieldset>
</form>

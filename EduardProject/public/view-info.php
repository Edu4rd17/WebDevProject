<?php
require_once 'templates/header.php';
require_once '../common.php';
require "../settings/config.php";
?>

<link rel="stylesheet" type="text/css" href="css/view-info.css">
<title>View Info</title>
</head>

<?php
/*
Delete user
*/
if (isset($_GET["userID"])) {
    try {
        require_once "../settings/DBconnection.php";

        $id = $_GET["userID"];

        $sql = "DELETE FROM webdevserver.users WHERE userID = :userID";

        $statement = $connection->prepare($sql);
        $statement->bindParam(':userID', $id);
        $statement->execute();

        session_unset();
        session_destroy();
        header("location:index.php");
        exit;

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>

<body>
<div class="table-container">
    <div class="table-box">
        <h1>The details of your account are listed below!</h1>
        <hr>
        <table class="table">
            <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Email Address</th>
                <th>Password</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date of registration</th>
            </tr>
            </thead>
            <tbody>
            <tr class="active-row">

                <?php $array = $_SESSION;
                //take the last element of the array
                if (isset($array['Active'])) {
//                    array_pop($array);
                    unset($array['Active']);
                    unset($array['bookID']);
                    unset($array['price']);
                }

                //            array_pop($array);
                //the array_slice ignores the first element of the array
                foreach (array_slice($array, 1) as $row) {
                    ?>
                    <td><?php echo escape($row); ?></td>
                <?php } ?>
            </tr>
            </tbody>
        </table>
        <hr>
        <div class="delete-edit-container">
            <div class="delete">
                <a class="delete-user" href="view-info.php?userID=<?php echo escape($array["userID"]); ?>">Delete
                    account</a>
            </div>
            <div class="edit">
                <a class="edit-user" href="update-info.php?userID=<?php echo escape($array['userID']); ?>">Edit
                    details</a>
            </div>
        </div>
        <hr>

        <div class="done">
            <input type="button" name="done" value="Done" class="done-button"
                   onClick="document.location.href='index.php'"/>
        </div>
    </div>
</div>
<?php require "templates/footer.php"; ?>

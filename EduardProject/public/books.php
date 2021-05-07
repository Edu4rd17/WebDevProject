<?php
require_once 'templates/header.php';
if (!isset($_SESSION['bookID'])) {
    $_SESSION['bookID'] = [];
}
if ($_SESSION['Active'] == false) { /* Redirects user to Login.php if not logged in. Remember, we set $_SESSION['Active'] == true in login.php*/
    header("location:login.php");
    exit;
}

?>

<?php
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    try {
        require "../settings/config.php";
        require "../common.php";
        require_once "../settings/DBconnection.php";

        $sql = "SELECT bookID, bookTitle, authorName, price FROM webdevserver.books";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
if (!isset($array)) {
    $array = [];
}

if (isset($_POST['addtocart'])) {

    $quantity = 1;
    $i = $_GET['procedure'];
    switch ($i) {
        case "add":
            if (array_key_exists($_GET['bookID'], $_SESSION['bookID'])) {
                $quantity = $_SESSION['bookID'][$_GET['bookID']];
                $quantity++;
            }
            $_SESSION['bookID'] = array_push_assoc($_SESSION['bookID'], $_GET['bookID'], $quantity);
    }

}

function array_push_assoc($array, $key, $value)
{
    $array[$key] = $value;
    return $array;
}

?>


<link rel="stylesheet" type="text/css" href="css/books.css">
<title>Books</title>
</head>

<body>
<div class="image-container">
    <div class="hero">
        <P class="herotext">No matter what type of books you like, you can find your favourite here.</P>
    </div>
</div>

<?php
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if ($result && $statement->rowCount() > 0) { ?>
        <div class="flexbox1">
            <?php
            $i = 2;
            foreach ($result as $row) { ?>
                <div class="box1">

                    <img src="images/bookimages/book<?php echo escape($row["bookID"]); ?>.png">
                    <h1><?php echo escape($row["bookTitle"]); ?></h1>
                    <p class="author">by <?php echo escape($row["authorName"]); ?></p>
                    <p class="price">$<?php echo escape($row["price"]); ?></p>
                    <form method="post" action="books.php?procedure=add&bookID=<?php echo escape($row['bookID']); ?>">
                        <button class="addtocart-button" type="submit"
                                name="addtocart" value="Add to Cart"
                                title="Add to Cart">Add to
                            cart
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>
    <?php } ?>

<?php } ?>

<?php require_once 'templates/footer.php'; ?>

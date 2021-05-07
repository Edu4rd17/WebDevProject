<?php
require_once 'templates/header.php';
require_once '../common.php';
require "../settings/config.php";
ob_start();
?>

<link rel="stylesheet" type="text/css" href="css/cart.css" xmlns="http://www.w3.org/1999/html">
<title>My Cart</title>
</head>

<?php
//if bookid in session is not empty...then do the following
$priceTotalAll = 0;
if (!empty($_SESSION['bookID'])) {
?>

<body>
<div class="cart-container">
    <h1>My Cart</h1>
    <div class="cart-items">
        <table class="styled-table">
            <thead>
            <tr>
                <th></th>
                <th>Title</th>
                <th>Author</th>
                <th>Price</th>
                <th>Quantity</th>
                <th></th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $keyArray = array_keys($_SESSION['bookID']);
            foreach ($keyArray as $row) {
                try {
                    require_once "../settings/DBconnection.php";


                    $sql = "SELECT bookID, bookTitle, authorName, price FROM webdevserver.books WHERE bookID = :bookID";

                    $id = $row;

                    $statement = $connection->prepare($sql);
                    $statement->bindParam(':bookID', $id, PDO::PARAM_STR);
                    $statement->execute();

                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

                    $bookImage = $result[0]['bookID'];
                    $bookTitle = $result[0]['bookTitle'];
                    $authorName = $result[0]['authorName'];
                    $price = $result[0]['price'];

                    $bookQuantity = $_SESSION['bookID'][$bookImage];

                    $totalPrice = $price * $_SESSION['bookID'][$row];
                    
                    if (isset($_POST['plus' . $row])) {
                        $_SESSION['bookID'][$row]++;
                        unset($_POST);
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }
                    if (isset($_POST['minus' . $row])) {
                        //if quantity gets to 0 remove item
                        $_SESSION['bookID'][$row]--;
                        unset($_POST);
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }

                    if (isset($_POST['remove']) || $_SESSION['bookID'][$row] <= 0) {
                        unset($_SESSION['bookID'][$row]);
                        unset($_POST["remove"]);
                        if (empty($_SESSION['bookID'])) {
                            header("location:cart.php");
                            exit;
                        }
                        continue;
                    }

                    $priceTotalAll = $totalPrice + $priceTotalAll;
                    $_SESSION['price'] = $priceTotalAll;

                } catch (PDOException $error) {
                    echo $sql . "<br>" . $error->getMessage();

                }

                ?>
                <?php if (isset($_POST['checkout'])) {
                    unset($_SESSION['bookID']);
                    header("location:checkout.php");
                    exit;
                }
                ?>
                <tr class="active-row">
                    <td><img src="images/bookimages/book<?php echo escape($bookImage); ?>.png"></td>
                    <td><p class="title"><?php echo escape($bookTitle); ?></p></td>
                    <td><p class="author">by <?php echo escape($authorName); ?></p></td>
                    <td><p class="price">€<?php echo escape($price); ?></p></td>
                    <td>
                        <form method="post">
                            <input type="submit" class="add-minus minus" name="minus<?php echo escape($row); ?>"
                                   value="-">
                            <input type="text" class="quantity-input"
                                   value="<?php echo escape($_SESSION['bookID'][$row]); ?>" min="1"
                                   max="5">
                            <input type="submit" class="add-minus plus" name="plus<?php echo escape($row); ?>"
                                   value="+">
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <button type="submit" class="remove-book" name="remove" value="Remove a book">Remove
                            </button>
                        </form>
                    </td>
                    <td><p class="total-price-cart">€<?php echo escape($totalPrice); ?></p></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="total-price">
        <p class="text-total">Total Price:</p>
        <p class="allprice">
            <?php echo escape($priceTotalAll); ?>
        </p>
        <form class="checkout-button" method="post">
            <button type="submit" name="checkout" value="Proceed to checkout" class="checkout">Proceed to checkout
            </button>
        </form>
    </div>
</div>
<?php } else { ?>
    <h1>Your cart is empty!</h1>
<?php } ?>







<?php
require_once 'templates/header.php';
if ($_SESSION['Active'] == false) { /* Redirects user to Login.php if not logged in. Remember, we set $_SESSION['Active'] == true in login.php*/
    header("location:login.php");
    exit;
}
?>
<link rel="stylesheet" type="text/css" href="css/bestsellers-limitededition.css">
<title>Limited Edition</title>
</head>

<body>

<div class="content">
    <h1>This page is for testing and demonstration purpose!</h1>
</div>

<?php require_once 'templates/footer.php'; ?>

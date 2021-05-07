<?php
require_once 'templates/header.php';
?>
<link rel="stylesheet" type="text/css" href="css/home.css">
<title>Home page</title>
</head>

<?php
if (isset($_SESSION['username'])) {
    echo '<style>.welcome-back{display: inline-block;} .button-register{display: none;}</style>';

} else {
    echo '<style>.welcome-back{display: none;} .button-register{display: inline-block;}</style>';
} ?>
<body>

<div class="image-container">
    <input type="button" name="submit-register" value="Register for free" class="button-register"
           onClick="document.location.href='register.php'"/>
    <p class="welcome-back">Welcome back <?php
        if (isset($_SESSION['username'])) {
            echo $_SESSION['firstname'];
        }
        ?>, we missed you!</p>
</div>
<main>
    <div class="flexbox1">
        <div class="box1">
            <h1>Eire Books</h1>
            <p class="intro">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed dictum mi.</p>

        </div>
        <div class="box2">
            <p class="description">Etiam a dolor ac nibh faucibus posuere. Proin in varius nunc. Morbi in sem ut nisi
                euismod laoreet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos
                himenaeos. Donec id pulvinar dolor. Nullam sodales arcu eu libero suscipit, nec ultrices ante placerat.
                Vestibulum finibus, arcu vel malesuada vulputate, magna augue pellentesque augue, in commodo est dui nec
                nibh. Phasellus at libero justo.</p>
            <p class="description">Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus
                mus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent a iaculis elit, et rhoncus orci.
                Ut ac libero ut mi consectetur euismod. Proin vel neque erat. Phasellus id diam id lacus accumsan
                porttitor non ut enim. In et erat finibus quam feugiat porttitor non vitae lorem. Aenean sapien odio,
                vehicula ac justo porta, ultricies fermentum neque.</p>


        </div>
    </div>
    <div class="flexbox2">
        <div class="box3">
            <img class="booksimg" src="images/limitededition.png" alt="Our pancakes">
            <h2>Most Excusive Books</h2>
            <p class="les">Duis neque enim, hendrerit ut convallis maximus, porta vitae nisl. In id odio ac risus tempor
                blandit ut ut orci. Nam felis odio, euismod id sodales ac, ullamcorper eget quam.</p>
        </div>

        <div class="box4">
            <img class="booksimg" src="images/books.png" alt="Our amazing coffee">
            <h3>No matter what type of books you like, you can find your favourite in here!</h3>
        </div>
        <div class="box5">
            <div>
                <img class="booksimg" src="images/bestsellers.png" alt="business lunch">
                <h4>Limited Edition Books</h4>
                <p class="les">Sed sapien sapien, congue id sem et, ornare blandit urna. Aenean fermentum dictum lectus
                    ac ornare. Sed sed diam porta, efficitur nunc ac, scelerisque lacus. Phasellus eget dignissim
                    tellus.</p>
            </div>
        </div>
    </div>
</main>

<?php require_once 'templates/footer.php'; ?>

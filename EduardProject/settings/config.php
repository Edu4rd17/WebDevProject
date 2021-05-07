<?php
$host = "localhost";
$username = "root";
$password = "Database2001";
$dbname = "webdevserver"; // will use later
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
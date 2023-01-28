<?php
$servername = "sysmysql8.auburn.edu";
$db = "rmj0020db";
$username = "rmj0020";
$password = "s!2023t-4rt";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

<?php
session_start();
setcookie("user", "", time() - 3600, "/");
session_destroy();


if (!headers_sent()) {
    header("Location: index.php");
    exit;
}

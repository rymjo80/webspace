<?php
session_start();
include_once('json-file-functions.php');


$stack["date"] = $_POST['date'];
$stack["recipe-id"] = $_POST['recipeId'];
$stack["meal"] = $_POST['meal'];

updateJSON("files/" . $_SESSION['user'] . "-stacks.json", $stack);

if (!headers_sent()) {
    header("Location: my-daily-stack.php?d=" . $stack['date']);
    exit;
}

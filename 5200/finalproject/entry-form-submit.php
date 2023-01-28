<?php session_start();
include_once('json-file-functions.php');

date_default_timezone_set('America/Chicago');

$journal[] = "Journal";
$journal[] = $now = date("Y-m-d H:i:s");
$journal[] = $entry = $_POST['entry'];

updateJSON("files/" . $_SESSION['user'] . "-journal.json", $journal);

if (!headers_sent()) {
    header("Location: my-food-journal.php");
    exit;
}

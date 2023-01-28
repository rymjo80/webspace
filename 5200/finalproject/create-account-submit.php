<?php
if (!validateInput()) {
    $page = "create-account.php?error=350";
}

date_default_timezone_set('America/Chicago');

$firstname = $_POST['first-name'];
$lastname = $_POST['last-name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password1 = $_POST['password-1'];
$password2 = $_POST['password-2'];
$now = date("Y-m-d H:i:s");

if (validateUser($username, $email)) {
    if ($password1 == $password2) {
        $file = fopen("files/user.csv", "a") or die("Unable to open file!");
        $add_user = [$firstname, $lastname, $email, $username, $password1];
        fputcsv($file, $add_user);
        fclose($file);
        $user_file = fopen("files/" . $username . "-journal.json", "w") or die("Unable to open file!");
        fclose($user_file);
        $user_recipes = fopen("files/" . $username . "-recipes.json", "w") or die("Unable to open file!");
        fclose($user_recipes);
        $user_stacks = fopen("files/" . $username . "-stacks.json", "w") or die("Unable to open file!");
        fclose($user_stacks);
        $page = "login.php?mes=100";
    } else {
        $page = "create-account.php?mes=300";
    }
} else {
    $page = "create-account.php?mes=301";
}

if (!headers_sent()) {
    header("Location: " . $page);
    exit;
}

function validateUser($username, $email)
{
    $csv = array_map('str_getcsv', file('files/user.csv'));
    foreach ($csv as $user) {
        if (in_array($email, $user) || in_array($username, $user)) {
            return false;
        }
    }
    return true;
}

function validateInput()
{
    foreach ($_POST as $input) {
        if ($input == "" || $input == null) {
            return false;
        }
        return true;
    }
}

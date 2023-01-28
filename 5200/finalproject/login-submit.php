<?php
session_start();

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = $_POST['remember'];
    $user = array();

    if (validate($username, $password)) {
        $user = getUser($username, $password);
        if (count($user) > 0) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['first-name'] = $user['first-name'];
            $_SESSION['last-name'] = $user['last-name'];
            $page = "index.php";
        } else {
            $page = "login.php?mes=302";
        }
    } else {
        $page = "login.php?mes=303";
    }

    if (!headers_sent()) {
        header("Location: " . $page);
        exit;
    }
}

function validate($username, $password)
{
    if ($username != "" && $username != null) {
        if ($password != "" && $password != null) {
            return true;
        }
    }

    return false;
}

function getUser($username, $password)
{
    $csv = array_map('str_getcsv', file('files/user.csv'));
    $user = array();
    for ($i = 0; $i < count($csv); $i++) {
        if (strcmp($username, trim($csv[$i][3])) == 0 && strcmp($password, trim($csv[$i][4])) == 0) {
            $user['first-name'] = trim($csv[$i][0]);
            $user['last-name'] = trim($csv[$i][1]);
            $user['email'] = trim($csv[$i][2]);
            $user['username'] = trim($csv[$i][3]);

            return $user;
        }
    }
    return $user;
}

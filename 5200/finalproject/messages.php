<?php

function getErrorArray()
{
    $error[0] = "<p class='error'>Passwords did not match.</p>";
    $error[1] = "<p class='error'>A user with that username or email already exist.</p>";
    $error[2] = "<p class='error'>Unknown error</p>";
    $error[3] = "<p class='error'>Please fill out completely.</p>";
    $error[4] = "<div class='card'><p class='error'>Please select a stack from the weekly 
    stack to edit/view the daily stack.</p></div>";

    return $error;
}

function getMessage($code)
{
    if (is_numeric($code)) {
        if ($code > 299 && $code < 400) {
            $int = $code - 300;
            $array = getErrorArray();
        } else if ($code > 99 && $code < 200) {
            $int = $code - 100;
            $array = getSuccessArray();
        }
        if ($int >= 0 && $int < count($array)) {
            return $array[$int];
        }
    }
    return "";
}

function getSuccessArray()
{
    $success[0] = "<p class='error'>New user created! Please log in.</p>";
    return $success;
}

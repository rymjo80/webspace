<?php
session_start();
if (!$_SESSION['user']) {
    header("Location: index.php");
    exit;
}
include_once('json-file-functions.php');

# Image upload - Adapted from w3schools.com
# https://www.w3schools.com/php/php_file_upload.asp
$target_dir = "recipe-images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check == false) {
        $error = "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    $error = "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 200000) {
    $error = "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $success = "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    } else {
        $error = "Sorry, there was an error uploading your file.";
    }
}



# Processing the form
# Ingredients
for ($i = 1; $i < 8; $i++) {
    $j = $i - 1;
    if ($_POST['ingredient-' . $i] != "") {
        $ingredients[$j]['name'] = trim($_POST['ingredient-' . $i]);
        $ingredients[$j]['quantity'] = trim($_POST['quantity-' . $i]) . " " . trim($_POST['uom-' . $i]);
        $j++;
    }
}

# steps
for ($k = 1; $k < 8; $k++) {
    $l = $k - 1;
    if ($_POST['step-' . $k] != "") {
        $steps[$l] = trim($_POST['step-' . $k]);
        $l++;
    }
}

# load array
$recipe["name"] = trim($_POST['recipe-name']);
$recipe["ingredients"] = $ingredients;
$recipe["steps"] = $steps;
if ($uploadOk) {
    $recipe["imageURL"] = $target_file;
} else {
    $recipe['imageURL'] = "";
}

# update json
updateJSON("files/" . $_SESSION['user'] . "-recipes.json", $recipe);

if (!headers_sent()) {
    header("Location: my-recipes.php");
    exit;
}

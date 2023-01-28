<?php 
    include("top.html"); 
    //TODO get post and set it to csv then add to file.
    
    if (isset($_POST['name'])) {
        $user[] = trim($_POST['name']);
        $user[] = $_POST['gender'];
        $user[] = trim($_POST['age']);
        $user[] = $_POST['personality'];
        $user[] = $_POST['favoriteOS'];
        $user[] = $_POST['agemin'];
        $user[] = $_POST['agemax'];
   
        $new_user = "\n" . implode(",", $user);
        file_put_contents("singles.txt", $new_user, FILE_APPEND);
    }
    
  
?>

<!-- Web Programming, Project 4 (NerdLuv)
     signup-submit.php -->

<div>
    <h1>Thank you!</h1>

    <p>Welcome to NerdLuv, <?= (isset($_POST['name']) ? $_POST['name'] : "Error: No User Saved") ?>!</p>
    <p>Now <a href="matches.php">log in to see your matches!</a>

</div>

<?php include("bottom.html"); ?>
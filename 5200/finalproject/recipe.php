<?php
session_start();
if (!$_SESSION['user']) {
    header("Location: index.php");
    exit;
}
include_once('json-file-functions.php');
?>
<!-- 
	Author: Ryan Johnson
	Class: CPSC 5200
	 
	Final Project
 -->
<?php include("top.php"); ?>
<div class="background bkg-single-recipe"></div>
<div id="wrapper">
    <div>
        <form action="add-to-stack.php" method="post">
            <p class="align-right">
                <input type="date" name="date" class="small-input" required="required">
                <input type="hidden" name="recipeId" value="<?= $_GET['id']; ?>">
                <select name="meal" class="small-input">
                    <option value="breakfast">breakfast</option>
                    <option value="lunch">lunch</option>
                    <option value="dinner">dinner</option>
                </select>
                <input type="submit" name="submit" value="Add to a Stack">
            </p>
        </form>
        <?= getRecipeCard($_GET['id']) ?>
    </div>
</div>

<?php include("bottom.php"); ?>
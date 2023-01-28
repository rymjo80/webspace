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
<div class="background bkg-recipes"></div>
<div id="wrapper">
	<div class="flex-one">
		<div class="stack">
			<h1>My Recipes</h1>
			<p><a href="add-recipe.php"><strong>+</strong> Add Recipe</a></p>
		</div>
		<div class="recipe-holder">
			<?= getSmallRecipeCards("user"); ?>
		</div>
	</div>
	<div class="flex-one">
		<h1>Community Recipes</h1>
		<div class="recipe-holder">
			<?= getSmallRecipeCards("comm"); ?>
		</div>
	</div>


</div>

<?php include("bottom.php"); ?>
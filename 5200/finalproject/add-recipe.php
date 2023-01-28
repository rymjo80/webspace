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
<div class="background bkg-add-recipe"></div>
<div id="wrapper">
    <div>
        <div class="card">
            <h1>Add Recipe</h1>
            <form name="add-recipe" action="add-recipe-submit.php" method="post" enctype="multipart/form-data">
                <p><input type="text" name="recipe-name" placeholder="Recipe Name" required="required"></p>
                <p>
                    Add Image (jpg, jpeg, png or gif only; 320px x 200px):
                    <input type="file" name="fileToUpload" id="fileToUpload">
                </p>
                <?php for ($i = 1; $i < 8; $i++) { ?>
                    <p>
                        <input type="text" name="ingredient-<?= $i; ?>" placeholder="Ingredient <?= $i; ?>" <?= ($i < 3 ? "required='required'" : "") ?>>
                        <input type="text" name="quantity-<?= $i; ?>" class="small-input" placeholder="Qty <?= $i; ?>" <?= ($i < 3 ? "required='required'" : "") ?>>
                        <select name="uom-<?= $i; ?>" class="small-input">
                            <option value="">choose</option>
                            <option value="">no unit</option>
                            <option value="pinch">pinch</option>
                            <option value="teaspoon(s)">teaspoon(s)</option>
                            <option value="tablespoon(s)">tablespoon(s)</option>
                            <option value="cup(s)">cup(s)</option>
                            <option value="lbs">lbs</option>
                        </select>
                    </p>
                <?php } ?>
                <?php for ($j = 1; $j < 8; $j++) { ?>
                    <p>
                        <input type="text" name="step-<?= $j; ?>" placeholder="Step <?= $j; ?>" <?= ($j < 3 ? "required='required'" : "") ?>>
                    </p>
                <?php } ?>
                <p class="align-right"><input type="submit" name="submit" value="Add Recipe"></p>
            </form>
        </div>
    </div>
</div>

<?php include("bottom.php"); ?>
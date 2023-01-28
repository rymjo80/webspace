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
<div class="background bkg-journal"></div>
<div id="wrapper">
	<div class="flex-one journal scrollable">
		<h1>My Food Journal</h1>
		<?= getJournalEntries("all"); ?>
	</div>
	<div class="flex-one align-right">
		<div class="card">
			<h1>Journal Entry</h1>
			<p>Food inspires more than our tastebuds...what's on your mind?</p>
			<form action="entry-form-submit.php" method="post">
				<p><textarea name="entry" required="required"></textarea><br>
				<p><input type="submit" name="submit" value="Submit Entry"></p>
			</form>
		</div>
	</div>
</div>

<?php include("bottom.php"); ?>
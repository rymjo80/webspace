<?php
session_start();
if (isset($_COOKIE['user']) && isset($_COOKIE['first-name'])) {
	$_SESSION['user'] = $_COOKIE['user'];
	$_SESSION['first-name'] = $_COOKIE['first-name'];
}
date_default_timezone_set('America/Chicago');
include_once('json-file-functions.php');
?>
<!-- 
	Author: Ryan Johnson
	Class: CPSC 5200
	 
	Final Project
 -->
<?php include("top.php"); ?>
<div class="background <?= (isset($_SESSION['user']) ? "bkg-dashboard" : "bkg-welcome") ?> "></div>
<div id="wrapper">
	<div id="welcome" <?= (isset($_SESSION['user']) ? "class='hide'" : "") ?>">
		<h1>Welcome to Menu Stack!</h1>
		<p>Please <a href="login.php">log in</a> to see your menu stacks. Don't have an account?
			<a href="create-account.php">Create an account</a> now.
		</p>
		<h2>What is Menu Stack?</h2>
		<p>Menu Stack is a toolkit for the cook-at-home chef in all of us. Users can choose
			from recipes provided by the MenuStack community or create their own. Home cooking
			should be fun and full of adventure, but the continuous chores of planning meals and
			making shopping lists is less than exciting. MenuStack.com is here to make those tasks easier.</p>
	</div>
	<div class="flex-one <?= (!isset($_SESSION['user']) ? "hide" : "") ?>">
		<div class="card title">
			<h1>Food Journal</h1>
		</div>
		<?= getJournalEntries(5); ?>

	</div>
	<div class="flex-one <?= (!isset($_SESSION['user']) ? "hide" : "") ?>">
		<div class="card title">
			<h1>Today's Stack</h1>
			<p><em><?= date("l, F j"); ?></em></p>
		</div>
		<?= getStack(date("Y-m-d"), "full"); ?>
	</div>
</div>

<?php include("bottom.php"); ?>
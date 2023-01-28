<?php
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: index.php");
	exit;
} else if (!isset($_GET['d'])) {
	header("Location: my-weekly-stack.php?mes=304");
	exit;
}
include_once("json-file-functions.php");
?>
<!-- 
	Author: Ryan Johnson
	Class: CPSC 5200
	 
	Final Project
 -->
<?php include("top.php"); ?>
<div class="background bkg-daily"></div>
<div id="wrapper">
	<div>
		<div class="card">
			<h1>My Daily Stack</h1>
			<h2><?= date("l, F j", strtotime($_GET['d'])) ?></h2>
		</div>
		<?= getStack($_GET['d'], "full"); ?>
	</div>

</div>

<?php include("bottom.php"); ?>
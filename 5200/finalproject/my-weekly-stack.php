<?php
session_start();
if (!$_SESSION['user']) {
	header("Location: index.php");
	exit;
}
include_once("json-file-functions.php");
include_once("messages.php");
date_default_timezone_set('America/Chicago');

# Get Sunday's date to start the week.
$sunday = date("Y-m-d", strtotime("-" . date('N') . "days"));
?>
<!-- 
	Author: Ryan Johnson
	Class: CPSC 5200
	 
	Final Project
 -->
<?php include("top.php"); ?>
<div class="background bkg-weekly"></div>
<div id="wrapper">
	<div class="flex-one">
		<div class="card align-center large-card">
			<h1>My Weekly Stack</h1>
		</div>
		<?= (isset($_GET['mes']) ? getMessage($_GET['mes']) : "") ?>
		<div class="stack">
			<?php
			for ($i = 0; $i < 7; $i++) {
				$day = date("Y-m-d", strtotime($sunday . "+" . $i . " days"));
			?>
				<div>
					<div class="card <?= ($day == date("Y-m-d") ? "flex-three today-stack" : "flex-one") ?>">
						<p class="align-right"><a href="my-daily-stack.php?d=<?= $day; ?>">View</a></p>
						<h2><?= date("l", strtotime($day)); ?></h2>
						<p><em><?= date("F j", strtotime($day)) ?></em></p>
					</div>
					<?= getStack($day, "small"); ?>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<?php include("bottom.php"); ?>
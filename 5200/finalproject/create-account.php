<?php
session_start();
include('messages.php');
?>
<!-- 
	Author: Ryan Johnson
	Class: CPSC 5200
	 
	Final Project
 -->
<?php include("top.php"); ?>
<div class="background bkg-create-account"></div>
<div id="wrapper">
	<div id="create-account-form">
		<h1>Create Account</h1>
		<form action="create-account-submit.php" method="POST">
			<?= (isset($_GET['mes']) ? getMessage($_GET['mes']) : "") ?>
			<p><label>First Name:</label><input type="text" name="first-name" required="required"></p>
			<p><label>Last Name:</label><input type="text" name="last-name" required="required"></p>
			<p><label>Email:</label><input type="text" name="email" required="required"></p>
			<p><label>Username:</label><input type="text" name="username" required="required"></p>
			<p><label>Password:</label><input type="password" name="password-1" required="required"></p>
			<p><label>Confirm Password:</label><input type="password" name="password-2" required="required"></p>
			<p class="align-right"><input type="submit" name="submit" value="Create Account"></p>
		</form>
	</div>
</div>

<?php include("bottom.php"); ?>
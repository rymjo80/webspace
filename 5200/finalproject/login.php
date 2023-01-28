<?php
session_start();
include('messages.php');
?>
<!-- 
	Author: Ryan Johnson
	Class: CPSC 5200
	 
	Final Project
 -->
<?php include('top.php'); ?>
<div class="background bkg-login"></div>
<div id="wrapper">
  <div id="login">
    <p id="create-account">Don't have an account? <a href="create-account.php">Create one</a> now.</p>
    <?= (isset($_GET['mes']) ? getMessage($_GET['mes']) : "") ?>
    <form name="login-form" method="post" action="login-submit.php">
      <p><label>Username:</label><input type="text" name="username" required="required"></p>
      <p><label>Password:</label><input type="password" name="password" required="required"></p>
      <p class="align-right"><input type="submit" name="submit" value="Log In"></p>
    </form>
  </div>
</div>
<?php include('bottom.php'); ?>
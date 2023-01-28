<!DOCTYPE html>
<html lang=en>

<head>
	<title>Menu Stack</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link href="images/heart.gif" type="image/gif" rel="shortcut icon" /> -->
	<link href="css/menustack.css" type="text/css" rel="stylesheet" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
	<header id="banner">
		<div class="header-left"><a href="index.php">
				<img src="images/menu-stack-logo.png" alt="menu stack logo"></a></div>
		<div class="header-right">
			<ul class="header-welcome">
				<li>Welcome<?= (isset($_SESSION['first-name']) ? ", " . $_SESSION['first-name'] : "") ?></li>
				<li>[<a href=<?= (isset($_SESSION['first-name']) ? "logout.php" : "login.php") ?>><?= (isset($_SESSION['first-name']) ? "Log out" : "Log in") ?></a>]</li>
			</ul>
			<?php (isset($_SESSION['user']) ? include('user-menu.php') : "") ?>
		</div>
	</header>
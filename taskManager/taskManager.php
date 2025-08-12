<?php
session_start();
$user = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Task Manager</title>
	<link rel="stylesheet" type="text/css" href="taskManager.css" />
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
		integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer" />

</head>

<body>
	<header>
		<div class="nav-bar black-color">
			<div class="nav-container black-color">
				<div class="nav-logo">
					<!-- Logo -->
				</div>
				<div class="nav-btn">
					<ul>
						
						<li id="nav-btn">
							<a class="nav-btn-theme" href="../user.php">Home</a>
						</li>
						<li id="nav-btn" class="logout ">
							<a href="../logOut.php">Logout</a>
						</li>
					</ul>
				</div>
				<div class="nav-menu hidden-nav-menu">
					<i class="fa-solid fa-bars"></i>
				</div>
			</div>
			<div class="menu-bar hidden-menu-bar">
				<ul>
					
					<li id="menu-btn">
						<a class="nav-btn-theme" href="user.php">Home</a>
					</li>
					<li id="menu-btn" class="register">
						<a class="nav-btn-theme" href="logOut.php">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</header>

	<!-- Main body starts here -->

	<main>

		<div class="container">
			<div class="header">
				<h2>Hello, <?php echo $user ?>!</h2>
				<p id="dateTime"></p>
			</div>
			<form id="taskForm" autocomplete="off">
				<input type="text" id="taskName" placeholder="Task Name (required)" required />
				<textarea id="taskDesc" placeholder="Description (optional)" rows="1"></textarea>
				<input type="date" id="taskDeadline" />
				<input type="text" id="taskCategory" placeholder="Category" />
				<button type="submit">Add Task</button>
			</form>
			<div id="tasksContainer"></div>
		</div>

	</main>
	<footer>
		<div class="footer-container">
			<div class="footer-logo-box">
				<div class="footer-logo"></div>
				<div class="footer-btn">
					<a href="../logOut.php" class="button">Logout</a>
				</div>
			</div>
			<div class="footer-main footer-child">
				<h1>Main</h1>
				<a href="#home">Home</a>
				<a href="index.php">About</a>
				<a href="#contact">Contact</a>
				<a href="#contact">Work with us</a>
			</div>
			<div class="footer-features footer-child">
				<h1>Features</h1>
				<a href="#features">Dashboard</a>
				<a href="#features">Task Manager</a>
				<a href="#features">Study Planner</a>
				<a href="#features">GPA Calculator</a>
				<a href="#features">Budget Planner</a>
				<a href="future-enhancement.php">Resume Builder</a>
				<a href="#features">Scholarship Finder</a>
				<a href="#features">Dictionary</a>
				<a href="#features">Motivational Quotes</a>
			</div>
			<div class="footer-legal footer-child">
				<h1>Legal</h1>
				<a href="#">Terms</a>
				<a href="#">Privacy</a>
				<a href="#">Help</a>
				<a href="#">FAQ</a>
			</div>
			<div class="footer-social footer-child">
				<h1>Social Links</h1>
				<a href="#"><i class="fa-brands fa-github"></i> Github</a>
				<a href="#"><i class="fa-brands fa-x-twitter"></i> Twitter</a>
				<a href="#"><i class="fa-brands fa-youtube"></i> Youtube</a>
				<a href="#"><i class="fa-brands fa-facebook"></i> facebook</a>
			</div>
		</div>
		<div class="bottom-section">
			<p>Made with <i class="fa-solid fa-heart"></i> by Monirul & Hafiza</p>
		</div>
	</footer>
	</main>
	<script src="taskManager.js?v=1.0"></script>
</body>

</html>
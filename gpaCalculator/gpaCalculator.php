<?php
session_start();
$user = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="gpaCalculator.css" />
	<link
		rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
		integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer" />
		<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>


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
							<a href="logOut.php">Logout</a>
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
		<section id="home">
			<div class="pure-g" id="layout">
				<div class="pure-u-1">
					<h1 class="remove-bottom" style="margin-top: 40px,">GPA Calculator</h1>
					<hr class="medium">
				</div>
				<div class="pure-u-1">
					<p hidden>If you have GPA before first enter your current information. Your GPA will update as you add your classes below.</p>
					<p hidden><input type="text" class="small" id="current-gpa" value="0.00"></input> : Current GPA</p>
					<p hidden><input type="text" class="small" id="current-hrs" value="0"></input> : Credit Hours Earned</p>

					<table id="gpa-table">
						<thead>
							<tr>
								<td></td>
								<td>Course</td>
								<td>Credit Point Assigned</td>
								<td>Grade</td>
								<td>Grade Points</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td><input type="text" class="coursename"></td>
								<td><input type="text" class="credithours small"></td>
								<td><select class="gpa_select small"></select></td>
								<td><input type="text" class="gradepoint small" readonly="readonly"></td>
							</tr>
							<tr>
								<td>2</td>
								<td><input type="text" class="coursename"></td>
								<td><input type="text" class="credithours small"></td>
								<td><select class="gpa_select small"></select></td>
								<td><input type="text" class="gradepoint small" readonly="readonly"></td>
							</tr>
							<tr>
								<td>3</td>
								<td><input type="text" class="coursename"></td>
								<td><input type="text" class="credithours small"></td>
								<td><select class="gpa_select small"></select></td>
								<td><input type="text" class="gradepoint small" readonly="readonly"></td>
							</tr>
							<tr>
								<td>4</td>
								<td><input type="text" class="coursename"></td>
								<td><input type="text" class="credithours small"></td>
								<td><select class="gpa_select small"></select></td>
								<td><input type="text" class="gradepoint small" readonly="readonly"></td>
							</tr>
							<tr>
								<td>5</td>
								<td><input type="text" class="coursename"></td>
								<td><input type="text" class="credithours small"></td>
								<td><select class="gpa_select small"></select></td>
								<td><input type="text" class="gradepoint small" readonly="readonly"></td>
							</tr>
							<tr>
								<td>6</td>
								<td><input type="text" class="coursename"></td>
								<td><input type="text" class="credithours small"></td>
								<td><select class="gpa_select small"></select></td>
								<td><input type="text" class="gradepoint small" readonly="readonly"></td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td>&nbsp;</td>
								<td>Semester:</td>
								<td><input type="text" id="semester-credit-hours" class="small"></td>
								<td>&nbsp;</td>
								<td><input type="text" id="semester-grade-points" class="small"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td hidden>Overall:</td>
								<td hidden><input type="text" id="total-credit-hours" class="small"></td>
								<td>&nbsp;</td>
								<td hidden><input type="text" id="total-grade-points" class="small"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>GPA:</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><input type="text" id="overall-gpa" class="small"></td>
							</tr>
						</tfoot>
					</table>
					<button class="gpa-btn" id="add_row">Add Class</button>
					<button class="gpa-btn" id="remove_row">Remove Class</button>
				</div>
				<div class="pure-u-1">
					<hr class="medium">
				</div>
			</div>

		</section>

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
	<script src="gpaCalculator.js"></script>
</body>

</html>
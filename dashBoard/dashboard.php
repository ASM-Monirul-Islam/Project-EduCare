<?php
session_start();
$user = $_SESSION['name'];
$userName = $_SESSION['userName'];
$content = $quickNotes = "";
// $pendingTask = "";
if (!is_dir($userName)) {
	mkdir($userName);
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$form = $_POST['formType'];

	if ($form === 'quickNotes') {
		$quickNotes = $_POST["quickNotes"];
		$fileDir = "$userName/quickNotes.txt";
		$file = fopen($fileDir, "w");
		fwrite($file, $quickNotes);
		fclose($file);
		if (file_exists($fileDir)) {
			$content = file_get_contents($fileDir);
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="dashboard.css" />
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
		<section id="home">
			<div class="heading">
				<div id="greeting-block">
					<h1 id="greeting">Hello, <?php echo $user ?></h1>
					<p id="daytime-greeting">Good Morning</p>
				</div>
				<div id="time">Loading date & time...</div>
			</div>
			<section class="cards">

				<div class="card classes-card">
					<h2>Today's Classes</h2>
					<ul id="classes-list">
						<li>9:30 AM - Web Technologies & Programming <button onclick="markAttendance(this)">Present</button></li>
						<li>2:20 PM - DLD <button onclick="markAttendance(this)">Present</button></li>
						<!-- <li>3:00 PM - English Literature <button onclick="markAttendance(this)">Present</button></li> -->
					</ul>
				</div>

				<div class="card tasks-card">
      <h2>Pending Tasks</h2>
      <ul id="pending-tasks-list">
        <!-- <li><label><input type="checkbox" class="task-checkbox"> Submit assignment on AI</label></li>
        <li><label><input type="checkbox" class="task-checkbox"> Prepare for Quiz</label></li>
        <li><label><input type="checkbox" class="task-checkbox"> Read Chapter 5 of Math</label></li> -->
      </ul>
      <input type="text" id="new-task-input" placeholder="Add new task..." />
      <button onclick="addNewTask()">Add Task</button>
    </div>


				<div class="card completed-card">
					<h2>Completed Tasks</h2>
					<ul id="completed-tasks-list"></ul>
				</div>

				<div class="card gpa-card">
					<h2>GPA Summary</h2>
					<p>Current GPA: <strong>3.79</strong></p>
				</div>

				<div class="card events-card">
					<h2>Upcoming Events</h2>
					<ul id="events-list">
						<!-- <li>Sep 20 - Science Fair <button onclick="removeEvent(this)">Done</button></li>
						<li>Oct 05 - Midterm Exams <button onclick="removeEvent(this)">Done</button></li>
						<li>Nov 15 - Winter Break <button onclick="removeEvent(this)">Done</button></li> -->
					</ul>
					<input type="text" id="new-event-input" placeholder="Add new event (e.g. Dec 01 - Project deadline)" />
					<button onclick="addNewEvent()">Add Event</button>
				</div>
				<form method="post" class="card notes-card">
					<input type="hidden" name="formType" value="quickNotes">
					<h2>Quick Notes</h2>
					<textarea id="notes" placeholder="Write your quick notes here..." name="quickNotes"><?php echo $content ?></textarea>
					<button type="submit">Save</button>
				</form>


				<div class="card studygoals-card">
					<h2>Study Goals</h2>
					<ul>
						<li>Complete chapter 8 of Physics</li>
						<li>Practice coding problems daily</li>
						<li>Review last week's lecture notes</li>
					</ul>
				</div>

				<div class="card weather-card">
					<h2>Weather</h2>
					<p id="weather-info">Loading weather...</p>
				</div>

				<div class="card quotes-card">
					<h2>Motivational Quote</h2>
					<p class="quote-text" id="quote-text">Loading...</p>
					<p class="quote-author" id="quote-author"></p>
				</div>

			</section>
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
				<a href="../index.php">About</a>
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
	<script src="dashboard.js"></script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['userName'])) {
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="user.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>


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
              <a class="nav-btn-theme" href="#">Profile</a>
            </li>
            <li id="nav-btn">
              <a class="nav-btn-theme" href="dashBoard/dashboard.php">Dashboard</a>
            </li>
            <li id="nav-btn">
              <a class="nav-btn-theme" href="#features">Features</a>
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
            <a class="nav-btn-theme" href="#">Profile</a>
          </li>
          <li id="menu-btn">
            <a class="nav-btn-theme" href="dashBoard/dashboard.php">Dashboard</a>
          </li>
          <li id="menu-btn">
            <a class="nav-btn-theme" href="#features">Features</a>
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
      <div class="user-hero-image"></div>
      <div class="welcome-message">
        <div class="welcome-msg-box">
          <p class="welcome-msg">Hello</p>
          <p class="welcome-msg"><?php echo $_SESSION['name'] ?></p>
        </div>
        <div class="welcome-msg-box">
          <p class="welcome-msg">Welcome to</p>
          <p class="welcome-msg-2">EduCare</p>
        </div>
      </div>
    </section>
    <section id="features">
      <div class="feature-container">
        <!-- <div class="feature-title">Features</div> -->
        <div class="feature-card-wrapper">
          <div class="feature-card">
            <div class="card-image dashboard-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Dashboard</div>
              <div class="short-description">
                Stay on track with tasks focus, and daily reminder
              </div>
              <a style="color: #1d233e;" href="dashBoard/dashboard.php">
                <button class="feature-btn">View Feature</button>
              </a>

            </div>
          </div>
          <div class="feature-card">
            <div class="card-image task-manager-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Task Manager</div>
              <div class="short-description">
                Let student add, view, and completes tasks with ease
              </div>
              <a href="taskManager/taskManager.php">
                <button class="feature-btn">View Feature</button>
              </a>
            </div>
          </div>

          <div class="feature-card">
            <div class="card-image budget-planner-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Budget Planner</div>
              <div class="short-description">
                Take control of your incomes with a student friendly planner
              </div>
              <a href="budgetPlanner/budgetPlanner.php">
                <button class="feature-btn">View Feature</button>
              </a>
            </div>
          </div>


          <div class="feature-card">
            <div class="card-image gpa-calc-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">GPA Calculator</div>
              <div class="short-description">
                Easily calculate your Grade Point Average
              </div>
              <a href="gpaCalculator/gpaCalculator.php">
                <button class="feature-btn">View Feature</button>
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>
  </main>
  <footer>
    <div class="footer-container">
      <div class="footer-logo-box">
        <div class="footer-logo"></div>
        <div class="footer-btn">
          <a href="logOut.php" class="button">Logout</a>
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
        <a href="dashboard.php">Dashboard</a>
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
  <script src="script.js"></script>
</body>

</html>
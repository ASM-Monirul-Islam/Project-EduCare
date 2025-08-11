<?php
include 'db.php';

function test_input($data)
{
  return htmlspecialchars(stripslashes(trim($data)));
}

$name = $userName = $email = $password = $confirmPassword = "";
$loginErr = "";
$contactName = $contactEmail = $phoneNumber = $contactMsg = "";
$contactErr="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $form = $_POST['form_type'];

  if ($form === 'register') {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $userName = test_input($_POST["userName"]);
    $password = test_input($_POST["password"]);
    $confirmPassword = test_input($_POST["confirmPassword"]);
    $password = md5($password);
    $confirmPassword = md5($confirmPassword);

    try {
      $stmt = $conn->prepare("
	INSERT INTO registration(name, userName, email,  password, confirmPassword)
	VALUES(:name, :userName, :email,  :password, :confirmPassword)
	");
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':userName', $userName);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':password', $password);
      $stmt->bindParam(':confirmPassword', $password);

      $stmt->execute();
    } catch (PDOException $e) {
      echo "failed to insert" . $e->getMessage();
    }
  } else if ($form === 'login') {
    session_start();
    $userName = test_input($_POST["userName"]);
    $password = test_input($_POST["password"]);
    $password = md5($password);
    

    try {
      $stmt = $conn->prepare("
        SELECT id, name, userName, password, email FROM registration
        WHERE userName = :userName
        ");
      $stmt->bindParam(":userName", $userName);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($user && $user['password'] === $password) {
        $_SESSION['name'] = $user['name'];
        $_SESSION['userName'] = $user['userName'];
        $_SESSION['email'] = $user['email'];
        header("Location: user.php");
        exit();
      } else {
        $loginErr = "Invalid username or password";
      }
    } catch (PDOException $e) {
      $loginErr = "Login error. Please try again.";
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
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>


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
              <a class="nav-btn-theme" href="#home">Home</a>
            </li>
            <li id="nav-btn">
              <a class="nav-btn-theme" href="#features">Features</a>
            </li>
            <li id="nav-btn">
              <a class="nav-btn-theme" href="#about">About</a>
            </li>
            <li id="nav-btn">
              <a class="nav-btn-theme" href="#contact">Contact</a>
            </li>
            <li id="nav-btn" class="login ">
              <a class="nav-btn-theme">Login</a>
            </li>
            <li id="nav-btn" class="register">
              <a class="nav-btn-theme">Register</a>
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
            <a class="nav-btn-theme" href="#home">Home</a>
          </li>
          <li id="menu-btn">
            <a class="nav-btn-theme" href="#features">Features</a>
          </li>
          <li id="menu-btn">
            <a class="nav-btn-theme" href="#about">About</a>
          </li>
          <li id="menu-btn">
            <a class="nav-btn-theme" href="#contact">Contact</a>
          </li>
          <li id="menu-btn" class="login">
            <a class="nav-btn-theme">Login</a>
          </li>
          <li id="menu-btn" class="register">
            <a class="nav-btn-theme">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <!-- Main body starts here -->

  <main>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="login-popup login-panel-hidden">
      <div class="login-card">
        <input type="hidden" name="form_type" value="login">
        <div class="login-title">EduCare - Login</div>
        <label>User Name: </label>
        <input type="text" id="userName" name="userName" required />
        <label>Password: </label>
        <input type="password" id="password" name="password" required />
        <div class="login-forgot-pass">
          <a href="#">Forgot Password?</a>
          <p>
            New to Educare?
            <a href="#" id="login-register" class="register login-close">Sign up</a>
          </p>
        </div>
        <div class="login-card-btn">
          <button type="submit" id="login-submit">Login</button>
          <button type="reset" id="login-close" class="login-close">Close</button>
        </div>
        <span class="error"><?php echo $loginErr; ?></span>
      </div>
    </form>
    <!-- Login Pop Up Menu Ends here ------------>

    <!-- Registration Menu Starts here ---------->
    <!--  -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="register-popup register-panel-hidden">
      <div class="register-card">
        <input type="hidden" name="form_type" value="register">
        <div class="register-title">EduCare - Register</div>
        <label>Full Name:</label>
        <input type="text" class="register-input name" name="name" required />
        <span class="nameErr error"></span>
        <label>User Name:</label>
        <input type="text" class="register-input userName" name="userName" required />
        <span class="userNameErr error"></span>
        <label>Email:</label>
        <input type="email" class="register-input email" name="email" required />
        <span class="emailErr error"></span>
        <label for="pass">Password:</label>
        <input type="password" class="register-input password" name="password" required />
        <span class="passwordErr error"></span>
        <label for="confirm-pass">Confirm Password:</label>
        <input type="password" class="register-input confirmPassword" name="confirmPassword" required />
        <span class="confirmPasswordErr error"></span>
        <div class="agree-checkbox">
          <input type="checkbox" required class="register-checkbox checkbox" name="checkbox" />I agree
          to the terms and conditions
        </div>
        <span class="checkboxErr error"></span>
        <div class="register-signin">
          Already have account?
          <a href="#" id="register-login" class="login register-close">Login</a>
        </div>
        <div class="register-btn">
          <button type="submit" id="register-submit">Register</button>
          <button type="reset" id="register-close" class="register-close">Close</button>
        </div>
        <span class="error finalMsg"></span>
      </div>
    </form>
    <!-- Register pop up ends here -------------->
    <section id="home">
      <div class="hero-container">
        <div class="hero-title-box">
          <div class="hero-title"></div>
        </div>
        <div class="hero-image-box">
          <div class="hero-image"></div>
        </div>
      </div>
      <div id="why-educare">
        <div class="why-container">
          <h2>Why EduCare?</h2>
          <p class="why-subtext">
            Because students deserve more than stress and scattered solutions.
          </p>
          <div class="why-card-wrapper">
            <div class="why-card">
              <i class="fas fa-book-reader"></i>
              <h3>All-in-One Solution</h3>
              <p>
                From study planners to GPA calculators, EduCare gives you
                every tool you need — in one place.
              </p>
            </div>
            <div class="why-card">
              <i class="fas fa-bell"></i>
              <h3>Smart Reminders</h3>
              <p>
                Never miss a deadline again. Set and forget — EduCare reminds
                you.
              </p>
            </div>
            <div class="why-card">
              <i class="fas fa-chart-line"></i>
              <h3>Track Your Progress</h3>
              <p>
                Visualize your academic growth and identify areas to improve
                over time.
              </p>
            </div>
            <div class="why-card">
              <i class="fas fa-money-bill-wave"></i>
              <h3>Budget Like a Pro</h3>
              <p>
                Control your student expenses with an integrated budget
                planner.
              </p>
            </div>
            <div class="why-card">
              <i class="fas fa-magnifying-glass-dollar"></i>
              <h3>Scholarship Finder</h3>
              <p>
                Get personalized scholarship recommendations that fit your
                profile and goals.
              </p>
            </div>
            <div class="why-card">
              <i class="fas fa-bolt"></i>
              <h3>Fast & Free</h3>
              <p>
                Built for speed. Designed for students. 100% free — always.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="features">
      <div class="feature-container">
        <div class="feature-title">Explore EduCare's Smart Features</div>
        <div class="feature-subtext">
          Everything you need to succeed — all in one place. Explore EduCare's
          powerful tools designed to simplify your student life, from planning
          your day to building your future.
        </div>
        <div class="feature-card-wrapper">
          <div class="feature-card">
            <div class="card-image dashboard-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Dashboard</div>
              <div class="short-description">
                Stay on track with tasks focus, and daily reminder
              </div>
              <button class="feature-btn login-first">View Feature</button>
            </div>
          </div>
          <div class="feature-card">
            <div class="card-image task-manager-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Task Manager</div>
              <div class="short-description">
                Let student add, view, and completes tasks with ease
              </div>
              <button class="feature-btn login-first">View Feature</button>
            </div>
          </div>
          <div class="feature-card">
            <div class="card-image study-planner-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Study Planner</div>
              <div class="short-description">
                Organize daily/weekly study sessions
              </div>
              <button class="feature-btn future">View Feature</button>
            </div>
          </div>
          <div class="feature-card">
            <div class="card-image budget-planner-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Budget Planner</div>
              <div class="short-description">
                Take control of your incomes with a student friendly planner
              </div>

                <button class="feature-btn login-first">View Feature</button>

            </div>
          </div>
          <div class="feature-card">
            <div class="card-image resume-builder-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Resume Builder</div>
              <div class="short-description">
                Craft your professional CV - clean & ready to impress
              </div>
              <button class="feature-btn future">View Feature</button>
            </div>
          </div>
          <div class="feature-card">
            <div class="card-image scholarship-finder-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Scholarship Finder</div>
              <div class="short-description">
                Discover scholarships that match your profile and needs
              </div>
              <button class="feature-btn future">View Feature</button>
            </div>
          </div>
          <div class="feature-card">
            <div class="card-image gpa-calc-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">GPA Calculator</div>
              <div class="short-description">
                Easily calculate your Grade Point Average
              </div>
              <button class="feature-btn login-first">View Feature</button>
            </div>
          </div>
          <div class="feature-card">
            <div class="card-image dictionary-image"></div>
            <div class="below-image-wrapper">
              <div class="card-title">Dictionary</div>
              <div class="short-description">
                Access definition and enrich your vocabulary
              </div>
              <button class="feature-btn future">View Feature</button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="about">
      <div class="about-container">
        <div class="about-text">
          <h2>About EduCare</h2>
          <p class="about-subtext">
            EduCare was born out of frustration with the scattered,
            overwhelming digital jungle students face today. We decided to fix
            that — and build a tool students actually
            <strong>love</strong> using.
          </p>
        </div>
        <div class="about-left">
          <div class="about-details">
            <div class="about-box">
              <h3>Our Mission</h3>
              <p>
                We exist to <strong>simplify</strong> your student life — from
                managing deadlines to finding scholarships — with a single,
                smart platform tailored for university students in Bangladesh.
              </p>
            </div>
            <div class="about-box">
              <h3>Our Vision</h3>
              <p>
                To become every student’s digital companion — intuitive,
                reliable, and always free.
              </p>
            </div>
            <div class="about-box">
              <h3>Built by Students</h3>
              <p>
                We’re a passionate team of students, developers, and dreamers
                using technology to make real academic impact.
              </p>
            </div>
          </div>
        </div>
        <div class="about-right">
          <div class="about-img"></div>
          <div class="CTA-box">
            <a href="#home" class="about-cta login">Get Started</a>
          </div>
        </div>
      </div>
    </section>

    <section id="contact">
      <div class="contact-container">
        <div class="contact-left">
          <div class="contact-text">
            <p class="first-para">Contact Us</p>
            <p class="sec-para">
              We are available for questions, feedback, or collaboration
              opportunities. Let us know how we can help!
            </p>
            <div class="contact-details">
              <p>You can also contact us at:</p>
              <div class="c-phone">
                <i class="fa-solid fa-mobile-screen"></i>
                01401411046, 01607311921
              </div>
              <div class="c-email">
                <i class="fa-solid fa-envelope"></i>
                educare@gmail.com
              </div>
            </div>
          </div>
          <div class="contact-images">
            <div class="image1"></div>
            <div class="image2"></div>
          </div>
        </div>
        <div class="contact-right">
          <form method="post" action="sendEmail.php" class="contact-form">
            <input type="hidden" name="form_type" value="contact">
            <label for="name">Name</label>
            <input type="text" placeholder="Your Name" id="contact-name" name="contactName" required/>
            <label for="email">Email</label>
            <input type="email" placeholder="Email" id="contact-email" name="contactEmail" required/>
            <label for="mobile">Subject</label>
            <input
              type="text"
              placeholder="write the subject"
              id="contact-number" name="subject" required/>
            <label for="msg">Message</label>
            <textarea name="contactMsg" id="contact-msg" required placeholder="Type your message here"></textarea>
            <button type="submit" id="send-msg">Send Message</button>
          </form>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <div class="footer-container">
      <div class="footer-logo-box">
        <div class="footer-logo"></div>
        <div class="footer-btn">
          <a id="footer-login" class="login button ">Login</a>
          <a id="footer-register" class="register button ">Register</a>
        </div>
      </div>
      <div class="footer-main footer-child">
        <h1>Main</h1>
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <a href="#">Work with us</a>
      </div>
      <div class="footer-features footer-child">
        <h1>Features</h1>
        <a href="#">Dashboard</a>
        <a href="#">Task Manager</a>
        <a href="#">Study Planner</a>
        <a href="#">GPA Calculator</a>
        <a href="#">Budget Planner</a>
        <a href="future-enhancement.php">Resume Builder</a>
        <a href="#">Scholarship Finder</a>
        <a href="#">Dictionary</a>
        <a href="#">Motivational Quotes</a>
      </div>
      <div class="footer-legal footer-child">
        <h1>Legal</h1>
        <a href="#">Terms</a>
        <a href="#">Privacy</a>
        <a href="#">Help</a>
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
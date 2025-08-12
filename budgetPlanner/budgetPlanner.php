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
	<link rel="stylesheet" type="text/css" href="budgetPlanner.css" />
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
			<h2 id="greeting">Hello, User!</h2>
			<p id="dateTime"></p>

			<label for="income">Monthly Income (Tk):</label>
			<input type="number" id="income" placeholder="Enter your income" min="0" />

			<label for="expenseName">Expense Name:</label>
			<input type="text" id="expenseName" placeholder="E.g., Rent, Food" />

			<label for="expenseAmount">Expense Amount (Tk):</label>
			<input type="number" id="expenseAmount" placeholder="Enter expense amount" min="0" />

			<button id="addExpenseBtn">Add Expense</button>

			<ul class="expense-list" id="expenseList"></ul>

			<div class="result" id="summary" style="display:none;">
				<p>Total Expenses: <span id="totalExpenses">0</span> Tk</p>
				<p>Remaining Balance: <span id="balance">0</span> Tk</p>
			</div>
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
	<script>
  // ======== DEMO USER LOGIN (Replace with Educare Login Variable) ========
  let loggedInUser = "<?php echo $user ?>"; // Example: dynamically from Educare

  // ======== GREETING & DATE-TIME ========
  function updateGreeting() {
    let hour = new Date().getHours();
    let greet = "Hello";
    if (hour < 12) greet = "Good Morning";
    else if (hour < 18) greet = "Good Afternoon";
    else greet = "Good Evening";
    document.getElementById('greeting').textContent = `${greet}, ${loggedInUser}!`;
  }

  function updateDateTime() {
    const dt = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = dt.toLocaleDateString(undefined, options);
    const timeString = dt.toLocaleTimeString();
    document.getElementById('dateTime').textContent = `${dateString}, ${timeString}`;
  }
  setInterval(updateDateTime, 1000);
  updateGreeting();
  updateDateTime();

  // ======== BUDGET PLANNER LOGIC ========
  const incomeInput = document.getElementById('income');
  const expenseNameInput = document.getElementById('expenseName');
  const expenseAmountInput = document.getElementById('expenseAmount');
  const addExpenseBtn = document.getElementById('addExpenseBtn');
  const expenseList = document.getElementById('expenseList');
  const summary = document.getElementById('summary');
  const totalExpensesEl = document.getElementById('totalExpenses');
  const balanceEl = document.getElementById('balance');

  let expenses = [];

  // Save & Load Data per User
  function getUserKey() {
    return `budget_${loggedInUser}`;
  }
  function saveData() {
    const data = {
      income: Number(incomeInput.value) || 0,
      expenses
    };
    localStorage.setItem(getUserKey(), JSON.stringify(data));
  }
  function loadData() {
    const saved = localStorage.getItem(getUserKey());
    if (saved) {
      const data = JSON.parse(saved);
      incomeInput.value = data.income || '';
      expenses = data.expenses || [];
      renderExpenses();
      updateSummary();
    }
  }

  function updateSummary() {
    const income = Number(incomeInput.value) || 0;
    const totalExpenses = expenses.reduce((sum, exp) => sum + exp.amount, 0);
    const balance = income - totalExpenses;

    totalExpensesEl.textContent = totalExpenses.toFixed(2);
    balanceEl.textContent = balance.toFixed(2);
    summary.style.display = income > 0 ? 'block' : 'none';

    saveData();
  }

  function renderExpenses() {
    expenseList.innerHTML = '';
    expenses.forEach(exp => {
      const li = document.createElement('li');
      li.textContent = exp.name;
      const span = document.createElement('span');
      span.textContent = exp.amount.toFixed(2) + ' Tk';
      li.appendChild(span);
      expenseList.appendChild(li);
    });
  }

  function addExpense() {
    const name = expenseNameInput.value.trim();
    const amount = Number(expenseAmountInput.value);

    if (!name) {
      alert("Please enter the expense name.");
      return;
    }
    if (!amount || amount <= 0) {
      alert("Please enter a valid expense amount.");
      return;
    }

    expenses.push({ name, amount });
    expenseNameInput.value = '';
    expenseAmountInput.value = '';
    renderExpenses();
    updateSummary();
  }

  addExpenseBtn.addEventListener('click', addExpense);
  incomeInput.addEventListener('input', updateSummary);

  // Load user-specific data on page load
  loadData();
</script>

</body>

</html>
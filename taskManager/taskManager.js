const navBar = document.querySelector(".nav-bar");
const menu = document.querySelector(".nav-menu");
const bar = '<i class="fa-solid fa-bars"></i>';
const cross = '<i class="fa-solid fa-xmark fa-2xl"></i>';
const menuBar = document.querySelector(".menu-bar");

let isBar = true;

function menuBartoggle() {
  if (isBar) {
    menu.innerHTML = cross;
    navBar.classList.add("nav-bar-hidden");
    menuBar.classList.remove("hidden-menu-bar");
  } else {
    menu.innerHTML = bar;
    navBar.classList.remove("nav-bar-hidden");
    menuBar.classList.add("hidden-menu-bar");
  }
  isBar = !isBar;
}

menu.addEventListener("click", () => {
  menuBartoggle();
});

// Navigator button

const btn = document.querySelectorAll("#menu-btn");
btn.forEach((e) => {
  e.addEventListener("click", () => {
    menuBartoggle();
  });
});


 // Show current date and time
  function updateDateTime() {
    const dt = new Date();
    // Format example: Monday, 11 August 2025, 11:23:45 AM
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = dt.toLocaleDateString(undefined, options);
    const timeString = dt.toLocaleTimeString();
    document.getElementById('dateTime').textContent = dateString + ', ' + timeString;
  }
  setInterval(updateDateTime, 1000);
  updateDateTime();

  // Task Manager code (same as before)
  let tasks = [];
  let editingId = null;

  const taskForm = document.getElementById('taskForm');
  const tasksContainer = document.getElementById('tasksContainer');
  const taskNameInput = document.getElementById('taskName');
  const taskDescInput = document.getElementById('taskDesc');
  const taskDeadlineInput = document.getElementById('taskDeadline');
  const taskCategoryInput = document.getElementById('taskCategory');

  function loadTasks() {
    const saved = localStorage.getItem('tasks');
    if (saved) tasks = JSON.parse(saved);
  }

  function saveTasks() {
    localStorage.setItem('tasks', JSON.stringify(tasks));
  }

  function generateId() {
    return '_' + Math.random().toString(36).substr(2, 9);
  }

  function clearForm() {
    taskForm.reset();
    editingId = null;
    taskForm.querySelector('button').textContent = 'Add Task';
  }

  function renderTasks() {
    tasksContainer.innerHTML = '';
    if (tasks.length === 0) {
      tasksContainer.innerHTML = '<p style="text-align:center; color:#888;">No tasks added yet.</p>';
      return;
    }
    tasks.forEach(task => {
      const card = document.createElement('div');
      card.classList.add('task-card');

      const title = document.createElement('h3');
      title.classList.add('task-title');
      title.textContent = task.name;
      card.appendChild(title);

      if (task.description) {
        const desc = document.createElement('p');
        desc.classList.add('task-desc');
        desc.textContent = task.description;
        card.appendChild(desc);
      }

      const details = document.createElement('p');
      details.classList.add('task-details');
      details.innerHTML = `
        <strong>Deadline:</strong> ${task.deadline || 'N/A'} <br />
        <strong>Category:</strong> ${task.category || 'None'} <br />
        <strong>Status:</strong> <span class="status ${statusClass(task.status)}">${task.status}</span>
      `;
      card.appendChild(details);

      const actions = document.createElement('div');
      actions.classList.add('task-actions');

      const statusSelect = document.createElement('select');
      ['Pending', 'In Progress', 'Completed'].forEach(statusOption => {
        const option = document.createElement('option');
        option.value = statusOption;
        option.textContent = statusOption;
        if (task.status === statusOption) option.selected = true;
        statusSelect.appendChild(option);
      });
      statusSelect.addEventListener('change', () => {
        task.status = statusSelect.value;
        saveTasks();
        renderTasks();
      });
      actions.appendChild(statusSelect);

      const editBtn = document.createElement('button');
      editBtn.classList.add('btn-edit');
      editBtn.textContent = 'Edit';
      editBtn.onclick = () => {
        editingId = task.id;
        taskNameInput.value = task.name;
        taskDescInput.value = task.description;
        taskDeadlineInput.value = task.deadline;
        taskCategoryInput.value = task.category;
        taskForm.querySelector('button').textContent = 'Update Task';
        window.scrollTo({top: 0, behavior: 'smooth'});
      };
      actions.appendChild(editBtn);

      const deleteBtn = document.createElement('button');
      deleteBtn.classList.add('btn-delete');
      deleteBtn.textContent = 'Delete';
      deleteBtn.onclick = () => {
        if (confirm('Are you sure you want to delete this task?')) {
          tasks = tasks.filter(t => t.id !== task.id);
          saveTasks();
          renderTasks();
        }
      };
      actions.appendChild(deleteBtn);

      card.appendChild(actions);
      tasksContainer.appendChild(card);
    });
  }

  function statusClass(status) {
    if (status === 'Pending') return 'status-pending';
    if (status === 'In Progress') return 'status-inprogress';
    if (status === 'Completed') return 'status-completed';
    return '';
  }

  taskForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const name = taskNameInput.value.trim();
    const description = taskDescInput.value.trim();
    const deadline = taskDeadlineInput.value;
    const category = taskCategoryInput.value.trim();

    if (!name) {
      alert('Please enter task name');
      return;
    }

    if (editingId) {
      const index = tasks.findIndex(t => t.id === editingId);
      if (index !== -1) {
        tasks[index].name = name;
        tasks[index].description = description;
        tasks[index].deadline = deadline;
        tasks[index].category = category;
      }
      editingId = null;
      taskForm.querySelector('button').textContent = 'Add Task';
    } else {
      tasks.push({
        id: generateId(),
        name,
        description,
        deadline,
        category,
        status: 'Pending'
      });
    }

    saveTasks();
    renderTasks();
    clearForm();
  });

  // Initialize
  loadTasks();
  renderTasks();

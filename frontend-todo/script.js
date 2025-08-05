const newTaskInput = document.getElementById("new-task");
const addTaskBtn = document.getElementById("add-task");
const taskList = document.getElementById("task-list");
const themeToggleBtn = document.getElementById("theme-toggle");

addTaskBtn.addEventListener("click", () => {
  const text = newTaskInput.value.trim();
  if (text !== "") {
    createTaskElement(text);
    newTaskInput.value = "";
  }
});

function createTaskElement(text) {
  const li = document.createElement("li");
  li.className = "task";

  const span = document.createElement("span");
  span.textContent = text;

  const actions = document.createElement("div");
  actions.className = "actions";

  const completeBtn = document.createElement("button");
  completeBtn.textContent = "✓";
  completeBtn.title = "Mark as completed";
  completeBtn.addEventListener("click", () => {
    li.classList.toggle("completed");
  });

  const editBtn = document.createElement("button");
  editBtn.textContent = "✏️";
  editBtn.title = "Edit task";
  editBtn.addEventListener("click", () => {
    const newText = prompt("Edit task:", span.textContent);
    if (newText && newText.trim() !== "") {
      span.textContent = newText.trim();
    }
  });

  const deleteBtn = document.createElement("button");
  deleteBtn.textContent = "🗑️";
  deleteBtn.title = "Delete task";
  deleteBtn.addEventListener("click", () => {
    li.remove();
  });

  actions.appendChild(completeBtn);
  actions.appendChild(editBtn);
  actions.appendChild(deleteBtn);

  li.appendChild(span);
  li.appendChild(actions);

  taskList.appendChild(li);
}

document.querySelectorAll(".task").forEach((task) => {
  const [completeBtn, editBtn, deleteBtn] = task.querySelectorAll("button");

  completeBtn.addEventListener("click", () => {
    task.classList.toggle("completed");
  });

  editBtn.addEventListener("click", () => {
    const span = task.querySelector("span");
    const newText = prompt("Edit task:", span.textContent);
    if (newText && newText.trim() !== "") {
      span.textContent = newText.trim();
    }
  });

  deleteBtn.addEventListener("click", () => {
    task.remove();
  });
});

themeToggleBtn.addEventListener("click", () => {
  document.body.classList.toggle("dark-mode");
  document.body.classList.toggle("light-mode");
  themeToggleBtn.textContent = document.body.classList.contains("dark-mode")
    ? "☀️ Light Mode"
    : "🌙 Dark Mode";
});

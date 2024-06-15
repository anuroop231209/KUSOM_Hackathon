document.addEventListener('DOMContentLoaded', () => {
  const todoForm = document.getElementById('todo-form');
  const todoInput = document.getElementById('todo-input');
  const todoList = document.getElementById('todo-list');

  todoForm.addEventListener('submit', (e) => {
      e.preventDefault();
      addTodo(todoInput.value);
      todoInput.value = '';
  });

  function addTodo(task) {
      const li = document.createElement('li');
      li.textContent = task;

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.classList.add('delete');
      deleteButton.addEventListener('click', () => {
          li.remove();
      });

      li.appendChild(deleteButton);
      li.addEventListener('click', () => {
          li.classList.toggle('completed');
      });

      todoList.appendChild(li);
  }
});




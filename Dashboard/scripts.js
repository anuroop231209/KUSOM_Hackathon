document.getElementById('add-task').addEventListener('click', function() {
  const taskInput = document.getElementById('new-task');
  const taskText = taskInput.value.trim();
  
  if (taskText !== '') {
      addTask(taskText);
      taskInput.value = '';
  }
});
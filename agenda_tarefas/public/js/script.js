function openModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
      modal.style.display = 'block';
  } else {
      console.error(`Modal com ID ${modalId} não encontrado.`);
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId);
  if (modal) {
      modal.style.display = 'none';
  } else {
      console.error(`Modal com ID ${modalId} não encontrado.`);
  }
}

function openEditModal(taskId, taskName, taskDesc, taskStatus) {
  // Preencher os campos do modal com os dados da tarefa
  document.getElementById('edit-task-id').value = taskId;
  document.getElementById('edit-task-name').value = taskName;
  document.getElementById('edit-task-desc').value = taskDesc;
  document.getElementById('edit-task-status').value = taskStatus;
  
  // Exibir o modal
  document.getElementById('editTaskModal').style.display = 'block';
}

function deleteTask(taskId) {
  if (confirm("Tem certeza que deseja excluir esta tarefa?")) {
    fetch('../src/tasks/delete.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ task_id: taskId }),
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert("Tarefa excluída com sucesso!");
          location.reload();
        } else {
          alert(data.message || "Erro ao excluir a tarefa.");
        }
      })
      .catch(error => {
        console.error("Erro ao excluir a tarefa:", error);
        alert("Ocorreu um erro ao tentar excluir a tarefa.");
      });
  }
}

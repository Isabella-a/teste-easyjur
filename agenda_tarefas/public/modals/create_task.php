<div id="createTaskModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('createTaskModal')">&times;</span>
        <h2>Criar Nova Tarefa</h2>
        <form id="create-task-form" action="../src/tasks/create.php" method="POST">
            <div class="form-group">
                <label for="task-name">Nome:</label>
                <input type="text" id="task-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="task-desc">Descrição:</label>
                <textarea id="task-desc" name="description" required></textarea>
            </div>
            <button type="submit">Salvar</button>
        </form>
    </div>
</div>

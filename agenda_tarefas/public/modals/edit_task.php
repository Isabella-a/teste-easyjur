<div id="editTaskModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal('editTaskModal')">&times;</span>
        <h2>Editar Tarefa</h2>
        <form id="edit-task-form" action="../src/tasks/update.php" method="POST">
            <input type="hidden" id="edit-task-id" name="task_id">
            <div class="form-group">
                <label for="edit-task-name">Nome:</label>
                <input type="text" id="edit-task-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit-task-desc">Descrição:</label>
                <textarea id="edit-task-desc" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="edit-task-status">Status:</label>
                <select id="edit-task-status" name="status" required>
                    <option value="1">Pendente</option>
                    <option value="2">Concluída</option>
                </select>
            </div>
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</div>

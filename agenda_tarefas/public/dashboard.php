<?php
require dirname(__DIR__) . '/src/db/connection.php';
  session_start();

  if (!isset($_SESSION['user_id'])) {
      header('Location: ../src/auth/login.php');
      exit();
  }

  $user_id = $_SESSION['user_id'];
  
  $stmt = $conn->prepare("SELECT * FROM tarefas WHERE usuario_id = :user_id");
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();
  $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/style.css">
    <script src="../public/js/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Dashboard</title>
</head>

<body>
    <div class='main-content'>

        <h2 class='main-title'>Minhas Tarefas</h2>
        <?php include 'modals/create_task.php'; ?>
    
        <button class='btn-create' onclick="openModal('createTaskModal')">Criar Tarefa</button>

        <div class="table-content">
            <table class='tasks-table'>
                <thead class='header-table'>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data Criação</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody class='body-table'>
                    <?php foreach ($tarefas as $tarefa): ?>
                        <tr class='line-table'>
                            <td><?= $tarefa['nome'] ?></td>
                            <td><?= $tarefa['descricao'] ?></td>
                            <td><?= $tarefa['data_criacao'] ?></td>
                            <td class="<?php echo $tarefa['status'] === 'Concluída' ? 'status-concluido' : 'status-pendente'; ?>"> <?php echo htmlspecialchars($tarefa['status']); ?> </td>
                            <td class='btns-actions'>
                              <button class="btn-edit" onclick="openEditModal(
                                '<?= $tarefa['id'] ?>',
                                '<?= addslashes($tarefa['nome']) ?>',
                                '<?= addslashes($tarefa['descricao']) ?>',
                                '<?= $tarefa['status'] ?>'
                                )">Editar
                              </button>
                              <button class="btn-delete" onclick="deleteTask('<?= $tarefa['id'] ?>')">Excluir</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    
        <!-- Modal de Edição -->
        <?php include 'modals/edit_task.php'; ?>
    
        <script src="scripts.js"></script>
    
        <div class="export-buttons">
          <a href="../src/tasks/export_excel.php" target="_blank" class="btn-export">Exportar para Excel</a>
          <a href="../src/tasks/export_pdf.php" target="_blank" class="btn-export">Exportar para PDF</a>
        </div>
    </div>

</body>
</html>

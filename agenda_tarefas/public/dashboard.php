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
    <title>Dashboard</title>
</head>

<body>
    <h2>Minhas Tarefas</h2>
    <?php include 'modals/create_task.php'; ?>

    <button onclick="openModal('createTaskModal')">Criar Tarefa</button>

    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Data Criação</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tarefas as $tarefa): ?>
                <tr>
                    <td><?= $tarefa['nome'] ?></td>
                    <td><?= $tarefa['descricao'] ?></td>
                    <td><?= $tarefa['data_criacao'] ?></td>
                    <td><?= $tarefa['status'] ?></td>
                    <td>
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

    <!-- Modal de Edição -->
    <?php include 'modals/edit_task.php'; ?>

    <script src="scripts.js"></script>

    <div class="export-buttons">
      <a href="../src/tasks/export_excel.php" target="_blank" class="btn-export">Exportar para Excel</a>
      <a href="../src/tasks/export_pdf.php" target="_blank" class="btn-export">Exportar para PDF</a>
    </div>

</body>
</html>

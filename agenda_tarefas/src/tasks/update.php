<?php
  require '../db/connection.php';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $task_id = $_POST['task_id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      $status = $_POST['status'];

      try {
          $stmt = $conn->prepare("UPDATE tarefas SET nome = :name, descricao = :description, status = :status WHERE id = :task_id");
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':description', $description);
          $stmt->bindParam(':status', $status);
          $stmt->bindParam(':task_id', $task_id);
          $stmt->execute();
          header('Location: ../../public/dashboard.php');
          exit;
      } catch (PDOException $e) {
          echo "Erro ao atualizar tarefa: " . $e->getMessage();
      }
  }
?>

<?php
  require '../db/connection.php';
  session_start();
  
  // Verifique se o usuário está logado
  if (!isset($_SESSION['user_id'])) {
    // Exibe uma mensagem de erro e um botão para redirecionar para a página de login
    echo "
    <div style='text-align: center;'>
        <p>Erro: Usuário não está logado. Por favor, faça o login.</p>
        <a href='../auth/login.php'>
            <button style='padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer;'>
                Ir para o Login
            </button>
        </a>
    </div>";
    exit; // Impede que o código posterior seja executado
  }

  // Obter o ID do usuário da sessão
  $usuario_id = $_SESSION['user_id'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'];
      $description = $_POST['description'];
      $status = 'Pendente'; // Status inicial

      try {
          $stmt = $conn->prepare("INSERT INTO tarefas (nome, descricao, status, data_criacao, usuario_id) VALUES (:name, :description, :status, NOW(), :usuario_id)");
          $stmt->bindParam(':name', $name);
          $stmt->bindParam(':description', $description);
          $stmt->bindParam(':status', $status);
          $stmt->bindParam(':usuario_id', $usuario_id);
          $stmt->execute();
          header('Location: ../../public/dashboard.php');
          exit;
      } catch (PDOException $e) {
          echo "Erro ao criar tarefa: " . $e->getMessage();
      }
  }
?>

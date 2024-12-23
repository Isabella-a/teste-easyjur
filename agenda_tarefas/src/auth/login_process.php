<?php
  session_start();
  require '../db/connection.php';

  var_dump($_SESSION);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      try {
          $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
          $stmt->bindParam(':email', $email);
          $stmt->execute();
          $user = $stmt->fetch(PDO::FETCH_ASSOC);

          if ($user && password_verify($password, $user['senha'])) {
              $_SESSION['user_id'] = $user['id'];
              header('Location: ../../public/dashboard.php');
              exit();
          } else {
              echo "Credenciais inválidas.";
              header('Location: ../../src/auth/login.php');
          }
      } catch (PDOException $e) {
          echo "Erro ao processar login: " . $e->getMessage();
      }
  }
?>

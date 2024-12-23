<?php
header('Content-Type: application/json');
require '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $taskId = $input['task_id'];

    if (!$taskId) {
        echo json_encode(['success' => false, 'message' => 'ID da tarefa não fornecido.']);
        exit;
    }

    try {
        $stmt = $conn->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->bindParam(':id', $taskId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Tarefa não encontrada.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método inválido.']);
}

<?php
require '../../../vendor/autoload.php'; // Autoload do Composer

use TCPDF;

require '../db/connection.php';

// Consultar as tarefas
$query = "SELECT * FROM tarefas";
$stmt = $conn->prepare($query);
$stmt->execute();
$tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Criar um novo objeto TCPDF
$pdf = new TCPDF();
$pdf->AddPage();

// Definir título do relatório
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'Relatório de Tarefas', 0, 1, 'C');

// Definir o conteúdo da tabela
$pdf->SetFont('helvetica', '', 12);

// Cabeçalho da tabela
$pdf->Cell(40, 10, 'Nome', 1);
$pdf->Cell(50, 10, 'Descrição', 1);
$pdf->Cell(30, 10, 'Data Criação', 1);
$pdf->Cell(30, 10, 'Data Conclusão', 1);
$pdf->Cell(30, 10, 'Status', 1);
$pdf->Ln();

// Preencher os dados das tarefas
foreach ($tarefas as $tarefa) {
    $pdf->Cell(40, 10, $tarefa['nome'], 1);
    $pdf->Cell(50, 10, $tarefa['descricao'], 1);
    $pdf->Cell(30, 10, $tarefa['data_criacao'], 1);
    $pdf->Cell(30, 10, $tarefa['data_conclusao'], 1);
    $pdf->Cell(30, 10, $tarefa['status'], 1);
    $pdf->Ln();
}

// Gerar o PDF e fazer o download
$pdf->Output('relatorio_tarefas.pdf', 'D');

<?php
require '../../../vendor/autoload.php'; // Autoload do Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Criação do objeto Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Definir a primeira linha com os cabeçalhos
$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Nome');
$sheet->setCellValue('C1', 'Descrição');
$sheet->setCellValue('D1', 'Data de Criação');
$sheet->setCellValue('E1', 'Data de Conclusão');
$sheet->setCellValue('F1', 'Status');

// Dados que serão exportados (assumindo que $tarefas é um array com os dados)
$row = 2; // Iniciar na segunda linha
foreach ($tarefas as $tarefa) {
    // Convertendo os valores para UTF-8 para garantir que caracteres especiais sejam manipulados corretamente
    $sheet->setCellValue('A' . $row, $tarefa['id']);
    $sheet->setCellValue('B' . $row, mb_convert_encoding($tarefa['nome'], 'UTF-8', 'auto'));
    $sheet->setCellValue('C' . $row, mb_convert_encoding($tarefa['descricao'], 'UTF-8', 'auto'));
    $sheet->setCellValue('D' . $row, $tarefa['data_criacao']);
    $sheet->setCellValue('E' . $row, $tarefa['data_conclusao']);
    $sheet->setCellValue('F' . $row, mb_convert_encoding($tarefa['status'], 'UTF-8', 'auto'));
    $row++;
}

// Definir os cabeçalhos para forçar o download do arquivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="tarefas.xlsx"');
header('Cache-Control: max-age=0');

// Remover qualquer saída antes de gerar o arquivo Excel
ob_clean();
flush();

// Gerar o arquivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

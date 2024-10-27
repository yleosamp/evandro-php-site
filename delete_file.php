<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $filename = $_POST['filename'];
    $filepath = 'uploads/professor/' . $filename;

    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Não foi possível deletar o arquivo.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Arquivo não encontrado.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
}


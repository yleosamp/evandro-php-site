<?php
session_start();

// Ativar exibição de erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = 'uploads/professor/';
    
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $title = $_POST['title'];
    $subject = $_POST['subject'];
    $class = $_POST['class'];

    // Remover espaços e capitalizar cada palavra
    $title = str_replace(' ', '', ucwords($title));

    // Pegar a primeira palavra da matéria
    $subject = explode(' ', $subject)[0];

    // Remover o traço da turma, se houver
    $class = str_replace('-', '', $class);

    // Se a classe for SEGUNDO ou TERCEIRO, use isso no lugar da turma específica
    if ($class === 'SEGUNDO' || $class === 'TERCEIRO') {
        $class = $class;
    }

    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $newFileName = $title . '-' . $subject . '-' . $class . '.' . $fileExtension;

    $uploadFile = $uploadDir . $newFileName;

    // Verificar se o arquivo foi enviado sem erros
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        $_SESSION['upload_message'] = "Arquivo enviado com sucesso!";
        $_SESSION['upload_status'] = "success";
    } else {
        $_SESSION['upload_message'] = "Erro ao enviar o arquivo. Por favor, tente novamente.";
        $_SESSION['upload_status'] = "error";
    }
} 

// Obter o diretório base do script
$baseDir = dirname($_SERVER['SCRIPT_NAME']);
$redirectUrl = $baseDir . '/?page=adm-page';

// Remover barras duplas, se houver
$redirectUrl = preg_replace('#/+#', '/', $redirectUrl);

header("Location: $redirectUrl");
exit();
?>

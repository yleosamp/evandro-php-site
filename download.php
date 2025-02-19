<?php
if (isset($_GET['files'])) {
    $category = isset($_GET['category']) ? $_GET['category'] : 'downloads';
    
    // Remover o traço e converter para maiúsculas
    $category = strtoupper(str_replace('-', '', $category));
    
    $zipName = $category . '.zip';
    
    $zip = new ZipArchive();
    
    if ($zip->open($zipName, ZipArchive::CREATE) === TRUE) {
        foreach ($_GET['files'] as $file) {
            $filePath = 'uploads/alunos/' . $file;
            if (file_exists($filePath)) {
                $zip->addFile($filePath, basename($file));
            }
        }
        $zip->close();
        
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipName);
        header('Content-Length: ' . filesize($zipName));
        readfile($zipName);
        unlink($zipName);
        exit;
    }
} elseif (isset($_GET['file'])) {
    $folder = isset($_GET['folder']) && $_GET['folder'] === 'professor' ? 'uploads/professor/' : 'uploads/alunos/';
    $file = $folder . $_GET['file'];
    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}
echo "Arquivo não encontrado.";

<?php
if (isset($_GET['file'])) {
    $file = 'uploads/alunos/' . $_GET['file'];
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
} elseif (isset($_GET['files'])) {
    $zip = new ZipArchive();
    $zipName = 'downloads_' . date('Y-m-d_H-i-s') . '.zip';
    
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
}
echo "Arquivo não encontrado.";

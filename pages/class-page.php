<?php
$year = isset($_GET['year']) ? $_GET['year'] : '';
$class = isset($_GET['class']) ? $_GET['class'] : '';

$yearName = $year === "segundo" ? "2º ANO" : "TERCEIRÃO";

function getProfessorFiles($targetClass) {
    $dir = 'uploads/professor/';
    $files = scandir($dir);
    $professorFiles = [];
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $info = pathinfo($file);
            $nameParts = explode('-', $info['filename']);
            if (count($nameParts) >= 3) {
                $title = preg_replace('/(?<!^)([A-Z])/', ' $1', $nameParts[0]);
                $fileClass = $nameParts[2];
                if ($fileClass === $targetClass || ($targetClass[0] === $fileClass[0] && strlen($fileClass) === 1)) {
                    $professorFiles[] = [
                        'title' => $title,
                        'subject' => $nameParts[1],
                        'class' => $fileClass,
                        'filename' => $file
                    ];
                }
            }
        }
    }
    return $professorFiles;
}

$classFiles = getProfessorFiles(str_replace('-', '', $class));
?>

<div class="flex flex-col space-y-4 w-full">
    <h2 class="text-lg font-semibold">ARQUIVOS DA TURMA</h2>
    <div class="space-y-2" id="professor-files-list">
        <?php foreach ($classFiles as $file): ?>
            <div class="flex justify-between items-center p-2 border border-primary rounded bg-accent">
                <div>
                    <div class="font-semibold text-white"><?php echo $file['title']; ?></div>
                    <div class="text-sm text-primary"><?php echo $file['subject']; ?></div>
                </div>
                <a href="download.php?file=<?php echo urlencode($file['filename']); ?>&folder=professor" class="px-3 py-1 rounded bg-secondary text-primary text-sm hover:bg-primary hover:text-white transition-colors font-bold">
                    BAIXAR
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

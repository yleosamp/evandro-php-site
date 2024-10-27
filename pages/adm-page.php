<?php
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ?page=login");
    exit();
}

$classes = [
    'SEGUNDO ANO' => ['2-51', '2-52', '2-53', '2-54'],
    'TERCEIRO ANO' => ['3-51', '3-52', '3-53', '3-54']
];
$subjects = ['Lógica de Programação', 'Banco de Dados', 'Desenvolvimento Web'];
$students = [
    ['name' => 'JOÃOZIN PICA FINA', 'subject' => 'Lógica de programação'],
    ['name' =>   'MARIA SILVA', 'subject' => 'Banco de dados'],
    ['name' =>  'PEDRO SANTOS', 'subject' => 'Desenvolvimento web'],
    ['name' =>  'ANA OLIVEIRA', 'subject' => 'Inteligência artificial'],
];
$submittedFiles = [
    ['name' => 'TRABALHO WEB', 'subject' => 'Lógica de programação'],
    ['name' => 'TRABALHO WEB', 'subject' => 'Lógica de programação'],
    ['name' => 'TRABALHO WEB', 'subject' => 'Lógica de programação'],
];

// Função para ler os arquivos da pasta uploads/alunos
function getStudentFiles() {
    $dir = 'uploads/alunos/';
    $files = scandir($dir);
    $studentFiles = [];
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $info = pathinfo($file);
            $nameParts = explode('-', $info['filename']);
            if (count($nameParts) >= 3) {
                $year = substr($nameParts[1], 0, 1);
                $studentFiles[] = [
                    'name' => $nameParts[0],
                    'class' => $nameParts[1],
                    'year' => $year,
                    'subject' => $nameParts[2],
                    'filename' => $file
                ];
            }
        }
    }
    return $studentFiles;
}

$studentFiles = getStudentFiles();

// Função para ler os arquivos da pasta uploads/professor
function getProfessorFiles() {
    $dir = 'uploads/professor/';
    $files = scandir($dir);
    $professorFiles = [];
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $info = pathinfo($file);
            $nameParts = explode('-', $info['filename']);
            if (count($nameParts) >= 3) {
                $title = preg_replace('/(?<!^)([A-Z])/', ' $1', $nameParts[0]);
                $professorFiles[] = [
                    'title' => $title,
                    'subject' => $nameParts[1],
                    'class' => $nameParts[2],
                    'filename' => $file
                ];
            }
        }
    }
    return $professorFiles;
}

$professorFiles = getProfessorFiles();

// Verificar se há uma mensagem de upload
if (isset($_SESSION['upload_message'])) {
    $messageClass = ($_SESSION['upload_status'] === 'success') ? 'bg-green-500' : 'bg-red-500';
    echo "<div class='{$messageClass} text-white p-4 mb-4 rounded'>{$_SESSION['upload_message']}</div>";
    
    // Limpar a mensagem da sessão
    unset($_SESSION['upload_message']);
    unset($_SESSION['upload_status']);
}

?>

<div class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-4 p-4  text-primary">
    <!-- Left Section -->
    <div class="flex flex-col space-y-4 w-full lg:w-1/2">
        <form action="upload_professor.php" method="post" enctype="multipart/form-data" class="space-y-4" id="uploadForm">
            <input 
                name="title"
                placeholder="Título do arquivo" 
                class="w-full p-2 rounded-lg border border-primary bg-secondary text-primary placeholder-primary focus:outline-none focus:ring-2 focus:ring-primary"
                required
            >
            <select name="subject" class="w-full p-2 rounded-lg border border-primary bg-secondary text-primary focus:outline-none focus:ring-2 focus:ring-primary appearance-none" required>
                <option value="" disabled selected hidden>Matéria</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?php echo $subject; ?>"><?php echo $subject; ?></option>
                <?php endforeach; ?>
            </select>
            <select name="class" class="w-full p-2 rounded-lg border border-primary bg-secondary text-primary focus:outline-none focus:ring-2 focus:ring-primary appearance-none" id="class-select" required>
                <option value="" disabled selected hidden>Turma</option>
                <?php foreach ($classes as $year => $yearClasses): ?>
                    <option value="<?php echo explode(' ', $year)[0]; ?>"><?php echo $year; ?></option>
                    <?php foreach ($yearClasses as $class): ?>
                        <option value="<?php echo $class; ?>">&nbsp;&nbsp;<?php echo $class; ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
            <input type="file" name="file" class="w-full p-2 rounded-lg border border-primary bg-secondary text-primary focus:outline-none focus:ring-2 focus:ring-primary" required>

            <button type="submit" class="w-full p-2 rounded-lg bg-accent text-primary border border-primary hover:bg-primary hover:text-white transition-colors font-bold">
                Enviar arquivo
            </button>
        </form>

        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
            <button 
                class="flex-grow p-2 rounded-lg bg-accent text-primary hover:bg-primary hover:text-white transition-colors font-bold"
                id="toggle-students"
            >
                VER ENVIOS DE ALUNOS
            </button>
            <select 
                class="w-full sm:w-24 p-2 rounded-lg border border-primary bg-secondary text-primary focus:outline-none focus:ring-2 focus:ring-primary appearance-none"
                id="class-select-2"
            >
                <?php foreach ($classes as $year => $yearClasses): ?>
                    <option value="<?php echo explode(' ', $year)[0]; ?>"><?php echo $year; ?></option>
                    <?php foreach ($yearClasses as $class): ?>
                        <option value="<?php echo $class; ?>">&nbsp;&nbsp;<?php echo $class; ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div id="student-list" class="space-y-2" style="display: none;">
            <?php foreach ($studentFiles as $student): ?>
                <div class="flex justify-between items-center p-2 border border-primary rounded bg-secondary" data-class="<?php echo $student['class']; ?>" data-year="<?php echo $student['year']; ?>">
                    <div>
                        <div class="font-semibold text-white"><?php echo $student['name']; ?></div>
                        <div class="text-sm text-primary"><?php echo $student['subject']; ?></div>
                    </div>
                    <button class="px-3 py-1 rounded bg-accent text-primary text-sm hover:bg-primary hover:text-white transition-colors font-bold" onclick="downloadFile('<?php echo $student['filename']; ?>')">
                        Download
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
        <button id="download-all" class="w-full p-2 mt-4 rounded-lg bg-accent text-primary hover:bg-primary hover:text-white transition-colors font-bold" style="display: none;">
            Baixar Todos os Arquivos
        </button>
    </div>

    <!-- Divisao -->
    <div class="hidden lg:block w-px bg-primary"></div>

    <!-- Direita -->
    <div class="flex flex-col space-y-4 w-full lg:w-1/2">
        <div class="flex justify-between items-center">
            <h2 class="text-lg font-semibold">ARQUIVOS ENVIADOS</h2>
            <select 
                class="w-24 p-2 rounded-lg border border-primary bg-secondary text-primary focus:outline-none focus:ring-2 focus:ring-primary appearance-none"
                id="file-class-select"
            >
                <?php foreach ($classes as $year => $yearClasses): ?>
                    <option value="<?php echo explode(' ', $year)[0]; ?>"><?php echo $year; ?></option>
                    <?php foreach ($yearClasses as $class): ?>
                        <option value="<?php echo $class; ?>">&nbsp;&nbsp;<?php echo $class; ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="space-y-2" id="professor-files-list">
            <?php foreach ($professorFiles as $file): ?>
                <div class="flex justify-between items-center p-2 border border-primary rounded bg-accent" data-class="<?php echo $file['class']; ?>">
                    <div>
                        <div class="font-semibold text-white"><?php echo $file['title']; ?></div>
                        <div class="text-sm text-primary"><?php echo $file['subject']; ?></div>
                    </div>
                    <button class="px-3 py-1 rounded bg-secondary text-primary text-sm hover:bg-primary hover:text-white transition-colors font-bold" onclick="deleteFile('<?php echo $file['filename']; ?>')">
                        DELETAR
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggle-students').addEventListener('click', function() {
        var studentList = document.getElementById('student-list');
        studentList.style.display = studentList.style.display === 'none' ? 'block' : 'none';
        filterStudents();
    });

    function makeSelectCategoriesSelectable(selectId) {
        const select = document.getElementById(selectId);
        select.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value === 'SEGUNDO' || selectedOption.value === 'TERCEIRO') {
                selectedOption.selected = true;
            }
            if (selectId === 'class-select-2') {
                filterStudents();
            }
            if (selectId === 'file-class-select') {
                filterProfessorFiles();
            }
        });
    }

    makeSelectCategoriesSelectable('class-select');
    makeSelectCategoriesSelectable('class-select-2');
    makeSelectCategoriesSelectable('file-class-select');

    function filterStudents() {
        const selectedClass = document.getElementById('class-select-2').value;
        const studentItems = document.querySelectorAll('#student-list > div');
        const downloadAllButton = document.getElementById('download-all');
        let visibleItems = 0;

        studentItems.forEach(item => {
            const itemClass = item.getAttribute('data-class');
            const itemYear = item.getAttribute('data-year');
            let shouldDisplay = false;

            if (selectedClass === 'SEGUNDO' || selectedClass === 'TERCEIRO') {
                shouldDisplay = itemYear === (selectedClass === 'SEGUNDO' ? '2' : '3');
            } else {
                shouldDisplay = itemClass === selectedClass.replace('-', '');
            }

            item.style.display = shouldDisplay ? 'flex' : 'none';
            if (shouldDisplay) visibleItems++;
        });

        downloadAllButton.style.display = visibleItems > 0 ? 'block' : 'none';
    }

    function downloadFile(filename) {
        window.location.href = 'download.php?file=' + encodeURIComponent(filename);
    }

    document.getElementById('download-all').addEventListener('click', function() {
        const selectedClass = document.getElementById('class-select-2').value;
        const visibleItems = document.querySelectorAll('#student-list > div[style="display: flex;"]');
        const filenames = Array.from(visibleItems).map(item => item.querySelector('button').getAttribute('onclick').match(/'(.+?)'/)[1]);
        
        if (filenames.length > 0) {
            const queryString = filenames.map(filename => 'files[]=' + encodeURIComponent(filename)).join('&');
            window.location.href = 'download.php?' + queryString;
        }
    });

    function filterProfessorFiles() {
        const selectedClass = document.getElementById('file-class-select').value;
        const fileItems = document.querySelectorAll('#professor-files-list > div');

        fileItems.forEach(item => {
            const itemClass = item.getAttribute('data-class');
            let shouldDisplay = false;

            if (selectedClass === 'SEGUNDO' || selectedClass === 'TERCEIRO') {
                shouldDisplay = itemClass.startsWith(selectedClass[0]);
            } else {
                shouldDisplay = itemClass === selectedClass.replace('-', '');
            }

            item.style.display = shouldDisplay ? 'flex' : 'none';
        });
    }

    function deleteFile(filename) {
        if (confirm('Tem certeza que deseja deletar este arquivo?')) {
            fetch('delete_file.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'filename=' + encodeURIComponent(filename)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Arquivo deletado com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao deletar o arquivo: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Ocorreu um erro ao tentar deletar o arquivo.');
            });
        }
    }

    // Inicializar a filtragem
    filterProfessorFiles();

    // Adicionar este código para limpar o formulário após o envio
    document.getElementById('uploadForm').addEventListener('submit', function() {
        setTimeout(function() {
            document.getElementById('uploadForm').reset();
        }, 100);
    });
</script>

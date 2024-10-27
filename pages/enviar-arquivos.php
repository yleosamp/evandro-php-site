<?php
$turmas = ['2-51', '2-52', '2-53', '2-54'];
$materias = ['Lógica de programação', 'Banco de dados', 'Desenvolvimento web'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $turma = $_POST['turma'];
    $materia = $_POST['materia'];
    
    $arquivo = $_FILES['arquivo'];
    $tamanho_maximo = 30 * 1024 * 1024; // 30MB em bytes

    if ($arquivo['size'] > $tamanho_maximo) {
        $erro = "O arquivo excede o tamanho máximo permitido de 30MB.";
    } else {
        // Processar o nome do arquivo
        $nome_formatado = str_replace(' ', '', $nome);
        $turma_formatada = str_replace('-', '', $turma);
        $materia_formatada = preg_replace('/[áàãâäéèêëíìîïóòõôöúùûüç]/ui', '', $materia);
        $materia_formatada = explode(' ', $materia_formatada)[0];

        $extensao = pathinfo($arquivo['name'], PATHINFO_EXTENSION);
        
        $novo_nome = "{$nome_formatado}-{$turma_formatada}-{$materia_formatada}.{$extensao}";
        $caminho_destino = "./uploads/alunos/" . $novo_nome;
        
        if (move_uploaded_file($arquivo['tmp_name'], $caminho_destino)) {
            $mensagem = "Arquivo enviado com sucesso!";
        } else {
            $erro = "Erro ao enviar o arquivo.";
        }
    }
}
?>

<div class="flex items-center justify-center min-h-[calc(90vh-4rem)] px-4">
    <div class="w-full max-w-2xl">
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6" id="upload-form">
            <?php if (isset($mensagem)): ?>
                <p class="text-green-500 text-center"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <?php if (isset($erro)): ?>
                <p class="text-red-500 text-center"><?php echo $erro; ?></p>
            <?php endif; ?>
            <div>
                <label class="block text-primary text-lg font-bold mb-2" for="nome">
                    Seu nome
                </label>
                <input
                    class="shadow appearance-none border border-primary rounded w-full py-3 px-4 text-primary leading-tight focus:outline-none focus:shadow-outline bg-transparent text-lg placeholder-primary"
                    id="nome"
                    name="nome"
                    type="text"
                    placeholder="Seu nome"
                    required
                >
            </div>
            <div>
                <label class="block text-primary text-lg font-bold mb-2" for="turma">
                    Sua turma
                </label>
                <select
                    class="shadow appearance-none border border-primary rounded w-full py-3 px-4 text-primary leading-tight focus:outline-none focus:shadow-outline bg-transparent text-lg"
                    id="turma"
                    name="turma"
                    required
                >
                    <option value="" disabled selected>Selecione sua turma</option>
                    <?php foreach ($turmas as $turma): ?>
                        <option value="<?php echo $turma; ?>"><?php echo $turma; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-primary text-lg font-bold mb-2" for="materia">
                    Matéria
                </label>
                <select
                    class="shadow appearance-none border border-primary rounded w-full py-3 px-4 text-primary leading-tight focus:outline-none focus:shadow-outline bg-transparent text-lg"
                    id="materia"
                    name="materia"
                    required
                >
                    <option value="" disabled selected>Selecione a matéria</option>
                    <?php foreach ($materias as $materia): ?>
                        <option value="<?php echo $materia; ?>"><?php echo $materia; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-primary text-lg font-bold mb-2" for="arquivo">
                    Selecione o arquivo (máx. 30MB)
                </label>
                <div class="relative">
                    <input
                        class="hidden"
                        id="arquivo"
                        name="arquivo"
                        type="file"
                        required
                        onchange="updateFileName(this)"
                    >
                    <label for="arquivo" class="cursor-pointer bg-primary hover:bg-opacity-80 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline inline-block">
                        Escolher arquivo
                    </label>
                    <span id="file-name" class="ml-3 text-primary"></span>
                </div>
            </div>
            <div>
                <button
                    class="w-full bg-primary hover:bg-opacity-80 text-white font-bold py-3 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >
                    Enviar arquivo
                </button>
            </div>
            <div id="progress-container" class="hidden">
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div id="progress-bar" class="h-2.5 rounded-full" style="background-color: #6E62A4; width: 0%"></div>
                </div>
                <p id="progress-text" class="text-center text-primary mt-2"></p>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = input.files[0]?.name || 'Nenhum arquivo selecionado';
    document.getElementById('file-name').textContent = fileName;
}

document.getElementById('upload-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', '', true);
    
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const percentComplete = (e.loaded / e.total) * 100;
            document.getElementById('progress-bar').style.width = percentComplete + '%';
            document.getElementById('progress-text').textContent = `${Math.round(percentComplete)}% enviado`;
        }
    };
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('progress-text').textContent = 'Arquivo enviado com sucesso!';
        } else {
            document.getElementById('progress-text').textContent = 'Erro ao enviar o arquivo.';
        }
    };
    
    document.getElementById('progress-container').classList.remove('hidden');
    xhr.send(formData);
});
</script>

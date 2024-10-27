<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === 'vandovando' && $password === 'vandoadmin') {
        $_SESSION['logged_in'] = true;
        redirect('adm-page');
    } else {
        $error = "Credenciais inválidas";
    }
}
?>

<div class="flex items-center justify-center min-h-[calc(90vh-4rem)]">
    <div class="w-full max-w-lg px-4"> 
        <form method="POST" class="bg-gradient-custom shadow-md rounded-lg px-8 pt-6 pb-8 mb-4 min-h-[350px]">
            <h2 class="text-2xl font-bold mb-6 text-center text-primary">LOGIN DE ADMINISTRADOR</h2>
            <?php if (isset($error)): ?>
                <p class="text-red-500 text-center mb-4"><?php echo $error; ?></p>
            <?php endif; ?>
            <div class="mb-4">
                <input
                    class="shadow appearance-none rounded-lg w-full py-3 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline bg-accent placeholder-primary"
                    id="username"
                    name="username"
                    type="text"
                    placeholder="Usuário"
                    required
                >
            </div>
            <div class="mb-6">
                <input
                    class="shadow appearance-none rounded-lg w-full py-3 px-3 text-primary leading-tight focus:outline-none focus:shadow-outline bg-accent placeholder-primary"
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Senha"
                    required
                >
            </div>
            <div class="flex items-center justify-center">
                <button
                    class="bg-primary hover:bg-opacity-80 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline w-full"
                    type="submit"
                >
                    CONTINUAR
                </button>
            </div>
        </form>
    </div>
</div>

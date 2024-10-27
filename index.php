<?php
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- ... outros meta tags ... -->
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6E62A4',
                        secondary: '#18122B',
                        accent: '#443C68',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-gradient-custom {
                @apply bg-gradient-to-b from-[#4C3F78] to-[#3E335C];
            }
        }
    </style>
</head>
<body class="bg-secondary text-primary min-h-screen">
    <?php include 'header.php'; ?>
    
    <main class="container mx-auto px-4 pt-24">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $page_file = "pages/{$page}.php";

        if (file_exists($page_file)) {
            include $page_file;
        } else {
            echo "Arquivo não encontrado ou variável não definida.";
        }
        ?>
    </main>

    

    <script src="js/scripts.js"></script>
</body>
</html>

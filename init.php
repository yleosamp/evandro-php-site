<?php
session_start();
ob_start();

// Funções de utilidade
function redirect($page) {
    header("Location: ?page=" . $page);
    exit();
}

// Verificação de login
function require_login() {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        redirect('login');
    }
}

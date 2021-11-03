<?php
/**
 * Exibir a tela de login para o usuário.
 */
function exibeLogin() {
    require_once('./View/ViewLogin.php');
}

/**
 * Verifica o login do usuário.
 */
function verificaLogin() {
    if (isset($_POST) && isset($_POST['usuario']) && isset($_POST['senha'])) {
        require_once('./Controller/controllerBase.php');
        require_once('./Controller/controllerValidation.php');
        if (is_array(validaDados($_POST['usuario'], $_POST['senha']))) {
            $_SESSION[USUARIO] = $_POST['usuario'];
            $_SESSION[LOGADO] = true;
        }else {
            $_SESSION['erroLogin'] = true;
        };
        alteraUrl();
        die();
    }
}

/**
 * Função para sair do sistema.
 */
function logout() {
    unset($_SESSION[USUARIO]);
    unset($_SESSION[LOGADO]);
}
<?php
require_once('./Controller/controllerLogin.php');
require_once('./Controller/controllerMenu.php');

const LOGADO = 'LOGADO';
const USUARIO = 'USUARIO';
const ADMIN = 'ADMINISTRATOR';

/**
 * Função centralizada para validar o inicio.
 * Necessário para saber se o usuário está ou não logado e então para qual tela ele será redirecionado.
 */
function validationInicio() {

    if (validaUsuarioLogado()) {
        exibeMenu();
    }
    else {
        exibeLogin();
    }

}

/**
 * Valida se o usuário da sessão está logado.
 */
function validaUsuarioLogado() {
    $bLogado = false;
    if (isset($_SESSION[LOGADO]) && $_SESSION[LOGADO] && !empty($_SESSION[USUARIO])) {
        $bLogado = true;
    }
    return $bLogado;
}

/**
 * Retorna se o usuário é admin.
 * @return Boolean $bRetorno - Indica se o usuário é admin.
 */
function isAdmin() {
    $bRetorno = false;
    if (isset($_SESSION[ADMIN]) && $_SESSION[ADMIN]) {
        $bRetorno = true;
    }
    return true;
    return $bRetorno;
}
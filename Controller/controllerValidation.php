<?php

use FFI\Exception;

require_once('./Controller/controllerLogin.php');
require_once('./Controller/controllerMenu.php');
require_once('./Controller/controllerBd.php');
require_once('./Controller/controllerBase.php');

const LOGADO = 'LOGADO';
const USUARIO = 'USUARIO';
const ADMIN = 'ADMINISTRATOR';
const ACAO_LOGOUT  = 5;
const ACAO_LOGIN   = 4;
const ACAO_DELETAR = 3;
const ACAO_ALTERAR = 2;
const ACAO_INCLUIR = 1;

/**
 * Função centralizada para validar o inicio.
 * Necessário para saber se o usuário está ou não logado e então para qual tela ele será redirecionado.
 */
function validationInicio() {

    if (validaUsuarioLogado()) {
        validaAcoes();
        exibeMenu();
    }
    else {
        validaLogin();
        exibeLogin();
    }

}

/**
 * Valida se existem ações sendo requisitadas.
 */
function validaAcoes() {
    if (isset($_POST) && count($_POST)) {
        validaAcoesPost();
    }
    else{
        validaAcoesGet();
    }
}

/**
 * Realiza os tratamentos para ações GET.
 */
function validaAcoesGet() {
    if (isset($_GET['acao']) && isset($_GET['codigo'])) {
        switch ($_GET['acao']) {
            case ACAO_INCLUIR:
                require_once('./Controller/controllerInclusao.php');
                montaTelaInclusao();
                break;
            case ACAO_ALTERAR:
                require_once('./Controller/controllerAlteracao.php');
                $_SESSION['codigoRegistro'] = $_GET['codigo'];
                montaTelaAlteracao();
                break;
            case ACAO_DELETAR:
                deletaRegistro($_GET['codigo']);
                alteraUrl();
                break;
            case ACAO_LOGOUT:
                logout();
                alteraUrl();
                break;
        }
    }    
}

/**
 * Realiza os tratamentos para ações POST.
 */
function validaAcoesPost() {
    if (isset($_GET['acao'])) {
        switch ($_GET['acao']) {
            case ACAO_INCLUIR:
                require_once('./Controller/controllerBd.php');
                    salvaInclusao();
                    alteraUrl();
                break;
            case ACAO_ALTERAR:
                require_once('./Controller/controllerBd.php');
                    salvaAlteracao();
                    alteraUrl();
                break;
        }
    }  
}

/**
 * Realiza validações para o login.
 */
function validaLogin() {
    if (isset($_POST) && count($_POST) && isset($_GET) && count($_GET)) {
        validaAcaoLogin();
    }
}

/**
 * Valida o login do usuário.
 */
function validaAcaoLogin() {
    if (isset($_GET['acao']) && isset($_POST['usuario']) && isset($_POST['senha'])) {
        switch ($_GET['acao']) {
            case ACAO_LOGIN:
                verificaLogin();
                break;
        }
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

/**
 * Função para validar os dados de login
 */
function validaDados($sUsuario, $sSenha) {
    require_once('./Controller/controllerBd.php');
    return execute(getSqlValidaLogin($sUsuario, $sSenha));
}
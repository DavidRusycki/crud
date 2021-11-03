<?php

use FFI\Exception;

require_once('./Controller/controllerLogin.php');
require_once('./Controller/controllerMenu.php');
require_once('./Controller/controllerBd.php');
require_once('./Controller/controllerBase.php');

// Constantes
const LOGADO       = 'LOGADO';
const USUARIO      = 'USUARIO';
const ADMIN        = 'ADMINISTRATOR';
const ACAO         = 'acao';
const CODIGO       = 'codigo';
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
    if (isset($_GET[ACAO]) && isset($_GET[CODIGO])) {
        switch ($_GET[ACAO]) {
            case ACAO_INCLUIR:
                acaoGetIncluir();
                break;
            case ACAO_ALTERAR:
                acaoGetAlterar();
                break;
            case ACAO_DELETAR:
                acaoGetDeletar();
                break;
            case ACAO_LOGOUT:
                acaoGetLogout();
                break;
        }
    }    
}

/**
 * Trata a acao GET de inclusão.
 */
function acaoGetIncluir() {
    require_once('./Controller/controllerInclusao.php');
    montaTelaInclusao();
}

/**
 * Trata a acao GET de Alteração.
 */
function acaoGetAlterar() {
    require_once('./Controller/controllerAlteracao.php');
    $_SESSION['codigoRegistro'] = $_GET[CODIGO];
    montaTelaAlteracao();
}

/**
 * Trata a acao GET de Deletar.
 */
function acaoGetDeletar() {
    deletaRegistro($_GET[CODIGO]);
    alteraUrl();
}

/**
 * Trata a acao GET de deslogar do sistema.
 */
function acaoGetLogout() {
    logout();
    alteraUrl();
}

/**
 * Realiza os tratamentos para ações POST.
 */
function validaAcoesPost() {
    if (isset($_GET[ACAO])) {
        switch ($_GET[ACAO]) {
            case ACAO_INCLUIR:
                acaoPostIncluir();
                break;
            case ACAO_ALTERAR:
                acaoPostAlterar();
                break;
        }
    }  
}

/**
 * Trata a acao POST de inclusão.
 */
function acaoPostIncluir() {
    require_once('./Controller/controllerBd.php');
    salvaInclusao();
    alteraUrl();
}

/**
 * Trata a acao POST de alteração.
 */
function acaoPostAlterar() {
    require_once('./Controller/controllerBd.php');
    salvaAlteracao();
    alteraUrl();
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
    if (isset($_GET[ACAO]) && isset($_POST['usuario']) && isset($_POST['senha'])) {
        switch ($_GET[ACAO]) {
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
 * @TODO QUANDO O MÉTODO FOR ARRUMADO DEVE-SE ALTERAR O MÉTODO DE LOGOUT NO CONTROLLERLOGIN
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
 * Retorna os dados de login
 * @param String $sUsuario - Usuário
 * @param String $sSenha - Senha
 */
function validaDados($sUsuario, $sSenha) {
    require_once('./Controller/controllerBd.php');
    return execute(getSqlValidaLogin($sUsuario, $sSenha));
}
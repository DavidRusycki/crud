<?php
require_once('./Controller/controllerValidation.php');

/**
 * Função centralizada para iniciar a sessão.
 */
function iniciaSessao() {
    session_start();
}

/**
 * Função para chamar a validação de inicio do Controller de validação.
 */
function validaInicio() {
    validationInicio();
}

/**
 * Retorna a primeira posição de um array.
 * @param Array $aArray
 * @return Mixed
 */
function getFirstFromArray($aArray) {
    foreach($aArray as $xThing) {
        return $xThing;
    }
}

/**
 * Altera a url do usuário.
 */
function alteraUrl() {
    header("Location: index.php");
}
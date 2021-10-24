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

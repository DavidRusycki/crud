<?php

use FFI\Exception;

require_once('./Controller/controllerValidation.php');
require_once('./SQL/sql.php');

const BD_TYPE = 'mysql';
const HOST    = 'localhost';
const BD_NAME = 'crud';
const USER    = 'root';

/**
 * Executa o sql no banco de dados e trata o retorno.
 * @param String $sSql
 * @return Array - Resultado do sql.
 */
function execute($sSql) {
    try {
        $oPrepare = getConnection()->prepare($sSql);
        $oPrepare->execute();
        $aResult = $oPrepare->fetchAll(PDO::FETCH_ASSOC);
        $aResult = trataFetch($aResult);
        if (count($aResult) == 0) {
            $aResult = true;
        }
        return $aResult;
    } catch (\Throwable $e) {
        if (isAdmin()) {
            echo $e;
            throw new \Exception('error');
        }
        else {
            echo '<h1>Ops! :(</h1>';
            echo '<br/>';
            echo 'Ocorreram problemas internos não esperados.';
            throw new \Exception();
        }
    }
}

/**
 * Possibilita tratar o retorno do banco.
 * @return Array $aRetorno - Retorno do sql. 
 */
function trataFetch($aFetch) {
}

/**
 * Retorna o DataObject PDO para conexão com o MySql
 * @return PDO $oConnection 
 */
function getConnection() {
    $sBdName = BD_NAME;
    $sHost   = HOST;
    $sBd     = BD_TYPE;

    $oConnection = new PDO("{$sBd}:host={$sHost};dbname={$sBdName}",USER,'');
    //Pesquisar o pq disso akie
    $oConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $oConnection;
}

/**
 * Função responsável por deletar o registro do código passado.
 */
function deletaRegistro($iCodigo) {
    execute(montaSqlDelete($iCodigo));
}

/**
 * Retorna os dados de determinado registro.
 */
function getDadosLinhaFromCodigo($iCodigo) {
    return execute(getSqlDadosLinhaFromCodigo($iCodigo));
}

/**
 * Responsável por salvar as informações da alteração no banco de dados.
 */
function salvaAlteracao() {
    return execute(getSqlUpdate());
}

/**
 * Responsável por salvar as informações da inclusão no banco de dados.
 */
function salvaInclusao() {
    return execute(getSqlInsert());
}

/**
 * Retorna o sql de validação de login.
 */
function getSqlValidaLogin($sUsuario, $sSenha) {
    $sSql = "
        SELECT 1 FROM usuario where nome = \"{$sUsuario}\" and senha = md5('{$sSenha}')
    ";
    return $sSql;
}
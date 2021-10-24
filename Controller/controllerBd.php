<?php
require_once('./Controller/controllerValidation.php');

const BD_NAME = 'crud';
const USER = 'root';

/**
 * Executa o sql no banco de dados e trata o retorno.
 * @param String $sSql
 * @return Array - Resultado do sql.
 */
function execute($sSql) {
    try {
        $oPrepare = getConnection()->prepare($sSql);
        $oPrepare->execute();
        $aResult = trataFetch($oPrepare->fetchAll());
        if (count($aResult) == 0) {
            $aResult = true;
        }
        return $aResult;
    } catch (\Throwable $e) {
        if (isAdmin()) {
            echo $e;
        }
        else {
            echo '<h1>Ops! :(</h1>';
            echo '<br/>';
            echo 'Ocorreram problemas internos não esperados.';
        }
    }
}

/**
 * Trata o fetch do banco.
 * É necessário trata o fetch do mySql pois ele retorna duas vezes o mesmo valor mas com chaves diferentes dentro do array.
 * @return Array $aRetorno - Retorno do sql. 
 */
function trataFetch($aFetch) {
    $aRetorno = [];
    $iAcumulador = 1;
    foreach($aFetch as $iIndice => $aLinha) {
        foreach($aLinha as $xColuna => $xValor) {
            if ($iAcumulador%2 != 0) {
                $aRetorno[$iIndice][$xColuna] = $xValor;
            }
            ++$iAcumulador;
        }
    }
    return $aRetorno;
}

/**
 * Retorna o DataObject PDO para conexão com o MySql
 * @return PDO $oConnection 
 */
function getConnection() {
    $sBdName = BD_NAME;
    $oConnection = new PDO("mysql:host=localhost;dbname={$sBdName}",USER,'');
    //Pesquisar o pq disso akie
    $oConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $oConnection;
}

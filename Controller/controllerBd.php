<?php

use FFI\Exception;

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
        // $aResult = trataFetch($oPrepare->fetchAll());
        $aResult = $oPrepare->fetchAll(PDO::FETCH_ASSOC);
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

/**
 * Função responsável por deletar o registro do código passado.
 */
function deletaRegistro($iCodigo) {
     execute(montaSqlDelete($iCodigo));
}

/**
 * Reponsável por retornar o sql para excluir um registro.
 */
function montaSqlDelete($iCodigo) {
    return "delete from produto where codigo = {$iCodigo} ";
}

function getDadosLinhaFromCodigo($iCodigo) {
    return execute(getSqlDadosLinhaFromCodigo($iCodigo));
}

/**
 * Retorna o sql para pegar os dados de determinado registro.
 * @return String
 */
function getSqlDadosLinhaFromCodigo($iCodigo) {
    return "SELECT * FROM PRODUTO WHERE CODIGO = {$iCodigo}";
}

/**
 * Responsável por salvar as informações da alteração no banco de dados.
 */
function salvaAlteracao() {
    return execute(getSqlUpdate());
}

/**
 * Retorna o sql para atualizar um registro.
 */
function getSqlUpdate() {
    $sSql = "
    UPDATE produto SET 
    nome       = \"{$_POST['nome'      ]}\",
    marca      = \"{$_POST['marca'     ]}\",
    valor      = \"{$_POST['valor'     ]}\",
    quantidade = \"{$_POST['quantidade']}\"
    WHERE codigo = {$_POST['codigo']}";
    return $sSql;
}

/**
 * Responsável por salvar as informações da inclusão no banco de dados.
 */
function salvaInclusao() {
    return execute(getSqlInsert());
}

/**
 * Retorna o sql para incluir um registro.
 */
function getSqlInsert() {
    $sSql = "
    INSERT INTO `produto` (`nome`, `valor`, `marca`, `quantidade`) VALUES (
        \"{$_POST['nome'      ]}\",
          {$_POST['valor'     ]},
        \"{$_POST['marca'     ]}\",
          {$_POST['quantidade']}
    )";
    return $sSql;
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
<?php
/**
 * Retorna o sql para consultar os produtos.
 * @return String $sSql - Sql para consulta.
 */
function getSqlConsultaProdutos() {
    $sSql = "
        SELECT * FROM produto
    ";
    return $sSql;
}

/**
 * Reponsável por retornar o sql para excluir um registro.
 * @param Integer $iCodigo - Código
 * @return String - SQL de delete
 */
function montaSqlDelete($iCodigo) {
    return "delete from produtasdfasdfo where codigo = {$iCodigo} ";
}

/**
 * Retorna o sql para pegar os dados de determinado registro.
 * @param Integer $iCodigo - Código
 * @return String - Select
 */
function getSqlDadosLinhaFromCodigo($iCodigo) {
    return "SELECT * FROM PRODUTO WHERE CODIGO = {$iCodigo}";
}

/**
 * Retorna o sql para atualizar um registro.
 * @return String $sSql - Sql de update
 */
function getSqlUpdate() {
    $sSql = "
        UPDATE produto SET 
        nome       = \"{$_POST['nome'      ]}\",
        marca      = \"{$_POST['marca'     ]}\",
        valor      = \"{$_POST['valor'     ]}\",
        quantidade = \"{$_POST['quantidade']}\"
        WHERE codigo = {$_POST['codigo']}
    ";
    return $sSql;
}

/**
 * Retorna o sql para incluir um registro.
 * @return String $sSql - Sql de insert
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
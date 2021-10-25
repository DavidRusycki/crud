<?php

/**
 * Retorna o sql para consultar os produtos.
 * @return String $sSql
 */
function getSqlConsultaProdutos() {
    $sSql = "
        SELECT * FROM produto
    ";
    return $sSql;
}


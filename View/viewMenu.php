<?php
require_once('./Controller/controllerBd.php');
require_once('./Controller/controllerBase.php');
require_once('./SQL/sql.php');

/**
 * Monta a tabela de exibição das informações.
 */
function montaMenu() {
    $aRegistros = execute(getSqlConsultaProdutos());
    if (is_array($aRegistros)) {
        adicionaColunas($aRegistros);
        echo '<table class="table">';
        montaColunas($aRegistros);
        montaLinhas($aRegistros);
        echo '</table>';        
    }
    else {
        echo '<br>';
        echo 'Nenhum produto cadastrado.';
    }
}

/**
 * Adiciona os botões nas linhas da consulta.
 * @param Array $aRegistros - Registros
 */
function adicionaColunas(&$aRegistros) {
    foreach($aRegistros as $indice => $aLinha) {
        $aRegistros[$indice]['total'] = 1;
        $aRegistros[$indice]['acoes'] = 1;
    }
}

/**
 * Monta as colunas da consulta.
 * @param Array $aRegistros - Registros
 */
function montaColunas($aRegistros) {
    echo '<thead>';
    echo '<tr>';
    foreach(getFirstFromArray($aRegistros) as $sColuna => $xValor) {
        trataTituloColuna($sColuna);    
    }
    echo '</tr>';
    echo '</thead>';
}

/**
 * Permite tratar o título da coluna.
 * @param String $sColuna - Nome da coluna.
 */
function trataTituloColuna($sColuna) {
    switch ($sColuna) {
        case 'codigo':
            echo "<th scope=\"col\">Código</th>";           
            break;
        case 'total':
            echo "<th scope=\"col\">Valor Total</th>";           
            break;
        
        default:
            $sColuna = ucfirst($sColuna);
            echo "<th scope=\"col\">{$sColuna}</th>";
            break;
    }

}

/**
 * Monta as linhas com os valores vindos do banco de dados.
 * @param Array $aRegistros - Valores do banco.
 */
function montaLinhas($aRegistros) {
    echo '<tbody>';
    foreach($aRegistros as $aLinha) {
        echo '<tr>';
        foreach($aLinha as $sColuna => $xValor) {
            trataLinha($sColuna, $xValor, $aLinha);
        }
        echo '</tr>';
    }
    echo '</tbody>';
}

/**
 * Possibilita realizar um tratamento para as linhas.
 * @param String $sColuna - Nome da coluna.
 * @param Mixed $xValor - Valor da coluna.
 * @param Array $aLinha - Array da linha.
 */
function trataLinha($sColuna, $xValor, $aLinha) {
    switch ($sColuna) {
        case 'codigo':
            echo "<th scope=\"row\">{$xValor}</th>";
            break;
            
        case 'total':
            $iTotal = $aLinha['quantidade'] * $aLinha['valor'];
            echo "<th scope=\"row\">R$ {$iTotal}</th>";
            break;

        case 'acoes':
            echo "<td><a href=\"?codigo={$aLinha['codigo']}&acao=2\" class=\"btn btn-primary\">Alterar</a> <a href=\"?codigo={$aLinha['codigo']}&acao=3\" class=\"btn btn-danger\">Deletar</a></td>";
            break;

        case 'valor':
            echo "<td>R$ {$xValor}</td>";
            break;

        default:
        echo "<td>{$xValor}</td>";
            break;
    }
}

?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estoque</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>

    <a class="btn btn-success" href="index.php?acao=1&codigo=0">Incluir</a>
    <a class="btn btn-warning right" href="index.php?acao=5&codigo=0">Logout</a>

    <?php montaMenu() ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>

</html>

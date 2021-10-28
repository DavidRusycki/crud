<?php
require_once('./Controller/controllerBd.php');
require_once('./Controller/controllerBase.php');
require_once('./SQL/sql.php');

/**
 * Monta a tabela de exibição das informações.
 */
function montaMenu() {
    $aRegistros = execute(getSqlConsultaProdutos());
    adicionaAcoes($aRegistros);
    echo '<table class="table">';
    montaColunas($aRegistros);
    montaLinhas($aRegistros);
    echo '</table>';
}

/**
 * Adiciona os botões nas linha das consulta.
 */
function adicionaAcoes(&$aRegistros) {
    foreach($aRegistros as $indice => $aLinha) {
        $aRegistros[$indice]['acoes'] = 1;
    }
}

/**
 * Monta a consulta de acordo com o necessário.
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
 * Permite tratar o titulo da coluna.
 */
function trataTituloColuna($sColuna) {
    switch ($sColuna) {
        case 'codigo':
            echo "<th scope=\"col\">Código</th>";           
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
 */
function trataLinha($sColuna, $xValor, $aLinha) {
    switch ($sColuna) {
        case 'codigo':
        echo "<th scope=\"row\">{$xValor}</th>";
            break;
        
        case 'acoes':
            echo "<td><a href=\"?codigo={$aLinha['codigo']}&acao=2\" class=\"btn btn-primary\">Alterar</a> <a href=\"?codigo={$aLinha['codigo']}&acao=3\" class=\"btn btn-danger\">Deletar</a></td>";
            break;

        default:
        echo "<td>{$xValor}</td>";
            break;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Estoque</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body>

    <a class="btn btn-success" href="index.php?acao=1&codigo=0">Incluir</a>

    <?php montaMenu() ?>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>

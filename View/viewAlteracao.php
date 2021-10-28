<?php

/**
 * Monta o formulário com os valores.
 */
function montaForm() {
    require_once('./Controller/controllerBd.php');
    $aLinha = getFirstFromArray(getDadosLinhaFromCodigo($_SESSION['codigoRegistro']));
    montaCampos($aLinha);
    unset($_SESSION['codigoRegistro']);
}

/**
 * Monta os campos.
 */
function montaCampos($aLinha) {

    echo "<input class=\"campo1 campo\" type=\"number\" name=\"codigo\" id=\"codigo\" value=\"{$aLinha['codigo']}\">";
    echo '<br>';
    echo "<input class=\"campo\" type=\"text\" name=\"nome\" id=\"nome\" value=\"{$aLinha['nome']}\">";
    echo '<br>';
    echo "<input class=\"campo\" type=\"text\" name=\"marca\" id=\"marca\" value=\"{$aLinha['marca']}\">";
    echo '<br>';
    echo "<input class=\"campo\" type=\"number\" name=\"valor\" id=\"valor\" value=\"{$aLinha['valor']}\">";
    echo '<br>';
    echo "<input class=\"campo\" type=\"number\" name=\"quantidade\" id=\"quantidade\" value=\"{$aLinha['quantidade']}\">";
    echo '<br>';

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>

        .tampa {
            z-index: 99;
            background-color: rgba(0, 0, 0, 0.479);
            width: 100%;
            height: 100vh;
            position: fixed;
        }

        .tela {
            z-index: 999;
            position: fixed;
            background-color: white;
            width: 20%;
            height: 40vh;
            margin-left: 40%;
            margin-top: 10%;
        }

        .campo {
            align-content: center;
            align-items: center;
            margin-left: 15%;
        }

        .botao {
            margin-top: 10%;
            margin-left: 35%;
        }

        .campo1 {
            margin-top: 10%;
        }

    </style>
</head>
<body>
    
    <div class="tampa">
        
    </div>

    <div class="tela">

        <form class="formulario" action="index.php?acao=2" method="POST">

        <?php montaForm() ?>

        <button class="botao btn btn-success" type="submit" >Alterar</button>

        </form>

    </div>

</body>
</html>

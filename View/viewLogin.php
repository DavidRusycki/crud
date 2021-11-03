<?php
/**
 * Verifica se deve ou não mostrar a mensagem de erro.
 */
function verificaMensagemErro() {
    if (isset($_SESSION) && isset($_SESSION['erroLogin']) && $_SESSION['erroLogin']) {
        exibeErro();
    }
    unset($_SESSION['erroLogin']);
}

/**
 * Exibe o erro de login.
 */
function exibeErro() {
    echo "
        <div class=\"alert alert-danger\" role=\"alert\">
            Ops :( 
            <br>
            Falha no Login tente novamente!
        </div> 
    ";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>

    #usuario {
        margin-top: 18%;
        margin-bottom: 0.5%;
    }

    #usuario, #senha {
        margin-left: 42%;
    }

    #botao { 
        margin-top: 1%;
        margin-left: 42%;
        width: 14.9%;
    }

    </style>

</head>
<body>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <form action="?acao=4" method="POST">    
        <?php verificaMensagemErro() ?>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario">
        <br>
        <input type="password" name="senha" id="senha" placeholder="Senha">
        <br>
        <button id="botao" class="btn btn-success" type="submit" >Login</button>
    </form>

</body>
</html>

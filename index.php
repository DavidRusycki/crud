<?php
 require_once('./Controller/controllerBase.php');

//Realiza a iniciação da sessão.
// iniciaSessao();

//Validar se o usuário está logado e caso não esteja joga pra o controller de login caso esteja joga para o controller de menu.
// validaInicio();


require_once('./Controller/controllerMenu.php');

exibeMenu();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>

.tampa {
width: 100%;
height: 100vh;
background-color: rgba(0, 0, 0, 0.432);
z-index: 3;
box-sizing: border-box;
position: fixed;
}

.tela {

width: 20%;
height: 100vh;

}

</style>

</head>
<body>
    
<div class="tela">
    
    
    tela

</div>

<div class="tampa">
    ...
</div>

</body>
</html>
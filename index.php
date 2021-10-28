<?php
 require_once('./Controller/controllerBase.php');

//Realiza a iniciação da sessão.
iniciaSessao();

//Validar se o usuário está logado e caso não esteja joga pra o controller de login caso esteja joga para o controller de menu.
validaInicio();


// require_once('./Controller/controllerMenu.php');

// exibeMenu();

?>

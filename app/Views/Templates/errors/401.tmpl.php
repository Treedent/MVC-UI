<?php

use SYRADEV\app\MvcUIController;

?>
<div id="messageError" class="text-center px-5 py-5 animate__animated animate__fadeIn">
    <a href="<?= MvcUIController::getRoute('home'); ?>" title="Page d'accueil">
        <img id="mvclogo" src="<?= MvcUIController::assets('/imgs/mvc-ui-.svg'); ?>"
             alt="Application MVC"></a>
    <h1 class="display-5">Oh ! 401 ACC&Egrave;S NON AUTORIS&Eacute;</h1>
    <p>Malheureusement, vous n'avez pas accès &agrave; cette page.<br> vous pouvez retourner &agrave; la page
        <a href="<?= MvcUIController::getRoute('home'); ?>" title="Retourner à la page d'accueil">d'accueil</a> <br>ou retourner à la <a
            href="javascript:history.go(-1);">page pr&eacute;cédente</a>.</p>
</div>

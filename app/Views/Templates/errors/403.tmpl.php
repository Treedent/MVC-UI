<?php

use SYRADEV\app\MvcUIController;

?>
<div id="messageError" class="text-center px-5 py-5 animate__animated animate__fadeIn">
    <a href="<?= MvcUIController::getRoute('home'); ?>" title="Page d'accueil">
        <img id="mvclogo" src="<?= MvcUIController::assets('/imgs/mvc-ui-.svg'); ?>"
             alt="Application MVC"></a>
    <h1 class="display-5">Oh! 403 - ACCÈS INTERDIT</h1>
    <p>Malheureusement, vous n'avez pas accès à cette page.<br> vous pouvez soit retourner &agrave; la page
        <a href="<?= MvcUIController::getRoute('home'); ?>" title="Retourner &agrave; la page d'accueil">d'accueil</a> <br>soit revenir &agrave; la <a
            href="javascript:history.go(-1);" title="Revenir &agrave; la page pr&eacute;c&eacute;dente">page pr&eacute;c&eacute;dente</a>.</p>
</div>

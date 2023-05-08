<?php

use SYRADEV\app\MvcUIController;

?>
<div id="messageError" class="text-center px-5 py-5 animate__animated animate__fadeIn">
    <a href="<?= MvcUIController::getRoute('home'); ?>" title="Page d'accueil">
        <img id="mvclogo" src="<?= MvcUIController::assets('/imgs/mvc-ui-.svg'); ?>"
             alt="Application MVC"></a>
    <h1 class="display-5">Oh! 500 - Erreur interne du serveur</h1>
    <p>Malheureusement, Une erreur s'est produite sur le serveur. <br>Vous pouvez soit retourner &agrave; la page
        <a href="<?= MvcUIController::getRoute('home'); ?>" title="Retourner &agrave; la page d'accueil">d'accueil</a>
        <br>soit
        revenir &agrave; la <a
                href="javascript:history.go(-1);" title="Revenir &agrave; la page pr&eacute;c&eacute;dente">page pr&eacute;c&eacute;dente</a>.
    </p>
</div>

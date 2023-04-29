<?php
/**
 * MvcUI page d'erreur 404
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.0.0
 */

use SYRADEV\app\MvcUIController;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erreur 404</title>
    <link rel="icon" type="image/png" href="<?= MvcUIController::assets('/imgs/favicon.png'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/404.min.css'); ?>">
</head>
<body oncontextmenu="return false;">
<div id="main404" class="d-flex justify-content-center align-items-center">
    <div id="message404" class="text-center px-5 py-5 animate__animated animate__fadeIn">
        <a href="<?= MvcUIController::getRoute('home'); ?>" title="Page d'accueil">
            <img id="mvclogo" src="<?= MvcUIController::assets('/imgs/mvc-ui-.svg'); ?>"
                 alt="Application MVC"></a>
        <h1 class="display-5">Oh ! 404 PAGE NON TROUVÉE</h1>
        <p>Malheureusement, cette page n'existe pas. <br>Veuillez vérifier votre URL <br> ou retourner à la page
            <a href="<?= MvcUIController::getRoute('home'); ?>" title="Retourner à la page d'accueil">d'accueil</a> <br>ou retourner à la <a
                    href="javascript:history.go(-1);">page précédente</a>.</p>
    </div>
</div>
<script src="<?= MvcUIController::assets('/js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>

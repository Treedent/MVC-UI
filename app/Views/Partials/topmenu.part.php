<?php
/**
 * MvcUI Menu du haut
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.0.0
 */

use SYRADEV\app\MvcUIController;

?>

<nav class="navbar navbar-expand-lg bg-body-primary" id="top-menu">
    <div class="container-fluid">
        <span>Navigation</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link<?= MvcUIController::isActive(['home']); ?>" aria-current="page"
                       href="<?= MvcUIController::getRoute('home'); ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= MvcUIController::isActive(['pagination']); ?>"
                       href="<?= MvcUIController::getRoute('pagination'); ?>">Pagination</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= MvcUIController::isActive(['doc']); ?>"
                       href="<?= MvcUIController::getRoute('doc'); ?>">Docs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link<?= MvcUIController::isActive(['infiniteScroll']); ?>"
                       href="<?= MvcUIController::getRoute('infiniteScroll'); ?>">Défilement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= MvcUIController::getRoute('404'); ?>">Page 404</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= MvcUIController::getRoute('login'); ?>">Se connecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

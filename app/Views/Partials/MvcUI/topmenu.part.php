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
 * @version    1.3.0
 */

use SYRADEV\app\MvcUIController;

?>

<nav class="navbar navbar-expand-lg" id="top-menu">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link<?= MvcUIController::isActive(['home']); ?>"
                       href="<?= MvcUIController::getRoute('home'); ?>">Accueil</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= MvcUIController::isActive(['redirectpagination','ajaxpagination','productslist']); ?>" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Paginations
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="nav-link<?= MvcUIController::isActive(['redirectpagination']); ?>"
                               href="<?= MvcUIController::getRoute('redirectpagination'); ?>">Pagination redirigée</a>
                        </li>
                        <li>
                            <a class="nav-link<?= MvcUIController::isActive(['ajaxpagination']); ?>"
                               href="<?= MvcUIController::getRoute('ajaxpagination'); ?>">Pagination ajax</a>
                        </li>
                        <li>
                            <a class="nav-link<?= MvcUIController::isActive(['productslist']); ?>"
                               href="<?= MvcUIController::getRoute('productslist'); ?>">Scroll infini</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= MvcUIController::isActive(['apidoc','dbdoc']); ?>" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Documentation
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link<?= MvcUIController::isActive(['apidoc']); ?>"
                       href="<?= MvcUIController::getRoute('apidoc'); ?>">Doc API</a>
                        </li>
                        <li><a class="nav-link<?= MvcUIController::isActive(['dbdoc']); ?>"
                               href="<?= MvcUIController::getRoute('dbdoc'); ?>">Doc DB northwind</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        Pages d'erreurs
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= MvcUIController::getRoute('500'); ?>">Erreur 500</a></li>
                        <li><a class="dropdown-item" href="<?= MvcUIController::getRoute('404'); ?>">Erreur 404</a></li>
                        <li><a class="dropdown-item" href="<?= MvcUIController::getRoute('403'); ?>">Erreur 403</a></li>
                        <li><a class="dropdown-item" href="<?= MvcUIController::getRoute('401'); ?>">Erreur 401</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= MvcUIController::getRoute('login'); ?>">Se connecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

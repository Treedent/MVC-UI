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
 * @version    1.4.0
 */

use SYRADEV\app\MvcUIController;

/**
 * @var $logo
 * @var $title
 * @var $toptitle
 */


?>

<nav class="navbar navbar-expand-lg" id="top-menu">
    <a href="<?= MvcUIController::getRoute('home'); ?>" class="navbar-brand align-middle">
        <img id="top-logo" src="<?= MvcUIController::assets($logo); ?>"
             class="d-inline-block animated fadeIn" alt="<?= $title; ?>">
    </a>
    <h1 id="top-title" class="align-middle"><?= $toptitle; ?></h1>
    <button class="navbar-toggler" id="hamburger" type="button"
            aria-controls="navbarMvcui" aria-expanded="false" aria-label="Basculer la navigation">
        <span id="animated-hamburger"><span></span><span></span><span></span><span></span></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarMvcui">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link<?= MvcUIController::isActive(['home']); ?>"
                   href="<?= MvcUIController::getRoute('home'); ?>">Accueil</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= MvcUIController::isActive(['redirectpagination', 'ajaxpagination', 'productslist', 'productsbycategory']); ?>"
                   href="#" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Démos
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
                    <li>
                        <a class="nav-link<?= MvcUIController::isActive(['productsbycategory']); ?>"
                           href="<?= MvcUIController::getRoute('productsbycategory'); ?>">Produits SQL Join</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?= MvcUIController::isActive(['apidoc', 'dbdoc','relationsdoc']); ?>" href="#"
                   role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    Documentation
                </a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link<?= MvcUIController::isActive(['apidoc']); ?>"
                           href="<?= MvcUIController::getRoute('apidoc'); ?>">Doc API</a>
                    </li>
                    <li><a class="nav-link<?= MvcUIController::isActive(['dbdoc']); ?>"
                           href="<?= MvcUIController::getRoute('dbdoc'); ?>">Doc BDD northwind</a>
                    </li>
                    <li><a class="nav-link<?= MvcUIController::isActive(['relationsdoc']); ?>"
                           href="<?= MvcUIController::getRoute('relationsdoc'); ?>">Doc relations BDD</a>
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
</nav>

<?php
/**
 * MvcUI template page d'accueil
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

$degres = MvcUIController::huerotate();

?>

<div class="container py-2 py-md-4 py-lg-5">
    <div class="row">
        <div class="col">
            <figure class="card position-relative bg-light-subtle py-3 p-0 p-lg-4 mt-4 mb-0 ms-xl-5 animated fadeIn" style="border: none;">
                <span class="btn btn-icon btn-lg pe-none position-absolute top-0 start-0 translate-middle-y ms-4 ms-lg-5"
                      style="background:#ff8e31;filter: hue-rotate(<?= $degres; ?>);">
                  <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#ffffff" viewBox="0 0 16 16">
                      <path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 9 7.558V11a1 1 0 0 0 1 1h2Zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612c0-.351.021-.703.062-1.054.062-.372.166-.703.31-.992.145-.29.331-.517.559-.683.227-.186.516-.279.868-.279V3c-.579 0-1.085.124-1.52.372a3.322 3.322 0 0 0-1.085.992 4.92 4.92 0 0 0-.62 1.458A7.712 7.712 0 0 0 3 7.558V11a1 1 0 0 0 1 1h2Z"/>
                  </svg>
                </span>
                <blockquote class="card-body mt-2 mb-0">
                    <img style="margin-left: 20px;filter: hue-rotate(<?= $degres; ?>);" class="float-end w-25"
                         src="<?= MvcUIController::assets('/imgs/man_orange.png'); ?>" alt="Mvc::ui">
                    <p class="text-end mt-1 mb-5"><strong>MVC::UI</strong> est un package open-source proposant un squelette de
                        démarrage pour des applications web
                        basées sur le modèle MVC. Ce squelette est développé en PHP8, avec une implémentation côté
                        client en javascript ES6,
                        et une base de données MySQL.</p>
                    <p class="text-end  mt-1 mb-5">Ce package fournit un ensemble de fonctionnalités permettant de développer
                        rapidement une
                        application web MVC en fournissant une structure de projet préconfigurée avec des dossiers et
                        des fichiers pour
                        chaque partie de l'architecture. Le squelette fournit également une implémentation de base pour
                        les fonctionnalités
                        telles que l'authentification, les sessions utilisateur, les pages d'erreur, les requêtes AJAX,
                        etc.</p>
                    <p class="text-end  mt-1 mb-5">Le squelette MVC::UI suit les meilleures pratiques de développement et est
                        hautement
                        personnalisable. Il est facilement extensible avec des modules tiers, tels que des bibliothèques
                        de composants
                        frontend, et il est compatible avec les outils de développement tels que NPM.</p>
                    <p class="text-end  mt-1 mb-5">En utilisant MVC::UI comme base de développement pour votre application web,
                        vous pouvez
                        accélérer considérablement votre processus de développement et vous concentrer sur la création
                        de fonctionnalités
                        spécifiques à votre application plutôt que sur la configuration et l'organisation de votre
                        projet. De plus, en
                        utilisant un squelette éprouvé et stable, vous pouvez être sûr que votre application sera
                        robuste et sécurisée de bout en bout.</p>
                    <p class="text-end  mt-1 mb-5">En résumé, MVC::UI est un package open-source de haute qualité pour les
                        développeurs
                        d'applications web qui cherchent à créer des applications MVC rapides, sécurisées et
                        personnalisables.</p>
                </blockquote>
                <figcaption class="card-footer border-0 d-sm-flex justify-content-center">
                    <div class="align-middle m-2">
                        <h5 class="mb-0">John Doe</h5>
                        <span class="fs-sm text-muted">Mvc::UI</span>
                    </div>
                    <div class="align-middle m-2">
                        <img style="filter: hue-rotate(<?= $degres; ?>);"
                             src="<?= MvcUIController::assets('/imgs/syradev.svg'); ?>" class="d-block" alt="Syradev"
                             width="50">
                    </div>
                </figcaption>
            </figure>
        </div>
    </div>
</div>



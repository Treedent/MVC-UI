<?php
/**
 * MvcUI template Démo pagination Ajax
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

use SYRADEV\app\PdoMySQL;
use SYRADEV\app\DemoController;
$pg = DemoController::getInstance();
$cnx = PdoMySQL::getInstance();

/** La page par défaut */
$page = 1;

/** Nombre de clients par page */
$maxPerPage = $_SESSION['mvcRoutes']['clientslist']['elements_per_page'];

/** Compte le nombre de clients en base **/
$nbClients = $cnx->compteTable('Customers')['nombre'];

/** Nom de la méthode javascript à exécuter */
$method = 'refreshClients';

/** Alignement de la barre de pagination */
$align = 'left';

/** Animation de chargement */
$loader = $pg->renderPartial('/MvcUI/loader', ['width' => 250, 'height' => 250]);

/** Identifiant unique pour paginations multiples */
$uniq = uniqid ();
?>

<div class="container">
    <?= DemoController::getAjaxPagination($page, $maxPerPage, $nbClients, $method, $align, $uniq); ?>
    <div class="w-100 border-1 bg-light pt-2">
        <h1 class="display-6">Liste des clients</h1>
        <hr>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped rounded-3">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contact</th>
                        <th>T&eacute;l&eacute;phone</th>
                        <th>Soci&eacute;t&eacute;</th>
                        <th>Ville</th>
                        <th>Pays</th>
                    </tr>
                    </thead>
                    <tbody id="clientslist">
                    <tr>
                        <td colspan="6">Chargement des données...</td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-center">
                            <?= $loader ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?= DemoController::getAjaxPagination($page, $maxPerPage, $nbClients, $method, $align, $uniq); ?>
</div>

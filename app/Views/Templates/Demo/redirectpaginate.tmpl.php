<?php
/**
 * MvcUI Template Démo pagination redirigée
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

use SYRADEV\app\DemoController;

$redirectpage = $_GET['redirectpage'] ?? 1;
/**
 * @var array $data Les données reçues du controller
 */
extract($data);
?>

<div class="container">
    <?= DemoController::getPagination($redirectpage, $nbpages, 'redirectpagination','center'); ?>
    <div class="w-100 border-1 bg-light pt-2">
        <h1 class="display-6 text-center">Liste des clients</h1>
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
                    <tbody>
                    <?php foreach ($clients as $client) {
                        extract($client);
                        ?>
                        <tr>
                            <td><?= $CustomerID; ?></td>
                            <td><?= $ContactName; ?></td>
                            <td><?= $Phone; ?></td>
                            <td><?= $CompanyName; ?></td>
                            <td><?= $City; ?></td>
                            <td><?= $Country; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?= DemoController::getPagination($redirectpage, $nbpages,'redirectpagination', 'center'); ?>
</div>

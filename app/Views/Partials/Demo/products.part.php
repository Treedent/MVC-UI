<?php
/**
 * MvcUI Partiel Démo products scroll infini
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
 * @var array $params
 */

foreach ($params as $product) {
    extract($product);
    ?>
    <div class="col produit animated fadeInLeft">
        <div class="card">
            <img src="<?= MvcUIController::assets('/imgs/product.svg'); ?>"
                 style="display:block; margin: auto; filter: hue-rotate(<?= MvcUIController::huerotate(); ?>);"
                 class="card-img-top w-25"
                 alt="<?= $ProductName; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $ProductID . ': ' . $ProductName; ?></h5>
                <h6 class="card-text">
                    <?= $QuantityPerUnit; ?><br>
                    <span class="badge badge-lg bg-success"><?= MvcUIController::formalizeEuro($UnitPrice); ?></span>
                </h6>
            </div>
        </div>
    </div>
<?php } ?>

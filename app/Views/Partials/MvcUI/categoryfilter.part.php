<?php
/**
 *  MvcUI Partiel de filtrage par catégories
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

/** @var array $data */
?>
<div class="col mt-3 mb-3">
    Filtrer par catégorie&nbsp;:
    <div class="btn-group btn-group-sm flex-wrap filters">
        <a href="#" class="btn btn-outline-primary active" data-filter="*">Toutes</a>
        <?php
        foreach ($data['categories'] as $category) {
            ?>
            <a href="#" class="btn btn-outline-primary"
               data-filter=".<?= MvcUIController::sanitizeName($category); ?>"><?= $category; ?></a>
        <?php } ?>
    </div>
</div>
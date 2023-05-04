<?php
/**
 * MvcUI partiel affichant une barre de pagination
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.2.0
 */
use SYRADEV\app\MvcUIController;

/** @var $params */
extract($params);
?>
<div class="w-100 mt-3 mb-3 d-flex justify-content-<?= $align; ?>">
    <nav aria-label="Pagination d-flex flex-row-reverse">
        <ul class="pagination pagination-sm">
            <?php
            $prevDisabled = $num === 1 ? ' disabled' : '';
            $prevLink = MvcUIController::getRoute('pagination') . '/' . ($num - 1);
            ?>
            <li class="page-item<?= $prevDisabled; ?>">
                <a class="page-link" href="<?= $prevLink; ?>">Pr&eacute;c&eacute;dent</a>
            </li>
            <?php
            for ($i = 1; $i <= $maxpage; $i++) {
                $active = $i === $num ? ' active' : '';
                ?>
                <li class="page-item">
                    <a class="page-link<?= $active; ?>"
                       href="<?= MvcUIController::getRoute('pagination') . '/' . $i; ?>"><?= $i; ?></a>
                </li>
            <?php }
            $nextDisabled = $num === $maxpage ? ' disabled' : '';
            $nextLink = MvcUIController::getRoute('pagination') . '/' . ($num + 1);
            ?>
            <li class="page-item<?= $nextDisabled; ?>">
                <?php ?>
                <a class="page-link" href="<?= $nextLink; ?>">Suivant</a>
            </li>
        </ul>
    </nav>
</div>
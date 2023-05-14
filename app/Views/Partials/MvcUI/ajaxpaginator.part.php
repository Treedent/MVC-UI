<?php
/**
 * MvcUI partiel affichant une barre de pagination ajax
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

/** @var $params */
extract($params);
$nbPages = $maxrecords > 0 ? ceil($maxrecords / $maxperpage) : 0;

?>
<div class="w-100 mt-3 mb-3 d-flex justify-content-<?= $align; ?>">
    <nav class="ajaxPagination d-flex flex-row-reverse" aria-label="ajax pagination">
        <input type="hidden" class="currentpage" value="1">
        <input type="hidden" class="nbpages" value="<?= $nbPages; ?>">
        <ul class="pagination pagination-sm flex-wrap" data-paginatorid="<?= $uniq;?>">
            <?php
            $prevDisabled = $numpage <= 1 ? ' disabled' : '';
            ?>
            <li class="page-item<?= $prevDisabled; ?>">
                <a class="page-link" href="#" data-action="<?= $action; ?>" data-page="prev">Pr&eacute;c&eacute;dent</a>
            </li>
            <?php
            for ($i = 1; $i <= $nbPages; $i++) {
                $active = $i === $numpage ? ' active' : '';
                ?>
                <li class="page-item">
                    <a class="page-link<?= $active; ?>" href="#" data-action="<?= $action; ?>" data-page="<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php }
            $nextDisabled = $numpage >= $nbPages ? ' disabled' : '';
            ?>
            <li class="page-item<?= $nextDisabled; ?>">
                <?php ?>
                <a class="page-link" href="#" data-action="<?= $action; ?>" data-page="next">Suivant</a>
            </li>
        </ul>
    </nav>
</div>
<?php
/**
 * MvcUI template partiel de Footer
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
$MvcUi = MvcUIController::getInstance();

/** @var $footer ** */
extract($footer);
?>
<footer id="mvcfooter" class="row p-2 mb-3 bg-light border rounded-3">
    <div class="col">
        <p class="text-center">Mvc::UI v.<?= $MvcUi->getConf('version'); ?>&nbsp;&copy;&nbsp;Syradev <?= date('Y'); ?>
            <a id="to-top" href="#" title="Haut de la page.">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                </svg>
            </a>
        </p>
    </div>
</footer>

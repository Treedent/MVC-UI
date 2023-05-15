<?php
/**
 * MvcUI Template avec iframe
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
 * @var $data
 */
extract($data);

/**
 * @var $appurl * Url à afficher dans l'iframe
 * @var $apptitle * Titre de l'application
 */
?>
<div class="container animated fadeIn">
    <button type="button" id="fullscreen" class="btn btn-primary text-white d-none d-sm-block">Plein écran</button>
    <div class="row">
        <div class="col">
            <iframe src="<?= $appurl; ?>" id="framed" referrerpolicy="strict-origin-when-cross-origin"
                    title="<?= $apptitle; ?>"></iframe>
        </div>
    </div>
</div>

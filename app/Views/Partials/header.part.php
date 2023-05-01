<?php
/**
 * MvcUI template partiel de Header
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.1.0
 */

use SYRADEV\app\MvcUIController;

/** @var $header ** */
extract($header);
?>

<header id="mvcheader" class="row p-2 mb-3 bg-light border rounded-3">
    <div class="col-3 align-middle">
        <a href="<?= MvcUIController::getRoute('home'); ?>">
            <img src="<?= MvcUIController::assets($logo); ?>" class="w-50 animate__animated animate__fadeIn" alt="<?= $title; ?>">
        </a>
    </div>
    <div class="col-3 align-middle">
    </div>
    <div class="col-6 d-flex justify-content-end align-items-center">
        <?php require_once MvcUIController::partial('/topmenu.part.php');?>
    </div>
</header>

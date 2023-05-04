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
 * @version    1.2.0
 */

use SYRADEV\app\MvcUIController;

/** @var $header ** */
extract($header);
?>

<header id="mvcheader" class="row p-2 mb-3 bg-light border rounded-3">
    <div class="col-2 align-middle">
        <a href="<?= MvcUIController::getRoute('home'); ?>">
            <img src="<?= MvcUIController::assets($logo); ?>" class="w-100 animate__animated animate__fadeIn align-middle" alt="<?= $title; ?>">
        </a>
    </div>
    <div class="col-4 align-middle" id="title-bar">
        <h1 class="display-6 align-middle pt-1"><?= $toptitle; ?></h1>
    </div>
    <div class="col-6 d-flex justify-content-end align-items-center">
        <?php require_once MvcUIController::partial('/topmenu.part.php');?>
    </div>
</header>

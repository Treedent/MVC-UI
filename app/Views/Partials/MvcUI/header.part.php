<?php
/**
 * MvcUI Partiel de Header
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.5.0
 */

use SYRADEV\app\MvcUIController;

/** @var $header ** */
extract($header);
?>

<header id="mvcheader" class="row p-2 mb-3 rounded-3 align-middle">
        <?php require_once MvcUIController::partial('/MvcUI/topmenu.part.php'); ?>
</header>

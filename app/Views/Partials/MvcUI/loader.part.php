<?php
/**
 * MvcUI Partiel animation ajax
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
 extract($params);
?>
<img width="<?= $width; ?>" height="<?= $height; ?>" src="<?=MvcUIController::assets('/imgs/puff.svg') ;?>" alt="Chargement...">

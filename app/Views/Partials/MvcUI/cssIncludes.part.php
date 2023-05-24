<?php
/**
 * MvcUI Inclusion de fichiers CSS additionnels
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

if (MvcUIController::isRoute('dashboard')) {

    echo '<link rel="stylesheet" href="'. MvcUIController::assets('/css/dashboard.min.css').'">';

}

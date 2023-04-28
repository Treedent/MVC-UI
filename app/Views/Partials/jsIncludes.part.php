<?php
/***
 * MvcUI Inclusion de fichiers JS additionnels
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

if (MvcUIController::isRoute('dashboard', true)) {
    echo '<script src="'. MvcUIController::assets('/js/dashboard.min.js').'"></script>';
}
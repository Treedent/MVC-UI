<?php
/**
 * MvcUI fichier d'autochargement des classes
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

require_once __DIR__ . '/Classes/MvcUIController.php';
require_once __DIR__ . '/Classes/PdoMySQL.php';
require_once __DIR__ . '/Classes/PdoDebug.php';
require_once __DIR__ . '/Classes/DemoController.php';
require_once __DIR__ . '/Classes/UsersController.php';
require_once __DIR__ . '/Models/UserModel.php';

use SYRADEV\app\MvcUIController;
$mvcUI = MvcUIController::getInstance();
$mvcUI->cacheRoutes();
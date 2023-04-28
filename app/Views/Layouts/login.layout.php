<?php
/***
 *  MvcUI Layout Login
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.0.0
 */

use SYRADEV\app\MvcUIController;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= MvcUIController::getCSRFToken(); ?>">
    <meta http-equiv="refresh" content="3000">
    <title>MVCUi login</title>
    <link rel="icon" type="image/png" href="<?= MvcUIController::assets('/imgs/favicon.png'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/bootstrap-icons.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/login.min.css'); ?>">
</head>
<body oncontextmenu="return false;" data-bs-theme="light">
<div id="mainLogin" class="d-flex align-items-center">
    <div id="loginContainer" class="animate__animated animate__fadeIn">
        <div class="text-center mb-4">
            <img id="loginLogo" src="<?= MvcUIController::assets('/imgs/mvc-ui.svg'); ?>" alt="MvcUI">
        </div>
        <?php if (!MvcUIController::isConnected()) { ?>
            <form autocomplete="off">
                <div class="form-group my-2">
                    <label class="d-block" for="mvcun">Username:</label>
                    <input type="text" class="form-control" id="mvcun" placeholder="________________________" required>
                </div>
                <div class="form-group my-2">
                    <label class="d-block" for="mvcpw">Password:</label>
                    <input type="password" class="form-control" id="mvcpw" placeholder="________________________" required>
                </div>
                <div class="form-group my-6">
                    <button type="button" id="connect" class="btn btn-primary w-100 text-white">Login</button>
                </div>
            </form>
        <?php } else { ?>
            <div class="text-center mt-4 mb-4">
                <p>Vous êtes connecté : <span class="text-primary"><?= $_SESSION['admin']; ?></span></p>
                <button type="button" data-id="disconnect" class="btn btn-secondary text-white">
                    Logout
                </button>
                <a href="<?= MvcUIController::getRoute('home'); ?>" class="btn btn-primary text-white">
                    Enter
                </a>
            </div>
        <?php } ?>
        <div class="text-center my-2">
            <span class="small normal text-black">Syradev&copy;<?= date('Y'); ?></span>
        </div>
    </div>
</div>

<script src="<?= MvcUIController::assets('/js/docready.min.js'); ?>"></script>
<script src="<?= MvcUIController::assets('/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= MvcUIController::assets('/js/crypto-js.min.js'); ?>"></script>
<script src="<?= MvcUIController::assets('/js/aesjson.min.js'); ?>"></script>
<script src="<?= MvcUIController::assets('/js/login.min.js'); ?>"></script>
</body>
</html>

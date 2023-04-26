<?php
/***
 *  MvcUI Layout principal du frontend
 *
 * MvcUI Application
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.0.0
 ***/

use Syradev\app\MvcUIController;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= MvcUIController::getCSRFToken(); ?>">
    <title>{{ pageTitle }}</title>
    <link rel="icon" type="image/png" href="<?= MvcUIController::assets('/imgs/favicon.png'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/mvcui.min.css'); ?>">
    <?php require_once MvcUIController::partial('/cssIncludes.part.php'); ?>
</head>
<body oncontextmenu="return false;" data-bs-theme="light">
<div class="container">
    <div class="row flex-nowrap">
        <main id="mvcMain" class="col ps-md-2 pt-1">
            <div class="row">
                <div class="col">
                    <?php
                        $header = [
                            'logo' => '/imgs/mvc-ui.svg',
                            'title' => 'MVC-UI'
                        ];
                        require_once MvcUIController::partial('/header.part.php');
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    {{ pageContent }}
                </div>
            </div>
            <div id="row footer">
                <?php
                $footer = [
                    'logo' => '/imgs/mvc-ui.svg',
                    'title' => 'MVC-UI',
                    'classTitle' => 'php'
                ];
                require_once MvcUIController::partial('/footer.part.php');
                ?>
            </div>
        </main>
    </div>
</div>
<script src="<?= MvcUIController::assets('/js/docready.min.js'); ?>"></script>
<script src="<?= MvcUIController::assets('/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= MvcUIController::assets('/js/mvcui.min.js'); ?>"></script>
<?php require_once MvcUIController::partial('/jsIncludes.part.php'); ?>
</body>
</html>
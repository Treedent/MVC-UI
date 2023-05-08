<?php
/**
 * MvcUI Layout page d'erreur
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.3.0
 */

use SYRADEV\app\MvcUIController;

/**
 * @var string $data
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Erreur 404</title>
    <link rel="icon" type="image/svg+xml" href="<?= MvcUIController::assets('/imgs/favicon.svg'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/animate.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= MvcUIController::assets('/css/errors.min.css'); ?>">
</head>
<body oncontextmenu="return false;">
<div id="mainError" class="d-flex align-items-center <?= $data; ?>">
    {{ pageContent }}
</div>
</body>
</html>

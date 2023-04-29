<?php
/**
 * MvcUI template de test
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

use SYRADEV\app\PaginateController;

$num = $_GET['num'] ?? 1;
$max = 10;

?>

<?= PaginateController::getPagination($num, $max, 'start'); ?>
<?= PaginateController::getPagination($num, $max, 'center'); ?>
<?= PaginateController::getPagination($num, $max, 'end'); ?>

<div class="w-100 border-1 bg-light-subtle text-center">
    <h1 class="display-big rainbow_text_animated">#<?= $num; ?></h1>
</div>
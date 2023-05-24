<?php
/**
 * MvcUI Partiel Informations de copyrights
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

extract($params);
/**
 * @var $app_name * Nom de l'application
 * @var $version * Version de l'application
 * @var $company * Nom de la société
 */
?>
<span class="small text-black">
    <?= $app_name; ?>&nbsp;v.<?= $version; ?>&nbsp;&copy;&nbsp;<?= $company; ?>&nbsp;<?= date('Y'); ?>
</span>

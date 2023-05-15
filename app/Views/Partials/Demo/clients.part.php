<?php
/**
 * MvcUI Partiel Démo clients ajax
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

/**
 * @var array $params Données envoyées depuis le controleur
 */

extract($params);

foreach ($clients as $client) {
    extract($client);
    ?>
    <tr>
        <td><?= $CustomerID; ?></td>
        <td><?= $ContactName; ?></td>
        <td><?= $Phone; ?></td>
        <td><?= $CompanyName; ?></td>
        <td><?= $City; ?></td>
        <td><?= $Country; ?></td>
    </tr>
<?php } ?>

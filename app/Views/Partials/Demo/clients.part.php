<?php

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

<?php
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

<?php
 use SYRADEV\app\MvcUIController;
 extract($params);
?>
<img width="<?= $width; ?>" height="<?= $height; ?>" src="<?=MvcUIController::assets('/imgs/puff.svg') ;?>" alt="Chargement...">

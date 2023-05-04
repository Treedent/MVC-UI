<?php

use SYRADEV\app\MvcUIController;

/**
 * @var $params
 */

foreach ($params as $product) {
    extract($product);
    ?>
    <div class="col produit animate__animated animate__backInLeft">
        <div class="card">
            <img src="<?= MvcUIController::assets('/imgs/product.svg'); ?>"
                 style="display:block; margin: auto; filter: hue-rotate(<?= MvcUIController::huerotate(); ?>);"
                 class="card-img-top w-25"
                 alt="<?= $ProductName; ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $ProductID . ': ' . $ProductName; ?></h5>
                <h6 class="card-text">
                    <?= $QuantityPerUnit; ?><br>
                    <span class="badge badge-lg bg-success"><?= MvcUIController::formalizeEuro($UnitPrice); ?></span>
                </h6>
            </div>
        </div>
    </div>
<?php } ?>

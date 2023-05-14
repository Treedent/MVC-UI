<?php

/**
 * @var $data
 */

use SYRADEV\app\MvcUIController;

?>
<div class="container mt-3">
    <div class="row mb-3 animated fadeIn">
        <?php require_once MvcUIController::partial('/MvcUI/categoryfilter.part.php'); ?>
    </div>
    <div class="row mb-3 animated fadeIn">
        <?php require_once MvcUIController::partial('/MvcUI/orderfilter.part.php'); ?>
    </div>
    <div class="row grid">
        <?php foreach ($data['products'] as $product) {
            extract($product); ?>
            <div class="card grid-item product <?= MvcUIController::sanitizeName($CategoryName); ?>">
                <img src="data:image/jpeg;base64,<?= base64_encode($Picture); ?>" class="card-img-top img-rounded"
                     alt="<?= $CategoryName; ?>">
                <h6 class="cardImgTitle"><?= $CategoryName; ?></h6>
                <div class="card-body">
                    <h5 class="card-title text-center"><?= $ProductName; ?></h5>
                    <div class="card-text">
                        <table class="table table-sm">
                            <tbody>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Quantity per unit:</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="float-end"><?= $QuantityPerUnit; ?>.</mark>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Unit price:</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="float-end"><?= MvcUIController::formalizeEuro($UnitPrice); ?>.</mark>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Units in stock:</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="float-end"><?= $UnitsInStock; ?>.</mark>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Supplier:</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="bg-info-subtle float-end"><?= $CompanyName; ?>.</mark>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Contact :</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="bg-info-subtle float-end"><?= $ContactName; ?>.</mark>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Phone :</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="bg-info-subtle float-end"><?= $Phone; ?>.</mark>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="small fst-italic">Country :</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <mark class="bg-info-subtle float-end"><?= $Country; ?>.</mark>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php
/**
 * MvcUI Inclusion de fichiers JS additionnels
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

if (MvcUIController::isRoute('productslist', true)) {
    echo '<script src="'. MvcUIController::assets('/js/infinite-scroll.pkgd.min.js').'"></script>';
    echo '<script src="'. MvcUIController::assets('/js/products-scroll.min.js').'"></script>';
}

if (MvcUIController::isRoute('ajaxpagination', true)) {
    echo '<script src="'. MvcUIController::assets('/js/clients-ajax.min.js').'"></script>';
}

if (MvcUIController::isRoute('productsbycategory', true)) {
    echo '<script src="'. MvcUIController::assets('/js/isotope.pkgd.min.js').'"></script>';
    echo '<script src="'. MvcUIController::assets('/js/isotope.min.js').'"></script>';
}
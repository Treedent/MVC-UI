<?php
/**
 * MvcUI template page de défilement de contenu
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.2.0
 */

use SYRADEV\app\MvcUIController;

/**
 * @var $data
 */

?>

<div class="container py-2 py-md-4 py-lg-5">
    <div class="row">
        <div class="col">
            <div class="row row-cols-3 g-4" id="products-container">

                <div class="page-load-status">
                    <div class="loader-ellipse infinite-scroll-request">
                        <span class="loader-ellipse__dot"></span>
                        <span class="loader-ellipse__dot"></span>
                        <span class="loader-ellipse__dot"></span>
                        <span class="loader-ellipse__dot"></span>
                    </div>
                    <p class="infinite-scroll-last">Fin du contenu</p>
                    <p class="infinite-scroll-error">Il n'y a plus de pages à charger</p>
                </div>
            </div>
        </div>
    </div>
</div>



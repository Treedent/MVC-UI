/**
 * MvcUI Product demo Scroll
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

docReady(() => {

    'use strict';
    let d = document;

    let csrfToken;
    if (d.querySelector('meta[name="csrf-token"]') !== null) {
        csrfToken = d.querySelector('meta[name="csrf-token"]').content;
    }
    const ajaxHeaders = {
        'X-Requested-With': 'XMLHttpRequest',
        'cache': 'no-cache',
        'Cache-Control': 'no-store, no-transform, max-age=0, private',
        'Content-Type': 'application/json'
    };
    if (csrfToken !== null) {
        ajaxHeaders['X-CSRF-TOKEN'] = csrfToken;
    }

    let infScroll = new InfiniteScroll( '#products-container', {
        path: function() {
            let pagenumber = ( this.loadCount + 1);
            return `/api/products/${pagenumber}`;
        },
        fetchOptions: {
            headers: ajaxHeaders
        },
        append: '.produit',
        prefill: true,
        history: false,
        status: '.page-load-status',
        debug: false
    });
});
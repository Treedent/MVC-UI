/**
 * MvcUI JavaScript login/logout
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.0.0
 */

docReady(() => {

    'use strict';

    const d = document;

    /** Constantes des sélecteurs */
    const loginBtn = d.querySelector("#connect");

    loginBtn.addEventListener('click', (e) => {
        e.preventDefault();
        d.location.href= '/';
    });

});
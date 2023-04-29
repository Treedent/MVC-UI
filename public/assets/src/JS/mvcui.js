/**
 * MvcUI JavaScript principal
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
    const totop = d.querySelector('#to-top');

    /** Evènement click sur bouton To top */
    totop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
    window.onscroll = () => {
        if (d.body.scrollTop > 20 || d.documentElement.scrollTop > 20) {
            totop.style.display = 'block';
        } else {
            totop.style.display = 'none';
        }
    }

});
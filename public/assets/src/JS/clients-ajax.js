/**
 * MvcUI Javascript Démo liste client paginée avec Ajax
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.3.0
 */


docReady(() => {

    'use strict';
    const d = document;
    const clientslist = d.querySelector('#clientslist');

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

    /** Affichage des clients par page */
    window.refreshClients = function(page){
        clientslist.innerHTML = '<tr><td colSpan="6">Chargement des données...</td></tr>';
        /** Appel des données paginées */
        fetch('/api/clients/' + page, {
            headers: ajaxHeaders
        }).then((response) => {
            return response.text();
        }).then((clients) => {
            /** Affichage paginé des clients */
            clientslist.innerHTML = clients;
        });
    }
    setTimeout(refreshClients, 1000, 1);
});
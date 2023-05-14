/**
 * MvcUI JavaScript configuration isotope
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

docReady(() => {

    'use strict';

    const d = document;

// On identifie la grille isotope
    const grid = d.querySelector('.grid');

// On identifie le groupe de boutons de filtrage
    const filters = document.querySelector('.filters');

    // On identifie le groupe de boutons d'ordre
    const orders = document.querySelector('.ordering');

// On initialise le composant javaScript Isotope
    let iso = new Isotope(grid, {
        itemSelector: '.grid-item',
        layoutMode: 'fitRows',
        sortBy: 'product',
        sortAscending: true
    });


// Désactive tous les boutons de filtre
    let removeActiveLinks = (parent) => {
        for (const link of parent.getElementsByTagName("a")) {
            link.classList.remove('active');
        }
    }
// On gère les clicks sur les boutons de filtrage
    if (filters !== null) {
        filters.addEventListener('click', (e) => {
            e.preventDefault();
            // On récupère le bouton cliqué
            let $this = e.target;
            // On récupère le nom du filtre
            let filtre = $this.dataset.filter;
            // On désactive tous les boutons de filtre
            removeActiveLinks(filters);
            // On active le bouton
            $this.classList.add('active');
            // On lance le filtrage de l'affichage
            iso.arrange({filter: filtre});
        });
    }

    // On gère les clicks sur les boutons d'ordre
    if (orders !== null) {
        orders.addEventListener('click', (e) => {
            e.preventDefault();
            // On récupère le bouton cliqué
            const $this = e.target;
            // On récupère le nom du filtre
            const order = $this.dataset.ordering === 'true';
            // On désactive tous les boutons de filtre
            removeActiveLinks(orders);
            // On active le bouton
            $this.classList.add('active');
            iso.arrange({sortAscending: order});
        });
    }
});

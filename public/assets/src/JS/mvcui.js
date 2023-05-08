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
 * @version    1.3.0
 */

docReady(() => {

    'use strict';

    const d = document;
    const totop = d.querySelector('#to-top');
    const ajaxPaginateBtn = d.querySelectorAll('.ajaxPagination li > a');

    /**
     * Evènement click sur bouton To top
     */
    totop.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
    /** Affichage du boutn to-top suivant le scroll de la page **/
    window.onscroll = () => {
        totop.style.display = (d.body.scrollTop > 20 || d.documentElement.scrollTop > 20) ? 'block' : 'none';
    }

    /**
     * Supprime les classes active de tous les liens d'un parent
     * @param parent Le node parent du paginateur
     */
    let removeActiveLinks = (parent) => {
        for (const link of parent.getElementsByTagName("a")) {
            link.classList.remove('active');
        }
    };

    /**
     * Active un des boutons de la pagination suivant son numéro
     * @param paginator
     * @param page La page courante
     */
    let addActiveLink = (paginator, page) => {
        for (const link of paginator.getElementsByTagName("a")) {
            if (parseInt(link.dataset.page) === page) {
                link.classList.add('active');
            }
        }
    };

    /**
     * Evènement click sur un bouton de barre de pagination ajax
     */
    if (ajaxPaginateBtn !== null) {
        ajaxPaginateBtn.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const $this = e.currentTarget;
                const action = $this.dataset.action;
                let pageDemanded = $this.dataset.page;
                let parentUl = btn.parentNode.parentNode;
                const paginatorId = parentUl.dataset.paginatorid;
                const currentPageIndicator = parentUl.parentNode.querySelector('.currentpage');
                const AllPaginators = d.querySelectorAll(`ul[data-paginatorid="${paginatorId}"]`);
                const nbpages = parentUl.parentNode.querySelector('.nbpages').value;
                AllPaginators.forEach(paginator => {
                    removeActiveLinks(paginator);
                    if (pageDemanded === 'prev') {
                        addActiveLink(paginator, parseInt(currentPageIndicator.value) - 1);
                        pageDemanded = parseInt(currentPageIndicator.value)-1;
                    } else if (pageDemanded === 'next') {
                        addActiveLink(paginator, parseInt(currentPageIndicator.value) + 1);
                        pageDemanded = parseInt(currentPageIndicator.value)+1;
                    } else {
                        paginator.querySelector(`a[data-page="${pageDemanded}"]`).classList.add('active');
                    }
                    if (parseInt(pageDemanded) === 1) {
                        paginator.firstElementChild.classList.add('disabled');
                    } else if (parseInt(pageDemanded) > 1) {
                        paginator.firstElementChild.classList.remove('disabled');
                    }
                    if (parseInt(pageDemanded) >= nbpages) {
                        paginator.lastElementChild.classList.add('disabled');
                    } else {
                        paginator.lastElementChild.classList.remove('disabled');
                    }
                    paginator.parentNode.querySelector('.currentpage').value = pageDemanded;
                    $this.blur();
                });
                /** Execute the clients data load */
                window[action](pageDemanded);
            });
        });
    }
});
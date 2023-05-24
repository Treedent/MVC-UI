/**
 * MvcUI JavaScript Gestion des Utilisateurs
 *
 * Application MvcUI
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.5.0
 */

docReady(() => {

    'use strict';

    const d = document;

    /** Constantes des sélecteurs */
    const actionuser = d.querySelector("#actionuser");
    const userform = d.querySelector("#userform");
    const deleteuser = d.querySelector("#deleteuser");
    const userdeleteform = d.querySelector("#userdeleteform");
    const email = d.querySelector('#email');
    const password = d.querySelector('#password');
    const cryptedEmail = d.querySelector('#cryptedEmail');
    const cryptedPw = d.querySelector('#cryptedPw');
    const active = d.querySelector('#active');

    /** Récupère le jeton CSRF Token depuis sa balise meta */
    let csrfToken;
    if (d.querySelector('meta[name="csrf-token"]') !== null) {
        csrfToken = d.querySelector('meta[name="csrf-token"]').content;
    }


    /** Positionne le focus sur le 1er champ en erreur ou sur le premier champ */
    let firstfield = d.querySelector('input.is-invalid:first-of-type');
    if (firstfield !== null) {
        firstfield.focus();
    } else {
        firstfield = d.querySelector('input[type="text"]:first-of-type');
        if (firstfield !== null) {
            firstfield.focus();
        }
    }


    /** Evènement ajouter/modifier un utilisateur */
    if (actionuser !== null) {
        actionuser.addEventListener('click', (e) => {
            e.preventDefault();
            if (email.value.trim().length > 0) {
                cryptedEmail.value = window.btoa(AesJson.encrypt(email.value, csrfToken));
            }
            if (password.value.trim().length > 0) {
                cryptedPw.value = window.btoa(AesJson.encrypt(password.value, csrfToken));
            } else {
                cryptedPw.value = '';
            }
            userform.submit();
        });
    }

    /** Evènement activer/désactiver un compte */
    if (active !== null) {
        active.addEventListener('click', (e) => {
            const $this = e.currentTarget;
            $this.nextElementSibling.innerHTML = $this.checked ? 'Compte activ&eacute;' : 'Compte d&eacute;sactiv&eacute;';
        });
    }

    /** Evènement supprimer un utilisateur */
    if (deleteuser!== null) {
        deleteuser.addEventListener('click', (e) => {
            e.preventDefault();
            userdeleteform.submit();
        });
    }
});
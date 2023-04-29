<?php
/**
 * MvcUI Définition des Routes de l'application
 *
 * MvcUI Sample App
 *
 * @package    MvcUI
 * @author     Regis TEDONE
 * @email      syradev@proton.me
 * @copyright  Syradev 2023
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html  GNU General Public License
 * @version    1.0.0
 */

use SYRADEV\app\MvcUIController;
use SYRADEV\app\PaginateController;

return [
    'login' => [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/login',
        'class' => MvcUIController::class,
        'action' => 'login',
        'info' => 'Affiche la bannière de login.'
    ],
    '404' => [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/404',
        'class' => MvcUIController::class,
        'action' => 'error404',
        'info' => 'Affiche la page d\'erreur 404.'
    ],
    'home' => [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/',
        'class' => MvcUIController::class,
        'action' => 'home',
        'info' => 'Affiche la page d\'accueil.'
    ],
    'dashboard' => [
        'access' => 'web',
        'privacy' => 'private',
        'method' => 'get',
        'route' => '/dashboard',
        'class' => MvcUIController::class,
        'action' => '',
        'info' => 'Page d\'accueil du Backend.'
    ],
    'connect' => [
        'access' => 'api',
        'privacy' => 'public',
        'method' => 'post',
        'route' => '/connect',
        'class' => MvcUIController::class,
        'action' => 'connect',
        'info' => 'Connecte un utilisateur.'
    ],
    'disconnect' => [
        'access' => 'api',
        'privacy' => 'private',
        'method' => 'post',
        'route' => '/disconnect',
        'class' => MvcUIController::class,
        'action' => 'disconnect',
        'info' => 'Déconnecte un utilisateur.'
    ],
    'pagination'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/pagination',
        'allowed_params_regex' => 'int+',
        'class' => PaginateController::class,
        'action' => 'paginateDemo',
        'info' => 'Exemple de pagination.'
    ],
    'docs'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/docs',
        'class' => MvcUIController::class,
        'action' => 'docs',
        'info' => 'Documentation classe MvcUI.'
    ]
];
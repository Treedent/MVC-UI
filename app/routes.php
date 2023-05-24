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
 * @version    1.5.0
 */

use SYRADEV\app\MvcUIController;
use SYRADEV\app\DemoController;
use SYRADEV\app\UsersController;

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
    '500' => [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/500',
        'class' => MvcUIController::class,
        'action' => 'error500',
        'info' => 'Affiche la page d\'erreur 500.'
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
    '403' => [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/403',
        'class' => MvcUIController::class,
        'action' => 'error403',
        'info' => 'Affiche la page d\'erreur 403.'
    ],
    '401' => [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/401',
        'class' => MvcUIController::class,
        'action' => 'error401',
        'info' => 'Affiche la page d\'erreur 401.'
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
        'route' => '/api/connect',
        'class' => MvcUIController::class,
        'action' => 'connect',
        'info' => 'Connecte un utilisateur.'
    ],
    'disconnect' => [
        'access' => 'api',
        'privacy' => 'private',
        'method' => 'post',
        'route' => '/api/disconnect',
        'class' => MvcUIController::class,
        'action' => 'disconnect',
        'info' => 'Déconnecte un utilisateur.'
    ],
    'apidoc'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/apidoc',
        'class' => MvcUIController::class,
        'action' => 'apidoc',
        'info' => 'Documentation classe MvcUI.'
    ],
    'dbdoc'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/dbdoc',
        'class' => MvcUIController::class,
        'action' => 'dbdoc',
        'info' => 'Documentation de la base de données northwind.'
    ],
    'relationsdoc'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/relationsdoc',
        'class' => MvcUIController::class,
        'action' => 'relationsdoc',
        'info' => 'Documentation relations base de données.'
    ],

    'users'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/users',
        'class' => UsersController::class,
        'action' => 'listUsers',
        'info' => 'Exemple de CRUD utilisateurs.'
    ],
    'newuser'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/users/newuser',
        'class' => UsersController::class,
        'action' => 'newUser',
        'info' => 'Ajouter un utilisateur.'
    ],
    'edituser'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/users/edituser',
        'allowed_params_regex' => 'int+',
        'class' => UsersController::class,
        'action' => 'editUser',
        'info' => 'Éditer un utilisateur.'
    ],
    'deleteuser'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/users/deleteuser',
        'allowed_params_regex' => 'int+',
        'class' => UsersController::class,
        'action' => 'deleteUser',
        'info' => 'Supprimer un utilisateur.'
    ],
    'redirectpagination'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/demo/redirectpagination',
        'allowed_params_regex' => 'int+',
        'elements_per_page' => 12,
        'class' => DemoController::class,
        'action' => 'redirectPaginateDemo',
        'info' => 'Exemple de pagination redirigée.'
    ],
    'ajaxpagination'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/demo/ajaxpagination',
        'allowed_params_regex' => 'int+',
        'class' => DemoController::class,
        'action' => 'ajaxPaginateDemo',
        'info' => 'Exemple de pagination gérée en Ajax.'
    ],
    'productslist'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/demo/productslist',
        'class' => DemoController::class,
        'action' => 'productslist',
        'info' => 'Demo scroll infini.'
    ],
    'productsbycategory'=> [
        'access' => 'web',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/productsbycategory',
        'class' => DemoController::class,
        'action' => 'productsByCategory',
        'info' => 'Demo blog.'
    ],
    'clientslist'=> [
        'access' => 'api',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/api/clients',
        'allowed_params_regex' => 'int+',
        'elements_per_page' => 8,
        'class' => DemoController::class,
        'action' => 'clientslist',
        'info' => 'Requête une liste de clients paginée en base de données.'
    ],
    'products' => [
        'access' => 'api',
        'privacy' => 'public',
        'method' => 'get',
        'route' => '/api/products',
        'allowed_params_regex' => 'int+',
        'elements_per_page' => 3,
        'class' => DemoController::class,
        'action' => 'infinitescroll',
        'info' => 'Renvoie un partiel de produits.'
    ]
];
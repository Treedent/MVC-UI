<?php
/**
 * MvcUI interface de démarrage
 * Dispatch vers le controller ad hoc
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

// Instance la classe MvcUI
$mvcUI = MvcUIController::getInstance();

// Récupère l'url demandée
$requestUri = $_SERVER['REQUEST_URI'];

// Vérifie que la route existe et renvoi de son nom
$routeName = $mvcUI->getRouteName($requestUri);

// Récupère le type d'accès de la demande (web ou api)
$access = $_SESSION['mvcRoutes'][$routeName]['access'] ?? 'web';

//**************************************************
// Traitement de l'API Ajax *************************
//**************************************************
// Vérifie si la requête est une requête Ajax XmlHttpRequest
// Vérifiction du domaine enregistré
$requestIsAjax = $mvcUI->ajaxCheck() && $mvcUI->domainCheck() && $access=== 'api';

if ($requestIsAjax) {
    // Récupération du flux de données JSON envoyé par le client
    $ajaxRequest = json_decode(file_get_contents('php://input'));

    // Vérification de la requête ajax avec son CSRF Token
    if ($mvcUI->validateAjaxRequest()) {

        // Le CSRF Token est valide
        // On ne spécifie aucun cache pour la réponse
        header("Cache-Control: no-store, no-transform, max-age=0, private");

        // Si la requête ajax reçue contient des paramètres sur php://input
        if (isset($ajaxRequest) && !empty($ajaxRequest)) {
            // Routage de la demande
            switch ($requestUri) {

                /** Demande de connexion */
                case '/api/connect':
                    if (isset($ajaxRequest->type) && $ajaxRequest->type === 'cnx') {
                        if (isset($ajaxRequest->action) && $ajaxRequest->action === 'connect') {
                            if (isset($ajaxRequest->username) && isset($ajaxRequest->hash)) {
                                if (isset($_SESSION['mvcRoutes'][$routeName]['action']) && $_SESSION['mvcRoutes'][$routeName]['route'] === $requestUri) {
                                    $MvcUI = $_SESSION['mvcRoutes'][$routeName]['class']::getInstance();
                                    echo json_encode([
                                        'status' => 200,
                                        'action' => $ajaxRequest->action,
                                        'connected' => $MvcUI->{$_SESSION['mvcRoutes'][$routeName]['action']}([base64_decode($ajaxRequest->username), base64_decode($ajaxRequest->hash)])
                                    ]);
                                    exit();
                                }
                            }
                        }
                    }
                    break;

                /** Demande de déconnexion */
                case '/api/disconnect':
                    if (isset($ajaxRequest->type) && $ajaxRequest->type === 'cnx') {
                        if (isset($ajaxRequest->action) && $ajaxRequest->action === 'disconnect') {
                            if (isset($_SESSION['mvcRoutes'][$routeName]['action']) && $_SESSION['mvcRoutes'][$routeName]['route'] === $requestUri) {
                                $MvcUI = $_SESSION['mvcRoutes'][$routeName]['class']::getInstance();
                                echo json_encode([
                                    'status' => 200,
                                    'action' => $ajaxRequest->action,
                                    'disconnected' => $MvcUI->{$_SESSION['mvcRoutes'][$routeName]['action']}()
                                ]);
                                exit();
                            }
                        }
                    }
                    break;

                /** Demande d'un template partiel */
                case '/api/partial':
                    if (isset($ajaxRequest->type) && $ajaxRequest->type === 'srv') {
                        if (isset($ajaxRequest->partial)) {
                            $mvcUI = MvcUIController::getInstance();
                            echo json_encode([
                                'status' => 200,
                                'partial' => $mvcUI->renderPartial($ajaxRequest->partial)
                            ]);
                        }
                    }
                    break;
            }

        }
        // Si la requête ajax reçue contient des paramètres sur $_GET
        if(isset($_GET) && !empty($_GET)) {
            // Products page
            if(isset($_GET['productspage']) && !empty($_GET['productspage'])) {
                $products_page = $_GET['productspage'];
                $maxProductPerPage = 9;
                $mvcUI = $_SESSION['mvcRoutes'][$routeName]['class']::getInstance();
                $mvcUI->{$_SESSION['mvcRoutes'][$routeName]['action']}($products_page, $maxProductPerPage);
            }
        }



        // Si le CSRF Token n'est pas ou plus valide
    } else {

        // Routage de la demande
        switch ($requestUri) {
            case '/disconnect':
                echo json_encode([
                    'status' => 200,
                    'action' => 'disconnect',
                    'disconnected' => true
                ]);
                break;
            case '/api/partial':
                header("HTTP/1.1 401 Unauthorized");
                echo json_encode(['status' => 401]);
                break;
            default:
                header("HTTP/1.1 401 Unauthorized");
                break;
        }
        exit();
    }


//**************************************************
// Traitement des requêtes HTTP standard ************
//**************************************************
} else {
// Si la route n'existe pas
    if ($routeName === null) {
        header("HTTP/1.1 404 Not Found");
        header('Location:' . MvcUIController::getRoute('404'));
        exit();

        // Si la route existe
    } else {
        if ($_SESSION['mvcRoutes'][$routeName]['privacy'] === 'private') {
            if (!$mvcUI->isConnected()) {
                header('Location:' . MvcUIController::getRoute('login'));
                exit();
            }
        }
        $mvcUI = $_SESSION['mvcRoutes'][$routeName]['class']::getInstance();
        $mvcUI->{$_SESSION['mvcRoutes'][$routeName]['action']}();
    }
}
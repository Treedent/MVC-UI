<?php
/**
 * MvcUI classe principale de l'interface
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

namespace SYRADEV\app;

use Random\Randomizer;

/**
 * Classe MvcUIControlller
 */
class MvcUIController
{

    /**
     * Instance de la classe
     * @protected MvcUIController|null $instance
     */
    protected static ?MvcUIController $instance = null;

    /**
     * Chemin vers le fichier de routes
     * @const ROUTESFILE
     */
    const ROUTESFILE = __DIR__ . '/../routes.php';

    /**
     * Chemin vers le dossier des vues
     * @const VIEWPATH
     */
    const VIEWPATH = __DIR__ . '/../Views';

    /**
     * Chemin vers le dossier des partiels
     * @const PARTIALSPATH
     */
    const PARTIALSPATH = self::VIEWPATH . '/Partials';

    /**
     * Extension des fichiers de Layout
     * @const LAYOUT_EXT
     */
    const LAYOUT_EXT = '.layout.php';

    /**
     * Extension des fichiers de Template
     * @const TMPL_EXT
     */
    const TMPL_EXT = '.tmpl.php';

    /**
     * Extension des fichiers de Partiel
     * @const PARTIAL_EXT
     */
    const PARTIAL_EXT = '.part.php';

    /**
     * Chemin vers les assets
     * @const ASSETSFOLDER
     */
    const ASSETSFOLDER = '/assets';

    /**
     * Titre de page par défaut
     * @const PAGETITLE
     */
    const PAGETITLE = 'Mvc::UI';


    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    /**
     * Instantie l'objet MvcUIController
     * @return MvcUIController object *
     */
    public static function getInstance(): MvcUIController
    {
        if (MvcUIController::$instance === null) {
            MvcUIController::$instance = new MvcUIController;
        }
        return MvcUIController::$instance;
    }

    /**
     * Récupère la configuration de l'application
     * @param null $key
     */
    public function getConf($key = null)
    {
        $confFile = __DIR__ . '/../../conf/app.json';
        $conf = json_decode(file_get_contents($confFile));
        return $conf->$key ?? $conf;
    }

    /**
     * Renvoie le chemin des assets
     * @param $asset
     * @return string *
     */
    public static function assets($asset): string
    {
        return self::ASSETSFOLDER . $asset;
    }


    /**
     * Mise en cache des routes de l'Application dans une session PHP
     * @return void
     */
    public function cacheRoutes(): void
    {
        $mvcConf = $this->getConf();
        ini_set('session.name', $mvcConf->user_session_name);
        ini_set('session.use_cookies', true);
        ini_set('session.use_only_cookies', false);
        ini_set('session.use_strict_mode', true);
        ini_set('session.cookie_path', $mvcConf->originating_segment);
        ini_set('session.cookie_httponly', true);
        ini_set('session.cookie_secure', true);
        ini_set('session.cookie_samesite', 'Strict');
        ini_set('session.gc_maxlifetime', 3600);
        ini_set('session.cookie_lifetime', 3600);
        ini_set('session.use_trans_sid', false);
        ini_set('session.trans_sid_hosts', $mvcConf->domain);
        ini_set('session.referer_check', $mvcConf->originating_url);
        ini_set('session.cache_limiter', 'nocache');
        ini_set('session.sid_length', 128);
        ini_set('session.sid_bits_per_character', 6);
        ini_set('session.hash_function', $mvcConf->hashAlgo);
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (empty($_SESSION['mvcRoutes'])) {
            $_SESSION['mvcRoutes'] = include_once self::ROUTESFILE;
        }
    }

    /**
     * Renvoie vrai si une route existe
     * @param string $routeName
     * @param bool|null $startBy
     * @return bool $isRoute *
     */
    public static function isRoute(string $routeName, bool|null $startBy = null): bool
    {
        $isRoute = false;
        if (isset($_SESSION['mvcRoutes']) && !empty($_SESSION['mvcRoutes'])) {
            if ($startBy) {
                $isRoute = str_starts_with($_SERVER['REQUEST_URI'], $_SESSION['mvcRoutes'][$routeName]['route']);
            } else {
                $isRoute = $_SESSION['mvcRoutes'][$routeName]['route'] === $_SERVER['REQUEST_URI'];
            }
        }
        return $isRoute;
    }


    /**
     * Renvoie le nom d'une route à partir de ses segments
     * @param string $requestedRoute
     * @return string|null $routeKey *
     */
    public function getRouteName(string $requestedRoute): string|null
    {
        $routeName = null;
        if (isset($_SESSION['mvcRoutes']) && !empty($_SESSION['mvcRoutes'])) {
            foreach ($_SESSION['mvcRoutes'] as $routeKey => $routeInfos) {
                if (isset($routeInfos['allowed_params']) && !empty($routeInfos['allowed_params'])) {
                    $requestedRouteSegments = explode('/', trim($requestedRoute, ('/')));
                    if (in_array(end($requestedRouteSegments), $routeInfos['allowed_params'], true)) {
                        $requestedRoute = str_replace('/' . end($requestedRouteSegments), '', $requestedRoute);
                    }
                }
                if (isset($routeInfos['allowed_params_regex']) && !empty($routeInfos['allowed_params_regex'])) {
                    $requestedRouteSegments = explode('/', trim($requestedRoute, ('/')));
                    if ($routeInfos['allowed_params_regex'] === 'int+') {
                        $lastParam = (int)end($requestedRouteSegments);
                        if (preg_match('/[0-9]\d*/', $lastParam) && $lastParam >= 0) {
                            $requestedRoute = str_replace('/' . $lastParam, '', $requestedRoute);
                        }
                    }
                }
                if ($requestedRoute === $routeInfos['route']) {
                    $routeName = $routeKey;
                }
            }
        }
        return $routeName;
    }

    /**
     * Renvoie les segments d'une route à partir de son nom
     * @param string $routeName
     * @return string $route *
     */
    public static function getRoute(string $routeName): string
    {
        $route = (new self)->getConf('originating_segment');
        if (isset($_SESSION['mvcRoutes'][$routeName]) && !empty($_SESSION['mvcRoutes'][$routeName])) {
            $route = $_SESSION['mvcRoutes'][$routeName]['route'];
        }
        return $route;
    }


    /**
     * Atténuation des risques XSS
     * @param $data
     * @return string *
     */
    private static function xssafe($data): string
    {
        return htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }


    /**
     * Génère un jeton CSRF
     * @return string *
     */
    private function generateCSRFToken(): string
    {
        $mvcConf = $this->getConf();
        $sessionTokenLabel = $mvcConf->session_token_label;
        if (empty($_SESSION[$sessionTokenLabel])) {
            $_SESSION[$sessionTokenLabel] = bin2hex(openssl_random_pseudo_bytes(256));
        }
        return hash_hmac($mvcConf->hashAlgo, $mvcConf->hmacData, $_SESSION[$sessionTokenLabel]);
    }

    /**
     * Renvoie le jeton CSRF
     * @return string *
     */
    public static function getCSRFToken(): string
    {
        return self::xssafe((new self)->generateCSRFToken());
    }

    /**
     * Rendu d'un layout + template
     * @param $layout
     * @param null $template
     * @param null $data
     * @param null $toptitle
     * @return string
     */
    public function render($layout, $template = null, $data = null, $toptitle = null): string
    {
        // Récupère le layout
        $layout_ar = explode('.', $layout);
        ob_start();
        require(self::VIEWPATH . '/' . implode('/', $layout_ar) . self::LAYOUT_EXT);
        $layout_content = ob_get_contents();
        ob_end_clean();
        $layout_content = str_replace('{{ pageTitle }}', self::PAGETITLE, $layout_content);
        // Récupère le template
        $template_content = '';
        if (!is_null($template)) {
            $template_ar = explode('.', $template);
            ob_start();
            require(self::VIEWPATH . '/' . implode('/', $template_ar) . self::TMPL_EXT);
            $template_content = ob_get_contents();
            ob_end_clean();
        }
        return str_replace('{{ pageContent }}', $template_content, $layout_content);
    }

    /**
     * Renvoie le chemin d'un partiel
     * @param $partial
     * @return string *
     */
    public static function partial($partial): string
    {
        return self::PARTIALSPATH . $partial;
    }

    /**
     * Rendu d'un partiel
     * @param string $partial
     * @param null $params
     * @return string
     */
    public function renderPartial(string $partial, $params = null): string
    {
        ob_start();
        require(self::PARTIALSPATH . '/' . $partial . self::PARTIAL_EXT);
        $partial_content = ob_get_contents();
        ob_end_clean();
        return $partial_content;
    }

    /**
     * Compare la route courante pour son activation dans le menu
     * @param array $routes
     * @return string *
     */
    static public function isActive(array $routes): string
    {
        $routeName = (new self)->getRouteName($_SERVER['REQUEST_URI']);
        return in_array($routeName, $routes) ? ' active' : '';
    }

    /**
     * Vérifie si un utilisateur est connecté
     * @return bool
     */
    public static function isConnected(): bool
    {
        return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
    }

    /**
     * Affiche la bannière de login
     * @return void
     */
    public function login(): void
    {
        echo $this->render('Layouts.login');
    }

    public function docs(): void
    {
        $data = [
            'appurl' => '/documentation',
            'apptitle' => 'Documentation API Mvc::UI'
        ];
        echo $this->render('Layouts.default', 'Templates.framed', $data, 'Documentation');
    }


    /**
     * Affiche la page d'accueil
     * @return void
     */
    public function home(): void
    {
        echo $this->render('Layouts.default', 'Templates.home', null, 'Acceuil');
    }

    /**
     * Affiche la page d'erreur 404
     * @return void
     */
    public function error404(): void
    {
        header("HTTP/1.1 404 Not Found");
        echo $this->render('Layouts.errors', 'Templates.errors.404', 'error404');
    }

    /**
     * Affiche la page d'erreur 403
     * @return void
     */
    public function error403(): void
    {
        header("HTTP/1.1 403 Forbidden");
        echo $this->render('Layouts.errors', 'Templates.errors.403', 'error403');
    }

    /**
     * Affiche la page d'erreur 401
     * @return void
     */
    public function error401(): void
    {
        header("HTTP/1.1 401 Unauthorized");
        echo $this->render('Layouts.errors', 'Templates.errors.401', 'error401');
    }


    /**
     * Vérifie les requêtes Ajax
     * @return bool *
     */
    public function ajaxCheck(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Vérification du Domaine enregistré
     * @return bool *
     */
    public function domainCheck(): bool
    {
        $domain = $this->getConf('domain');
        return $_SERVER['HTTP_HOST'] === $domain && $_SERVER['SERVER_NAME'] === $domain;
    }

    /**
     * Valide le jeton CSRF pour les appels Ajax
     * @return bool *
     */
    public function validateAjaxRequest(): bool
    {
        $mvcConf = $this->getConf();
        $sessionTokenLabel = $mvcConf->session_token_label;
        if (!isset($_SESSION[$sessionTokenLabel])) {
            return false;
        }
        $expected = hash_hmac($mvcConf->hashAlgo, $mvcConf->hmacData, $_SESSION[$sessionTokenLabel]);
        $requestToken = $_SERVER['HTTP_X_CSRF_TOKEN'];
        return hash_equals($requestToken, $expected);
    }


    /**
     * Valide le jeton CSRF pour les données postées
     * @return bool *
     */
    public function validateFormRequest(): bool
    {
        $mvcConf = $this->getConf();
        $sessionTokenLabel = $mvcConf->session_token_label;
        if (!isset($_SESSION[$sessionTokenLabel])) {
            return false;
        }
        $expected = hash_hmac($mvcConf->hashAlgo, $mvcConf->hmacData, $_SESSION[$sessionTokenLabel]);
        $requestToken = $_POST[$mvcConf->form_token_label];
        return hash_equals($requestToken, $expected);
    }


    /**
     * Renvoie les informations de copyrights
     * @return string
     */
    public static function getCopyRights(): string
    {
        $mvcUi = (new self);
        $appConf = (array)$mvcUi->getConf();
        extract($appConf);
        return $mvcUi->renderPartial('copyrightsinfos', ['app_name'=>$app_name, 'version'=>$version, 'company'=>$company] );
    }

    /**
     * Renvoie une rotation en degrès pour la fonction hue rotate de CSS
     * @return string
     */
    public static function huerotate(): string
    {
        for($i=0;$i<=360;$i+=9) {
            $huesRotate[] = $i . 'deg';
        }
        return  $huesRotate[array_rand($huesRotate)];
    }

    /**
     * Fonction qui formatte un nombre en monnaie Euro
     * @return string
     * @var string $montant
     */
    public static function formalizeEuro(string $montant): string
    {
        return (int)$montant . '.00 &euro;';
    }
}
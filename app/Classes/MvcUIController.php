<?php
/**
 * MvcUI classe principale de l'interface Mvc::UI
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

namespace SYRADEV\app;

/**
 * Classe MvcUIControlller : Classe principale de l'interface Mvc::UI
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
     * Dossier des assets
     * @const ASSETSFOLDER
     */
    const ASSETSFOLDER = '/assets';

    /**
     * Chemin vers les assets
     * @const ASSETSPATH
     */
    const ASSETSPATH = __DIR__ . '/../../public/assets';


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

    /***************************************************************
     * MÉTHODES SYSTÈME
     ***************************************************************/

    /**
     * Système :
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
     * Système :
     * Récupère la configuration de l'application
     * @param null $key Une des clés du tableau de configuration de l'application
     */
    public function getConf($key = null)
    {
        $confFile = __DIR__ . '/../../conf/app.json';
        $conf = json_decode(file_get_contents($confFile));
        return $conf->$key ?? $conf;
    }

    /**
     * Système :
     * Renvoie le chemin des assets
     * @param string $asset Le chemin et le nom de fichier de l'asset à afficher
     * @return string *
     */
    public static function assets(string $asset): string
    {
        return self::ASSETSFOLDER . $asset;
    }


    /**
     * Système :
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
     * Système :
     * Renvoie vrai si une route existe
     * @param string $routeName Le nom d'une route
     * @param bool|null $startBy Si vrai, la recherche se fait sur le début du nom de la route
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
     * Système :
     * Renvoie le nom d'une route à partir de ses segments
     * @param string $requestedRoute La route demandée eg. /api/test
     * @return string|null $routeKey Renvoie le nom de la route
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
     * Système :
     * Renvoie les segments d'une route à partir de son nom
     * @param string $routeName Le nom de la route demandé
     * @return string $route La route ie. /api/test
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
     * Système :
     * Rendu d'un layout + template
     * @param string $layout Le chemin/nom du layout demandé
     * @param string|null $template Le chemin/nom du template demandé
     * @param string|array|null $data Les données à afficher
     * @param string|null $toptitle Le titre à afficher en top bar
     * @return string Le contenu à afficher
     */
    public function render(string $layout, string $template = null, string|array $data = null, string $toptitle = null): string
    {
        // Récupère le layout
        $layout_ar = explode('.', $layout);
        ob_start();
        require(sprintf("%s/%s%s", self::VIEWPATH, implode('/', $layout_ar), self::LAYOUT_EXT));
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
     * Système :
     * Renvoie le chemin d'un partiel
     * @param string $partial Le chemin/nom du fichier partiel
     * @return string *
     */
    public static function partial(string $partial): string
    {
        return self::PARTIALSPATH . $partial;
    }

    /**
     * Système :
     * Rendu d'un partiel
     * @param string $partial Le nom du partiel sans son extension
     * @param array|null $params Des paramètres à passer au partiel
     * @return string Le rendu du partiel
     */
    public function renderPartial(string $partial, array $params = null): string
    {
        ob_start();
        require(self::PARTIALSPATH . '/' . $partial . self::PARTIAL_EXT);
        $partial_content = ob_get_contents();
        ob_end_clean();
        return $partial_content;
    }

    /**
     * Système :
     * Rends un fichier svg dans le DOM
     * @param string $svg Le chemin/nom du fichier SVG
     * @return false|string Le code source du fichier SVG
     */
    public static function renderSVG(string $svg): false|string
    {
        return file_get_contents(self::ASSETSPATH . $svg);
    }


    /***************************************************************
     * MÉTHODES D'AFFICHAGE
     ***************************************************************/

    /**
     * Affichage :
     * Affiche la bannière de login
     * @return void
     */
    public function login(): void
    {
        echo $this->render('Layouts.login');
    }


    /**
     * Affichage :
     * Affiche la documentation de l'API Mvc::UI
     * @return void
     */
    public function apidoc(): void
    {
        $data = [
            'appurl' => '/documentation/api',
            'apptitle' => 'Documentation API Mvc::UI'
        ];
        echo $this->render('Layouts.default', 'Templates.MvcUI.framed', $data, $data['apptitle']);
    }


    /**
     * Affichage :
     * Affiche la documentation de la database northwind
     * @return void
     */
    public function dbdoc(): void
    {
        $data = [
            'appurl' => '/documentation/northwind_bdd',
            'apptitle' => 'Documentation database northwind'
        ];
        echo $this->render('Layouts.default', 'Templates.MvcUI.framed', $data, $data['apptitle']);
    }


    /**
     * Affichage :
     * Affiche une documentation sur les relations de base de données
     * @return void
     */
    public function relationsdoc(): void
    {
        $data = [
            'appurl' => '/documentation/relations_bdd',
            'apptitle' => 'Documentation relations base de données.'
        ];
        echo $this->render('Layouts.default', 'Templates.MvcUI.framed', $data, $data['apptitle']);
    }


    /**
     * Affichage :
     * Affiche la page d'accueil
     * @return void
     */
    public function home(): void
    {
        echo $this->render('Layouts.default', 'Templates.MvcUI.home', null, 'Accueil');
    }

    /**
     * Affichage :
     * Affiche la page d'erreur 404
     * @return void
     */
    public function error500(): void
    {
        header("HTTP/1.1 500 Internal Server Error");
        echo $this->render('Layouts.errors', 'Templates.errors.500', 'error500');
    }

    /**
     * Affichage :
     * Affiche la page d'erreur 404
     * @return void
     */
    public function error404(): void
    {
        header("HTTP/1.1 404 Not Found");
        echo $this->render('Layouts.errors', 'Templates.errors.404', 'error404');
    }

    /**
     * Affichage :
     * Affiche la page d'erreur 403
     * @return void
     */
    public function error403(): void
    {
        header("HTTP/1.1 403 Forbidden");
        echo $this->render('Layouts.errors', 'Templates.errors.403', 'error403');
    }

    /**
     * Affichage :
     * Affiche la page d'erreur 401
     * @return void
     */
    public function error401(): void
    {
        header("HTTP/1.1 401 Unauthorized");
        echo $this->render('Layouts.errors', 'Templates.errors.401', 'error401');
    }


    /***************************************************************
     * MÉTHODES DE SÉCURITÉ
     ***************************************************************/

    /**
     * Sécurité :
     * Atténuation des risques XSS
     * @param $data
     * @return string *
     */
    private static function xssafe($data): string
    {
        return htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }


    /**
     * Sécurité :
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
     * Sécurité :
     * Renvoie le jeton CSRF
     * @return string *
     */
    public static function getCSRFToken(): string
    {
        return self::xssafe((new self)->generateCSRFToken());
    }


    /**
     * Sécurité :
     * Vérifie les requêtes Ajax
     * @return bool *
     */
    public function ajaxCheck(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }


    /**
     * Sécurité :
     * Vérification du Domaine enregistré
     * @return bool *
     */
    public function domainCheck(): bool
    {
        $domain = $this->getConf('domain');
        return $_SERVER['HTTP_HOST'] === $domain && $_SERVER['SERVER_NAME'] === $domain;
    }


    /**
     * Sécurité :
     * Vérifie si un utilisateur est connecté
     * @return bool
     */
    public static function isConnected(): bool
    {
        return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
    }

    /**
     * Sécurité :
     * Valide le jeton CSRF du header d'une requête Ajax
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
     * Sécurité :
     * Valide le jeton CSRF posté par un formulaire
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



    /***************************************************************
     * MÉTHODES UTILITAIRES
     ***************************************************************/

    /**
     * Utilitaire :
     * Compare la route courante pour son activation dans le menu
     * @param array $routes Un tableau composé du nom des routes
     * @return string ' active'|''
     */
    static public function isActive(array $routes): string
    {
        $routeName = (new self)->getRouteName($_SERVER['REQUEST_URI']);
        return in_array($routeName, $routes) ? ' active' : '';
    }


    /**
     * Utilitaire :
     * Renvoie les informations de copyrights
     * @return string Les informations de copyrights issus de la configuration de l'application
     */
    public static function getCopyRights(): string
    {
        $mvcUi = (new self);
        $appConf = (array)$mvcUi->getConf();
        extract($appConf);
        return $mvcUi->renderPartial('/MvcUI/copyrightsinfos', ['app_name' => $app_name, 'version' => $version, 'company' => $company]);
    }


    /**
     * Utilitaire :
     * Renvoie une rotation en degrès pour la fonction hue rotate de CSS
     * @return string Une rotation en degrès
     */
    public static function huerotate(): string
    {
        for ($i = 0; $i <= 360; $i += 9) {
            $huesRotate[] = $i . 'deg';
        }
        return $huesRotate[array_rand($huesRotate)];
    }


    /**
     * Utilitaire :
     * Fonction qui formatte un nombre en monnaie Euro
     * @return string La chaine formalisée en Euros
     * @var string $montant Le montant à formaliser en Euros
     */
    public static function formalizeEuro(string $montant): string
    {
        return (int)$montant . '.00 &euro;';
    }


    /**
     * Utilitaire :
     * Fonction qui rend conforme (sans espace et ponctuation) une chaine
     * @param string $name
     * @return string
     */
    public static function sanitizeName(string $name): string
    {
        // Supprimme la ponctuation et les espaces
        $name = preg_replace('/[\p{P}\p{Zs}]+/u', '', $name);
        // Converti les caractères accentués en ASCII
        return iconv('UTF-8', 'ASCII//TRANSLIT', $name);
    }


    /**
     * Utilitaire :
     * Construit une barre de pagination géréé en redirections
     * @param int $numpage Le numéro de page demandée
     * @param int $maxpage Le nombre maximum de pages
     * @param string $route La route des liens de la barre de pagination
     * @param string $align L'alignement de la barre de pagination
     * @return string
     */
    public static function getPagination(int $numpage, int $maxpage, string $route, string $align): string
    {
        return (new self)->renderPartial(
            '/MvcUI/linkpaginator',
            [
                'numpage' => $numpage,
                'maxpage' => $maxpage,
                'route' => $route,
                'align' => $align
            ]
        );
    }


    /**
     * Utilitaire :
     * Construit une barre de pagination géréé en ajax
     * @param int $numpage Le numéro de page courante
     * @param int $maxperpage Le nombre maximum d'enregistrements par page
     * @param int $maxrecords Le nombre maximum d'enregistrements en base
     * @param string $action La méthode JS à exécuter
     * @param string $align L'alignement de la barre de pagination
     * @param string $uniq Un identifiant unique pour des barres de pagination multiple
     * @return string
     */
    public static function getAjaxPagination(int $numpage, int $maxperpage, int $maxrecords, string $action, string $align, string $uniq): string
    {
        return (new self)->renderPartial(
            '/MvcUI/ajaxpaginator',
            [
                'numpage' => $numpage,
                'maxperpage' => $maxperpage,
                'maxrecords' => $maxrecords,
                'action' => $action,
                'align' => $align,
                'uniq' => $uniq
            ]
        );
    }
}
<?php
/**
 * MvcUI classe Controller de Gestion des utilisteurs.
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

namespace SYRADEV\app;

use SYRADEV\Model\UserModel;

/**
 * Classe DemoController étends MvcUIControlller
 * Gestion de la pagination
 */
class UsersController extends MvcUIController
{


    /**
     * Instance de la classe
     * @protected MvcUIController|null $instance
     */
    protected static ?MvcUIController $instance = null;
    private string $cipherAlgo;
    private string $hashAlgo;
    private string $secret;


    /**
     * Constructeur de la classe UsersController
     */
    private function __construct()
    {
        parent::__construct();
        $conf = $this->getConf();
        $this->cipherAlgo = $conf->cipherAlgo;
        $this->hashAlgo = $conf->hashAlgo;
        $this->secret = $conf->hmacData;
    }


    /**
     * Système :
     * Instantie l'objet UsersController
     * @return UsersController object *
     */
    public static function getInstance(): MvcUIController
    {
        if (DemoController::$instance === null) {
            DemoController::$instance = new UsersController;
        }
        return DemoController::$instance;
    }


    /***
     * Sécurité :
     * Encripte avec l'algorythme aes-256-cbc une valeur quelconque
     * @param mixed $value Valeur quelconque
     * @param string $passphrase Phrase secrète
     * @return string La chaine cryptée
     ***/
    public function aesEncrypt(mixed $value, string $passphrase): string
    {
        $salt = openssl_random_pseudo_bytes(8);
        $salted = '';
        $dx = '';
        while (strlen($salted) < 48) {
            $dx = md5($dx . $passphrase . $salt, true);
            $salted .= $dx;
        }
        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);
        $encrypted_data = openssl_encrypt(json_encode($value), $this->cipherAlgo, $key, true, $iv);
        $data = ["ct" => base64_encode($encrypted_data), "iv" => bin2hex($iv), "s" => bin2hex($salt)];
        return json_encode($data);
    }


    /***
     * Sécurité :
     * Decripte une valeur préalablement encriptée
     * @param string $jsonStr Chaine JSON
     * @param string $passphrase Phrase secrète
     * @return mixed
     ***/
    public function aesDecrypt(string $jsonStr, string $passphrase): mixed
    {
        $json = json_decode($jsonStr, true);
        $salt = hex2bin($json["s"]);
        $iv = hex2bin($json["iv"]);
        $ct = base64_decode($json["ct"]);
        $concatedPassphrase = $passphrase . $salt;
        $md5 = [];
        $md5[0] = md5($concatedPassphrase, true);
        $result = $md5[0];
        for ($i = 1; $i < 3; $i++) {
            $md5[$i] = md5($md5[$i - 1] . $concatedPassphrase, true);
            $result .= $md5[$i];
        }
        $key = substr($result, 0, 32);
        $data = openssl_decrypt($ct, $this->cipherAlgo, $key, true, $iv);
        return json_decode($data, true);
    }


    /***
     * Sécurité :
     * Hash un texte avec l'algorithme Argon2id
     * puis convertit le hash en hexadécimal
     * @param $plaintext
     * @return string
     ***/
    public function argon2idHash($plaintext): string
    {
        return bin2hex(
            password_hash(
                hash_hmac($this->hashAlgo, $plaintext, $this->secret),
                PASSWORD_ARGON2ID,
                ['memory_cost' => 2 ** 14, 'time_cost' => 5, 'threads' => $this->getNumberOfCPUs()]
            )
        );
    }


    /***
     * Sécurité :
     * Compare un texte en clair
     * avec son hash argon2id convertit en hexadécimal
     * @param $plaintext
     * @param $hash
     * @return bool
     ***/
    public function argon2idHashVerify($plaintext, $hash): bool
    {
        return password_verify(
            hash_hmac(
                $this->hashAlgo,
                $plaintext,
                $this->secret),
            hex2bin($hash)
        );
    }


    /**
     * Sécurité :
     * Vérifie la syntaxe d'une adresse mail
     * @param string $adresseEmail L'adresse mail à vérifier
     * @return bool Renvoie Vrai si l'adresse mail est valide sinon Faux
     */
    public function validateEmail(string $adresseEmail): bool
    {
        // Expression régulière pour valider une adresse email
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        // Vérifie si l'adresse email correspond au modèle
        if (preg_match($pattern, $adresseEmail)) {
            return true; // L'adresse email est valide
        } else {
            return false; // L'adresse email est invalide
        }
    }

    /**
     * Utilitaire :
     * Renvoie le nombre de processeurs de la machine hôte
     * @return int
     */
    private function getNumberOfCPUs(): int
    {
        $nbcpu = 1;
        if (is_file('/proc/cpuinfo')) {
            $cpuinfo = file_get_contents('/proc/cpuinfo');
            preg_match_all('/^processor/m', $cpuinfo, $matches);
            $nbcpu = count($matches[0]);
        } else if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            $process = @popen('wmic cpu get NumberOfCores', 'rb');
            if (false !== $process) {
                fgets($process);
                $nbcpu = intval(fgets($process));
                pclose($process);
            }
        } else {
            $ps = @popen('sysctl -a', 'rb');
            if (false !== $ps) {
                $output = stream_get_contents($ps);
                preg_match('/hw.ncpu: (\d+)/', $output, $matches);
                if ($matches) {
                    $nbcpu = intval($matches[1][0]);
                }
                pclose($ps);
            }
        }
        return $nbcpu;
    }



    /************************************************************
     ***************** CRUD UTILISATEURS ************************
     ************************************************************/


    /**
     * CRUD UTILISATEUR :
     * Renvoie la liste des utilisateurs
     * @return void
     */
    public function listUsers(): void
    {
        // On se connecte à la database
        $cnx = PdoMySQL::getInstance();

        $data = [];
        $data['color'] = '#ffffff';

        // Requête les utilisateurs en base de données
        $requeteUsers = 'SELECT * from `Users` ORDER BY `uid`';
        $data['users'] = $cnx->requete($requeteUsers);

        // Envoie les données des utilisateurs au template
        echo $this->render('Layouts.default', 'Templates.Users.listusers', $data, 'Liste des utilisateurs');
    }


    /**
     * CRUD UTILISATEUR :
     * Affiche le formulaire de création d'un utilisateur
     * @return void
     */
    public function newUser(): void
    {
        $data['action'] = 'newuser';
        echo $this->render('Layouts.default', 'Templates.Users.userform', $data, 'Ajouter un utilisateur');
    }


    /**
     * CRUD UTILISATEUR :
     * Créé un nouvel utilisateur en base de données
     * @param array $post Les données issues du formulaire
     * @return bool Vrai si l'insertion en base s'est bien passée ou faux
     */
    public function createUser(array $post): bool
    {
        /**
         * On crée un objet User basé sur son modèle avec les données du post nettoyées
         */
        $userObj = new UserModel($this->cleanUpValues($post));

        // On se connecte à la database
        $cnx = PdoMySQL::getInstance();

        /**
         * On insère le nouvel utilisateur en base de données
         */
        return $cnx->inserer('Users', $userObj);
    }


    /**
     * CRUD UTILISATEUR :
     * Affiche le formulaire d'édition d'un utilisateur
     * @return void
     */
    public function editUser(): void
    {
        $data = [];
        $data['userid'] = $_GET['uid'];
        $data['action'] = 'edituser';

        /** On récupère les infos de l'utilisateur en base de données */
        $cnx = PdoMySQL::getInstance();
        $requeteUsers = sprintf('SELECT * from `Users` WHERE `uid` =%d', $data['userid']);
        $data['userinfos'] = $cnx->requete($requeteUsers, 'fetch');

        echo $this->render('Layouts.default', 'Templates.Users.userform', $data, 'Modifier un utilisateur');
    }


    /**
     * CRUD UTILISATEUR :
     * Met à jour un utilisateur en base de données
     * @param array $post Les données issues du formulaire
     * @return bool Vrai si l'insertion en base s'est bien passée ou faux
     */
    public function updateUser(array $post): bool
    {

        $cleanPost = $this->cleanUpValues($post);

        // On supprime le champ cryptedPw si il est vide
        if(empty($cleanPost['cryptedPw'])){
            unset($cleanPost['cryptedPw']);
        }

        /**
         * On crée un objet User basé sur son modèle avec les données du post nettoyées
         */
        $userObj = new UserModel($cleanPost);

        // On se connecte à la database
        $cnx = PdoMySQL::getInstance();

        /**
         * On insère le nouvel utilisateur en base de données
         */
        return $cnx->metajour('Users', $userObj, '`uid`=' . $cleanPost['uid']);
    }


    /**
     * CRUD UTILISATEUR :
     * Affiche le formulaire de confirmation de suppression d'un utilisateur
     * @return void
     */
    public function deleteUser(): void
    {
        // On récupère l'identifiant unique de l'utilisateur
        $uid = $_GET['uid'] ?? $_POST['uid'];

        // On se connecte à la database
        $cnx = PdoMySQL::getInstance();

        // On récupère en base de données l'uid, le nom et le prénom de l'utilisateur
        $usersql = sprintf('SELECT `uid`, `firstname`, `lastname` FROM `Users` WHERE `uid` =%d', $uid);
        $user = $cnx->requete($usersql, 'fetch');

        echo $this->render('Layouts.default', 'Templates.Users.deleteuser', $user, 'Supprimer un utilisateur');
    }


    /**
     * CRUD UTILISATEUR :
     * Supprime un utilisateur de la base de données
     * @param int $uid L'id de l'utilisateur à supprimer
     * @return bool Renvoie Vrai si la suppression s'est bien passée sinon Faux
     */
    public function destroyUser(int $uid): bool
    {
        // On se connecte à la database
        $cnx = PdoMySQL::getInstance();

        /**
         * On supprime l'utilisateur de la base de données
         */
        return $cnx->supprime('Users', ['uid'=>$uid]);
    }
}
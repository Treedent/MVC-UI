<?php
/**
 * Classe PdoMySQL
 * Permet d'opérer sur une base de données MySQL
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

use PDO;
use PDOException;

/**
 * Classe PdoMySQL
 * Permet d'opérer sur une base de données MySQL
 */
class PdoMySQL {

    private static ?PdoMySQL $connect = null;
    private PDO $conx;

    private function __construct() {
        $mvcUI = MvcUIController::getInstance();
        $conf = $mvcUI->getConf('db');
        extract((array)$conf);
        try {
            $this->conx = new PDO('mysql:host='.$host.';dbname='.$database, $user, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
            $this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            $message = 'Erreur ! ' . $e->getMessage() . '<hr>';
            die($message);
        }
    }

    public static function getInstance(): ?PdoMySQL
    {
        if (is_null(self::$connect)) {
            self::$connect = new PdoMySQL();
        }
        return self::$connect;
    }

    public function requete($sql, $fetchMethod='fetchAll') {
        try {
            $result = $this->conx->query($sql, PDO::FETCH_ASSOC)->{$fetchMethod}();
        } catch(PDOException $e) {
            $message = 'Erreur ! ' . $e->getMessage() . '<hr>';
            die($message);
        }
        return $result;
    }

    /**
     * Insert des données dans une table
     */
    public function inserer($table, $data): bool
    {
        // On convertit l'objet en tableau
        $dataTab = get_object_vars($data);

        // On récupère les nom de champs dans les clés du tableau
        $fields = array_keys($dataTab);
        // On récupère les valeurs
        $values = array_values($dataTab);

        // On compte le nombre de champ
        $values_count = count($values);

        // On construit la chaine des paramètres ':p0,:p1,:p2,...'
        $params = [];
        foreach ($values as $key => $value) {
            $params[] = ':p' . $key;
        }
        $params_str = implode(',', $params);

        // On prépare la requête
        $reqInsert = 'INSERT INTO ' . $table . '('. implode(',',$fields).')';
        $reqInsert .= ' VALUES('.$params_str.')';

        $prepared = $this->conx->prepare($reqInsert);

        // On injecte dans la requête les données avec leur type.
        for($i=0;$i<$values_count;$i++) {
            $type = match (gettype($values[$i])) {
                'NULL' => PDO::PARAM_NULL,
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
            // On lie une valeur au paramètre :pX
            $prepared->bindParam(':p'.$i, $values[$i], $type);
        }

        // On exécute la requête.
        // Retourne TRUE en cas de succès ou FALSE en cas d'échec.
        return $prepared->execute();
    }

    /**
     * Retourne l'id de la dernière insertion par auto-incrément dans la base de données
     * @return int
     */
    public function dernierIndex(): int
    {
        return $this->conx->lastInsertId();
    }
}
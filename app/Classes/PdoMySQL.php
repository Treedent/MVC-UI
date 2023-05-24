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
 * @version    1.5.0
 */


namespace SYRADEV\app;

use PDO;
use PDOException;

/**
 * Classe PdoMySQL
 * Permet d'opérer avec PDO sur une base de données MySQL
 */
final class PdoMySQL
{

    /**
     * Instance de la classe
     * @private PdoMySQL|null $pdomysql
     */
    private static ?PdoMySQL $pdomysql = null;


    /**
     * Objet de connexion à la base ded données
     * @private PDO $conx
     */
    private PDO $conx;


    /**
     * Constructeur de classe
     * Connexion automatique à la base de données
     * @return void
     */
    private function __construct()
    {
        $mvcUI = MvcUIController::getInstance();
        $conf = $mvcUI->getConf('db');
        extract((array)$conf);
        try {
            $this->conx = new PDO('mysql:host=' . $host . ';dbname=' . $database, $user, $password, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8']);
            $this->conx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $message = 'Erreur ! ' . $e->getMessage() . '<hr>';
            die($message);
        }
    }

    /**
     * Instantie l'objet PdoMySQL
     * @return PdoMySQL|null L'objet PdoMySQL
     */
    public static function getInstance(): ?PdoMySQL
    {
        if (is_null(self::$pdomysql)) {
            self::$pdomysql = new PdoMySQL();
        }
        return self::$pdomysql;
    }

    /**
     * Renvoie le nombre d'éléments d'une table
     * @param string $tableName Le nom de la table à compter
     * @return array [Le nombre d'enregistrements de la table
     */
    public function compteTable(string $tableName): array
    {
        $sql = 'SELECT COUNT(*) AS nombre FROM ' . $tableName;
        return $this->requete($sql, 'fetch');
    }

    /**
     * Exécute une requête de type SELECT
     * @param string $sql La reqête SELECT à exécuter
     * @param string $fetchMethod Le type de tableau renvoyé
     * @return array $result Le résultat de la requête
     */
    public function requete(string $sql, string $fetchMethod = 'fetchAll'): array
    {
        try {
            $result = $this->conx->query($sql, PDO::FETCH_ASSOC)->{$fetchMethod}();
        } catch (PDOException $e) {
            $message = '<div style="background:#df0017;padding:10px;border:1px solid #CCC;color:#fff;">Erreur requete ! ' . $e->getMessage() . '</div>';
            die($message);
        }
        return $result;
    }

    /**
     * Insert des données dans une table
     * @param string $table Le nom de la table cible
     * @param object $data L'objet contenant les données à insérer
     * @return bool Retourne TRUE en cas de succès ou FALSE en cas d'échec
     */
    public function inserer(string $table, object $data): bool
    {
        // On convertit l'objet en tableau
        $dataTab = get_object_vars($data);
        // On récupère les noms de champs dans les clés du tableau
        $fields = array_keys($dataTab);
        // On récupère les valeurs
        $values = array_values($dataTab);
        // On compte le nombre de champs
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
            // On lie une valeur au paramètre : px
            $prepared->bindParam(':p'.$i, $values[$i], $type);
        }
        // On exécute la requête.
        // Retourne TRUE en cas de succès ou FALSE en cas d'échec.
        return $prepared->execute();
    }


    /**
     * Met à jour des données dans une table
     * @param string $table Le nom de la table cible
     * @param object $data L'objet contenant les données à mettre à jour
     * @param string $condition La condition de mise à jour (ex: "id = :id")
     * @return bool Retourne TRUE en cas de succès ou FALSE en cas d'échec
     */
    public function metajour(string $table, object $data, string $condition): bool
    {
        // On convertit l'objet en tableau
        $dataTab = get_object_vars($data);

        // On récupère les noms de champs et les valeurs
        $fields = [];
        $values = [];
        foreach ($dataTab as $field => $value) {
            $fields[] = $field . ' = :' . $field;
            $values[':' . $field] = $value;
        }

        // On construit la clause SET
        $setClause = implode(', ', $fields);
        // On prépare la requête
        $reqUpdate = 'UPDATE ' . $table . ' SET ' . $setClause . ' WHERE ' . $condition;

        $prepared = $this->conx->prepare($reqUpdate);
        // On injecte dans la requête les données avec leur type
        foreach ($values as $param => $value) {
            $type = match (gettype($value)) {
                'NULL' => PDO::PARAM_NULL,
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
            // On lie une valeur au paramètre
            $prepared->bindValue($param, $value, $type);
        }

        /** Pour debugger la requête */
        //echo PdoDebug::show($reqUpdate, $dataTab);
        //exit();

        // On exécute la requête
        // Retourne TRUE en cas de succès ou FALSE en cas d'échec
        return $prepared->execute();
    }


    /**
     * Supprime des données dans une table
     * @param string $table Le nom de la table cible
     * @param array $conditions un tableau de conditions composé de couples champ/valeur
     * @return bool Retourne TRUE en cas de succès ou FALSE en cas d'échec
     */
    public function supprime(string $table, array $conditions): bool
    {

        $whereCondition = '';
        $count = 0;
        $and = ' ';
        foreach ($conditions as $key => $value) {
            if ($count > 0) {
                $and = ' AND ';
            }
            $whereCondition .= $and . $key . '=:' . $key;
            $count++;
        }

        // On prépare la requête
        $reqDelete = 'DELETE FROM ' . $table . ' WHERE ' . $whereCondition;
        $prepared = $this->conx->prepare($reqDelete);

        // On injecte dans la requête les données avec leur type.
        foreach ($conditions as $key => $value) {
            $type = match (gettype($value)) {
                'NULL' => PDO::PARAM_NULL,
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                default => PDO::PARAM_STR,
            };
            // On lie une valeur au paramètre :param
            $prepared->bindValue(':'.$key, $value, $type);
        }

        /** Pour debugger la requête */
        //echo PdoDebug::show($reqDelete, $conditions);
        //exit();

        // On exécute la requête
        // Retourne Vrai en cas de succès ou Faux en cas d'échec
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
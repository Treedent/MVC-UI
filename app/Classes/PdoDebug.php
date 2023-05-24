<?php

namespace SYRADEV\app;

/**
 * Class PdoDebug
 *
 * Emule l'instruction SQL de PDO
 */
class PdoDebug
{
    /**
     * Renvoie la chaîne SQL émulée
     *
     * @param string $raw_sql
     * @param array $parameters
     * @return string|array|null
     */
    public static function show(string $raw_sql, array $parameters): string|array|null
    {

        $keys = [];
        $values = [];

        /*
         * Obtient les clés les plus longues en premier,
         * afin que le remplacement de la regex ne coupe pas les marqueurs
         */
        $isNamedMarkers = false;
        if (count($parameters) && is_string(key($parameters))) {
            uksort($parameters, function($k1, $k2) {
                return strlen($k2) - strlen($k1);
            });
            $isNamedMarkers = true;
        }
        foreach ($parameters as $key => $value) {

            // Vérifie si des paramètres nommés ':param' ou des paramètres anonymes ? sont utilisés
            if (is_string($key)) {
                $keys[] = '/:'.ltrim($key, ':').'/';
            } else {
                $keys[] = '/[?]/';
            }

            // Mets le paramètre dans un format lisible par l'être humain
            if (is_string($value)) {
                $values[] = "'" . addslashes($value) . "'";
            } elseif(is_int($value)) {
                $values[] = strval($value);
            } elseif (is_float($value)) {
                $values[] = strval($value);
            } elseif (is_array($value)) {
                $values[] = implode(',', $value);
            } elseif (is_null($value)) {
                $values[] = 'NULL';
            }
        }

        $query = '';
        if ($isNamedMarkers) {
            $query = preg_replace($keys, $values, $raw_sql);
        } else {
            $query = preg_replace($keys, $values, $raw_sql, 1);
        }

        return '<div style="background:#b6e0b0;padding:10px;border:1px solid #CCC;color:#333;">'.$query.'</div>';

    }
}

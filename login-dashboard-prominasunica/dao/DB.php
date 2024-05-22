<?php

require_once ('db_config.php');

class DB {

    private static $instance;
    
    private function __construct() {
        ;
    }
    
    public static function getInstance() {

        if (!isset(self::$instance)) {

            try {
                self::$instance = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public static function prepare(string $sql): ?PDOStatement {
        $instance = self::getInstance();
        if ($instance === null) {
            return null;
        }

        try {
            return $instance->prepare($sql);
        } catch (PDOException $e) {
            echo "Preparation error: " . $e->getMessage();
            return null;
        }
    }

    public static function lastInsertId(): ?string {
        $instance = self::getInstance();
        if ($instance === null) {
            return null;
        }

        try {
            return $instance->lastInsertId();
        } catch (PDOException $e) {
            echo "Error getting last insert ID: " . $e->getMessage();
            return null;
        }
    }
}
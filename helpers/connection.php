<?php

class Connection {
    static public function connect() {
        global $env;
        $host = $env->get('db_host');
        $db = $env->get('db_name');
        $userDB = $env->get('db_user');
        $passDB = $env->get('db_password');
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $userDB, $passDB);
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
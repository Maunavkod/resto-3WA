<?php

class Database
{
    private $pdo;


    public function __construct()
    {
        $configuration = new Configuration();
        $this->pdo = new PDO
        (
            $configuration->get('database', 'dsn'),
            $configuration->get('database', 'user'),
            $configuration->get('database', 'password'),
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                // Affichage des erreurs MySQL dans PHP
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Définition du mode tableau associatifs par défaut
            ]
        );
        $this->pdo->exec('SET NAMES UTF8mb4');
    }

    public function executeSql($sql, array $values = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($values);

        return $this->pdo->lastInsertId();
    }

    public function query($sql, array $criteria = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($criteria);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($sql, array $criteria = [])
    {
        $query = $this->pdo->prepare($sql);
        $query->execute($criteria);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

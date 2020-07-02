<?php

class MealModel
{
    public function listAll()
    {
        // Requête SQL pour récupérer tous les plats
        
        
        $db = new Database;
        return $db->query('
            SELECT * 
            FROM meal
        ');
    }
}
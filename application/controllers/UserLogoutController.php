<?php

class UserLogoutController
{
    // Définit la vue à charger
    const VIEW = '';

    public function httpGetMethod(Http $http, array $queryFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP GET
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $queryFields contient l'équivalent de $_GET en PHP natif.
    	 */

        /*
        * L'action du contrôleur doit retourner un tableau associatif dont les clés
        * seront converties en variables dans la vue.
        * Il peut également contenir des index spéciaux servant à configurer la vue retournée
        */
        
        $userSession = new UserSession();
        $userSession->destroy();
        $http->redirectTo('/');
    }
}
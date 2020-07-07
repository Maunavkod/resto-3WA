<?php

class UserLoginController
{
    // Définit la vue à charger
    const VIEW = 'user/Login';

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
        
        return [
            '_form' => new LoginForm(),
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	/*
    	 * Méthode appelée en cas de requête HTTP POST
    	 *
    	 * L'argument $http est un objet permettant de faire des redirections etc.
    	 * L'argument $formFields contient l'équivalent de $_POST en PHP natif.
    	 */
    	 $form = new LoginForm();
    	 
    	 try {
        	 $userModel = new UserModel();
        	 $user = $userModel->findByEmailPassword(
        	     $formFields['email'],
        	     $formFields['password']
    	     );
    	     
    	     // TODO
    	     
    	     $userSession = new UserSession();
    	     $userSession->create(
    	         $user['id'],
    	         $user['first_name'],
    	         $user['last_name'],
    	         $user['email']
	         );
    	     
    	     $http->redirectTo('/');
    	 } catch (DomainException $exception) {
    	     // Récupérer le message pour l'afficher dans le formulaire
    	     $form->bind($formFields);
    	     $form->setErrorMessage($exception->getMessage());
    	 }
    	 
    	 return [
            '_form' => $form,
	     ];
    }
}
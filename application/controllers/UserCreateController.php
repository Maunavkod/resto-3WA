<?php

class UserCreateController
{
    // Définit la vue à charger
    const VIEW = 'user/Create';

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
            '_form' => new UserCreateForm(),
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
    	 
    	 // 1 - Instancier le UserModel
    	 // 2 - lancer la création de compte - signUp
    	 
    	 // Rediriger vers la page d'accueil - /!\ Utiliser l'objet Http
    	 
    	 $form = new UserCreateForm();
    	 
    	 try {
        	 $userModel = new UserModel();
        	 $userModel->signUp(
        	     $formFields['last_name'],
        	     $formFields['first_name'],
        	     $formFields['email'],
        	     $formFields['password'],
        	     $formFields['address'],
        	     $formFields['zip_code'] ? intval($formFields['zip_code']) : null,
        	     $formFields['city'],
        	     $formFields['phone']
    	     );
    	     
    	     $flashBag = new FlashBag();
    	     $flashBag->add('Votre compte a bien été créé !');
    	     
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
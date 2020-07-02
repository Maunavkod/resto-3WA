'use strict';

class FormValidator
{
    constructor(form)
    {
       this.form = form;
       this.errorMessage = form.querySelector('.error-message');
       this.totalErrorCount = form.querySelector('.total-error-count');
        // this.errorMessage = form.find('.error-message');
        // this.totalErrorCount = form.find('.total-error-count');
       
       // Liste des messages d'erreurs de validation de données
       this.errorMessages = null;
    }
    
    run()
    {
        // Mise en place du(es) écouteurs d'évènements (submit)
        
        // S'il y déjà un message d'erreur (erreur serveur cf un client existe déjà)
        // Afficher le message d'erreur
    }
}
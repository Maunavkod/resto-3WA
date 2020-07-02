'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function runFormValidation()
{
    // Récupération des formulaires de la page
    // Non... Ce sont des balises... Va les chercher toutes et mets ca dans une variable...
    const forms = document.querySelectorAll('form');
    
    if (forms.length === 0){
        return;
    }
    
    forms.forEach(form => {
        let formValidator = new FormValidator(form);
        formValidator.run();
    });
    
    
    // Affectaction d'une instance de FormValidator pour chaque formulaire et exucution de run()
}


/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

document.addEventListener('DOMContentLoaded', () => {
    // Lancer la validation des formulaires
    
    // Masquage automatiques des notification au bout de 3 secondes
    
    // ... plus tard...
});

// $(() => {
    
// });
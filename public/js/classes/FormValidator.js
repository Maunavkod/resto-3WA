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
    
    checkDataTypes()
    {
        // Pour chaque champe qui a l'attribut data-type
            // S'il a une longueur (s'il est rempli, 
            // on veut pas le rendre obligatoire comme pour les autres tests)
            // En fonction de ce qu'il y a comme valeur dans le data-type (ici est le switch...)
                // Si c'est number on regarde si c'est pas un nombre... et génère une erreur
                // Si c'est integer on regarde si c'est pas un nombre... et génère une erreur
                // etc...
        this.form.querySelectorAll('[data-type]').forEach(input => {
            // oui c'est bien mais peut mieux faire... L'idée c'est de bien gérer l'erreur et de ne pas faire la suite
            // Mais on ne mets pas du code normal dans un if idéalement, on va gérer l'erreur et sortir...
            if (!input.value.trim().length){
                return;
            }
            switch (input.dataset.type) {
                // oui c'est l'idée, maitenant dans chaque case, 
                // fait la condition de test et génère une erreur comme on a déjà fait
                case 'number':
                    // Euh... Elles attendent des paramètres nos fonctions isNumber et isInteger...
                    if(!isNumber(value)){
                        this.errorMessages.push({
                            fieldName: input.dataset.name,
                            message: `doit être un nombre`
                        });
                    }
                    break;
                case 'integer':
                    if(!isInteger(value)){
                        this.errorMessage.push({
                            fieldName: input.dataset.name,
                            message: 'doit être un nombre entier'
                        });
                    }
                    break;
                case 'positive-integer':
                    if(!isInteger(value) || !(value >= 0)){
                        this.errorMessage.push({
                            fieldName: input.dataset.name,
                            message: 'doit être un nombre entier'
                        });
                    }
                    break;
            }
        });
    }
    
    checkMinimumLength()
    {
        this.form.querySelectorAll('[data-minlength]').forEach(input => {
           if (input.value.trim().length && input.value.trim().length < input.dataset.minlength){
               this.errorMessages.push({
                   fieldName: input.dataset.name,
                   message: `doit comporter au moins ${input.dataset.minlength} caractère(s)`
               });
           }
        });
    }
    
    checkRequiredFields()
    {
        // 5 - Pour chaque champ data-required
            // S'il ne sont pas rempli
                // Générer une erreur et la mettre dans this.errorMessages
        this.form.querySelectorAll('[data-required]').forEach(input => {
            // Dans quoi as-t-on ce que tape la personne et que l'on va regarder ??
            // Formulaire? Input? BDD?
            
            if (!input.value.trim().length){
                this.errorMessages.push('Le champ ' + input.dataset.name + 'est requis');
            }
        });
        // on va chercher parmi les enfants du formulaire tous ceux qui ont l'attribut data-required...
        // Pas l'attribut data-required du document...
        // on veut les enfants qui ont l'attribut data-required (cf ligne 8)
        // et on boucle dessus, cf main.js
        //if (this.form.getAttribute('data-required')) {
        //    for(let i=1; i <= this.form.getAttribute('data-required').length; i++){
        //        this.errorMessages.push(this.errorMessage);
        //    }
        //}
    }
    
    onSubmit(event)
    {
        // I'M A FUCKING PICKLE RICK !!
        event.preventDefault();
        
        let errorMessage = '';
        // 2 - Masquer les message d'erreur
        this.errorMessage.classList.add('hidden');
        
        // 3 - Initialisation des variables et/ou propriétés
        this.errorMessages = [];
        
        // 4 - Execution des différentes vérifications du formulaire
        this.checkRequiredFields();
        this.checkMinimumLength()
        this.checkDataTypes();
        
        
        // 6 - S'il y a des erreurs
            // Empêcher l'envoi
            // Changer dans le DOM le nombre d'erreurs
            // Mettre les messages d'erreur dans le DOM (chaque message...)
            // Afficher le message d'erreur
        // this.errorMessages est un tableau donc toujours différent de 0
        if(this.errorMessages.length)
        {
            // Empêcher l'envoi
            event.preventDefault();
            // on a déjà totalerrorcount, regarde le constructeur
            // textContent est une propriété pas une méthode et count n'existe pas ;)
            this.totalErrorCount.textContent = this.errorMessages.length;
            
            
            // this.errorMessages est un tableau, pourquoi s'embeter avec un for ?
                // idem ici textContent est une propriété pas une méthode
            this.errorMessages.forEach({fieldName, message} => )
        }    
    }
    
    
    run()
    {
        //1 Mise en place du(es) écouteurs d'évènements (submit)
        this.form.addEventListener('submit', this.onSubmit.bind(this));
        
        // S'il y déjà un message d'erreur (erreur serveur cf un client existe déjà)
        
        // Afficher le message d'erreur
        // this.errorMessage c'est notre aside de class .error-message, 
        // on veut aller regarder si dans son enfant <p> on a qqch
        // Si c'est le cas, on affiche this.errorMessage
        
        if (this.errorMessage.querySelector('p').textContent.length > 0) {
                this.errorMessage.classList.remove('hidden');
                // fadeIn(this.errorMessage, 1000);
        }
    }
}
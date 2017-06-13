$(document).ready(function() {
    // Lorsque je soumets le formulaire
    $('body').on('submit', '.submitAjax', function(e) {
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
        var $this = $(this); // L'objet jQuery du formulaire
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: $this.attr('action'), // Le nom du fichier indiqué dans le formulaire
            type: $this.attr('method'), // La méthode indiquée dans le formulaire (get ou post)
            data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: setTimeout(function(){
                $(".newsfeedwrap").load(location.href + " .newsfeed");
            },100)
        });
    });

    $('body').on('click', '.supprComment', function(e) {
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
        var $this = $(this); // L'objet jQuery du formulaire
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: $this.attr('href'), // Le nom du fichier indiqué dans le formulaire
            data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: setTimeout(function(){
                $(".newsfeedwrap").load(location.href + " .newsfeed");
            },100)
        });
    });

    $('body').on('click', '.supprNews', function(e) {
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
        var $this = $(this); // L'objet jQuery du formulaire
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: $this.attr('href'), // Le nom du fichier indiqué dans le formulaire
            data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: setTimeout(function(){
                $(".newsfeedwrap").load(location.href + " .newsfeed");
            },100)
        });
    });

    $('body').on('click', '.thumb', function(e) {
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
        var $this = $(this); // L'objet jQuery du formulaire
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: $this.attr('href'), // Le nom du fichier indiqué dans le formulaire
            data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: setTimeout(function(){

                $(".newsfeedwrap").load(location.href + " .newsfeed");
               
            },200)
        });
    });
    
    $('body').on('click', '.chatAjax', function(e) {
        e.preventDefault(); // J'empêche le comportement par défaut du navigateur, c-à-d de soumettre le formulaire
        var $this = $(this); // L'objet jQuery du formulaire
        // Envoi de la requête HTTP en mode asynchrone
        $.ajax({
            url: $this.attr('href'), // Le nom du fichier indiqué dans le formulaire
            data: $this.serialize(), // Je sérialise les données (j'envoie toutes les valeurs présentes dans le formulaire)
            success: function(){
                $(".refreshChatRoom").load(location.href + " .wrapRefreshChatRoom");
                $(".refreshChat").load(location.href + " .wrapRefreshChat");
                $(".refreshChatButton").load(location.href + " .wrapRefreshChatButton");
                var liste = document.getElementById($this.attr("id"));
                liste.style.color="black";
                test($this.attr('href'));
            }
        });
    });
});

function sleep(functionName, param, timeInMS) {
	if (functionName === '') {
		functionName = 'nothing';
	} 
                
	var s = functionName + '("' + param + '")';
		
	setTimeout(s, timeInMS);

}

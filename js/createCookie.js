function createCookie(nom, valeur, jours) {
// Le nombre de jours est spécifié
        if (jours) {
var date = new Date();
                // Converti le nombre de jour en millisecondes
date.setTime(date.getTime()+(jours*24*60*60*1000));
var expire = "; expire="+date.toGMTString();
}
        // Aucune valeur de jours spécifiée
else var expire = "";
document.cookie = nom+"="+valeur+expire+"; path=/";
}
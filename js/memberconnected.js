function writeInDiv(text){
    var objet = document.getElementById('memberconnected');
    objet.innerHTML = text;
}
var tmp = setInterval(function(){ refresh() }, 10000);

function refresh()
{
    var xhr=null;
    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject){
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("GET", "/ensisocial/memberconnected.php", false);
    xhr.send(null);
    writeInDiv(xhr.responseText);
}

$('#thumbs_up').click(function() {
    // L'URL du fichier dans lequel tu appelles ta fonction
    var url = '/thumbup.php';
    $.post(url, function(data){
        // Tu affiches le contenu dans ta div
        $('.thumbup').html(data);
    });
});

$('#thumbs_down').click(function() {
    // L'URL du fichier dans lequel tu appelles ta fonctio
    var url = '/thumbdown.php';
    $.post(url, function(data){
        // Tu affiches le contenu dans ta div
        $('.thumbdown').html(data);
    });
});
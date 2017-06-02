function writeInDiv(text){
    var objet = document.getElementById('memberconnected');
    objet.innerHTML = text;
}

function member()
{
    var xhr=null;

    if (window.XMLHttpRequest || window.ActiveXObject) {
        if (window.ActiveXObject) {
            try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch(e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
        else{
            xhr = new XMLHttpRequest();
        }
    }
    xhr.open("GET", "memberconnected.php", false);
    xhr.send(null);
    writeInDiv(xhr.responseText);
        setInterval("ajax()",5000);
}

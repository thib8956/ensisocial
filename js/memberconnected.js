function writeInDiv(text){
    var objet = document.getElementById('memberconnected');
    objet.innerHTML = text;
}

function ajax()
{
    var xhr=null;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("GET", "memberconnected.php", false);
    xhr.send(null);
    writeInDiv(xhr.responseText);
        setInterval("ajax()",5000);
}

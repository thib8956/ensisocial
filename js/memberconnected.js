function writeInDiv(text){
    var objet = document.getElementById('ta_div');
    objet.innerHTML = text;
}

function refresh()
{
    top.window.focus()
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
    setInterval("refresh()",5000);
}

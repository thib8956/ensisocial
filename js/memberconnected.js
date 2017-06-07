function writeInDiv(text) {
    var objet = document.getElementById('memberconnected');
    objet.innerHTML = text;
}

var tmp = setInterval(function(){ refresh() }, 10000);

function createRequestObject() {
    var http;
    if(window.XMLHttpRequest || window.ActiveXObject){
        if(window.ActiveXObject){
            try{
                http= new ActiveXObject("Msxm12.XMLHTTP")
            }catch(e){
                http= new ActiveXObject("Microsoft.XMLHTTP")
            }
        }else {
            http=new XMLHttpRequest();
        }
    } else  {
       alert("Votre navigateur ne supporte pas l'objet XMLHttpRequest");
    return null
    }
    return http;
}


function refresh() {
    var xhr=createRequestObject();
    xhr.open("GET", "memberconnected.php", false);
    xhr.send(null);
    writeInDiv(xhr.responseText);
    setInterval("refresh()",10000);
}

function clicup(num,iduser) {
    http = createRequestObject();
    http.open("POST", 'thumb.php', true);
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.send("num="+num+"&action=0&iduser="+iduser);
}

function clicdown(num,iduser) {
    http = createRequestObject();
    http.open("POST", 'thumb.php', true);
    http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http.send("num="+num+"&action=1&iduser="+iduser);
}

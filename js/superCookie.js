/*$(document).ready(function() {*/
    
    function setCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000));
            var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
        document.cookie = name+"="+value+expires+"; path=/";
        alert('caca');
    }
    function getCookie (name)
    {
        var arg  = name +"=";
        var alen = arg.length;
        var clen = document.cookie.length;
        var i = 0;
        while (i<clen)
        {
            var j = i + alen;
            if (document.cookie.substring(i, j) == arg)
            {
                return getCookieVal (j);
            }
            i = document.cookie.indexOf(" ",i) + 1;
            if (i == 0)
            {
                break;
            }
        }
        return null;
    }
    
/*});*/

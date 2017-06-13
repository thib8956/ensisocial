$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://192.168.1.55:9000/ensisocial/messagerie/server.php"; 	//path du serveur!!!!!
	websocket = new WebSocket(wsUri);

	websocket.onopen = function(ev) { // connection is open
		//$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
        var myname = getCookie('prenom')+" "+getCookie('nom'); //get user name
        var mycolor = getCookie('color'); //get user color
        var myid = getCookie('userid'); //get user id

		//prepare json data
		var msg = {
		message: "log",
		name: myname,
		color: mycolor,
        type: "logmsg",
        to: "all",
        from: myid
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
        
        var myname = getCookie('prenom')+" "+getCookie('nom'); //get user name
        var myid = getCookie('userid'); //get user id
        var mycolor = getCookie('color'); //get user color
        var mydest = $('#message').attr("name"); //get user destinataire

        var objDiv = document.getElementById("message_box");
        objDiv.scrollTop = objDiv.scrollHeight;
        //prepare json data
        var msg = {
        message: "load",
        name: myname,
        color: mycolor,
        type: "loadmsg",
        to: mydest,
        from: myid
        };
        //convert and send data to server
        websocket.send(JSON.stringify(msg));
        $('#message').val(''); //reset text
	}

	$('#send-btn').click(function(){ //use clicks message send button
		var mymessage = $('#message').val(); //get message text
		var myname = getCookie('prenom')+" "+getCookie('nom'); //get user name
        var myid = getCookie('userid'); //get user id
        var mycolor = getCookie('color'); //get user color
        var mydest = $('#message').attr("name"); //get user destinataire

        if(mymessage == ""){ //emtpy message?
                //alert("Enter Some message Please!");
                return;
            }
            //document.getElementById("name").style.visibility = "hidden";

            var objDiv = document.getElementById("message_box");
            objDiv.scrollTop = objDiv.scrollHeight;
            //prepare json data
            var msg = {
            message: mymessage,
            name: myname,
            color: mycolor,
            type: "usermsg",
            to: mydest,
            from: myid
            };
            //convert and send data to server
            websocket.send(JSON.stringify(msg));
            $('#message').val(''); //reset text
        });

//    $('body').on('click', '.loadChat', function(){ //use clicks message send button
//		var myname = getCookie('prenom')+" "+getCookie('nom'); //get user name
//        var myid = getCookie('userid'); //get user id
//        var mycolor = getCookie('color'); //get user color
//        var url = $(this).attr("href"); //get user destinataire
//        var re = /.*?id=(.*)/;
//        var mydest = url.replace(re, '$1');
//
//		//var objDiv = document.getElementById("message_box");
//		//objDiv.scrollTop = objDiv.scrollHeight;
//		//prepare json data
//		var msg = {
//		message: "load",
//		name: myname,
//		color: mycolor,
//        type: "loadmsg",
//        to: mydest,
//        from: myid
//		};
//		//convert and send data to server
//		websocket.send(JSON.stringify(msg));
//        $('#message').val(''); //reset text
//	});

	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		var uname = msg.name; //user name
        uname = uname.replace(/\+/g, " ");
		var ucolor = msg.color; //color
        var ufrom = msg.from; //from

		if(type == 'usermsg' && ufrom == $('#message').attr("name"))
		{
			$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
		}
        else {
            var liste = document.getElementById("chat"+ufrom);
            liste.style.color="orange";
            createCookie("chat"+ufrom,"true","");
        }
		if(type == 'system')
		{
			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
		}

		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
	};

	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");};
	websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");};
});

function  getCookie(name){
     if(document.cookie.length == 0)
       return null;

     var regSepCookie = new RegExp('(; )', 'g');
     var cookies = document.cookie.split(regSepCookie);

     for(var i = 0; i < cookies.length; i++){
       var regInfo = new RegExp('=', 'g');
       var infos = cookies[i].split(regInfo);
       if(infos[0] == name){
         return unescape(infos[1]);
       }
     }
     return null;
}

function createCookie(name,value,days) {
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}

function test(url){ //use clicks message send button
//    var a;
//    for(i=0; i<100000000; i++) {
//        a+=1;
//    }
    window.setTimeout(function(){
    var myname = getCookie('prenom')+" "+getCookie('nom'); //get user name
    var myid = getCookie('userid'); //get user id
    var mycolor = getCookie('color'); //get user color
    var re = /.*?id=(.*)/;
    var mydest = url.replace(re, '$1');

    var objDiv = document.getElementById("message_box");
    objDiv.scrollTop = objDiv.scrollHeight;
    //prepare json data
    var msg = {
    message: "load",
    name: myname,
    color: mycolor,
    type: "loadmsg",
    to: mydest,
    from: myid
    };
    //convert and send data to server
    websocket.send(JSON.stringify(msg));
    $('#message').val(''); //reset text
    }, 400)};

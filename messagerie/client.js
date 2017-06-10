$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://localhost:9000/ensisocial/messagerie/server.php"; 	//path du serveur!!!!!
	websocket = new WebSocket(wsUri);

	websocket.onopen = function(ev) { // connection is open
		//$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
	}

	$('#send-btn').click(function(){ //use clicks message send button
		var mymessage = $('#message').val(); //get message text
		var myname = getCookie('prenom')+" "+getCookie('nom'); //get user name
        var mycolor = getCookie('color'); //get user color


		if(myname == ""){ //empty name?
			alert("Enter your Name please!");
			return;
		}
		if(mymessage == ""){ //emtpy message?
			alert("Enter Some message Please!");
			return;
		}
		//document.getElementById("name").style.visibility = "hidden";

		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
		//prepare json data
		var msg = {
		message: mymessage,
		name: myname,
		color : mycolor
		};
		//convert and send data to server
		websocket.send(JSON.stringify(msg));
        $('#message').val(''); //reset text
	});

	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		var uname = msg.name; //user name
		var ucolor = msg.color; //color

		if(type == 'usermsg')
		{
			$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
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

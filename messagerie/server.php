<?php
$host = 'localhost/ensisocial/messagerie'; //host  !!!!!!!
$port = '9000'; //port
$null = NULL; //null var

//Create TCP/IP sream socket
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//reuseable port
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);

//bind socket to specified host
socket_bind($socket, 0, $port);

//listen to port
socket_listen($socket);

$defaultid = -1;
//create & add listning socket to the list
$clients = array($socket);

$map = array();

//base de donnée
try {
	$db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8mb4", "root", "");
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Error:'.$e->getMessage());
}
try {
    $insertall = $db->prepare('INSERT INTO chatgeneral (`type`, `name`, `message`, `color`, `lu`)
            VALUES (:type, :name, :message, :color, :lu)');
    $insert = $db->prepare('INSERT INTO message (`id_sender`, `id_recipient`, `type`, `name`, `lu`, `message`)
            VALUES (:id_sender, :id_recipient, :type, :name, :lu, :message)');

    $reqall = $db->prepare('SELECT * FROM chatgeneral');
    $req = $db->prepare('SELECT * FROM message WHERE (id_sender = :id_sender AND id_recipient = :id_recipient) OR (id_sender = :id_recipient2 AND id_recipient = :id_sender2)');

} catch (PDOException $e) {
    die('Error:'.$e->getMessage());
}

//start endless loop, so that our script doesn't stop
while (true) {
	//manage multipal connections
	$changed = $clients;
	//returns the socket resources in $changed array
	socket_select($changed, $null, $null, 0, 10);

	//check for new socket
	if (in_array($socket, $changed)) {
		$socket_new = socket_accept($socket); //accpet new socket
		$clients[] = $socket_new; //add socket to client array

		$header = socket_read($socket_new, 1024); //read data sent by the socket
		perform_handshaking($header, $socket_new, $host, $port); //perform websocket handshake

		socket_getpeername($socket_new, $ip); //get ip address of connected socket
		$response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' connected'))); //prepare json data
		//send_message($response); //notify all users about new connection

		//make room for new socket
		$found_socket = array_search($socket, $changed);
		unset($changed[$found_socket]);
	}

	//loop through all connected sockets
	foreach ($changed as $changed_socket) {

		//check for any incomming data
		while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
		{
			$received_text = unmask($buf); //unmask data
			$tst_msg = json_decode($received_text); //json decode
			$user_name = $tst_msg->name; //sender name
            $user_name = mb_convert_encoding($user_name, "auto");
			$user_message = $tst_msg->message; //message text
			$user_color = $tst_msg->color; //color
            $user_type = $tst_msg->type; //type
            $user_to = $tst_msg->to; //to
            $user_from = $tst_msg->from; //from

            if($user_message != null & $user_name != null) {
                //prepare data to be sent to client
                if($user_type == 'usermsg') {
                    if($user_to == 'all') {
                        $response_text = mask(json_encode(array('type'=>'usermsg', 'name'=>$user_name, 'message'=>$user_message, 'color'=>$user_color, 'from'=>'all')));
                        send_message($response_text); //send data
                    }
                    else {
                        //base de donnée
                        try {
                           $insert->execute(array('id_sender' => $user_from,
                            'id_recipient' => $user_to,
                            'type' => $user_type,
                            'name' => $user_name,
                            'lu' => FALSE,
                            'message' => $user_message
                            ));
                        } catch (Exception $e) {
                            die('Error:'.$e->getMessage());
                        }

                        $response_text = mask(json_encode(array('type'=>'usermsg', 'name'=>$user_name, 'message'=>$user_message, 'color'=>'000000', 'from'=>$user_from)));
                        $socketById=$map[$user_to];
                        send_messageClient($response_text, $socketById);
                        $response_text = mask(json_encode(array('type'=>'usermsg', 'name'=>$user_name, 'message'=>$user_message, 'color'=>'0000FF', 'from'=>$user_to)));
                        $socketById=$map[$user_from];
                        send_messageClient($response_text, $socketById);
                    }
                }
                elseif($user_type == 'logmsg'){
                    $map[$user_from] = $changed_socket;
                }
                elseif($user_type == 'loadmsg'){
                    if($user_to == 'all') {
                        $reqall->execute();
                        while($rowall = $reqall->fetch()) {
                            $response_text = mask(json_encode(array('type'=>$rowall['type'], 'name'=>$rowall['name'], 'message'=>$rowall['message'], 'color'=>$rowall['color'], 'from'=>'all')));
                            $socketById=$map[$user_from];
                            send_messageClient($response_text, $socketById);
                        }
                    }
                    else {
                        $req->execute(array('id_sender'=> $user_from, 'id_recipient' => $user_to, 'id_recipient2'=> $user_to, 'id_sender2' => $user_from));
                        while($row = $req->fetch()) {
                            if($user_from == $row['id_sender']) {
                                $ucolor='0000FF';
                            }
                            else {
                                $ucolor='000000';
                            }
                            $response_text = mask(json_encode(array('type'=>$row['type'], 'name'=>$row['name'], 'message'=>$row['message'], 'color'=>$ucolor, 'from'=>$user_to)));
                            $socketById=$map[$user_from];
                            send_messageClient($response_text, $socketById);
                        }

                    }
                }
            }
			break 2; //exist this loop
		}

		$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
		if ($buf === false) { // check disconnected client
			// remove client for $clients array
			$found_socket = array_search($changed_socket, $clients);
			socket_getpeername($changed_socket, $ip);
			unset($clients[$found_socket]);

			//notify all users about disconnected connection
			//$response = mask(json_encode(array('type'=>'system', 'message'=>$ip.' disconnected')));
			//send_message($response);
		}
	}
}
// close the listening socket
socket_close($socket);

function send_message($msg)
{
	global $clients;
	foreach($clients as $changed_socket)
	{
		@socket_write($changed_socket,$msg,strlen($msg));
	}
	return true;
}

function send_messageClient($msg,$client)
{
    @socket_write($client,$msg,strlen($msg));
	return true;
}


//Unmask incoming framed message
function unmask($text) {
	$length = ord($text[1]) & 127;
	if($length == 126) {
		$masks = substr($text, 4, 4);
		$data = substr($text, 8);
	}
	elseif($length == 127) {
		$masks = substr($text, 10, 4);
		$data = substr($text, 14);
	}
	else {
		$masks = substr($text, 2, 4);
		$data = substr($text, 6);
	}
	$text = "";
	for ($i = 0; $i < strlen($data); ++$i) {
		$text .= $data[$i] ^ $masks[$i%4];
	}
	return $text;
}

//Encode message for transfer to client.
function mask($text)
{
	$b1 = 0x80 | (0x1 & 0x0f);
	$length = strlen($text);

	if($length <= 125)
		$header = pack('CC', $b1, $length);
	elseif($length > 125 && $length < 65536)
		$header = pack('CCn', $b1, 126, $length);
	elseif($length >= 65536)
		$header = pack('CCNN', $b1, 127, $length);
	return $header.$text;
}

//handshake new client.
function perform_handshaking($receved_header,$client_conn, $host, $port)
{
	$headers = array();
	$lines = preg_split("/\r\n/", $receved_header);
	foreach($lines as $line)
	{
		$line = chop($line);
		if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
		{
			$headers[$matches[1]] = $matches[2];
		}
	}

	$secKey = $headers['Sec-WebSocket-Key'];
	$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
	//hand shaking header
	$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"WebSocket-Origin: $host\r\n" .
	"WebSocket-Location: ws://$host:$port/demo/shout.php\r\n".
	"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
	socket_write($client_conn,$upgrade,strlen($upgrade));
}
?>
















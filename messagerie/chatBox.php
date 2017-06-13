<?php
if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
session_start();
}
try {
    $db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8mb4", "root", "");
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $memberconnected = $db-> query('SELECT lastname, firstname, connectedTime, id FROM users');

    if(isset($_SESSION['id'])) {
        $connectionRefresh = $db->prepare('UPDATE users SET connectedTime = :time WHERE id = :id');
        $connectionRefresh->execute(array('time' => time(),'id' => $_SESSION['id']));
    }
} catch (PDOException $e) {
    die('Error:'.$e->getMessage());
}

?>

<div class="col-md-3 col-md-offset-9 col-sm-6 chat">
    <div class="panel-group chat-panel">
        <div class="panel panel-info">
            <a data-toggle="collapse" href="#collapse-chat">
                <div class="panel-heading chat-panel-heading">
                    <h4 class="panel-title chattitre">
                        <span class="glyphicon glyphicon-comment"></span>&nbsp;Chat
                    </h4>
                </div>
            </a>
            <div id="collapse-chat" class="panel-collapse collapse">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 chat-col-left">
                            <div>
                            <ul class="list-group small">
                                <?php
                                echo '<li class="list-group-item chatlist">';
                                echo '<a id="chatall" class="loadChat chatAjax" href="/ensisocial/messagerie/chatDestinataire.php?id=all" >Parler à tout le monde</a>';
                                echo '</li>';
                                while($data = $memberconnected->fetch()){
                                    $firstname = $data['firstname'];
                                    $lastname = $data['lastname'];
                                    $id = $data['id'];
                                    if ($id != $_SESSION['id']){
                                        if (htmlentities($data['connectedTime']) > time() - 11){
                                            echo '<li class="list-group-item chatlist">';
                                            echo '<a id="chat'.$id.'" class="loadChat chatAjax" href="/ensisocial/messagerie/chatDestinataire.php?id='.$id.'" >'.$firstname.' '.$lastname.'</a>';
                                            echo '</li>';
                                        }
                                        else {
                                            echo '<li class="list-group-item chatlist">';
                                            echo '<a id="chat'.$id.'" class="loadChat chatAjax" href="/ensisocial/messagerie/chatDestinataire.php?id='.$id.'" >'.$firstname.' '.$lastname.'</a>';
                                            echo '</li>';
                                        }
                                    }
                                }
                                ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-6 chat-col-right">
                            <div class="chat_wrapper">
                                <div class="wrapRefreshChat" >
                                <div class="refreshChat" >
                                    <div>
                                        <p class="chattitle"><?php echo $_SESSION['room']; ?></p>
                                    </div>
                                    <div class="message_box" id="message_box"></div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer chat-panel-footer">
                                <div class="input-group add-on">
                                    <div class="wrapRefreshChatButton" >
                                    <div class="refreshChatButton" >
                                        <input type="text" name="<?php echo $_SESSION['destinataire']; ?>" id="message" placeholder="Message" maxlength="80" onkeydown = "if (event.keyCode == 13)document.getElementById('send-btn').click()" class="form-control ui-autocomplete-input" />
                                    </div>
                                    </div>
                                    <div class="input-group-btn">
                                        <button id="send-btn" class="btn btn-default">
                                            <span class="sr-only">Envoyer le message</span>
                                            <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>

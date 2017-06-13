<style type="text/css">
    .test {
        position: fixed;
        bottom: 0;
        z-index: 8;
    }
</style>
<div class="panel-group test">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" href="#collapse1">Collapsible panel</a>
            </h4>
        </div>
        <div id="collapse1" class="panel-collapse collapse">
            <div class="wrapRefreshChatRoom" >
            <div class="refreshChatRoom" >
            <div class="panel-body">
            <?php
            if(session_status() != 2) {  //on verifie si la session n'est pas deja demarrée
            session_start();
            }
            try {
                $db = new PDO("mysql:host=localhost;dbname=ensisocial;charset=utf8", "root", "");
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
            echo '<ul class="list-group">';
            while($data = $memberconnected->fetch()){
                $firstname = $data['firstname'];
                $lastname = $data['lastname'];
                $id = $data['id'];

                if (htmlentities($data['connectedTime']) > time() - 11){
                    echo '<li class="list-group-item">';
                    echo '<span class="glyphicon glyphicon-record" style="color:#58D68D"></span>';
                    echo '<a class="loadChat chatAjax" href="/ensisocial/messagerie/chatDestinataire.php?id='.$id.'" >'.$firstname.' '.$lastname.'</a>';
                    echo '</li>';
                }
                else {
                    echo '<li class="list-group-item">';
                    echo '<span class="glyphicon glyphicon-record" style="color:#D3D3D3"></span>';
                    echo '<a class="loadChat chatAjax" href="/ensisocial/messagerie/chatDestinataire.php?id='.$id.'" >'.$firstname.' '.$lastname.'</a>';
                    echo '</li>';
                }
            }
            echo '</ul>';
            echo '<a class="loadChat chatAjax" href="/ensisocial/messagerie/chatDestinataire.php?id=all" >parler a tous le monde</a>';
            echo '<br/>';
            echo $_SESSION['destinataire'];
            ?>
            
            </div>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3 col-md-offset-9 col-sm-6 chat">
    <div class="panel-group chat-panel">
        <div class="panel panel-info">
            <a data-toggle="collapse" href="#collapse-chat">
                <div class="panel-heading chat-panel-heading">
                    <h4 class="panel-title">
                        <span class="glyphicon glyphicon-comment"></span>&nbsp;Chat
                    </h4>
                </div>
            </a>
            <div id="collapse-chat" class="panel-collapse collapse">
                <div class="chat_wrapper">
                    <div class="wrapRefreshChat" >
                    <div class="refreshChat" >
                        <div class="panel-body message_box" id="message_box"></div>
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

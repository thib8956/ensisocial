<style type="text/css">
    .chat {
        position: fixed;
        line-height: 0;
        bottom:0;
        width: 25%;
    }
    
    input[type=text]{
		width:100%;
		margin-top:5px;

	}


    .chat_wrapper {
/*
        width: 70%;
        height:472px;
        background: #3B5998;
        border: 1px solid #999999;
        padding: 10px;
*/
        font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
    }
    .chat_wrapper .message_box {
/*        background: #F7F7F7;*/
        height:300px;
            overflow: auto;
/*        padding: 10px 10px 20px 10px;*/
/*        border: 1px solid #999999;*/
    }
    .chat_wrapper  input{
        padding: 2px 2px 2px 5px;
    }
    .system_msg{color: #BDBDBD;font-style: italic;}
    .user_name{font-weight:bold;}
    .user_message{color: #88B6E0;}

    @media only screen and (max-width: 720px) {
    /* For mobile phones: */
        .chat_wrapper {
        width: 95%;
        height: 40%;
        }

        .button { 
        width:100%;
        margin-right:auto;
        margin-left:auto;
        height:40px;
        }
    }

</style>

<div class="container chat">
  <div class="panel-group">
    <div class="panel panel-info">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Chat</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
          <div class="chat_wrapper">
              <div class="panel-body message_box" id="message_box"></div>
            </div>
        <div class="panel-footer">
            <div>
                <input type="text" name="message" id="message" placeholder="Message" maxlength="80" onkeydown = "if (event.keyCode == 13)document.getElementById('send-btn').click()" class="form-control ui-autocomplete-input" />
            </div>
            <button id="send-btn" class="btn btn-primary">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>
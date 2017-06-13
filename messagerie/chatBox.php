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
          <div class="panel-body message_box" id="message_box"></div>
        </div>
        <div class="panel-footer chat-panel-footer">
          <div class="input-group add-on">
            <input type="text" name="message" id="message" placeholder="Message" maxlength="80" onkeydown = "if (event.keyCode == 13)document.getElementById('send-btn').click()" class="form-control ui-autocomplete-input" />
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

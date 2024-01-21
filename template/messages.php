<div class="container text-center chat-container" id="chat-container-<?php echo $_SESSION['username']; ?>-<?php echo $templateParams['reciver']; ?>" sender="" reciver="">
    <div class="row" id="user-information">
        <div class="col text-align-center"> <img src="<?php echo AVATAR_FOLDER . $templateParams["img"] ?>" class="avatar" alt="" /> <?php echo $templateParams['reciver']; ?></div>
    </div>
    <div class="chat" id="chat">
        <div class="chat-box" id="chat-box"></div>
    </div>
    <div class="input-group mb-3 pt-4" id="message-form">
        <input type="text" class="form-control" placeholder="Scrivi il messaggio" id="message-text">
        <button class="btn btn-primary" id="send-message-button" type="button">Send</button>
    </div>
</div>

<div class="modal" tabindex="-1" aria-hidden="true" id="message-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Elimina il messaggio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Sei sicuro di voler eliminare il messaggio?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="remove-msg" data-bs-dismiss="modal" class="btn btn-primary">Elimina</button>
      </div>
    </div>
  </div>
</div>
<script src="js/messages.js"></script>

<div class="container text-center" id="chat-container" sender="<?php echo $_SESSION['username']; ?>" reciver="<?php echo $templateParams['reciver']; ?>">
    <div class="chat" id="chat">
    </div>
    <div class="input-group mb-3 pt-4" id="message-form">
        <input type="text" class="form-control" placeholder="Scrivi il messaggio" id="message-text">
        <button class="btn btn-primary" type="button" onclick="sendMessage()">Send</button>
    </div>

</div>

<script src="js/messages.js"></script>

<div class="container text-center" id="chat-container" sender="<?php echo $_SESSION['username']; ?>" reciver="<?php echo $templateParams['reciver'];?>">
    <div class="row" id="user-information">
        <div class="col text-align-center"> <?php echo $templateParams['reciver'];?></div>
    </div>
    <div class="chat" id="chat">
    <div class="chat-box" id="chat-box"></div>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Scrivi il messaggio" id="message-text">
        <button class="btn btn-primary" type="button" onclick="sendMessage()">Send</button>
    </div>
    
</div>

<script src="js/messages.js"></script>
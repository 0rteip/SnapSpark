<div class="container text-center chat-container" id="chat-container-<?php echo $_SESSION['username']; ?>-<?php echo $templateParams['reciver'];?>" sender="" reciver="">
    <div class="row" id="user-information">
        <div class="col text-align-center"> <img src="<?php echo AVATAR_FOLDER . $templateParams["img"]?>" class="profile-avatar" alt="" /> <?php echo $templateParams['reciver'];?></div>
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
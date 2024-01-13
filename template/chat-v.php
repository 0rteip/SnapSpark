<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="location.href='new-chat.php'">Create New Chat</button>
        </div>
        <div class="col-3" >
            <input class="form-control bg-info-subtle" type="search" placeholder="Search" aria-label="Search" onkeyup="chatSearch(this.value, 3)">
        </div>
    </div>
</div>

<div class="container chat-container" id="chat-container">
    <?php foreach($templateParams['chats'] as $chat) : ?>
        <a href="chat.php?reciver=<?php echo $chat['user']?>">
            <div class="user-card">
                <img alt="" class="avatar" id="chat-avatar" src="<?php echo AVATAR_FOLDER . 'avatar.png'; ?>">
                <div class="user-info">
                    <div class="user-name"><?php echo $chat['user'] ?></div>
                    <div class="last-message"><?php echo $chat['testo'] ?></div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<script src="js/search.js"></script>

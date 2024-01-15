<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="location.href='new-chat.php'">Create New Chat</button>
        </div>
        <div class="col-3">
            <input id="search-bar-chats" class="form-control bg-main-color-subtle" type="search" placeholder="Search" aria-label="Search" onkeyup="chatSearch(this.value, 3)">
        </div>
    </div>
</div>

<div class="container chat-container" id="chat-container">
</div>

<script src="js/update-chatList.js"></script>

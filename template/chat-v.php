<div class="text-center mb-4 pb-4 px-0" id="new-chat-div">
    <div class="row row-cols-2 justify-content-center">
        <div class="col-sm-10">
            <label for="search-bar-chats" class="visually-hidden">Search chats</label>
            <input id="search-bar-chats" class="form-control bg-main-color-subtle" type="search" placeholder="Search chat" aria-label="Search" onkeyup="chatSearch(this.value, 3)">
        </div>
        <div class="col-sm-2 text-end">
            <button type="button" class="btn btn-primary" onclick="location.href='new-chat.php'">New Chat</button>
        </div>
    </div>
</div>

<div class="chat-container px-0" id="chat-container">
</div>

<script src="js/update-chatList.js"></script>

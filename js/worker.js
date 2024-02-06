self.addEventListener('message', function (e) {
    const reciver = e.data.split('¬')[0];
    const type = e.data.split('¬')[1];
    if (e.origin !== self.origin) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../utils/notification.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("action=send" + "&reciver=" + reciver + "&type=" + type);
    }
});

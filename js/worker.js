self.addEventListener('message', function (e) {
    if (e.origin !== self.origin) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../utils/segui.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                self.postMessage(this.responseText);
            }
        };

        xhr.send(e.data);
    }
});

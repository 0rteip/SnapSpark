function checkUserName(element) {
    return new Promise(function(resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/login-validation.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("username=" + element.value);
        xhr.onload = function () {
            let result = JSON.parse(this.responseText);
            if (!result) {
                document.querySelector('div#usernameCustomValid').innerHTML = 'Nome utente già in uso';
            }
            change(element, result)
            resolve(result);
        }
        })
}

function validateOneInput(element) {
    switch (element.getAttribute('name')) {
        case 'username': if (/^[a-zA-Z_]+$/.test(element.value)) {
            checkUserName(element).then(
                function(value) {
                    console.log("fine reale")
                    return value;
                }
            ) ;
            console.log("fine");
            return;
        } else {
            change(element, false);
            document.querySelector('div#usernameCustomValid').innerHTML = 'Username mast contains only a-z, A-Z and _';
        }
        case 'numero': if (element.getAttribute('name') === 'numero') {
            let check = element.value.length == 10;
            console.log(check)
            change(element, check);
        }

    }

}

function change(element, valid) {
    if (!valid) {
        console.log('invalid');
        element.classList.remove("is-valid")
        element.classList.add("is-invalid");
    } else {
        console.log("valid")
        element.classList.remove("is-invalid")
        element.classList.add("is-valid");
    }
}

$(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault();
        event.stopPropagation();

        this.checkValidity(); // Esegue la validazione di Bootstrap

        validateInputs()
            .then(function (results) {
                var isCustomValid = results.every(result => result);
                if (!isCustomValid) {
                    // Gestisci il caso in cui almeno una validazione personalizzata fallisce
                    console.log('Almeno una validazione personalizzata ha fallito');
                } else {
                    // Tutte le validazioni personalizzate sono passate
                    console.log('Tutte le validazioni personalizzate sono passate');
                    this.submit(); // Invia il modulo se tutte le validazioni sono passate
                }
            })
            .catch(function (error) {
                console.error(error);
            });
    });

    document.querySelectorAll('input.extra-validation').forEach(element => {
        element.addEventListener("input", function () {
            validateOneInput(element);
        })
    });

});

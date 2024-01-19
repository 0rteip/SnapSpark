function checkUserName(element) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/login-validation.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            let result = JSON.parse(this.responseText);
            console.log(result);
            if (!result) {
                document.querySelector('div#usernameCustomValid').innerHTML = 'Nome utente già in uso';
            }
            change(element, result)
            console.log("ritorno");
        }
        xhr.send("username=" + element.value);
}

function validateOneInput(element) {
    if (element.getAttribute('name') === 'username') {
        if (/^[a-zA-Z_]+$/.test(element.value)) {
            checkUserName(element)
            return;
        }
        change(element, false);
        document.querySelector('div#usernameCustomValid').innerHTML = 'Username mast contains only a-z, A-Z and _';
    } else if (element.getAttribute('name') === 'numero') {
        change(element, element.value.length);
    }
}

function validateInputs() {
    var promises = [];
    document.querySelectorAll('input.extra-validation').forEach(element => {
        promises.push(validateOneInput(element));
    });
    return Promise.all(promises);
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
            .then(function(results) {
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
            .catch(function(error) {
                console.error(error);
            });
    });

    document.querySelectorAll('input.extra-validation').forEach(element => {
            element.addEventListener("input", function() {
                validateOneInput(element);
            })
    });
        
});

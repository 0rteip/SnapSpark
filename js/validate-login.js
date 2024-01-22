function checkValue(element, action) {
    return new Promise(function(resolve, reject) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/login-validation.php");
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send("value=" + element.value + "&action=" + action);
        xhr.onload = function () {
            console.log(this.responseText)
            let result = JSON.parse(this.responseText);
            if (!result && action === 'user') {
                document.querySelector('div#usernameCustomValid').innerHTML = 'Nome utente già in uso';
            } else if(!result && action === 'mail'){
                document.querySelector('div#mailCustomValid').innerHTML = 'Mail utente già in uso';
            }
            resolve(result);
        }
        })
}

async function validateOneInput(element) {
    let check = true;
    switch (element.getAttribute('name')) {
        case 'username': if (/^[a-zA-Z_]+$/.test(element.value) && element.value.length <= 30) {
            try {
                const result = await checkValue(element, 'user');
                check = result;
            } catch (error) {
                console.error(error);
            }
        } else {
            check = false;
            document.querySelector('div#usernameCustomValid').innerHTML = 'Username mast contains only a-z, A-Z and _';
        }
        break;
        case 'numero': check = element.value.length == 10;
            break;
        case 'mail' : if(element.value.indexOf('@') >= 0 && element.value.length <= 40) {
            try {
                const result = await checkValue(element, 'mail');
                check = result;
            } catch (error) {
                console.error(error);
            }
        } else {
            check = false;
            document.querySelector('div#mailCustomValid').innerHTML = ' L\'email deve avere la @ e  al massimo 40 caratteri';
        }
            break;
        case 'nome' :
        case 'cognome' : check = element.value.length <= 20 && element.value.length > 0;
            break;
        case 'data_nascita' : let data = new Date();
            check = element.value.split('-')[0] <= data.getFullYear();
            if (!check) {
                element.value = "";
            }
            break;
        case 'password' : check = (element.value.length >= 8 && element.value.length <= 30)
            break;
        case 'biografia' : check = element.value.length <=100;
    }
        change(element, check);
        return check;
}

function change(element, valid) {
    if (!valid) {
        element.classList.remove("is-valid")
        element.classList.add("is-invalid");
    } else {
        element.classList.remove("is-invalid")
        element.classList.add("is-valid");
    }
}

async function validateAllInputs(event) {
    let elements = document.querySelectorAll('.extra-validation');
    for (let i = 0; i < elements.length; i++) {
        const res = await validateOneInput(elements[i]);
        if (!res) {
            console.log("blocco");
            return false;
        }
    }
    return true;
}


$(document).ready(function () {

    $("form").submit(async function (event) {
        event.preventDefault();  // Evita la presentazione del modulo di default

        let validationSuccessful = await validateAllInputs(event);

        if (validationSuccessful && this.checkValidity()) {
            this.submit();  // Invia manualmente il modulo se la validazione è riuscita
        }
    });
    

    document.querySelectorAll('.extra-validation').forEach(element => {
        element.addEventListener("input", function () {
            validateOneInput(element);
        })
    });

});

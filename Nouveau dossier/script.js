var mail = document.querySelector('input[name=mail]');
var confmail = document.querySelector('input[name=confEmail]');
var message = document.querySelector('textarea[name=message]');
var form = document.querySelector('form');
var submitButton = document.querySelector('input[type=submit]');

submitButton.disabled = true;

form.addEventListener('submit',
    (event) => {
        event.preventDefault();// Tu nne fais le fonctionnement normal du submit
        if (validateForm()) { //Tu valide mon formulaire
            fetch("script.php", { //Et si il est valide alors du fait une requete ajax
                method: "POST", // En post
                body: new FormData(document.querySelector('form')) //Avec le formulaire
            })
                .then(result => result.json())
                .then(data => {
                    flashMessage(data.status)
                });
        }
    });

form.addEventListener('change',
    () => {
        submitButton.disabled = !validateForm();
    });

function validateForm() {
    result = true;
    let errorMessage = "";

    validateAllFields();

    if (mail.value !== confmail.value) {
        result = false;
        validateField(mail, false);
        validateField(confmail, false);
        errorMessage += "Emails différents <br/>";
    } else if (mail.value.trim() === '' || !validateEmail(mail.value)) {
        result = false;
        validateField(mail, false);
        errorMessage += "Email non renseigné ou invalide<br/>";
    } else if (confmail.value.trim() === '' || !validateEmail(confmail.value)) {
        result = false;
        validateField(confmail, false);
        errorMessage += "Confirmation de l'Email non renseignée ou invalide<br/>";
    }
    if (message.value === '') {
        result = false;
        validateField(message, false);
        errorMessage += "Message non renseigné<br/>";
    }

    setMessage(result, errorMessage);
    return result;
}

function validateAllFields() {
    validateField(mail, true);
    validateField(confmail, true);
    validateField(message, true);
}

/**
 * 
 * @param {*boolean} ok 
 * @param {*string} message 
 * Le message approprié en fonction de l'état du formulaire
 */
function setMessage(ok, errorMessage = "") {
    if (ok) {
        document.querySelector('.formok').style.display = "block";
        document.querySelector('.error').style.display = "none";
    } else {
        document.querySelector('.error').innerHTML = errorMessage;
        document.querySelector('.error').style.display = "block";
        document.querySelector('.formok').style.display = "none";
    }
}

function validateField(field, valid) {
    if (valid) {
        field.classList.add("valid");
        field.classList.remove("invalid");
    }
    else {
        field.classList.add("invalid");
        field.classList.remove("valid");
    }
}


function validateEmail(mail) {
    if (/^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/
        .test(mail)) {
        return true;
    } else {
        return false;
    }
}

function flashMessage(ok = true) {
    if (ok) {
        document.querySelector('.success').style.display = "block";
        setInterval(() => {
            document.querySelector('.success').style.display = "none";
        }, 5000);
    } else {
        document.querySelector('.error').style.display = "block";
        setInterval(() => {
            document.querySelector('.error').style.display = "none";
        }, 5000);
    }
}
// mot de passe :

function passwordControl() {
    let password = document.getElementById("password");
    let alertPassword1 = document.getElementById("alertPassword");
    let regex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

    if (password.value.test(regex)) {
        alertPassword1.innerHTML = 'Mot de passe accepté!';
    } else {
        alertPassword1.innerHTML = 'Votre mot de passe doit contenir entre 8-30 caractères, 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.'
    }
};

function confirmPasswordControl() {
    let confirmPassword = document.getElementById("passwordConfirm");
    let alertPassword2 = document.getElementById("alertPassword");
    let regex = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

    if (confirmPassword.value.test(regex)) {
        alertPassword2.innerHTML = 'Mot de passe accepté!';
    } else {
        alertPassword2.innerHTML = 'Votre mot de passe doit contenir entre 8-30 caractères, 1 minuscule, 1 majuscule, 1 chiffre et 1 caractère spécial.';
    }
};

function passwordOk() {
    let password = document.getElementById("password");
    let confirmPassword = document.getElementById("passwordConfirm");
    let alertPassword3 = document.getElementById("alertPassword");
  
    if (password.value != confirmPassword.value) {
        alertPassword3.innerHTML = 'Les mots de passe doivent être identiques.';
    } else {
        alertPassword3.innerHTML = 'C\'est bon.';
    }
};

//bloquer l'envoi du formulaire si les conditions ne sont pas ok : (à faire)
let form = document.getElementById('form');
let submit = document.getElementById('submit');


let password = document.getElementById('password');
let passwordConfirm = document.getElementById('passwordConfirm');

// mot de passe correspond à regex (pas ok)
password.addEventListener('blur', passwordControl);
passwordConfirm.addEventListener('blur', confirmPasswordControl);

// mots de passe identique (ok)
password.addEventListener('blur', passwordOk);
passwordConfirm.addEventListener('blur', passwordOk);

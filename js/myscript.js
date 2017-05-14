function toggleMenu() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

function checkPassword() {
    if (document.getElementById('password').value ==
        document.getElementById('password_c').value) {
        document.getElementById('password_c').setCustomValidity('');
    } else {
        document.getElementById('password_c').setCustomValidity(
            'Le password devono coincidere');
    }
}

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

function showSubDiv(punto, idDiv) {
    if (punto.value == "altro") {
        document.getElementById(idDiv).style.display = "block";
    } else {
        document.getElementById(idDiv).style.display = "none";
    }
}

function openDiv(divName) {
    var i;
    var x = document.getElementsByClassName("nuovoItinerario");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(divName).style.display = "block";
}

/**
 * Mostra il menù laterale quando viene cliccata l'icona del 'panino'
 */
function toggleMenu() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
/**
 * Controlla che i campi password e conferma password abbiano lo stesso valore,
 * in caso contrario il campo conferma non viene considerato valido.
 */
function checkPassword() {
    if (document.getElementById('passwordRegistra').value ==
        document.getElementById('confermaPasswordRegistra').value) {
        document.getElementById('confermaPasswordRegistra').setCustomValidity('');
    } else {
        document.getElementById('confermaPasswordRegistra').setCustomValidity(
            'Le password devono coincidere');
    }
}
/**
 * Mostra il div con id = 'idDiv' quando il valore del campo 'punto' è uguale ad
 * 'altro'.
 */
function showSubDiv(punto, idDiv, map) {
    if (punto.value == "altro") {
        document.getElementById(idDiv).style.display = "block";
    } else {
        document.getElementById(idDiv).style.display = "none";
    }
    // viene 'ridimensionata' anche la mappa per risolvere problemi legati alle
    // API di Google Maps
    if (map!==undefined){
        google.maps.event.trigger(map, 'resize');
    }
}
/**
 * Mostra il div con id = 'divName' e nasconde tutti gli altri della stessa
 * classe (nuovoItinerario). Viene utilizzata per la form per l'inserimento
 * di un nuovo itinerario che è composta da 3 div.
 */
function showDiv(divName, map) {
    var i;
    var x = document.getElementsByClassName("nuovoItinerario");
    // li nascondo tutti
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    // e mostro quello selezionato
    document.getElementById(divName).style.display = "block";
    if (map!==undefined){
        google.maps.event.trigger(map, 'resize');
    }
}
/**
 * Mostra un campo input per l'upload delle immagini.
 */
function addImageField(id){
    var i = 0;
    var added = false
    var field = document.getElementById(id + i);
    while (field != null && !added) {
        if (field.style.display == 'none'){
            field.style.display = 'block';
            added = true;
        } else {
            field = document.getElementById(id + ++i);
        }
    }
}
/**
 * Chiude la form modale con id = 'id' quando clicco al di fuori di essa.
 */
function addModalListener(id){
    var modal = document.getElementById(id);
    window.addEventListener("click", function(event) {
       if (event.target == modal) {
           modal.style.display = "none";
       }
   }, false);
}

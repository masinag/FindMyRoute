<?php
    /**
     * Effettua la connessione al database con credenziali predefinite
     */
    function db_connect(){
        $conn = mysql_connect("localhost", "root", "");
        mysql_select_db("findMyRoute", $conn);
        mysql_query ("set character_set_client='utf8'");
        mysql_query ("set character_set_results='utf8'");
        mysql_query ("set collation_connection='utf8_general_ci'");
        return $conn;
    }

    /**
     * Permette di stampare dati sulla console di javascript.
     */
    function console_log( $data ){
      echo '<script>';
      echo 'console.log('. json_encode( $data ) .')';
      echo '</script>';
    }
    /**
     * Seleziona un elemento del tag select se era stato scelto nella richiesta
     * post o, altrimenti, se è il primo (i==0).
     */
    function selectValue($fieldName, $value, $i){
        if (isSet($_POST["$fieldName"])) {
            echo ($_POST["$fieldName"]==$value)?"selected='selected' ":"";
        } else {
            echo ($i==0)?"selected='selected' ":"";
        }
    }
    /**
     * Stampa il valore di un campo, leggendolo dalla richiesta POST o dal
     * vettore 'values' passato.
     */
    function printValueText($fieldName, &$values){
        echo getValueText($fieldName, $values);
    }
    /**
     * Restituisce il valore di un campo, leggendolo dalla richiesta POST o dal
     * vettore 'values' passato.
     */
    function getValueText($fieldName, &$values){
        if ($values == null) {
            return isSet($_POST[$fieldName])?$_POST[$fieldName]:"";
        } else {
            return isSet($values[$fieldName])?$values[$fieldName]:"";
        }
    }
    /**
     * Stampa la stringa "value = <valore di un campo>", leggendo quest'ultimo
     * dallo dalla richiesta POST o dal vettore 'values' passato.
     */
    function getValue($fieldName){
        echo isSet($_POST[$fieldName])?"value='".$_POST[$fieldName]."'":"value=''";
    }
    /**
     * Stampa un eventuale errore di un campo ($field) di una risorsa ($resouce)
     * leggendolo dal vettore $errori.
     */
    function getError($resource, $field, &$errori){
        if (isSet($errori) && array_key_exists($resource, $errori) && array_key_exists($field, $errori[$resource])) {
            echo $errori[$resource][$field];
        }
    }
    /**
     * Restituisce il valore della proprietà css 'display' di un div. Se il
     * valore della richiesta POST del campo $field passato vale 'altro'
     * viene stampato 'block', altrimenti 'none'.
     */
    function getDisplay($field){
        echo (isSet($_POST[$field]) && $_POST[$field]=="altro")?"block":"none";
    }

    /**
     * Controlla che i campi appartenenti ad una certa risorsa non siano vuoti.
     * Restituisce il numero di campi vuoti trovati.
     */
    function checkNotEmpty($fields, $resource, &$errori){
        // scorro la lista dei campi
        foreach ($fields as $f) {
            // se il campo è vuoto aggiungo un errore al vettore
            if (trim($_POST[$f.ucfirst($resource)]) == "") {
                $errori[$resource][$f] = "Il campo $f non può essere vuoto";
            }
        }
    }
 ?>

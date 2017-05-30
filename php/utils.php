<?php
    /**
     * Effettua la connessione al database con credenziali predefinite
     */
    function db_connect(){
        $conn = mysql_connect("localhost", "root", "");
        mysql_select_db("itinerariInBicicletta", $conn);
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

    function selectValue($fieldName, $value, $i){
        // echo "-> $fieldName";
        if (isSet($_POST["$fieldName"])) {
            echo ($_POST["$fieldName"]==$value)?"selected='selected' ":"";
        } else {
            echo ($i==0)?"selected='selected' ":"";
        }
    }

    function getValueText($fieldName){
        echo isSet($_POST[$fieldName])?$_POST[$fieldName]:"";
    }
    function getValue($fieldName){
        echo isSet($_POST[$fieldName])?"value='".$_POST[$fieldName]."'":"value=''";
    }
    function getError($resource, $field, &$errori){
        // return "is set \$errori[$resource][$field]? ". array_key_exists($resource, $errori);
        if (isSet($errori) && array_key_exists($resource, $errori) && array_key_exists($field, $errori[$resource])) {
            echo $errori[$resource][$field];
        }
    }

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

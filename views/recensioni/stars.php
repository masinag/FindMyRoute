<?php
    function showStars($number, $enabled, $id){
        // 5 stelle
        for ($i=5; $i > 0; $i--) {
            $enString = $enabled?"":"disabled='disabled'";
            $checkString = ($i==$number)?"checked='checked'":"";
            echo "
                <input class='star star$id-$i' id='star$id-$i' value='$i' type='radio' name='votoRecensione$id' $enString $checkString/>
                <label class='star star$id-$i' for='star$id-$i'></label>";
        }
    }

 ?>

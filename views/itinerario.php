<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Itinerario</title>
        <?php include "head.php" ?>
    </head>
    <body>
        <?php include ROOT_DIR."views/navbar.php" ?>
        <?php
            $conn = connect_db();
         ?>
        <?php include "prova_mappe.php" ?>
    </body>
</html>

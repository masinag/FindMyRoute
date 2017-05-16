<!DOCTYPE html>
<html>
    <head>
        <title>Itinerari</title>
        <?php include "head.php" ?>
    </head>
    <body>
        <?php include ROOT_DIR."views/navbar.php" ?>

        <header class="my-header w3-center">
            <h1>Itinerari</h1>
        </header>

        <section class="w3-container">
            <div class="w3-row">
                <div class="w3-third w3-container w3-green">
                    <h2>w3-third</h2>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxNPdObgBGVgg7PJPj3KihhwnMr30kSzA&callback=initMap"
                        type="text/javascript"></script>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                    <script type="text/javascript">
                      function initialize() {
                        var map = new google.maps.Map(document.getElementById("map_canvas"), {
                          mapTypeId: google.maps.MapTypeId.TERRAIN
                        });

                        $.ajax({
                         type: "GET",
                         url: "/FindMyRoute/files/tracks/2.gpx",
                         dataType: "xml",
                         success: function(xml) {
                           var points = [];
                           var bounds = new google.maps.LatLngBounds ();
                           $(xml).find("trkpt").each(function() {
                             var lat = $(this).attr("lat");
                             var lon = $(this).attr("lon");
                             var p = new google.maps.LatLng(lat, lon);
                             points.push(p);
                             bounds.extend(p);
                           });

                           var poly = new google.maps.Polyline({
                             // use your own style here
                             path: points,
                             strokeColor: "#FF00AA",
                             strokeOpacity: .7,
                             strokeWeight: 4
                           });

                           poly.setMap(map);

                           // fit bounds to track
                           map.fitBounds(bounds);
                         }
                        });
                      }
</script>
                </div>
                <div class="w3-third w3-container">
                    <h2>w3-third</h2>
                </div>
                <div class="w3-third w3-container w3-red">
                    <h2>w3-third</h2>
                </div>
            </div>
        </section>
    </body>
</html>

<?php
    $pluginDir = ROOT_DIR."wp-gpx-maps/"; // wordpress plugin path
    $gpxUrl = ROOT_DIR."files/tracks/$traccia"; // your gpx file
    function load_plugin_textdomain(){}
    function is_admin() {return false;}
    function add_action(){}
    function add_shortcode(){}
    function register_activation_hook(){}
    function register_deactivation_hook(){}
    function add_filter(){}
    function get_option(){return "";}
    function wp_upload_dir(){
        $uploadDir = "/FindMyRoute/uploads";
        return Array ( "basedir" => $uploadDir ); }
    function plugins_url(){
        $uploadUrl = "/FindMyRoute"; // gpx download path
        return $uploadUrl ;}
    function __($val){return $val;}

    include $pluginDir.'wp-gpx-maps.php';
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxNPdObgBGVgg7PJPj3KihhwnMr30kSzA" type="text/javascript"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.9" type="text/javascript" ></script> -->
    <script src="http://code.highcharts.com/highcharts.js" type="text/javascript" ></script>
    <?php include_once $pluginDir."WP-GPX-Maps-js.php" ?>
    <!-- <script src="<?php echo $pluginDir; ?>WP-GPX-Maps.js" type="text/javascript" ></script> -->
    <?php
    echo print_WP_GPX_Maps_styles();
    ?>
    <?php

    /*
    plugin call with all the possible settings
    more info here: http://wordpress.org/extend/plugins/wp-gpx-maps/faq/
    */
    echo handle_WP_GPX_Maps_Shortcodes( Array (
    "gpx"=> $gpxUrl,
    "width"=> "100%",
    "mheight"=> "450px",
    "mtype"=>"HYBRID",
    "gheight"=> "200px",
    "showcad"=>false,
    "showhr"=> false,
    "waypoints"=> false,
    "showspeed"=> false,
    "showgrade"=> false,
    "zoomonscrollwheel"=> false,
    "donotreducegpx"=> false,
    "pointsoffset"=> 10,
    "uom"=>"0",
    "uomspeed"=>"0",
    "mlinecolor"=>"#ff5722",
    "glinecolor"=>"#3366cc",
    "glinecolorspeed"=>"#ff0000",
    "glinecolorhr"=>"#ff77bd",
    "glinecolorcad"=>"#beecff",
    "glinecolorgrade"=>"#beecff",
    "chartfrom1"=>"",
    "chartto1"=>"",
    "chartfrom2"=>"",
    "chartto2"=> "",
    "starticon"=> "",
    "endicon"=> "",
    "currenticon"=> "",
    "waypointicon"=> "",
    "nggalleries"=> "",
    "ngimages"=>"",
    "download"=> "",
    "dtoffset"=> 0,
    "skipcache"=> "",
    "summary"=> "",
    "summarytotlen"=> false,
    "summarymaxele"=> false,
    "summaryminele"=> false,
    "summaryeleup"=>false,
    "summaryeledown"=> false,
    "summaryavgspeed"=> false,
    "summarytotaltime"=>false,
    ) );


    ?>

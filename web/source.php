<?php 

require 'config.php';

function detectDevice(){
  $deviceName="";
  $userAgent = $_SERVER["HTTP_USER_AGENT"];
  $devicesTypes = array(
        "Computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "Tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
        "Mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
        "Bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
    );
  foreach($devicesTypes as $deviceType => $devices) {
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst($deviceName);
  }


  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
         $url = "https://";
    else
         $url = "http://";
    // Append the host(domain name, ip) to the URL.
    $url.= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL
    $url.= $_SERVER['REQUEST_URI'];
    

if(isset($_GET['utm_source']) AND isset($_GET['action']) and isset($_GET['validate'])){
  	$utm_source = $_GET['utm_source'];
    $action = $_GET['action'];
    $validate = $_GET['validate'];

    if($_GET['utm_source'] == "v_card" and $_GET['action'] == "download_app" and $_GET['validate'] == "true"){
        header("location: https://play.google.com/store/apps/details?id=com.gauravsinghigc.u24kharido");
    } else {
        header("location: error.php?type=404");
    }
} else {
	header("location: error.php?type=404");
}
?>
<?php

/***
  AIO (All In One) Config.php File for core php projects or php projects.
		This file contain all basic requirements for projects and it's configuration just include the file and call required function.
		Change have to done only at App configuration and Database configuration if required, else leave others.
		for css and js bootstrap, fontawseome cdn is all ready included in with HEADER_FILES() for css and FOOTER_FILES() for js.for custom css and js create a folder name as assets then in root dir then create css and js folder for custom files their, config file automatically include them at header or footer via header footer function.
		for cdn include the link of cdn in header footer array and that's it.
 */

//Display Errors
ini_set("display_errors", 1);

//session_start()
session_start();

//Change configuration according to your need and project requirements
//define
define("ROOT", __DIR__ . "/");
define("DOMAIN", "http://localhost/projects/ProjectCost");

//App Configurations
$APP_NAME = "GSIProjects";
$TAGLINE = "";
$OWNER_NAME = "Gaurav Singh";
$DOMAIN = constant("DOMAIN");
$APP_DOMAIN = $DOMAIN . "";
$ADMIN_DOMAIN = $DOMAIN . "/admin";
$APP_LOGO = "";
$DIR_IMG = $DOMAIN . "/storage/images";
$APP_PHONE = "8447572565";
$APP_MAIL_ID = "gauravsinghigc@gmail.com";
$SENDER_MAIL = "gauravsinghigc@gmail.com";
$RECEIVER_MAIL = "gauravsinghigc@gmail.com";
$SMS_KEY = "6Ul0SAiTKpMxXh5ZCoWtBQcgmEkr1HaLRvDIFqbwnsY8j2fdNPvkUBD0wA4ueVdYs6qW5c2JoC3jLgK9";
$STORE_ADDRESS = "Y6/37-SF Sector 76, Greater Faridabad Haryana 121004";
$MAP_LINK = "https://g.page/gauravsinghigc?share";
$DOWNLOAD_LINK = "https://play.google.com/store/apps/details?id=com.gauravsinghigc.gauravsinghigc&hl=en_IN&gl=US";
$CREATED_BY = "Gauravsinghigc";
$DEV_URL = "http://gauravsinghigc.in";
$APP_VERSION = "1.0";
$WORK_ENV = "dev";
$LOGS_STATUS = "INACTIVE";
$Time = 2000;

//database
$Host = "localhost";
$User = "root";
$Pass = "";
$DataBase = "gauravsinghigcoffice";
$ALLOWDB = "true";

if ($ALLOWDB == "true") {
  $con = mysqli_connect($Host, $User, $Pass, $DataBase);
  $DBConnection = $con;

  if ($DBConnection == true) {
    $DBStatus = "<i class='fa fa-check-circle text-success'></i> Online";
  } else {
    $DBStatus = "<i class='fa fa-warning text-danger'></i> Offline";
  }
} else {
  $DBStatus = "<i class='fa fa-times text-warning'></i> DB Not Used!";
}

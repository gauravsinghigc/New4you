<?php
include 'config.php';
ini_set("display_errors", 1);

$SQL_web_tools = "SELECT * FROM web_tools where NAME='APP_NAME'";
$QUERY_web_tools = mysqli_query($con, $SQL_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$StoreName = $FETCH_web_tools['VALUE'];
$PosName = "$StoreName";
$SQL_web_tools = "SELECT * FROM web_tools where NAME='DOMAIN'";
$QUERY_web_tools = mysqli_query($con, $SQL_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$ADMIN_URL = $FETCH_web_tools['VALUE'];
$MDomain = $ADMIN_URL;
$Domain = "$MDomain/admin";
$AppAssets = $Domain . "/app-assets";
$Images = $AppAssets . "/images";
$Logo = $Images . "/logo/logo.png";
$img_url = $Domain . "/img";
$sms_api = "";
$CopyRight = "Copyrighted by $StoreName";
$UserImg = "$MDomain/img/user_img";

$CR_PAGE = basename($_SERVER['PHP_SELF']);

<?php
include 'config.php';
$sql_web_tools = "SELECT * FROM web_tools where NAME='DOMAIN'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$MUrl = $FETCH_web_tools['VALUE'];

$sql_web_tools = "SELECT * FROM web_tools where NAME='APP_NAME'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$APP_NAME = $FETCH_web_tools['VALUE'];
$AppNameWithExt = $APP_NAME . ".in";

$sql_web_tools = "SELECT * FROM web_tools where NAME='APP_TAGLINE'";
$QUERY_web_tools = mysqli_query($con, $sql_web_tools);
$FETCH_web_tools = mysqli_fetch_assoc($QUERY_web_tools);
$AppTag = $FETCH_web_tools['VALUE'];


$ThemeColor = "background-image: linear-gradient(#f1fff0, #1bff000f) !important;";
$store_id = "1";
$sql = "SELECT * from stores, users where stores.user_id=users.user_id and stores.store_id='$store_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_id = $fetch['store_id'];
$user_id = $fetch['user_id'];
$store_name = $fetch['store_name'];
$full_name = $fetch['full_name'];
$store_phone = $fetch['store_phone'];
$store_add_date = $fetch['store_add_date'];
$store_status = $fetch['store_status'];
$store_profile_img = $fetch['store_profile_img'];
$logo = "$MUrl/admin/$store_profile_img";
$LogoRec = $logo;
$store_desc = $fetch['store_description'];
$store_address = $fetch['store_address'];
$store_mail_id = $fetch['store_mail_id'];
$store_arealocality = $fetch['store_arealocality'];
$store_city = $fetch['store_city'];
$store_state = $fetch['store_state'];
$store_pincode = $fetch['store_pincode'];

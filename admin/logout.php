<?php
session_start();
session_destroy();
if (isset($_GET['n'])) {
  $n = $_GET['n'];
} else {
  $n = "";
}

header("location: login.php?t=info&m=Logout&a=$n Logout Successfully!");

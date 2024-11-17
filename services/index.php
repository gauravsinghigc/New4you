<?php
require 'require/config.php';
require 'require/common.php';
require 'data/tags.php';
require 'data/pagevariables.php';
require 'require/modules.php';

if (isset($_SESSION['LOGIN_USER'])) {
 header("location: admin/");
} else {
 header("location: auth/");
}

<?php
session_start();
require 'config.php';
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * from customer_cart where customer_id='$customer_id'";
    $query = mysqli_query($con, $sql);
    $count_cart = mysqli_num_rows($query);
 if($count_cart == 0){
    echo "";
 } else {
    $data = array('CountNo' => $count_cart);
    echo json_encode($data);
 }
} else {
} ?>
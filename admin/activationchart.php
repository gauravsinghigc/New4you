<?php
$month = date("M");
$month_1 = date("M", strtotime("-1 Month"));
$month_2 = date("M", strtotime("-2 Month"));
$month_3 = date("M", strtotime("-3 Month"));
$month_4 = date("M", strtotime("-4 Month"));
$month_5 = date("M", strtotime("-5 Month"));

$CURRENTYEAR = date("Y");

$user_role = $_SESSION['user_role'];

$user_id = $_SESSION['user_id'];

if ($user_role == "SUPER_ADMIN") {

  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month' and store_add_year='$CURRENTYEAR'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_1 = "0";
    } else {
      $month_amount_1 = $total_amount_1;
    }
  }
} elseif ($user_role == "TEAM_LEADER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month' and store_add_year='$CURRENTYEAR' and upper_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_1 = "0";
    } else {
      $month_amount_1 = $total_amount_1;
    }
  }
} elseif ($user_role == "EMPLOYEE") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_1 = "0";
    } else {
      $month_amount_1 = $total_amount_1;
    }
  }
} elseif ($user_role == "INFLUENCER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_1 = "0";
    } else {
      $month_amount_1 = $total_amount_1;
    }
  }
}


/////////////////////////////////////2nd
if ($user_role == "SUPER_ADMIN") {

  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_1' and store_add_year='$CURRENTYEAR'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_2 = "0";
    } else {
      $month_amount_2 = $total_amount_1;
    }
  }
} elseif ($user_role == "TEAM_LEADER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_1' and store_add_year='$CURRENTYEAR' and upper_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_2 = "0";
    } else {
      $month_amount_2 = $total_amount_1;
    }
  }
} elseif ($user_role == "EMPLOYEE") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_1' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_2 = "0";
    } else {
      $month_amount_2 = $total_amount_1;
    }
  }
} elseif ($user_role == "INFLUENCER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_1' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_2 = "0";
    } else {
      $month_amount_2 = $total_amount_1;
    }
  }
}
/////////////////////////////////////////////3rd month
if ($user_role == "SUPER_ADMIN") {

  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_2' and store_add_year='$CURRENTYEAR'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_3 = "0";
    } else {
      $month_amount_3 = $total_amount_1;
    }
  }
} elseif ($user_role == "TEAM_LEADER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_2' and store_add_year='$CURRENTYEAR' and upper_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_3 = "0";
    } else {
      $month_amount_3 = $total_amount_1;
    }
  }
} elseif ($user_role == "EMPLOYEE") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_2' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_3 = "0";
    } else {
      $month_amount_3 = $total_amount_1;
    }
  }
} elseif ($user_role == "INFLUENCER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_2' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_3 = "0";
    } else {
      $month_amount_3 = $total_amount_1;
    }
  }
}

//////////////////////////////////4th month
if ($user_role == "SUPER_ADMIN") {

  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_3' and store_add_year='$CURRENTYEAR'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_4 = "0";
    } else {
      $month_amount_4 = $total_amount_1;
    }
  }
} elseif ($user_role == "TEAM_LEADER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_3' and store_add_year='$CURRENTYEAR' and upper_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_4 = "0";
    } else {
      $month_amount_4 = $total_amount_1;
    }
  }
} elseif ($user_role == "EMPLOYEE") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_3' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_4 = "0";
    } else {
      $month_amount_4 = $total_amount_1;
    }
  }
} elseif ($user_role == "INFLUENCER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_3' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_4 = "0";
    } else {
      $month_amount_4 = $total_amount_1;
    }
  }
}
/////////////////////////////////5th month
if ($user_role == "SUPER_ADMIN") {

  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_4' and store_add_year='$CURRENTYEAR'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_5 = "0";
    } else {
      $month_amount_5 = $total_amount_1;
    }
  }
} elseif ($user_role == "TEAM_LEADER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_4' and store_add_year='$CURRENTYEAR' and upper_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_5 = "0";
    } else {
      $month_amount_5 = $total_amount_1;
    }
  }
} elseif ($user_role == "EMPLOYEE") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_4' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_5 = "0";
    } else {
      $month_amount_5 = $total_amount_1;
    }
  }
} elseif ($user_role == "INFLUENCER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_4' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_5 = "0";
    } else {
      $month_amount_5 = $total_amount_1;
    }
  }
}
//////////////////////////////////////////////////6th month
if ($user_role == "SUPER_ADMIN") {

  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_5' and store_add_year='$CURRENTYEAR'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_6 = "0";
    } else {
      $month_amount_6 = $total_amount_1;
    }
  }
} elseif ($user_role == "TEAM_LEADER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_5' and store_add_year='$CURRENTYEAR' and upper_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_6 = "0";
    } else {
      $month_amount_6 = $total_amount_1;
    }
  }
} elseif ($user_role == "EMPLOYEE") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_5' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_6 = "0";
    } else {
      $month_amount_6 = $total_amount_1;
    }
  }
} elseif ($user_role == "INFLUENCER") {
  $sql = "SELECT sum(store_activation_fee) FROM stores where activation_fee_status='ACTIVATED' and store_add_month='$month_5' and store_add_year='$CURRENTYEAR' and store_ref_id='$user_id'";
  $query = mysqli_query($con, $sql);
  while ($record = mysqli_fetch_array($query)) {
    $total_amount_1 = $record['sum(store_activation_fee)'];
    if ($total_amount_1 == 0) {
      $month_amount_6 = "0";
    } else {
      $month_amount_6 = $total_amount_1;
    }
  }
}
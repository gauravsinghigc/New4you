<?php

$day = date("D");
$day_1 = date("D", strtotime("-1 Days"));
$day_2 = date("D", strtotime("-2 Days"));
$day_3 = date("D", strtotime("-3 Days"));
$day_4 = date("D", strtotime("-4 Days"));
$day_5 = date("D", strtotime("-5 Days"));
$day_6 = date("D", strtotime("-6 Days"));


$date = date("d");
$date_1 = date("d", strtotime("-1 Days"));
$date_2 = date("d", strtotime("-2 Days"));
$date_3 = date("d", strtotime("-3 Days"));
$date_4 = date("d", strtotime("-4 Days"));
$date_5 = date("d", strtotime("-5 Days"));
$date_6 = date("d", strtotime("-6 Days"));
$CURRENTYEAR = date("Y");
$CURRENTMONTH = date("M");

$user_role = $_SESSION['user_role'];

if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date' and tasks_month='$cm' and tasks_year='$CURRENTYEAR'  ";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_1 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id' and tasks_status!=null and tasks_feedback!=null and tasks_followupdate!=null";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_1 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_1 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day' and taska_datetime='$date'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_1 = mysqli_num_rows($query);
}

if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_2 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1' and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_2 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1'  and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_2 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1'  and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$cm' and tasks_year='$cy' and tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_1' and taska_datetime='$date_1'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_2 = mysqli_num_rows($query);
}

/////////////////////////////////////
///////day3
////////////////////////////////////

if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2' and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_3 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_2' and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_3 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_2' and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_2' and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_3 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_2'  and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_2' and taska_datetime='$date_2'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_2' and taska_datetime='$date_2'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_3 = mysqli_num_rows($query);
}


////////////////////////////////////////////////
///////////////$day_4//////////////////////////
/////////////////////////////////////////
if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_4 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3'  and taska_datetime='$date_3' and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_4 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_4 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_3' and taska_datetime='$date_3'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_4 = mysqli_num_rows($query);
}


/////////////////////////////////////////////////////
///////////////////////$day_5
////////////////////////////////////////////////////////

if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4' and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4' and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_4' and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_4' and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_5 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4' and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4' and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_4' and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_5 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_5 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_4'  and taska_datetime='$date_4'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_5 = mysqli_num_rows($query);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////$day_6
//////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_5' and taska_datetime='$date_5' and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_6 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_6 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_6 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_5'  and taska_datetime='$date_5'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_6 = mysqli_num_rows($query);
}

////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////day7
////////////////////////////////////////////////
if ($user_role == "SUPER_ADMIN") {
  if (isset($_GET['cy'])) {
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$cy'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_7 = mysqli_num_rows($query);
} elseif ($user_role == "TEAM_LEADER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_7 = mysqli_num_rows($query);
} elseif ($user_role == "EMPLOYEE") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_7 = mysqli_num_rows($query);
} elseif ($user_role == "INFLUENCER") {
  $user_id = $_SESSION['user_id'];
  if (isset($_GET['cy'])) {
    global $con;
    $CURRENTMONTH = date("M");
    $CURRENTYEAR = date("Y");
    $cy = $_GET['cy'];
    $cm = $_GET['cm'];
    if ($cy == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$CURRENTYEAR' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm == null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    } elseif ($cm != null and $cy != null) {
      $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$cm' and tasks_year='$cy' and tasks_assign_id='$user_id' or tasks_executer_id='$user_id'";
    }
  } else {
    $sql = "SELECT * from taska where tasks_day='$day_6'  and taska_datetime='$date_6'  and tasks_month='$CURRENTMONTH' and tasks_year='$CURRENTYEAR' and tasks_executer_id='$user_id'";
  }
  $query = mysqli_query($con, $sql);
  $count_calls_7 = mysqli_num_rows($query);
}
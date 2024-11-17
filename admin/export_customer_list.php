<head>
  <title><?php echo $_GET['CUSTOMER_TYPE']; ?>_<?php echo $_GET['CUSTOMER_AREA']; ?>_<?php echo $_GET['CUSTOMER_CITIES']; ?>_<?php echo $_GET['CUSTOMER_STATE']; ?>_<?php echo $_GET['REG_DATE']; ?>_<?php echo date("D_d_M_Y_h_m_a"); ?></title>
</head>


<style type="text/css">
  @import url('https://fonts.googleapis.com/css2?family=Commissioner&display=swap');

  html,
  body,
  table,
  tr,
  th,
  td,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  p,
  span,
  div,
  section {
    font-family: 'Commissioner', sans-serif !important;
    font-size: 11px !important;
  }

  @media print {
    #main {
      position: relative;
      padding: 0;
      height: 1px;
      overflow: visible;
    }

    #printarea {
      position: absolute;
      width: 100%;
      top: 0;
      padding: 0;
      margin: -1px;
    }
  }

  @page {
    size: 5.5in 8.5in;
  }

  @page {
    size: A4 portrait;
  }

  @page :blank {
    @top-center {
      content: "This page is intentionally left blank."
    }
  }

  @page: right {
    @bottom-left {
      margin: 10pt 0 30pt 0;
      border-top: .25pt solid #666;
      content: "My book";
      font-size: 9pt;
      color: #333;
    }
  }

  table,
  figure {
    page-break-inside: avoid;
  }

  @page: right {
    @bottom-right {
      content: counter(page);
    }
  }

  @page: left {
    @bottom-left {
      content: counter(page);
    }
  }

  @page: left {
    @bottom-left {
      content: "Page "counter(page) " of "counter(pages);
    }
  }
</style>
<?php
session_start();
require 'config.php';
require 'text.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM stores where user_id='$user_id'";
$query = mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_id = "1";

$sql = "SELECT * from stores where store_id='$store_id'";
$query =  mysqli_query($con, $sql);
$fetch = mysqli_fetch_assoc($query);
$store_name = $fetch['store_name'];
$store_phone = $fetch['store_phone'];
$store_mail_id = $fetch['store_mail_id'];
$store_description = $fetch['store_description'];
$store_address = $fetch['store_address'];
$store_arealocality = $fetch['store_arealocality'];
$store_city = $fetch['store_city'];
$store_state = $fetch['store_state'];
$store_pincode = $fetch['store_pincode'];
$activation_fee_status = $fetch['activation_fee_status'];
$store_user_id = $fetch['user_id'];
$user_view_id = $store_user_id;
$store_gst = $fetch['GST'];
$store_pan = $fetch['PAN'];
$store_profile_img = $fetch['store_profile_img'];
?>

<body style="width:21cm; margin-left:auto; margin-right:auto;height:auto;">
  <center>
    <button onclick="window.print()"> Save & Print</button>
  </center> <br>
  <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
    <tr>
      <td style="width: 150px;">
        <img src="<?php echo $store_profile_img; ?>" style="width: 100%;">
      </td>
      <td>
        <p style="font-size: 12px !important;"><span style="font-size: 14px !important;"><b><?php echo $store_name; ?></b></span><br>
          Address :
          <?php echo "$store_address, $store_arealocality, $store_city, $store_state - $store_pincode"; ?><br>
          Phone : <?php echo $store_phone; ?> <br>
          Mail ID : <?php echo $store_mail_id; ?><br>
          GST : <?php echo $store_gst; ?> <br>
          PAN : <?php echo $store_pan; ?>
        </p>
      </td>
      <td>
        <p>
          <b>FILTERED BY:</b> <br>
          <?php
          if (isset($_GET['REG_DATE'])) {
            if ($_GET['REG_DATE'] == null or $_GET['REG_DATE'] == "ALL_DATES") {
              $REG_DATE = "";
            } else {
              $RequiredDate = $_GET['REG_DATE'];
              $REG_DATE = date("d M Y", strtotime($RequiredDate));
            }
          }
          $CUSTOMER_TYPE = $_GET['CUSTOMER_TYPE'];
          $CUSTOMER_STATE = $_GET['CUSTOMER_STATE'];
          $CUSTOMER_CITIES = $_GET['CUSTOMER_CITIES'];
          $CUSTOMER_AREA = $_GET['CUSTOMER_AREA'];

          echo  "<b>Customer Type :</b> $CUSTOMER_TYPE <br>
  <b>Customer State :</b> $CUSTOMER_STATE<br>
  <b>Customer City :</b>  $CUSTOMER_CITIES<br>
  <b>Customer Area :</b> $CUSTOMER_AREA<br>
  <b>Registered Date :</b> $REG_DATE</p>"; ?>
      </td>
    </tr>
  </table>
  <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;">
    <tr>
      <th>
        <h2 style="font-size: 13px !important;margin-bottom: 0px;">Customer Reports @ <?php echo date("D d M, Y"); ?></h2>
      </th>
    </tr>
  </table>
  <?php
  if (isset($_GET['EXPORT_CUSTOMERS'])) {
    $CUSTOMER_TYPE = $_GET['CUSTOMER_TYPE'];
    $CUSTOMER_STATE = $_GET['CUSTOMER_STATE'];
    $CUSTOMER_CITIES = $_GET['CUSTOMER_CITIES'];
    $CUSTOMER_AREA = $_GET['CUSTOMER_AREA'];
  } else {
    header("location: export_customers.php?msg=Please Select valid Data for customer reports");
  } ?>

  <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 12px;text-align:left !important;">
    <thead>
      <tr>
        <th style="width: 2% !important;">#</th>
        <th style="width: 18% !important;">Name & ID</th>
        <th style="width: 12% !important;">Phone Number</th>
        <th style="width: 23% !important;">Email ID</th>
        <th style="width: 40% !important;">Address</th>
        <th style="width: 5% !important;">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php

      if ($_GET['CUSTOMER_TYPE'] == "ALL_TYPES") {
        $CUSTOMER_TYPE = "";
      } else {
        $CUSTOMER_TYPE = $_GET['CUSTOMER_TYPE'];
      }

      if ($_GET['CUSTOMER_STATE'] == "ALL_STATE") {
        $CUSTOMER_STATE = "";
      } else {
        $CUSTOMER_STATE = $_GET['CUSTOMER_STATE'];
      }

      if ($_GET['CUSTOMER_CITIES'] == "ALL_CITIES") {
        $CUSTOMER_CITIES = "";
      } else {
        $CUSTOMER_CITIES = $_GET['CUSTOMER_CITIES'];
      }

      if ($_GET['CUSTOMER_AREA'] == "ALL_AREAS") {
        $CUSTOMER_AREA = "";
      } else {
        $CUSTOMER_AREA = $_GET['CUSTOMER_AREA'];
      }

      if ($_GET['CUSTOMER_TYPE'] == "ALL_TYPES" and $_GET['CUSTOMER_STATE'] == "ALL_STATE" and $_GET['CUSTOMER_CITIES'] == "ALL_CITIES" and $_GET['CUSTOMER_AREA'] == "ALL_AREAS") {
        $sql = "SELECT * FROM customers where customer_reg_date like '%$REG_DATE%'";
      } else {
        $sql = "SELECT * FROM customers where customer_reg_date like '%$REG_DATE%'";
      }

      $query = mysqli_query($con, $sql);
      $CountCustomer = mysqli_num_rows($query);
      if ($CountCustomer == 0) {
        echo "<tr>
      <td colspan='6' align='center'><h4 style='font-size:14px !important;'>No Customers Found!</h4></td>
      </tr>";
      } else {
        while ($fetch = mysqli_fetch_assoc($query)) {
          $customer_id = $fetch['customer_id'];
          $customer_name = $fetch['customer_name'];
          $customer_mail_id = $fetch['customer_mail_id'];
          $customer_phone_number = $fetch['customer_phone_number'];
          $arealocality = $fetch['arealocality'];
          $custaddress = $fetch['custaddress'];
          $custcity = $fetch['custcity'];
          $custstate = $fetch['custstate'];
          $custpincode = $fetch['custpincode'];
          $contactperson = $fetch['contactperson'];
          $alternatenumber = $fetch['alternatenumber'];
          $customer_status = $fetch['customer_status'];
          $customer_image = $fetch['customer_image'];

          echo "<tr align='left'>
        <td><img src='$UserImg/$customer_image' style='width:12px;'></td>
        <td>(ID$customer_id)<br> $customer_name</td>
        <td>$customer_phone_number</td>
        <td>$customer_mail_id</td>
        <td>$custaddress $arealocality $custcity $custstate $custpincode</td>
        <td>$customer_status</td>
       </tr>";
        }
      }

      ?>
    </tbody>
  </table>
</body>
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

table tr td {
 padding: 1%;
 box-shadow: 0px 1px 0px 0px grey;
}
</style>
<?php
require 'config.php';
$user_id = "1";
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
  <button onclick="printPageArea('printableArea')"> Save & Print</button>
 </center> <br>

 <head>
  <title> <?php
            $product_cat_id = $_GET['product_cat_id'];
            if ($_GET['product_cat_id'] == "ALL") {
              $SheetType = "All Items";
            } else {
              $sql = "SELECT * FROM product_categories where product_cat_id='$product_cat_id'";
              $query = mysqli_query($con, $sql);
              $fetch = mysqli_fetch_assoc($query);
              $SheetType = $fetch['product_cat_title'];
            } ?> <?php echo $SheetType; ?> - Stock Price Chart @ <?php echo date("D d M, Y"); ?> </title>
 </head>
 <div id="printableArea">
  <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 18px;">
   <tr>
    <td style="width:20%;">
     <img src="<?php echo $store_profile_img; ?>" style="width: 100%;">
    </td>
    <td>
     <p><span style="font-size: 20px;"><b><?php echo $store_name; ?></b></span><br>
      Address: <?php echo "$store_address, $store_arealocality, $store_city, $store_state - $store_pincode"; ?><br>
      Phone : <?php echo $store_phone; ?> <br>
      Mail ID: <?php echo $store_mail_id; ?><br>
      GST : <?php echo $store_gst; ?> <br>
      PAN : <?php echo $store_pan; ?>
     </p>
    </td>
   </tr>
  </table>
  <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 18px;">
   <tr>
    <th> <?php echo $SheetType; ?> <?php if ($_GET['pro_status'] == null or $_GET['pro_status'] == "ALL") {
                                        echo " - ";
                                      } else {
                                        echo " - ";
                                        echo $_GET['pro_status'] . " - ";
                                      } ?> Stock Price Chart - <?php echo date("D d M, Y"); ?></th>
   </tr>
  </table>
  <table style="width: 100%; box-shadow: 0px 0px 1px grey;font-size: 18px;">
   <tr align="left">
    <th style="width: 8%;">S.no</th>
    <th style="width: 10%;">Image</th>
    <th style="width: 32%;">Item Name</th>
    <th style="width: 25%;">Market Price</th>
    <th style="width: 25%;">Our Price</th>
   </tr>
  </table>
  <?php
    mysqli_set_charset($con, 'utf8');
    $product_cat_id = $_GET['product_cat_id'];
    $pro_status = $_GET['pro_status'];

    if ($product_cat_id == "ALL") {
      $product_cat_id = "";
    } else {
      $product_cat_id = $product_cat_id;
    }

    if ($pro_status == "ALL") {
      $pro_status = "";
    } else {
      $pro_status = $pro_status;
    }

    if ($_GET['product_cat_id'] == "ALL" and $_GET['pro_status'] == "ALL") {
      $sql = "SELECT * FROM user_products";
    } elseif ($_GET['pro_status'] == null) {
      $sql = "SELECT * from user_products where product_cat_id like '%$product_cat_id%'";
    } elseif ($_GET['pro_status'] != null and $_GET['product_cat_id'] == "ALL") {
      $sql = "SELECT * from user_products where product_cat_id like '%$product_cat_id%' and product_status='$pro_status'";
    } else {
      $sql = "SELECT * from user_products where product_cat_id like '%$product_cat_id%' and product_status='$pro_status'";
    }

    $query = mysqli_query($con, $sql);
    $counItems = mysqli_num_rows($query);
    if ($counItems == 0) {
      echo "<tr>
  <td colspan='5'><h2 align='center'>No Items Found!</h2></td>
  </tr>";
    }
    $count = 0;
    while ($fetch = mysqli_fetch_assoc($query)) {
      $product_title = $fetch['product_title'];
      $product_img = $fetch['product_img'];
      $hindi_name = $fetch['hindi_name'];
      $product_offer_price = $fetch['product_offer_price'];
      $product_mrp_price = $fetch['product_mrp_price'];
      $product_tags = $fetch['product_tags'];
      $approx_weight = $fetch['approx_weight'];
      $count++;
      echo "
  <div style='display:inline-block; width:100%;'>
  <table style='width: 100%; box-shadow: 0px 0px 1px grey;font-size: 13px;'>
    <tr>
       <td style='width: 8%;'>$count</td>
       <td style='width: 10%;'><img src='img/store_img/pro_img/$product_img' style='width:30px;'></td>
       <td style='width: 32%;'><b style='font-size:13px;'>$product_title <br> $hindi_name</b></td>
       <td style='width: 25%;'><b style='font-size:13px;'>Rs.$product_mrp_price / $product_tags</b>
       <br>$approx_weight</td>
       <td style='width: 25%;'><b style='font-size:13px;'>Rs.$product_offer_price / $product_tags</b>
       <br>$approx_weight</td>
    </tr>
    </table>
</div>
  ";
    }
    ?>
 </div>
 <script type="text/javascript">
 function printPageArea(areaid) {
  var printContent = document.getElementById(areaid);
  var WinPrint = window.open('', '', 'width=1200,height=650');
  WinPrint.document.write(printContent.innerHTML);
  WinPrint.document.close();
  WinPrint.focus();
  WinPrint.print();
  WinPrint.close();
 }
 </script>
</body>
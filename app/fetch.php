<?php

function GSI_Select_Options($SQL, $CL, $VALUE)
{
  global $con;
  $Select  = "$SQL";
  $query = mysqli_query($con, $Select);
  if ($query == true) {
    while ($fetch = mysqli_fetch_assoc($query)) {
      $CL_NAME = $fetch["$CL"];
      $CL_VALUE = $fetch["$VALUE"];
      echo "<option value='$CL_VALUE'>$CL_NAME</option>";
    }
  } else {
    echo "<option value='null'>Null Values</option>";
  }
}

function CDATA($data)
{
  global $con;
  if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $sql = "SELECT * FROM customers where customer_id='$customer_id'";
    $query = mysqli_query($con, $sql);
    $fetch =  mysqli_fetch_assoc($query);
    $Data = $fetch["$data"];
    echo $Data;
  } else {
  }
}

function SDATA($data)
{
  global $con;
  $sql = "SELECT * FROM stores where store_id='1'";
  $query = mysqli_query($con, $sql);
  $fetch =  mysqli_fetch_assoc($query);
  $Data = $fetch["$data"];
  echo $Data;
}

function CreateSlider($Type)
{
  global $con;
  global $MUrl;
  echo '<div class="container-fluid mt-3">
          <div class="row" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 1%;
    padding-right: 1%;">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">';
  $sql = "SELECT * FROM slider where slider_type='$Type'";
  $query = mysqli_query($con, $sql);
  $CountSliders = mysqli_num_rows($query);
  $TargetNumbers = 0;
  while ($TargetNumbers < $CountSliders) { ?>
    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $TargetNumbers; ?>" <?php if ($TargetNumbers == 0) {
                                                                                                  echo "class='active'";
                                                                                                } else {
                                                                                                  echo "";
                                                                                                } ?>></li>
  <?php $TargetNumbers++;
  } ?>
  </ol>
  <div class="carousel-inner">
    <?php
    $sql = "SELECT * FROM slider where slider_type='$Type' ORDER BY sortby ASC";
    $query = mysqli_query($con, $sql);
    $CountSlides = 0;
    while ($fetch = mysqli_fetch_assoc($query)) {
      $slider_img = $fetch["slider_img"];
      $target_url = $fetch["target_url"];
      $slider_title = $fetch["slider_title"];
      if ($target_url == "No Url Required") {
        $target_url = "";
      } else {
        $target_url = "href='$target_url'";
      }
    ?>
      <div class="carousel-item <?php if ($CountSlides == 0) {
                                  echo "active";
                                } else {
                                  echo "";
                                } ?>">
        <a <?php echo $target_url; ?>>
          <img class="d-block w-100" src="<?php echo $MUrl; ?>admin/img/store_img/slider/<?php echo $slider_img; ?>" alt="<?php echo $slider_title; ?>" style="width:100%;">
        </a>
      </div>
    <?php $CountSlides++;
    } ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  </div>
  </div>
  </div>
  </div>
<?php }


?>
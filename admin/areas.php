<?php
require 'files.php';
require 'session.php';
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title>Service Areas : <?php echo $PosName; ?></title>
 <?php include 'header_files.php'; ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click"
 data-menu="vertical-menu-modern" data-col="2-columns">

 <?php require 'header.php'; ?>
 <?php require 'sidebar.php'; ?>

 <!-- BEGIN: Content-->
 <div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
   <div class="content-header row">
    <div class="col-lg-12 card-content">
     <?php notification(); ?>
    </div>
   </div>

   <div class="content-body">
    <!-- users list start -->
    <section class="users-list-wrapper">
     <div class="users-list-table">
      <div class="card">
       <div class="card-header">
        <h4 class="users-action"><i class="fa fa-map-marker text-info"></i> Service Areas <i
          class="fa fa-angle-right"></i>
         <?php
                  if (isset($_GET['area'])) {
                    $Fcityid = $_GET['area'];
                    $SelectCity = "SELECT * FROM city where city_id='$Fcityid'";
                    $FCityQuery = mysqli_query($con, $SelectCity);
                    $FCityFetch = mysqli_fetch_assoc($FCityQuery);
                    $FCityName = $FCityFetch['city_name'];
                    echo "$FCityName <i class='fa fa-angle-right'></i>";
                  } else {
                    echo "";
                  } ?>
         <a href="add_area.php" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add Areas</a>
         <a href="cities.php" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> View Cities</a>
         <a href="states.php" class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> View States</a>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <!-- datatable start -->
         <div class="table-responsive">
          <table class="table table-striped zero-configuration" style="padding: 1%; font-size: 12px;">
           <thead>
            <tr>
             <th style="width: 5% !important;">#</th>
             <th style="width: 15% !important;">State Name</th>
             <th style="width: 20% !important;">City Name</th>
             <th style="width: 20% !important;">Area Name</th>
             <th style="width: 10% !important;">Customers</th>
             <th style="width: 15% !important;">Add Date</th>
             <th style="width: 15% !important;">Action</th>
            </tr>
           </thead>

           <tbody>
            <?php
                        if (isset($_GET['area'])) {
                          $CityView = $_GET['area'];
                          $SelectArea = "SELECT * FROM services_area, city, state where services_area.city_id=city.city_id and services_area.city_id='$CityView' and state.state_name=city.state_name ORDER BY area_id DESC";
                        } else {
                          $SelectArea = "SELECT * FROM services_area, city, state where services_area.city_id=city.city_id and state.state_name=city.state_name ORDER BY area_id DESC";
                        }
                        $AreaQuery = mysqli_query($con, $SelectArea);
                        $CountAreas = mysqli_num_rows($AreaQuery);
                        if ($CountAreas != 0) {
                          $CountAreas = 0;
                          while ($FetchArea = mysqli_fetch_assoc($AreaQuery)) {
                            $area_id = $FetchArea['area_id'];
                            $area_locality = $FetchArea['area_locality'];
                            $area_status = $FetchArea['area_status'];
                            $city_name = $FetchArea['city_name'];
                            $state_name = $FetchArea['state_name'];
                            $area_add_date = date("D d M, Y", strtotime($FetchArea['area_add_date']));
                            if ($area_status == "active") {
                              $area_statuss = "<i class='fa fa-check-circle text-success'></i> Active";
                              $btn_type = "btn-success";
                            } else {
                              $area_statuss = "<i class='fa fa-warning text-danger'></i> Inactive";
                              $btn_type = "btn-danger";
                            }
                            $CountAreas++; ?>

            <tr>
             <form action="update.php" method="POST">
              <td><?php echo $CountAreas; ?></td>
              <td>
               <select class="form-control d-input" name="state_name">
                <option value="<?php echo $state_name; ?>"><?php echo $state_name; ?></option>
                <?php
                                    $FetchState = "SELECT * FROM state where state_status='active' and state_name!='$state_name'";
                                    $StateWuery = mysqli_query($con, $FetchState);
                                    while ($FetchState = mysqli_fetch_assoc($StateWuery)) {
                                      $fstate = $FetchState['state_name'];
                                      echo "<option value='$fstate'>$fstate</option>";
                                    } ?>
               </select>
              </td>
              <td>
               <select class="form-control d-input" name="city_id">
                <option value="<?php echo $FetchArea['city_id']; ?>"><?php echo $city_name; ?></option>
                <?php
                                    $FetchCity = "SELECT * FROM city where city_status='active' and state_name='" . $FetchArea['state_name'] . "' and city_id!='" . $FetchArea['city_id'] . "'";
                                    $CityQuery = mysqli_query($con, $FetchCity);
                                    while ($fetchCity = mysqli_fetch_assoc($CityQuery)) {
                                      echo "<option value='" . $fetchCity['city_id'] . "'>" . $fetchCity['city_name'] . "</option>";
                                    } ?>
               </select>
              </td>
              <td>
               <input type="text" name="area_locality" value="<?php echo $area_locality; ?>"
                class="form-control d-input" required="">
              </td>
              <td align="center"><?php
                                                    $SelectCustomers  = "SELECT * FROM customers where arealocality like '%$area_locality%'";
                                                    $CustomerQuery = mysqli_query($con, $SelectCustomers);
                                                    $CountCustomers = mysqli_num_rows($CustomerQuery);
                                                    if ($CountCustomers == 0) {
                                                      echo "0";
                                                      $btnst = "";
                                                    } else {
                                                      echo $CountCustomers;
                                                      $btnst = "disabled";
                                                    } ?></td>
              <td><?php echo $area_add_date; ?></td>
              <td>
               <a href='update.php?update_area=<?php echo $area_id; ?>&status=<?php echo $area_status; ?>'
                class='btn btn-sm <?php echo $btn_type; ?> uppercase'><?php echo $area_status; ?></a>
               <button type="submit" name="UpdateArea" value="<?php echo $area_id; ?>"
                class="btn btn-primary btn-sm">Update</button>
               <a href="delete.php?delete_area=<?php echo $area_id; ?>"
                class="btn btn-sm btn-danger <?php echo $btnst; ?>"><i class="fa fa-trash"></i></a>
              </td>
             </form>
            </tr>
            <?php }
                        } else { ?>
            <tr align="center">
             <td colspan="6">
              <h2>No Service Area Found!</h2>
             </td>
            </tr>
            <?php } ?>
           </tbody>
          </table>
         </div>
         <!-- datatable ends -->
        </div>
       </div>
      </div>
     </div>
    </section>
    <!-- users list ends -->
   </div>
  </div>
 </div>
 <!-- END: Content-->

 <?php require 'footer.php'; ?>

</body>
<!-- END: Body-->

</html>
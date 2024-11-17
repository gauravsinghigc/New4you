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
    <title>Slider : <?php echo $PosName; ?></title>
    <?php include 'header_files.php'; ?>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

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
                                <h4 class="users-action">Sliders <i class="fa fa-angle-right"></i>
                                    <a href="add_slider.php" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add Slider</a>
                                </h4>
                            </div>

                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table table-striped zero-configuration">
                                        <thead>
                                            <th>#</th>
                                            <th>Slide Title</th>
                                            <th>Slide Image</th>
                                            <th>Slide Type</th>
                                            <th>Url</th>
                                            <th>Status</th>
                                            <th>SortBy</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM slider ORDER BY sortby ASC";
                                            $query = mysqli_query($con, $sql);
                                            $counslide = mysqli_num_rows($query);
                                            if ($counslide == 0) {
                                                echo "<tr><td colspan='5' align='center'><h2>No Slides Found!</h2></td></tr>";
                                            }
                                            $num = 0;
                                            while ($fetch = mysqli_fetch_assoc($query)) {
                                                $slider_id = $fetch['slider_id'];
                                                $slider_title = $fetch['slider_title'];
                                                $slider_type = $fetch['slider_type'];
                                                $target_url = $fetch['target_url'];
                                                $slider_img = $fetch['slider_img'];
                                                $sortby = $fetch['sortby'];
                                                $slider_status = $fetch['slider_status'];
                                                $status = $fetch['slider_status'];

                                                if ($slider_status == "active") {
                                                    $slider_status = "<i class='text-success fa fa-check-circle'> Active</i>";
                                                    $back = "";
                                                } elseif ($slider_status == "inactive") {
                                                    $slider_status = "<i class='text-danger fa fa-warning'> Inactive</i>";
                                                    $back = "background-color: #fbcfcf33 !important;";
                                                }
                                                $num++;
                                                echo "
                                                <tr style='$back'>
                                                <form action='update.php' method='POST'>
                                                    <td>$num</td>
                                                   <td><input type='text' value='$slider_title' name='slider_title' class='form-control d-input' required=''></td>
                                                   <td><a href='img/store_img/slider/$slider_img' target='blank'><img src='img/store_img/slider/$slider_img' style='width:50px;'></a></td>
                                                   <td>$slider_type</td>
                                                   <td>$target_url</td>
                                                   <td><a href='update.php?slider_status=$slider_id&status=$status'>$slider_status</a></td>
                                                   <td>$sortby</td>
                                                   <td>
                                                <a href='delete.php?delete_slider=$slider_id&file=$slider_img' class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a>
                                                   </td>
                                                   </form>
                                                </tr>";
                                            } ?>
                                        </tbody>
                                    </table>

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
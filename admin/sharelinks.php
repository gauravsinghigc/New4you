<?php
require 'files.php';
require 'session.php';
$title_name = "Sharing Links & Account Url";

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="author" content="<?php echo $PosName; ?>">
  <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
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

      <!--Action Modal ---->

      <div class="modal fade text-left" id="AddSharingUrl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title font-medium-2 text-white" id="myModalLabel1"><i class="fa fa-link text-white"></i>
                <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
              </h4>
              <button type="button" class="close btn-md text-white font-medium-3" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="insert.php" method="POST">
                <input type="text" name="cr_url" value="<?php echo $CR_PAGE; ?>" hidden="">
                <input type="text" name="linkcreatedon" value="<?php echo date('d M, y h:m a'); ?>" hidden="">
                <div class="row">

                  <!---content form area -->
                  <div class="col-12 col-sm-7 col-md-7 col-lg-7 mb-1">
                    <div class="form-group">
                      <label>Link
                        Title</label>
                      <input type="text" name="linktitle" class="form-control" required="" placeholder="like facebook, twitter, youtube, instagram">
                    </div>
                  </div>

                  <div class="col-12 col-sm-5 col-md-5 col-lg-5 mb-1">
                    <div class="form-group">
                      <label>Fa-code</label>
                      <input type="text" name="fafacode" class="form-control" required="" placeholder="like : fa-link, fa-share, fa-facebook">
                    </div>
                  </div>

                  <div class="col-12 col-sm-12 col-md-12 col-lg-12 mb-1">
                    <div class="form-group">
                      <label>Url or
                        Link</label>
                      <input type="text" name="linkurl" class="form-control" required="" placeholder="like : https://example.ext/">
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-1">
                    <div class="form-group">
                      <label>Alt &
                        Title
                        Name</label>
                      <input type="text" name="linkaltname" class="form-control" required="" placeholder="like : example text">
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-1">
                    <div class="form-group">
                      <label>Status</label>
                      <input type="text" name="linkstatus" class="form-control" required="" placeholder="like : active or inactive">
                    </div>
                  </div>

                  <!-- content form area end -->
                </div>
            </div>
            <div class="modal-footer">
              <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
              <button class="btn btn-success" type="submit" name="SaveNewUrl">Save url</button>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-------------------end ----------------->

      <div class="content-body">
        <!-- users list start -->
        <section class="users-list-wrapper">
          <div class="users-list-table">
            <div class="card">
              <div class="card-header">
                <h4 class="users-action"><i class="fa fa-table text-primary"></i>
                  <?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
                  <a href="#" data-toggle="modal" data-target="#AddSharingUrl"><i class="fa fa-plus"></i>
                    Add
                    Url</a>
                </h4>
              </div><br>
              <div class="card-content">
                <div class="card-body">
                  <!-- datatable start -->
                  <style>
                    table tr th,
                    td {
                      font-size: 12.5px !important;
                    }
                  </style>
                  <div class="table-responsive">
                    <table class="table table-striped zero-configuration" style="font-size: 12px !important;">
                      <thead>
                        <tr>
                          <th style="width:3% !important;">#</th>
                          <th style="width:5% !important;">LinkId</th>
                          <th style="width:2% !important;">Icon</th>
                          <th style="width:15% !important;">LinkTitle</th>
                          <th style="width:15% !important;">Fa Fa-code</th>
                          <th>View</th>
                          <th>CreatedOn</th>
                          <th>LastUpdated</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $FETCH_sharelinks = "SELECT * FROM sharelinks";
                        $QUERY_sharelinks = mysqli_query($con, $FETCH_sharelinks);
                        $CountSno = 0;
                        while ($ROWS = mysqli_fetch_assoc($QUERY_sharelinks)) {
                          $CountSno++;
                          $linkstatus = $ROWS['linkstatus'];
                          if($linkstatus == "active"){
                            $status = '<input type="checkbox" id="switcherySize3" class="switchery mt-0" data-size="xs" checked/>';
                          } else {
                            $status = '<input type="checkbox" id="switcherySize3" class="switchery mt-0" data-size="xs"/>';
                          } ?>

                          <tr>
                            <td><?php echo $CountSno; ?></td>
                            <td><a href="#" class="btn btn-link btn-sm" data-toggle="modal" data-target="#ViewSharedLink<?php echo $ROWS['sharelinkid']; ?>">
                                #LINK<?php echo $ROWS['sharelinkid']; ?>
                              </a></td>
                            <td align="center"><i class="fa <?php echo $ROWS['fafacode']; ?> btn-sm btn btn-outline-secondary"></i></td>
                            <td><?php echo $ROWS['linktitle']; ?></td>
                            <td><?php echo $ROWS['fafacode'];?></td>
                            <td><?php echo rand(11111, 99999); ?></td>
                            <td><?php echo $ROWS['linkcreatedon']; ?></td>
                            <td><?php echo $ROWS['linklastupdated']; ?></td>
                            <td>
                              <?php UpdateStatus(
                              $table = "sharelinks", 
                              $data = "sharelinkid", 
                              $name = $ROWS['linktitle'], 
                              $status = $linkstatus, 
                              $id = $ROWS['sharelinkid'],
                              $c_name = "linkstatus"
                              );?>
                            </td>
                            <td>
                              <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ViewSharedLink<?php echo $ROWS['sharelinkid']; ?>">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a href="#" class="btn btn-sm btn-black" data-toggle="modal" data-target="#ViewSharedLink<?php echo $ROWS['sharelinkid']; ?>">
                                <i class="fa fa-eye"></i>
                              </a>
                              <a href="<?php echo $ROWS['linkurl'];?>" class="btn btn-sm btn-info" target="_blank">Open</a>
                              <?php DeleteData($table="sharelinks", $data="sharelinkid", $id=$ROWS['sharelinkid'], $name=$ROWS['linktitle']);?>
                            </td>
                          </tr>

                          <!-- Modal -->
                          <div class="modal fade text-left" id="ViewSharedLink<?php echo $ROWS['sharelinkid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header bg-primary">
                                  <h4 class="modal-title font-medium-2 text-white" id="myModalLabel1">
                                    <i class="fa fa-edit"></i>
                                    <?php echo $title_name; ?>
                                    <i class="fa fa-angle-right"></i>
                                    <?php echo $ROWS['linktitle']; ?>
                                  </h4>
                                  <button type="button" class="close text-white btn-lg" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <form action="update.php" method="POST">
                                    <input type="text" name="cr_url" value="<?php echo $CR_PAGE;?>" hidden="">
                                    <input type="text" name="linklastupdated" value="<?php echo date('d M, Y h:m A');?>" hidden="">
                                    <div class="row">
                                      <div class="col-12 col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                          <label>linktitle</label>
                                          <input type="text" name="linktitle" value="<?php echo $ROWS['linktitle'];?>" class="form-control" required="">
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                          <label>fafacode</label>
                                          <input type="text" name="fafacode" value="<?php echo $ROWS['fafacode'];?>" class="form-control" required="">
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                          <label>linkaltname</label>
                                          <input type="text" name="linkaltname" value="<?php echo $ROWS['linkaltname'];?>" class="form-control" required="">
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-6 col-lg-6 col-sm-6">
                                        <div class="form-group">
                                          <label>linkstatus  <i class="fa fa-angle-right"></i> Status : <?php echo $ROWS['linkstatus'];?></label><br>
                                          <input type="radio" name="linkstatus" value="active" required="" checked=""> Active<br>
                                          <input type="radio" name="linkstatus" value="inactive"> Inactive
                                        </div>
                                      </div>
                                      <div class="col-12 col-md-12 col-lg-12 col-sm-6">
                                        <div class="form-group">
                                          <label>linkurl <i class="fa fa-angle-right"></i> <a href="#" onclick="urlcopy<?php echo $ROWS['sharelinkid']; ?>()" id='button<?php echo $ROWS['sharelinkid']; ?>'
               class='btn btn-sm btn-primary'><span id="Text<?php echo $ROWS['sharelinkid']; ?>">Copy Url</span></a></label>
                                          <input type="text" name="linkurl" value="<?php echo $ROWS['linkurl'];?>" class="form-control" id="myInput<?php echo $ROWS['sharelinkid']; ?>" required="">
                              <script>
            function urlcopy<?php echo $ROWS['sharelinkid']; ?>() {
             var copyText = document.getElementById("myInput<?php echo $ROWS['sharelinkid']; ?>");
             copyText.select();
             copyText.setSelectionRange(0, 99999);
             document.execCommand("copy");
             document.getElementById("Text<?php echo $ROWS['sharelinkid']; ?>").innerHTML = "Url Copied";
             document.getElementById("button<?php echo $ROWS['sharelinkid']; ?>").className = "btn-danger btn btn-sm btn";
            }
            </script>
                                        </div>
                                      </div>
                                      
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <a class="btn grey btn-outline-secondary" data-dismiss="modal">Close</a>
                                  <button class="btn btn-success btn-success" type="submit" name="UPDATESHARELINKS" value="<?php echo $ROWS['sharelinkid'];?>">Update Data</button>
                                </form>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end modal -->

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
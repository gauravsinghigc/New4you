<?php require 'files.php';
if(isset($_GET['view'])){
    $view = $_GET['view'];
  if ($view == "contacts_list") {
      if (isset($_GET['id'])) {
          $id = $_GET['id'];
        if (empty($id)) {
          header("location: contacts_list.php?alert=danger&msg=Invalid&txt=Invalid Data Source, Server Rejected the Information Access!");
        } else {
            $id_d = modify("$id", "d"); 
            $sql = "SELECT * FROM contacts_list where contact_id='$id_d'";
            $query =  mysqli_query($con, $sql);
            $fetch = mysqli_fetch_assoc($query);
        }
      }
  } else {
    header("location: error.php?err=invalid_data_format for gethering information");
  }
} else {
    header("location: error.php?err=invalid_data_view request");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo modify($fetch['contact_fullname'], "d");?> | <?php echo $name;?></title>

<?php require 'meta.php'; require 'stylesheet.php'; ?>

</head>
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
    <!-- end #page-loader -->



    <!-- begin #page-container -->
    <div id="page-container" class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">

     <?php require 'header.php'; require 'sidebar.php'; ?>

     <!-- begin #content -->
        <div id="content" class="content">
            <!-- begin page-header -->
            <h1 class="page-header"><i class="fa fa-user"></i> <?php echo modify($fetch['contact_fullname'],"d");?>
                <small>
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Phone</button>
                </a>
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Mail-id</button>
                </a>
                 <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Address</button>
                </a>
                 <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Projects</button>
                </a>
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Credentials</button>
                </a>
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Transaction</button>
                </a>
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Invoices</button>
                </a>
                <a href="#modal-dialog" data-toggle="modal">
                    <button type="button" class="btn btn-link text-info btn-sm m-b-5"><i class="fa fa-plus"></i> Reference links</button>
                </a>
                </small>
            </h1>
            <hr class="hr-mr">
            <!-- end page-header -->
            <!-- content -- >
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
            <!-- begin widget -->
                    <div class="widget widget-blog">
                        <div class="widget-blog-cover list-bg-style">
                        </div>
                        <div class="widget-blog-author">
                            <div class="widget-blog-author-image">
                                <img src="assets/img/user_3.jpg" alt="">
                            </div>
                            <div class="widget-blog-author-info">
                                <h5 class="m-t-0 m-b-1">Serhiy Navin</h5>
                                <p class="text-muted m-0 f-s-11">Front End Designer</p>
                            </div>
                        </div>
                        <div class="widget-blog-content">
                            <h5>Lorem ipsum dolor sit amec adipiscing elit.</h5>
                            <p>
                                Nulla condimentum sodales urna, at consequat urna laoreet non. Aenean id porttitor odio, id elementum augue. Donec rhoncus semper mi.
                            </p>
                        </div>
                    </div>
            <!-- end widget -->
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">

                </div>
            </div>


            <!-- content -- >
            <?php require 'footer.php';?>
        </div>
        <!-- end #content -->



    </div>
    <!-- end page container -->



    <?php require 'script.php'; ?>
</body>

</html>
<div class="modal fade" id="modal-dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Modal Dialog</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4>Text in a modal</h4>
                                            <p class="m-b-20">
                                                Duis mollis, est non commodo luctus, nisi erat porttitor ligula.
                                            </p>

                                            <h4>Popover in a modal</h4>
                                            <p class="m-b-20">
                                                This <a href="#" class="btn btn-sm btn-success" data-toggle="popover" title="A Title" data-content="And here's some amazing content. It's very engaging. right?">button</a> should trigger a popover on click.
                                            </p>

                                            <h4>Tooltips in a modal</h4>
                                            <p class="m-b-20">
                                                This <a href="#" data-toggle="tooltip" title="Tooltip">link</a> and that <a href="#" data-toggle="tooltip" title="Tooltip">link</a> should have tooltips on hover.
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
                                            <a href="javascript:;" class="btn width-100 btn-primary">Action</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="utf-8" />
 <title>ALL Contacts | <?php echo $name; ?></title>

 <?php require 'meta.php';
    require 'stylesheet.php'; ?>

</head>

<body>
 <!-- begin #page-loader -->
 <div id="page-loader" class="page-loader fade in"><span class="spinner">Loading...</span></div>
 <!-- end #page-loader -->



 <!-- begin #page-container -->
 <div id="page-container"
  class="fade page-container page-header-fixed page-sidebar-fixed page-with-two-sidebar page-with-footer">

  <?php require 'header.php';
        require 'sidebar.php'; ?>

  <!-- begin #content -->
  <div id="content" class="content">
   <!-- begin page-header -->
   <h1 class="page-header">ALL Contacts
    <small>
     <a href="#modal-dialog" data-toggle="modal"><button type="button" class="btn btn-info btn-sm m-b-5">ADD
       Contacts</button></a>
    </small>
   </h1>
   <hr class="hr-mr">
   <!-- end page-header -->
   <!-- content -- >



            <!-- content -- >
            <?php require 'footer.php'; ?>
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
     This <a href="#" class="btn btn-sm btn-success" data-toggle="popover" title="A Title"
      data-content="And here's some amazing content. It's very engaging. right?">button</a> should trigger a popover on
     click.
    </p>

    <h4>Tooltips in a modal</h4>
    <p class="m-b-20">
     This <a href="#" data-toggle="tooltip" title="Tooltip">link</a> and that <a href="#" data-toggle="tooltip"
      title="Tooltip">link</a> should have tooltips on hover.
    </p>
   </div>
   <div class="modal-footer">
    <a href="javascript:;" class="btn width-100 btn-default" data-dismiss="modal">Close</a>
    <a href="javascript:;" class="btn width-100 btn-primary">Action</a>
   </div>
  </div>
 </div>
</div>
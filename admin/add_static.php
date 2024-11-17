<?php
require 'files.php';
require 'session.php';
$title_name = "ADD Static Page";
$store_user_id = $_SESSION['user_id'];
$select_store = "SELECT * FROM stores where user_id='$store_user_id'";
$store_query = mysqli_query($con, $select_store);
$fetch_store = mysqli_fetch_assoc($store_query);
$store_id = $fetch_store['store_id'];

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
 <meta name="author" content="<?php echo $PosName; ?>">
 <title><?php echo $title_name; ?> : <?php echo $PosName; ?></title>
 <style>
 #container #containerHeader {
  text-align: center;
  cursor: move;
 }

 #container #editor1 {
  border: 1px solid grey;
  height: 100%;
  width: 100%;
  margin: 0px auto 0;
  padding: 10px;
 }

 #container fieldset {
  margin: 2px auto 0px;
  width: 100%;
  height: 50%;
  background-color: #fafafa;
  border: none;
 }

 #container button {
  width: 5ex;
  text-align: center;
  padding: 1px 3px;
  height: 25px;
  width: 25px;
  background-repeat: no-repeat;
  background-size: cover;
  border: none;
 }

 #container img {
  width: 100%;
 }
 </style>
 <script>
 function chooseColor() {
  var mycolor = document.getElementById("myColor").value;
  document.execCommand('foreColor', false, mycolor);
 }

 function backColor() {
  var nColor = document.getElementById("nColor").value;
  document.execCommand('backColor', false, nColor);
 }

 function changeFont() {
  var myFont = document.getElementById("input-font").value;
  document.execCommand('fontName', false, myFont);
 }

 function changeSize() {
  var mysize = document.getElementById("fontSize").value;
  document.execCommand('fontSize', false, mysize);
 }

 function checkDiv() {
  var editorText = document.getElementById("editor1").innerHTML;
  if (editorText === '') {
   document.getElementById("editor1").style.border = '5px solid red';
  }
 }

 function removeBorder() {
  document.getElementById("editor1").style.border = '1px solid transparent';
 }

 function getContent() {
  document.getElementById("my-textarea").value = document.getElementById("editor1").innerHTML;
 }
 </script>
 <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
        <h4 class="users-action"><?php echo $title_name; ?> <i class="fa fa-angle-right"></i>
        </h4>
       </div>
       <div class="card-content">
        <div class="card-body">
         <form action="insert.php" method="POST" enctype="multipart/form-data">
          <div class="row">
           <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
             <label>Page Access Key</label>
             <input type="text" name="staticpageaccesskey" class="form-control d-input" required="">
            </div>
           </div>

           <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
             <label>Page Title</label>
             <input type="text" name="staticpagetitle" class="form-control d-input" required="">
            </div>
           </div>

           <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
             <label>Page Keywords</label>
             <input type="text" name="staticpagekeywords" class="form-control d-input" required="">
            </div>
           </div>

           <div class="col-lg-12 col-md-12 col-12">
            <div class="form-group">
             <label>Page Meta Description</label>
             <textarea class="form-control" name="staticpagemetadesc" required=""></textarea>
            </div>
           </div>

           <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
             <label>Page Status</label>
             <select class="form-control" name="staticpagestatus" required="">
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
             </select>
            </div>
           </div>

           <div class="col-lg-6 col-md-6 col-12">
            <div class="form-group">
             <label>Page Created On</label>
             <input type="date" name="staticpagecreatedon" class="form-control d-input" required="">
            </div>
           </div>

           <div class="col-lg-12 col-md-12 col-12">
            <div id="container">
             <fieldset>
              <a class="fontStyle cut" onclick="document.execCommand('cut',false,null);" title="cut(Ctrl+x)">
               <i class="fa fa-scissors"></i>
              </a>
              <a class="fontStyle copy" onclick="document.execCommand('copy',false,null);" title="copy(ctrl+c)">
               <i class="fa fa-copy"></i>
              </a>
              <a class="fontStyle italic" onclick="document.execCommand('italic',false,null);"
               title="Italicize Highlighted Text"><i class="fa fa-italic"></i></a>
              <a class="fontStyle bold" onclick="document.execCommand( 'bold',false,null);"
               title="Bold Highlighted Text"><i class="fa fa-bold"></i></a>
              <a class="fontStyle underline" onclick="document.execCommand( 'underline',false,null);"><i
                class="fa fa-underline"></i></a>
              <select id="input-font" class="input" onchange="changeFont (this);" style="width:10%;">
               <option value="Arial">Arial</option>
               <option value="Helvetica">Helvetica</option>
               <option value="Times New Roman">Times New Roman</option>
               <option value="Sans serif">Sans serif</option>
               <option value="Courier New">Courier New</option>
               <option value="Verdana">Verdana</option>
               <option value="Georgia">Georgia</option>
               <option value="Palatino">Palatino</option>
               <option value="Garamond">Garamond</option>
               <option value="Comic Sans MS">Comic Sans MS</option>
               <option value="Arial Black">Arial Black</option>
               <option value="Tahoma">Tahoma</option>
               <option value="Comic Sans MS">Comic Sans MS</option>
              </select>
              <a class="fontStyle subscript" onclick="document.execCommand( 'subscript',false,null);">
               <subscript><i class="fas fa-subscript"></i></subscript>
              </a>
              <a class="fontStyle superscript" onclick="document.execCommand( 'superscript',false,null);">
               <superscript><i class="fas fa-superscript"></i></superscript>
              </a>
              <a class="fontStyle strikethrough" onclick="document.execCommand( 'strikethrough',false,null);">
               <strikethrough> <i class="fa fa-strikethrough"></i></strikethrough>
              </a>
              <a class="fontStyle align-left" onclick="document.execCommand( 'justifyLeft',false,null);">
               <justifyLeft><i class="fas fa-align-left"></i> </justifyLeft>
              </a>
              <a class="fontStyle align-center" onclick="document.execCommand( 'justifyCenter',false,null);">
               <justifyCenter> <i class="fas fa-align-center"></i> </justifyCenter>
              </a>
              <a class="fontStyle align-right" onclick="document.execCommand( 'justifyRight',false,null);">
               <justifyRight> <i class="fas fa-align-right"></i> </justifyRight>
              </a>
              <a class="fontStyle redo-apply" onclick="document.execCommand( 'redo',false,null);">
               <redo><i class="fas fa-redo-alt"></i></redo>
              </a>
              <a class="fontStyle undo-apply" onclick="document.execCommand( 'undo',false,null);">
               <undo><i class="fas fa-undo-alt"></i></undo>
              </a>
              <a class="fontStyle createlink" onclick="document.execCommand( 'createLink',false,null);">
               <link> <i class="fas fa-link"></i></link>
              </a>
              <a class="fontStyle unlink" onclick="document.execCommand( 'unlink',false,null);">
               <link> <i class="fas fa-unlink"></i></link>
              </a>
              <a class="fontStyle orderedlist" onclick="document.execCommand('insertOrderedList', false, null);">
               <insertOrderedList><i class="fas fa-list"></i></insertOrderedList>
              </a>
              <a class="fontStyle unorderedlist" onclick="document.execCommand('insertUnorderedList', false, null)">
               <insertUnorderedList<i class="fas fa-list-ol"></i></insertUnorderedList>
              </a>
              <a class="fontStyle save" onclick="save()">
               <save><i class="fa fa-save"></i></save>
              </a>
              <input class="color-apply" type="color" onchange="backColor()" id="nColor" title="highlight">
              <input class="color-apply" type="color" onchange="chooseColor()" id="myColor" title="font color">
              <!-- font size start -->
              font size :
              <select id="fontSize" onclick="changeSize()">
               <option value="1">1</option>
               <option value="2">2</option>
               <option value="3">3</option>
               <option value="4">4</option>
               <option value="5">5</option>
               <option value="6">6</option>
               <option value="7">7</option>
               <option value="8">8</option>
              </select>
              <!-- font size end -->

             </fieldset>
             <div id="editor1" contenteditable="true"></div>
             <textarea id="my-textarea" class="form-control" name="t" style="display:none"></textarea>
         </form>
        </div>
       </div>


       <div class="panel-footer text-right pt-2">
        <a href="static_pages.php" class="btn btn-default">Back to Pages</a>
        <button class="btn btn-success" type="submit" name="create_static_pages">Create
         Page</button>
       </div>
       </form>
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

</html>
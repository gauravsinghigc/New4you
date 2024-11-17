<?php


function msg()
{
  if (isset($_GET['notify'])) {
    $notify = $_GET['notify'];
    $msg = $_GET['msg'];
    echo "
                <div class='alert alert-$notify fade show m-b-10'>
                    <strong class='text-upper'>$notify : </strong>
                      $msg
                   <span class='close' data-dismiss='alert'><a>&times;</a></span>
                </div>";
  } else {
  }
}

function notification()
{
  if (isset($_GET['alert'])) {
    $notify = $_GET['alert'];
    $msg = $_GET['msg'];
    $txt = $_GET['txt'];
    echo "
              <div class='row'>
                <div id='note' class='alert alert-$notify fade show col-lg-12 col-sm-12 col-sx-12 col-12'>
                    <strong class='text-upper'>$msg :</strong>
                      $txt
                   <span class='close' onclick='remove_msg()' data-dismiss='alert' style='margin-top:5px;'>&times;</span>
                </div>
              </div>";
  } else {
  }
}
?>

<script>
function remove_msg() {
 $(document).ready(function() {
  var uri = window.location.toString();
  if (uri.indexOf("?") > 0) {
   var clean_uri = uri.substring(0, uri.indexOf("?"));
   window.history.replaceState({}, document.title, clean_uri);
  }
 });
}
</script>
<?php require 'files.php';
require 'session.php';
if (isset($_SESSION['introduction'])) {
  header("location: index.php");
} else {
  setcookie("introduction", $customer_id, time()+60*60*365);
  $_SESSION['introduction'] = "intro.php";
}
?>
<html>

 <head>
  <title><?php echo $AppNameWithExt; ?> ! <?php echo $AppTag; ?></title>
  <?php GSI_header_files(); ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <style type="text/css">
  #loader {
   border: 12px solid #f3f3f3;
   border-radius: 50%;
   border-top: 12px solid #444444;
   width: 70px;
   height: 70px;
   animation: spin 1s linear infinite;
   z-index: 100000000000000000;
  }

  @keyframes spin {
   100% {
    transform: rotate(360deg);
   }
  }

  .center {
   position: absolute;
   top: 0;
   bottom: 0;
   left: 0;
   right: 0;
   margin: auto;
  }

  body.myanimation {
   animation: myanimation 10s infinite !important;
  }

  @keyframes myanimation {
   0% {
    background-color: #b7f5f4;
   }

   25% {
    background-color: #bbd3ec;
   }

   50% {
    background-color: #bbecde;
   }

   75% {
    background-color: #bbeccb;
   }

   85% {
    background-color: #bff5b7;
   }

   100% {
    background-color: #b7f5e8;
   }
  }

  </style>
 </head>

 <body class="myanimation">
  <?php GetMsg(); ?>

  <body>
   <div id="loader" class="center"></div>
   <section class="container-fluid">
    <div class="row">
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 col-xl-12 col-xxs-12">
      <div class="d-block my-auto" style="margin: auto;
  width: 100%;
  padding: 10px;">
       <img src="<?php echo $LogoRec; ?>" class="mb-0 d-block mx-auto" id="AppLogo" style="width: 0px;">
       <p class="text-center kharido-TagLine mt-0 mx-auto d-block font-9" id="KharidoTagLine" style="margin-top: -14px !important;opacity: 0.0;width: 0px;"><?php echo $AppTag; ?></p>
      </div>
      <p class="text-danger d-block mx-auto fixed-bottom text-center" id="PreparingApp" style="margin-bottom: 23% !important;opacity: 0;"><i class="fa fa-spinner fa-spin"></i> Loading App...</p>
      <p class="text-success d-block mx-auto fixed-bottom text-center" id="AppIsReady" style="margin-bottom: 23% !important;opacity: 0;"><i class="fa fa-check-circle"></i> Ready to Go</p>
      <a href="index.php" class="btn btn-block btn-info bottom-text bottom-p text-white fixed-bottom d-block mx-auto" id="ContinueBtn" onclick="ContinueAction()"
       style="opacity: 0.0;width:0px; margin-bottom: 12% !important;">Continue </a>
      <p class="text-center copyrighted mb-1 fixed-bottom" id="CopyRightedText" style="opacity: 0.0; margin-bottom: -10% !important;">CopyRighted &copy; <?php echo date("Y"); ?> All Right are
       Reserved By <a href="https://<?php echo $AppNameWithExt; ?>" class="text-info"><?php echo $AppNameWithExt; ?></a><br>
       By Continue this, You agree our <a href="terms-and-conditions.php" class="text-info">terms & condition.</a></p>
     </div>
    </div>
   </section>

   <?php GSI_footer_files(); ?>
   <script type="text/javascript">
   $(document).ready(() => {
    $("#AppLogo").animate({
     width: '100%',
     marginTop: '150%'
    }, 900);
    $("#AppLogo").delay(900).animate({
     width: '3%',
     marginTop: '0%'
    }, 600);
    $("#AppLogo").delay(200).animate({
     width: '55%',
     marginTop: '100%'
    }, 1000);
    $("#AppLogo").delay(300).animate({
     width: '100%',
     marginTop: '15%'
    }, 1000);
    $("#KharidoTagLine").delay(5300).animate({
     width: '100%',
     opacity: '1.0'
    }, 1500);
    $("#PreparingApp").delay(6500).animate({
     opacity: '1.0'
    }, 800);
    $("#PreparingApp").delay(600).animate({
     opacity: '0'
    }, 400);
    $("#AppIsReady").delay(8300).animate({
     opacity: '1.0'
    }, 300);
    $("#ContinueBtn").delay(8500).animate({
     opacity: '1.0',
     width: '50%'
    }, 900);
    $("#CopyRightedText").delay(9200).animate({
     opacity: '1.0',
     marginBottom: '1%',
     width: '100%'
    }, 800);
   });

   function ContinueAction() {
    document.getElementById("ContinueBtn").innerHTML = "<i class='fa fa-spinner fa-spin'></i> Opening App...";
   }
   </script>
   <script type="text/javascript">
   document.onreadystatechange = function() {
    if (document.readyState !== "complete") {
     document.querySelector(
      "body").style.visibility = "hidden";
     document.querySelector(
      "#loader").style.visibility = "visible";
    } else {
     document.querySelector(
      "#loader").style.display = "none";
     document.querySelector(
      "body").style.visibility = "visible";
    }
   };
   </script>
  </body>

</html>

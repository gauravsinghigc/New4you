<?php include 'files.php';?>
<html style="<?php echo $ThemeColor;?>">
    <head>
       <title><?php echo $AppNameWithExt;?> ! <?php echo $AppTag;?></title> 
       <?php GSI_header_files();?>   
    </head>
    <body>
  <div class="container" style="padding-left: 1%;
    padding-right: 1%;">
   <div class="row header-content">
    <div class="col-lg-12 col-sm-12 col-xs-12">
     <div class="content-header">
      <div class="left-section">
       <div class="header-top" style="padding-top: 1%;
    padding-bottom: 1%;border-bottom: none;">
        <div class="navbar">
         <center>
          <a href="index.php">
           <img src="<?php echo $LogoRec;?>" class="img-fluid w-50 mx-auto d-block" id='box'>
           <p class="text-center kharido-TagLine-all mt-0 font-3"><?php echo $AppTag;?></p>
          </a>
         </center>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>

        <!--section start-->
        <section class="login-page section-b-space mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-5">
                        <h3 class="title font-6">Password Reset</h3>
                        <div class="theme-card">
                            <form class="theme-form" action="reset.php" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control tr-input pl-2" name="check_data"
                                        placeholder="Enter Phone Number/Email Id" required="" id="DataInput">
                                </div>
                                <button name="check_user" type="submit" class="btn btn-success btn-block bottom-text bottom-p btn-block mb-1" onclick="ResetClick()">
                                  <span id="ResetClick"><i class="fa fa-refresh mt-0"></i> Reset</span>
                                </button>

                                <a href="login.php" class="btn btn-info btn-block bottom-text bottom-p text-white"><i class="fa fa-angle-left"></i> Back to Login</a>
                            </form>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-0 text-center pl-0 pr-0">
                    <hr class="mx-auto">
                    <p class="text-center copyrighted">CopyRighted &copy; <?php echo date("Y");?> All Right are Reserved By <a href="https://<?php echo $AppNameWithExt;?>" class="text-info"><?php echo $AppNameWithExt;?></a></p>
                </div>
                </div>
            </div>
        </section>
        <!--Section ends-->

<script type="text/javascript">
  function ResetClick(){
    var DataInput = document.getElementById("DataInput").value;
    document.getElementById("ResetClick").innerHTML = "<i class='fa fa-refresh fa-spin mt-0'></i> Searching Account for " + DataInput + " ...";
  }
</script> 




        <script>
        $(window).on('load', function() {
            $('#exampleModal').modal('show');
        });

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }
        </script>

        <!-- latest jquery-->
         <!-- Vendor JS -->
   <script src="libs/jquery/jquery.js"></script>
   <script src="libs/bootstrap/js/bootstrap.js"></script>
   <script src="libs/jquery.countdown/jquery.countdown.js"></script>
   <script src="libs/nivo-slider/js/jquery.nivo.slider.js"></script>
   <script src="libs/owl.carousel/owl.carousel.min.js"></script>
   <script src="libs/slider-range/js/tmpl.js"></script>
   <script src="libs/slider-range/js/jquery.dependClass-0.1.js"></script>
   <script src="libs/slider-range/js/draggable-0.1.js"></script>
   <script src="libs/slider-range/js/jquery.slider.js"></script>
   <script src="libs/elevatezoom/jquery.elevatezoom.js"></script>

   <!-- Template CSS -->
   <script src="js/main.js"></script>
    </body>

</html>

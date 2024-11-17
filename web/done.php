<?php
require 'files.php';
if (isset($_GET['data'])) { ?>
<meta http-equiv="refresh" content="3; checkout.php">
<?php } elseif(isset($_GET['msg'])){?>
<meta http-equiv="refresh" content="3; checkout.php">
<?php } elseif (isset($_GET['err'])) { ?>
<meta http-equiv="refresh" content="3; checkout.php">
<?php } else { } ?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="24kharido.in">
      <title><?php echo $store_name;?> :  Order Placed</title>
      <?php include 'header_files.php';?>
<script type="text/javascript"></script>
   </head>
   <body>
      <?php require 'header.php'; ?>

      <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <a href="index.php"><strong><span class="fa fa-home"></span> Home</strong></a> <span class="fa fa-angle-right"></span> <a href="">Order Success</a>
               </div>
            </div>
         </div>
      </section>
      <section class="checkout-page section-padding">
         <div class="container">
            <div class="row">
               <div class="col-md-8 mx-auto">
                  <div class="checkout-step">
                     <div class="accordion" id="accordionExample">
                        <div class="card">
                           <div class="card-header" id="headingThree">
                              <h5 class="mb-0">Order Complete</h5>
                           </div>
                           <div id="collapsefour" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
                              <div class="card-body">
                                 <div class="text-center">
                                    <div class="col-lg-10 col-md-10 mx-auto order-done">
                                       <i class="fa fa-check-circle text-success"></i>
                                       <h4 class="text-success">Congrats! Your Order has been Placed..</h4>
                                       <p>
                                         Your Order Is placed Successfully. Please Check your registered mail id to know more about order details, order status.<br>You can also check in your Store Account about this.
                                       </p>
                                    </div>

                                    <div class="text-center">
                                       <a href="order_list.php"><button type="button" class="btn btn-info mb-2 btn-lg">View Orders</button></a>
                                       <a href="index.php"><button type='button' class="btn btn-success mb-1 btn-lg">Return to Store</button></a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>
      </section>
 <?php require 'why_section.php'; require 'login_section.php'; require 'footer.php'; ?>
<!-- Bootstrap core JavaScript -->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <!-- select2 Js -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel -->
      <script src="js/owl.carousel.js"></script>
      <!-- Custom -->
      <script src="js/custom.js"></script>


</body></html>

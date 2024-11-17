<?php require 'files.php'; ?>
<!DOCTYPE html>
<html>

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <title><?php echo $store_name; ?> : Contact Us</title>
 <?php include 'header_files.php'; ?>
</head>

<body>
 <?php
 include "header.php"; ?>
 <!-- about section start -->
 <section class="about-page section-big-py-space">
  <div class="custom-container">
   <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-12 offset-3">
     <h4>Contact Us</h4>
     <p>Feel free to contact us for your valuable feedback, suggestion, and queries</p>
     <form class="mt-4">
      <div class="form-group row">
       <label for="colFormLabel" class="col-sm-2 col-form-label col-form-label">Full Name</label>
       <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="colFormLabel" placeholder=" Enter Your Name ">
       </div>
      </div>
      <div class="form-group row">
       <label for="colFormLabel" class="col-sm-2 col-form-label col-form-label">Phone</label>
       <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="colFormLabel" placeholder="+91" value="+91">
       </div>
      </div>
      <div class="form-group row">
       <label for="colFormLabel" class="col-sm-2 col-form-label col-form-label">Email ID</label>
       <div class="col-sm-10">
        <input type="email" class="form-control form-control-sm" id="colFormLabel" placeholder="Enter your mail id">
       </div>
      </div>
      <div class="form-group row">
       <label for="colFormLabel" class="col-sm-2 col-form-label col-form-label">Subject</label>
       <div class="col-sm-10">
        <input type="text" class="form-control form-control-sm" id="colFormLabel" placeholder="Subject">
       </div>
      </div>
      <div class="form-group row">
       <label for="colFormLabel" class="col-sm-2 col-form-label col-form-label">Message</label>
       <div class="col-sm-10">
        <textarea name="" class="form-control form-control-sm" id="colFormLabel" placeholder="Your Message"></textarea>
       </div>
      </div>
      <div class="form-group row">
       <div class="col-sm-10">
        <button class="btn btn-primary">Send Message</button>
       </div>
      </div>
     </form>


    </div>

   </div>
  </div>
 </section>
 <!-- about section end -->


 <?php include 'footer.php'; ?>
</body>

</html>
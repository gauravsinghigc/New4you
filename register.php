<?php require 'files.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $store_name; ?> : Login</title>
    <?php include 'header_files.php'; ?>
</head>

<body>
    <?php
    include "header.php"; ?>
    <!--section start-->
    <section class="login-page section-big-py-space b-g-light">
        <div class="custom-container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="theme-card">
                        <h3 class="text-center"><i class="fa fa-user text-primary"></i> Create account</h3>
                        <hr>
                        <form class="theme-form bg-white" action="insert.php" method="POST">
                            <input type="hidden" name="cr_url" value="<?php echo get_url(); ?>" hidden="">
                            <div class="row g-3">
                                <div class="col-md-6 form-group">
                                    <label for="email">Full Name</label>
                                    <input type="text" class="form-control" id="fname" name="customer_name" placeholder="Full Name" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Phone Number</label>
                                    <input type="text" class="form-control" value="" id="LoginPhoneNumber" name="customer_phone_number" placeholder="Phone Number" required="">
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12 form-group">
                                    <label for="review">Mail Id</label>
                                    <input type="email" class="form-control" value="" id="LoginPhoneNumber" name="customer_mail_id" placeholder="Email Id" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" value="" id="LoginPhoneNumber" name="customer_password" placeholder="Password" required="">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Re-Enter Password</label>
                                    <input type="password" class="form-control" value="" id="LoginPhoneNumber" name="customer_password_2" placeholder="Re-Enter Password" required="">
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" name="register_customer" class="btn btn-normal">create Account</button>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <p>Have you already account? <a href="login.php" class="txt-default text-primary">click</a> here to &nbsp;<a href="login.php" class="txt-default">Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Section ends-->


    <?php include 'footer.php'; ?>
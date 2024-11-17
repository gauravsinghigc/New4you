<!-- My account bar start-->
<div id="myAccount" class="add_to_cart right account-bar">
  <a href="javascript:void(0)" class="overlay" onclick="closeAccount()"></a>
  <div class="cart-inner">
    <div class="cart_top">
      <h3>my account</h3>
      <div class="close-cart">
        <a href="javascript:void(0)" onclick="closeAccount()">
          <i class="fa fa-times" aria-hidden="true"></i>
        </a>
      </div>
    </div>
    <form class="theme-form" action="insert.php" method="POST">
      <div class="form-group">
        <label for="email">Phone Number</label>
        <input type="text" class="form-control" id="email" name="customer_mail_id" placeholder="Email" required="">
      </div>
      <div class="form-group">
        <label for="review">Password</label>
        <input type="password" class="form-control" id="review" name="customer_password" placeholder="Enter your password" required="">
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-solid btn-md btn-block " name="login_request">Login</button>
      </div>
      <div class="accout-fwd">
        <a href="forget.php" class="d-block"><h5>forget password?</h5></a>
        <a href="register.php" class="d-block"><h6 >you have no account ?<span>signup now</span></h6></a>
      </div>
    </form>
  </div>
</div>
<!-- Add to account bar end-->
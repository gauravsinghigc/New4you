<!-- footer start -->
<footer>
  <div class="footer1">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="footer-main">
            <div class="footer-box">
              <div class="footer-title mobile-title">
                <h5>about</h5>
              </div>
              <div class="footer-contant">
                <div class="footer-logo">
                  <a href="index-2.html">
                    <img src="<?php echo $logo; ?>" class="img-fluid" alt="logo">
                  </a>
                </div>
                <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.</p>
                <ul class="paymant">
                  <li><a href="javascript:void(0)"><img src="assets/images/layout-1/pay/1.png" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="assets/images/layout-1/pay/2.png" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="assets/images/layout-1/pay/3.png" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="assets/images/layout-1/pay/4.png" class="img-fluid" alt="pay"></a></li>
                  <li><a href="javascript:void(0)"><img src="assets/images/layout-1/pay/5.png" class="img-fluid" alt="pay"></a></li>
                </ul>
              </div>
            </div>
            <div class="footer-box">
              <div class="footer-title">
                <h5>my account</h5>
              </div>
              <div class="footer-contant">
                <ul>
                  <li><a href="about-us.php">about us</a></li>
                  <li><a href="contact-us.php">contact us</a></li>
                  <li><a href="terms-and-condition.php">terms &amp; conditions</a></li>
                  <li><a href="refund-policy.php">returns &amp; exchanges</a></li>
                  <li><a href="privacy-policy.php">privacy policy</a></li>
                  <li><a href="track-order.php">shipping &amp; delivery</a></li>
                </ul>
              </div>
            </div>
            <div class="footer-box">
              <div class="footer-title">
                <h5>contact us</h5>
              </div>
              <div class="footer-contant">
                <ul class="contact-list">
                  <li><i class="fa fa-map-marker"></i><?php echo $STORE_ADDRESS; ?></li>
                  <li><i class="fa fa-phone"></i>call us: <span><?php echo $store_phone; ?></span></li>
                  <li><i class="fa fa-envelope-o"></i>email us: <?php echo $store_mail_id; ?></li>
                  <li><i class="fa fa-fax"></i>Domain: <span> <?php echo $DOMAIN; ?></span></li>
                </ul>
              </div>
            </div>
            <div class="footer-box">
              <div class="footer-title">
                <h5>newsletter</h5>
              </div>
              <div class="footer-contant">
                <div class="newsletter-second">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="enter full name">
                      <span class="input-group-text"><i class="ti-user"></i></span>
                    </div>
                  </div>
                  <div class="form-group ">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="enter email address">
                      <span class="input-group-text"><i class="ti-email"></i></span>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <a href="javascript:void(0)" class="btn btn-solid btn-sm">submit now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="subfooter dark-footer ">
    <div class="container">
      <div class="row">
        <div class="col-xl-7 col-md-8 col-sm-12">
          <div class="footer-left">
            <p><?php echo date("Y"); ?> &copy; CopyRighted | All Right Reserved By <?php echo APP_CONFIG("APP_NAME"); ?></p>
          </div>
        </div>
        <div class="col-xl-5 col-md-4 col-sm-12">
          <div class="footer-right">
            <ul class="sosiyal">
              <?php
              $FETCH_sharelinks = "SELECT * FROM sharelinks where linkstatus='active'";
              $QUERY_sharelinks = mysqli_query($con, $FETCH_sharelinks);
              while ($ROWS = mysqli_fetch_assoc($QUERY_sharelinks)) { ?>
                <li><a href="<?php echo $ROWS['linkurl']; ?>"><i class="fa <?php echo $ROWS['fafacode']; ?>"></i></a></li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer end -->
<?php include 'login_sec.php'; ?>

<script type="text/javascript">
  function Singup() {
    var register = document.getElementById("register");
    var login = document.getElementById("myAccount");
    if (register.style.display == "none") {
      register.style.display = "block";
      login.style.display = "none";
    } else {
      register.style.display = "none";
      login.style.display = "none";
    }
  }
</script>
<script>
  $('.slick-slider').slick({
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 2000
  });
</script>
<?php include 'cart_bar.php';
include "footer_files.php";
require 'msg.php'; ?>
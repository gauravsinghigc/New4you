<?php require 'files.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="description" content="bigboost">
 <meta name="keywords" content="bigboost">
 <meta name="author" content="bigboost">
 <link rel="icon" href="<?php echo $app_logo_sq;?>" type="image/x-icon" />
 <link rel="shortcut icon" href="<?php echo $app_logo_sq;?>" type="image/x-icon" />
 <title><?php echo $app_name;?> : Home Page</title>

 <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display:300,400,700" rel="stylesheet">
  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
    <link rel="stylesheet" href="css/cmGauge.css">

  <!-- Vendor CSS -->
  <link rel="stylesheet" href="libs/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="libs/font-material/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="libs/nivo-slider/css/nivo-slider.css">
  <link rel="stylesheet" href="libs/nivo-slider/css/animate.css">
  <link rel="stylesheet" href="libs/nivo-slider/css/style.css">
  <link rel="stylesheet" href="libs/owl.carousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="libs/slider-range/css/jslider.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reponsive.css">

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style type="text/css">
  .tab_buttons {
    background-color: white;
    color: black !important;
    box-shadow: 0px 0px 1px grey;
  }

  .tab_buttons:hover {
    background-color: green;
    color: white !important;
    box-shadow: 0px 0px 1px grey;
  }
  .fr {
    float: right;
  }
</style>
</head>

<body class="home home-2">
 <div id="all">
   <?php include 'header.php';?>

 <section class="container-fluid">
  <div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 1%; padding-right: 1%;">
    <h2 style="font-size: 14px;"><i class="fa fa-star"></i> Quality Reports <i class="fa fa-angle-right"></i> <span id="REPORTVIEW"></span>
    </h2>
   </div>
  </div>
 </section>

<section class="container-fluid">
  <div class="row">
    <div class="col-sm-12 col-xs-12" style="padding-right: 1%; padding-left: 1%;padding-bottom: 6vw;">
      <a onclick="VIEWBUFFALO()" class="btn btn-sm btn-outline-success tab_buttons">Buffalo Milk</a>
      <a onclick="VIEWCOW()" class="btn btn-sm btn-outline-success tab_buttons fr">Cow Milk</a>
    </div>
  </div>
</section>

<script type="text/javascript">
  function VIEWBUFFALO(){
    document.getElementById('BUFFALOTABS').style.display = "block";
    document.getElementById('COWTABS').style.display = "none";
    document.getElementById('REPORTVIEW').innerHTML = "Buffalo Milk";
  }

  function VIEWCOW(){
    document.getElementById('BUFFALOTABS').style.display = "none";
    document.getElementById('COWTABS').style.display = "block";
    document.getElementById('REPORTVIEW').innerHTML = "Cow Milk";
  }
</script>

 <section class="container-fluid" id="BUFFALOTABS" style="display: black;">
  <div class="row">
    <div class="col-xs-7 col-sm-7" style="padding-right: 1%; padding-left: 1%;margin-bottom: 5%;">
      <div id="gaugeDemo" class="gauge gauge-small gauge-green" style="border: none !important;">
        <img src="img/meterbg.png" style="width: 50vw">
       <div class="gauge-arrow" data-percentage="70" id='numbers' style="transform: rotate(0deg);"><img src="img/niddle.png" style="width: 7vw;
   margin-left: -11px;
    margin-top: 4vw;"></div>
      </div>
    </div>
    <div class="col-sm-5 col-xs-5" style="padding-left: 1%; padding-right: 1%;">
      <div style="padding-top: 5vw;">
        <p style="line-height: initial;"><b>Today's Score</b><br>
          <span style="font-size: 9vw;" class="numbers" data-target="540">540</span><br>
        Out of 700</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: left;padding: 1.5%;">
      <div style="background-color: #4c8752;
    border-radius: 7px;
    padding: 1%;
    color: white;
    text-shadow: 0px 0px 1px black;
    padding-left: 4%;">
      <p style="font-size: 17px;padding: 2%;">
        <span>Adulterent</span><br><span class="numbers" data-target="0">0</span></p>
    </div>
    </div>
    <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: left;padding: 1.5%;">
      <div style="background-color: #4c8752;
    border-radius: 7px;
    padding: 1%;
    color: white;
    text-shadow: 0px 0px 1px black;
    padding-left: 4%;">
      <p style="font-size: 17px;padding: 2%;"><span>Acidity</span><br><span class="numbers" data-target="0">0</span></p>
    </div>
    </div>
    <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: left;padding: 1.5%;">
      <div style="background-color: #4c8752;
    border-radius: 7px;
    padding: 1%;
    color: white;
    text-shadow: 0px 0px 1px black;
    padding-left: 4%;">
      <p style="font-size: 17px;padding: 2%;"><span>Grade</span><br>A</p>
    </div>
    </div> 
  </div>
  <hr>
   <div class="row" style="background-color: #3bfb4f1a;
    padding-top: 5%;
    padding-bottom: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8752;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>FAT</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="6.8">6.8</span> <small style="color:white;">%</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 6%</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">Percent fat content, whole buffalo milk fat varies between 5% - 6% depends on feed and weather.</p>
     </div>
   </div>

   <div class="row" style="background-color: #dadada66;
    padding-bottom: 5%;
    padding-top: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8775;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>SNF</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="9.1">9.1</span> <small style="color:white;">%</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 9%</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">solid non fat is the substances in milk other than fat and water, it include casein, lactose, vitamins ad minerals standard snf in buffalo milk in 9%.</p>
     </div>
   </div>

   <div class="row" style="background-color: #3bfb4f1a;
    padding-top: 5%;
    padding-bottom: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8752;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>PROTEIN</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="4">4</span> <small style="color:white;">%</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 3.5%</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">raw buffalo milk contains 35 grams of protein per liter.</p>
     </div>
   </div>

   <div class="row" style="background-color: #dadada66;
    padding-bottom: 5%;
    padding-top: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8775;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>SSC</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="2.6">2.6</span> <small style="color:white;">K/ML</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 300 K/ML</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">somatic cell count -- scc is the number of white blood cells found in milliliter of buffalo milk.</p>
     </div>
   </div>

   <div class="row" style="background-color: #3bfb4f1a;
    padding-top: 5%;
    padding-bottom: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8752;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>MBRT</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="4">4</span> <small style="color:white;">Hours</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"> <b>> STANDARD 4 hours</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">Methylene blue drereduction test, commonly known as MBRT test is used as a quick method to assess the bacterial count in milk, higher time indicates lowr bacterial count in buffalo milk.</p>
     </div>
   </div>
   <hr>
   <div class="row" style="margin-bottom: 5vw;">
     <div class="col-xs-12 col-sm-12">
      <center>
       <a href="report.php" class="btn btn-sm">View Report</a>
     </center>
     </div>
   </div>
 </section>



 <section class="container-fluid" id="COWTABS" style="display: none;">
  <div class="row">
    <div class="col-xs-7 col-sm-7" style="padding-right: 1%; padding-left: 1%;margin-bottom: 5%;">
      <div id="gaugeDemo" class="gauge gauge-small gauge-green" style="border: none !important;">
        <img src="img/meterbg.png" style="width: 50vw">
       <div class="gauge-arrow" data-percentage="40" id='numbers' style="transform: rotate(0deg);"><img src="img/niddle.png" style="width: 7vw;
   margin-left: -11px;
    margin-top: 4vw;"></div>
      </div>
    </div>
    <div class="col-sm-5 col-xs-5" style="padding-left: 1%; padding-right: 1%;">
      <div style="padding-top: 5vw;">
        <p style="line-height: initial;"><b>Today's Score</b><br>
          <span style="font-size: 9vw;" class="numbers" data-target="540">290</span><br>
        Out of 700</p>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: left;padding: 1.5%;">
      <div style="background-color: #4c8752;
    border-radius: 7px;
    padding: 1%;
    color: white;
    text-shadow: 0px 0px 1px black;
    padding-left: 4%;">
      <p style="font-size: 17px;padding: 2%;">
        <span>Adulterent</span><br><span class="numbers" data-target="0">1</span></p>
    </div>
    </div>
    <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: left;padding: 1.5%;">
      <div style="background-color: #4c8752;
    border-radius: 7px;
    padding: 1%;
    color: white;
    text-shadow: 0px 0px 1px black;
    padding-left: 4%;">
      <p style="font-size: 17px;padding: 2%;"><span>Acidity</span><br><span class="numbers" data-target="0">0</span></p>
    </div>
    </div>
    <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: left;padding: 1.5%;">
      <div style="background-color: #4c8752;
    border-radius: 7px;
    padding: 1%;
    color: white;
    text-shadow: 0px 0px 1px black;
    padding-left: 4%;">
      <p style="font-size: 17px;padding: 2%;"><span>Grade</span><br>B</p>
    </div>
    </div> 
  </div>
  <hr>
   <div class="row" style="background-color: #3bfb4f1a;
    padding-top: 5%;
    padding-bottom: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8752;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>FAT</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="6.8">5</span> <small style="color:white;">%</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 6%</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">Percent fat content, whole cow milk fat varies between 5% - 6% depends on feed and weather.</p>
     </div>
   </div>

   <div class="row" style="background-color: #dadada66;
    padding-bottom: 5%;
    padding-top: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8775;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>SNF</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="9.1">8</span> <small style="color:white;">%</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 9%</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">solid non fat is the substances in milk other than fat and water, it include casein, lactose, vitamins ad minerals standard snf in cow milk in 9%.</p>
     </div>
   </div>

   <div class="row" style="background-color: #3bfb4f1a;
    padding-top: 5%;
    padding-bottom: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8752;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>PROTEIN</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="4">3</span> <small style="color:white;">%</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 4.5%</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">raw cow milk contains 35 grams of protein per liter.</p>
     </div>
   </div>

   <div class="row" style="background-color: #dadada66;
    padding-bottom: 5%;
    padding-top: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8775;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>SSC</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="2.6">4</span> <small style="color:white;">K/ML</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"><b>STANDARD 300 K/ML</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">somatic cell count -- scc is the number of white blood cells found in milliliter of cow milk.</p>
     </div>
   </div>

   <div class="row" style="background-color: #3bfb4f1a;
    padding-top: 5%;
    padding-bottom: 5%;
    margin-bottom: 1%;">
     <div class="col-xs-4 col-sm-4" style="padding-left: 1%; padding-right: 1%;text-align: center;">
      <div style="padding: 12%;
    background-color: #4c8752;
    color: white;
    border-radius: 15px;">
      <h5 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 13px;"><b>MBRT</b></h5>
      <h2 style="margin-top: 0px;
    margin-bottom: 0px;font-size: 20px;"><span class="numbers" data-target="4">3</span> <small style="color:white;">Hours</small></h2><br>
      <p style="margin-top: 0px;
    margin-bottom: 0px;font-size: 10px;"> <b>> STANDARD 4 hours</b></p>
  </div>
     </div>
     <div class="col-xs-8 col-sm-8" style="padding-left: 1%; padding-right: 1%;padding: 1%;">
<p style="font-size: 12px;">Methylene blue drereduction test, commonly known as MBRT test is used as a quick method to assess the bacterial count in milk, higher time indicates lowr bacterial count in cow milk.</p>
     </div>
   </div>
   <hr>
   <div class="row" style="margin-bottom: 5vw;">
     <div class="col-xs-12 col-sm-12">
      <center>
       <a href="report.php" class="btn btn-sm">View Report</a>
     </center>
     </div>
   </div>
 </section>
 <br><br><br><br>
 </div>



<script type="text/javascript">
  $('.numbers').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4500,
            easing: 'linear',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

</script>



 <!-- Vendor JS -->
      <script src="libs/jquery/jquery.js">
      </script>
      <script src="libs/bootstrap/js/bootstrap.js">
      </script>
      <script src="libs/jquery.countdown/jquery.countdown.js">
      </script>
      <script src="libs/nivo-slider/js/jquery.nivo.slider.js">
      </script>
      <script src="libs/owl.carousel/owl.carousel.min.js">
      </script>
      <script src="libs/slider-range/js/tmpl.js">
      </script>
      <script src="libs/slider-range/js/jquery.dependClass-0.1.js">
      </script>
      <script src="libs/slider-range/js/draggable-0.1.js">
      </script>
      <script src="libs/slider-range/js/jquery.slider.js">
      </script>
      <script src="libs/elevatezoom/jquery.elevatezoom.js">
      </script>

      <!-- Template CSS -->
      <script src="js/main.js"></script>
      <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="js/cmGauge.js"></script>
<script type="text/javascript">
  $(function () {
    $("button").click(function () {
      var randomNum = Math.floor((Math.random() * 100));
      $('#gaugeDemo .gauge-arrow').trigger('updateGauge', randomNum);
    });

    $('#gaugeDemo .gauge-arrow').cmGauge();
  });
</script>

 <script>
 $(window).on('load', function() {
      $('#exampleModal').modal('show');
    });

    setTimeout(function() {
      $('#exampleModal').modal('hide');
      $('#exampleModal').fadeOut('slow');
    }, 1800); // <-- time in milliseconds


 function openSearch() {
  document.getElementById("search-overlay").style.display = "block";
 }

 function closeSearch() {
  document.getElementById("search-overlay").style.display = "none";
 }
 </script>
 <script type="text/javascript">
 function incrementValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  if (value < 10) {
   value++;
   document.getElementById('number').value = value;
  }
 }

 function decrementValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  if (value > 1) {
   value--;
   document.getElementById('number').value = value;
  }

 }
 </script>
</body>

</html>

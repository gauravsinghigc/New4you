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

	</head>

	<body class="home home-2">
		<div id="all">
			<?php include 'header.php';?>

<section class="container-fluid pb-2" >
				<div class="row">
					<div class="col-sm-12 col-xs-12" style="padding-top: 2%; padding-left: 1%; padding-right: 1%;">
						 <?php
                /* draws a calendar */
                function draw_calendar($month, $year)
                {

                    /* draw table */
                    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" style="width:100%;">';

                    /* table headings */
                    $headings = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
                    $calendar .= '<thead><tr class="calendar-row"><td class="calendar-day-head" style="padding: 2%;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;">' . implode('</td><td class="calendar-day-head" style="padding: 2%;
    box-shadow: 0px 0px 1px grey;
    font-size:12px;
    padding-right: 1px !important;
    text-align: center;">', $headings) . '</td></tr></thead>';

                    /* days and weeks vars now ... */
                    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
                    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
                    $days_in_this_week = 1;
                    $day_counter = 0;
                    $dates_array = array();

                    /* row for week one */
                    $calendar .= '<tr class="calendar-row">';

                    /* print "blank" days until the first of the current week */
                    for ($x = 0; $x < $running_day; $x++) :
                        $calendar .= '<td class="calendar-day-np" style="padding: 2%;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;"></td>';
                        $days_in_this_week++;
                    endfor;

                    /* keep going with days.... */
                    for ($list_day = 1; $list_day <= $days_in_month; $list_day++) :

                        if (isset($_GET['month'])) {
                            $view_month = $_GET['month'];
                        } else {
                            $view_month = date("m");
                        }
                        $month_name = strtoupper(date('M', mktime(0, 0, 0, $view_month, 10)));

                        if (isset($_GET['year'])) {
                            $view_year = $_GET['year'];
                        } else {
                            $view_year = date("Y");
                        }

                        $current_date = date("d");
                        $current_month = date("m");
                        $current_year = date("Y");
                        $full_current_date = "$current_date $current_month $current_year";
                        $full_running_date = "$list_day $view_month $view_year";
                        if ($full_current_date == $full_running_date) {
                            $show_date = "box-shadow:0px 0px 2px green; border-radius:10px;border-style: grrove; border:green; color:red !important;font-weight: 900;";
                        } else {
                            $show_date = "";
                        }

                        
                         
                        if(isset($_GET['day'])){
                            $v_day = $_GET['day'];
                            $v_month = $_GET['month'];
                            $v_year = $_GET['year'];
                            $v_date = "$v_day $v_month $v_year";
                            $full_running_date = "$list_day $view_month $view_year";
                            if($v_date == $full_running_date){
                                $run_Date = "box-shadow:0px 0px 2px red; border-radius:10px;border-style: grrove; border:green; color:red !important; font-weight: 900;text-decoration: red underline !important;";
                            } else {
                                $run_Date = "";
                            }
                        } else {
                            $run_Date = "";
                        }


                        $calendar .= '<td class="calendar-day" style="
                        padding: 1%;
    width: 14.28571428571429% !important;
    box-shadow: 0px 0px 1px grey;
    padding-right: 1px !important;
    text-align: center;
    ' . $show_date . '
    '. $run_Date.'">';
                        /* add in the day number */
                        $calendar .= '<a href="?day=' . $list_day . '&month=' . $view_month . '&year=' . $view_year . '" style="color:;"><div class="day-number">' . $list_day . '</div></a>';
                        if (isset($_SESSION['customer_id'])) {
                            $customer_id = $_SESSION['customer_id'];
                        } else {
                            $customer_id = "0";
                        }
                        global $con;
                        $currentdate = "$list_day-$view_month-$view_year";
                        $daysarrange = strtoupper(date("D", strtotime($currentdate)));
                        $current_date = date("Y-m-d", strtotime($currentdate));


                        $SelectUserstasks = "SELECT * FROM customer_subscriptions_days, customer_subscriptions where customer_subscriptions_days.customer_id='$customer_id' and  customer_subscriptions_days.SUBSCRIPTION_DAYS='$daysarrange' and customer_subscriptions_days.SUBS_START_DATE<='$current_date' and customer_subscriptions_days.customer_subscription_id=customer_subscriptions.customer_subscription_id and customer_subscriptions.SUBSCRIPTION_STATUS!='CANCEL'";

                        $query_tasks = mysqli_query($con, $SelectUserstasks);
                        $count_tasks = mysqli_num_rows($query_tasks);
                        if ($count_tasks == 0) {
                            $view_counts = "";
                        } else {
                            $view_counts = $count_tasks . "";
                        }

                        /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
                        $calendar .= str_repeat("<p style='font-size:12px;margin-bottom:0px;height:20px;'>$view_counts</p>", 1);

                        $calendar .= '</td>';
                        if ($running_day == 6) :
                            $calendar .= '</tr>';
                            if (($day_counter + 1) != $days_in_month) :
                                $calendar .= '<tr class="calendar-row">';
                            endif;
                            $running_day = -1;
                            $days_in_this_week = 0;
                        endif;
                        $days_in_this_week++;
                        $running_day++;
                        $day_counter++;
                    endfor;

                    /* finish the rest of the days in the week */
                    if ($days_in_this_week < 8) :
                        for ($x = 1; $x <= (8 - $days_in_this_week); $x++) :
                            $calendar .= '<td class="calendar-day-np"> </td>';
                        endfor;
                    endif;

                    /* final row */
                    $calendar .= '</tr>';

                    /* end the table */
                    $calendar .= '</table>';

                    /* all done, return result */
                    return $calendar;
                }



                /* date settings */
                $month = (int) (isset($_GET['month']) ? $_GET['month'] : date('m'));
                $year = (int)  (isset($_GET['year']) ? $_GET['year'] : date('Y'));
                $day = (int)  (isset($_GET['day']) ? $_GET['day'] : date('d'));

                /* select month control */
                $select_month_control = '<center><select name="month" id="month" style="padding:2%;">';
                for ($x = 1; $x <= 12; $x++) {
                    $select_month_control .= '<option value="' . $x . '"' . ($x != $month ? '' : ' selected="selected"') . '>' . date('F', mktime(0, 0, 0, $x, 1, $year)) . '</option>';
                }
                $select_month_control .= '</select>';

                /* select year control */
                $year_range = 3;
                $select_year_control = '<select name="year" id="year" style="padding:2%;">';
                for ($x = ($year - floor($year_range / 2)); $x <= ($year + floor($year_range / 2)); $x++) {
                    $select_year_control .= '<option value="' . $x . '"' . ($x != $year ? '' : ' selected="selected"') . '>' . $x . '</option>';
                }
                $select_year_control .= '</select>';

                /* "next month" control */
                $next_month_link = '<a href="?month=' . ($month != 12 ? $month + 1 : 1) . '&year=' . ($month != 12 ? $year : $year + 1) . '&day=' . $day . '" class="control float-right btn btn-sm btn-primary" style="float:right;" >Next <i class="fa fa-angle-right"></i></a>';

                /* "previous month" control */
                $previous_month_link = '<a href="?month=' . ($month != 1 ? $month - 1 : 12) . '&year=' .    ($month != 1 ? $year : $year - 1) . '&day=' . $day . '" class="control btn float-left btn-sm btn-primary"style="float:left;"><i class="fa fa-angle-left"></i>   Previous</a>'; ?>


                    <?php
                echo $next_month_link;
                echo $previous_month_link;
                echo "<br><hr style='margin-top: 8vw;'>"; ?>
                    <h5><span class='p-1'><b><i class="fa fa-calendar"></i> <i class="fa fa-angle-right"></i> </b><?php if (isset($_GET['day'])) {
                                                                                    $month_cr = $_GET['month'];
                                                                                    $month_cr_n = date("M", mktime(0, 0, 0, $month_cr, 10));
                                                                                    $year_cr = $_GET['year'];
                                                                                    $date_cr = $_GET['day'];
                                                                                    if($date_cr == "DAILY_PLAN"){
                                                                                        echo "Daily Plan";
                                                                                    } else {
                                                                                        echo "$date_cr $month_cr_n, $year_cr";
                                                                                    }
                                                                                } else {
                                                                                    echo date("d M, Y");
                                                                                } ?></span>
                        <a href='chart.php' class='btn btn-info btn-sm float-right' style="float: right;margin-top: -3%;">View Today</a><br></h5><br>
                    <?php echo draw_calendar($month, $year);
                ?>
					</div>
					<div class="col-sm-12 col-xs-12">
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <a href="chart.php" class="btn <?php
                                                                                        if (isset($_GET['tom'])) {
                                                                                            echo $selected = "btn-info";
                                                                                        } elseif(isset($_GET['day'])) {
                                                                                            echo $selected = "btn-info";
                                                                                        } else {
 echo $selected = "btn-outline-info";
                                                                                        }
                                                                                        ?> btn-sm" <?php
                                                                                        if (isset($_GET['type'])) {
                                                                                            echo $shadow = "";
                                                                                        } else {
                                                                                            echo $shadow = "style='font-weight: 600;'";
                                                                                        }
                                                                                        ?>> Today</a>
                            <a href="?<?php
                                    $cur_day = date("d", strtotime("+1 days"));
                                    $cur_month = date("m");
                                    $cur_year = date("Y");
                                    echo "day=$cur_day&month=$cur_month&year=$cur_year&tom=true";
                                    ?>
    " class="btn <?php
                                                                                        if (isset($_GET['tom'])) {
                                                                                            echo $selected = "btn-outline-info";
                                                                                        } else {
                                                                                            echo $selected = "btn-info";
                                                                                        }
                                                                                        ?> btn-sm" <?php
                                    if (isset($_GET['type'])) {
                                        $day = $_GET['type'];
                                        if ($day == "tom") {
                                            echo $shadow = "style='font-weight: 600;'";
                                        } else {
                                            $shadow = "";
                                        }
                                    }
                                    ?>> Tommorrow</a>

                        </div>
                    </div>
                    <div class="row">
                        <?php
                    if (!isset($_SESSION['customer_id'])) { ?>
                        <div class="col-md-12 col-12">
                            <center>
                                <img src="img/blank.png" style="width: 100%;">
                                <h4>No Subscriptions</h4>
                                <a href="login.php" class="btn btn-info btn-sm"><i class="fa fa-angle-left"></i> Login
                                    to View Orders</a>
                            </center>
                        </div>
                        <?php } else {
                        $customer_id = $_SESSION['customer_id'];
                        if (isset($_GET['day'])) {
                            $view_day = $_GET['day'];
                            if ($view_day <= 9) {
                                $view_days = "0$view_day";
                            } else {
                                $view_days = $view_day;
                            }
                            $view_day = $_GET['day'];
                            $view_month = $_GET['month'];
                            $view_year = $_GET['year'];
                            $monthName = strtoupper(date('M', mktime(0, 0, 0, $view_month, 10)));
                            $filter_view = "$view_days-$monthName-$year";
                            $daily_plan = "DAILY_PLAN";
                            $curre_day = strtoupper(date("D", strtotime($filter_view)));
                            $current_dates = date("Y-m-d", strtotime($filter_view));
                        } else {
                            $view_day = date("d");
                            $view_month = strtoupper(date("M"));
                            $view_year = date("Y");
                            $filter_view = "$view_day-$view_month-$year";
                            $daily_plan = "DAILY_PLAN";
                            $curre_day = strtoupper(date("D", strtotime($filter_view)));
                            $current_dates = date("Y-m-d", strtotime($filter_view));
                        }

                        if ($view_day == "DAILY_PLAN") {
                            $sql = "SELECT * FROM customer_subscriptions_days, customer_subscriptions  where customer_subscriptions_days.customer_id='$customer_id' and customer_subscriptions_days.SUBSCRIPTION_DATES='DAILY_PLAN' and customer_subscriptions_days.customer_subscription_id=customer_subscriptions.customer_subscription_id and customer_subscriptions.SUBSCRIPTION_STATUS!='CANCEL'";
                        } else {
                            $sql = "SELECT * FROM customer_subscriptions_days, customer_subscriptions where customer_subscriptions_days.customer_id='$customer_id' and customer_subscriptions_days.SUBSCRIPTION_DAYS='$curre_day' and customer_subscriptions_days.SUBS_START_DATE<='$current_dates' and customer_subscriptions_days.customer_subscription_id=customer_subscriptions.customer_subscription_id and customer_subscriptions.SUBSCRIPTION_STATUS!='CANCEL'";
                        }

                        $query = mysqli_query($con, $sql);
                        $count_all_items = mysqli_num_rows($query);

                        if ($count_all_items == 0) {
                            echo '<div class="col-md-12 col-12">
                                <center>
                                 <img src="img/blank.png" style="width: 100%;">
                                 <h4>No Subscriptions</h4>
                                 <a href="home.php" class="btn btn-info btn-sm"><i class="fa fa-angle-left"></i> Subscribe Now</a>
                                </center>
                               </div>';
                        } else {
                            if (isset($_GET['day'])) {
                                $v_day = $_GET['day'];
                                if($v_day == "DAILY_PLAN"){
                                    echo "<div class='col-lg-12'>
                                <br>
                                <h4 class='float-right'>View For: Daily Plan</h4>
                                </div>";
                                } else {
                                 echo "<div class='col-lg-12'>
                                <br>
                                <h4 class='float-right'>View For: $filter_view</h4>
                                </div>";
                                }

                            } else {
                            }
                            while ($fetch = mysqli_fetch_assoc($query)) {
                                $SUBSCRIPTION_ID[] = $fetch['customer_subscription_id'];
                            }
                            foreach ($SUBSCRIPTION_ID as $SUBS_ID_VIEW) {
                                $sql = "SELECT * FROM customer_subscriptions where customer_id='$customer_id' and customer_subscription_id='$SUBS_ID_VIEW'";
                                $query = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($query);

                                if ($count == 0) {
                                    echo '<div class="col-md-12 col-12">
                                        <center>
                                         <img src="img/blank.png" style="width: 100%;">
                                         <h4>No Subscription</h4>
                                         <a href="home.php" class="btn btn-info btn-sm"><i class="fa fa-angle-left"></i> Subscribe Now</a>
                                        </center>
                                       </div>';
                                } else {
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                        $subscribe_id = $fetch['customer_subscription_id'];
                                  $SUBS_APPLY_DATE = $fetch['SUBS_APPLY_DATE'];
                                $status_view = $fetch['SUBSCRIPTION_STATUS'];
                                $PLAN_TYPE = $fetch['SUBSCRIBE_PLAN_TYPE'];
                                $start_date = $fetch['SUBS_START_DATE'];
                $SUBS_START_DATE = date("d M, Y", strtotime($start_date));
                        ?>

                        <div class="col-12 col-md-12">
                            <hr>
                            <div class="row" style="padding:2%;box-shadow:0px 0px 1px grey; border-radius:5px;">
                                <div class="col-sm-3 col-xs-3" style='padding:2%; box-shadow:0px 0px 1px grey;'>
                                    <img src='img/referral-icon2.png' class='img-fluid text-center'
                                        style='width: 100%;'>
                                </div>
                                <div class="col-sm-9 col-xs-9">
                                    <h6 class="text-left" style='font-size:12px;'>SUBSID#
                                        <?php echo $fetch['customer_subscription_id']; ?> </h6>
                                    <p style="color: black; font-size: 12px;margin-top:-8px;">
                                        <span style='font-size:12px !important;'>
                                            <?php
        $sql = "SELECT * FROM subscription_products where customer_subscription_id='$subscribe_id'";
        $query = mysqli_query($con, $sql);
        $count_subs_items = mysqli_num_rows($query);
 while($fetch = mysqli_fetch_assoc($query)){
        echo "- ".$fetch['product_name']."<br>";
 }
?>

                                            <span class='float-right'>Start Date: <?php echo $SUBS_START_DATE;?></span>

                                            Req Date :
                                            <?php echo $SUBS_APPLY_DATE; ?><br>
                                            Total Items : <?php echo $count_subs_items;?> Items</span> <br>
                                        Payable Amount: <b style="font-size: 14px; color: green;"><i
                                                class="fa fa-inr"></i>
                                            <?php
        $select = "SELECT sum(product_total_price) FROM subscription_products where customer_subscription_id='$subscribe_id'";
        $action = mysqli_query($con, $select);
        while ($record = mysqli_fetch_assoc($action)) {
          echo $total_amount = $record['sum(product_total_price)'];
        }
?>
                                        </b>
                                        <b style="float: right;">Status: <?php echo $status_view; ?></b><br>
                                        PLAN Type : <?php echo $PLAN_TYPE; ?><br>
                                        <a href="subs_details.php?id=<?php echo $subscribe_id; ?>"
                                            class='btn btn-sm btn-success' style='padding: 4%;'><i class='fa fa-info-circle'></i> View </a>
                                        <?php
                                                        if ($status_view == "ACTIVE") { ?>
                                        <a href="update.php?subs_deactivate=<?php echo $subscribe_id; ?>&cr_url=<?php echo get_url(); ?>&action=PAUSE"
                                            class='btn btn-sm btn-warning float-right' style='padding: 4%;'>PAUSE</a>
                                        <?php } elseif ($status_view == "CANCEL") { ?>
                                        <a href="" class='btn btn-sm text-danger float-right'>Cancelled</a>
                                        <?php } else { ?>
                                        <a href="update.php?subs_deactivate=<?php echo $subscribe_id; ?>&cr_url=<?php echo get_url(); ?>&action=ACTIVE"
                                            class='btn btn-sm btn-info float-right' style='margin:1%;padding: 4%;'>Continue</a>

                                        <?php } ?>

                                    </p>
                                </div>
                            </div>
                        </div> <?php
                                            }
                                        }
                                    }
                                }
                            }

                                                ?>
                    </div>
                </div>
            </div>
			</section>

<br><br><br><br><br>

</div>

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
			<script src="js/main.js">
			< script >
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

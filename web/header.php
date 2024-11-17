<?php
if (isset($_GET['ref'])) {
    $RefrenceId = $_GET['ref'];
    $MainReferebPersonId = preg_replace("/[^0-9\.]/", '', "$RefrenceId");
    $_SESSION['REFER_PERSON_ID'] = $MainReferebPersonId;
}

$DeviceType = detectDevice();
if ($DeviceType == "Mobile") {
    header("location: app/");
}
?>
<nav class="navbar navbar-expand-lg bg-theme-cr bg-faded osahan-menu" style="background-color: transparent !important;">
    <div class="container-fluid container-fluid-mobile-view" style="background-color: transparent !important;">
        <a class="navbar-brand  dropbtn" href="index.php">
            <img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" title="<?php echo $store_name; ?>" class="kharido-logo">
        </a>
        <div class="dropdown dropbtn" style="width: 166px;
    padding: 0.3%;
    padding-bottom: 0;
    cursor: pointer;
    margin-top: 0px;">
            <a class="location-top" style="background-color: transparent !important;font-size:14.5px;color: black !important;"> &nbsp;
                <i class="fa fa-map-marker mt-0 text-success" aria-hidden="true" style='font-size:38px;position:absolute;top: 1px;'></i>
                <span style="margin-left: 15%;"> &nbsp;<?php
                                                    if (isset($_GET['city'])) {
                                                        $_SESSION['city_name'] = $_GET['city'];
                                                        $store_city_cr = $_SESSION['city_name'];
                                                    } else {
                                                        if (isset($_SESSION['city_name'])) {
                                                            $store_city_cr = $_SESSION['city_name'];
                                                        } else {
                                                            if (isset($_SESSION['customer_id'])) {
                                                                $store_city_cr = $customer_city;
                                                            } else {
                                                                $store_city_cr = $store_city;
                                                            }
                                                        }
                                                    }
                                                    echo "$store_city_cr"; ?>
                </span>
                <br>
                <span style="margin-left: 18%;
    font-size: 11px;
    top: -5px !important;
    position: relative;
"><i class='fa fa-angle-right mt-0 ml-2' style='font-size:11px;position: absolute;top: 3%;'></i>
                    <span style="margin-left: 7%;">
                        <?php
                        if (isset($_GET['area'])) {
                            $_SESSION['area'] = $_GET['area'];
                            $store_arealocality_cr = $_SESSION['area'];
                        } else {
                            if (isset($_SESSION['area'])) {
                                $store_arealocality_cr = $_SESSION['area'];
                            } else {
                                $store_arealocality_cr = $store_arealocality;
                            }
                        }

                        $sql = "SELECT * FROM city where city_name='$store_city_cr'";
                        $query = mysqli_query($con, $sql);
                        $fetch = mysqli_fetch_assoc($query);
                        $city_id_cr = $fetch['city_id'];
                        $sql = "SELECT * FROM services_area where city_id='$city_id_cr' and area_status='active'";
                        $query = mysqli_query($con, $sql);
                        $checkarea = mysqli_num_rows($query);
                        if ($checkarea == 0) {
                            $store_arealocality_cr = "No Active Areas";
                        } else {
                            $store_arealocality_cr = $store_arealocality_cr;
                        }
                        echo $store_arealocality_cr;
                        ?>
                    </span>
                </span>
            </a>
            <style>
                span.list-inline-2 {}

                a.area-locality {
                    font-size: 12.5px;
                    box-shadow: 0px 0px 1px black;
                    padding: 0.3%;
                    display: inline-block;
                    margin: 0.19%;
                    border-radius: 25px;
                    padding-left: 1.5%;
                    padding-right: 1.5%;
                }

                a.area-locality:hover {
                    background-color: #3dc33d !important;
                    color: white !impportant;
                }
            </style>
            <div class="dropdown-content" style="width:100% !important;left:0px !important;z-index: 50;position:fixed;top:5%;/*display: block !important;*/">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        $sql = "SELECT * FROM city where city_status='active'";
                        $query = mysqli_query($con, $sql);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                            $city_id[] = $fetch['city_id'];
                        }
                        foreach ($city_id as $city_id) {
                            $cr_url = $_SERVER['PHP_SELF'];
                            $sql = "SELECT * FROM city where city_status='active' and city_id='$city_id'";
                            $query = mysqli_query($con, $sql);
                            while ($fetch = mysqli_fetch_assoc($query)) {
                                $city_name = $fetch['city_name'];
                                echo "<div class='col-lg-12 col-md-12 col-sm-12 col-12 col-xs-12' style='text-align: justify;'>
                        <h4><i class='fa fa-map-marker'></i> $city_name</h4>";
                                echo "<span class='list-inline-2'><a href='$cr_url?city=$city_name' class='area-locality' style='border-radius:25px;background-color:#3dc33d; color:white;padding-left:2%; padding-right:2%;'><i class='fa fa-map-marker mt-0'></i> $city_name</a></span><br>";
                                $sql = "SELECT * FROM services_area where city_id='$city_id' and area_status='active'";
                                $query = mysqli_query($con, $sql);
                                while ($fetch = mysqli_fetch_assoc($query)) {
                                    $area_locality = $fetch['area_locality'];
                                    echo "<span class='list-inline-2'><a href='$cr_url?area=$area_locality' class='area-locality'> $area_locality</a></span>";
                                }
                                echo "</div><br>";
                            }
                        }
                        ?>
                        <div class='col-lg-12 col-md-12 col-sm-12 col-12 col-xs-12 text-center'>
                            <hr>
                            <h4><i class='fa fa-info-circle text-info'></i> We are currently working on activating other cities and area too, As activated we will inform you.</h4><br>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>

        <button class="navbar-toggler navbar-toggler-white" onclick="WebCategoryView()" style="font-size: 27px;">
        <span class="fa fa-bars"></span>
        </button>
        <div class="navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                <form action="products.php" method="GET">
                    <div class="top-categories-search">
                        <div class="input-group">
                            <input class="form-control" name="search" id='searchitems' oninput="autocomplete()" placeholder="Enter Product Name..." type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i>
                                    Search</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>


            <div class="my-2 my-lg-0">
                <ul class="list-inline main-nav-right">
                    <?php
                    if (isset($_SESSION['customer_id'])) { ?>
                        <li class="list-inline-item dropdown osahan-top-dropdown" style="color: white !important;margin-top: 4px;">
                            <a class="btn dropbtn" href="account.php">
                                <img src="img/user_img/<?php echo $customer_image; ?>">
                            </a>
                            <div class="dropdown-content" style="min-width: 14rem !important;
    margin-left: 2px !important;
    margin-right: -5px !important;
    margin-top: -4px !important;">
                                <a href="account.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-user"></i> My
                                    Account</a>
                                <a href="address.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-map-marker"></i> My Address</a>
                                <a href="order_list.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-shopping-cart"></i> My Orders</a>
                                <a href="track-order.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-map-marker"></i> Track Order</a>
                                <a href="rewards.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-star"></i> Reward Points</a>
                                <a href="wallet.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-square"></i> 24kharido Funds</a>
                                <a href="refer.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-share"></i> Refer & Earns</a>
                                <a href="notification.php" class="nav-link font-15"><i aria-hidden="true" class="fa fa-bell"></i> Notification</a>
                                <div class="dropdown-divider"></div>
                                <a class="nav-link font-15" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="list-inline-item" style="background-color:transparent !important;">
                            <a href="login.php" class="btn btn-link text-black btn-md" style="margin-top: 4px;"><i class="fa fa-sign-in"> Login/Sign Up</i></a>
                        </li>
                    <?php } ?>
                    <li class="list-inline-item cart-btn">
                        <a href="cart.php" class="btn btn-link border-none" style="margin-top: 4px;"><i class="fa fa-shopping-cart"> Cart</i>
                            <?php
                            $ip_address = get_ip();
                            $device_type = detectDevice();
                            date_default_timezone_set("Asia/Calcutta");
                            $date_time_c = date("dMY");
                            $ipv6_n = php_uname('n');
                            $ipv6_p = php_uname('p');
                            $os = php_uname('s');
                            $OS_release = php_uname('r');
                            $OS_Version = php_uname('v');
                            $System_Info = php_uname('m');
                            $System_more_Info = $_SERVER['HTTP_USER_AGENT'];
                            $device_info = "$ip_address";
                            if (isset($_SESSION['customer_id'])) {
                                $customer_id = $_SESSION['customer_id'];
                                $Update = "UPDATE customer_cart SET customer_id='$customer_id' where device_info='$device_info' and ip_address='$ip_address'";
                                $Query = mysqli_query($con, $Update);
                                if ($Query == true) {
                                    $sql = "SELECT * from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
                                }
                            } else {
                                $sql = "SELECT * from customer_cart where ip_address='$ip_address' and store_id='$store_id'";
                            }

                            $query = mysqli_query($con, $sql);
                            $count = mysqli_num_rows($query);
                            if ($count == 0) {
                                echo "";
                            } else {
                                echo "<small class='cart-value'>$count</small>";
                            }
                            ?>

                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile" style="margin-bottom: 0.5% !important;">
    <div class="container-fluid" style="padding-left: 0.5%; padding-right: 0.5%;padding: 0.1%;">
        <div class="collapse navbar-collapse" id="navbarText">
            <style type="text/css">
                @media only screen and (max-width: 600px) {
                    .mobile_list_items {
                        position: fixed;
                        top: -8px;
                        width: 100%;
                        z-index: 999;
                        height: 100%;
                        background-color: white;
                        left: 0px;
                        overflow: scroll !important;
                    }
                }

                @media only screen and (min-width: 1200px) {
                    .mobile-cat-img {
                        display: none;
                    }
                }

                @media only screen and (max-width: 600px) {
                    .mobile-cat-link {
                        display: none;
                    }

                    .mobile-dropdown {
                        display: none !important;
                    }
                }
            </style>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto mobile_list_items" style="padding-top: 0.2%;">
                <li class="nav-item mobile-cat-img">
                    <a class="nav-link shop mt-1" data-toggle="collapse" href='#top' data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <h4><i class="fa fa-times mobile-cat-img"></i> CLOSE </h4>
                    </a>
                </li>
                <li class="nav-item mobile-cat-link">
                    <a class="nav-link shop text-white" href="#" onclick="WebCategoryView()">
                        <i class="fa fa-bars mt-0"></i> All Categories</a>
                </li>

                <!--End of Large Category -->

                <li class="mobile-cat-img top-categories-search-main">
                    <form action="products.php" method="GET" class="mt-2">
                        <div class="top-categories-search">
                            <div class="input-group">
                                <input class="form-control" name="search" id='navsearch' placeholder="Enter Product Name..." aria-label="Enter product name..." type="text" style="box-shadow: 0px 0px 1px grey;">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i>
                                        Search</button>
                                </span>
                            </div>
                    </form>
        </li>
        <?php
        $sql = "SELECT * FROM product_categories where product_cat_status='active' and store_id='$store_id' ORDER BY sortby ASC limit 0, 8";
        $query = mysqli_query($con, $sql);
        $countcat = mysqli_num_rows($query);
        while ($fetch =  mysqli_fetch_assoc($query)) {
            $product_cat_id[] = $fetch['product_cat_id'];
        }

        foreach ($product_cat_id as $product_cat_id) {
            $sql = "SELECT * FROM product_categories where product_cat_status='active' and product_cat_id='$product_cat_id' and store_id='$store_id' ORDER BY sortby ASC";
            $query = mysqli_query($con, $sql);
            $fetch =  mysqli_fetch_assoc($query);
            $product_cat_id = $fetch['product_cat_id'];
            $category_img = $fetch['category_img'];
            $product_cat_title = $fetch['product_cat_title'];
            $product_cat_add_date = $fetch['product_cat_add_date'];
            $product_cat_status = $fetch['product_cat_status'];
            $sql_products = "SELECT * from user_products where product_cat_id='$product_cat_id' and user_id='$user_id' and user_products.product_status='active'";
            $query_products = mysqli_query($con, $sql_products);
            $count = mysqli_num_rows($query_products); ?>
                <li class="nav-item dropbtn" onmouseover="ShowSubs<?php echo $product_cat_id; ?>()">
                    <div class="dropdown">
                    <a href="products.php?cat_id=<?php echo $product_cat_id; ?>" class="nav-link " style="color: white;">
                        <img src='<?php echo $img_url; ?>/img/store_img/cat_img/<?php echo $category_img; ?>' class='mobile-cat-img' style='width:35px;'>
                        &nbsp;<?php echo $product_cat_title; ?>
                        <span class="mobile-cat-img float-right"> <?php echo $count; ?> Items </span></a>

                    <div class="dropdown-content">
                        <a href="products.php?cat_id=<?php echo $product_cat_id; ?>">
                            <img src='<?php echo $img_url; ?>/img/store_img/cat_img/<?php echo $category_img; ?>' class='img-fluid' style='width:35px;'> <b><?php echo $product_cat_title; ?></b></a>
                        <?php
                        $Select  = "SELECT * FROM product_sub_categories where product_cat_id='$product_cat_id' ORDER BY subcatsortby ASC";
                        $query = mysqli_query($con, $Select);
                        while ($fetch = mysqli_fetch_assoc($query)) {
                            $sub_cat_title = $fetch['sub_cat_title'];
                            $sub_cat_id = $fetch['sub_cat_id']; ?>
                            <a href="products.php?sub_cat_id=<?php echo $sub_cat_id; ?>"><i class="fa fa-angle-right mt-0"></i> <?php echo $sub_cat_title; ?></a>
                        <?php } ?>
                    </div>
            </div>
            </li>
        <?php } ?>
<?php if($countcat >= 9) { ?>
        <li class="nav-item dropbtn">
            <div class="dropdown">
            <a href="#" class="nav-link font-15" onclick="WebCategoryView()" onmouseover="WebCategoryView()"> <b>+ <?php echo $countcat-8; ?> View All</b></a>
        </div>
        </li>
<?php } ?>
        </ul>
    </div>
    </div>
</nav>
<script type="text/javascript">
    var products = [<?php
                    $sql = "SELECT * FROM user_products where user_id='$user_id' and product_status='active'";
                    $query = mysqli_query($con, $sql);
                    while ($fetch = mysqli_fetch_assoc($query)) {
                        $product_title = $fetch['product_title'];
                        echo '"' . $product_title . '",';
                    } ?>]

    function autocomplete(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) {
                return false;
            }
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    /*create a DIV element for each matching element:*/
                    b = document.createElement("DIV");
                    /*make the matching letters bold:*/
                    b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                    b.innerHTML += arr[i].substr(val.length);
                    /*insert a input field that will hold the current array item's value:*/
                    b.innerHTML += "<a href='products.php'><input type='hidden' value='" + arr[i] + "'><a>";
                    /*execute a function when someone clicks on the item value (DIV element):*/
                    b.addEventListener("click", function(e) {
                        /*insert the value for the autocomplete text field:*/
                        inp.value = this.getElementsByTagName("input")[0].value;
                        /*close the list of autocompleted values,
                        (or any other open lists of autocompleted values:*/
                        closeAllLists();
                    });
                    a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                if (currentFocus > -1) {
                    /*and simulate a click on the "active" item:*/
                    if (x) x[currentFocus].click();
                }
            }
        });

        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }

        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
                x[i].classList.remove("autocomplete-active");
            }
        }

        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
                if (elmnt != x[i] && elmnt != inp) {
                    x[i].parentNode.removeChild(x[i]);
                }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function(e) {
            closeAllLists(e.target);
        });
    }
    autocomplete(document.getElementById("searchitems"), products);
    autocomplete(document.getElementById("navsearch"), products);
</script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<?php
if (isset($_SESSION['customer_id'])) {
    $CheckNotification = "SELECT * FROM notifications where customer_id='$customer_id' and notification_status='NEW'";
    $NotificaitonQuery = mysqli_query($con, $CheckNotification);
    $CountNotificaiton = mysqli_num_rows($NotificaitonQuery);
    if ($CountNotificaiton == 0) {
    } else {
        echo "
      <a href='notification.php'><div style='padding: 1%;
    border-radius: 25px;
    box-shadow: grey 0px 0px 10px;
    position: fixed;
    bottom: 1%;
    right: 0;
    left: 0;
    z-index: 12;
    font-size: 13px;
    color: black !important;
    width: 15%;
    background-color: white;
    text-align:justify;' class='d-block mx-auto'>
    <h5 class='text-center'><i class='fa fa-bell text-danger'></i> $CountNotificaiton</h5>
  </div>
  </a>";
    }
}
?>

<?php
$ip_address = get_ip();
$device_type = detectDevice();
date_default_timezone_set("Asia/Calcutta");
$date_time_c = date("dMY");
$ipv6_n = php_uname('n');
$ipv6_p = php_uname('p');
$os = php_uname('s');
$OS_release = php_uname('r');
$OS_Version = php_uname('v');
$System_Info = php_uname('m');
$System_more_Info = $_SERVER['HTTP_USER_AGENT'];
$device_info = "$ip_address";
if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
    $Update = "UPDATE customer_cart SET customer_id='$customer_id' where device_info='$device_info' and ip_address='$ip_address'";
    $Query = mysqli_query($con, $Update);
    if ($Query == true) {
        $sql = "SELECT * from customer_cart where store_id='$store_id' and customer_id='$customer_id'";
    }
} else {
    $sql = "SELECT * from customer_cart where ip_address='$ip_address' and store_id='$store_id'";
}

$query = mysqli_query($con, $sql);
$count = mysqli_num_rows($query);
if ($count == 0) {
    echo "";
} else {
    echo "
    <a href='cart.php'><div style='padding: 1%;
    border-radius: 25px;
    box-shadow: red 0px 0px 10px;
    position: fixed;
    bottom: 1%;
    right: 0;
    left: 0;
    z-index: 12;
    font-size: 13px;
    color: black !important;
    width: 15%;
    background-color: white;
    text-align:justify;' class='d-block mx-auto'>
    <h5 class='text-center'><i class='fa fa-shopping-cart text-success'></i> $count</h5>
  </div>
  </a>";
}
?>
<!-- Large category -->
                <div class="container-fluid bg-white web-cat-area"  id="WebCategoryView" style="display:none;">
                    <div class="row bg-white">
                        <div>
                            <a href="#" class="btn btn-lg btn-danger web-area-close-btn" onclick="WebCategoryView()"><i class="fa fa-times mt-0"></i></a>
                        </div>
                        <div class="col-xs-12 col-md-12 col-lg-12 col-12 pl-1 pr-1 mb-2">
                            <div class="web-category" style="height: auto !important;">
                                <div class="Web-User-Area p-1">
                                    <?php if (isset($_SESSION['customer_id'])) { ?>
                                        <div class="row" style="width: 100% !important;">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-12 pr-0 text-center">
                                                <img class="web-user-logo" src="img/user_img/<?php echo $customer_image; ?>">
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-12 pl-1 pt-2 pr-0" style="padding-top: 5px !important;">
                                                <a href="account.php" class="font-15"><b>Hi</b>, <?php echo $customer_name; ?></a>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="row" style="width: 100% !important;">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 pr-0 text-center">
                                                <img class="web-user-logo" src="img/user_img/user.png">
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9 col-9 pl-1 pt-2 pr-0" style="padding-top: 5px !important;">
                                                <a href="login.php" class="font-15">Login/Signup </a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="Web-Categories-list">
                                    <a href="#" class="side-cat-heading"><h5><b>Browse Categories</b></h5></a>
                                    <?php
                                    $SQL_product_categories = "SELECT * FROM product_categories where product_cat_status='active' ORDER BY sortby ASC";
                                    $QUERY_product_categories = mysqli_query($con, $SQL_product_categories);
                                    while($FETCH_product_categories = mysqli_fetch_assoc($QUERY_product_categories)){ ?>
                                        <a href="products.php?cat_id=<?php echo $FETCH_product_categories['product_cat_id']; ?>">
                                            <img src='<?php echo $img_url; ?>/img/store_img/cat_img/<?php echo $FETCH_product_categories['category_img']; ?>' style='width:35px;'> <?php echo $FETCH_product_categories['product_cat_title'];?>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    <?php } ?>
                                    <a href="#" class="side-cat-heading"><h5><b>Account & Settings</b></h5></a>
                                    <?php if(isset($_SESSION['customer_id'])) { ?>
                                <a href="account.php"> My Account</a>
                                <a href="address.php"> My Address</a>
                                <a href="order_list.php"> My Orders</a>
                                <a href="track-order.php"> Track Order</a>
                                <a href="rewards.php"> Reward Points</a>
                                <a href="wallet.php"> 24kharido Funds</a>
                                <a href="refer.php"> Refer & Earns</a>
                                <a href="notification.php"> Notification</a>
                                <a href="query.php">Have an Query?</a>
                                <a href="logout.php">Logout</a>
                                    <?php } else { ?>
                                        <a href="login.php">Login/Signup </a>
                                        <a href="track-order.php">Track Order</a>
                                        <a href="query.php">Have an Query?</a>
                                    <?php } ?>
                                <a href="#" class="side-cat-heading"><h5><b>About <?php echo $APP_NAME;?></b></h5></a>
                                <a href="<?php echo $MainUrl;?>about_us.php">About Us</a>
                 <a href="<?php echo $MainUrl;?>privacy-policy.php">Privacy Policy</a>
                 <a href="<?php echo $MainUrl;?>terms-and-conditions.php">Terms & Condition</a>
                 <a href="<?php echo $MainUrl;?>refund-and-cancellation.php">Refund & Cancellation</a>
                 <a href="<?php echo $MainUrl;?>track-order.php">Track Order</a>
                 <a href="<?php echo $MainUrl;?>query.php">Have a Query?</a>
                 <a href="https://news4tech.in/category/24kharido/24kharido-fq" target="_blank">F&Q's</a>
                 <a href="<?php echo $MainUrl;?>career.php">Career</a>
                 <a href="<?php echo $MainUrl;?>influencer.php">Become an Influencer</a>
                 <a href="<?php echo $MainUrl;?>contact-us.php">Contact Us</a>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    function WebCategoryView() {
                         var WebCategoryView = document.getElementById("WebCategoryView");
                         var WebCategoryBg = document.getElementById("WebCategoryBg");
                        if (WebCategoryView.style.display === "none") {
                            WebCategoryView.style.display = "block";
                            WebCategoryBg.style.display = "block";
                        } else {
                            WebCategoryView.style.display = "none";
                            WebCategoryBg.style.display = "none";
                        }
                    }
                </script>

<?php
if (isset($_GET['ref'])) {
  $RefrenceId = $_GET['ref'];
  $MainReferebPersonId = preg_replace("/[^0-9\.]/", '', "$RefrenceId");
  $_SESSION['REFER_PERSON_ID'] = $MainReferebPersonId;
}
?>
<style>
  .autocomplete {
    /*the container must be positioned relative:*/
    position: relative;
    display: inline-block;
  }

  input {
    border: 1px solid transparent;
    padding: 10px;
    font-size: 13px;
  }

  input[type=text] {
    width: 100%;
  }

  input[type=submit] {
    color: black;
  }

  .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 90%;
    left: 0;
    right: 0;
    background-color: transparent;
  }

  .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    border-bottom: 1px solid #d4d4d4;
    background-color: white !important;
    color: black !important;
  }

  .autocomplete-items div:hover {
    /*when hovering an item:*/
    background-color: #caeff7;
    color: black;
  }

  .autocomplete-active {
    /*when navigating through the items using the arrow keys:*/
    color: black;
  }

  .notification-box {
    position: fixed;
    right: 0.5%;
    bottom: -1%;
    width: 70%;
    min-width: 250px;
    max-width: 350px;
    z-index: 1 !important;
    padding: 1% !important;
    padding-left: 1% !important;
    padding-right: 1% !important;
    box-shadow: 0px 0px 10px grey;
    border-radius: 10px !important;
    background-color: white !important;
    -webkit-border-radius: 10px !important;
    -moz-border-radius: 10px !important;
    -ms-border-radius: 10px !important;
    -o-border-radius: 10px !important;
  }

  .notification-box h4 {
    cursor: pointer;
    padding: 0.7rem !important;
    border-radius: 4px;
    font-weight: 200 !important;
    font-size: 1rem !important;
  }

  .notification-box p {
    padding: 2% !important;
    padding-left: 3% !important;
  }

  .notification-box h4 i.fa-times {
    float: right !important;
    margin-right: 2% !important;
  }

  @media (max-width: 720px) {
    .notification-box {
      width: 100% !important;
      min-width: 100% !important;
      max-width: 100%;
      bottom: 0px;
      z-index: 1111111111111 !important;
      position: fixed;
      border-top-right-radius: 20px !important;
      border-top-left-radius: 20px !important;
      box-shadow: 0px 0px 1px lightgrey !important;
      padding-top: 2% !important;
    }
  }
</style>


<!--header start-->
<header id="stickyheader">
  <div class="mobile-fix-option"></div>
  <div class="layout-header2">
    <div class="container">
      <div class="col-md-12">
        <div class="main-menu-block">
          <div class="header-left">
            <div class="sm-nav-block">
              <span class="sm-nav-btn">
                <i class="fa fa-bars"></i>
              </span>
              <ul class="nav-slide">
                <li>
                  <div class="nav-sm-back">
                    back <i class="fa fa-angle-right ps-2"></i>
                  </div>
                </li>
                <?php
                $sqlMOB = "SELECT * FROM product_categories where product_cat_status='active' and store_id='$store_id' ORDER BY sortby ASC";
                $query = mysqli_query($con, $sqlMOB);
                $countcat = mysqli_num_rows($query);
                while ($fetch =  mysqli_fetch_assoc($query)) {
                  $product_cat_idMOB[] = $fetch['product_cat_id'];
                }

                foreach ($product_cat_idMOB as $product_cat_id) {
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
                  <li><a href="products.php?cat_id=<?php echo $product_cat_id; ?>"><?php echo $product_cat_title; ?></a></li>
                <?php } ?>
              </ul>
            </div>
            <div class="brand-logo logo-sm-center">
              <a href="index.php">
                <img src="<?php echo $logo; ?>" class="img-fluid  " alt="logo">
              </a>
            </div>
          </div>
          <div class="input-block">
            <div class="input-box">
              <form class="big-deal-form" action="products.php" method="GET">
                <div class="input-group ">
                  <input type="search" class="form-control" name="search" id='bavbaritems' placeholder="Search a Product">
                  <div class="input-group-text">
                    <button type="submit" class="btn btn-theme">Search</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="header-right">
            <div class="icon-block">
              <ul>
                <li class="mobile-search">
                  <a href="javascript:void(0)">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612.01 612.01" style="enable-background:new 0 0 612.01 612.01;" xml:space="preserve">
                      <g>
                        <g>
                          <g>
                            <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
                              C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
                              l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
                              c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
                              S377.82,467.8,257.493,467.8z" />
                          </g>
                        </g>
                      </g>
                    </svg>
                  </a>
                </li>
                <li class="mobile-user " onclick="openAccount()">
                  <a href="javascript:void(0)">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                      <g>
                        <g>
                          <path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240
                              c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z" />
                        </g>
                      </g>
                      <g>
                        <g>
                          <path d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z
                               M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z" />
                        </g>
                      </g>
                    </svg>
                  </a>
                </li>
                <li class="mobile-setting" onclick="openSetting()">
                  <a href="javascript:void(0)">
                    <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z" />
                      <path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z" />
                    </svg>
                  </a>
                </li>
                <li class="mobile-wishlist item-count" onclick="openWishlist()">
                  <a href="javascript:void(0)">
                    <svg viewBox="0 -28 512.001 512" xmlns="http://www.w3.org/2000/svg">
                      <path d="m256 455.515625c-7.289062 0-14.316406-2.640625-19.792969-7.4375-20.683593-18.085937-40.625-35.082031-58.21875-50.074219l-.089843-.078125c-51.582032-43.957031-96.125-81.917969-127.117188-119.3125-34.644531-41.804687-50.78125-81.441406-50.78125-124.742187 0-42.070313 14.425781-80.882813 40.617188-109.292969 26.503906-28.746094 62.871093-44.578125 102.414062-44.578125 29.554688 0 56.621094 9.34375 80.445312 27.769531 12.023438 9.300781 22.921876 20.683594 32.523438 33.960938 9.605469-13.277344 20.5-24.660157 32.527344-33.960938 23.824218-18.425781 50.890625-27.769531 80.445312-27.769531 39.539063 0 75.910156 15.832031 102.414063 44.578125 26.191406 28.410156 40.613281 67.222656 40.613281 109.292969 0 43.300781-16.132812 82.9375-50.777344 124.738281-30.992187 37.398437-75.53125 75.355469-127.105468 119.308594-17.625 15.015625-37.597657 32.039062-58.328126 50.167969-5.472656 4.789062-12.503906 7.429687-19.789062 7.429687zm-112.96875-425.523437c-31.066406 0-59.605469 12.398437-80.367188 34.914062-21.070312 22.855469-32.675781 54.449219-32.675781 88.964844 0 36.417968 13.535157 68.988281 43.882813 105.605468 29.332031 35.394532 72.960937 72.574219 123.476562 115.625l.09375.078126c17.660156 15.050781 37.679688 32.113281 58.515625 50.332031 20.960938-18.253907 41.011719-35.34375 58.707031-50.417969 50.511719-43.050781 94.136719-80.222656 123.46875-115.617188 30.34375-36.617187 43.878907-69.1875 43.878907-105.605468 0-34.515625-11.605469-66.109375-32.675781-88.964844-20.757813-22.515625-49.300782-34.914062-80.363282-34.914062-22.757812 0-43.652344 7.234374-62.101562 21.5-16.441406 12.71875-27.894532 28.796874-34.609375 40.046874-3.453125 5.785157-9.53125 9.238282-16.261719 9.238282s-12.808594-3.453125-16.261719-9.238282c-6.710937-11.25-18.164062-27.328124-34.609375-40.046874-18.449218-14.265626-39.34375-21.5-62.097656-21.5zm0 0" />
                    </svg>
                    <div class="item-count-contain">
                      2
                    </div>
                  </a>
                </li>
                <li class="mobile-cart item-count">
                  <a href="cart.php">
                    <div class="cart-block">
                      <div class="cart-icon">
                        <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                          <g>
                            <path d="m497 401.667c-415.684 0-397.149.077-397.175-.139-4.556-36.483-4.373-34.149-4.076-34.193 199.47-1.037-277.492.065 368.071.065 26.896 0 47.18-20.377 47.18-47.4v-203.25c0-19.7-16.025-35.755-35.725-35.79l-124.179-.214v-31.746c0-17.645-14.355-32-32-32h-29.972c-17.64 0-31.99 14.351-31.99 31.99v31.594l-133.21-.232-9.985-54.992c-2.667-14.694-15.443-25.36-30.378-25.36h-68.561c-8.284 0-15 6.716-15 15s6.716 15 15 15c72.595 0 69.219-.399 69.422.719 16.275 89.632 5.917 26.988 49.58 306.416l-38.389.2c-18.027.069-32.06 15.893-29.81 33.899l4.252 34.016c1.883 15.06 14.748 26.417 29.925 26.417h26.62c-18.8 36.504 7.827 80.333 49.067 80.333 41.221 0 67.876-43.813 49.067-80.333h142.866c-18.801 36.504 7.827 80.333 49.067 80.333 41.22 0 67.875-43.811 49.066-80.333h31.267c8.284 0 15-6.716 15-15s-6.716-15-15-15zm-209.865-352.677c0-1.097.893-1.99 1.99-1.99h29.972c1.103 0 2 .897 2 2v111c0 8.284 6.716 15 15 15h22.276l-46.75 46.779c-4.149 4.151-10.866 4.151-15.015 0l-46.751-46.779h22.277c8.284 0 15-6.716 15-15v-111.01zm-30 61.594v34.416h-25.039c-20.126 0-30.252 24.394-16.014 38.644l59.308 59.342c15.874 15.883 41.576 15.885 57.452 0l59.307-59.342c14.229-14.237 4.13-38.644-16.013-38.644h-25.039v-34.254l124.127.214c3.186.005 5.776 2.603 5.776 5.79v203.25c0 10.407-6.904 17.4-17.18 17.4h-299.412l-35.477-227.039zm-56.302 346.249c0 13.877-11.29 25.167-25.167 25.167s-25.166-11.29-25.166-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167zm241 0c0 13.877-11.289 25.167-25.166 25.167s-25.167-11.29-25.167-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167z" />
                          </g>
                        </svg>
                      </div>
                      <div class="cart-item">
                        <h5>shopping</h5>
                        <h5>cart</h5>
                      </div>
                    </div>
                  </a>
                  <div class="item-count-contain">
                    <?php echo cart_count(); ?>
                  </div>
                </li>
              </ul>
            </div>
            <div class="menu-nav">
              <span class="toggle-nav">
                <i class="fa fa-bars "></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="searchbar-input">
      <div class="input-group">
        <span class="input-group-text">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932" style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
            <g>
              <path d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z" />
            </g>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="search your product">
        <span class="input-group-text close-searchbar">
          <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
            <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0" />
          </svg>
        </span>
      </div>
    </div>
  </div>
  <div class="category-header-2">
    <div class="custom-container">
      <div class="row">
        <div class="col-12">
          <div class="navbar-menu">
            <div class="logo-block">
              <div class="brand-logo logo-sm-center">
                <a href="index.php">
                  <img src="<?php echo $logo; ?>" class="img-fluid  " alt="logo">
                </a>
              </div>
            </div>

            <div class="nav-block">

              <div class="nav-left">
                <nav class="navbar" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent">
                  <button class="navbar-toggler" type="button">
                    <span class="navbar-icon"><i class="fa fa-arrow-down"></i></span>
                  </button>
                  <h5 class="mb-0  text-white title-font">Shop by category</h5>
                </nav>
                <div class="collapse  nav-desk" id="navbarToggleExternalContent">
                  <ul class="nav-cat title-font">
                    <li> <a href="products.php"><img src="https://www.iconbunny.com/icons/media/catalog/product/1/2/1208.9-checklist-icon-iconbunny.jpg" alt="category-product">View All Products</a></li>
                    <?php
                    $sqlDESK = "SELECT * FROM product_categories where product_cat_status='active' and store_id='$store_id' ORDER BY sortby ASC";
                    $query = mysqli_query($con, $sqlDESK);
                    $countcat = mysqli_num_rows($query);
                    while ($fetch =  mysqli_fetch_assoc($query)) {
                      $product_cat_idDESK[] = $fetch['product_cat_id'];
                    }

                    foreach ($product_cat_idDESK as $product_cat_id) {
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
                      <li> <a href="products.php?cat_id=<?php echo $product_cat_id; ?>"><img src="<?php echo $img_url; ?>/img/store_img/cat_img/<?php echo $category_img; ?>" alt="category-product"><?php echo $product_cat_title; ?></a></li>
                    <?php }  ?>
                  </ul>
                </div>
              </div>
            </div>
            <style>
              .dropdown-bar {
                position: absolute;
                z-index: 1;
                background: white;
                padding: 0.5rem 1rem;
                width: max-content;
                display: flex;
                flex-direction: column;
                right: -1rem;
                box-shadow: 0px 0px 2px grey !important;
                min-width: 206px !important;
                top: 2.2rem;
                display: none;
              }

              .dropdown-bar ul {
                display: flex;
                flex-direction: column;
              }

              .dropdown-bar ul li {
                font-size: 1rem;
                padding: 8px 3px;
                color: #1c3481;
                border-bottom-style: groove;
                border-width: thin;
              }

              .dropdown-bar ul li a {
                color: #1c3481;
                font-family: 'PT Sans';
              }

              .dropdown-bar ul li:hover a {
                text-shadow: 0px 0px 1px grey !important;
                font-weight: 700;
              }

              .icon-block:hover .dropdown-bar {
                display: block;
              }
            </style>
            <div class="icon-block" style="padding: 0.9%;">
              <ul>
                <li class="mobile-search">
                  <a href="javascript:void(0)">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 612.01 612.01" style="enable-background:new 0 0 612.01 612.01;" xml:space="preserve">
                      <g>
                        <g>
                          <g>
                            <path d="M606.209,578.714L448.198,423.228C489.576,378.272,515,318.817,515,253.393C514.98,113.439,399.704,0,257.493,0
                            C115.282,0,0.006,113.439,0.006,253.393s115.276,253.393,257.487,253.393c61.445,0,117.801-21.253,162.068-56.586
                            l158.624,156.099c7.729,7.614,20.277,7.614,28.006,0C613.938,598.686,613.938,586.328,606.209,578.714z M257.493,467.8
                            c-120.326,0-217.869-95.993-217.869-214.407S137.167,38.986,257.493,38.986c120.327,0,217.869,95.993,217.869,214.407
                            S377.82,467.8,257.493,467.8z" />
                          </g>
                        </g>
                      </g>
                    </svg>
                  </a>
                </li>
                <li class="mobile-user">
                  <?php if (isset($_SESSION['customer_id'])) { ?>
                    <a href="account.php">
                      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                          <g>
                            <path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240
                            c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z
                             M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z" />
                          </g>
                        </g>
                      </svg>

                      <div class="cart-item">
                        <div><?php echo $customer_name; ?></div>
                      </div>
                      <div class="dropdown-bar">
                        <ul>
                          <li><a href="account.php">My Account</a></li>
                          <li><a href="orders.php">My Orders</a></li>
                          <li><a href="address.php">My Addresses</a></li>
                          <li><a href="notifications.php">Notification</a></li>
                          <li><a href="account_settings.php">Acccount Settings</a></li>
                          <li><a href="logout.php">Log Out</a></li>
                        </ul>
                      </div>
                    </a>
                  <?php } else { ?>
                    <a href="login.php">
                      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                          <g>
                            <path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240
                            c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z" />
                          </g>
                        </g>
                        <g>
                          <g>
                            <path d="M297.833,301h-83.667C144.964,301,76.669,332.951,31,401.458V512h450V401.458C435.397,333.05,367.121,301,297.833,301z
                             M451.001,482H451H61v-71.363C96.031,360.683,152.952,331,214.167,331h83.667c61.215,0,118.135,29.683,153.167,79.637V482z" />
                          </g>
                        </g>
                      </svg>
                      <div class="cart-item">
                        <div>
                          Login/Signup
                        </div>
                      </div>
                    </a>
                  <?php } ?>
                </li>
                <li class="mobile-setting" onclick="openSetting()">
                  <a href="javascript:void(0)">
                    <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <path d="m272.066 512h-32.133c-25.989 0-47.134-21.144-47.134-47.133v-10.871c-11.049-3.53-21.784-7.986-32.097-13.323l-7.704 7.704c-18.659 18.682-48.548 18.134-66.665-.007l-22.711-22.71c-18.149-18.129-18.671-48.008.006-66.665l7.698-7.698c-5.337-10.313-9.792-21.046-13.323-32.097h-10.87c-25.988 0-47.133-21.144-47.133-47.133v-32.134c0-25.989 21.145-47.133 47.134-47.133h10.87c3.531-11.05 7.986-21.784 13.323-32.097l-7.704-7.703c-18.666-18.646-18.151-48.528.006-66.665l22.713-22.712c18.159-18.184 48.041-18.638 66.664.006l7.697 7.697c10.313-5.336 21.048-9.792 32.097-13.323v-10.87c0-25.989 21.144-47.133 47.134-47.133h32.133c25.989 0 47.133 21.144 47.133 47.133v10.871c11.049 3.53 21.784 7.986 32.097 13.323l7.704-7.704c18.659-18.682 48.548-18.134 66.665.007l22.711 22.71c18.149 18.129 18.671 48.008-.006 66.665l-7.698 7.698c5.337 10.313 9.792 21.046 13.323 32.097h10.87c25.989 0 47.134 21.144 47.134 47.133v32.134c0 25.989-21.145 47.133-47.134 47.133h-10.87c-3.531 11.05-7.986 21.784-13.323 32.097l7.704 7.704c18.666 18.646 18.151 48.528-.006 66.665l-22.713 22.712c-18.159 18.184-48.041 18.638-66.664-.006l-7.697-7.697c-10.313 5.336-21.048 9.792-32.097 13.323v10.871c0 25.987-21.144 47.131-47.134 47.131zm-106.349-102.83c14.327 8.473 29.747 14.874 45.831 19.025 6.624 1.709 11.252 7.683 11.252 14.524v22.148c0 9.447 7.687 17.133 17.134 17.133h32.133c9.447 0 17.134-7.686 17.134-17.133v-22.148c0-6.841 4.628-12.815 11.252-14.524 16.084-4.151 31.504-10.552 45.831-19.025 5.895-3.486 13.4-2.538 18.243 2.305l15.688 15.689c6.764 6.772 17.626 6.615 24.224.007l22.727-22.726c6.582-6.574 6.802-17.438.006-24.225l-15.695-15.695c-4.842-4.842-5.79-12.348-2.305-18.242 8.473-14.326 14.873-29.746 19.024-45.831 1.71-6.624 7.684-11.251 14.524-11.251h22.147c9.447 0 17.134-7.686 17.134-17.133v-32.134c0-9.447-7.687-17.133-17.134-17.133h-22.147c-6.841 0-12.814-4.628-14.524-11.251-4.151-16.085-10.552-31.505-19.024-45.831-3.485-5.894-2.537-13.4 2.305-18.242l15.689-15.689c6.782-6.774 6.605-17.634.006-24.225l-22.725-22.725c-6.587-6.596-17.451-6.789-24.225-.006l-15.694 15.695c-4.842 4.843-12.35 5.791-18.243 2.305-14.327-8.473-29.747-14.874-45.831-19.025-6.624-1.709-11.252-7.683-11.252-14.524v-22.15c0-9.447-7.687-17.133-17.134-17.133h-32.133c-9.447 0-17.134 7.686-17.134 17.133v22.148c0 6.841-4.628 12.815-11.252 14.524-16.084 4.151-31.504 10.552-45.831 19.025-5.896 3.485-13.401 2.537-18.243-2.305l-15.688-15.689c-6.764-6.772-17.627-6.615-24.224-.007l-22.727 22.726c-6.582 6.574-6.802 17.437-.006 24.225l15.695 15.695c4.842 4.842 5.79 12.348 2.305 18.242-8.473 14.326-14.873 29.746-19.024 45.831-1.71 6.624-7.684 11.251-14.524 11.251h-22.148c-9.447.001-17.134 7.687-17.134 17.134v32.134c0 9.447 7.687 17.133 17.134 17.133h22.147c6.841 0 12.814 4.628 14.524 11.251 4.151 16.085 10.552 31.505 19.024 45.831 3.485 5.894 2.537 13.4-2.305 18.242l-15.689 15.689c-6.782 6.774-6.605 17.634-.006 24.225l22.725 22.725c6.587 6.596 17.451 6.789 24.225.006l15.694-15.695c3.568-3.567 10.991-6.594 18.244-2.304z" />
                      <path d="m256 367.4c-61.427 0-111.4-49.974-111.4-111.4s49.973-111.4 111.4-111.4 111.4 49.974 111.4 111.4-49.973 111.4-111.4 111.4zm0-192.8c-44.885 0-81.4 36.516-81.4 81.4s36.516 81.4 81.4 81.4 81.4-36.516 81.4-81.4-36.515-81.4-81.4-81.4z" />
                    </svg>
                  </a>
                </li>
                <li class="mobile-cart item-count" onclick="openCart()">
                  <a href="javascript:void(0)">
                    <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                      <g>
                        <path d="m497 401.667c-415.684 0-397.149.077-397.175-.139-4.556-36.483-4.373-34.149-4.076-34.193 199.47-1.037-277.492.065 368.071.065 26.896 0 47.18-20.377 47.18-47.4v-203.25c0-19.7-16.025-35.755-35.725-35.79l-124.179-.214v-31.746c0-17.645-14.355-32-32-32h-29.972c-17.64 0-31.99 14.351-31.99 31.99v31.594l-133.21-.232-9.985-54.992c-2.667-14.694-15.443-25.36-30.378-25.36h-68.561c-8.284 0-15 6.716-15 15s6.716 15 15 15c72.595 0 69.219-.399 69.422.719 16.275 89.632 5.917 26.988 49.58 306.416l-38.389.2c-18.027.069-32.06 15.893-29.81 33.899l4.252 34.016c1.883 15.06 14.748 26.417 29.925 26.417h26.62c-18.8 36.504 7.827 80.333 49.067 80.333 41.221 0 67.876-43.813 49.067-80.333h142.866c-18.801 36.504 7.827 80.333 49.067 80.333 41.22 0 67.875-43.811 49.066-80.333h31.267c8.284 0 15-6.716 15-15s-6.716-15-15-15zm-209.865-352.677c0-1.097.893-1.99 1.99-1.99h29.972c1.103 0 2 .897 2 2v111c0 8.284 6.716 15 15 15h22.276l-46.75 46.779c-4.149 4.151-10.866 4.151-15.015 0l-46.751-46.779h22.277c8.284 0 15-6.716 15-15v-111.01zm-30 61.594v34.416h-25.039c-20.126 0-30.252 24.394-16.014 38.644l59.308 59.342c15.874 15.883 41.576 15.885 57.452 0l59.307-59.342c14.229-14.237 4.13-38.644-16.013-38.644h-25.039v-34.254l124.127.214c3.186.005 5.776 2.603 5.776 5.79v203.25c0 10.407-6.904 17.4-17.18 17.4h-299.412l-35.477-227.039zm-56.302 346.249c0 13.877-11.29 25.167-25.167 25.167s-25.166-11.29-25.166-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167zm241 0c0 13.877-11.289 25.167-25.166 25.167s-25.167-11.29-25.167-25.167 11.29-25.167 25.167-25.167 25.166 11.291 25.166 25.167z" />
                      </g>
                    </svg>
                  </a>
                  <div class="item-count-contain">
                    <?php echo cart_count(); ?>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="searchbar-input">
      <div class="input-group">
        <span class="input-group-text">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="28.931px" height="28.932px" viewBox="0 0 28.931 28.932" style="enable-background:new 0 0 28.931 28.932;" xml:space="preserve">
            <g>
              <path d="M28.344,25.518l-6.114-6.115c1.486-2.067,2.303-4.537,2.303-7.137c0-3.275-1.275-6.355-3.594-8.672C18.625,1.278,15.543,0,12.266,0C8.99,0,5.909,1.275,3.593,3.594C1.277,5.909,0.001,8.99,0.001,12.266c0,3.276,1.275,6.356,3.592,8.674c2.316,2.316,5.396,3.594,8.673,3.594c2.599,0,5.067-0.813,7.136-2.303l6.114,6.115c0.392,0.391,0.902,0.586,1.414,0.586c0.513,0,1.024-0.195,1.414-0.586C29.125,27.564,29.125,26.299,28.344,25.518z M6.422,18.111c-1.562-1.562-2.421-3.639-2.421-5.846S4.86,7.983,6.422,6.421c1.561-1.562,3.636-2.422,5.844-2.422s4.284,0.86,5.845,2.422c1.562,1.562,2.422,3.638,2.422,5.845s-0.859,4.283-2.422,5.846c-1.562,1.562-3.636,2.42-5.845,2.42S7.981,19.672,6.422,18.111z" />
            </g>
          </svg>
        </span>
        <input type="text" class="form-control" placeholder="search your product">
        <span class="input-group-text close-searchbar">
          <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
            <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0" />
          </svg>
        </span>
      </div>
    </div>
  </div>
</header>
<!--header end-->
<!--header end-->
<style>
  @media only screen and (max-width: 600px) {
    .product .product-box .product-imgbox img {
      position: relative;
      overflow: hidden;
      height: auto !important;
      padding-top: 1rem;
      width: 100% !important;
      border-radius: 5px !important;
    }

    .product .product-box .product-detail .detail-title h2 {
      font-size: 0.8rem !important;
    }

    .product .product-box .product-imgbox {
      padding: 1px !important;
      width: 12rem !important;
      height: 12rem !important;
      margin-bottom: 1rem !important;
    }
  }

  @media only screen and (min-width: 385px) {
    .product .product-box .product-imgbox img {
      position: relative;
      overflow: hidden;
      height: auto !important;
      padding-top: 1rem;
      width: 100% !important;
      border-radius: 5px !important;
    }
  }

  @media only screen and (max-width: 385px) {
    .product .product-box .product-imgbox img {
      position: relative;
      overflow: hidden;
      height: auto !important;
      padding-top: 1rem;
      width: 100% !important;
      border-radius: 5px !important;
    }

    .product .product-box .product-detail .detail-title h2 {
      font-size: 0.7rem !important;
    }
  }

  @media only screen and (min-width: 306px) {
    .product .product-box .product-imgbox img {
      position: relative;
      overflow: hidden;
      height: auto !important;
      padding-top: 0.5rem;
      width: 100% !important;
      border-radius: 5px !important;
    }

    .product .product-box .product-detail .detail-title h2 {
      font-size: 1rem !important;
    }
  }

  @media only screen and (min-width: 430px) {
    .product .product-box .product-detail .detail-title h2 {
      font-size: 1rem !important;
    }
  }

  .product .product-box .product-detail .detail-title .detail-right .price {
    margin-left: 0px !important;
  }

  .product .product-box .product-detail .detail-title h4 {
    font-size: 0.8rem !important;
  }

  .product .product-box .product-imgbox {
    background-color: white !important;
  }
</style>
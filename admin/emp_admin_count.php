<!-- Grouped multiple cards for statistics starts here -->
<div class="row grouped-multiple-statistics-card">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="row">

           <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <a href="tasks.php">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon primary d-flex justify-content-center mr-3">
                <i class="icon p-1 fa fa-phone customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">
                 <?php 
                 $user_id = $_SESSION['user_id'];
                 $sql = "SELECT * from taska where tasks_status='HOT' and tasks_assign_id='$user_id'";
                 $query  = mysqli_query($con, $sql);
                 $count_hot_calls = mysqli_num_rows($query);
                 if ($count_hot_calls == 0) {
                   echo "0";
                 } else {
                  echo $count_hot_calls;
                 }
                 ?>
                </h3>
                <p class="sub-heading">Self Assign</p>
              </div>
            </div>
            <hr>
          </a>
          </div>


           <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <a href="tasks.php">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon success d-flex justify-content-center mr-3">
                <i class="icon p-1 fa fa-phone customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">
                 <?php 
                 $user_id = $_SESSION['user_id'];
                 $sql = "SELECT * from taska where tasks_status='HOT' and tasks_executer_id='$user_id'";
                 $query  = mysqli_query($con, $sql);
                 $count_hot_calls = mysqli_num_rows($query);
                 if ($count_hot_calls == 0) {
                   echo "0";
                 } else {
                  echo $count_hot_calls;
                 }
                 ?>
                </h3>
                <p class="sub-heading">HOT Calls</p>
              </div>
            </div>
            <hr>
          </a>
          </div>

          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon warning d-flex justify-content-center mr-3">
                <i class="icon p-1 fa fa-phone customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">
                   <?php 
                 $sql = "SELECT * from taska where tasks_status='WARM' and tasks_executer_id='$user_id'";
                 $query  = mysqli_query($con, $sql);
                 $count_hot_calls = mysqli_num_rows($query);
                 if ($count_hot_calls == 0) {
                   echo "0";
                 } else {
                  echo $count_hot_calls;
                 }
                 ?>
                </h3>
                <p class="sub-heading">WARM Calls</p>
              </div>
            </div>
            <hr>
          </div>

          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon danger d-flex justify-content-center mr-3">
                <i class="icon p-1 fa fa-phone customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">
                  <?php 
                 $sql = "SELECT * from taska where tasks_status='COLD' and tasks_executer_id='$user_id'";
                 $query  = mysqli_query($con, $sql);
                 $count_hot_calls = mysqli_num_rows($query);
                 if ($count_hot_calls == 0) {
                   echo "0";
                 } else {
                  echo $count_hot_calls;
                 }
                 ?>
                </h3>
                <p class="sub-heading">COLD Calls</p>
              </div>
            </div>
            <hr>
          </div>

          <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
            <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
              <span class="card-icon success d-flex justify-content-center mr-3">
                <i class="icon p-1 fa fa-star customize-icon font-large-2 p-1"></i>
              </span>
              <div class="stats-amount mr-3">
                <h3 class="heading-text text-bold-600">
                   <?php 
                 $sql = "SELECT * from taska where tasks_status='SALE' and tasks_executer_id='$user_id'";
                 $query  = mysqli_query($con, $sql);
                 $count_hot_calls = mysqli_num_rows($query);
                 if ($count_hot_calls == 0) {
                   echo "0";
                 } else {
                  echo $count_hot_calls;
                 }
                 ?>
                </h3>
                <p class="sub-heading">Sales</p>
              </div>
            </div>
            <hr>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- Grouped multiple cards for statistics ends here -->

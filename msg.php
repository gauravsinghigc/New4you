<?php
$Time = "2000";

if (isset($_GET['msg'])) {
      $msg = $_GET['msg'];
      if ($msg == "login") { ?>
            <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
                  <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
                        <i class="fa fa-times"></i>
                  </h4>
                  <p class="mb-0">
                        <span class="font-14">
                              <?php echo $_GET['login']; ?>
                        </span>
                        <br><br>
                        <a href="#" onclick="HideMsgNote()">Dismiss</a>
                  </p>

                  <script>
                        setTimeout(function() {
                              $("#MsgArea1").fadeOut("slow");
                        }, <?php echo $Time; ?>);
                  </script>
            </div>
            <script>
                  function HideMsgNote() {
                        document.getElementById("MsgArea1").style.display = "none";
                  }
            </script>
      <?php } elseif ($msg == "logout") { ?>
            <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
                  <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
                        <i class="fa fa-times"></i>
                  </h4>
                  <p class="mb-0">
                        <span class="font-14">
                              <?php echo $_GET['msg']; ?>
                        </span>
                        <br><br>
                        <a href="#" onclick="HideMsgNote()">Dismiss</a>
                  </p>

                  <script>
                        setTimeout(function() {
                              $("#MsgArea1").fadeOut("slow");
                        }, <?php echo $Time; ?>);
                  </script>
            </div>
            <script>
                  function HideMsgNote() {
                        document.getElementById("MsgArea1").style.display = "none";
                  }
            </script>
      <?php } elseif ($msg == "logout") { ?>
            <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
                  <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
                        <i class="fa fa-times"></i>
                  </h4>
                  <p class="mb-0">
                        <span class="font-14">
                              <?php echo $_GET['logout']; ?>
                        </span>
                        <br><br>
                        <a href="#" onclick="HideMsgNote()">Dismiss</a>
                  </p>

                  <script>
                        setTimeout(function() {
                              $("#MsgArea1").fadeOut("slow");
                        }, <?php echo $Time; ?>);
                  </script>
            </div>
            <script>
                  function HideMsgNote() {
                        document.getElementById("MsgArea1").style.display = "none";
                  }
            </script>
      <?php } elseif ($msg == "register") { ?>
            <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
                  <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
                        <i class="fa fa-times"></i>
                  </h4>
                  <p class="mb-0">
                        <span class="font-14">
                              <?php echo $_GET['register']; ?>
                        </span>
                        <br><br>
                        <a href="#" onclick="HideMsgNote()">Dismiss</a>
                  </p>

                  <script>
                        setTimeout(function() {
                              $("#MsgArea1").fadeOut("slow");
                        }, <?php echo $Time; ?>);
                  </script>
            </div>
            <script>
                  function HideMsgNote() {
                        document.getElementById("MsgArea1").style.display = "none";
                  }
            </script>
      <?php } elseif ($msg == "updated") { ?>
            <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
                  <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
                        <i class="fa fa-times"></i>
                  </h4>
                  <p class="mb-0">
                        <span class="font-14">
                              <?php echo $_GET['updated']; ?>
                        </span>
                        <br><br>
                        <a href="#" onclick="HideMsgNote()">Dismiss</a>
                  </p>

                  <script>
                        setTimeout(function() {
                              $("#MsgArea1").fadeOut("slow");
                        }, <?php echo $Time; ?>);
                  </script>
            </div>
            <script>
                  function HideMsgNote() {
                        document.getElementById("MsgArea1").style.display = "none";
                  }
            </script>
      <?php } elseif ($msg == "unmatched") { ?>
            <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
                  <h4 class="bg-warning p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Failed!
                        <i class="fa fa-times"></i>
                  </h4>
                  <p class="mb-0">
                        <span class="font-14">
                              <?php echo $_GET['unmatched']; ?>
                        </span>
                        <br><br>
                        <a href="#" onclick="HideMsgNote()">Dismiss</a>
                  </p>

                  <script>
                        setTimeout(function() {
                              $("#MsgArea1").fadeOut("slow");
                        }, <?php echo $Time; ?>);
                  </script>
            </div>
            <script>
                  function HideMsgNote() {
                        document.getElementById("MsgArea1").style.display = "none";
                  }
            </script>
      <?php }
} elseif (isset($_GET['err'])) {
      $err = $_GET['err'];   ?>
      <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
            <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Error!
                  <i class="fa fa-times"></i>
            </h4>
            <p class="mb-0">
                  <span class="font-14">
                        <?php echo $_GET['err']; ?>
                  </span>
                  <br><br>
                  <a href="#" onclick="HideMsgNote()">Dismiss</a>
            </p>

            <script>
                  setTimeout(function() {
                        $("#MsgArea1").fadeOut("slow");
                  }, <?php echo $Time; ?>);
            </script>
      </div>
      <script>
            function HideMsgNote() {
                  document.getElementById("MsgArea1").style.display = "none";
            }
      </script>
<?php } elseif (isset($_GET['data'])) {
      $data = $_GET['data'];   ?>
      <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
            <h4 class="bg-info p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Notification!
                  <i class="fa fa-times"></i>
            </h4>
            <p class="mb-0">
                  <span class="font-14">
                        <?php echo $_GET['data']; ?>
                  </span>
                  <br><br>
                  <a href="#" onclick="HideMsgNote()">Dismiss</a>
            </p>

            <script>
                  setTimeout(function() {
                        $("#MsgArea1").fadeOut("slow");
                  }, <?php echo $Time; ?>);
            </script>
      </div>
      <script>
            function HideMsgNote() {
                  document.getElementById("MsgArea1").style.display = "none";
            }
      </script>
<?php } ?>
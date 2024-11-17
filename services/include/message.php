<?php if (isset($_SESSION['success'])) { ?>
  <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea1">
    <audio controls autoplay hidden="">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/success.mp3" type="audio/ogg">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/success.mp3" type="audio/ogg">
    </audio>
    <h4 class="bg-success p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-check-circle"></i> Success!
      <i class="fa fa-times"></i>
    </h4>
    <p class="mb-0">
      <span class="font-14">
        <?php echo $_SESSION['success']; ?>
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

<?php unset($_SESSION['success']);
} elseif (isset($_SESSION['info'])) { ?>

  <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea2">
    <audio controls autoplay hidden="">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/info.mp3" type="audio/ogg">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/info.mp3" type="audio/ogg">
    </audio>
    <h4 class="bg-info p-3 text-white" onclick="HideMsgNote()"><i class="fa fa-bell"></i> Notification
      <i class="fa fa-times"></i>
    </h4>
    <p class="mb-0">
      <span class="font-14">
        <?php echo $_SESSION['info']; ?>
      </span>
      <br><br>
      <a href="#" onclick="HideMsgNote()">Dismiss</a>
    </p>
    <script>
      setTimeout(function() {
        $("#MsgArea2").fadeOut("slow");
      }, <?php echo $Time; ?>);
    </script>
  </div>
  <script>
    function HideMsgNote() {
      document.getElementById("MsgArea2").style.display = "none";
    }
  </script>
  <?php if (!empty($_SESSION['info'])) {
    unset($_SESSION['info']);
  }
} elseif (isset($_SESSION['warning'])) { ?>

  <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea3">
    <audio controls autoplay hidden="">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/danger.mp3" type="audio/ogg">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/danger.mp3" type="audio/ogg">
    </audio>
    <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()">Failed
      <i class="fa fa-times"></i>
    </h4>
    <p class="mb-0">
      <span class="font-14">
        <?php echo $_SESSION['warning']; ?>
      </span>
      <br><br>
      <a href="#" onclick="HideMsgNote()">Dismiss</a>
    </p>
    <script>
      setTimeout(function() {
        $("#MsgArea3").fadeOut("slow");
      }, <?php echo $Time; ?>);
    </script>
  </div>
  <script>
    function HideMsgNote() {
      document.getElementById("MsgArea3").style.display = "none";
    }
  </script>
  <?php if (!empty($_SESSION['warning'])) {
    unset($_SESSION['warning']);
  }
} elseif (isset($_SESSION['danger'])) { ?>
  <div class="text-black border-circle mb-4 square p-2 notification-box" id="MsgArea4">
    <audio controls autoplay hidden="">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/warning.mp3" type="audio/ogg">
      <source src="<?php echo $APP_DOMAIN; ?>/storage/sys-tone/warning.mp3" type="audio/ogg">
    </audio>
    <h4 class="bg-danger p-3 text-white" onclick="HideMsgNote()"> <i class="fa fa-warning"></i> Something Went Wrong!
      <i class="fa fa-times"></i>
    </h4>
    <p class="mb-0">
      <span class="font-14">
        <?php echo $_SESSION['danger']; ?>
      </span>
      <br><br>
      <a href="#" onclick="HideMsgNote()">Dismiss</a>
    </p>
    <script>
      setTimeout(function() {
        $("#MsgArea4").fadeOut("slow");
      }, <?php echo $Time; ?>);
    </script>
  </div>
  <script>
    function HideMsgNote() {
      document.getElementById("MsgArea4").style.display = "none";
    }
  </script>
<?php if (!empty($_SESSION['danger'])) {
    unset($_SESSION['danger']);
  }
} else {
}
?>
<div class="time p-2 flex-c">
  <div id="clock" class="display-8">8:10:45</div>
  <span class="display-8"> &nbsp;|&nbsp; </span>
  <span class="text-center p-1 display-9 m-b-3"><?php echo date("d D M, Y"); ?></span>
  <script>
    setInterval(showTime, 1000);

    function showTime() {
      let time = new Date();
      let hour = time.getHours();
      let min = time.getMinutes();
      let sec = time.getSeconds();
      am_pm = "AM ";

      if (hour > 12) {
        hour -= 12;
        am_pm = " PM";
      }
      if (hour == 0) {
        hr = 12;
        am_pm = " AM";
      }

      hour = hour < 10 ? "0" + hour : hour;
      min = min < 10 ? "0" + min : min;
      sec = sec < 10 ? "0" + sec : sec;

      let currentTime = hour + ":" +
        min + ":" + sec + am_pm + "";

      document.getElementById("clock")
        .innerHTML = currentTime + " ";
    }

    showTime();
  </script>
</div>
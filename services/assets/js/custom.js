$(document).ready(function () {
  var count_particles, stats, update;
  stats = new Stats();
  stats.setMode(0);
  stats.domElement.style.position = "relative";
  stats.domElement.style.left = "0px";
  stats.domElement.style.top = "0px";
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector(".js-count-particles");
  update = function () {
    stats.begin();
    stats.end();
    if (
      window.pJSDom[0].pJS.particles &&
      window.pJSDom[0].pJS.particles.array
    ) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
});

var i = 0;
var WelcomeText = "Welcome at GauravinghigC, where we are ";
var speed = 60; /* The speed/duration of the effect in milliseconds */
window.onload = function () {
  typeWriter();
};

function typeWriter() {
  if (i < WelcomeText.length) {
    document.getElementById("WelcomeText").innerHTML += WelcomeText.charAt(i);
    i++;
    setTimeout(typeWriter, speed);
  }
}

$(document).ready(function () {
  // Add smooth scrolling to all links
  $("a").on("click", function (event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top,
        },
        2000,
        function () {
          // Add hash (#) to URL when done scrolling (default click behavior)
          window.location.hash = hash;
        }
      );
    } // End if
  });
});

//orders view
    $("#ActiveBTN").click(function() {
      document.getElementById("ActiveBTN").classList.add("btn-dark");
      document.getElementById("ActiveBTN").classList.remove("btn-outline-dark");
      document.getElementById("CompletedOrders").style.display = "none";
      document.getElementById("ScheduledOrders").style.display = "none";
      document.getElementById("ActiveOrders").style.display = "block";
      document.getElementById("supportorders").style.display = "none";

      document.getElementById("ScheduledBTN").classList.add("btn-outline-dark");
      document.getElementById("CompletedBTN").classList.add("btn-outline-dark");
      document.getElementById("HelpBTN").classList.add("btn-outline-dark");

      document.getElementById("ScheduledBTN").classList.remove("btn-dark");
      document.getElementById("CompletedBTN").classList.remove("btn-dark");
      document.getElementById("HelpBTN").classList.remove("btn-dark");
    });
    $("#ScheduledBTN").click(function() {
      document.getElementById("ScheduledBTN").classList.add("btn-dark");
      document.getElementById("ScheduledBTN").classList.remove("btn-outline-dark");
      document.getElementById("CompletedOrders").style.display = "none";
      document.getElementById("ScheduledOrders").style.display = "block";
      document.getElementById("ActiveOrders").style.display = "none";
      document.getElementById("supportorders").style.display = "none";

      document.getElementById("ActiveBTN").classList.add("btn-outline-dark");
      document.getElementById("CompletedBTN").classList.add("btn-outline-dark");
      document.getElementById("HelpBTN").classList.add("btn-outline-dark");

      document.getElementById("ActiveBTN").classList.remove("btn-dark");
      document.getElementById("CompletedBTN").classList.remove("btn-dark");
      document.getElementById("HelpBTN").classList.remove("btn-dark");
    });
    $("#CompletedBTN").click(function() {
      document.getElementById("CompletedBTN").classList.add("btn-dark");
      document.getElementById("CompletedBTN").classList.remove("btn-outline-dark");
      document.getElementById("CompletedOrders").style.display = "block";
      document.getElementById("ScheduledOrders").style.display = "none";
      document.getElementById("ActiveOrders").style.display = "none";
      document.getElementById("supportorders").style.display = "none";

      document.getElementById("ScheduledBTN").classList.add("btn-outline-dark");
      document.getElementById("ActiveBTN").classList.add("btn-outline-dark");
      document.getElementById("HelpBTN").classList.add("btn-outline-dark");

      document.getElementById("ScheduledBTN").classList.remove("btn-dark");
      document.getElementById("ActiveBTN").classList.remove("btn-dark");
      document.getElementById("HelpBTN").classList.remove("btn-dark");
    });
    $("#HelpBTN").click(function() {
      document.getElementById("HelpBTN").classList.add("btn-dark");
      document.getElementById("HelpBTN").classList.remove("btn-outline-dark");
      document.getElementById("CompletedOrders").style.display = "none";
      document.getElementById("ScheduledOrders").style.display = "none";
      document.getElementById("ActiveOrders").style.display = "none";
      document.getElementById("supportorders").style.display = "block";

      document.getElementById("ScheduledBTN").classList.add("btn-outline-dark");
      document.getElementById("CompletedBTN").classList.add("btn-outline-dark");
      document.getElementById("ActiveBTN").classList.add("btn-outline-dark");

      document.getElementById("ScheduledBTN").classList.remove("btn-dark");
      document.getElementById("CompletedBTN").classList.remove("btn-dark");
      document.getElementById("ActiveBTN").classList.remove("btn-dark");
    });


  //loader view
  //loader script
 document.onreadystatechange = function() {
  if (document.readyState !== "complete") {
   document.querySelector("body").style.visibility = "hidden";
   document.querySelector("#loader").style.visibility = "visible";
  } else {
   document.querySelector("#loader").style.display = "none";
   document.querySelector("body").style.visibility = "visible";
  }
 };

 
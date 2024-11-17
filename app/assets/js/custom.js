//Dropwdown Navbar
$('ul.nav li.dropdown').hover(function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
    $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});


//Slider affects
$('.carousel').carousel({
    interval: 2000
})

.carousel('cycle')

//toast
var toastElList = [].slice.call(document.querySelectorAll('.toast'))
var toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl, option)
})

//pwl coroselo
$(document).ready(function() {
    $(".owl-carousel").owlCarousel();
});

function LoginClick() {
    document.getElementById("LoginRequest").innerHTML = "<i class='fa fa-refresh fa-spin'></i> Loading...";
}

//login action
function CustomerAction() {
    var LoginForm = document.getElementById("LoginForm");
    var SignupForm = document.getElementById("SignupForm");
    if (LoginForm.style.display === "none") {
        LoginForm.style.display = "block";
        SignupForm.style.display = "none";
        document.getElementById("ActionName").innerHTML = " Create an Account";
    } else {
        SignupForm.style.display = "block";
        LoginForm.style.display = "none";
        document.getElementById("ActionName").innerHTML = " Already Have an Account?";
    }
}

function Hide() {
    document.getElementById("MSG").style.display = "none";
}

function ShowSideBar() {
    if (document.getElementById("sidebar").style.display === "block") {
        document.getElementById("sidebar").style.display = "none";
        document.getElementById("bakcbf").style.display = "none";
    } else {
        document.getElementById("sidebar").style.display = "block";
        document.getElementById("bakcbf").style.display = "block";
    }
}


function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
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
                b.innerHTML += "<i class='fa fa-search' style='float:left;font-size:12px;margin-top: 3px;padding-right: 2%;'></i><input type='hidden' value='" + arr[i] + "'>";
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

function HideMsg() {
    document.getElementById("MsgArea").style.display = "none !important;";
}

function LoginAction() {
    var LoginPhoneNumber = document.getElementById("LoginPhoneNumber");
    var CustomerPassword = document.getElementById("CustomerPassword");


    if (CustomerPassword.value == "") {
        document.getElementById("LoginErrorPassMsg").innerHTML = "* Please Enter Password...";
    }

    if (LoginPhoneNumber.value == "") {
        document.getElementById("LoginErrorPhoneMsg").innerHTML = "* Please Enter Phone Number...";
    }

    if (LoginPhoneNumber.value != "" && CustomerPassword.value != "") {
        document.getElementById("LoginAction").innerHTML = "<i class='fa fa-spinner fa-spin'></i> Checking Phone & Password...";
    }
}

function RegisterAction() {
    var RegCustomerName = document.getElementById("RegCustomerName");
    var RegCustomerPhone = document.getElementById("RegCustomerPhone");
    var RegCustomerEmail = document.getElementById("RegCustomerEmail");
    var RegCustomerPass = document.getElementById("RegCustomerPass");
    var RegCustomerPass2 = document.getElementById("RegCustomerPass2");

    if (RegCustomerName.value == "") {
        document.getElementById("CustomerNameMsg").innerHTML = "* Please Enter Your Name...";
    } else {
        document.getElementById("CustomerNameMsg").innerHTML = "";
    }

    if (RegCustomerPhone.value == "") {
        document.getElementById("CustomerPhoneMsg").innerHTML = "* Please Enter Your Phone...";
    } else {
        document.getElementById("CustomerPhoneMsg").innerHTML = "";
    }

    if (RegCustomerEmail.value == "") {
        document.getElementById("CustomerEmailMsg").innerHTML = "* Please Enter Your Email id...";
    } else {
        document.getElementById("CustomerEmailMsg").innerHTML = "";
    }

    if (RegCustomerPass.value == "") {
        document.getElementById("CustomerPasswordMsg").innerHTML = "* Please Enter Your Password...";
    } else {
        document.getElementById("CustomerPasswordMsg").innerHTML = "";
    }

    if (RegCustomerPass2.value == "") {
        document.getElementById("CustomerPasswordMsg2").innerHTML = "* Please Re-Enter Your Password...";
    } else {
        document.getElementById("CustomerPasswordMsg2").innerHTML = "";
    }

    if (RegCustomerPass.value != RegCustomerPass2.value) {
        document.getElementById("PasswordNotMatch").innerHTML = "* Password Do not match...";
    }

    if (RegCustomerName.value != "" && RegCustomerPhone.value != "" && RegCustomerEmail.value != "" && RegCustomerPass.value != "" && RegCustomerPass2.value != "") {
        document.getElementById("RegisterAction").innerHTML = "<i class='fa fa-spinner fa-spin'></i> Please wait while creating account...";
    }

}

function CheckPassword() {
    var RegCustomerPass = document.getElementById("RegCustomerPass");
    var RegCustomerPass2 = document.getElementById("RegCustomerPass2");
    if (RegCustomerPass.value == RegCustomerPass2.value && RegCustomerPass.value != "" && RegCustomerPass2.value != "") {
        document.getElementById("PasswordNotMatch").className = "text-success font-5";
        document.getElementById("PasswordNotMatch").innerHTML = "* Password Matched!";
        document.getElementById("RegBtn").className = "btn btn-success btn-md KLoginButton btn-block mb-0 bottom-text";
    } else {
        document.getElementById("PasswordNotMatch").innerHTML = "* Password Do Not Match!";
        document.getElementById("RegBtn").className = "btn btn-success btn-md KLoginButton btn-block mb-0 bottom-text disabled";
    }
}
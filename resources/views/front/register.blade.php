
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Shopping</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="bootstrap.css" type="text/css" />
<!-- Fancy Box -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn, .signupbtn {
  float: left;
  width: 50%;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
     width: 100%;
  }
}
</style>
</head>
<body>

  <!-- Desktop Header -->
@include('front.header')

   <section>
       
       <div class="container col-md-6 mx-auto">
            <div class="row">
               <div class="col-md-12"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
       <form action="{{ route('front.registerdata') }}" style="border:1px solid #ccc" method="POST">
           
            <div class="container">
                {{ csrf_field() }}
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
            
                <label for="email"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" required>
                
                <label for="email"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" required>
                
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>
                
                <label for="email"><b>Mobile</b></label>
                <input type="text" placeholder="Enter Mobile" name="mobile" required>
            
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
            
                
                
                <label>
                  <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                </label>
                
                <p>Already register then click on <a href="{{route('front.login')}}" style="color:dodgerblue">Log In</a>.</p>
            
                <div class="clearfix">
                  
                  <button type="submit" class="signupbtn float-right">Sign Up</button>
                </div>
            </div>
        </form>
        </div>
    </section>


@include('front.footer')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>  -->

<script>
var interleaveOffset = 0.5;

var swiperOptions = {
loop: true,
speed: 1000,
grabCursor: true,
autoplay: true,
watchSlidesProgress: true,
mousewheelControl: true,
keyboardControl: true,
navigation: {
nextEl: ".swiper-button-next",
prevEl: ".swiper-button-prev"
},
on: {
progress: function() {
  var swiper = this;
  for (var i = 0; i < swiper.slides.length; i++) {
    var slideProgress = swiper.slides[i].progress;
    var innerOffset = swiper.width * interleaveOffset;
    var innerTranslate = slideProgress * innerOffset;
    swiper.slides[i].querySelector(".slide-inner").style.transform =
      "translate3d(" + innerTranslate + "px, 0, 0)";
  }      
},
touchStart: function() {
  var swiper = this;
  for (var i = 0; i < swiper.slides.length; i++) {
    swiper.slides[i].style.transition = "";
  }
},
setTransition: function(speed) {
  var swiper = this;
  for (var i = 0; i < swiper.slides.length; i++) {
    swiper.slides[i].style.transition = speed + "ms";
    swiper.slides[i].querySelector(".slide-inner").style.transition =
      speed + "ms";
  }
}
}
};

var swiper = new Swiper(".swiper-container", swiperOptions);

</script> 
<script>
$(document).ready(function() {
$(".gallery").magnificPopup({
delegate: "a",
type: "image",
tLoading: "Loading image #%curr%...",
mainClass: "mfp-img-mobile",
gallery: {
enabled: true,
navigateByImgClick: true,
preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
},
image: {
tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
}
});
});
</script>
<script>
$(document).ready(function(){
$('.customer-logos').slick({
slidesToShow: 6,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 1500,
arrows: false,
dots: false,
pauseOnHover: false,
responsive: [{
breakpoint: 768,
settings: {
    slidesToShow: 4
}
}, {
breakpoint: 520,
settings: {
    slidesToShow: 3
}
}]
});
});

const scrollHeader = document.querySelector(".Header__upperHeader");
window.addEventListener("scroll", function(){
const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
if (currentScroll > 56) {
scrollHeader.classList.add('fixed-header');
}
else {
scrollHeader.classList.remove('fixed-header');
}
});



</script>
<script>
    var $loginForm = $(".form-signin"),
    $login_text_fields = $loginForm.find("input[type='text']");

	$(".login-logo,.form-container").removeClass("off-canvas");

    $loginForm.validate({
      errorElement: "span",
      success: function(label) {
        _form_success_aria(label);
      },
      invalidHandler : function(event, validator){
        _form_error_aria(event);
      }
    });

    function _form_success_aria(label){
      var target = label.parent().find("input");
      target.attr("aria-invalid","false");
    }

    function _form_error_aria(validator){
 		console.log(validator.target.elements[0]);
    }
</script>
</body>
</html>
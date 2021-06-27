<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Shopping - Home</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/carousel.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/owl-carousel.css') }}">
<!-- Google Font -->

<!-- Fancy Box -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
</head>
<style>
    .containerdata {
  position: relative;
 text-align: center;
  color: white;
}
.top-left {
  position: absolute;
  top: 300px;
  left: 100px;
  
}
.swiper-slide img {
    display: block;
    width: 100%;
    height: 100% !important;
}
.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #495057;
    background-color: #ffc107;
    border-color: #dee2e6 #dee2e6 #fff;
}

.nav-tabs {
    border-bottom: 1px solid #dee2e6;
   padding-left: 100px !important;
}

</style>
<body>

  <!-- Desktop Header -->
@include('front.header')
@php
$banners = \app\Http\Controllers\Front::banner();
$setting = \app\Http\Controllers\Front::setting();
$currency = $setting->data->currency;
@endphp

<div class="slider-wrapper">
<div class="container-fluid padding0">
<div class="swiper-container">
<div class="swiper-wrapper">
@foreach($banners as $banner)
    <div class="swiper-slide">
    <div class="slide-inner containerdata">
      <img src="{{ $banner->websitebanner }}" class="img-fluid"> 
      <div class="top-left">{{ $banner->title }}</div>
    </div>
    </div>
@endforeach

</div>
<div class="swiper-button-next swiper-button-white"></div>
<div class="swiper-button-prev swiper-button-white"></div>
</div>
</div>
</div>
 @if(session()->has('success_message'))
 <script> Swal({
                title: 'Please Wait !',
                html: 'data uploading',// add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });</script>
 @endif
<!-- End -->






<!-- Section -->
<section class="spec_wrapper">
<div class="container">
<div class="row">

<div class="abtcolimg">
<img loading="lazy" src="{{ asset('assets/images/home.png')}}" alt="Doors" class="abtimg">

</div>






<div class="abtcol">
<p><h2 style="text-shadow: 2px 2px 5px black">Gehoben Doors - Your security is a door away</h2></p>
<hr color="black">
<p>We “Gehoben Builders Pvt. Ltd.,”, operational since January 1990 specialize in manufacturing and supply of branded high definition  Steel Doors which conform to the international quality standard, our head office is located in Kerala ,India owing land of 163,353 sq.ft. area with commercial building. The International corporate office is in Dubai & Sharjah – UAE undertaking world-wide export business.</p>

<p>We are an ISO certified company having more than 100 plus channel partners, and have Overseas corporate offices. The Gehoben steel doors are crafted from GI of international standards and have excellent security of several locking points with anti-theft locking system. We provide 5 Years warranty on the locking system and hardware.</p>

<p><b><center>All doors are UV protected and highly durable. The Gehoben Steel Doors are 20% - 50% inexpensive than normal wooden doors.</center></b></p>
<hr color="black">

</div>
</div>
</div>
</section>


<section class="spec_wrapper">
    <div class="container">
       
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h4>Steel Door Products</h4>
        <hr>
        </div>
    </div>

        <div class="container-fluid">
            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner row w-100 mx-auto" role="listbox">
                    <?php  foreach($steelproduct as $key => $productfinalval) {
                    	if($productfinalval->product_category == 6){ 
                    	    
                    	    if($productfinalval->regular_price != '')
                            {
                               $price = $productfinalval->regular_price;
                            }else
                            {
                               $price = $productfinalval->sale_price;
                            }
                    	?>
                    
                    <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                    <div class="card-carousel">
                         <a href="{{route('front.productdetail',$productfinalval->id)}}"> 
                    <img src="{{  $productfinalval->product_media }}" class="img-fluid mx-auto d-block" alt="img1">
                    <p>{{  $productfinalval->product_name }}</p>
                    </a>
                    <p class="price">Rs. {{$price}}</p>
                    <p>Gehoben has introduced a revolutionary range of products to keep your loved ones safe and secure.</p>
                    <p><button>Add to Cart</button></p>
                    </div>
                    
                    </div>
                    <?php }
                    
                    }
                    ?>
                </div>
            </div>
        </div>
    
    </div>
</section>
<section class="spec_wrapper">
<div class="container">
<div class="row">
<div class="col-lg-4  col-md-4 col-sm-6 col-12">
<div class="circle-inner-wrappper">
<div class="circle-icon">
  <img src="{{ asset('assets/images/trolley.png') }}" class="img-fluid">
</div>
<div class="spec-head">
  <h4>Online Spice Store</h4>
</div>
<div class="spec-content">
  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
</div>
</div>
</div>

<div class="col-lg-4  col-md-4 col-sm-6 col-12">
<div class="circle-inner-wrappper">
  <div class="circle-icon">
    <img src="{{ asset('assets/images/delivery-truck.png') }}" class="img-fluid">
  </div>
  <div class="spec-head">
    <h4>Free Shipping</h4>
  </div>
  <div class="spec-content">
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
  </div>
</div>
</div>

<div class="col-lg-4  col-md-4 col-sm-6 col-12">
<div class="circle-inner-wrappper">
  <div class="circle-icon">
    <img src="{{ asset('assets/images/customer-satisfaction.png') }}" class="img-fluid">
  </div>
  <div class="spec-head">
    <h4>Satisfaction Guaranteed</h4>
  </div>
  <div class="spec-content">
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
  </div>
</div>
</div>
</div>
</div>

</section>
<!-- End -->
<div class="container">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h4>Find New Category For You</h4>
      <hr>
    </div>
  </div>
  <a class="carousel-arrow-left" href="#carousel-example" role="button" data-slide="prev" color=black>
    <span class="carousel-control-prev-icon" aria-hidden="true">
      <img src="{{ asset('assets/css/images/prevn.png')}}" width="30px" height="30px">
    </span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-arrow-right" href="#carousel-example" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true">
      <img src="{{ asset('assets/css/images/nextn.png')}}" width="30px" height="30px">
    </span>
    <span class="sr-only">Next</span>
  </a>
  <br>
  <br>
  <br>
  <div class="container-fluid">
    <div id="carousel-example" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner row w-100 mx-auto" role="listbox">
        <?php if(isset($category)){ foreach($category as $i => $categoryval) { 
        if($i == 0)
        {
        ?>
            <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
              <a href="{{ route('front.product',$categoryval->id)}}"><img src="{{  $categoryval->image }}" class="img-fluid mx-auto d-block img-carousel" alt="img1">
               <h4 style="font-size: 20px;"><center>{{  $categoryval->name }}</center></h4></a>
            </div>
            
        <?php 
        }else{
        ?>  
        <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
          <a href="{{ route('front.product',$categoryval->id)}}"><img src="{{  $categoryval->image }}" class="img-fluid mx-auto d-block img-carousel" alt="img2">
           <h4 style="font-size: 20px;"><center>{{  $categoryval->name }}</center></h4></a>
          
        </div>
        
        <?php 
        }}}?>
        
      </div>
    </div>
  </div>
</div>


<br>
<br>
<br>
<br>

@php $userid= 0; @endphp
@if(session('user_id') != '')
$userid = session('user_id');
@endif
	<!-- Section Gallery -->
<div class="product-area section">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2><center>Product Item</center></h2>
							<hr>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="product-info">
						    <!--<div class="row-grid">-->
						    <!--<div class="col-md-3">-->
							<div class="nav-main">
								<!-- Tab Nav -->
							
								<ul class="nav nav-tabs" id="myTab" role="tablist">
								    <?php if(isset($productcategory)){ foreach($productcategory as $i => $categoryval) { 
                                    if($i == 0)
                                    {
                                    ?>
									<li class="nav-item" ><a class="nav-link active" data-toggle="tab" href="#{{  $categoryval->name }}" role="tab">{{  $categoryval->name }}</a></li>
									<?php 
									}else{
									?>
									<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#{{  $categoryval->name }}" role="tab">{{  $categoryval->name }}</a></li>
									<?php 
									}
									} }?>
									
								</ul>
							   
								<!--/ End Tab Nav -->
							</div>
							<!--</div>-->
							<!--<div class="col-md-9">-->
							<div class="tab-content" id="myTabContent" style="padding-top: 25px;">
								<!-- Start Single Tab -->
							    <?php if(isset($productcategory)){ foreach($productcategory as $i => $categoryval) { 
                                if($i == 0)
                                {
                                ?>
								    <div class="tab-pane fade show active" id="{{  $categoryval->name }}" role="tabpanel">
									    <div class="container-fluid">
                                            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                              <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                                   <?php if(isset($categoryval->product)){foreach($categoryval->product as $key => $productval) { 
                                                   if($key == 0){
                                                       if($productval->regular_price != '')
                                                       {
                                                           $price = $productval->regular_price;
                                                       }else
                                                       {
                                                           $price = $productval->sale_price;
                                                       }
                                                   ?>
                                                 <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                                                    <div class="card-carousel">
                                                       <img src="@if(isset($productval->product_media)){{  $productval->product_media }}@else {{ asset('assets/images/download.png') }} @endif" class="img-fluid mx-auto d-block" alt="img1">
                                                       <p>{{  $productval->product_name }}</p>
                                                       <p class="price">{{$currency}}. {{$price}}</p>
                                                       <div class="product-rating">
                                                       <?php for($j= 1;$j<= 5;$j++){
                                                            if($productval->rating > $j){
                                                           ?>
                                                	            <span class="product-star-empty" style="color:#ffc107">★</span>
                                                	            
                                                	       <?php }else{
                                                	       ?>
                                                	         <span class="product-star-empty">★</span>
                                                	       <?php
                                                	       } }?>
                                                	   </div>
                                                       <p><button><a href="{{route('front.addtocart',['id' => $productval->id,'userid' => $userid,'varient_id' => 0])}}" >Add to Cart</a></button></p>
                                                    </div>
                                                 </div>
                                                 <?php }else{
                                                  if($productval->regular_price != '')
                                                       {
                                                           $price = $productval->regular_price;
                                                       }else
                                                       {
                                                           $price = $productval->sale_price;
                                                       }
                                                 
                                                 ?>
                                                 <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="card-carousel">
                                                       <img src="@if(isset($productval->product_media)){{  $productval->product_media }}@else {{ asset('assets/images/download.png') }} @endif" class="img-fluid mx-auto d-block" alt="img2">
                                                       <p>{{  $productval->product_name }}</p>
                                                       <p class="price">{{$currency}}. {{$price}}</p>
                                                       <div class="product-rating">
                                                           <?php for($j= 1;$j<= 5;$j++){
                                                            if($productval->rating > $j){
                                                           ?>
                                                	            <span class="product-star-empty" style="color:#ffc107">★</span>
                                                	            
                                                	       <?php }else{
                                                	       ?>
                                                	         <span class="product-star-empty">★</span>
                                                	       <?php
                                                	       } }?>
                                                	       </div>
                                                       <p><button><a href="{{route('front.addtocart',['id' => $productval->id,'userid' => $userid,'varient_id' => 0])}}" >Add to Cart</a></button></p>
                                                    </div>
                                                 </div>
                                                <?php }
                                                } }?>
                                                 
                                        </div>
                                    </div>
								        </div>
								<!--/ End Single Tab -->
								<!-- Start Single Tab -->
								
								<!--/ End Single Tab -->
							        </div>
						    	<?php 
								}else{
								  
								?>
									<div class="tab-pane fade" id="{{  $categoryval->name }}" role="tabpanel">
									    <div class="container-fluid">
                                            <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                              <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                                   <?php if(isset($categoryval->product)){foreach($categoryval->product as $key => $productval) { 
                                                   if($key == 0){
                                                         if($productval->regular_price != '')
                                                           {
                                                               $price = $productval->regular_price;
                                                           }else
                                                           {
                                                               $price = $productval->sale_price;
                                                           }
                                                   ?>
                                                 <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
                                                    <div class="card-carousel">
                                                       <img src="@if(isset($productval->product_media)){{  $productval->product_media }}@else {{ asset('assets/images/download.png') }} @endif" class="img-fluid mx-auto d-block" alt="img1">
                                                       <p>{{  $productval->product_name }}</p>
                                                       <p class="price">{{$currency}}. {{$price}}</p>
                                                        <div class="product-rating">
                                                        <?php for($j= 1;$j<= 5;$j++){
                                                            if($productval->rating > $j){
                                                           ?>
                                                	            <span class="product-star-empty" style="color:#ffc107">★</span>
                                                	            
                                                	       <?php }else{
                                                	       ?>
                                                	         <span class="product-star-empty">★</span>
                                                	       <?php
                                                	       } }?>
                                                	   </div>
                                                       <p><button><a href="{{route('front.addtocart',['id' => $productval->id,'userid' => $userid,'varient_id' => 0])}}" >Add to Cart</a></button></p>
                                                    </div>
                                                 </div>
                                                 <?php }else{
                                                   if($productval->regular_price != '')
                                                   {
                                                       $price = $productval->regular_price;
                                                   }else
                                                   {
                                                       $price = $productval->sale_price;
                                                   }
                                                 ?>
                                                 <div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
                                                    <div class="card-carousel">
                                                       <img src="@if(isset($productval->product_media)){{  $productval->product_media }}@else {{ asset('assets/images/download.png') }} @endif" class="img-fluid mx-auto d-block" alt="img2">
                                                       <p>{{  $productval->product_name }}</p>
                                                       <p class="price">{{$currency}}. {{$price}}</p>
                                                        <div class="product-rating">
                                                       <?php for($j= 1;$j<= 5;$j++){
                                                            if($productval->rating > $j){
                                                           ?>
                                                	            <span class="product-star-empty" style="color:#ffc107">★</span>
                                                	            
                                                	       <?php }else{
                                                	       ?>
                                                	         <span class="product-star-empty">★</span>
                                                	       <?php
                                                	       } }?>
                                                	   </div>
                                                       <p><button><a href="{{route('front.addtocart',['id' => $productval->id,'userid' => $userid,'varient_id' => 0])}}" >Add to Cart</a></button></p>
                                                    </div>
                                                 </div>
                                                <?php }
                                                } }?>
                                                 
                                        </div>
                                    </div>
								        </div>
									</div>
								<?php 
								}
								} }?>
						    </div>
						    <!--</div>-->
						    <!--</div>-->
					</div>
				</div>
            </div>
    </div>
    </div>
    
    
<!-- End -->

<!-- Section -->

<section class="product_powder">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<h4>Most Popular Products This Week</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php if(isset($category)){ foreach($product as $key => $popular_productval) { if($key < 12){
			if($popular_productval->sale_price != '')
            {
               $price = $popular_productval->sale_price;
            }else
            {
               $price = $popular_productval->regular_price;
            }
           
			?>
	        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
	         <div class="spec-border">
	           <a href="{{route('front.productdetail',$popular_productval->id)}}"> 
	             <img src="{{  $popular_productval->product_media }}" class="img-fluid">
	             <h6>{{  $popular_productval->product_name }}</h6>
	             <p>{{$currency}}. {{$price}}</p>
	          </a>
	            <div class="product-rating">
                   <?php for($j= 1;$j<= 5;$j++){
                        if($popular_productval->rating > $j){
                       ?>
            	            <span class="product-star-empty" style="color:#ffc107">★</span>
            	            
            	       <?php }else{
            	       ?>
            	         <span class="product-star-empty">★</span>
            	       <?php
            	       } }?>
            	</div>
	         </div>
	         
	        </div>
	        <?php } } } ?>
		</div>
	</div>
</section>
<!-- End -->

@include('front.footer')
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
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
</body>
</html>
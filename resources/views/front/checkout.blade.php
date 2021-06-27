 <!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Custom CSS -->

<link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
<!-- Fancy Box -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->

  </head>
  <body>
   
@include('front.header')
<?php
    $cartlist = \app\Http\Controllers\Front::cartlist(session('user_id'));
    $coupen = \app\Http\Controllers\Front::coupencheck(session('user_id'));
    $setting = \app\Http\Controllers\Front::setting();
    $currency = $setting->data->currency;
    ?>
 <!-- Tab --> 
  <div class="checkout-wrapper">
	<div class="checkout-inner-wrapper">
	<div class="col-lg-12 col-md-12 col col-sm-12 col-12 column-title">
	<h3>Review Your Order</h3>
	<p>By clicking on the place your order you are ready to amazon's <a href="javascript:Pvoid(0);">Privacy</a> and <a href="javascript:Pvoid(0);">Terms & Condition</a></p>
	</div>
	 <form class="" method="POST" action="{{ url('/placeorder')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
	<div class="row">
	    @php $total = 0 ;@endphp
        @foreach($cartlist->data as $data)
        @if($data->sale_price != 0)  @php $total +=  $data->sale_price; @endphp  @else @php $total +=  $data->regular_price; @endphp    @endif
        @endforeach
		<div class="col-lg-9 col-md-9 col col-sm-12 col-12">
		    <input type="hidden" name="cart_id" value="{{$cartlist->data[0]->cart_ref_id}}">
		     <input type="hidden" name="total" value="{{$total}}">
			
			<div class="card shadow checkout_card">
                  <div class="card-header checkoutcard_head2" id="nono2" style="height: 40px;">
                     <h4 style="color: white;font-weight: 500;font-size: 17px;"> Delivery Address </h4>
                  </div>
                  <div class="card-body checkout_cardbody">
                     
                     <div class="row" style="margin-top: 20px;">
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Flat / House No / Building Name <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="shippingflatno">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Landmark <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="shippinglandmark">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Pincode <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="shippingpincode">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">City <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="shippingcity">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">State <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="shippingstate">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Country <span style="color: red">*</span></label>
                               <select class="checkout_input22" name="shippingcountry" id="producttype" >
                                   <option>Select Country</option>
                                   <?php foreach($countries as $countriesval) { ?>
                                    <option value="{{  $countriesval->name }}">{{  $countriesval->name }}</option>
                                    <?php }
                                ?>
                                </select>
                           </div>
                        </div>
                        
                     </div>
                     <hr style="border-bottom: 2px solid black">
                     <div class="row" style="margin-top: 20px;">
                        <div class="col-xl-12">
                           <h5 style="margin-top: 20px;margin-bottom: 30px;">BILLING ADDRESS</h5>
                        </div>
                        
                       
                         <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Flat / House No / Building Name <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="billingflatno">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Landmark <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="billinglandmark">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Pincode <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="billingpincode">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">City <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="billingcity">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">State <span style="color: red">*</span></label>
                              <input type="text" class="checkout_input22" id="usr" name="billingstate">
                           </div>
                        </div>
                        <div class="col-xl-6">
                           <div class="form-group">
                              <label for="usr" style="font-size: 14px;font-weight: 500;">Country <span style="color: red">*</span></label>
                              <select class="checkout_input22" name="billingcountry" id="producttype" >
                                    <option>Select Country</option>
                                   <?php foreach($countries as $countriesval) { ?>
                                    <option value="{{  $countriesval->name }}">{{  $countriesval->name }}</option>
                                    <?php }
                                ?>
                                </select>
                           </div>
                        </div>
                        
                     </div>
                     
                  </div>
               </div><br>
   <!--            <div class="im-wrapper address-wrapper">-->
			<!--	  <div class="row">-->
			<!--	  <div class="col-lg-4 col-md-4 col-sm-12 col-12">-->
			<!--	  <h4>GCC</h4>-->
			<!--	  <p>GCC Solution</p>-->
			<!--	    <a href="javascript:Pvoid(0);">Change</a>-->
			<!--	  </div>-->
			<!--	  <div class="col-lg-4 col-md-4 col-sm-12 col-12">-->
			<!--	  <h4>Payment Method</h4> <a href="javascript:Pvoid(0);">Change</a>-->
			<!--	  <p>editing in3014 <br> 6 mont EMI</p>-->
			<!--	  </div>-->
			<!--	  <div class="col-lg-4 col-md-4 col-sm-12 col-12">-->
			<!--	  <h4>Get Gift Card Voucher & Promotional Codes </h4>-->
			<!--	  <form action="/action_page.php" target="_blank" method="get">-->
			<!--	    <input type="number" class="email" Placeholder="Enter Code" name="email" autocomplete="email" autofocus="on" required="" disabled="" value="">-->
			<!--	    <input type="submit" value="Apply">-->
			<!--	  </form>-->
			<!--	  </div>-->
			<!--	  <div class="col-lg-4 col-md-4 col-sm-12 col-12">-->
			<!--	  <h4>Shipping Address</h4><a href="javascript:Pvoid(0);">Change</a>-->
			<!--	  <p>123 <br> Ground Floor <br> Phone: +8878xyz <br> <a href="javascript:void(0);">Edit Delivery Pincode</a></p>-->
			<!--	  </div>-->
			<!--	  <div class="col-lg-4 col-md-4 col-sm-12 col-12">-->
			<!--	  <h4>Billing Address</h4> -->
			<!--	  <a href="javascript:Pvoid(0);">Change</a>-->
			<!--	  <p>Same AS Delivery Address</p>-->
			<!--	  </div>-->
			<!--	  <div class="col-lg-4 col-md-4 col-sm-12 col-12">-->
			<!--	  <h4>GCC</h4>-->
			<!--	  <p>GCC Solution</p>-->
			<!--	    <a href="javascript:Pvoid(0);">Change</a>-->
			<!--	  </div>-->
			<!--	</div>-->
			<!--</div>-->
		</div>
<div class="col-lg-3 col-md-3 col col-sm-12 col-12">
    <div class="place-order-wrapper">
    	
    	<!--<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took</p>-->
      <h4><strong>Order Summary</strong></h4>
      <p><span class="text-left">Items</span><span class="text-right-wrapper">{{$currency}}. {{$total}}</span></p>
      <p><span class="text-left">Items</span><span class="text-right-wrapper">{{$currency}}. @if(isset($coupen->total)){{$coupen->total}} @endif</span></p>
       @php $coupen = 0;@endphp
      @if(isset($coupen->total)) $coupen =  $coupen->total;  @endif
      <p><span class="text-left">Delivery</span><span class="text-right-wrapper">{{$currency}}. 10</span></p>
      <p><span class="text-left">Total</span><span class="text-right-wrapper">{{$currency}}. {{ $total + 10 -$coupen }}</span></p>
      <p><span class="text-left">Promotion Applied</span><span class="text-right-wrapper">{{$currency}}. 0</span></p>
      <p><span class="text-left">No Cost EMI Discounts</span><span class="text-right-wrapper">{{$currency}}. 0</span></p>
      <hr>
     
      <p><strong><span class="text-left">Order total</span><span class="text-right-wrapper">{{$currency}}. {{ $total + 10 - $coupen }}</span></strong></p>
        <hr>
        <!--<p><span class="text-left">Total</span><span class="text-right-wrapper">$20.00</span></p>-->
        <!--<p><span class="text-left">Total</span><span class="text-right-wrapper">$20.00</span></p>-->
        <!--<p><strong><span class="text-left">Order total</span><span class="text-right-wrapper">$100.00</span></strong></p>-->
          <!--<hr>-->
          <p class="red-color">Your Saving</p>
          <ul>
            <li>No Cost EMI Discount</li>
            <li>Free Delivery</li>
            <li>Items Discount</li>
          </ul>
          <hr>
          <p class="">Payment Method</p>
          <hr>
            <div class="form-check">
              <input class="form-check-input " type="radio" name="payment_method" id="exampleRadios1" value="cash" >
              <label class="form-check-label" for="exampleRadios1">
                Cash On Delivery
              </label>
            </div><br>
            <div class="form-check">
              <input class="form-check-input " type="radio" name="payment_method" id="exampleRadios1" value="razorpay" >
              <label class="form-check-label" for="exampleRadios1">
                Razorpay
              </label>
            </div>
          <br>
        <button class="btn btn-warning" type="submit"> Place Your Order and Pay </button>
    </div>
  </div>
  </div>
  </form>
</div>
</div>
 <!-- End -->
<!-- Footer -->

   @include('front.footer')
   <!-- End -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>
  </body>
</html>
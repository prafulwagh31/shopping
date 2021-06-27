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

<link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
<!-- Fancy Box -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
<style>
    .plus-minus-input {
  -webkit-align-items: center;
      -ms-flex-align: center;
          align-items: center;
}

.plus-minus-input .input-group-field {
  text-align: center;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  padding: 1rem;
   width:50px;
}

.plus-minus-input .input-group-field::-webkit-inner-spin-button,
.plus-minus-input .input-group-field ::-webkit-outer-spin-button {
  -webkit-appearance: none;
          appearance: none;
}

.plus-minus-input .input-group-button .circle {
  border-radius: 50%;
  padding: 0.25em 0.8em;
}
.plus-minus-input {
  align-items: center;

  .input-group-field {
    text-align: center;
    margin-left: 0.5rem;
    margin-right: 0.5rem;
    padding: 1rem;
    width:50px;

    &::-webkit-inner-spin-button,
    ::-webkit-outer-spin-button {
      appearance: none;
    }
  }

  .input-group-button {
    .circle {
      border-radius: 50%;
      padding: 0.25em 0.8em;
    }
  }
}

</style>
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
  <div class="cart-wrapper" style="padding-top:60px;">
    <div class="px-4 px-lg-0">
      
        <div class="cart-section">
          <div class="container">
           
            <div class="row">
                
              <div class="col-lg-12 bg-white  shadow-sm">
                <div class="row">
                   <div class="col-md-6"> 
                       @if(session()->has('error_message'))
                        <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                        @endif
                        @if(session()->has('success_message'))
                        <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                        @endif
                    </div>
                </div> 
                <!-- Shopping cart table -->
                <div class="table-responsive">
                <h3>Cart</h3>
                <hr>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="border-0 bg-light">
                          <div class="p-2 px-3 text-uppercase">Product</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Price</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Quantity</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Remove</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    @php $total = 0 ;
                    $cart_ref_id = 0;
                    @endphp
                    @if(isset($cartlist->data))
                    @foreach($cartlist->data as $key => $data)
                    @php
                    $cart_ref_id = $data->cart_ref_id;
                    @endphp
                      <tr>
                        <th scope="row" class="border-0">
                          <div class="p-2">
                            <img src="{{$data->product_image}}" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">{{$data->product_name}}</a></h5>
                            </div>
                          </div>
                        </th>
                        <td class="border-0 align-middle"><strong>@if($data->sale_price != 0)  {{$currency}}. {{ $data->sale_price }} @php $total +=  $data->sale_price; @endphp  @else  {{$currency}}. {{ $data->regular_price }} @php $total +=  $data->regular_price; @endphp    @endif</strong></td>
                        <td class="border-0 align-middle"><strong><div class="input-group plus-minus-input">
                          <div class="input-group-button">
                            <button type="button" class="button hollow circle" data-quantity="minus"  onclick="getminus({{$key}})"data-field="quantity">
                              <i class="fa fa-minus" aria-hidden="true"></i>
                            </button>
                          </div>
                          <input class="input-group-field" id="setqty{{$key}}"type="number" name="quantity" value="{{$data->qty}}">
                          <div class="input-group-button">
                            <button type="button" class="button hollow circle" data-quantity="plus" onclick="getplus({{$key}})" data-field="quantity">
                              <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                          </div>
                        </div></strong></td>
                        <td class="border-0 align-middle"><a href="{{ route('front.rmemovecartitem',['cart_id' => $data->cart_id])}}" class="text-dark"><i class="fa fa-trash"></i></a></td>
                      </tr>
                      
                    @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
                <hr>
                <!-- End -->
              </div>
            </div>
      
            <div class="row py-5 p-4 bg-white rounded shadow-sm">
              <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                <form method="POST" action="{{ route('front.coupenapply')}}">
                    {{csrf_field()}}
                <div class="p-4">
                  <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                  <div class="input-group mb-4 border rounded-pill p-2">
                    <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" name="discount_code" class="form-control border-0">
                    <input type="hidden" name="total" value="{{ $total }}" >
                    <input type="hidden" name="cart_ref_id" value="{{ $cart_ref_id }}" >
                    <div class="input-group-append border-0">
                      <button id="button-addon3" type="submit" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
                    </div>
                  </div>
                </div>
                </form>
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
                <div class="p-4">
                  <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
                  <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                <div class="p-4">
                  <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
                  <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong> {{$currency}}. {{ $total }}</strong></li>
                     <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Coupen charges</strong><strong> {{$currency}}. @if(isset($coupen->total)){{$coupen->total}} @endif</strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong> {{$currency}}. 10.00</strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Tax</strong><strong> {{$currency}}. 0.00</strong></li>
                    <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                    @php $coupen_total = 0; @endphp
                    @if(isset($coupen->total)) $coupen_total = $coupen->total @endif
                      <h5 class="font-weight-bold"> {{$currency}}. {{ $total + 10 - $coupen_total}} </h5>
                    </li>
                  </ul><a href="{{ route('front.checkout')}}" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
                </div>
              </div>
            </div>
      
          </div>
        </div>
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
    function getminus(key)
    {
        var qty = $('#setqty'+key).val();
        var total = parseInt(qty) - 1;
        $('#setqty'+key).val(total);
    }
    function getplus(key)
    {
        var qty = $('#setqty'+key).val();
        var total = parseInt(qty) + 1;
        $('#setqty'+key).val(total);
    }
    function getremoveitem(productid)
    {
        alert(productid);
    }
   

    </script>
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
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Custom CSS -->

<link rel="stylesheet" href="{{ asset('assets/css/product.css') }}">
<!-- Google Font -->

<!-- Fancy Box -->
 <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/ui-lightness/jquery-ui.css" media="screen"> 

  </head>
  <style>
body {
  background:#f8f9fa;
}
#slider-container {
    width:220px;
    margin-left:0px;
}

/*--- /.price-range-slider ---*/
  </style>
  <body>
   
@include('front.header')
@php 
$category = \app\Http\Controllers\Front::category();
$setting = \app\Http\Controllers\Front::setting();
$currency = $setting->data->currency;
$attributelist = \app\Http\Controllers\Front::attributelist();

@endphp
 <!-- Tab --> 
 <div class="tab-wrapper">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                 <!-- Tab links -->
<div class="tab">
    @foreach($category->data as $category_val)
   
    <button class="tablinks" id="defaultOpen" onclick="openCity(event, 'Spices')">{{$category_val->catgory}}</button>
    
    @endforeach
   
  </div>
  
  <!-- Tab content -->
  <div id="Spices" class="tabcontent">
       <div class="row">
            <div class="col-md-12"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif
            </div>
        </div>
    <div class="row">
       
        <!-- Start Sidebar -->
        
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
						
							<!-- property Sidebar -->
							<div class="exlip-page-sidebar">
								
								<!-- Find New Property -->
								<div class="sidebar-widgets">
									
									<!--<div class="form-group">-->
									<!--	<div class="input-with-icon">-->
									<!--		<input type="text" class="form-control" placeholder="Keyword">-->
									<!--		<i class="fa fa-search" ></i>-->
									<!--	</div>-->
									<!--</div>-->
									
									<!--<div class="form-group">-->
									<!--	<div class="input-with-icon">-->
									<!--		<input type="text" class="form-control" placeholder="Where">-->
									<!--		<i class="fa fa-tags" ></i>-->
									<!--	</div>-->
									<!--</div>-->
									
									<!--<div class="form-group">-->
									<!--	<div class="input-with-icon">-->
									<!--		<select id="list-category" class="form-control">-->
									<!--			<option value="">&nbsp;</option>-->
									<!--			<option value="1">Spa & Bars</option>-->
									<!--			<option value="2">Restaurants</option>-->
									<!--			<option value="3">Hotels</option>-->
									<!--			<option value="4">Educations</option>-->
									<!--			<option value="5">Business</option>-->
									<!--			<option value="6">Retail & Shops</option>-->
									<!--			<option value="7">Garage & Services</option>-->
									<!--		</select>-->
									<!--		<i class="fa fa-briefcase" ></i>-->
									<!--	</div>-->
									<!--</div>-->
									<label for="amount"><b>Price range</b></label>
									<div id="slider-container"></div>
                                    
                                        <form method="POST" action="{{route('front.getpricerange')}}">
                                            {{ csrf_field()}}
                                        <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;"  />
                                        <input type="hidden" id="min" name="min_price"
                                                value="">
                                            
                                            <input type="hidden" id="max" name="max_price"
                                                value="">
                                        <br><br>
                                        <button class="btn btn-primary">Apply</button>
                                        </form>
                                    <hr>
                                   
									<div class="ameneties-features">
										<label><b>Category Filter</b></label>
										<ul class="no-ul-list">
										    @foreach($category->data as $key => $category_val)
											<li>
											    	<input id="a-{{$key}}" class="checkbox-custom" name="category" type="checkbox" value="{{$category_val->categoryid}}" onclick="getdetailproduct({{$category_val->categoryid}})">
												<label for="a-{{$key}}" class="checkbox-custom-label"><b>{{$category_val->catgory}}</b></label><ul class="no-ul-list">
												  @foreach($category_val->subcategory as $subkey => $subcategory_val) 
												  	<li>
												<input id="a-{{$key}}{{$subkey}}" class="checkbox-custom" name="category" type="checkbox" value="{{$subcategory_val->subcategoryid}}" onclick="getdetailproduct({{$subcategory_val->subcategoryid}})">
												<label for="a-{{$key}}{{$subkey}}" class="checkbox-custom-label">{{$subcategory_val->subcategory}}</label>	</li>
												  	@endforeach
												</ul>
											</li>
										@endforeach
										
										</ul>
									
									</div>
									<hr>
									<div class="ameneties-features mt-3">
										<label><b>Attribute</b></label>
										<ul class="no-ul-list">
										    @foreach($attributelist->data as $key =>  $attribute)
										    @php
										    $termlist = \app\Http\Controllers\Front::termlist($attribute->id);
										   
										    @endphp
											<li>
											
												<label for="m-{{$key}}" class="checkbox-custom-label">{{$attribute->name}}</label><ul class="no-ul-list">	
												@foreach($termlist->data as $termkey => $term)
												
    												<li>
    												<input id="m-{{$key}}{{$termkey}}" class="checkbox-custom" name="term" type="checkbox" value="{{$term->id}}" onclick="getdetailattribute({{$term->id}})">
    												<label for="m-{{$key}}{{$termkey}}" class="checkbox-custom-label">{{$term->name}}</label>
    												</li>
											
												@endforeach
												</ul>
											</li>
										@endforeach
										
											
										</ul>
									
									</div>
							
								</div>
							</div>
						</div>
        <!-- End Sidebar -->

        <div class="col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="row" id="productdetailsdiv">
                <?php foreach($productwisecategory as $productwisecategoryval) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="{{  $productwisecategoryval->product_media }}">
                                <img class="pic-2" src="{{  $productwisecategoryval->product_media }}">
                            </a>
                            <ul class="social">
                                <li>@if(session('user_id') != '')
                                    <a href="{{route('front.addtowishlist',['id' => $productwisecategoryval->id,'userid' => session('user_id')])}}"><i class="fa fa-heart"></i></a>
                                    @else
                                    <a href="#" onclick="getalert()"><i class="fa fa-heart"></i></a>
                                    @endif
                                </li>
                                <li>@if(session('user_id') != '')
                                <a href="{{route('front.addtocart',['id' => $productwisecategoryval->id,'userid' => session('user_id'),'varient_id' => 0])}}" ><i class="fa fa-shopping-cart"></i></a>
                                @else
                                <a href="#" onclick="getalert()" ><i class="fa fa-shopping-cart"></i></a>
                                @endif</li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{  $productwisecategoryval->product_name }}</a></h3>
                           
                                @isset($productwisecategoryval->regular_price)
                                <div class="price">
                                    {{$currency}}.{{  $productwisecategoryval->regular_price }}
                                </div>
                                @endisset
                               
                                @isset($productwisecategoryval->sale_price)
                                <div class="price"><del>
                                {{$currency}}.{{  $productwisecategoryval->sale_price }}
                                </div></del>
                                @endisset
                            
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
               </div>
             <?php } ?>
          </div>
        </div>
    </div>
  </div>

  <div id="Fruit" class="tabcontent">
    <div class="row">

        <!-- Start Sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div> <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>

            </div>
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                       <img src="{{ url('assets/images/payumoney.png') }}" class="img-fluid">
                    </div>
                </div>
            </div>

        </div>
        <!-- End Sidebar -->

        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="{{ url('assets/images/Red-Chilli-Powder-mirchi.jpg') }}">
                                <img class="pic-2" src="{{ url('assets/images/Red-Chilli-Powder-mirchi.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">Red Chilli powder Mirchi</a></h3>
                            <div class="price">
                                $63.50
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
               </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="#">
                            <img class="pic-1" src="{{ url('assets/images/Red-chilli.jpg') }}">
                            <img class="pic-2" src="{{ url('assets/images/Red-chilli.jpg') }}">
                        </a>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">New</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">Red Chilli</a></h3>
                        <div class="price">
                            $63.50
                            <span>$75.00</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                    </div>
                </div>
             </div>

           <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="product-grid3">
                <div class="product-image3">
                    <a href="#">
                        <img class="pic-1" src="{{ url('assets/images/rose-petals.jpg') }}">
                        <img class="pic-2" src="{{ url('assets/images/rose-petals.jpg') }}">
                    </a>
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">New</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">Rose Petals</a></h3>
                    <div class="price">
                        $63.50
                        <span>$75.00</span>
                    </div>
                    <ul class="rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star disable"></li>
                        <li class="fa fa-star disable"></li>
                    </ul>
                </div>
            </div>
    </div>
    </div>
        </div>
    </div>
  </div>
  
  <div id="Herbs" class="tabcontent">
    <div class="row">

        <!-- Start Sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div> <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>

            </div>
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{ url('assets/images/payumoney.png') }}" class="img-fluid">                     
                     </div>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="{{ url('assets/images/star-anise.jpg') }}">
                                <img class="pic-2" src="{{ url('assets/images/star-anise.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">Star Anise</a></h3>
                            <div class="price">
                                $63.50
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
               </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="#">
                            <img class="pic-1" src="{{ url('assets/images/turmeric.jpg') }}">
                            <img class="pic-2" src="{{ url('assets/images/turmeric.jpg') }}">
                        </a>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">New</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">Turmeric</a></h3>
                        <div class="price">
                            $63.50
                            <span>$75.00</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                    </div>
                </div>
             </div>

           <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="product-grid3">
                <div class="product-image3">
                    <a href="#">
                        <img class="pic-1" src="{{ url('assets/images/yellow-mustard.jpg') }}">
                        <img class="pic-2" src="{{ url('assets/images/yellow-mustard.jpg') }}">
                    </a>
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">New</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">Yellow Mustard</a></h3>
                    <div class="price">
                        $63.50
                        <span>$75.00</span>
                    </div>
                    <ul class="rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star disable"></li>
                        <li class="fa fa-star disable"></li>
                    </ul>
                </div>
            </div>
    </div>
    </div>
        </div>
    </div>
  </div>

  <div id="Tree" class="tabcontent">
    <div class="row">

        <!-- Start Sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div> <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>

            </div>
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="category-products">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <img src="{{ url('assets/images/payumoney.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <!-- End Sidebar -->

        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="{{ url('assets/images/1447977000.jpg') }}">
                                <img class="pic-2" src="{{ url('assets/images/1447977000.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">Spices</a></h3>
                            <div class="price">
                                $63.50
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
               </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="#">
                            <img class="pic-1" src="{{ url('assets/images/1494514167.jpg') }}">
                            <img class="pic-2" src="{{ url('assets/images/1494514167.jpg') }}">
                        </a>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">New</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">Species</a></h3>
                        <div class="price">
                            $63.50
                            <span>$75.00</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                    </div>
                </div>
             </div>

           <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="product-grid3">
                <div class="product-image3">
                    <a href="#">
                        <img class="pic-1" src="{{ url('assets/images/1499888684.jpg') }}">
                        <img class="pic-2" src="{{ url('assets/images/1499888684.jpg') }}">
                    </a>
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">New</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">Species</a></h3>
                    <div class="price">
                        $63.50
                        <span>$75.00</span>
                    </div>
                    <ul class="rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star disable"></li>
                        <li class="fa fa-star disable"></li>
                    </ul>
                </div>
            </div>
    </div>
    </div>
        </div>
    </div>
  </div>

  <div id="Flower" class="tabcontent">
    <div class="row">

        <!-- Start Sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div> <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>

            </div>
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="category-products">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                   <img src="{{ url('assets/images/payumoney.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>                   
                </div>
            </div>
        </div>
        </div>
        <!-- End Sidebar -->

        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="{{ url('assets/images/bay-leaf.jpg') }}">
                                <img class="pic-2" src="{{ url('assets/images/bay-leaf.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">Bay Leaf</a></h3>
                            <div class="price">
                                $63.50
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
               </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="#">
                            <img class="pic-1" src="{{ url('assets/images/black-pepper-powder.jpg') }}">
                            <img class="pic-2" src="{{ url('assets/images/black-pepper-powder.jpg') }}">
                        </a>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">New</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">Black Pepper Powder</a></h3>
                        <div class="price">
                            $63.50
                            <span>$75.00</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                    </div>
                </div>
             </div>

           <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="product-grid3">
                <div class="product-image3">
                    <a href="#">
                        <img class="pic-1" src="{{ url('assets/images/black-stone-flower.jpg') }}">
                        <img class="pic-2" src="{{ url('assets/images/black-stone-flower.jpg') }}">
                    </a>
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">New</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">Black Stone Flower</a></h3>
                    <div class="price">
                        $63.50
                        <span>$75.00</span>
                    </div>
                    <ul class="rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star disable"></li>
                        <li class="fa fa-star disable"></li>
                    </ul>
                </div>
            </div>
    </div>
    </div>
        </div>
    </div>
  </div>

  <div id="Vegetable" class="tabcontent">
    <div class="row">

        <!-- Start Sidebar -->
        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div> <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="/Pippali-Thippili-Long-Pepper" title="Buy Thippili Long Pepper">Thippili Long Pepper</a></h4>
                    </div>
                </div>

            </div>
            <div class="category-products">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <img src="{{ url('assets/images/payumoney.png') }}" class="img-fluid">                    
                    </div>
                </div>
            </div>
          

        </div>
        <!-- End Sidebar -->

        <div class="col-lg-9 col-md-9 col-sm-12 col-12">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="product-grid3">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1" src="{{ url('assets/images/cardamom.jpg') }}">
                                <img class="pic-2" src="{{ url('assets/images/cardamom.jpg') }}">
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">Cardamon</a></h3>
                            <div class="price">
                                $63.50
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
               </div>
              <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="product-grid3">
                    <div class="product-image3">
                        <a href="#">
                            <img class="pic-1" src="{{ url('assets/images/cinnamon.png') }}">
                            <img class="pic-2" src="{{ url('assets/images/cinnamon.png') }}">
                        </a>
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-shopping-bag"></i></a></li>
                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                        <span class="product-new-label">New</span>
                    </div>
                    <div class="product-content">
                        <h3 class="title"><a href="#">Cinnamon</a></h3>
                        <div class="price">
                            $63.50
                            <span>$75.00</span>
                        </div>
                        <ul class="rating">
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star"></li>
                            <li class="fa fa-star disable"></li>
                            <li class="fa fa-star disable"></li>
                        </ul>
                    </div>
                </div>
             </div>

           <div class="col-lg-4 col-md-4 col-sm-6 col-12">
              <div class="product-grid3">
                <div class="product-image3">
                    <a href="#">
                        <img class="pic-1" src="{{ url('assets/images/cloves.jpg') }}">
                        <img class="pic-2" src="{{ url('assets/images/cloves.jpg') }}">
                    </a>
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    <span class="product-new-label">New</span>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">Cloves</a></h3>
                    <div class="price">
                        $63.50
                        <span>$75.00</span>
                    </div>
                    <ul class="rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star disable"></li>
                        <li class="fa fa-star disable"></li>
                    </ul>
                </div>
            </div>
    </div>
    </div>
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
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
   
$(function () {
    var minp = '<?php echo $min;?>';
    var maxp = '<?php echo $max;?>';
   
          
    if(minp == '')
    {
        minp = 0;
    }
    if(maxp == '')
    {
        maxp = 1000;
    }
   
      $('#slider-container').slider({
         
          range: true,
          min: minp,
          max: maxp,
          values: [minp, maxp],
          create: function() {
              $("#amount").val("{{$currency}}"+minp+" - {{$currency}}"+maxp+"");
          },
          slide: function (event, ui) {
              $("#amount").val("{{$currency}}" + ui.values[0] + " - {{$currency}}" + ui.values[1]);
              var mi = ui.values[0];
              var mx = ui.values[1];
              $('#min').val(mi);
              $('#max').val(mx);
          }
      })
});

 

 $('[name="category"]').change(function(){
 
    if(this.checked){
       $('[name="category"]').not(this).prop('checked', false);
    }    
  });
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function getdetailproduct(subcat_id)
    {
        
        $.ajax({
             url: "{{route('front.getdetailproduct')}}",
             data:{subcat_id:subcat_id},
             type:'POST',
             success: function(result){
                $("#productdetailsdiv").html(result.html);
            }
        });
      
    }
    function getdetailattribute(termid)
    {
        var terms = [];

        // Initializing array with Checkbox checked values
        $("input[name='term']:checked").each(function(){
            terms.push(this.value);
        });
      
        
        $.ajax({
             url: "{{route('front.getdetailattribute')}}",
             data:{termid:terms},
             type:'POST',
             success: function(result){
                $("#productdetailsdiv").html(result.html);
            }
        });
    }
    </script>
  </body>
</html>
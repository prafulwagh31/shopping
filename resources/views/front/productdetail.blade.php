<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Shopping - Product Detail</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/css/swiper.min.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/prodetail.css') }}">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
<!-- Fancy Box -->
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->

</head>
<style>
	    .checked {
          color: orange;
        }
.fa-heart {
  background: #ff6600;
  color: white;
}
.social {
  padding: 20px;
  font-size: 30px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}
.fa-shopping-cart
{
    background: #ff6600;
  color: white;
}

	</style>
<body>

    <!-- Desktop Header -->
@include('front.header')
@php
$setting = \app\Http\Controllers\Front::setting();
$currency = $setting->data->currency;
@endphp
<!-- Product Detail -->


<div class="product-detail-wrapper clearfix">
<div class="product-detail-column clearfix">
<div class="thumbnail-container">
<img class="drift-demo-trigger" data-zoom="https://awik.io/demo/webshop-zoom/shoe-large.jpg" src="{{ $productdetails->product_media }}">
</div>
</div>
<div class="row">
               <div class="col-md-12"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
<div class="product-detail-column clearfix">
<div class="product-detail">
<h1>{{$productdetails->product_name}}</h1>
<p class="product-detail-price">@if($productdetails->sale_price != 0) {{$currency}}. {{ $productdetails->sale_price }} <strike>{{$currency}}. {{ $productdetails->regular_price }}</strike>@else {{$currency}}. {{ $productdetails->regular_price }}  @endif</p>
<p class="product-detail-description">{{$productdetails->specification}}</p>

                                            

<div class="product-detail-columns-wrapper">

<div class="product-detail-column-inner-wrapper" id="wishlist-container">

<!--<button class="product-detail-button">-->



@if(session('user_id') != '')
<a href="{{route('front.addtowishlist',['id' => $productdetails->id,'userid' => session('user_id')])}}"><i class="fa fa-heart social"></i></a>
@else
<a href="#" onclick="getalert()"><i class="fa fa-heart social"></i></a>
@endif


@if(session('user_id') != '')
<a href="{{route('front.addtocart',['id' => $productdetails->id,'userid' => session('user_id'),'varient_id' => 0])}}" ><i class="fa fa-shopping-cart social"></i></a>
@else
<a href="#" onclick="getalert()" ><i class="fa fa-shopping-cart social"></i></a>
@endif



</div>
</div>
</div>



    <div class="row">
        @foreach($productdetails->attribute_details as $attributeinfo)
        <div class="col-lg-5 col-md-5 col-sm-5 col-12">
            <label>{{$attributeinfo->attribute}}</label>
            <select class="form-control" name="terms[]" id="terms" onchange="getsingleattribute(this)">
                <option>Select {{$attributeinfo->attribute}}</option>
                @foreach($attributeinfo->terms as $term)
                 <option value="{{$term->term_id}}"> {{$term->term}}</option>
                @endforeach
            </select>
        </div>
        @endforeach
    </div>
    <br>
    <p class="small-text"><span>Standard delivery</span> 2-5 working days</p>
    <form class="" method="POST" action="{{ route('front.addrating')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
        <input type="hidden" name="pid" id="pid" value="{{$productdetails->id}}">
                <div class="form-group">
						<label>Rating</label>
						<?php for($i=1; $i < 6;$i++){?>
        					<span class="fa fa-star " id="star<?php echo $i?>" onclick="getrating(<?php echo $i?>)"></span>
        				<?php }?>
                        <input type="hidden" name="rating" id="servicerating">
    			</div>
    			<div class="form-group">
						<label>Comment</label>
						<textarea rows="4" cols="50" name="comment" class="form-control" placeholder="Enter Comment"></textarea>
    			</div>
    			<div class="form-group">
    			    <button class="btn btn-success" type="submit"> Submit </button>
    			</div>
    	
    	</form>
    
</div>
</div>
                
</div>

<p class="zoom-image-wrapper">Zoom plugin: <a href="" target="_blank">Drift</a></p>

<!-- End -->

<!-- Description -->
<div id="main">

<div class="container">
    <div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-12">
		<h4>Releted Products </h4>
		<hr>
	</div>
</div>
<div class="row">
    @foreach($releted_products as $releted_product)
    <div class="col-lg-3 col-md-3 col-sm-4 col-12">
        <div class="spec-border">
            <a href="{{route('front.productdetail',$releted_product->id)}}"> 
             <img src="{{  $releted_product->product_media }}" class="img-fluid">
             <h6>{{  $releted_product->product_name }}</h6>
             <p>{{$currency}}. {{$releted_product->regular_price}}</p>
            </a>
            <div class="product-rating">
            <span class="product-star-empty">★</span>
            <span class="product-star-empty">★</span>
            <span class="product-star-empty">★</span>
             <span class="product-star-empty">★</span>
             <span class="product-star-empty">★</span>
            </div>
        </div>
     <a href="%"> <p class="product-reviews">0 reviews</p></a>
    </div>
    @endforeach
</div>
    <div class="accordion" id="faq">
                    <div class="card">
                        <div class="card-header" id="faqhead1">
                            <a href="#" class="btn btn-header-link" data-toggle="collapse" data-target="#faq1"
                            aria-expanded="true" aria-controls="faq1">Product Description</a>
                        </div>

                        <div id="faq1" class="collapse show" aria-labelledby="faqhead1" data-parent="#faq">
                            <div class="card-body">
                                <div class="ProductDescriptionPage__detailsCard">
                                    <div class="Accordion__base" style="padding: 0px;">
                                        <div class="ReactCollapse--collapse" style="height: auto;">
                                            <div class="ReactCollapse--content">
                                                <div class="ProductDescriptionPage__accordionContent" itemprop="description" id="EPMD">{{$productdetails->product_description}}
                                                    <div class="ProductDescriptionPage__productDetails">
                                                        
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
    <div class="card">
                        <div class="card-header" id="faqhead2">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq2"
                            aria-expanded="true" aria-controls="faq2">Return &amp; Refund</a>
                        </div>

                        <div id="faq2" class="collapse" aria-labelledby="faqhead2" data-parent="#faq">
                            <div class="card-body">
                                <div class="Accordion__base" style="padding: 0px;">
    
                                    <div class="ReactCollapse--collapse" style="height: 0px; overflow: hidden;">
                                        <div class="ReactCollapse--content">
                                            <div class="ProductDescriptionPage__containerWithBottomBorder">
                                                <div class="ProductDescriptionPage__accordionContentBold">10 Days Easy Return</div>
                                                <div class="ProductDescriptionPage__accordionLight">10 Days Easy Return</div>
                                                <div class="ProductDescriptionPage__accordionLight">An order, once placed, can be cancelled until the seller processes it.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    <div class="card">
                        <div class="card-header" id="faqhead3">
                            <a href="#" class="btn btn-header-link collapsed" data-toggle="collapse" data-target="#faq3"
                            aria-expanded="true" aria-controls="faq3">Know More</a>
                        </div>

                        <div id="faq3" class="collapse" aria-labelledby="faqhead3" data-parent="#faq">
                            <div class="card-body">
                                <div class="ReactCollapse--collapse" style="overflow: hidden; height: 0px;">
                                    <div class="ReactCollapse--content">
                                        <div class="ProductDescriptionPage__containerWithBottomBorder">
                                            <div class="ProductDescriptionPage__list">An order, once placed, can be cancelled until the seller processes it.</div>
                                            <div class="ProductDescriptionPage__list">This product can be returned within 10 day(s) of delivery,subject to the Return Policy.</div>
                                            <div class="ProductDescriptionPage__list">For any other queries, do reach out to CliQ Care at 90291 08282.</div>
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
new Drift(document.querySelector('.drift-demo-trigger'), {
paneContainer: document.querySelector('.details'),
inlinePane: 769,
inlineOffsetY: -85,
containInline: true,
hoverBoundingBox: true
});


</script>
<script>
    function getrating(id)
    {
        for(var i=0;i <= id;i++)
        {
             $('#star'+i).addClass('checked');
        }
       
        $('#servicerating').val(id);
    }
    function getalert()
    {
        alert('please Login');
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function getsingleattribute()
    {
        var terms = $("select[name='terms[]']")
              .map(function(){return $(this).val();}).get();
        $.ajax({
         url: "{{route('front.getsingleattribute')}}",
         data:{terms:terms},
          type:'POST',
         success: function(result){
            // $(".Header__subCategoryDetailsHolder").html(result);
        }
    });
    }
</script>
</body>
</html>
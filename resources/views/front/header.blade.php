<div class="headerwrapper__hiddenHeaderDesktop  headerwrapper__hiddenHeader desktop-header"></div>
<div class="Header__base desktop-header">
<div class="Header__dummyColorHeader"></div>
<div class="Header__headerHolder clearfix">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<a href="{{route('front.home')}}" class="Header__logoHolder">
    
</a>
<style>    .badge:after{
content:attr(value);
font-size:12px;
background: red;
border-radius:50%;
padding:3px;
position:relative;
left:-8px;
top:-10px;
opacity:0.9;
}
.Header__categoriesHolder {
    min-width: 1013px;
    width: 100%;
    position: absolute;
    height: 561px;
    background: #fff;
    top: 60px;
    padding: 20px;
    display: flex;
    border-radius: 0px 0px 4px 4px;
    left: 0;
    box-shadow: 0 6px 6px 0 rgb(156 156 156 / 24%), 0 0 6px 0 rgb(0 0 0 / 12%);
    opacity: 0;
    transform: translateY(-20%);
    visibility: hidden;
}
.Header__categoryDetailsValueWithArrow0:hover .Header__subCategoryDetailsHolder
{
   visibility: visible;
}

.Header__subCategoryDetailsHolder
{
    visibility: hidden;
}

.Header__subCategoryDetailsHolder2
{
    visibility: hidden;
}

.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #fff;
    background-color: #53c8f4;
    border-color: #dee2e6 #dee2e6 #fff;
}
.Header__categoryDetailsValueWithArrow0 {
    width: 100%;
    height: auto;
    line-height: 60px;
    border-bottom: 1px solid #e4e4e4;
    text-align: left;
    font-size: 14px;
    display: flex;
    color: #000;
    cursor: pointer;
    padding-right: 25px;
    position: relative;
}
.Header__subCategoryDetailsHeader {
    width: 50% !important;
    vertical-align: top;
    height: auto;
    color: #000000;
    font-size: 14px;
    line-height: 30px;
    cursor: pointer;
    font-weight: 700;
    padding-top:10px !important;
}
.Header__subCategoryDetailsHeader2 {
    width: 50% !important;
    vertical-align: top;
    height: auto;
    color: #000000;
    font-size: 14px;
    line-height: 30px;
    cursor: pointer;
    font-weight: 700;
    padding-top:10px !important;
}
</style>
<style>
.dropbtn {
  /*background-color: #04AA6D;*/
  color: black;
  /*padding: 16px;*/
  /*font-size: 16px;*/
  border: none;
  padding-top: 7px;
}

.dropdown {
  position: relative;
  display: inline-block;
  padding-top: 14px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #fff;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #fff;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #fff;}



nav {    
    display: block;
    /*text-align: center;*/
  }
  nav ul {
    margin: 0;
    padding:0;
    list-style: none;
  }
  .nav a {
    display:block; 
    background: #111; 
    color:#fff; 
    text-decoration: none;
    padding: .8em 1.8em;
    text-transform: uppercase;
    font-size: 80%;letter-spacing: 2px;
    text-shadow: 0 -1px 0 #000;
    position: relative;
  }
  .nav{  
    vertical-align: top; 
    display: inline-block;
    box-shadow: 1px -1px -1px 1px #000, -1px 1px -1px 1px #fff, 0 0 6px 3px #fff;
    border-radius:6px;
  }
  .nav li{position: relative;}
  .nav > li { 
    float:left; 
    border-bottom: 4px #aaa solid; 
    margin-right: 1px; 
    /*width: 127px*/
  } 
  .nav > li > a { 
    margin-bottom:1px;
    box-shadow:inset 0 2em .33em -.5em #555; 
  }
  .nav > li:hover , .nav > li:hover >a{  border-bottom-color:#53c8f4;}
  .nav li:hover > a { color:#53c8f4; }
  .nav > li:first-child  { border-radius: 4px 0 0 4px;} 
  .nav > li:first-child>a{border-radius: 4px 0 0 0;}
  .nav > li:last-child  { 
    border-radius: 0 0 4px 0; 
    margin-right: 0;
  } 
  .nav > li:last-child >a{border-radius: 0 4px 0 0; }
  .nav li li a { margin-top:1px}
  
  
  
    .nav li a:first-child:nth-last-child(2):before { 
     content:""; 
     position: absolute; 
     height:0; 
     width: 0; 
     border: 5px solid transparent; 
     top: 50% ;
     right:5px;  
   }
   
   
   
   
   
   /* submenu positioning*/
.nav ul {
  position: absolute;
  white-space: nowrap;
  border-bottom: 5px solid  #53c8f4;
  z-index: 1;
  left: -99999em;
}
.nav > li:hover > ul {
  left: auto;
  padding-top: 5px  ;
  min-width: 100%;
}
.nav > li li ul {  border-left:1px solid #fff;}


.nav > li li:hover > ul { 
 /* margin-left: 1px */
  left: 100%;
  top: -1px;
}
/* arrow hover styling */
.nav > li > a:first-child:nth-last-child(2):before { 
  border-top-color: #aaa; 
}
.nav > li:hover > a:first-child:nth-last-child(2):before {
  border: 5px solid transparent; 
  border-bottom-color: #53c8f4; 
  margin-top:-5px
}
.nav li li > a:first-child:nth-last-child(2):before {  
  border-left-color: #aaa; 
  margin-top: -5px
}
.nav li li:hover > a:first-child:nth-last-child(2):before {
  border: 5px solid transparent; 
  border-right-color: #53c8f4;
  right: 10px; 
}
</style>

    <?php
    $cartlist = \app\Http\Controllers\Front::cartlist(session('user_id'));
    if(isset($cartlist->data))
    {
        if(count($cartlist->data) > 0)
        {
            $cartcount = count($cartlist->data);
        }else
        {
            $cartcount = 0; 
        }
    }else
    {
        $cartcount = 0;
    }
  
    $wishlist = \app\Http\Controllers\Front::wishlist(session('user_id'));
    if(isset($wishlist->data))
    {
        if(count($wishlist->data) > 0)
        {
            $wishcount = count($wishlist->data) - 1;
        }else
        {
            $wishcount = 0; 
        }
       
    }else
    {
        $wishcount = 0;
    }
    
    $category = \app\Http\Controllers\Front::category();
    $brand = \app\Http\Controllers\Front::brand();
    
  
    ?>    
<div class="Header__headerFunctionality clearfix">
<div class="Header__upperHeader clearfix">
<!--<a class="clearfix" href="javascript:void(0);" target="_blank" rel="noreferrer">-->
<!--<div class="Header__luxeryTab">Tata CLiQ Luxury</div>-->
<!--</a>-->
<div class="Header__loginAndTrackTab clearfix">
<div class="Header__signInAndLogout clearfix">
   
<div class="Header__logOutDropDown">
<div class="DropdownMenu__base">
  <div class="DropdownMenu__loginAndRegisterButtonHolder">
    <div class="DropdownMenu__loginAndRegisterButton">
        	    <?php if(session('user_id') != '')
					    {
					    ?> 
					    <div class="DropdownMenu__accountHolder">
                            <div class="DropdownMenu__menuHolder">
                              <div class="DropdownMenu__menuIconProfile"></div><a href="{{ route('front.myaccount') }}">My account</a></div>
                            <div class="DropdownMenu__menuHolder">
                              <div class="DropdownMenu__menuIconOrder"><i class="fa fa-list"></i></div><a href="{{ route('front.myaccount') }}">Order History</a></div>
                            <div class="DropdownMenu__menuHolder">
                              <div class="DropdownMenu__menuIconWishList"></div><a href="{{ route('front.cart') }}"> Saved List</a></div>
                            <div class="DropdownMenu__menuHolder">
                              <div class="DropdownMenu__menuIconWishLisAlerts"></div><a href="#">Coupon</a></div>
                            <div class="DropdownMenu__menuHolder">
                              <div class="DropdownMenu__menuIconGiftCard"></div><a href="#">Gift Card</a></div>
                           
                              <div class="DropdownMenu__menuHolder">
                              <div class="DropdownMenu__menuIconCliqCash"><i class="fa fa-lock"></i></div><a href="{{ route('front.signout') }}">Sign Out</a></div>
                              
                        </div>
					    <?php }
					    else
					    {
					    ?>
          <div class="Button__base"><a href="{{ route('front.login')}}">Login</span></a>
          </div><br>
          <div class="Button__base"><a href="{{ route('front.register')}}">Register</span></a>
          </div>
      <?php } ?>
    </div>
  </div>
  
</div>
</div>
@if(session('user_id') != '')
 <div class="Header__loginTab" ><i class="fa fa-user"></i>  {{session('name')}}</div>
@else
<div class="Header__loginTab">Sign in / Sign Up</div>
@endif



</div>
<!--<a href="" target="_blank" rel="noreferrer">-->
<!--<div class="Header__loginTab">Track Orders</div>-->
<!--</a>-->
<!--<a href="" target="_blank" rel="noreferrer">-->
<!--<div class="Header__loginTab">CLiQ Care</div>-->
<!--</a>-->
<!--<a href="" target="_blank" rel="noreferrer">-->
<!--<div class="Header__loginTab">Gift Card</div>-->
<!--</a>-->
<!--<a href="" target="_blank" rel="noreferrer">-->
<!--<div class="Header__loginTab">CLiQ Cash</div>-->
<!--</a>-->

</div>
</div>
<!--<div class="Header__lowerHeader clearfix">-->
<!--<div class="Header__leftTabHolder clearfix">-->
<!--<div class="Header__categoryAndBrand"><a href="{{ route('front.home')}}">Home</a>-->
<!--</div>-->
<!--<div class="Header__categoryAndBrand"><a href="{{ route('front.aboutus')}}">About Us</a>-->
<!--</div>-->
<!--<div class="Header__categoryAndBrand">Blog-->
<!--</div>-->
<!--<div class="dropdown">-->
<!--  <button class="dropbtn">Categories<div class="Header__rightArrow"></div></button>-->
<!--  <div class="dropdown-content">-->
<!--    @if(isset($category))-->
<!--    @foreach($category->data as $key => $categoryval)-->
<!--    <a href="#" id="maincategory{{$key}}" onclick="getdetail({{ $categoryval->categoryid}})">{{$categoryval->catgory}}</a>-->
<!--    @endforeach-->
<!--    @endif-->
    
<!--  </div>-->
<!--</div>-->

<nav>
  <ul class="nav">
    <li style="width:127px;"><a href="{{ route('front.home')}}">Home</a></li>
    <li  style="width:127px;"><a href="{{ route('front.aboutus')}}">About Us</a>
    </li>
    <li  style="width:127px;"><a href="#">Blog</a></li>
    <li  style="width:127px;"><a href="#">Category</a>
      <ul>
        @if(isset($category))
        @foreach($category->data as $key => $categoryval)
        <li><a href="{{ route('front.product',$categoryval->categoryid)}}">{{$categoryval->catgory}}</a>
        @if(!empty($categoryval->subcategory))
            <ul>
            @foreach($categoryval->subcategory as $subcategory)
             <li><a href="{{ route('front.product',$categoryval->categoryid)}}">{{$subcategory->subcategory}}</a></li>
            @endforeach
            </ul>
        @endif
        </li>
        <!--<li><a href="#">item</a>-->
        <!--  <ul>-->
        <!--    <li><a href="#">Ray</a></li>-->
        <!--    <li><a href="#">Veronica</a></li>-->
        <!--    <li><a href="#">Bushy</a></li>-->
        <!--    <li><a href="#">Havoc</a></li>-->
        <!--  </ul>-->
        <!--</li>-->
        @endforeach
        @endif
        
      </ul>
    </li>
    
    <li  style="width:127px;"><a href="#">Brand</a>
      <ul>
        @if(isset($brand))
        @foreach($brand->data as $key => $brandval)
        <li><a href="#">{{$brandval->name}}</a></li>
        @endforeach
        @endif
      </ul>
    </li>
    <li  style="width:127px;"><a href="#">Contact</a></li>
  </ul>
  <a href="{{ route('front.wishlistdata') }}"><i class="fa badge " style="font-size:24px;color:#000" value="{{$wishcount}}" >&#xf004;</i></a>
   <a href="{{ route('front.cart') }}"><i class="fa badge" style="font-size:24px;color:#000" value={{$cartcount}}>&#xf07a;</i></a>
</nav>
<!--<div class="Header__categoryAndBrand">Categories-->
<!--<div class="Header__arrow"></div>-->
<!--<div class="Header__categoriesHolder">-->
<!--<div class="Header__categoryDetails">-->
<!--    @if(isset($category))-->
<!--    @foreach($category->data as $key => $categoryval)-->
<!--    <div class="Header__categoryDetailsValueWithArrow" id="maincategory{{$key}}" onclick="getdetail({{ $categoryval->categoryid}})"><input type="hidden" class="catgorydata" value="{{$categoryval->categoryid}}">{{$categoryval->catgory}}-->
<!--        <div class="Header__rightArrow"></div>-->
<!--    </div>-->
<!--    @endforeach-->
<!--    @endif-->
  
<!--</div>-->
<!--<div class="Header__subCategoryDetailsHolder">-->
 
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--<div class="Header__categoryAndBrand">Brands-->
<!--<div class="Header__arrow"></div>-->
<!--<div class="Header__categoriesHolder">-->
<!--    <div class="Header__categoryDetailsValueWithArrow">-->
<!--<div class="row">-->
<!--  @if(isset($brand))-->
<!--    @foreach($brand->data as $key => $brandval)-->
<!--    @if($key < 25)-->
<!--    <div class="col-md-4">-->
<!--  <input type="hidden" class="catgorydata" value="{{$brandval->id}}">{{$brandval->name}}-->
<!--        <div class="Header__rightArrow"></div>-->
<!--   </div>-->
<!--    @endif-->
<!--    @endforeach-->
<!--    @endif-->
<!-- </div> </div>-->
<!--</div>-->
<!--</div>-->

</div>
<div class="Header__rightTabHolder">
<div class="badge Header__myBagShow "></div>
 

</div>
<!--<div class="Header__searchHolder clearfix">-->
<!--<div class="Header__searchWrapper clearfix">-->
<!--<div class="searchPage__base">-->
<!--<div class="searchPage__searchBar">-->
<!--  <div class="searchHeader__base">-->
<!--    <div class="searchHeader__InformationHeader">-->
<!--      <div class="searchHeader__searchRedHolder">-->
<!--        <div class="icon__base">-->
<!--          <div class="icon__image"></div>-->
<!--        </div>-->
<!--      </div>-->
<!--      <div class="searchHeader__searchWithInputRedHolder">-->
<!--        <div class="searchHeader__input">-->
<!--          <div class="input2__whiteHollow input2__container" data-test="control-input-field-main-div">-->
<!--            <div class="input2__wrapper input2__container">-->
<!--              <div class="input2__box input2__base">-->
<!--                <input type="search" autocomplete="off" autocorrect="off" placeholder="Search" class="input2__inputBox" data-test="control-input-field" value="">-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
</div>
</div>
</div>
</div>
</div>

<!------ Include the above in your HEAD tag ---------->

<!-- Responsive Header -->

<div class="header-responsive header-top-wrapper">
	<div class="headrInner">
		<div class="informationHeader">
			<div class="left-btn">
        <span>&nbsp;&nbsp;&nbsp;</span>
        <a 
         class="icon hdLogo" href="/">Go Back</a>
			</div>
			<div class="hdrTxtBox">
				<h1>Welcome</h1>
			</div>
			<div class="button-wrapper">
				<button aria-label="downloadIcon" type="button" class="icon downIco"></button>
				<button aria-label="searchIcon" type="button" class="icon searchIco"></button>
			</div>
			<div class="bottom-wrapper">&nbsp;</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script>
$( ".Header__categoryDetailsValueWithArrow" ).hover(
//   function() {
//   var id = $('.catgorydata').val();
//   alert(id);
//   }
);
 function getdetail(category_id)
 {
     $.ajax({
         url: "{{route('front.getsubcategory')}}",
         data:{category_id:category_id},
        success: function(result){
            $(".Header__subCategoryDetailsHolder").html(result);
        }
    });
    $('.Header__subCategoryDetailsHolder').css('visibility','visible');
 }

</script>
<!-- End -->
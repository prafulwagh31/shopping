@include('header')

<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/*button style*/
.buttondata {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.buttondata2 {background-color: white;} 

/* Style the tab */
.tab {
  float: left;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  width: 20%;
  min-height:300px;
  max-height:500px;
  
}

/* Style the buttons inside the tab */
.tab button {
  display: block;
  background-color: inherit;
  color: black;
  /*padding: 22px 16px;*/
  width: 100%;
  border: none;
  outline: none;
  text-align: left;
  cursor: pointer;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current "tab button" class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  float: left;
  padding: 0px 12px;
  border: 1px solid #ccc;
  width: 80%;
 
   min-height:300px;
  max-height:auto;
}
</style>
 <style>
.opt { font-weight:bold;}
.opt1 { color: red;}
.opt2 { color: green;padding-left:20px;}
    hr{
        height: 1px;
        background-color: #ccc;
        border: 2px solid;
    }
    .tabcontent
    {
        overflow-y: auto !important;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Products
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
              </ol>
            </nav>
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
          
          <div class="row">
            <?php if(isset($editproduct)){
            
            ?>
            <div class="row">
               <div class="col-md-3">
                  <div class="card-body">
                     <button class="buttondata buttondata2"><a href="{{ url('categories')}}">Categories</a></button>
                     <button class="buttondata buttondata2"><a href="{{ url('brand')}}">Brand</a></button>
                     <button class="buttondata buttondata2"><a href="{{ url('attributes')}}">Attributes</a></button>
                     <button class="buttondata buttondata2"><a href="{{ url('product')}}">Product</a></button>
                     <button class="buttondata buttondata2"><a href="{{ url('productlist')}}">Product List</a></button>
                     <button class="buttondata buttondata2"><a href="{{ url('importproduct')}}">Import Product</a></button>
                     <button class="buttondata buttondata2"><a href="{{ url('importpriceproduct')}}">Update Product Price</a></button>
                  </div>
               </div>
               <div class="col-md-9 grid-margin stretch-card">
                  <div class="card" style="">
                     <div class="card-body">
                        <h4 class="card-title">Edit  Product</h4>
                         <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                         <?php if(isset($editvarientproductidfinal)){?>
                         <li class="nav-item" role="presentation">
                           
                            <a
                              class="nav-link "
                              id="ex1-tab-1"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-1"
                              role="tab"
                              aria-controls="ex1-tabs-1"
                              aria-selected="true"
                              >Product</a
                            >
                          </li>
                           <li class="nav-item" role="presentation">
                            <a
                              class="nav-link active"
                              id="ex1-tab-2"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-2"
                              role="tab"
                              aria-controls="ex1-tabs-2"
                              aria-selected="false"
                              >Product Varient</a
                            >
                          </li>
                           
                            <?php }else{?>
                             <li class="nav-item" role="presentation">
                           
                            <a
                              class="nav-link active"
                              id="ex1-tab-1"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-1"
                              role="tab"
                              aria-controls="ex1-tabs-1"
                              aria-selected="true"
                              >Product</a
                            >
                          </li>
                          <li class="nav-item" role="presentation" style="">
                              <!--<li class="nav-item" role="presentation" style="pointer-events: none;">-->
                            <a
                              class="nav-link"
                              id="ex1-tab-2"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-2"
                              role="tab"
                              aria-controls="ex1-tabs-2"
                              aria-selected="false"
                              >Product Varient</a
                            >
                          </li>
                            <?php }?>
                         
                        
                          
                        </ul>
                         <div class="tab-content" id="ex1-content">
                        <div class="tab-pane <?php if(isset($editvarientproductidfinal)){}else{?>fade show active<?php }?>" id="ex1-tabs-1" role="tabpanel"  aria-labelledby="ex1-tab-1" >
                        <form class="" method="POST" action="{{ url('/updateproduct')}}"  enctype="multipart/form-data"  id="updateproduct">
                           {{ csrf_field() }}
                           <input type="hidden" name="hiddenid" value="<?php echo $editproduct->id;?>">
                           <div class="form-group">
                              <label for="exampleInputUsername1">Title</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name" value="<?php echo $editproduct->product_name;?>">
                           </div>
                           <div class="row">
                              <div class="col-md-4">
                                 <label for="exampleInputUsername1">Sale Status</label>
                                 <select name="sale_status" class="form-control">
                                    <option>Select</option>
                                    <option value="For Sale" <?php if($editproduct->salestatus == 'For Sale'){echo 'selected';}?>>For Sale</option>
                                    <option value="Not For Sale" <?php if($editproduct->salestatus == 'Not For Sale'){echo 'selected';}?>>Not For Sale</option>
                                 </select>
                              </div>
                              <div class="col-md-4">
                                 <label for="exampleInputUsername1">Purchase Status</label>
                                 <select name="purchase_status" class="form-control">
                                    <option>Select</option>
                                    <option value="For Purchase" <?php if($editproduct->purchasestatus == 'For Purchase'){echo 'selected';}?>>For Purchase</option>
                                    <option value="Not For Purchase" <?php if($editproduct->purchasestatus == 'Not For Purchase'){echo 'selected';}?>>Not For Purchase</option>
                                 </select>
                              </div>
                              <div class="col-md-4">
                                 <label for="exampleInputUsername1">HSN/SAC</label>
                                 <input type="text" class="form-control" name="hsn" value="<?php echo $editproduct->hsn;?>">
                              </div>
                           </div>
                           <br>
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="exampleInputUsername1">Category</label>
                                 <select class="form-control js-example-basic-multiple " name="category" multiple="multiple">
                                    <option value="0">Select Category</option>
                                    <?php foreach($category as $category) { 
                                       $subcategory = DB::table('tbl_categories')->where(array('pid' => $category->id))->get();
                                       ?>
                                    <option value="<?php echo $category->id;?>" class="opt" <?php if($editproduct->product_category == $category->id){echo 'selected';}?>>
                                       <?php echo $category->name;?>
                                    </option>
                                    <?php 
                                       foreach($subcategory as $subcategory)
                                       {
                                           $subcategorytwo = DB::table('tbl_categories')->where(array('pid' => $subcategory->id))->get();
                                          
                                           ?>
                                    <option value="<?php echo $subcategory->id;?>" class="opt1" <?php if($editproduct->product_category == $subcategory->id){echo 'selected';}?>>-----<?php echo $subcategory->name;?></option>
                                    <?php
                                       if($subcategorytwo != '')
                                       {
                                           foreach($subcategorytwo as $subcategorytwo)
                                           {?>
                                    <option value="<?php echo $subcategorytwo->id;?>" class="opt2" <?php if($editproduct->product_category == $subcategorytwo->id){echo 'selected';}?>>---------------<?php echo $subcategorytwo->name;?></option>
                                    <?php        
                                       }
                                       }
                                       
                                       }
                                       
                                       
                                       ?>
                                    <hr class="opt3">
                                    </hr>
                                    <?php }?>
                                 </select>
                              </div>
                              <div class="col-md-6">
                                 <label for="exampleInputUsername1">Brand</label>
                                 <select class="form-control" name="brand">
                                    <option>Select Brand</option>
                                    <?php foreach($brand as $brand) { ?>
                                    <option value="<?php echo $brand->id;?>" <?php if($brand->id == $editproduct->product_brand ){ echo 'selected';}?>><?php echo $brand->name;?></option>
                                    <?php }?>
                                 </select>
                              </div>
                           </div>
                           <br>
                           <div class="form-group">
                              <label for="exampleInputEmail1">Description</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"><?php echo $editproduct->product_description;?></textarea>
                           </div>
                           <div class="form-group">
                              <label for="document">Media</label>
                              <div class="needsclick dropzone" id="document-dropzone">
                              </div>
                           </div>
                           <div class="dropzoneimg"></div>
                           <?php $medianew = explode(',',$editproduct->product_media);
                              ?>
                           <?php foreach($medianew as $productdatamedianew){?>
                           <img src="{{asset('productimg')}}<?php echo '/'.$productdatamedianew;?>" style="height:100px;width:100px;">
                           <?php }?> 
                           <input type="hidden" name="hiddenimage" value="<?php echo $editproduct->product_media;?>">
                           <br>
                           <div class="form-group">
                              <label><strong>Product Data</strong></label>
                              <br>
                              <label>Product Type</label>
                              <div class="row">
                                 <div class="col-md-3">
                                    <select class="form-control" name="producttype" id="producttype" >
                                       <option value="1" <?php if(1 == $editproduct->product_type ){ echo 'selected';}?>>Simple Product</option>
                                       <option value="2" <?php if(2 == $editproduct->product_type ){ echo 'selected';}?>>Group Product</option>
                                       <option value="3" <?php if(3 == $editproduct->product_type ){ echo 'selected';}?>>External/Affilate Product</option>
                                       <option value="8" <?php if(8 == $editproduct->product_type ){ echo 'selected';}?>>Composite Product</option>
                                       <option value="6" <?php if(6 == $editproduct->product_type ){ echo 'selected';}?>>Variable Product</option>
                                       <option value="9" <?php if(9 == $editproduct->product_type ){ echo 'selected';}?>>Custom Product</option>
                                    </select>
                                 </div>
                                 <div class="col-md-1" id="virtualproduct" >
                                    <input type="checkbox" id="virtual" name="virtual" <?php if(4 == $editproduct->product_type ){ echo 'checked';}?>>
                                    <label for="quantity" style="padding-top:7px;">Virtual</label>
                                 </div>
                                 <div class="col-md-2" id="downloadableproduct" >
                                    <input type="checkbox" id="download" name="download"  <?php if(5 == $editproduct->product_type ){ echo 'checked';}?>>
                                    <label for="quantity" style="padding-top:7px;">Downloadable</label>
                                 </div>
                              </div>
                              <br><br>
                              <br><br>
                              <div class="tab">
                                 <button type="button" class="tablinks" onclick="openCity(event, 'Genral')" id="defaultOpen" style="border-radius: 0px;">Genral</button>
                                 <button type="button" class="tablinks" onclick="openCity(event, 'Inventory')" style="border-radius: 0px;">Inventory</button>
                                 <button  type="button" class="tablinks" onclick="openCity(event, 'Shipping')" style="border-radius: 0px;" id="shippinghidetab">Shipping</button>
                                 <button  type="button" class="tablinks" onclick="openCity(event, 'linkproducts')" style="border-radius: 0px;">Linked Products</button>
                                
                              </div>
                              <div id="Genral" class="tabcontent">
                                 <br>
                                 <div class="row" id="customproductdiv" <?php if(9 == $editproduct->product_type ){ ?>style="display:block;"<?php }?>style="display:none;">
                                    <div class="row" style="padding-left: 25px;" id="customproduct">
                                       <div class="row" style="padding-left: 25px;">
                                          <?php
                                             $unit = DB::table('tbl_unit')->get();
                                             $unitprice = DB::table('tbl_unitwiseprice')->where('unit_name','=',$editproduct->unitdata)->first();
                                             
                                             ?>
                                          <div class="col-md-3">
                                             <label for="exampleInputUsername1">Unit</label>
                                             <select class="form-control" name="unit" onchange="getunit(this)" id="unit">
                                                <?php foreach($unit as $unit){?>
                                                <option value="{{$unit->id}}"<?php if($editproduct->unitdata == $unit->id){echo 'selected';}?>>{{$unit->unit_name}}</option>
                                                <?php }?>
                                             </select>
                                          </div>
                                          <div class="col-md-2" id="heightdiv" <?php if($editproduct->unitdata == 2 || $editproduct->unitdata == 1){ ?>style="display:block"<?php }?> style="display:none">
                                             <label for="exampleInputUsername1">Height</label>
                                             <input type="text" class="form-control" name="unitheight" id="unitheight" value="<?php echo $editproduct->unitheight;?>">
                                          </div>
                                          <div class="col-md-2" id="widthdiv" <?php if($editproduct->unitdata == 2 || $editproduct->unitdata == 1){ ?>style="display:block"<?php }?> style="display:none">
                                             <label for="exampleInputUsername1">Width</label>
                                             <input type="text" class="form-control" name="unitwidth" onchange="getarea(this)" value="<?php echo $editproduct->unitwidth;?>">
                                          </div>
                                          <div class="col-md-2" id="areadiv" <?php if($editproduct->unitdata == 2 || $editproduct->unitdata == 1){ ?>style="display:block"<?php }?> style="display:none">
                                             <label for="exampleInputUsername1">Area</label>
                                             <input type="text" class="form-control" name="unitarea" id="unitarea" value="<?php echo $editproduct->unitarea;?>">
                                          </div>
                                          <div class="col-md-2" id="qtydiv" <?php if($editproduct->unitdata == 4 || $editproduct->unitdata == 5){ ?>style="display:block"<?php }?> style="display:none">
                                             <label for="exampleInputUsername1">Quantity</label>
                                             <input type="text" class="form-control" name="unitqty" id="qtyunit" onchange="getarea(this)" value="<?php echo $editproduct->unitquantity;?>">
                                          </div>
                                          <div class="col-md-2">
                                             <label for="exampleInputUsername1">Price</label>
                                             <input type="text" class="form-control" name="unitprice" id="unitprice" value="<?php if(isset($unitprice)){echo $unitprice->price;}?>">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <br><br>
                                 <div class="row" id="compositproductdiv" <?php if($editproduct->product_type  == 8){?>style="display:block"<?php }else {?>style="display:none;"<?php }?>>
                                    <?php
                                       $compositprdouct = explode(',',$editproduct->group_product_id);
                                       $compositprdouctqty = explode(',',$editproduct->compositqty);
                                       foreach($compositprdouct as $key => $compositprdouctval){
                                       
                                       
                                       ?>
                                    <div class="row" style="padding-left: 25px;" id="compositdata">
                                       <div class="row" style="padding-left: 25px;">
                                          <div class="col-md-6">
                                             <label for="exampleInputUsername1">Product</label>
                                             <select class="form-control" style="width:100%" name="compositproductdata[]">
                                                <?php foreach($product as $productdatafinal)
                                                   {?>
                                                <option value="{{ $productdatafinal->id}}" <?php if($compositprdouctval == $productdatafinal->id){echo 'selected';}?>>{{ $productdatafinal->product_name}}</option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                          <div class="col-md-3">
                                             <label for="exampleInputUsername1">Qty</label>
                                             <input type="text" class="form-control" name="compositqty[]" value="{{ $compositprdouctqty[$key] }}">
                                          </div>
                                       </div>
                                    </div>
                                    <?php }?>
                                    <div class="row" style="padding-left: 25px;">
                                       <div class="col-md-3"><button class="btn btn-default" 
                                          onclick="addcomposit()" type="button">Add </button></div>
                                    </div>
                                 </div>
                                 <div class="" id="exteranlaffilateinput" <?php if(3 == $editproduct->product_type ){ ?>style="display:block"<?php }?>style="display:none" >
                                    <br><br>
                                    <div class="row">
                                       <div class="col-md-3">
                                          <label>Product Url</label>
                                       </div>
                                       <div class="col-md-6">
                                          <input type="text" class="form-control" name="producturl" Placeholder="Enter the external URL to the product." value="<?php echo $editproduct->product_url;?>">
                                       </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       <div class="col-md-3">
                                          <label>Button Text</label>
                                       </div>
                                       <div class="col-md-6">
                                          <input type="text" class="form-control" name="buttontxt" Placeholder="This text will be shown on the button linking to the external product." value="<?php echo $editproduct->btn_txt;?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group" style="padding-top:25px;">
                                    <label><strong>Pricing</strong></label>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <label for="exampleInputUsername1">Regular price($)</label>
                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="regualrprice" value="<?php echo $editproduct->regular_price;?>">
                                       </div>
                                       <div class="col-md-6">
                                          <label for="exampleInputUsername1">Sale price($)</label>
                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="saleprice" value="<?php echo $editproduct->sale_price;?>">
                                          <br>
                                          <?php if($editproduct->sale_start_date != '' || $editproduct->sale_end_date != '') { ?>
                                          <label class="form-check-label" style="padding-left: 30px;">
                                          <input type="checkbox" class="form-check-input" name="dates" id="enddate" checked>Schedule</label>
                                          <?php } else {?>
                                          <label class="form-check-label" style="padding-left: 30px;">
                                          <input type="checkbox" class="form-check-input" name="dates" id="enddate" >Schedule</label>
                                          <?php }?>
                                          <div id="enddata" <?php if($editproduct->sale_start_date != '' || $editproduct->sale_end_date != '') { ?> style="display:block;"<?php }else {?>style="display:none;"<?php }?>>
                                             <h6>Sale Price Date</h6>
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <h5 class="">From</h5>
                                                   <input type="date" class="form-control" name="salestart" id="endd" value="<?php echo $editproduct->sale_start_date;?>">
                                                </div>
                                                <br>
                                                <div class="col-md-6">
                                                   <h5 class="">To</h5>
                                                   <input type="date" class="form-control" name="saleend" id="endd" value="<?php echo $editproduct->sale_end_date;?>">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group" style="padding-top:25px;">
                                    <div class="" id="downloadinput" style="display:none;">
                                       <div class="form-group">
                                          <div class="row">
                                             <div class="col-md-4" >
                                                <h6>Download Limit</h6>
                                                <input type="number" name="downloadlimit" class="form-control" placeholder="Unlimited">
                                             </div>
                                             <div class="col-md-4" >
                                                <h6>Download Expiry</h6>
                                                <input type="date" name="downloadexpairy" class="form-control" placeholder="Never">
                                             </div>
                                          </div>
                                       </div>
                                       <label>Downloadable Files: </label>
                                       <br><br>
                                       <input type="hidden" name="countdata" id="countdata" value="1">
                                       <div id="downloaddata">
                                          <div class="row">
                                             <div class="col-md-4">
                                                <input type="text" class="form-control"  name="downloadfile[]" placeholder="File name">
                                             </div>
                                             <div class="col-md-4">
                                                <input type="text" class="form-control"  name="downloadurl[]" placeholder="http://">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-4" style="padding-top:20px;">
                                          <button onclick = "addfile()" type="button" class="btn"  value="1">Add File</button>
                                       </div>
                                       <br>
                                    </div>
                                 </div>
                              </div>
                              <div id="Inventory" class="tabcontent">
                                 <div class="form-group">
                                    <h5><strong>Inventory</strong></h5>
                                    <div class="row">
                                       <div class="col-md-6">
                                          <label for="exampleInputEmail1">SKU (Stock Keeping Unit)</label>
                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="sku" value="<?php echo $editinventory->sku;?>">
                                       </div>
                                       <br>
                                       <div class="col-md-6">
                                          <label for="exampleInputEmail1">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="barcode" value="<?php echo $editinventory->barcode;?>">
                                       </div>
                                       <br>
                                       <?php if($editproductstock != ''){
                                          ?>
                                       <div class="col-md-6">
                                          <br><br>   
                                          <label for="exampleInputEmail1"> Manage stock?</label>
                                          <input type="checkbox" class="" id="enablestock" name="enablestock" value="1" checked>Enable stock management at product level
                                       </div>
                                       <?php
                                          }else {?>
                                       <div class="col-md-6">
                                          <br><br>   
                                          <label for="exampleInputEmail1"> Manage stock?</label>
                                          <input type="checkbox" class="" id="enablestock" name="enablestock" value="1" >Enable stock management at product level
                                       </div>
                                       <?php }?>
                                    </div>
                                    <br>
                                    <div class="row" id="stockdetails"  <?php if($editproductstock != ''){ ?> style="" <?php }else {?> style="display:none;"<?php }?>>
                                       <div class="col-md-6">
                                          <label for="exampleInputEmail1">Stock quantity</label>
                                          <input type="number" class="form-control" id="exampleInputUsername1" placeholder="" name="stockquantity" value="<?php if(isset($editproductstock)){echo $editproductstock->stockqty;}?>">
                                       </div>
                                       <br>
                                       <div class="col-md-6">
                                          <label for="exampleInputEmail1">Allow backorders?</label>
                                          <select class="form-control" name="allowbarcodes">
                                             <option value="no" <?php if(isset($editproductstock)){if($editproductstock->allowbarcodes == 'no'){echo 'selected';}}?>>Do not allow</option>
                                             <option value="notify" <?php if(isset($editproductstock)){if($editproductstock->allowbarcodes == 'notify'){echo 'selected';}}?>>Allow, but notify customer</option>
                                             <option value="yes" <?php if(isset($editproductstock)){if($editproductstock->allowbarcodes == 'yes'){echo 'selected';}}?>>Allow</option>
                                          </select>
                                       </div>
                                       <br>
                                       <div class="col-md-6">
                                          <label for="exampleInputEmail1">Low stock threshold</label>
                                          <input type="number" class="form-control" id="exampleInputUsername1" placeholder="" name="stockthreshold" value="<?php if(isset($editproductstock)){ echo $editproductstock->stockthreshold;}?>">
                                       </div>
                                    </div>
                                    <br>
                                    <?php if($editinventory->minqty != '' || $editinventory->maxqty){ ?>
                                    <input type="checkbox" id="quantity" name="quantity" checked>
                                    <label for="quantity">Track Quantity</label>
                                    <?php } else {?>
                                    <input type="checkbox" id="quantity" name="quantity" >
                                    <label for="quantity">Track Quantity</label>
                                    <?php }?>
                                    <br>
                                    <input type="checkbox" id="outofstock" name="quantity">
                                    <label for="quantity">Continue selling when out of stock</label>
                                 </div>
                                 <div class="row" id="quantityinput" <?php if($editinventory->minqty != '' || $editinventory->maxqty){ ?> style="" <?php }else {?> style="display:none;"<?php }?>>
                                    <div class="col-md-6 form-group">
                                       <label for="exampleInputUsername1">Min Qunatity</label>
                                       <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="minquantity"  value="<?php echo $editinventory->minqty;?>">
                                    </div>
                                    <div class="col-md-6 form-group">
                                       <label for="exampleInputUsername1">Max Qunatity</label>
                                       <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="maxquantity" value="<?php echo $editinventory->maxqty;?>">
                                    </div>
                                 </div>
                              </div>
                              <div id="Shipping" class="tabcontent">
                                 <div class="form-group">
                                    <h5><strong>Shipping</strong></h5>
                                    <!--<input type="checkbox" id="shipping" name="shipping">-->
                                    <!--<label>This is a physical product</label>-->
                                    <div class="" id="shippingdetails" >
                                       <div class="form-group">
                                          <label>Weight</label>
                                          <br>
                                          <div class="row">
                                             <div class="col-md-4">
                                                <input name="weight" id="ShippingCardWeight" placeholder="0.0" class="form-control" aria-labelledby="ShippingCardWeightLabel" aria-invalid="false" aria-multiline="false" value="<?php echo $editshipping->weight;?>"> 
                                             </div>
                                             <div class="col-md-2">
                                                <select id="ShippingCardWeightUnit" name="weightUnit" class="form-control" style="height: 48px;">
                                                   <option value="POUNDS" <?php  if($editshipping->weight == "POUNDS"){echo "selected";}?>>lb</option>
                                                   <option value="OUNCES" <?php  if($editshipping->weight == "OUNCES"){echo "selected";}?>>oz</option>
                                                   <option value="KILOGRAMS" <?php  if($editshipping->weight == "KILOGRAMS"){echo "selected";}?>>kg</option>
                                                   <option value="GRAMS" <?php  if($editshipping->weight == "GRAMS"){echo "selected";}?>>g</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <br> <br>
                                       <div class="row">
                                          <div class="col-md-4">
                                             <label>Shipping Class</label>
                                          </div>
                                          <div class="col-md-3">
                                             <select class="form-control" name="shippingclass">
                                                <option>Shipping Class</option>
                                                <?php foreach($shippingclass as $shippingclass){?>
                                                <option value="{{$shippingclass->id}}" <?php if($shippingclass->id == $editproduct->shippingclass ){echo 'selected';}?>>{{$shippingclass->title}}</option>
                                                <?php }?>
                                             </select>
                                          </div>
                                       </div>
                                       <br>
                                       <div class="row">
                                          <div class="col-md-1">
                                             <label>Dimension</label>
                                          </div>
                                          <div class="col-md-3">
                                             <input type="text" class="form-control" name="length" placeholder="Length" value="<?php echo $editshipping->length;?>">
                                          </div>
                                          <div class="col-md-3">
                                             <input type="text" class="form-control" name="width" placeholder="Width" value="<?php echo $editshipping->width;?>">
                                          </div>
                                          <div class="col-md-3">
                                             <input type="text" class="form-control" name="height" placeholder="Height" value="<?php echo $editshipping->height;?>">
                                          </div>
                                       </div>
                                       <br>
                                       <div class="form-group ">
                                          <label>Country/Region of origin</label>
                                          <div class="col-md-4">
                                             <select id="countries" name="country" class="form-control">
                                                <option>Select Country/Region</option>
                                                <?php
                                                   foreach($country as $country)
                                                   { ?>
                                                <option value="<?php echo $country->countrycode; ?>" <?php  if($editshipping->country == $country->countrycode){echo "selected";}?>><?php echo $country->countryname; ?></option>
                                                <?php }
                                                   ?>
                                             </select>
                                          </div>
                                          <br>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div id="linkproducts" class="tabcontent">
                                 <div class="row">
                                    <div class="col-md-6">
                                       <lable>Upsell</lable>
                                       <input type="text" name="upsell" class="form-control" value="<?php echo $editproduct->up_sell?>">
                                    </div>
                                 </div>
                                 <br>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <lable>Cross-sell</lable>
                                       <input type="text" name="crosssell" class="form-control" value="<?php echo $editproduct->cross_sell?>">
                                    </div>
                                 </div>
                              </div>
                              
                              <div class="row">
                              </div>
                              <br>
                              </div>
                              <div class="col-md-8">
                              </div>
                              <br>
                              <br>
                              <div class="form-group">
                              <label for="exampleInputUsername1">Product Gallery</label>
                              <input type="file" name="productgallery[]" class="form-control" multiple="multiple">
                              <?php $medianewdata = explode(',',$editproduct->product_gallery);
                                 ?>
                              <?php foreach($medianewdata as $medianewdata){?>
                              <img src="{{asset('productimg')}}<?php echo '/'.$medianewdata;?>" style="height:100px;width:100px;">
                              <?php }?> 
                              <input type="hidden" name="hiddenimagegallery" value="<?php echo $editproduct->product_gallery;?>">
                              </div>
                              <div class="row">
                              <div class="col-md-6">
                              <label for="exampleInputUsername1">Warehouse</label>
                              <select class="form-control" name="warehouse">
                              <option>Select Warehouse</option>
                              <?php foreach($warehouse as $warehouse){?>
                              <option value="{{ $warehouse->id}}" <?php if($warehouse->id == $editproduct->warehouse){echo 'selected';}?>>{{ $warehouse->name}}</option>
                              <?php }?>
                              </select>
                              </div>
                              <div class="col-md-6">
                              <label for="exampleInputUsername1"></label>
                              Create Warehouse
                              </div>
                              </div><br>
                              <div class="row">
                                <div class="form-group col-md-6">
                                            <label for="exampleInputUsername1">Delivery Flab</label>
                                            <select class="form-control" name="deliveryflab">
                                            <option>Select Delivery Flab</option>
                                            <?php foreach($deliverysetting as $deliverysetting){?>
                                           <option value="{{ $deliverysetting->id}}" <?php if($deliverysetting->id == $editproduct->deliveryflab){echo 'selected';}?>>{{ $deliverysetting->title}}</option>
                                           <?php }?>
                                            </select>
                                </div>
                            </div>
                              <div class="form-group">
                              <label for="exampleInputUsername1">Tax status</label>
                              <select class="form-control" name="taxstatus">
                              <option>Select Tax Status</option>
                              <option value="Taxable" <?php if($editproduct->taxstatus == "Taxable"){echo 'selected';}?>>Taxable</option>
                              <option value="NotTaxable" <?php if($editproduct->taxstatus == "NotTaxable"){echo 'selected';}?>>Not Taxable</option>
                              </select>
                              </div>
                              <br>
                              <div class="form-group">
                              <label for="exampleInputUsername1">Tax </label>
                              <select class="form-control" name="tax">
                              <option value="0">Select Tax</option>
                              <?php foreach($tax as $taxdata) {?>
                              <option value="{{$taxdata->id}}" <?php if($editproduct->tax == $taxdata->id){echo 'selected';}?>>{{$taxdata->tax_name}}</option>
                              <?php }?>
                              </select>
                              </div>
                              <div class="form-group">
                              <label for="exampleInputUsername1">Tax With</label>
                              <select class="form-control" name="taxwith">
                              <option value="0">Select Tax With</option>
                              <option vaule="including">including</option>
                              <option vaule="excluding">excluding</option>
                              </select>
                              </div>
                              <div class="form-group">
                              <h6><strong>SEO</strong></h6><br>
                              <label for="exampleInputUsername1">SEO Page Title</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="title" value="<?php echo $editproduct->seo_title;?>">
                              </div>
                              <div class="form-group">
                              <label for="exampleInputEmail1">SEO Description</label>
                              <textarea class="form-control" id="seodescription" rows="4" name="seodescription" ><?php echo $editproduct->seo_description;?></textarea>
                              </div>
                              <div class="form-group">
                              <label for="exampleInputEmail1">SEO Key</label>
                              <input type="text" class="form-control" id="seokey" placeholder="" name="seokey" value="<?php echo $editproduct->seo_key;?>">
                              </div>
                              <div class="form-group">
                              <label for="exampleInputEmail1">SEO URL and Handle</label>
                              <input type="text" class="form-control" id="urlhandle" placeholder="" name="urlhande" value="<?php echo $editproduct->seo_url;?>">
                              </div>
                              <button type="submit" class="btn btn-gradient-primary mr-2">Next</button>
                        </form>
                        </div>
                        <div class="tab-pane <?php if(isset($editvarientproductidfinal)){ ?>fade show active<?php }else{ ?><?php }?>" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                            
                            <form id="variationformedit">
                            <div class="form-group">
                                <h5><strong>Variants</strong></h5>
                            </div>
                            <div class="form-group">
                                <h6><strong>OPTIONS</strong></h6>
                                <br>
                                <div class="row">
                                   <div class="col-md-3"><label>Attribute</label></div>
                                   <div class="col-md-4"><label>Attribute Term</label></div>
                                   <!--<div class="col-md-2"><label>Attribute Image</label></div>-->
                                   <!--<div class="col-md-2"><label>Attribute Quantity</label></div>-->
                                </div>
                                <input type="hidden" name="hiddenattrcount" id="hiddenattrcount" value="<?php echo count($editattributedatavalue);?>">
                                <input type="hidden" name="productlastid" id="productlastid" value="{{$editproduct->id}}">
                                <div class="" id="optionsdata">
                                   <?php foreach($editattributedatavalue as $key => $editattributedatavaluedata){ 
                                      //   $attrselectdata = DB::table('attribute_terms')->where(array('id'=> $editattributedatavalue->term_id))->first();
                                          $attributtermnew = DB::table('attribute_terms')->where('attributeid','=',$editattributedatavaluedata->attribute_id)->get();
                                            $attrname =  DB::table('tbl_attribute')->where(array('id'=> $editattributedatavaluedata->attribute_id))->first();
                                            $explodeterm = explode(',',$editattributedatavaluedata->term_id);
                                        
                                       
                                      ?>    
                                   <div class="row">
                                      <input type="hidden" id="optiondataidnew" value="0" name="optiondataidnew">
                                      <div class="col-md-3">
                                         <select onchange="getterms(this,<?php echo $key;?>);getperivewoption(this);" class="form-control" name="attributetype[]" value="" id="attributetype0">
                                            <option>Select Option</option>
                                            <?php 
                                               foreach($attributeedit as $attributeeditvalue){
                                               
                                               
                                               ?>
                                            <option value="<?php echo $attributeeditvalue->id;?>"   <?php if($attributeeditvalue->id == $editattributedatavaluedata->attribute_id){ echo 'selected';} ?> ><?php echo $attributeeditvalue->name;?></option>
                                            <?php }?>
                                         </select>
                                      </div>
                                      <div class="col-md-4">
                                         <select class="" multiple="multiple" style="width:100%" name="attributeterm[]" id="attributeterm0" onchange="getattributeterm(this,0)" placeholder="Select Attribute Term" >
                                            <?php foreach($attributtermnew as $attributtermnewval){
                                               foreach($explodeterm as $explodetermval){
                                               ?>
                                            <option value="{{ $attributtermnewval->id}}" <?php if($attributtermnewval->id == $explodetermval){echo 'selected';}?>>{{ $attributtermnewval->name}}</option>
                                            <?php } }?>
                                         </select>
                                      </div>
                                      <!--<div class="col-md-2">-->
                                      <!--    <input type="file" name="varientimage[]" class="form-control">-->
                                      <!--</div>-->
                                      <!--<div class="col-md-2">-->
                                      <!--     <input type="text" name="varientquantity[]" class="form-control" placeholder ="quantity">-->
                                      <!--</div>-->
                                   </div>
                                   <br>
                                   <?php }?>
                                </div>
                                <br>
                                <div class="col-md-4">
                                   <button onclick = "saveattributeedit()" type="button" class="btn"  value="1">Save</button><br><br>
                                   <button onclick = "editaddotheroption()" type="button" class="btn" id="editbtndata" value="1">Add Another Option</button><br>
                                </div>
                             </div>
                            </form>
                            <form id="updatevarientsform" method="POST" action="{{ route('updatevarients') }}" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                <div class="form-group" id="vartionattribute">
                           
                                  <div id="updatevarientmsg" ></div>
                                  <div class="row">
                                  <div class="col-md-3"><b>Terms</b></div>
                                  <div class="col-md-2"><b>Quantity</b></div>
                                  <div class="col-md-2"><b>Sku</b></div>
                                  <div class="col-md-2"><b>Price</b></div>
                                  <div class="col-md-3"><b>Attribute Image</b></div>
                                  </div>
                                  <?php
                                  
                                     foreach($productvarient as $productvarientval)
                                     {
                                         $explodeterms = explode(',',$productvarientval->term_id);
                                     ?>  
                                  <div class="row">
                                  <input type="hidden" name="hiddenvarientid[]" value="<?php echo $productvarientval->id;?>">
                                  <div class="col-md-3">
                                  <?php
                                     $termsnamearray = array();
                                     foreach($explodeterms as $explodetermsval)
                                     {
                                         $termsdetail = DB::table('attribute_terms')->where('id','=',$explodetermsval)->first();
                                       array_push($termsnamearray,$termsdetail->name);
                                     }
                                     ?>
                                  <input type="text" class="form-control" value="<?php echo implode(',',$termsnamearray);?>" readonly> 
                                  </div>
                                  <div class="col-md-2"><input type="text" class="form-control" name="editvarientqty[]" value="<?php echo $productvarientval->attribute_quantity;?>"></div>
                                  <div class="col-md-2"><input type="text" class="form-control" name="editvarientsku[]" value="<?php echo $productvarientval->sku;?>"></div>
                                  <div class="col-md-2"><input type="text" class="form-control" name="editvarientprice[]" value="<?php echo $productvarientval->attrprice;?>"></div>
                                   <div class="col-md-3"><input type="hidden" name="hiddeneditattributeimage[]" value="<?php echo $productvarientval->attribute_image; ?>"><input type="file" name="editattributeimage[]" ><img src="{{asset('productimg')}}/<?php echo $productvarientval->attribute_image; ?>" style="width:100px;height:100px;"></div>
                                  </div><br>
                                  <?php    
                                     }
                                     ?>
                                  <br>
                                  <div class="col-md-3">
                                  <!--<button type="button" onclick="updatevarient()">Update</button>-->
                                  </div>
                                  </div>
                                <div class="col-md-2"><button type="button" class="btn btn-gradient-primary mr-2" onclick="updatevarient()">Save</button></div>
                            </form>  
                              
                        </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <?php }else {?>
            <div class="row">
                <div class="col-md-3">
                    <div class="card-body">
                        <button class="buttondata buttondata2"><a href="{{ url('categories')}}">Categories</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('brand')}}">Brand</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('attributes')}}">Attributes</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('product')}}">Product</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('productlist')}}">Product List</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('importproduct')}}">Import Product</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('importpriceproduct')}}">Update Product Price</a></button>
                       

                    </div>
                </div>
            <div class="col-md-9 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add New Products</h4>
                  
                    <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                         <?php if(isset($varientproductidfinal)){?>
                         <li class="nav-item" role="presentation">
                           
                            <a
                              class="nav-link "
                              id="ex1-tab-1"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-1"
                              role="tab"
                              aria-controls="ex1-tabs-1"
                              aria-selected="true"
                              >Product</a
                            >
                          </li>
                           <li class="nav-item" role="presentation">
                            <a
                              class="nav-link active"
                              id="ex1-tab-2"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-2"
                              role="tab"
                              aria-controls="ex1-tabs-2"
                              aria-selected="false"
                              >Product Varient</a
                            >
                          </li>
                           
                            <?php }else{?>
                             <li class="nav-item" role="presentation">
                           
                            <a
                              class="nav-link active"
                              id="ex1-tab-1"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-1"
                              role="tab"
                              aria-controls="ex1-tabs-1"
                              aria-selected="true"
                              >Product</a
                            >
                          </li>
                          <li class="nav-item" role="presentation" style="pointer-events: none;">
                            <a
                              class="nav-link"
                              id="ex1-tab-2"
                              data-mdb-toggle="tab"
                              href="#ex1-tabs-2"
                              role="tab"
                              aria-controls="ex1-tabs-2"
                              aria-selected="false"
                              >Product Varient</a
                            >
                          </li>
                            <?php }?>
                         
                        
                          
                        </ul>
                        <div class="tab-content" id="ex1-content">
                      <div
                        class="tab-pane <?php if(isset($varientproductidfinal)){}else{?>fade show active<?php }?>"
                        id="ex1-tabs-1"
                        role="tabpanel"
                        aria-labelledby="ex1-tab-1"
                      >
                  <form class="" method="POST" action="{{ url('/addproduct')}}"  enctype="multipart/form-data" id="addproduct">
                      {{ csrf_field() }}
                     
              
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                      <input type="text" class="form-control" id="productname" placeholder="Name" name="name">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                             <label for="exampleInputUsername1">Sale Status</label>
                            <select name="sale_status" class="form-control">
                                <option>Select</option>
                                 <option value="For Sale">For Sale</option>
                                  <option value="Not For Sale">Not For Sale</option>
                            </select>
                            </div>
                        <div class="col-md-4">
                             <label for="exampleInputUsername1">Purchase Status</label>
                            <select name="purchase_status" class="form-control">
                                <option>Select</option>
                                 <option value="For Purchase">For Purchase</option>
                                  <option value="Not For Purchase">Not For Purchase</option>
                            </select>
                            </div>
                              <div class="col-md-4">
                             <label for="exampleInputUsername1">HSN/SAC</label>
                            <input type="text" class="form-control" name="hsn" >
                            </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleInputUsername1">Category</label>
                            <select class="form-control js-example-basic-multiple" name="category" multiple="multiple" id="addcategory">
                                <option value="0">Select Category</option>
                                <?php foreach($category as $category) { 
                                    $subcategory = DB::table('tbl_categories')->where(array('pid' => $category->id))->get();
                                ?>
                              <option value="<?php echo $category->id;?>" class="opt">
                                 <?php echo $category->name;?></option>
                                    <?php 
                                        foreach($subcategory as $subcategory)
                                        {
                                            $subcategorytwo = DB::table('tbl_categories')->where(array('pid' => $subcategory->id))->get();
                                           
                                            ?>
                                            
                                                    <option value="<?php echo $subcategory->id;?>" class="opt1">-----<?php echo $subcategory->name;?></option>
                                            <?php
                                            if($subcategorytwo != '')
                                            {
                                                foreach($subcategorytwo as $subcategorytwo)
                                                {?>
                                                <option value="<?php echo $subcategorytwo->id;?>" class="opt2">---------------<?php echo $subcategorytwo->name;?></option>
                                            <?php        
                                                }
                                            }
                                            
                                        }
                                        
                                         
                                    ?>
                                    <hr class="opt3"></hr>
                                <?php }?>
                               
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputUsername1">Brand</label>
                            <select class="form-control" name="brand">
                                <option>Select Brand</option>
                                <?php foreach($brand as $brand) { ?>
                                <option value="<?php echo $brand->id;?>"><?php echo $brand->name;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                     
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                    </div>
                    
                    <div class="form-group">
                            <label for="document">Media</label>
                            <div class="needsclick dropzone" id="document-dropzone">
                    
                            </div>
                        </div>
                    <div class="dropzoneimg"></div>
                    <div class="form-group">
                        <label><strong>Product Data</strong></label>
                        <br>
                        <label>Product Type</label>
                        <div class="row">
                            <div class="col-md-3">
                                <select class="form-control" name="producttype" id="producttype"  onchange="getexternallink(this)">
                                    <option value="1">Simple Product</option>
                                    <option value="2">Group Product</option>
                                    <option value="3">External/Affilate Product</option>
                                    <option value="6">Variable Product</option>
                                    <option value="8">Composite Product</option>
                                    <option value="9">Custom Product</option>
                                </select>
                            </div>
                            <div class="col-md-1" id="virtualproduct" >
                                <input type="checkbox" id="virtual" name="virtual" >
                                <label for="quantity" style="padding-top:7px;">Virtual</label>
                            </div>
                            <div class="col-md-2" id="downloadableproduct" >
                               
                                <input type="checkbox" id="download" name="download" >
                                <label for="quantity" style="padding-top:7px;">Downloadable</label>
                            </div>    
                        </div>
                        <br><br>
                        <div class="tab">
                                <button type="button" class="tablinks" onclick="openCity(event, 'Genral')" id="defaultOpen" style="border-radius: 0px;">Genral</button>
                                <button type="button" class="tablinks" onclick="openCity(event, 'Inventory')" style="border-radius: 0px;">Inventory</button>
                                <button  type="button" class="tablinks" onclick="openCity(event, 'Shipping')" style="border-radius: 0px;" id="shippinghidetab">Shipping</button>
                                <button  type="button" class="tablinks" onclick="openCity(event, 'linkproducts')" style="border-radius: 0px;">Linked Products</button>
                                
                            </div>
                            
                            <div id="Genral" class="tabcontent">
                                
                                <div class="" id="exteranlaffilateinput" style="display:none;">
                                    <br><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Product Url</label>
                                            
                                        </div>
                                         <div class="col-md-6">
                                           <input type="text" class="form-control" name="producturl" Placeholder="Enter the external URL to the product.">
                                            
                                        </div>
                                    </div><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label>Button Text</label>
                                            
                                        </div>
                                         <div class="col-md-6">
                                           <input type="text" class="form-control" name="buttontxt" Placeholder="This text will be shown on the button linking to the external product.">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top:25px;">
                                    
                                <div class="row" id="groupproductdiv" style="display:none;">
                                    <div class="col-md-6">
                                    <label for="exampleInputUsername1">Group Product</label>
                                    <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="groupproductdata[]">
                                       
                                        <?php foreach($product as $productdatafinal)
                                        {?>
                                            <option value="{{ $productdatafinal->id}}">{{ $productdatafinal->product_name}}</option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    
                                </div>
                                <div class="row" id="customproductdiv" style="display:none;">
                                   <div class="row" style="padding-left: 25px;" id="customproduct">
                                    <div class="row" style="padding-left: 25px;">
                                    <?php
                                    $unit = DB::table('tbl_unit')->get();
                                    ?>
                                   <div class="col-md-3">
                                    <label for="exampleInputUsername1">Unit</label>
                                   
                                        <select class="form-control" name="unit" onchange="getunit(this)" id="unit">
                                             <?php foreach($unit as $unit){?>
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                            <?php }?>
                                            </select>
                                    
                                    </div>
                                     <div class="col-md-2" id="heightdiv"  style="display:none">
                                    <label for="exampleInputUsername1">Height</label>
                                    <input type="text" class="form-control" name="unitheight" id="unitheight">
                                    </div>
                                    <div class="col-md-2" id="widthdiv" style="display:none">
                                    <label for="exampleInputUsername1">Width</label>
                                    <input type="text" class="form-control" name="unitwidth" onchange="getarea(this)">
                                    </div>
                                    <div class="col-md-2" id="areadiv" style="display:none">
                                    <label for="exampleInputUsername1">Area</label>
                                    <input type="text" class="form-control" name="unitarea" id="unitarea">
                                    </div>
                                    <div class="col-md-2" id="qtydiv" style="display:none">
                                    <label for="exampleInputUsername1">Quantity</label>
                                    <input type="text" class="form-control" name="unitqty" id="qtyunit" onchange="getarea(this)">
                                    </div>
                                    <div class="col-md-2">
                                    <label for="exampleInputUsername1">Price</label>
                                    <input type="text" class="form-control" name="unitprice" id="unitprice">
                                    </div>
                                    
                                    
                                    </div>
                                     
                                </div>
                               
                                </div>
                                <br><br>
                                 <div class="row" id="compositproductdiv" style="display:none;">
                                   <div class="row" style="padding-left: 25px;" id="compositdata">
                                    <div class="row" style="padding-left: 25px;">
                                    <div class="col-md-6">
                                    <label for="exampleInputUsername1">Product</label>
                                    <select class="form-control" style="width:100%" name="compositproductdata[]">
                                       
                                        <?php foreach($product as $productdatafinal)
                                        {?>
                                            <option value="{{ $productdatafinal->id}}">{{ $productdatafinal->product_name}}</option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                     <div class="col-md-3">
                                    <label for="exampleInputUsername1">Qty</label>
                                    <input type="text" class="form-control" name="compositqty[]">
                                    </div>
                                    </div>
                                     
                                </div>
                                <div class="row" style="padding-left: 25px;"><div class="col-md-3"><button class="btn btn-default" 
                                      onclick="addcomposit()" type="button">Add </button></div></div>
                                </div>
                                <br><br>
                                <label><strong>Pricing</strong></label>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                    <label for="exampleInputUsername1">Regular price($)</label>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tax</button>
                                          <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Inc. Tax</a>
                                            <a class="dropdown-item" href="#">Excl. Tax</a>
                                           
                                          </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with dropdown button" id="regularprice" placeholder="" name="regualrprice">
                                      </div>
                                    </div>
                                    
                                    </div>
                                    <div class="col-md-6">
                                    <label for="exampleInputUsername1">Sale price($)</label>
                                     <div class="form-group">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tax</button>
                                          <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Inc. Tax</a>
                                            <a class="dropdown-item" href="#">Excl. Tax</a>
                                           
                                          </div>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Text input with dropdown button" id="saleprice" placeholder="" name="saleprice">
                                      </div>
                                    </div>
                                   
                                    <br>
                                    <label class="form-check-label" style="padding-left: 30px;">
                                    <input type="checkbox" class="form-check-input" name="dates" id="enddate">Schedule</label>
                                    <div id="enddata" style="display:none">
                                        <h6>Sale Price Date</h6>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <h5 class="">From</h5>
                                            <input type="date" class="form-control" name="salestart" id="endd">
                                        </div>
                                        <br>
                                        <div class="col-md-6">
                                            <h5 class="">To</h5>
                                            <input type="date" class="form-control" name="saleend" id="endd">
                                        </div>
                                        </div>
                                    </div>
                                     </div>
                                </div>
                                </div>
                                <div class="form-group" style="padding-top:25px;">
                                <div class="" id="downloadinput" style="display:none;">
                                        
                                        
                                        <div class="form-group">
                                        <div class="row">
                                        <div class="col-md-4" >
                                            <h6>Download Limit</h6>
                                        <input type="number" name="downloadlimit" class="form-control" placeholder="Unlimited">
                                        </div>
                                        <div class="col-md-4" >
                                            <h6>Download Expiry</h6>
                                        <input type="date" name="downloadexpairy" class="form-control" placeholder="Never">
                                        </div>
                                        </div>
                                        </div>
                                        <label>Downloadable Files: </label>
                                        <br><br>
                                        <input type="hidden" name="countdata" id="countdata" value="1">
                                        <div id="downloaddata">
                                            <div class="row">
                                            <div class="col-md-4">
                                            <input type="text" class="form-control"  name="downloadfile[]" placeholder="File name">
                                            </div>
                                            
                                            
                                                <div class="col-md-4">
                                            <input type="text" class="form-control"  name="downloadurl[]" placeholder="http://">
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4" style="padding-top:20px;">
                                        <button onclick = "addfile()" type="button" class="btn"  value="1">Add File</button>
                                        </div>
                                        <br>
                                       
                                    
                                </div>
                                </div>
                            </div>
                            
                            <div id="Inventory" class="tabcontent">
                               <div class="form-group">
                        
                                    <h5><strong>Inventory</strong></h5>
                                    <div class="row">
                                    <div class="col-md-6">
                                  <label for="exampleInputEmail1">SKU (Stock Keeping Unit)</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="sku">
                                  </div>
                                  <br>
                                  
                                  <div class="col-md-6">
                                   <label for="exampleInputEmail1">Barcode (ISBN, UPC, GTIN, etc.)</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="barcode">
                                  </div>
                                  
                                   <div class="col-md-6">
                                    <br><br>   
                                  <label for="exampleInputEmail1"> Manage stock?</label>
                                  <input type="checkbox" class="" id="enablestock" name="enablestock" value="1" >Enable stock management at product level
                                  </div>
                                  <br>
                                  </div>
                                  <div class="row" id="stockdetails" style="display:none;">
                                    <div class="col-md-6">
                                    <label for="exampleInputEmail1">Stock quantity</label>
                                    <input type="number" class="form-control" id="exampleInputUsername1" placeholder="" name="stockquantity">
                                    </div><br>
                                    <div class="col-md-6">
                                    <label for="exampleInputEmail1">Allow backorders?</label>
                                    <select class="form-control" name="allowbarcodes">
                                        <option value="no">Do not allow</option>
                                        <option value="notify">Allow, but notify customer</option>
                                        <option value="yes">Allow</option>
                                    </select>
                                    </div><br>
                                    <div class="col-md-6">
                                    <label for="exampleInputEmail1">Low stock threshold</label>
                                    <input type="number" class="form-control" id="exampleInputUsername1" placeholder="" name="stockthreshold">
                                    </div>
                                  </div>
                                  <br>
                                  <input type="checkbox" id="quantity" name="quantity">
                                  <label for="quantity">Track Quantity</label>
                                  <br>
                                  <input type="checkbox" id="outofstock" name="quantity">
                                  <label for="quantity">Continue selling when out of stock</label>
                                </div>
                                <div class="row" id="quantityinput" style="display:none;">
                                <div class="col-md-6 form-group">
                                        
                                        <label for="exampleInputUsername1">Min Qunatity</label>
                                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="minquantity">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        
                                        <label for="exampleInputUsername1">Max Qunatity</label>
                                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="maxquantity">
                                    </div>
                                </div>
                            </div>
                            
                            <div id="Shipping" class="tabcontent">
                             
                                    <h5><strong>Shipping</strong></h5>
                                    
                                    <!--<input type="checkbox" id="shipping" name="shipping">-->
                                    <!--<label>This is a physical product</label>-->
                                    
                                    <div class="" id="shippingdetails" >
                                    
                                    
                                    
                                    <div class="row">
                                    
                                    
                                    <div class="col-md-4">
                                        <label>Weight</label>
                                    <input name="weight" id="ShippingCardWeight" placeholder="0.0" class="form-control" aria-labelledby="ShippingCardWeightLabel" aria-invalid="false" aria-multiline="false" value="0.0">
                                    </div>
                                    <div class="col-md-2">
                                     <label></label>
                                    <select id="ShippingCardWeightUnit" name="weightUnit" class="form-control" style="height: 48px;">
                                        <option value="POUNDS">lb</option>
                                        <option value="OUNCES">oz</option>
                                        <option value="KILOGRAMS">kg</option>
                                        <option value="GRAMS">g</option>
                                    </select>
                                   
                                    </div>
                                    </div>
                                    <br> <br>
                                     <div class="row">
                                        <div class="col-md-4">
                                        <label>Shipping Class</label>
                                        </div>
                                        
                                         <div class="col-md-3">
                                        <select class="form-control" name="shippingclass">
                                            <option>Shipping Class</option>
                                            <?php foreach($shippingclass as $shippingclass){?>
                                            <option value="{{$shippingclass->id}}" >{{$shippingclass->title}}</option>
                                            <?php }?>
                                        </select>
                                        </div>
                                    </div><br>
                                    <div class="row">
                                    <div class="col-md-1">
                                    <label>Dimension</label>
                                    </div>
                                    <div class="col-md-3">
                                    <input type="text" class="form-control" name="length" placeholder="Length">
                                    </div>
                                    <div class="col-md-3">
                                    <input type="text" class="form-control" name="width" placeholder="Width">
                                    </div>
                                    
                                    <div class="col-md-3">
                                    <input type="text" class="form-control" name="height" placeholder="Height">
                                    </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                       
                                        
                                        
                                        <div class="col-md-4">
                                            <label>Country/Region of origin</label>
                                        <select id="countries" name="country" class="form-control">
                                            <option>Select Country/Region</option>
                                            <?php
                                            foreach($country as $country)
                                            { ?>
                                                <option value="<?php echo $country->countrycode; ?>"><?php echo $country->countryname; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        </div>
                                        <br>
                                        
                                        
                                    </div>
                                    </div>
                               
                            </div>
                            
                            <div id="linkproducts" class="tabcontent">
                                <div class="row">
                                <div class="col-md-6">
                                <lable>Upsell</lable>
                                <input type="text" name="upsell" class="form-control">
                                </div>
                                </div>
                                <br>
                                <div class="row">
                                <div class="col-md-6">
                                 <lable>Cross-sell</lable>
                                <input type="text" name="crosssell" class="form-control">
                                </div>
                                </div>
                            </div>
                            
                            
                        <div class="row">
                          
                      
                        </div>
                        <br>
                        
                    </div>
                    <div class="col-md-8">
                    
                </div>
                    <!--<div class="form-group">-->
                    <!--    <label><strong>Pricing</strong></label>-->
                    <!--    <div class="row">-->
                    <!--    <div class="col-md-6">-->
                    <!--    <label for="exampleInputUsername1">Price</label>-->
                    <!--        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Rs: 0.00" name="price">-->
                    <!--    </div><br><br>-->
                      
                    <!--  <div class="col-md-6">-->
                    <!--  <label for="exampleInputUsername1">Compare at Price</label>-->
                    <!--  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Rs: 0.00" name="cmpprice">-->
                    <!--  </div><br><br> </div>-->
                    <!--  <div class="row">-->
                    <!--  <div class="col-md-6" style="padding-top:25px;">-->
                    <!--  <label for="exampleInputUsername1">Cost per item</label>-->
                    <!--  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Rs: 0.00" name="cpr">-->
                    <!--  </div>-->
                    <!--   </div>-->
                    <!--</div>-->
                    
                   
                    <br>
                    <div class="form-group">
                            <label for="exampleInputUsername1">Product Gallery</label>
                            <input type="file" name="productgallery[]" class="form-control" multiple="multiple">
                    </div>
                    <div class="row">
                           <div class="col-md-6">
                                <label for="exampleInputUsername1">Warehouse</label>
                                <select class="form-control" name="warehouse">
                                <option>Select Warehouse</option>
                                <?php foreach($warehouse as $warehouse){?>
                               <option value="{{ $warehouse->id}}">{{ $warehouse->name}}</option>
                               <?php }?>
                                </select>
                           </div>
                           <div class="col-md-6">
                               <label for="exampleInputUsername1"></label>
                               Create Warehouse
                           </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                                    <label for="exampleInputUsername1">Delivery Flab</label>
                                    <select class="form-control" name="deliveryflab">
                                    <option>Select Delivery Flab</option>
                                    <?php foreach($deliverysetting as $deliverysetting){?>
                                   <option value="{{ $deliverysetting->id}}">{{ $deliverysetting->title}}</option>
                                   <?php }?>
                                    </select>
                        </div>
                    </div>
                    <br>
                     <div class="form-group">
                            <label for="exampleInputUsername1">Tax status</label>
                            <select class="form-control" name="taxstatus">
                                <option>Select Tax Status</option>
                                <option value="Taxable">Taxable</option>
                                <option value="NotTaxable">Not Taxable</option>
                            </select>
                    </div>
                    <br>
                     <div class="form-group">
                            <label for="exampleInputUsername1">Tax </label>
                            <select class="form-control" name="tax">
                                <option value="0">Select Tax</option>
                                <?php foreach($tax as $taxdata) {?>
                                <option value="{{$taxdata->id}}">{{$taxdata->tax_name}}</option>
                                <?php }?>
                            </select>
                    </div>
                    <div class="form-group">
                            <label for="exampleInputUsername1">Tax With</label>
                            <select class="form-control" name="taxwith">
                                <option value="0">Select Tax With</option>
                                
                                <option vaule="including">including</option>
                               <option vaule="excluding">excluding</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="seodescription" rows="4" name="seodescription"></textarea>
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">SEO Key</label>
                        <input type="text" class="form-control" id="seokey" placeholder="" name="seokey">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="urlhandle" placeholder="" name="urlhande">
                    </div>
                    <button type="button" class="btn btn-gradient-primary mr-2"  onclick="addproduct()">Next</button>
                    
                  </form>
                  </div>
                  <div class="tab-pane fade <?php if(isset($varientproductidfinal)){?>fade show active<?php }else{?><?php }?>" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                                 <form id="variationform">
                                 <div class="form-group">
                                     <h5><strong>Variants</strong></h5>
                                    
                                </div>
                                <div class="form-group">
                                    <h6><strong>OPTIONS</strong></h6><br>
                                    <div class="row">
                                        <input type="hidden" name="productlastid" id="productlastid" value="<?php if(isset($varientproductidfinal)){echo $varientproductidfinal;}?>">
                                        <div class="col-md-3"><label>Attribute</label></div>
                                        <div class="col-md-4"><label>Attribute Term</label></div>
                                        <!--<div class="col-md-2"><label>Attribute Image</label></div>-->
                                        <!--<div class="col-md-2"><label>Attribute Quantity</label></div>-->
                                    </div>
                                    
                                    <div class="" id="optionsdata">
                                    <div class="row">
                                       
                                        <input type="hidden" id="optiondataidnew" value="0" name="optiondataidnew">
                                        <div class="col-md-3"><select onchange="getterms(this,0);getperivewoption(this,1);" class="form-control" name="attributetype[]" value="" id="attributetype0">
                                            <option>Select Option</option>
                                            <?php foreach($attribute as $attribute){?>
                                            <option value="<?php echo $attribute->id;?>"    ><?php echo $attribute->name;?></option>
                                        <?php }?></select></div>
                                        <div class="col-md-4">
                                            <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="attributeterm[]" id="attributeterm0" onchange="getattributeterm(this,1)" placeholder="Select Attribute Term">
                                                
                                            </select>
                                            <input type="hidden" name="mainselectoption" id="mainselectoption1">
                                        </div>
                                        <!--<div class="col-md-2">-->
                                        <!--    <input type="file" name="varientimage[]" class="form-control">-->
                                        <!--</div>-->
                                        <!--<div class="col-md-2">-->
                                        <!--     <input type="text" name="varientquantity[]" class="form-control" placeholder ="quantity">-->
                                        <!--</div>-->
                                        
                                    </div>
                                    </div>
                                    <br>
                                    <div class="col-md-4">
                                        <button onclick = "saveattribute()" type="button" class="btn"  value="1">Save</button><br><br>
                                    <button onclick = "addotheroption()" type="button" class="btn" id="btndata" value="1">Add Another Option</button><br>
                                    
                                    </div>
                                </div>
                                </form>
                            
                                <form id="attributevaritionform" method="POST" action="{{ route('saveattributevariationdata') }}" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                      <input type="hidden" name="productlastid" id="productlastid" value="<?php if(isset($varientproductidfinal)){echo $varientproductidfinal;}?>">
                                    <div class="form-group">
                                         <h5><strong>Variation</strong></h5>
                                        
                                    </div>
                                    <div class="form-group" id="vartionattribute">
                                    
                                    </div>
                                    <div class="col-md-2"><button type="button" class="btn btn-gradient-primary mr-2" onclick="savevariationdata()">Save</button></div>
                                </form>
                    </div>
                   </div>
                </div>
              </div>
            </div>
            </div>
            <?php }?>
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Image </th>
                          <th>Name </th>
                          
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($product as $productdata){
                            $media = explode(',',$productdata->product_media);
                            $replace = array('<p>','</p>');
                            $text =  str_replace($replace,'',$productdata->product_description);
                        ?>
                        <tr>
                        <td>{{ $i }}</td>
                        <td><?php foreach($media as $productdatamedia){?>
                        <img src="{{asset('productimg')}}<?php echo '/'.$productdatamedia;?>" style="height:100px;width:100px;">
                        <?php }?> </td>
                        <td>{{ $productdata->product_name }}</td>
                       
                        <td><a href="{{url('/productedit/'.$productdata->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/productdelete/'.$productdata->id)}}"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php $i++;}?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
           
          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@include('footer')

<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('projects.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
       
      $('.dropzoneimg').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('.dropzoneimg').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('.dropzoneimg').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script>

<script>
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace('seodescription');
</script>
<script>
    $(".js-example-basic-multiple").select2();
    function addproduct()
    {
        var saleprice = $('#saleprice').val();
        var regularprice = $('#regularprice').val();
        var productname = $('#productname').val();
        var catgory = $("#addcategory").val();
    
        if(regularprice > saleprice)
        {
            alert('Regularprice is not greater than sellerprice');
        }else if(productname == '')
        {
            alert('Please add product name');
        }else if(catgory == null)
        {
            alert('Please Select category');
        }else
        {
            $('#addproduct').submit();
        }
    }
    $(document).ready(function(){
        $('#quantity').click(function(){
            if($(this).prop("checked") == true){
                console.log("Checkbox is checked.");
                $('#quantityinput').css('display','');
            }
            else if($(this).prop("checked") == false){
                $('#quantityinput').css('display','none');
            }else
            {
                $('#quantityinput').css('display','none');
            }
        });
        $('#shipping').click(function(){
            if($(this).prop("checked") == true){
                
                $('#shippingdetails').css('display','');
            }
            else if($(this).prop("checked") == false){
                $('#shippingdetails').css('display','none');
            }
        });
        $('#download').click(function(){
            if($(this).prop("checked") == true){
               
                $('#downloadinput').css('display','');
                $(this).val(5);
            }
            else if($(this).prop("checked") == false){
                $('#downloadinput').css('display','none');
                $(this).val(0);
            }
        });
        $('#virtual').click(function(){
            if($(this).prop("checked") == true){
               
                $('#shippinghidetab').css('display','none');
                $(this).val(4);
            }
            else if($(this).prop("checked") == false){
                $('#shippinghidetab').css('display','');
                $(this).val(0);
            }
        });
        
       
        $("#enddate").click(function() {
        if($(this).is(":checked")) {
            $("#enddata").show();
            } else {
            $("#enddata").hide();
        }
        });
        $('#enablestock').click(function(){
             if($(this).prop("checked") == true){
               
                $('#stockdetails').css('display','block');
                
            }
        })
        
    });
    function getterms(the,count)
    {
        var attribute = $(the).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getterms') }}", 
            type:"POST",
            data:{attribute: attribute},
            success: function(result){
            $("#attributeterm"+count+"").html(result);
        }});
    }
    function addotheroption()
    {
        var arrayFromPHP = <?php echo json_encode($attr); ?>;
        var btndata = $('#btndata').val();
        var btncount = parseInt(btndata) +1;
        var html = '';
        for (var i = 0; i < arrayFromPHP.length; i++) {
           
             html += '<option value="'+arrayFromPHP[i]['id']+'">'+arrayFromPHP[i]['name']+'</option>';
        };
        
         $('#btndata').val(btncount);
        $('#optionsdata').append('<div class="row" id="attributetypedatamultiple'+btncount+'"><div class="col-md-3"><select onchange="getterms(this,'+btncount+');getperivewoption(this,'+btncount+')" class="form-control" name="attributetype[]" id="attributetype'+btndata+'"><option>Select Option</option>'+html+'</select></div><div class="col-md-4"><select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="attributeterm[]" id="attributeterm'+btncount+'"  onchange="getattributeterm(this,'+btncount+')"></select><input type="hidden" name="mainselectoption" id="mainselectoption'+btncount+'"></div><div class="col-md-1"><i class="fa fa-trash" onclick="removeoptiontype('+btncount+')"></i></div></div><br>');
        $('#optiondataidnew').val(btncount);
        for(var j=1; j <= btncount; j++)
        {
          console.log(".js-example-basic-multiple"+j+"");
         if ($(".js-example-basic-multiple"+j+"").length) {
            $(".js-example-basic-multiple"+j+"").select2();
          }
        }
         
    }
    function editaddotheroption()
    {
         var arrayFromPHP = <?php echo json_encode($attr); ?>;
        var btndata = $('#editbtndata').val();
        var btncount = parseInt(btndata) +1;
        var html = '';
        for (var i = 0; i < arrayFromPHP.length; i++) {
           
             html += '<option value="'+arrayFromPHP[i]['id']+'">'+arrayFromPHP[i]['name']+'</option>';
        };
        
         $('#editbtndata').val(btncount);
        $('#optionsdata').append('<div class="row" id="attributetypedatamultiple'+btncount+'"><div class="col-md-3"><select onchange="getterms(this,'+btncount+');getperivewoption(this,'+btncount+')" class="form-control" name="attributetype[]" id="attributetype'+btndata+'"><option>Select Option</option>'+html+'</select></div><div class="col-md-4"><select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="attributeterm[]" id="attributeterm'+btncount+'"  onchange="getattributeterm(this,'+btncount+')"></select><input type="hidden" name="mainselectoption" id="mainselectoption'+btncount+'"></div><div class="col-md-1"><i class="fa fa-trash" onclick="removeoptiontype('+btncount+')"></i></div></div><br>');
        $('#optiondataidnew').val(btncount);
        for(var j=1; j <= btncount; j++)
        {
          console.log(".js-example-basic-multiple"+j+"");
         if ($(".js-example-basic-multiple"+j+"").length) {
            $(".js-example-basic-multiple"+j+"").select2();
          }
        }
    }
    //  function addotheroption()
    // {
    //     var arrayFromPHP = <?php echo json_encode($attr); ?>;
    //     var btndata = $('#btndata').val();
    //     var btncount = parseInt(btndata) +1;
    //     var html = '';
    //     for (var i = 0; i < arrayFromPHP.length; i++) {
           
    //          html += '<option value="'+arrayFromPHP[i]['id']+'">'+arrayFromPHP[i]['name']+'</option>';
    //     };
        
        
    //     $('#optionsdata').append('<div class="row" id="attributetypedatamultiple'+btncount+'"><div class="col-md-3"><select onchange="getterms(this,'+btncount+');getperivewoption(this,'+btncount+')" class="form-control" name="attributetype[]" id="attributetype'+btndata+'"><option>Select Option</option>'+html+'</select></div><div class="col-md-4"><select class="js-example-basic-multiple'+btncount+'" multiple="multiple" style="width:100%" name="attributeterm[]" id="attributeterm'+btncount+'"  onchange="getattributeterm(this,'+btncount+')"></select><input type="hidden" name="mainselectoption" id="mainselectoption'+btncount+'"></div><div class="col-md-1"><i class="fa fa-trash" onclick="removeoptiontype('+btncount+')"></i></div></div><br>');
    //     $('#optiondataidnew').val(btncount);
    //     // for(var j=1; j <= btncount; j++)
    //     // {
         
    //         $(".js-example-basic-multiple"+btncount+"").select2();
          
    //     // }
    //       $('#btndata').val(btncount);
    // }
    
    function getselected(id)
    {
       
    }
    function addfile()
    {
        var countdata = $('#countdata').val();
        $('#downloaddata').append('<br><div class="row" id="downloadiddata'+countdata+'" ><div class="col-md-4"><input type="text" class="form-control"  name="downloadfile[]" placeholder="File name"></div><div class="col-md-4"><input type="text" class="form-control"  name="downloadurl[]" placeholder="http://"></div><div class="col-md-2"><span style="padding-left: 30px;"><i class="fa fa-trash" onclick="deletetrash('+countdata+')"></i></span></div></div>');
        $('#countdata').val(parseInt(countdata)+1);
    }
    $('#producttype').change(function()
    {
       var producttypedata = $(this).val();
       if(producttypedata == 1)
       {
            $('#virtualproduct').css('display','block');
            $('#downloadableproduct').css('display','block');
       }else
       {
            $('#virtualproduct').css('display','none');
            $('#downloadableproduct').css('display','none');
       }
       
    });
     var optionarray = [];
     var attributetermdata = [];
    
    function getperivewoption(the,count)
    {
       
       
        var optiondata = $(the).val();
        $('#mainselectoption'+count+'').val(optiondata);
         
            // if(optionarray[i] != i)
            optionarray.push(optiondata);
                    var zz=    optionarray.filter(function(itm, i, optionarray){
                return i == optionarray.indexOf(itm);
            });
        
        
     console.log(zz);
        
    }
    function getattributeterm(the,count)
    {
        
        var attributeterm = $(the).val();
        var mainselectid = $('#mainselectoption'+count+'').val();
     
       attributetermdata.push(attributeterm);
                    var kk=    attributetermdata.filter(function(itm, i, attributetermdata){
                return i == attributetermdata.indexOf(itm);
            });
        
                    
        console.log(kk);
        
    }
    function getexternallink(the)
    {
        var selectedid = $(the).val();
        if(selectedid == 3)
        {
            $('#exteranlaffilateinput').css('display','');
            $('#groupproductdiv').css('display','none');
            $('#compositproductdiv').css('display','none');
            $('#customproductdiv').css('display','none');
        }else if(selectedid == 2)
        {
            $('#exteranlaffilateinput').css('display','none');
            $('#groupproductdiv').css('display','block');
            $('#compositproductdiv').css('display','none');
            $('#customproductdiv').css('display','none');
        }else if(selectedid == 8){
            $('#exteranlaffilateinput').css('display','none');
            $('#groupproductdiv').css('display','none');
            $('#compositproductdiv').css('display','block');
            $('#customproductdiv').css('display','none');
          
        }else if(selectedid == 9){
            $('#exteranlaffilateinput').css('display','none');
            $('#groupproductdiv').css('display','none');
            $('#compositproductdiv').css('display','none');
            $('#customproductdiv').css('display','block');
        }
        else
        {
            $('#exteranlaffilateinput').css('display','none');
            $('#groupproductdiv').css('display','none');
            $('#compositproductdiv').css('display','none');
            $('#customproductdiv').css('display','none');
        }
    }
    function setattribute()
    {
        console.log(optionarray);
        console.log(attributetermdata);
        var html = '<table class="table"><thead><th>SrNo<th><th>Image<th><th>A<th><thead>';
        for(var i =0 ; i < optionarray.length; i++)
        {
            html = ''
        }
    }
    function deletetrash(count)
    {
      
        $('#downloadiddata'+count).remove();
    }
    function removeoptiontype(count)
    {
        $('#attributetypedatamultiple'+count).remove();
    }
    </script>
     <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
    <script>
    function addcomposit()
    {
      
        var arrayFromPHP = <?php echo json_encode($product); ?>;
       
        var html = '';
        for (var i = 0; i < arrayFromPHP.length; i++) {
           
             html += '<option value="'+arrayFromPHP[i]['id']+'">'+arrayFromPHP[i]['product_name']+'</option>';
        };
        var finalhtml = ' <div class="row" style="padding-left: 25px;" id="compositremovediv"><div class="col-md-5">'+
                            '<label for="exampleInputUsername1">Product</label>'+
                            '<select class="form-control" style="width:109%" name="compositproductdata[]">'
                               +html+
                               
                            '</select>'+
                            '</div>'+
                             '<div class="col-md-3" style="padding-left: 41px;">'+
                            '<label for="exampleInputUsername1">Qty</label>'+
                            '<input type="text" class="form-control" name="compositqty[]">'+
                            '</div> <div class="col-md-3" style="padding-top:25px;">'+
                                    '<a  class="remove_button"><i class="fa fa-trash"></i></a>'+
                                    '</div></div>';

        $('#compositdata').append(finalhtml);

    }
    $(document).on('click', '.remove_button', function () {
      
        $(this).closest('#compositremovediv').remove();
    });
    // $('.remove_button').click(function()
    // {
     
    //   $(this).parent('div').remove();
    // })
    function saveattribute()
    {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('saveattributedata') }}", 
            type:"POST",
            data:$('#variationform').serialize(),
            success: function(result){
            // $('#Attributes').css('display','none');
            // $('#Varitaion').css('display','block');
            // $('#attributedatatab').removeClass('active');
            
            // $('#variationdata').addClass('active');
            $('#vartionattribute').html(result);

        }});
        
    }
    function saveattributeedit()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('saveattributedata') }}", 
            type:"POST",
            data:$('#variationformedit').serialize(),
            success: function(result){
           
            $('#vartionattribute').html(result);

        }});
    }
    function updatevarient()
    {
        
        $('#updatevarientsform').submit();
       
    }

    function savevariationdata()
    {
        $('#attributevaritionform').submit();
        //  $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
       
        // var totcount = $("#totcount").val();
//         var imgarray = [];
//         for(var i =1;i < totcount;i++)
//         {
//              var file_data = $("#attributeimage1").prop("files");
             
//              imgarray.push(file_data);
//         }
//      console.log(imgarray);
//   var datatab = JSON.stringify(imgarray);
//   console.log(JSON.stringify(imgarray));
        // let formData = $('#addproduct').serialize();
        // alert(datatab);
// var form_data = new FormData();
// form_data.append("file", imgarray);
           
  
        // $.ajax({
        //     url: "{{ route('saveattributevariationdata') }}", 
        //     type:"POST",
        //      dataType:"json",
           
        //     cache: false,
        //     data: $('#addproduct').serialize(),
        //     enctype: 'multipart/form-data',
        //     processData: false,  // tell jQuery not to process the data
        //     descriptionType: false,   
        //     success: function(result){
        //     $('#Attributes').css('display','none');
        //     $('#Varitaion').css('display','block');
        //     $('#attributedatatab').removeClass('active');
            
        //     $('#variationdata').addClass('active');
        //     $('#vartionattribute').html(result);

        // }});
    }

    function savevariationdataedit()
    {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        var totcount = $("#totcount").val();
        var imgarray = [];
        for(var i =1;i < totcount;i++)
        {
             var file_data = $("#attributeimage"+i+"").prop("files");
             imgarray.push(file_data);
        }
     
  var datatab = JSON.stringify(imgarray);
  alert(datatab);
        $.ajax({
            url: "{{ route('saveattributevariationdata') }}", 
            type:"POST",
            data:$('#updateproduct').serialize(),
          
            success: function(result){
            $('#Attributes').css('display','none');
            $('#Varitaion').css('display','block');
            $('#attributedatatab').removeClass('active');
            
            $('#variationdata').addClass('active');
            $('#vartionattribute').html(result);

        }});
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
function getunit(the)
{
     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var unitid = $(the).val()
    $.ajax({
            url: "{{ route('getunitprice') }}", 
            type:"POST",
            data:{unitid:unitid},
          
            success: function(result){
            $('#unitprice').val(result);

        }});
    if($(the).val() == 4 || $(the).val() == 5)
    {
        $('#qtydiv').css('display','block');
        $('#heightdiv').css('display','none');
        $('#widthdiv').css('display','none');
        $('#areadiv').css('display','none');
    }else if($(the).val() == 1 || $(the).val() == 2)
    {
        $('#heightdiv').css('display','block');
        $('#widthdiv').css('display','block');
        $('#areadiv').css('display','block');
        $('#qtydiv').css('display','none');
    }
}
function getarea(the)
{
    var unit = $('#unit').val();
    
    var unitprice = $('#unitprice').val();
    var qtyunit = $('#qtyunit').val();
    if(unit == 1 || unit == 2)
    { 
        var unitheight = $('#unitheight').val();
        var width = $(the).val();
        var tot = parseFloat(unitheight) * parseFloat(width);
        var final = parseFloat(unitprice) * parseFloat(tot);
        $('#unitarea').val(tot);
        $('#regularprice').val(final);
        $('#saleprice').val(final);
        
    }else if(unit == 4 || unit == 5)
    {
        var tot = parseFloat(qtyunit) * parseFloat(unitprice);
       
        $('#regularprice').val(tot);
        $('#saleprice').val(tot);
    }
    
}
</script>

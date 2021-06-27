@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Proposal List Item
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proposal List Item</li>
              </ol>
            </nav>
          </div>
            <div class="row">
               <div class="col-md-4"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
            <div class="row">
            <?php if(isset($edititem)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Proposal List Item </h4>
                    <div class="row">
                        <form method="POST" action="{{ url('/updateitem')}}"  enctype="multipart/form-data"> 
                               
                                 {{ csrf_field() }}
                               <input type="hidden" name="hiddenid" value="<?php echo $edititem->id;?>">
                                <div class="row">
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Proposal</label>
                                         
                                            <input type="text" name="proposalid" value="{{ $proposallistdata->proposal_ref_id }}" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Product type</label>
                                        <select class="form-control" name="producttype" onchange="getproducttype(this)"  id="producttype">
                                                    <option>Select</option>
                                                    <option value="Simple Product" <?php if($edititem->product_type == 'Simple Product'){echo 'selected';}?>>Simple Product</option>
                                                    <option value="Custom Product"<?php if($edititem->product_type == 'Custom Product'){echo 'selected';}?>>Custom Product</option>
                                                    
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Product</label>
                                        <select class="form-control js-example-basic-multiple" name="productid" onchange="getproductdeatils(this);"  id="productdataid" multiple="multiple" >
                                                    <option></option>
                                                    <?php foreach($product as $productval){?>
                                                    <option value="{{ $productval->id}}" <?php if($edititem->product_id == $productval->id){echo 'selected';}?>>{{ $productval->product_name}}</option>
                                                    <?php }?>
                                        </select>
                                    </div>
                                </div><br>
                                 <div class="row" id="heightcustom">
                                   
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Price</label>
                                         <input type="text" class="form-control" name="price" id="productpriceid" value="<?php echo $edititem->price;?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Qty</label>
                                        <input type="text" class="form-control" name="qty" id="qty" value="<?php echo $edititem->qty;?>">
                                    </div>
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Discount</label>
                                        <input type="text" class="form-control" name="discount" onchange="gettotal(this)" value="<?php echo $edititem->discount;?>">
                                    </div>
                                </div><br>
                                 <div class="row">
                                    <div class="col-md-4" id="taxtype">
                                         <label for="exampleInputUsername1">Tax type</label>
                                         <select class="form-control" name="taxtype"  readonly>
                                                <option>Select Tax Type</option>
                                                <option value="Including Tax" <?php if($edititem->taxtype == 'Including Tax'){echo 'selected';}?>>Including Tax</option>
                                                 <option value="Excluding Tax" <?php if($edititem->taxtype == 'Excluding Tax'){echo 'selected';}?>>Excluding Tax</option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Tax</label>
                                        <input type="text" class="form-control" name="tax" id="tax" readonly value="<?php echo $edititem->tax;?>">
                                    </div>
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Total</label>
                                        <input type="text" class="form-control" name="total" id="total" value="<?php echo $edititem->total;?>">
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4" id="taxtype">
                                         <label for="exampleInputUsername1">Total with tax</label>
                                         <input type="text" class="form-control" name="totaltax" id="totaltax" value="<?php echo $edititem->totaltax;?>">
                                    </div>
                                    <!--<div class="col-md-4">-->
                                    <!--    <label for="exampleInputUsername1">Tax</label>-->
                                    <!--    <input type="text" class="form-control" name="tax" id="tax" readonly style="width: 70px;">-->
                                    <!--</div>-->
                                    <!--<div class="col-md-4">-->
                                    <!--     <label for="exampleInputUsername1">Total</label>-->
                                    <!--    <input type="text" class="form-control" name="total" id="total" style="width: 100px;">-->
                                    <!--    </select>-->
                                    <!--</div>-->
                                </div>
                              <!--  <table class="table">-->
                              <!--      <thead>-->
                              <!--          <th>Proposal</th>-->
                              <!--           <th>Product type</th>-->
                              <!--      <th>Product</th>-->
                              <!--      <th>Price</th>-->
                              <!--      <th>Qty</th>-->
                              <!--      <th>Discount</th>-->
                              <!--      <th>Tax type</th> -->
                              <!--       <th>Tax </th>-->
                                    
                              <!--      <th>Total</th> -->
                              <!--      <th>Total with tax</th> -->
                                       
                              <!--      </thead>-->
                              <!--      <tbody>-->
                              <!--          <tr>-->
                              <!--              <td>{{ $proposallistdata->proposal_ref_id }}-->
                              <!--              <input type="hidden" name="proposalid" value="{{ $proposallistdata->proposal_ref_id }}"></td>-->
                              <!--              <td>-->
                              <!--                  <select class="form-control" name="producttype" onchange="getproducttype(this)" style="width: 120px;" id="producttype">-->
                              <!--                      <option>Select</option>-->
                              <!--                      <option value="1">Simple Product</option>-->
                              <!--                      <option value="2">Custom Product</option>-->
                                                    
                              <!--                  </select>-->
                              <!--              </td>-->
                              <!--              <td>-->
                                           
                              <!--                  <select class="form-control" name="productid" onchange="getproductdeatils(this);" style="width: 120px;" id="productdataid">-->
                              <!--                      <option></option>-->
                              <!--                      <?php foreach($product as $productval){?>-->
                              <!--                      <option value="{{ $productval->id}}">{{ $productval->product_name}}</option>-->
                              <!--                      <?php }?>-->
                              <!--                  </select>-->
                              <!--              </td>-->
                              <!--              <td><input type="text" class="form-control" name="price" id="productpriceid" style="width: 70px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="qty" id="qty" style="width: 70px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="discount" onchange="gettotal(this)" style="width: 70px;"></td>-->
                              <!--                <td id="taxtype"><select class="form-control" name="taxtype" style="width: 129px;" readonly>-->
                              <!--                  <option>Select Tax Type</option>-->
                              <!--                  <option value="including">Including Tax</option>-->
                              <!--                   <option value="excluding">Excluding Tax</option>-->
                              <!--              </select></td>-->
                              <!--              <td><input type="text" class="form-control" name="tax" id="tax" readonly style="width: 70px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="total" id="total" style="width: 100px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="totaltax" id="totaltax" style="width: 100px;"></td>-->
                                            
                              <!--              <td></td>-->
                                            
                                            
                                            
                              <!--          </tr>-->
                              <!--      </tbody>-->
                              <!--</table>-->
                              <div class="col-md-2"><button type="submit" class="btn btn-default">Update</button></div>
                                </form>
                          </div>
                          <hr>
                </div>
                </div>
            </div>
      
   
   
            <?php }else {?>
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Proposal List Item</h4><div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Proposal List Item</h4> 
                    <div class="">
                        
                                <form method="POST" action="{{ route('additeminproposal')}}"> 
                               
                                 {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Proposal</label>
                                         
                                            <input type="text" name="proposalid" value="{{ $proposallistdata->proposal_ref_id }}" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Product type</label>
                                        <select class="form-control" name="producttype" onchange="getproducttype(this)"  id="producttype">
                                                    <option>Select</option>
                                                    <option value="1">Simple Product</option>
                                                    <option value="2">Custom Product</option>
                                                    
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Product</label>
                                        <select class="form-control js-example-basic-multiple" name="productid" onchange="getproductdeatils(this);"  id="productdataid" multiple="multiple">
                                                    <option></option>
                                                    <?php foreach($product as $productval){?>
                                                    <option value="{{ $productval->id}}">{{ $productval->product_name}}</option>
                                                    <?php }?>
                                        </select>
                                    </div>
                                </div><br>
                                 <div class="row" id="heightcustom">
                                   
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Price</label>
                                         <input type="text" class="form-control" name="price" id="productpriceid" >
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Qty</label>
                                        <input type="text" class="form-control" name="qty" id="qty" onchange="gettotal(this)" >
                                    </div>
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Discount</label>
                                        <input type="text" class="form-control" name="discount" id="discount" value="0" onchange="gettotal(this)" >
                                    </div>
                                </div><br>
                                 <div class="row">
                                    <div class="col-md-4" id="taxtype">
                                         <label for="exampleInputUsername1">Tax type</label>
                                         <select class="form-control" name="taxtype"  disabled="disabled">
                                                <option>Select Tax Type</option>
                                                <option value="including">Including Tax</option>
                                                 <option value="excluding">Excluding Tax</option>
                                            </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputUsername1">Tax</label>
                                        <input type="text" class="form-control" name="tax" id="tax" readonly value="0" >
                                    </div>
                                    <div class="col-md-4">
                                         <label for="exampleInputUsername1">Total</label>
                                        <input type="text" class="form-control" name="total" id="total" >
                                        </select>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4" id="taxtype">
                                         <label for="exampleInputUsername1">Total with tax</label>
                                         <input type="text" class="form-control" name="totaltax" id="totaltax" >
                                    </div>
                                    <!--<div class="col-md-4">-->
                                    <!--    <label for="exampleInputUsername1">Tax</label>-->
                                    <!--    <input type="text" class="form-control" name="tax" id="tax" readonly style="width: 70px;">-->
                                    <!--</div>-->
                                    <!--<div class="col-md-4">-->
                                    <!--     <label for="exampleInputUsername1">Total</label>-->
                                    <!--    <input type="text" class="form-control" name="total" id="total" style="width: 100px;">-->
                                    <!--    </select>-->
                                    <!--</div>-->
                                </div>
                              <!--  <table class="table">-->
                              <!--      <thead>-->
                              <!--          <th>Proposal</th>-->
                              <!--           <th>Product type</th>-->
                              <!--      <th>Product</th>-->
                              <!--      <th>Price</th>-->
                              <!--      <th>Qty</th>-->
                              <!--      <th>Discount</th>-->
                              <!--      <th>Tax type</th> -->
                              <!--       <th>Tax </th>-->
                                    
                              <!--      <th>Total</th> -->
                              <!--      <th>Total with tax</th> -->
                                       
                              <!--      </thead>-->
                              <!--      <tbody>-->
                              <!--          <tr>-->
                              <!--              <td>{{ $proposallistdata->proposal_ref_id }}-->
                              <!--              <input type="hidden" name="proposalid" value="{{ $proposallistdata->proposal_ref_id }}"></td>-->
                              <!--              <td>-->
                              <!--                  <select class="form-control" name="producttype" onchange="getproducttype(this)" style="width: 120px;" id="producttype">-->
                              <!--                      <option>Select</option>-->
                              <!--                      <option value="1">Simple Product</option>-->
                              <!--                      <option value="2">Custom Product</option>-->
                                                    
                              <!--                  </select>-->
                              <!--              </td>-->
                              <!--              <td>-->
                                           
                              <!--                  <select class="form-control" name="productid" onchange="getproductdeatils(this);" style="width: 120px;" id="productdataid">-->
                              <!--                      <option></option>-->
                              <!--                      <?php foreach($product as $productval){?>-->
                              <!--                      <option value="{{ $productval->id}}">{{ $productval->product_name}}</option>-->
                              <!--                      <?php }?>-->
                              <!--                  </select>-->
                              <!--              </td>-->
                              <!--              <td><input type="text" class="form-control" name="price" id="productpriceid" style="width: 70px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="qty" id="qty" style="width: 70px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="discount" onchange="gettotal(this)" style="width: 70px;"></td>-->
                              <!--                <td id="taxtype"><select class="form-control" name="taxtype" style="width: 129px;" readonly>-->
                              <!--                  <option>Select Tax Type</option>-->
                              <!--                  <option value="including">Including Tax</option>-->
                              <!--                   <option value="excluding">Excluding Tax</option>-->
                              <!--              </select></td>-->
                              <!--              <td><input type="text" class="form-control" name="tax" id="tax" readonly style="width: 70px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="total" id="total" style="width: 100px;"></td>-->
                              <!--              <td><input type="text" class="form-control" name="totaltax" id="totaltax" style="width: 100px;"></td>-->
                                            
                              <!--              <td></td>-->
                                            
                                            
                                            
                              <!--          </tr>-->
                              <!--      </tbody>-->
                              <!--</table>-->
                              <div class="col-md-2"><button type="submit" class="btn btn-default">Add</button></div>
                                </form>
                          </div>
                          <hr>
                </div>
                </div></div></div></div></div>
            <?php }?>  
            </div>
            <div class="row" >
                <?php if(isset($editcustomproduct)){
            
                ?>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      
                    <div class="card-body">
                          <h3>Custom Product</h3><br>
                        <form method="POST" action="{{ route('customproductupdate')}}">
                            {{ csrf_field() }}
                        <input type="hidden" name="customhiddenid" value="<?php echo $editcustomproduct->id;?>">
                        <input type="hidden" name="customhiddenproposalid" value="<?php echo $proposalid;?>">
                        
                            <div class="row" style="padding-left: 25px;">
                                    <?php
                                    $unit = DB::table('tbl_unit')->get();
                                     $tax = DB::table('tbl_tax')->get();
                                    ?>
                                    <div class="col-md-6">
                                    <label for="exampleInputUsername1">Product Name</label>
                                     <input type="text" class="form-control" name="productname" id="productname" value="<?php echo $editcustomproduct->productname;?>">
                                    </div>
                                      <div class="col-md-6">
                                    <label for="exampleInputUsername1">HSN/SIC</label>
                                     <input type="text" class="form-control" name="hsn" id="hsn" value="<?php echo $editcustomproduct->hsn;?>">
                                    </div>
                                   <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Unit</label>
                                   
                                        <select class="form-control" name="unit" onchange="getunit(this)" id="unitedit">
                                             <?php foreach($unit as $unit){?>
                                            <option value="{{$unit->id}}" @if($editcustomproduct->unit == $unit->id) selected @endif>{{$unit->unit_name}}</option>
                                            <?php }?>
                                            </select>
                                    
                                    </div>
                                    <br>
                                     <div class="col-md-6" id="heightdiv"  @if($editcustomproduct->unit == 1 || $editcustomproduct->unit == 2) style="display:block;padding-top:20px;"  @else style="display:none;" @endif>
                                    <label for="exampleInputUsername1">Height</label>
                                    <input type="text" class="form-control" name="unitheight" id="unitheightedit" value="<?php echo $editcustomproduct->height;?>">
                                    </div>
                                    <div class="col-md-6" id="widthdiv" @if($editcustomproduct->unit == 1 || $editcustomproduct->unit == 2) style="display:block;padding-top:20px;" @else style="display:none;"  @endif>
                                    <label for="exampleInputUsername1">Width</label>
                                    <input type="text" class="form-control" name="unitwidth"  id="unitwidthedit" onchange="getarea(this)" value="<?php echo $editcustomproduct->width;?>">
                                    </div><br>
                                    <div class="col-md-6" id="areadiv"  @if($editcustomproduct->unit == 1 || $editcustomproduct->unit == 2) style="display:block;padding-top:20px;" @else style="display:none;"  @endif>
                                    <label for="exampleInputUsername1">Area</label>
                                    <input type="text" class="form-control" name="unitarea" id="unitareaedit" value="<?php echo $editcustomproduct->area;?>">
                                    </div>
                                    <div class="col-md-6" id="qtydiv"  @if($editcustomproduct->unit == 3 || $editcustomproduct->unit == 4) style="display:block;padding-top:20px;" @else style="display:none;" @endif>
                                    <label for="exampleInputUsername1">Quantity</label>
                                    <input type="text" class="form-control" name="unitqty" id="qtyunitedit"  value="<?php echo $editcustomproduct->qty;?>">
                                    </div><br>
                                    <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Price</label>
                                    <input type="text" class="form-control" name="unitprice" id="unitpriceedit" onchange="getareapriceedit(this)" value="<?php echo $editcustomproduct->price;?>">
                                    </div>
                                    <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Total </label>
                                    <input type="text" class="form-control" name="totalprice" id="totalpriceedit" value="<?php echo $editcustomproduct->total;?>">
                                    </div>
                                     <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Tax type </label>
                                    <select class="form-control" name="taxwith">
                                        <option value="0">Select Tax With</option>
                                        
                                        <option vaule="including" @if($editcustomproduct->taxtype == "including") selected @endif>including</option>
                                       <option vaule="excluding" @if($editcustomproduct->taxtype == "excluding") selected @endif>excluding</option>
                                    </select>
                                    </div>
                                     <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Tax </label>
                                        <select class="form-control" name="tax">
                                            <option value="0">Select Tax</option>
                                            <?php foreach($tax as $taxdata) {?>
                                            <option value="{{$taxdata->id}}" @if($editcustomproduct->tax == $taxdata->id) selected @endif>{{$taxdata->tax_name}}</option>
                                            <?php }?>
                                        </select>
                                    </div>
                            </div><br>
                            <div class="col-md-3"><button class="btn btn-default" type="submit">Submit</button></div>
                       
                        </form>
                        <br>
                       
                    </div>
                    </div>
                </div>
                <?php }else {?>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                      
                    <div class="card-body">
                          <h3>Custom Product</h3><br>
                        <form method="POST" action="{{ route('customproductadd')}}">
                            {{ csrf_field() }}
                        
                            <div class="row" style="padding-left: 25px;">
                                    <?php
                                    $unit = DB::table('tbl_unit')->get();
                                     $tax = DB::table('tbl_tax')->get();
                                    ?>
                                    <div class="col-md-6">
                                    <label for="exampleInputUsername1">Product Name</label>
                                     <input type="text" class="form-control" name="productname" id="productname">
                                    </div>
                                      <div class="col-md-6">
                                    <label for="exampleInputUsername1">HSN/SIC</label>
                                     <input type="text" class="form-control" name="hsn" id="hsn">
                                    </div>
                                   <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Unit</label>
                                   
                                        <select class="form-control" name="unit" onchange="getunit(this)" id="unit">
                                             <?php foreach($unit as $unit){?>
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                            <?php }?>
                                            </select>
                                    
                                    </div>
                                    <br>
                                     <div class="col-md-6" id="heightdiv"  style="display:none;padding-top:20px;">
                                    <label for="exampleInputUsername1">Height</label>
                                    <input type="text" class="form-control" name="unitheight" id="unitheight">
                                    </div>
                                    <div class="col-md-6" id="widthdiv" style="display:none;padding-top:20px;">
                                    <label for="exampleInputUsername1">Width</label>
                                    <input type="text" class="form-control" name="unitwidth"  id="unitwidth" onchange="getarea(this)">
                                    </div><br>
                                    <div class="col-md-6" id="areadiv" style="display:none;padding-top:20px;">
                                    <label for="exampleInputUsername1">Area</label>
                                    <input type="text" class="form-control" name="unitarea" id="unitarea">
                                    </div>
                                    <div class="col-md-6" id="qtydiv" style="display:none;padding-top:20px;">
                                    <label for="exampleInputUsername1">Quantity</label>
                                    <input type="text" class="form-control" name="unitqty" id="qtyunit" onchange="getarea(this)">
                                    </div><br>
                                    <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Price</label>
                                    <input type="text" class="form-control" name="unitprice"  onchange="getareaprice(this)" id="unitprice">
                                    </div>
                                    <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Total </label>
                                    <input type="text" class="form-control" name="totalprice" id="totalprice">
                                    </div>
                                     <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Tax type </label>
                                    <select class="form-control" name="taxwith">
                                        <option value="0">Select Tax With</option>
                                        
                                        <option vaule="including">including</option>
                                       <option vaule="excluding">excluding</option>
                                    </select>
                                    </div>
                                     <div class="col-md-6" style="padding-top:20px;">
                                    <label for="exampleInputUsername1">Tax </label>
                                        <select class="form-control" name="tax">
                                            <option value="0">Select Tax</option>
                                            <?php foreach($tax as $taxdata) {?>
                                            <option value="{{$taxdata->id}}" >{{$taxdata->tax_name}}</option>
                                            <?php }?>
                                        </select>
                                    </div>
                            </div><br>
                            <div class="col-md-3"><button class="btn btn-default" type="submit">Submit</button></div>
                       
                        </form>
                        <br>
                       
                    </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="col-md-12">
                  <h4 class="card-title">Custom product List </h4>
                <table id="order-listing" class="table">
                    
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Product name</th>
                      <th>Product price</th>
                      <th>Product tax type</th>
                     
                        <th>Action</th>
                      
                    </tr>
                  </thead>
                  
                    <tbody>
                    <?php
                    $i = 1;
                    $sum =0;
                    $tax =0;
                   
                    foreach($customproduct as  $customproductval){ 
                  
                    
                    ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $customproductval->productname }}</td>
                        <td>{{ $customproductval->total }}</td>
                        <td>{{ $customproductval->taxtype }}</td>
                        
                        
                         <td>
                          <a href="{{url('/customproductedit/'.$customproductval->id.'/'.$proposalid)}}"><i class="fa fa-edit"></i></a> 
                      <a href="{{url('/customproductdelete/'.$customproductval->id)}}"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                    $i++;
                    }
                    ?>
                  </tbody>
                 
                </table>
              </div>
                </div>
                </div>
                </div>
            </div>
             
          <div class="row" >
            
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                  <div class="row" >
               
                 <div class="col-md-2">
                <a href="{{ route('proposalstatusupdate',$proposallistdata->id)}}" style="float:left;"><button class="btn btn-default"  >Accept Proposal</button></a>
                </div>
                <div class="col-md-2">
                <a href="{{ route('createPDF',$proposallistdata->id)}}" style="float:left;"><button class="btn btn-default">Export PDF</button></a></div>
                
                <div class="col-md-2">
                 <a href="{{ route('crminvoice',$proposallistdata->id)}}" style="float:left;"><button class="btn btn-default">Create Invoice</button></a></div>
                 <div class="col-md-2">
                 <a href="{{ route('invoicePDF',$proposallistdata->id)}}" style="float:left;"><button class="btn btn-default">Export Invoice</button></a></div>
                 </div><br><br>
                <div class="row">
                     
                  <div class="col-md-12">
                      <h4 class="card-title">Proposal List Item</h4>
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Proposal Id</th>
                          <th>Product</th>
                          <th>Price</th>
                          <th>Qunatity</th>
                          <th>Discount</th>
                          <th>Total Price</th>
                            <th>Action</th>
                          
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php
                        $i = 1;
                        $sum =0;
                        $tax =0;
                       
                        foreach($proposallist as  $proposallistval){ 
                            if($proposallistval->product_type == 1)
                            {
                                $product = DB::table('tbl_product')->where(array('id' => $proposallistval->product_id))->first();
                                $productname = $product->product_name;
                                $proposal = DB::table('lead_proposal')->where(array('proposal_ref_id' => $proposallistval->proposal_id))->first();
                               
                                $sum += $proposallistval->total;
                                if($product->taxwith == 'excluding')
                                {
                                    $tax += $proposallistval->tax;
                                }else
                                {
                                    $tax += 0;
                                }
                            }else
                            {
                                
                                $product = DB::table('custom_product')->where(array('id' => $proposallistval->product_id))->first();
                                if(isset($product))
                                {
                                    $productname = $product->productname;
                                    $proposal = DB::table('lead_proposal')->where(array('proposal_ref_id' => $proposallistval->proposal_id))->first();
                               
                                    $sum += $proposallistval->total;
                                    if($product->taxtype == 'excluding')
                                    {
                                        $tax += $proposallistval->tax;
                                    }else
                                    {
                                        $tax += 0;
                                    }
                                }else
                                {
                                    $proposal = DB::table('lead_proposal')->where(array('proposal_ref_id' => $proposallistval->proposal_id))->first();
                                    $productname = '';
                                    $tax = 0;
                                }
                                
                                
                                
                            }
                        ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $proposal->proposal_ref_id }}</td>
                            <td>{{ $productname }}</td>
                            <td>{{ $proposallistval->price }}</td>
                            <td>{{ $proposallistval->qty }}</td>
                            <td>{{ $proposallistval->discount }}</td>
                            <td>{{ $proposallistval->total }}</td>
                            
                             <td> <a class="btn btn-default" href="{{url('/transfer/'.$customproductval->id.'/'.$proposal->id)}}">Create Purchase Order</a>
                             <a href="{{url('/itemedit/'.$proposallistval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/proposalitemdelete/'.$proposallistval->id)}}"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php
                        $i++;
                        }
                        
                          $taxpercentage = $sum * ($tax/100);
           $totaltax = $sum - $taxpercentage;
                        ?>
                                    <tr>
                            <td></td>
                            <td ></td>
                            <td ></td> 
                            <td ></td>
                             <td ></td>
                             <td >Total(excl. tax)</td>
                            <td ><?php echo $totaltax;?></td>
                           
                        </tr>
                         <tr>
                            <td></td>
                            <td ></td>
                            <td ></td> 
                            <td ></td>
                             <td ></td>
                            <td >Tax</td>
                            <td ><?php echo $tax;?></td>
                        </tr>
                         <tr>
                            <td></td>
                            <td ></td>
                            <td ></td> 
                            <td ></td>
                             <td ></td>
                             <td >Total(inc. tax)</td>
                            <td ><?php echo $sum;?></td>
                        </tr>
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
  
    function getproductdeatils(the)
    {
        var productid = $(the).val();
        var producttype = $('#producttype').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getproductdeatils') }}", 
            type:"POST",
            data:{productid: productid,producttype:producttype},
            success: function(result){
                var obj = JSON.parse(result);
            $('#productpriceid').val(obj.saleprice);
            $('#taxtype').html(obj.taxtype);
            $('#tax').val(obj.tax);
            $('#heightcustom').html(obj.htmldata);
            
        }});
    }
    function gettotal(the)
    {
        var discount = $('#discount').val();
        var price =$('#productpriceid').val();
        var qty = $('#qty').val();
        var taxtype = $('#taxtypedata').val();
        var tax = $('#tax').val();
      
        if(taxtype == 'excluding')
        {
            var subtot = parseFloat(price) * parseFloat(qty);
             alert(subtot);
            var dis = parseFloat(subtot) * parseFloat(discount)/100;
            alert(dis);
            var totdata = parseFloat(subtot) - parseFloat(dis);
            alert(totdata);
            var taxtot = totdata * parseFloat(tax)/100;
            var tot = parseFloat(subtot) - parseFloat(dis);
            var tottaxprice = parseFloat(totdata) +   parseFloat(taxtot);
           // var tottaxprice = totdata;
            
        }else
        { 
            var subtot = parseFloat(price) * parseFloat(qty);
            alert(subtot);
            var dis = parseFloat(subtot) * parseFloat(discount)/100;
            var tot = parseFloat(subtot) - parseFloat(dis);
            var tottaxprice = tot;
        }
       
        $('#total').val(tot);
        $('#totaltax').val(tottaxprice);
    }
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
            var tot = parseFloat(unitheight) * parseFloat(width) / parseFloat(1000000) * parseFloat(10.764);
            var final = parseFloat(unitprice) * parseFloat(tot);
            $('#unitarea').val(tot);
            $('#totalprice').val(final);
           
            
        }else if(unit == 4 || unit == 5)
        {
            var tot = parseFloat(qtyunit) * parseFloat(unitprice);
           
            $('#totalprice').val(tot);
           
        }
        
    }
    function getareaprice(the)
    {
        var unit = $('#unit').val();
        
        var unitprice = $(the).val();
        var qtyunit = $('#qtyunit').val();
        if(unit == 1 || unit == 2)
        { 
            var unitheight = $('#unitheight').val();
            var width = $('#unitwidth').val();
           
            var tot = parseFloat(unitheight) * parseFloat(width) / parseFloat(1000000) * parseFloat(10.764);
            var final = parseFloat(unitprice) * parseFloat(tot);
            $('#unitarea').val(tot);
            $('#totalprice').val(final);
           
            
        }else if(unit == 4 || unit == 5)
        {
            var tot = parseFloat(qtyunit) * parseFloat(unitprice);
           
            $('#totalprice').val(tot);
           
        }
    }
    
    function getareapriceedit(the)
    {
       
         var unit = $('#unitedit').val();
        
        var unitprice = $(the).val();
        var qtyunit = $('#qtyunitedit').val();
        if(unit == 1 || unit == 2)
        { 
            
            var unitheight = $('#unitheightedit').val();
            var width = $('#unitwidthedit').val();
           
            var tot = parseFloat(unitheight) * parseFloat(width) / parseFloat(1000000) * parseFloat(10.764);
            var final = parseFloat(unitprice) * parseFloat(tot);
            $('#unitareaedit').val(tot);
            $('#totalpriceedit').val(final);
           
            
        }else if(unit == 4 || unit == 5)
        {
            var tot = parseFloat(qtyunit) * parseFloat(unitprice);
           
            $('#totalpriceedit').val(tot);
           
        }
    }
    function customgetheight()
    {
        var heightid = $('#heightid').val();
        var baseprice = $('#baseprice').val();
        var widthid = $('#widthid').val();
        var productpriceid = $('#productpriceid').val();
            var tot = parseFloat(heightid) * parseFloat(widthid) / parseFloat(1000000) * parseFloat(10.764);
            var final = parseFloat(baseprice) * parseFloat(tot);
           
            $('#areaid').val(tot);
            $('#productpriceid').val(final);
           
            
        
    }
    function getproducttype(the)
    {
         $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        var producttype = $(the).val()
        $.ajax({
                url: "{{ route('getproducttype') }}", 
                type:"POST",
                data:{producttype:producttype},
              
                success: function(result){
                $('#productdataid').html(result);
    
            }});
    }
    $(".js-example-basic-multiple").select2();
</script>

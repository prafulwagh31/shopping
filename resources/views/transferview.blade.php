@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Transfer
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transfer View</li>
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
          
          
           
           
                <form class="" method="POST" action="{{ url('/addtransfer')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-8">
                    <div class=" grid-margin stretch-card">
                    <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Transfer View </h4>
                     <input type='button' value='Delete' id='delete'><br><br>
                    <table id="" class="table">
                        
                      <thead>
                        <tr>
                          <th><input type="checkbox" id="checkAll"></th>
                          <th>#</th>
                          <th>Image </th>
                          <th>Name </th>
                          <th>Qunatity </th>
                          <th>Price</th>
                          <th>Tax</th>
                          <th>Tax Type</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          
                       <?php $i = 1;
                        
                       foreach($transferdata as $key =>  $transerproduct){
                            $product = DB::table('tbl_product')->where(array('id' => $transerproduct->productid))->first();
                            if(!empty($product))
                            {
                            $inventory  = DB::table('tbl_inventory')->where(array('product_id' => $transerproduct->productid))->first();
                            if($product != '')
                            {
                                if($product->product_media != '')
                                {
                                    $mediadata = explode(',',$product->product_media);
                                    $media = asset('productimg').'/'.$mediadata[0];
                                }else
                                {
                                    $media = asset('images').'/image.png';
                                }
                            }
                            
                          
                           if($inventory != '')
                            {
                                $min = $inventory->minqty;
                                $max = $inventory->maxqty;
                            }else
                            {
                                $min ='';
                                $max = '';
                            }
                            
                            $tax = DB::table('tbl_tax')->where(array('id' => $transerproduct->tax))->first();
                            if($transerproduct->taxtype == 'including')
                            {
                                $taxtype = "Inclusive";
                            }else if($transerproduct->taxtype == 'excluding')
                            {
                                $taxtype = "Exclusive";
                            }
                           
                        ?>
                        <input type="hidden" name="productid[]" value="{{ $product->id }}">
                        <tr>
                        <td><input type='checkbox' id='del_<?php echo $product->id; ?>' ></td>
                        <td style="width:50px;">{{ $i }}</td>
                        <td>
                        <img src="{{ $media }}" style="height:100px;width:100px;">
                         </td>
                        <td style="width:50px;">{{ $product->product_name }}
                        <br><br> {{ $inventory->sku }}</td>
                        <td><input type="text" name="qty[]" id="qty{{$i}}" class="form-control" value="<?php if($transerproduct->status != 'received') {?>{{ $transerproduct->quantity }}<?php } else{?>{{ $transerproduct->accept }}<?php }?>" style="width:70px;"></td>
                        <td><input type="text" name="price[]" id="price{{$i}}" class="form-control" value="<?php if($transerproduct->status != 'received') {?>{{ $transerproduct->price }}<?php } else{?>{{ $transerproduct->accept }}<?php }?>" style="width:100px;"></td>
                        <td><input type="text" name="tax[]" id="tax{{$i}}" class="form-control" value="<?php if($transerproduct->status != 'received') {?>{{ $tax->tax_name }}<?php } else{?>{{ $transerproduct->accept }}<?php }?>" style="width:100px;"></td>
                        <td><input type="text" name="taxtype[]" id="taxtype{{$i}}" class="form-control" value="<?php if($transerproduct->status != 'received') {?>{{ $taxtype }}<?php } else{?>{{ $transerproduct->accept }}<?php }?>" style="width:100px;"></td>
                       
                       
                        
                        
                        </tr>
                        <?php $i++;}
                       }
                        ?>
                        
                      </tbody>
                    </table>
                    <div class="row">
                        <?php if($transferdata[0]->status != 'received') {?>
                        <div class="col-md-6"></div>
                         <div class="col-md-3">
                        <a href="{{ url('completetransfer')}}/{{ $transfer->id }}"><button type="button" name="" class="btn-gradient-primary" >Mark As Complete</button></a>
                        </div>
                        <div class="col-md-3">
                        <a href="{{ route('reieveitem',$transfer->id) }}"><button type="button" name="addtransfer" >Receive Items</button></a>
                        </div>
                        <?php } else {?>
                        <p style="padding-left:20px;color:green">ALL ITEMS HAVE BEEN RECEIVED</p>
                        <?php }?>
                    </div>
                  </div>
                </div>
              </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Origin </h4>
                        <h5>Supplier</h5>
                        <select class="form-control" name="suppliername" >
                            <option>Select Supplier</option>
                            <?php foreach($vendor as $vendor){?>
                            <option value="{{ $vendor->id }}" <?php if($vendor->id == $transfer->supplierid){ echo 'selected';}?>>{{ $vendor->name }}</option>
                            <?php }?>
                        </select>
                        </div>
                        </div>
                        <br><br>
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Shipment </h4>
                        <h5>Expected arrival</h5>
                        <input type="date" name="expectedarrival" class="form-control" value="{{ $transfer->expected_arrival }}">
                        </div>
                        </div>
                        <br><br>
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Additional details </h4>
                        <h5>Reference number</h5>
                        <input type="text" name="refernecenumber" class="form-control" value="{{ $transfer->referencenumber }}">
                        </div>
                        </div>
                        <br><br>
                        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Tags </h4>
                        
                        <input type="text" name="tags" class="form-control" placeholder="Urgent,COD" value="{{ $transfer->tag }}">
                        </div>
                        </div>
                    </div> 
                    
            
                </div>
                <hr>
                <!--<div class="row">-->
                    
                <!--    <div class="col-md-8"></div>-->
                <!--    <div class="col-md-2">-->
                <!--    <button type="button" name="" class="btn-gradient-primary" >Cancel</button>-->
                <!--    </div>-->
                <!--    <div class="col-md-2">-->
                <!--    <button type="submit" name="addtransfer" >Save Transfer</button>-->
                <!--    </div>-->
                <!--</div>-->
                </form>
           
          
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@include('footer')
<script>
    $(document).ready(function(){

  $('#delete').click(function(){

    var post_arr = [];

    // Get checked checkboxes
    $('#order-listing input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {
        var id = this.id;
        var splitid = id.split('_');
        var postid = splitid[1];

        post_arr.push(postid);
        
      }
    });
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    if(post_arr.length > 0){

        var isDelete = confirm("Do you really want to delete records?");
        if (isDelete == true) {
           // AJAX Request
           $.ajax({
              url: "{{ route('deletemultipleproductdata') }}",
              type: 'POST',
              data: { post_id: post_arr},
              success: function(response){
                 $.each(post_arr, function( i,l ){
                     $("#tr_"+l).remove();
                 });
              }
           });
        } 
    } 
  });
 
});
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>



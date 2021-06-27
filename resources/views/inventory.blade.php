@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Inventory
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventory</li>
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
           
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Inventory List</h4>
                <input type='button' value='Delete' id='delete'><br><br>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th><input type="checkbox" id="checkAll"></th>
                          <th>#</th>
                          <th>Media</th>
                          <th>Product </th>
                          <th>SKU </th>
                          <th>When sold out </th>
                          <th>Incoming</th>
                          <th>Available</th>
                          <th>Edit quantity available</th>
                        
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($stock as $stock){
                            $product = DB::table('tbl_product')->where(array('id' => $stock->productid))->first();
                           
                            $inventory  = DB::table('tbl_inventory')->where(array('product_id' => $stock->productid))->first();
                            
                            $transfer = DB::table('transfer')->where(array('productid' => $stock->productid,'status' =>  '0'))->first();
                           
                            
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
                         
                           
                        ?>
                        <tr>
                        <td><input type='checkbox' id='del_<?php echo $product->id; ?>' ></td>
                        <td>{{ $i }}</td>
                        <td>
                        <img src="{{ $media }}" style="height:100px;width:100px;">
                         </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $inventory->sku }}</td>
                        <td>Stop selling</td>
                        <td><a href="{{ route('transfer') }}" title="Add a transfer to record incoming inventory."> <?php if(isset($transfer)){if($transfer->status != 'received'){?>{{ $transfer->quantity }}<?php } } else {?>0<?php }?></a></td>
                        <td>{{ $stock->stockqty }}</td>
                        <td><div class="row"><div class="col-md-2"><button type="button" class="btn btn-primary" style="color:black">Add</button></div><div class="col-md-2"><button type="button" class="btn btn-primary" style="color:black">Set</button></div><div class="col-md-5"><input type="number" class="form-control" name="qty[]"></div></div></td>
                        
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



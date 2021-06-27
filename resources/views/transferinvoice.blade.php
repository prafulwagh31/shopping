@include('header')

 
        <style type="text/css">
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
        .menu-sidebar {
            width: 300px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            background: #fff;
            overflow-y: unset !important;
        }

        </style>
        <style type="text/css">
        @media print
        {
        body * { visibility: hidden; }
        .printdiv * { visibility: visible; }
        
        }
        </style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Transfer List
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Transfer List</li>
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
                <div class="row printdiv" id='printMe'>
                           
                            <div class="col-lg-12">
                                <div class="au-card chart-percent-card">
                                    <div class="au-card-inner">
                                        <div class="row">
                                            <div class="col-xs-12" style="padding-left: 20px">
                                            <div class="invoice-title">
                                                <h2>Transfer</h2><br>
                                                <h3 style="" id="saleid"><?php echo $transfer->transferid;?></h3>
                                            </div>
                                            <hr>
                                            
                                            
                                                <div class="col-xs-12">
                                                    <address>
                                                    <strong><?php echo $vendor->name;?></strong>
                                                    <span id="username" style="padding:10px;"></span>
                                                    </address>
                                                </div>
                                                
                                                <div class="col-xs-12 ">
                                                    <address>
                                                        <strong><?php echo $transfer->expected_arrival;?></strong>
                                                        <span id="orderdate" style="padding:10px;"></span><br>
                                                    </address>
                                                </div>
                                                <div class="col-xs-12 ">
                                                    <address>
                                                        <strong><?php echo $transfer->referencenumber;?></strong>
                                                        <span id="refnumber" style="padding:10px;"></span><br>
                                                    </address>
                                                </div>
                                                <div class="col-xs-12 ">
                                                    <address>
                                                        <strong><?php echo $transfer->tag;?></strong>
                                                        <span id="tag" style="padding:10px;"></span><br>
                                                    </address>
                                                </div>
                                            
                                        </div>
                                        </div>
    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                    <tr>
                                                                        <td><strong>Item</strong></td>
                                                                        <td><strong>Item</strong></td>
                                                                        <td class=""><strong>Price</strong></td>
                                                                        <td class="text-center"><strong>Quantity</strong></td>
                                                                        
                                                                        <td class="text-center"><strong>Sub Total</strong></td>
                                                                        <td class="text-center"><strong>Tax</strong></td>
                                                                        <td class="text-center"><strong>Tax Type</strong></td>
                                                                         <td class="text-center"><strong>Total</strong></td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="finaldata">
                                                                   
                                                                    
                                                                </tbody>
                                                                <?php 
                                                                $i =1 ;
                                                                foreach($transferdata as $key =>  $transferdata)
                                                                {
                                                                    $productdata = DB::table('tbl_product')->where(array('id' => $transferdata->productid))->first();
                                                                    $tax = DB::table('tbl_tax')->where(array('id' => $transferdata->tax))->first();
                                                                ?>
                                                                    <tr>
                                                                        <td class="thick-line">{{ $i}}</td>
                                                                        <td class="thick-line">{{ $productdata->product_name }}</td>
                                                                        <td class="thick-line">{{ $transferdata->price }}</td>
                                                                        <td class="thick-line text-center"><strong>{{ $transferdata->quantity }}</strong></td>
                                                                        <td class="thick-line text-center" id="subtotal"> {{ $transferdata->quantity * $transferdata->price }}</td>
                                                                        <td class="thick-line text-center" id="tax">{{ $tax->tax_name }}</td>
                                                                        <td class="thick-line text-center" id="subtotal"><?php if($transferdata->taxtype == 1){echo 'Inclusive';}else{ echo 'Exclusive';} ?></td>
                                                                        <td class="thick-line text-center" id="subtotal"><?php if($transferdata->taxtype == 1){echo $transferdata->quantity * $transferdata->price;}else{
                                                                        $total =$transferdata->quantity * $transferdata->price;
                                                                        $taxcalulate = $total*($tax->total_tax)/100;
                                        echo $taxcalulate+ $total;} ?></td>
                                                                    </tr>
                                                                   
                                                                <?php 
                                                                $i++;
                                                                }?>
                                                            </table>
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



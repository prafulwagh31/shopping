@include('header')

<style>
/*button style*/
.buttonpldata {
  border: none;
  color: white;
  padding: 7px 0px;
  width: 100px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.buttonpldata2 {background-color: skyblue;} 
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
           
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
               
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
           <a href="{{action('Controller@downloadOrderListPDF')}}" class="btn btn-primary " style="margin-left: 20px;" target="_blank" style="">Export PDF</a>
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Order List</h4>
               
                
               
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                         
                          <th>#</th>
                          <th>Order Id </th>
                          <th>User Name </th>
                          <th>Order date </th>
                          <th>Payment method</th>
                          <th>Payment Status</th>
                          <th>Order Status</th>
                          <th>Shipping Charges</th>
                          <th>Total Amount</th>
                          
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($orderlist as $orderlistdata){
                            ?>
                        <tr>
                        
                        <td>{{ $i }}</td>
                        <td>{{$orderlistdata->order_id}} </td>
                        <td>{{ $orderlistdata->firstName }} {{ $orderlistdata->lastName }}</td>
                        <td>{{ $orderlistdata->orderdate }}</td>
                        <td>{{ $orderlistdata->paymentmethod }}</td>
                        <td>{{ $orderlistdata->paymentstatus }}</td>
                        <td>{{ $orderlistdata->orderstatus }}</td>
                        <td>{{ $orderlistdata->shipping_charges }}</td>
                        <td>{{ $orderlistdata->total_amount }}</td>
                        <td>
                          <a href="{{url('/orderdelete/'.$orderlistdata->id)}}"><i class="fa fa-trash"></i></a>
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



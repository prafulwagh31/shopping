@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Transfer List
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
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
                <h4 class="card-title">Transfer List</h4>
                <input type='button' value='Delete' id='delete'><br><br>
                <br><br>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          
                          <th>#</th>
                          <th>Transfer Id </th>
                          <th>Expected Date </th>
                          <th>Status </th>
                         
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($transfer as $transfer){
                            
                          
                          
                          
                       
                        ?>
                        <tr>
                        
                        <td>{{ $i }}</td>
                        <td><a href="{{ route('transferview',$transfer['id']) }}">{{ $transfer['transferid'] }}</a></td>
                        <td>{{ $transfer['expected_arrival'] }}</td>
                        <td><?php if($transfer['status'] == 'received'){?><p style="padding-left:5px;color:green">Completed</p><?php }else{?><p style="padding-left:5px;color:Red">Pending</p><?php }?></td>
                       
                        <td>
                          <a href="{{ route('invoicegenrate',$transfer['id']) }}"><button type='button'  id='invoicegenrate' class="col-md-6 btn-default">Invoice Genrate</button></a>
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



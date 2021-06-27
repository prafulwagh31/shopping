@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Recieve List
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Recieve List</li>
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
                <h4 class="card-title">Recieve List</h4>
                <input type='button' value='Delete' id='delete'><br><br>
                <br><br>
                <form method="POST" action="{{ route('submitrecieve') }}">
                     {{ csrf_field() }}
                <div class="row">
                  <div class="col-12">
                    <table id="" class="table">
                        
                      <thead>
                        <tr>
                          
                          <th>#</th>
                          <th>Products </th>
                          <th>Recieved </th>
                          <th>Accept </th>
                         
                          <th>Cancel</th>
                          <th>Reject</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;
                        
                        
                        foreach($transferdata as $transferdata)
                        {
                            
                        $productdata = DB::table('tbl_product')->where(array('id'=> $transferdata->productid))->first();  
                           if($productdata != '')
                            {
                                if($productdata->product_media != '')
                                {
                                    $mediadata = explode(',',$productdata->product_media);
                                    $media = asset('productimg').'/'.$mediadata[0];
                                }else
                                {
                                    $media = asset('images').'/image.png';
                                }
                            }
                          
                       
                        ?>
                        <input type="hidden" name="transferid[]" value="{{ $transferdata->id }}"> 
                        <tr>
                        
                        <td><img src="{{ $media }}" style="height:100px;width:100px;"></td>
                        <td>{{ $productdata->product_name}}</td>
                        <td>{{ $transferdata->quantity }}</td>
                        <td><div class="form-group" >
                      <div class="input-group" style="width: 61%;">
                        <input type="number" class="form-control" name="allqunatity[]">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-gradient-primary" type="button">All</button>
                        </div>
                      </div>
                    </div></td>
                       
                        <td>
                     <div class="form-group" >
                      <div class="input-group" style="width: 61%;">
                        <input type="number" class="form-control" name="cancelqunatity[]">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-gradient-primary" type="button">All</button>
                        </div>
                      </div>
                    </div>
                          </td>
                          <td>
                     <div class="form-group" >
                      <div class="input-group" style="width: 61%;">
                        <input type="number" class="form-control" name="rejectqunatity[]">
                        <div class="input-group-append">
                          <button class="btn btn-sm btn-gradient-primary" type="button">All</button>
                        </div>
                      </div>
                    </div>
                          </td>
                        </tr>
                        <?php $i++;}?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
                 <div class="row">
                    
                    <div class="col-md-8"></div>
                    <div class="col-md-2">
                  
                    </div>
                    <div class="col-md-2">
                    <button type="submit" name="addtransfer" >Save Transfer</button>
                    </div>
                </div>
                </form>
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



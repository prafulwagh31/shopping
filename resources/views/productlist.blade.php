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
          <button class="buttonpldata buttonpldata2"><a href="{{ url('product')}}">Product</a></button>
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
                <h4 class="card-title">Product List</h4>
                <input type='button' value='Delete' id='delete'><br><br>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th><input type="checkbox" id="checkAll"></th>
                          <th>#</th>
                          <th>Image </th>
                          <th>Name </th>
                          <th>Category </th>
                          <th>Subcategoryone</th>
                          <th>Subcategorytwo</th>
                          <th>Min Quantity</th>
                          <th>Max Quantity</th>
                          <th>Description</th>
                          
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($product as $productdata){
                            $media = explode(',',$productdata->product_media);
                            
                            $category = DB::table('tbl_categories')->where(array('id' => $productdata->product_category))->first();
                            $inventory  = DB::table('tbl_inventory')->where(array('product_id' => $productdata->id))->first();
                            $replace = array('<p>','</p>');
                            $text =  str_replace($replace,'',$productdata->product_description);
                          
                           if($inventory != '')
                            {
                                $min = $inventory->minqty;
                                $max = $inventory->maxqty;
                            }else
                            {
                                $min ='';
                                $max = '';
                            }
                            
                             $subone = '';
                             $subtwo = '';
                            if($category != '')
                	        {
                	           $categoryname = $category->name;
                	            $subcatone = DB::table('tbl_categories')->where(array('id' => $category->pid))->first();
                	            
                	            if($subcatone != '')
                	            {
                	                if($subcatone->pid == 0)
                	                {
                	                    $categoryname = $subcatone->name;
                	                    $subone       = $category->name;
                	                    $subtwo       = '';
                	                }else
                	                {
                	                    $subcattwo = DB::table('tbl_categories')->where(array('id' => $subcatone->pid))->first();
                	                    $categoryname = $subcattwo->name;
                	                    $subone       = $subcatone->name;
                	                    $subtwo       = $category->name;
                	                    
                	                }
                	            }
                	        }else
                	        {
                	            $categoryname = '';
                	        }
                       
                        ?>
                        <tr>
                        <td><input type='checkbox' id='del_<?php echo $productdata->id; ?>' ></td>
                        <td>{{ $i }}</td>
                        <td><?php foreach($media as $productdatamedia){?>
                        <img src="{{asset('productimg')}}<?php echo '/'.$productdatamedia;?>" style="height:100px;width:100px;">
                        <?php }?> </td>
                        <td>{{ $productdata->product_name }}</td>
                        <td>{{ $categoryname }}</td>
                        <td>{{ $subone }}</td>
                        <td>{{ $subtwo }}</td>
                        <td>{{ $min }}</td>
                        <td>{{ $max }}</td>
                        <td>{{ $text }}</td>
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



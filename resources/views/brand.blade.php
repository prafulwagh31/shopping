@include('header')

<style>
/*button style*/
.buttonbdata {
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
.buttonbdata2 {background-color: skyblue;} 
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
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Brand
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Brand</li>
              </ol>
            </nav>
          </div>
          <button class="buttonbdata buttonbdata2"><a href="{{ url('product')}}">Product</a></button>
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
            <?php if(isset($editbrand)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 500px;">
                <div class="card-body">
                  <h4 class="card-title">Edit  Brand</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatebrand')}}"  enctype="multipart/form-data" id="editbrandform">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editbrand->id;?>">
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="editname" placeholder="Name" name="name" value="<?php echo $editbrand->name;?>">
                      <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" ><?php echo $editbrand->description;?></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" id="editimage" name="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                        <span style="color:red;">{{ $errors->first('image') }}</span>
                      </div>
                      <img src="{{asset('brandimg/'.$editbrand->image)}}" style="width:50px;height:50px;">
                    </div>
                    <input type="hidden" name="hiddenimage" value="<?php echo $editbrand->image;?>">
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update brand</button>

                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 600px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Brand</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addbrand')}}" id="addbrandform"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                     <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="image" id="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                      </div>
                      <span style="color:red;">{{ $errors->first('image') }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2" >Add new brand</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-8 grid-margin stretch-card">
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
                          <th>Description</th>
                          <th>Count</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($brand as $brandval) {
                         
                         if($brandval->image != '')
                        {
                            $img = asset('brandimg').'/'.$brandval->image;
                        }else
                        {
                            $img = asset('images').'/image.png';
                        }
                        $product =  DB::table('tbl_product')->where(array('product_brand' => $brandval->id))->get();
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><img src="<?php echo $img;?>" style="width:50px;height:50px;"></td>
                          <td><?php echo $brandval->name;?></td>
                          <td><?php echo $brandval->description;?></td>
                          <td><?php echo count($product);?></td>
                          <td><a href="{{url('/brandedit/'.$brandval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/branddelete/'.$brandval->id)}}"><i class="fa fa-trash"></i></a>
                          </td>
                          
                        </tr>
                        <?php $i++; }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
           
          </div>
        </div>
@include('footer')
<script>
$(document).ready( function () {
   
    $('#brand').DataTable({
            'lengthChange' : false;
        });
} );
</script>
<script>
    function validate()
    {
        alert();
        var name = $('#name').val();
        var image = $('#image').val();
        var flag = 0;
        if(name == '')
        {
            $('#nameerr').html('Enter Name');
            $('#nameerr').css('color','red');
            flag = 1;
        }else
        {
            $('#nameerr').html();
            flag = 0;
        }
        if(image == '')
        {
            $('#imageerr').html('Upload Image');
            $('#imageerr').css('color','red');
            flag = 1;
        }else
        {
             $('#imageerr').html();
            flag = 0;
        }
        
        if(flag == 1)
        {
            
        }else
        {
            $('#addbrandform').submit();
        }
        
    }
</script>
<script>
    function editbvalidate()
    {
        alert();
        var editname = $('#editname').val();
        var editimage = $('#editimage').val();
        var flag = 0;
        if(editname == '')
        {
            $('#editnameerr').html('Enter Name');
            $('#editnameerr').css('color','red');
            flag = 1;
        }else
        {
            $('#editnameerr').html();
            flag = 0;
        }
        if(editimage == '')
        {
            $('#editimageerr').html('Upload Image');
            $('#editimageerr').css('color','red');
            flag = 1;
        }else
        {
             $('#editimageerr').html();
            flag = 0;
        }
        
        if(flag == 1)
        {
            
        }else
        {
            $('#editbrandform').submit();
        }
        
    }
</script>
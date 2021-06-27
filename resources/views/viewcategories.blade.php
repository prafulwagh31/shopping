@include('header')



 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Categories
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
            <?php if(isset($editcategories)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 1050px;">
                <div class="card-body">
                  <h4 class="card-title">Edit  Categories</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatecategories')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                       <input type="hidden" value="<?php echo $pid; ?>" class="form-control" name="pid">  
                       
                      <input type="hidden" name="hiddenid" value="<?php echo $editcategories->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name" value="<?php echo $editcategories->name;?>">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Slug" name="slug" value="<?php echo $editcategories->slug;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <br>
                      <span><a class="btn btn-success" href="#" id="myBtn">Add Media</a></span>
                      <br><br>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" ><?php echo $editcategories->description;?></textarea>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="img" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                      </div>
                      <img src="{{asset('categoriesimg/'.$editcategories->image)}}" style="width:50px;height:50px;">
                    </div>
                    <input type="hidden" name="hiddenimage" value="<?php echo $editcategories->image;?>">
                    <div id="myModal" class="modal">
                     <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="row">
                            <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Banner Image</h4>
                                <input type="file" class="dropify" name="banner" />
                                <input type="hidden" name="bannerimg" value="<?php echo $editcategories->bannerimage;?>">
                                <img src="{{asset('categoriesimg/'.$editcategories->bannerimage)}}" style="width:200px;height:200px;">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update categories</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 1050px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Categories</h4>
                  
              
               
                  <form class="" method="POST" action="{{ url('/addcategories')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <input type="hidden" value="<?php echo $pid; ?>" class="form-control" name="pid">  
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Slug" name="slug" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                       <br>
                      <span><a class="btn btn-success" href="#" id="myBtn">Add Media</a></span>
                      <br><br>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" name="img" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
                    <div id="myModal" class="modal">
                     <div class="modal-content">
                        <span class="close">&times;</span>
                        <div class="row">
                            <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Banner Image</h4>
                                <input type="file" class="dropify" name="banner" />
                               
                               
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new categories</button>
                    
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
                        <?php $i = 1;foreach($categories as $categoriesval) {
                        
                        if($categoriesval->image != '')
                        {
                            $img = asset('categoriesimg').'/'.$categoriesval->image;
                        }else
                        {
                            $img = asset('images').'/image.png';
                        }
                        $product =  DB::table('tbl_product')->where(array('product_category' => $categoriesval->id))->get();
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><img src="<?php echo $img;?>" style="width:100px;height:100px;"></td>
                          <td><?php echo $categoriesval->name;?></td>
                          <td><?php echo $categoriesval->description;?></td>
                          <td><?php echo count($product);?></td>
                          <td><a href="{{url('/vieweditcategories/'.$categoriesval->id.'/'.$categoriesval->pid)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/categoriesdelete/'.$categoriesval->id)}}"><i class="fa fa-trash"></i></a>
                          <a href="{{url('/viewcategories/'.$categoriesval->id)}}"><i class="fa fa-plus"></i></a>
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
   
    $('#categories').DataTable({
            'lengthChange' : false
        });
} );
</script>
<script>
    CKEDITOR.replace( 'description' );
    
    var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script  type="text/javascript">
Dropzone.autoDiscover = false;
$(document).ready(function() {
 var myDropzone = new Dropzone("#dropzone_data", {
         url: '',
         method: 'post',
         maxFiles:20,
         
         init: function () 
         {
            this.on("success", function (file, responseText) 
            {
               var update = '<input type="hidden" class="pictures" name="pictures[]" value="'+responseText+'">';
               $("#dropzone_data").append(update);
            });
            this.on('resetFiles', function() 
            {
              this.removeAllFiles();
            });
         },
         addRemoveLinks: true,
         removedfile: function(file) 
         {
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         }
      }); 
});</script>
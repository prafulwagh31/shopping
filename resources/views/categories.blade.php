@include('header')

<style>
/*button style*/
.buttoncdata {
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
.buttoncdata2 {background-color: skyblue;} 
</style>

 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Categories
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
              </ol>
            </nav>
          </div>
          <button class="buttoncdata buttoncdata2"><a href="{{ url('product')}}">Product</a></button>
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
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Edit  Categories</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatecategories')}}"  enctype="multipart/form-data" id="editcategoryform">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editcategories->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="editname" placeholder="Name" name="name" value="<?php echo $editcategories->name;?>">
                      <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" id="editslug" placeholder="Slug" name="slug" value="<?php echo $editcategories->slug;?>">
                      <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                       <br>
                      <span><a class="btn btn-success" href="#" id="myBtn">Add Media</a></span>
                      <br><br>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" ><?php echo $editcategories->description;?></textarea>
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
                                <input type="file" class="dropify" name="bannerimage" onchange="readURL(this);"/>
                               <span style="color:red;">{{ $errors->first('bannerimage') }}</span>
                                <input type="hidden" name="bannerimg" value="<?php echo $editcategories->bannerimage;?>">
                                <img src="{{asset('categoriesimg/'.$editcategories->bannerimage)}}" style="width:200px;height:200px;" id="blah">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      </div>
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                        <input type="text" class="form-control" id="edittitle" placeholder="" name="seo_title"  value="<?php echo $editcategories->seo_title;?>">
                        <span style="color:red;">{{ $errors->first('seo_title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="editseodescription" rows="4" name="seo_description"  ><?php echo $editcategories->seo_description;?></textarea>
                        <span style="color:red;">{{ $errors->first('seo_description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="editurlhandle" placeholder="" name="seo_url" value="<?php echo $editcategories->seo_url;?>">
                        <span style="color:red;">{{ $errors->first('seo_url') }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update categories</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add New Categories</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addcategories')}}"  enctype="multipart/form-data" id="addcategoryform">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                      <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug">
                      <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <br>
                      <span><a class="btn btn-success" href="#" id="myBtn">Add Media</a></span>
                      <br><br>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" id="image" name="image" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                        <span style="color:red;">{{ $errors->first('image') }}</span>
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
                                <input type="file" class="dropify" name="bannerimage" onchange="readURL(this);"/>
                                <img id="blah" src="#" alt="your image" />
                                <span style="color:red;">{{ $errors->first('bannerimage') }}</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                        <input type="text" class="form-control" id="title" placeholder="" name="seo_title">
                        <span style="color:red;">{{ $errors->first('seo_title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="seodescription" rows="4" name="seo_description"></textarea>
                        <span style="color:red;">{{ $errors->first('seo_description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="urlhandle" placeholder="" name="seo_url">
                        <span style="color:red;">{{ $errors->first('seo_url') }}</span>
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
                          
                        <?php 
                        
                        $i = 1;foreach($categories as $key =>  $categoriesval) {
                            
                        $subcategory = DB::table('tbl_categories')->where(array('pid' => $categoriesval->id))->get();
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
                          <td><img src="<?php echo $img; ?>" style="width:50px;height:50px;"></td>
                          <td><?php echo $categoriesval->name;?></td>
                          <td><?php echo $categoriesval->description;?></td>
                          <td><?php echo count($product);?></td>
                          <td><a href="{{url('/categoriesedit/'.$categoriesval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/categoriesdelete/'.$categoriesval->id)}}"><i class="fa fa-trash"></i></a>
                          <a href="{{url('/viewcategories/'.$categoriesval->id)}}"><i class="fa fa-plus"></i></a>
                          </td>
                          
                          
                        </tr>
                        
                        <?php 
                        $i++;
                        foreach($subcategory as $subcategory){
                         $subcategorytwo = DB::table('tbl_categories')->where(array('pid' => $subcategory->id))->get();
                         if($subcategory->image != '')
                        {
                            $img1 = asset('categoriesimg').'/'.$subcategory->image;
                        }else
                        {
                            $img1 = asset('images').'/image.png';
                        }
                        $product1 =  DB::table('tbl_product')->where(array('product_category' => $subcategory->id))->get();
                        
                        ?>
                         <tr>
                          <td><?php echo $i;?></td>
                          <td><img src="<?php echo $img1;?>" style="width:50px;height:50px;"></td>
                          <td style="color:red;">---<?php echo $subcategory->name;?></td>
                          <td><?php echo $subcategory->description;?></td>
                          <td><?php echo count($product1);?></td>
                          <td><a href="{{url('/categoriesedit/'.$subcategory->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/categoriesdelete/'.$subcategory->id)}}"><i class="fa fa-trash"></i></a>
                          <a href="{{url('/viewcategories/'.$subcategory->id)}}"><i class="fa fa-plus"></i></a>
                          </td>
                          
                          
                        </tr>
                         <?php
                         $i++;
                            if($subcategorytwo != '')
                            {
                            foreach($subcategorytwo as $subcategorytwo)
                            {
                                if($subcategorytwo->image != '')
                                {
                                    $img2 = asset('categoriesimg').'/'.$subcategorytwo->image;
                                }else
                                {
                                    $img2 = asset('images').'/image.png';
                                }
                                $product2 =  DB::table('tbl_product')->where(array('product_category' => $subcategorytwo->id))->get();
                            ?>
                                          <tr>
                                  <td><?php echo $i;?></td>
                                  <td><img src="<?php echo $img2;?>" style="width:50px;height:50px;"></td>
                                  <td style="color:green;">------<?php echo $subcategorytwo->name;?></td>
                                  <td><?php echo $subcategorytwo->description;?></td>
                                  <td><?php echo count($product2);?></td>
                                  <td><a href="{{url('/categoriesedit/'.$subcategorytwo->id)}}"><i class="fa fa-edit"></i></a>
                                  <a href="{{url('/categoriesdelete/'.$subcategorytwo->id)}}"><i class="fa fa-trash"></i></a>
                                  <a href="{{url('/viewcategories/'.$subcategorytwo->id)}}"><i class="fa fa-plus"></i></a>
                                  </td>
                                  
                                  
                                </tr> 
                                
                            <?php   
                            $i++;
                            }
                           
                            ?>
                        <?php } }?>
                        <?php  }?>
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
    CKEDITOR.replace('seodescription');
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
<script>
    function validate()
    {
       
        var name = $('#name').val();
        var slug = $('#slug').val();
        var image = $('#image').val();
        var title = $('#title').val();
        var seodescription = $('#seodescription').val();
        var urlhandle = $('#urlhandle').val();
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
        if(slug == '')
        {
            $('#slugerr').html('Enter Slug');
            $('#slugerr').css('color','red');
            flag = 1;
        }else
        {
             $('#slugerr').html();
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
        if(title == '')
        {
            $('#titleerr').html('Enter Title');
            $('#titleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#titleerr').html();
            flag = 0;
        }
        if(seodescription == '')
        {
            $('#seodescriptionerr').html('Enter SEO Description');
            $('#seodescriptionerr').css('color','red');
            flag = 1;
        }else
        {
             $('#seodescriptionerr').html();
            flag = 0;
        }
        if(urlhandle == '')
        {
            $('#urlhandleerr').html('Enter SEO url');
            $('#urlhandleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#urlhandleerr').html();
            flag = 0;
        }
        
        if(flag == 1)
        {
            
        }else
        {
            $('#addcategoryform').submit();
        }
        
    }
</script>
<script>
    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    function editcvalidate()
    {
      
        var editname = $('#editname').val();
        var editslug = $('#editname').val();
        var editimage = $('#editimage').val();
        var edittitle = $('#edittitle').val();
        var editseodescription = $('#editseodescription').val();
        var editurlhandle = $('#editurlhandle').val();
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
        if(editslug == '')
        {
            $('#editslugerr').html('Enter Slug');
            $('#editslugerr').css('color','red');
            flag = 1;
        }else
        {
             $('#editslugerr').html();
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
        if(edittitle == '')
        {
            $('#edittitleerr').html('Enter Title');
            $('#edittitleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#edittitleerr').html();
            flag = 0;
        }
        if(editseodescription == '')
        {
            $('#editseodescriptionerr').html('Enter SEO Description');
            $('#editseodescriptionerr').css('color','red');
            flag = 1;
        }else
        {
             $('#editseodescriptionerr').html();
            flag = 0;
        }
        if(editurlhandle == '')
        {
            $('#editurlhandleerr').html('Enter SEO url');
            $('#editurlhandleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#editurlhandleerr').html();
            flag = 0;
        }
       
        if(flag == 1)
        {
             
        }else
        {
            
            $('#editcategoryform').submit();
        }
        
    }
</script>

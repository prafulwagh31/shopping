@include('header')
<style>
/*button style*/
.buttonadata {
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
.buttonadata2 {background-color: skyblue;} 
</style>

 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Attributes
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Attributes</li>
              </ol>
            </nav>
          </div>
          <button class="buttonadata buttonadata2"><a href="{{ url('product')}}">Product</a></button>
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
            <?php if(isset($editattributes)){
           
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 500px;">
                <div class="card-body">
                  <h4 class="card-title">Edit  Attributes</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateattributes')}}"  enctype="multipart/form-data" id="editattributeform">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editattributes->id;?>">
                      <div class="form-group">
                            <label for="exampleInputUsername1">Category</label>
                            <select class="form-control" name="category">
                                <option value="">Select Category</option>
                                  <?php foreach($category as $category) { 
                                    $subcategory = DB::table('tbl_categories')->where(array('pid' => $category->id))->get();
                                ?>
                                      <option value="<?php echo $category->id;?>" class="opt" <?php if($editattributes->category == $category->id){echo 'selected';}?>>
                                         <?php echo $category->name;?></option>
                                            <?php 
                                                foreach($subcategory as $subcategory)
                                                {
                                                    $subcategorytwo = DB::table('tbl_categories')->where(array('pid' => $subcategory->id))->get();
                                                   
                                                    ?>
                                                    
                                                            <option value="<?php echo $subcategory->id;?>" class="opt1" <?php if($editattributes->category == $subcategory->id){echo 'selected';}?>>-----<?php echo $subcategory->name;?></option>
                                                    <?php
                                                    if($subcategorytwo != '')
                                                    {
                                                        foreach($subcategorytwo as $subcategorytwo)
                                                        {?>
                                                        <option value="<?php echo $subcategorytwo->id;?>" class="opt2" <?php if($editattributes->category == $subcategorytwo->id){echo 'selected';}?>>---------------<?php echo $subcategorytwo->name;?></option>
                                                    <?php        
                                                        }
                                                    }
                                                    
                                                }
                                                
                                                 
                                            ?>
                                            <hr class="opt3"></hr>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('category') }}</span>
                        </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" placeholder="Name" name="name" id="editname" value="<?php echo $editattributes->name;?>">
                        <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" placeholder="Slug" name="slug" id="editslug" value="<?php echo $editattributes->slug;?>">
                      <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" rows="4" name="description" id="editdescription"><?php echo $editattributes->description;?></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                   
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update  Attributes</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 550px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Attributes</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addattributes')}}"  enctype="multipart/form-data" id="addattributeform">
                      {{ csrf_field() }}
                      <div class="form-group">
                            <label for="exampleInputUsername1">Category</label>
                            <select class="form-control" name="category" id="catgeory">
                                <option value="">Select Category</option>
                                  <?php foreach($category as $category) { 
                                    $subcategory = DB::table('tbl_categories')->where(array('pid' => $category->id))->get();
                                ?>
                                      <option value="<?php echo $category->id;?>" class="opt" >
                                         <?php echo $category->name;?></option>
                                            <?php 
                                                foreach($subcategory as $subcategory)
                                                {
                                                    $subcategorytwo = DB::table('tbl_categories')->where(array('pid' => $subcategory->id))->get();
                                                   
                                                    ?>
                                                    
                                                            <option value="<?php echo $subcategory->id;?>" class="opt1" >-----<?php echo $subcategory->name;?></option>
                                                    <?php
                                                    if($subcategorytwo != '')
                                                    {
                                                        foreach($subcategorytwo as $subcategorytwo)
                                                        {?>
                                                        <option value="<?php echo $subcategorytwo->id;?>" class="opt2" >---------------<?php echo $subcategorytwo->name;?></option>
                                                    <?php        
                                                        }
                                                    }
                                                    
                                                }
                                                
                                                 
                                            ?>
                                            <hr class="opt3"></hr>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('category') }}</span>
                        </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control"  placeholder="Name" name="name" id="name">
                      <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control"  placeholder="Slug" name="slug" id="slug">
                       <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new Attributes</button>
                    
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
                          <th>Name </th>
                          <th>Description</th>
                          <th>Terms</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($attributes as $attributesval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $attributesval->name;?></td>
                          <td><?php echo $attributesval->description;?></td>
                          <td><a href="{{url('/terms/'.$attributesval->id)}}">Configure Terms</td>
                          
                          <td><a href="{{url('/attributeedit/'.$attributesval->id)}}"><i class="fa fa-edit"></i></a>
                         <a href="{{url('/attributedelete/'.$attributesval->id)}}"><i class="fa fa-trash"></i></a>
                          
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
    function validate()
    {
        alert();
        var name = $('#catgeory').val();
        var name = $('#name').val();
        var slug = $('#slug').val();
        var description = $('#description').val();
        var flag = 0;
        if(catgeory == '')
        {
            $('#categoryerr').html('Select Category');
            $('#categoryerr').css('color','red');
            flag = 1;
        }else
        {
            $('#categoryerr').html();
            flag = 0;
        }
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
        if(description == '')
        {
             $('#descriptionerr').html('Enter Description');
            $('#descriptionerr').css('color','red');
            flag = 1;
        }else
        {
             $('#descriptionerr').html();
             flag = 0;
        }
        
        if(flag == 1)
        {
            
        }else
        {
            $('#addattributeform').submit();
        }
        
    }
</script>
<script>
    function editvalidate()
    {
        alert();
        var editname = $('#editname').val();
        var editslug = $('#editslug').val();
        var editdescription = $('#editdescription').val();
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
        if(editdescription == '')
        {
             $('#editdescriptionerr').html('Enter Description');
            $('#editdescriptionerr').css('color','red');
            flag = 1;
        }else
        {
             $('#editdescriptionerr').html();
             flag = 0;
        }
         
        if(flag == 1)
        {
            
        }else
        {
            $('#editattributeform').submit();
        }
        
    }
</script>

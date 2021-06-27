@include('header')



 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Staff
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Staff</li>
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
            <?php if(isset($editstaff)){
            
            ?>
            
                
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Service Category</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatestaff')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editstaff->id;?>">
                      <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                    <input type="text" name="name" placeholder="" class="form-control" value="<?php echo $editstaff->name;?>">
                    <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Phone</label>
                    <input type="text" name="phone" placeholder="" class="form-control" value="<?php echo $editstaff->phone;?>">
                    <span style="color:red;">{{ $errors->first('phone') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                    <input type="text" name="email" placeholder="" class="form-control" value="<?php echo $editstaff->email;?>">
                    <span style="color:red;">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Visbility</label>
                          <select class="form-control" id="staffvisbility" name="visibility" value="<?php echo $editstaff->visibility;?>">
                              <option value=""></option>
                              <option value="Public">Public</option>
                              <option value="Private">Private</option>
                          </select>
                          <span style="color:red;">{{ $errors->first('visibility') }}</span>
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
                      <img src="{{asset('images/'.$editstaff->image)}}" style="width:50px;height:50px;">
                    </div>
                   <input type="hidden" name="hiddenimage" value="<?php echo $editstaff->image;?>">
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            
                
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Add New Staff</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addstaff')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                    <input type="text" name="name" placeholder="" class="form-control">
                    <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Phone</label>
                    <input type="text" name="phone" placeholder="" class="form-control">
                    <span style="color:red;">{{ $errors->first('phone') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                    <input type="text" name="email" placeholder="" class="form-control">
                    <span style="color:red;">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Visbility</label>
                          <select class="form-control" id="staffvisbility" name="visibility">
                              <option value=""></option>
                              <option value="Public">Public</option>
                              <option value="Private">Private</option>
                          </select>
                          <span style="color:red;">{{ $errors->first('visibility') }}</span>
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
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                    
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
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>Visbility</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                     
                        
                        $i = 1;foreach($staffdata as $staffdataval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $staffdataval->name;?></td>
                          <td><?php echo $staffdataval->phone;?></td>
                          <td><?php echo $staffdataval->email;?></td>
                          <td><?php echo $staffdataval->visibility;?></td>
                          
                          <td><a href="{{url('/staffedit/'.$staffdataval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/staffdelete/'.$staffdataval->id)}}"><i class="fa fa-trash"></i></a>
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
            'lengthChange' : false
        });
} );
</script>
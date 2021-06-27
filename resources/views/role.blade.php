@include('header')



 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Role
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Role</li>
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
            <?php if(isset($editbrand)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 500px;">
                <div class="card-body">
                  <h4 class="card-title">Edit  Role</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatebrand')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editbrand->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name" value="<?php echo $editbrand->name;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" ><?php echo $editbrand->description;?></textarea>
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
                      <img src="{{asset('brandimg/'.$editbrand->image)}}" style="width:50px;height:50px;">
                    </div>
                    <input type="hidden" name="hiddenimage" value="<?php echo $editbrand->image;?>">
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update brand</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Role</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addrole')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Role</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Role" name="role">
                    </div>
                    
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new role</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <!--<div class="row">-->
                <!--  <div class="col-md-12">-->
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Role </th>
                        
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                       
                            @foreach($roles as $key => $rolesdata)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $rolesdata->role }}</td>
                                <td><a href=""><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @endforeach
                          
                        
                        
                      </tbody>
                    </table>
                <!--  </div>-->
                <!--</div>-->
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
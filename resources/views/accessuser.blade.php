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
                <li class="breadcrumb-item active" aria-current="page">Access User</li>
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
            <?php if(isset($editaccessuser)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 600px;">
                <div class="card-body">
                  <h4 class="card-title">Edit  Role</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateaccessuser')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editaccessuser->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name" value="<?php echo $editaccessuser->name;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Role</label>
                      <select name="role" class="form-control">
                          <option>Select Role</option>
                          <?php foreach($roles as $roles){?>
                            <option value="{{$roles->id}}">{{$roles->role}}</option>
                          <?php }?>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">User Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="User Name" name="username" value="<?php echo $editaccessuser->username;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                      <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Email" name="email" value="<?php echo $editaccessuser->email;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Password</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Password" name="password" value="<?php echo $editaccessuser->password;?>">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height: 600px;">
                <div class="card-body">
                  <h4 class="card-title">Add Access User</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addaccessuser')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Role</label>
                      <select name="role" class="form-control">
                          <option>Select Role</option>
                          <?php foreach($roles as $roles){?>
                            <option value="{{$roles->id}}">{{$roles->role}}</option>
                          <?php }?>
                      </select>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">User Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="User Name" name="username">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Email</label>
                      <input type="email" class="form-control" id="exampleInputUsername1" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Password</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Password" name="password">
                    </div>
                    
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add New Access User</button>
                    
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
                            <th>Name </th>
                            <th>Role </th>
                            <th>Username </th>
                            <th>Permission</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($access_users as $key => $access_usersval){
                        $roles = DB::table('roles')->where('id','=',$access_usersval->role_id)->first();
                        ?>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $access_usersval->name }}</td>
                            <td>{{ $roles->role }}</td>
                            <td>{{ $access_usersval->username }}</td>
                            <td><a href="accesspermission/{{$access_usersval->id}}"><i class="fa fa-eye"></i></a></td>
                            <td><a href="{{url('/accessuseredit/'.$access_usersval->id)}}"><i class="fa fa-edit"></i></a>
                                <a href="deleteaccessuser/{{$access_usersval->id}}"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php }?>
                            
                          
                        
                        
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
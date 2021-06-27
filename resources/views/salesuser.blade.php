@include('header')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Sales User
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales User</li>
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
            <?php if(isset($editsaleuser)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Group Name</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatesaleuser')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editsaleuser->id;?>">
                     <div class="form-group">
                      <label for="exampleInputUsername1">Group Name</label>
                    <select class="form-control" name="grpname" value="<?php echo $editsaleuser->grp_name;?>" required>
                                <option></option>
                                <?php foreach($salesgroup as $salesgroup) { ?>
                                <option value="<?php echo $salesgroup->id;?>"><?php echo $salesgroup->group_name;?></option>
                                <?php }?>
                            </select>
                    </div>
                    <div class="form-group">
                            <label for="exampleInputUsername1">User</label>
                            <select class="form-control js-example-basic-multiple" name="useraccess" multiple="multiple" id="addcategory" required>
                                <option></option>
                                <?php foreach($access_users as $access_users) { 
                                    $access_users = DB::table('access_users')->where(array('id' => $access_users->id))->first();
                                ?>
                              <option value="<?php echo $access_users->id;?>" class="opt">
                                 <?php echo $access_users->name;?></option>
                                    <hr class="opt3"></hr>
                                <?php }?>
                               
                            </select>
                        </div>
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Add New Sales User</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addsaleuser')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Group Name</label>
                    <select class="form-control" name="grpname" required>
                                <option></option>
                                <?php foreach($salesgroup as $salesgroup) { ?>
                                <option value="<?php echo $salesgroup->id;?>"><?php echo $salesgroup->group_name;?></option>
                                <?php }?>
                            </select>
                    </div>
                     <div class="form-group">
                            <label for="exampleInputUsername1">User</label>
                            <select class="form-control js-example-basic-multiple" name="useraccess[]" multiple="multiple" id="addcategory" required>
                                <option></option>
                                <?php foreach($access_users as $access_users) { 
                                    $access_users = DB::table('access_users')->where(array('id' => $access_users->id))->first();
                                ?>
                              <option value="<?php echo $access_users->id;?>" class="opt">
                                 <?php echo $access_users->name;?></option>
                                    <hr class="opt3"></hr>
                                <?php }?>
                               
                            </select>
                        </div>
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new Sale User</button>
                    
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
                          <th>Group Name</th>
                          <th>Access User</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($salesuser as $salesuserval) {
                            $grpdata = DB::table('tbl_salesgroup')->where(array('id' => $salesuserval->grp_name))->first();
                        $data = DB::table('access_users')->where(array('id' => $salesuserval->access_user))->first();
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $grpdata->group_name;?></td>
                          <td><?php echo $data->name;?></td>
                          
                          <td><a href="{{url('/saleuseredit/'.$salesuserval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/saleuserdelete/'.$salesuserval->id)}}"><i class="fa fa-trash"></i></a>
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
$(".js-example-basic-multiple").select2();
$(document).ready( function () {
   
    $('#brand').DataTable({
            'lengthChange' : false;
        });
} );
</script>
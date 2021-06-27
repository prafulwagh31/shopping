@include('header')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Shipping
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Warehouse</li>
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
            <?php if(isset($editwarehosue)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Shipping Class</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatewarehouse')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editwarehosue->id;?>">
                      <div class="form-group">
                     <label for="exampleInputUsername1">Warehouse Name</label>
                    <input type="text" name="name" placeholder="Enter Warehouse Name" class="form-control" value="{{ $editwarehosue->name}}">
                    <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Address</label>
                       <textarea name="address" class="form-control">{{ $editwarehosue->address}}</textarea>
                   <span style="color:red;">{{ $errors->first('address') }}</span>
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
                  <h4 class="card-title">Add New Warehouse</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addwarehouse')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Warehouse Name</label>
                    <input type="text" name="name" placeholder="Enter Warehouse Name" class="form-control">
                    <span style="color:red;">{{ $errors->first('name') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Address</label>
                       <textarea name="address" class="form-control"></textarea>
                    <span style="color:red;">{{ $errors->first('address') }}</span>
                    </div>
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new warehouse</button>
                    
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
                          <th>Warehouse </th>
                          <th>Address</th>
                         
                        
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($warehouse as $warehouseval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $warehouseval->name;?></td>
                          <td><?php echo $warehouseval->address;?></td>
                        
                        
                          <td><a href="{{url('/warehouseedit/'.$warehouseval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/warehousedelete/'.$warehouseval->id)}}"><i class="fa fa-trash"></i></a>
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
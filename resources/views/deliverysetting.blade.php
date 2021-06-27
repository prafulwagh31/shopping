@include('header')

 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Delivery Setting
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delivery Setting</li>
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
            <?php if(isset($editdeliverysetting)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Delivery Setting</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatedeliverysetting')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editdeliverysetting->id;?>">
                       <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                    <input type="text" name="delivertitle" placeholder="Enter Delivery Title" value="<?php echo $editdeliverysetting->title;?>" class="form-control" required>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Weight</label>
                       <input type="text" name="deliverweight" placeholder="Enter Weight" value="<?php echo $editdeliverysetting->weight;?>" class="form-control" required>
                   </div>
                   <div class="form-group">
                      <label for="exampleInputUsername1">Price</label>
                       <input type="text" name="deliverprice" placeholder="Enter Price" value="<?php echo $editdeliverysetting->price;?>" class="form-control" required>
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
                  <h4 class="card-title">Add Delivery Setting</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/adddeliverysetting')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                    <input type="text" name="delivertitle" placeholder="Enter Delivery Title" class="form-control" required>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Weight</label>
                       <input type="text" name="deliverweight" placeholder="Enter Weight" class="form-control" required>
                   </div>
                   <div class="form-group">
                      <label for="exampleInputUsername1">Price</label>
                       <input type="text" name="deliverprice" placeholder="Enter Price" class="form-control" required>
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
                          <th>Title </th>
                          <th>Weight</th>
                          <th>Price</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($deliverysetting as $deliverysettingval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $deliverysettingval->title;?></td>
                          <td><?php echo $deliverysettingval->weight;?></td>
                          <td><?php echo $deliverysettingval->price;?></td>
                        
                          <td><a href="{{url('/deliveryedit/'.$deliverysettingval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/deliverydelete/'.$deliverysettingval->id)}}"><i class="fa fa-trash"></i></a>
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
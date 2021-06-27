@include('header')



 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Unit Wise Price
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Unit Wise Price</li>
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
            <?php if(isset($editunit)){
            
            ?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Edit Unit</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateunit')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editunit->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter Unit" name="unitname" value="<?php echo $editunit->unit_name;?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Add Unit</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addunit')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Unit</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter Unit" name="unitname" required>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Unit</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i = 1;foreach($unitdata as $unitdataval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $unitdataval->unit_name;?></td>
                          
                          <td><a href="{{url('/unitedit/'.$unitdataval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/unitdelete/'.$unitdataval->id)}}"><i class="fa fa-trash"></i></a>
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
          <div class="row">
            <?php if(isset($editunitwiseprice)){
            
            ?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Edit Shipping Zone</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateunitwseprice')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editunitwiseprice->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Unit</label>
                        <select class="form-control"  name="unitwisename" required>
                            <option></option>
                        <?php
                                foreach($unitdata as $unitdata)
                                { ?>
                                    <option value="<?php echo $unitdata->id; ?>"  <?php if($editunitwiseprice->unit_name == $unitdata->id){echo 'selected';}?>><?php echo $unitdata->unit_name; ?></option>
                                <?php }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputUsername1">Price</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter Price" name="pricedata" value="<?php echo $editunitwiseprice->price;?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Add Unit Wise Price</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addunitwiseprice')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Unit</label>
                        <select class="form-control"  name="unitwisename" required>
                            <option></option>
                        <?php
                                foreach($unitdata as $unitdata)
                                { ?>
                                    <option value="<?php echo $unitdata->id; ?>"><?php echo $unitdata->unit_name; ?></option>
                                <?php }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                    <label for="exampleInputUsername1">Price</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Enter Price" name="pricedata" required>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Unit</th>
                          <th>Price</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i = 1;foreach($unitwisepricedata as $unitwisepricedataval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $unitwisepricedataval->unit_name;?></td>
                          <td><?php echo $unitwisepricedataval->price;?></td>
                          
                          <td><a href="{{url('/unitwisepriceedit/'.$unitwisepricedataval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/unitwisepricedelete/'.$unitwisepricedataval->id)}}"><i class="fa fa-trash"></i></a>
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

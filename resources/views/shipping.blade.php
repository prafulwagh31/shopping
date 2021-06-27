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
                <li class="breadcrumb-item active" aria-current="page">Shipping</li>
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
            <?php if(isset($editshippingzone)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Edit Shipping Zone</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateshippingzone')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editshippingzone->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Zone name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Zone Name" name="zone_name" value="<?php echo $editshippingzone->zone_name;?>">
                      <span style="color:red;">{{ $errors->first('zone_name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Zone Region</label>
                      <select class="form-control"  name="zone_region" value="<?php echo $editshippingzone->zone_region;?>">
                          <option value=""></option>
                        <?php
                                foreach($countriesdata as $countriesdata)
                                { ?>
                                    <option value="<?php echo $countriesdata->id; ?>"><?php echo $countriesdata->name; ?></option>
                                <?php }
                                ?>
                        </select>
                        <span style="color:red;">{{ $errors->first('zone_region') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Shipping Methods</label>
                      <select class="form-control" name="shipping_method" value="<?php echo $editshippingzone->shipping_method;?>">
                                <option value=""></option>
                                <?php foreach($shipmethod as $shipmethod) { ?>
                                <option value="<?php echo $shipmethod->id;?>"><?php echo $shipmethod->title;?></option>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('shipping_method') }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 450px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Shipping Zone</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addshippingzone')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Zone name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Zone Name" name="zone_name">
                      <span style="color:red;">{{ $errors->first('zone_name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Zone Region</label>
                      <select class="form-control"  name="zone_region">
                          <option value=""></option>
                        <?php
                                foreach($countriesdata as $countriesdata)
                                { ?>
                                    <option value="<?php echo $countriesdata->id; ?>"><?php echo $countriesdata->name; ?></option>
                                <?php }
                                ?>
                        </select>
                        <span style="color:red;">{{ $errors->first('zone_region') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Shipping Methods</label>
                      <select class="form-control" name="shipping_method">
                                <option value=""></option>
                                <?php foreach($shipmethod as $shipmethod) { ?>
                                <option value="<?php echo $shipmethod->id;?>"><?php echo $shipmethod->title;?></option>
                                <?php }?>
                      </select>
                      <span style="color:red;">{{ $errors->first('shipping_method') }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new shipping zone</button>
                    
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
                    <a href="{{ route('shippingmethods')}}" style="float:right;"><button class="btn btn-gradient-primary" >Add Shipping Methods</button></a>
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Zone Name</th>
                          <th>Zone Region</th>
                          <th>Shipping Method</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i = 1;foreach($shipzone as $shippingzoneval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $shippingzoneval->zone_name;?></td>
                          <td><?php echo $shippingzoneval->zone_region;?></td>
                          <td><?php echo $shippingzoneval->shipping_method;?></td>
                          <td><a href="{{url('/shippingzoneedit/'.$shippingzoneval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/shippingzonedelete/'.$shippingzoneval->id)}}"><i class="fa fa-trash"></i></a>
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

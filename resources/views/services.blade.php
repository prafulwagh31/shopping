@include('header')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Services
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Services</li>
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
            <?php if(isset($editservicedata)){
            
            ?>
            
                
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Service Category</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateservicedata')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editservicedata->id;?>">
                     <div class="form-group">
                      <label for="exampleInputUsername1">Service Category</label>
                    <select class="form-control" name="service_category" value="<?php echo $editservicedata->service_category;?>">
                                <option value=""></option>
                                <?php foreach($servicecat as $servicecat) { ?>
                                <option value="<?php echo $servicecat->id;?>"  <?php if($servicecat->id == $editservicedata->service_category){echo 'selected';}?>><?php echo $servicecat->service_category;?></option>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('service_category') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Service Name</label>
                    <input type="text" name="service_name" placeholder="" class="form-control" value="<?php echo $editservicedata->service_name;?>">
                    <span style="color:red;">{{ $errors->first('service_name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Date</label>
                    <input type="date" name="service_date" placeholder="" class="form-control" value="<?php echo $editservicedata->service_date;?>">
                    <span style="color:red;">{{ $errors->first('service_date') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Duration</label>
                    <select class="form-control" name="duration" value="<?php echo $editservicedata->duration;?>">
                                <option value="">Select Duration</option>
                                <?php foreach($durationdata as $durationdata) { ?>
                                <option value="<?php echo $durationdata->id;?>"<?php if($durationdata->id == $editservicedata->duration){echo 'selected';}?>><?php echo $durationdata->duartion;?></option>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('duration') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Staff</label>
                    <select class="form-control js-example-basic-multiple" name="staff[]" value="<?php echo $editservicedata->staff;?>"  multiple="multiple">
                                <option>Select Staff</option>
                                <?php foreach($staffdata as $staffdata) { 
                                $explodestaff = explode(',',$editservicedata->staff);
                                ?>
                                <option value="<?php echo $staffdata->id;?>"<?php foreach($explodestaff as $explodestaffval){if($staffdata->id == $explodestaffval){echo 'selected';}}?>><?php echo $staffdata->name;?></option>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('staff') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Price</label>
                    <input type="text" name="price" placeholder="" class="form-control" value="<?php echo $editservicedata->price;?>">
                    <span style="color:red;">{{ $errors->first('price') }}</span>
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
                      <img src="{{asset('contactimg/'.$editservicedata->image)}}" style="width:50px;height:50px;">
                    </div>
                    <input type="hidden" name="hiddenimage" value="<?php echo $editservicedata->image;?>">
                    <div class="form-group">
                              <label for="exampleInputUsername1">Description</label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"><?php echo $editservicedata->description;?></textarea>
                               <span style="color:red;">{{ $errors->first('description') }}</span>
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
                  <h4 class="card-title">Add New Service</h4>
                 
                  <form class="" method="POST" action="{{ url('/addservicedata')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      
                      <div class="form-group">
                         <label for="exampleInputUsername1">Service Category</label>
                         <select class="form-control" name="service_category">
                            <option value=""></option>
                            <?php foreach($servicecat as $servicecat) { ?>
                            <option value="<?php echo $servicecat->id;?>"><?php echo $servicecat->service_category;?></option>
                            <?php }?>
                         </select>
                         <span style="color:red;">{{ $errors->first('service_category') }}</span>
                      </div>
                      <div class="form-group">
                         <label for="exampleInputUsername1">Service Name</label>
                         <input type="text" name="service_name" placeholder="" class="form-control">
                         <span style="color:red;">{{ $errors->first('service_name') }}</span>
                      </div>
                      <div class="form-group">
                         <label for="exampleInputUsername1">Date</label>
                         <input type="date" name="service_date" placeholder="" class="form-control">
                         <span style="color:red;">{{ $errors->first('service_date') }}</span>
                      </div>
                      <div class="form-group">
                         <label for="exampleInputUsername1">Duration</label>
                         <select class="form-control" name="duration">
                            <option value="">Select Duration</option>
                            <?php foreach($durationdata as $durationdata) { ?>
                            <option value="<?php echo $durationdata->id;?>"><?php echo $durationdata->duartion;?></option>
                            <?php }?>
                         </select>
                         <span style="color:red;">{{ $errors->first('duration') }}</span>
                      </div>
                      <div class="form-group">
                         <label for="exampleInputUsername1">Staff</label>
                         <select class="form-control js-example-basic-multiple" name="staff[]"  multiple="multiple">
                            <option value="">Select Staff</option>
                            <?php foreach($staffdata as $staffdata) { ?>
                            <option value="<?php echo $staffdata->id;?>"><?php echo $staffdata->name;?></option>
                            <?php }?>
                         </select>
                         <span style="color:red;">{{ $errors->first('staff') }}</span>
                      </div>
                      <div class="form-group">
                         <label for="exampleInputUsername1">Price</label>
                         <input type="text" name="price" placeholder="" class="form-control">
                         <span style="color:red;">{{ $errors->first('price') }}</span>
                      </div>
                      <div class="form-group">
                         <label>Image</label>
                         <input type="file" name="image" id="imageservice" class="file-upload-default">
                         <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                            </span>
                         </div>
                         <span style="color:red;">{{ $errors->first('image') }}</span>
                      </div>
                      <div class="form-group">
                         <label for="exampleInputUsername1">Description</label>
                         <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                         <span style="color:red;">{{ $errors->first('description') }}</span>
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
                          <th>Service Category</th>
                          <th>Service Name</th>
                          <th>Service Date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($servicedata as $servicedataval) {
                        $service = DB::table('tbl_service')->where('id','=',$servicedataval->service_category)->first();
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $service->service_category;?></td>
                          <td><?php echo $servicedataval->service_name;?></td>
                          <td><?php echo $servicedataval->service_date;?></td>
                          
                           <td><a href="{{url('/servicedataedit/'.$servicedataval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/servicedatadelete/'.$servicedataval->id)}}"><i class="fa fa-trash"></i></a></td>
                          
                          
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
<script>
    CKEDITOR.replace( 'descriptionservice' );
</script>
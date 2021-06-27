@include('header')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Taxes
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Taxes</li>
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
                  <h4 class="card-title">Edit  Brand</h4>
                  
                 
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
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 550px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Tax</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addtax')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="tax_name">
                      <span style="color:red;">{{ $errors->first('tax_name') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Tax type</label>
                        <select class="form-control" name="tax_type">
                            <option value=""></option>
                            <?php foreach($taxtype as $taxtypedata){?>
                            <option value="{{ $taxtypedata->id }}">{{ $taxtypedata->taxtype }}</option>
                            <?php }?>
                        </select>
                        <span style="color:red;">{{ $errors->first('tax_type') }}</span>
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Total Tax</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="total_tax">
                      <span style="color:red;">{{ $errors->first('total_tax') }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new Tax</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-8 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                 <a href="{{ route('taxtype')}}" class="btn btn-gradient-primary mr-2" style="">Add Tax Type</a>
                 <br><br>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Tax Type</th>
                        
                          <th>Total Tax</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;
                      
                        foreach($taxes as $taxesval) {
                        $taxtype = DB::table('tax_type')->where('id','=',$taxesval->tax_type)->first();
                       
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $taxesval->tax_name;?></td>
                          <td><?php echo $taxtype->taxtype;?></td>
                        
                          <td><?php echo $taxesval->total_tax;?></td>
                          
                          <td>
                              <a href="{{url('/taxdelete/'.$taxesval->id)}}"><i class="fa fa-trash"></i></a>
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
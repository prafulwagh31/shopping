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
            <?php if(isset($editshippingmethod)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Shipping Methods</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateshippingmethod')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editshippingmethod->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                     <select class="form-control" name="title" value="<?php echo $editshippingmethod->title;?>">
                            <option value=""></option>
                            <option value="Flat rate">Flat rate</option>
                            <option value="Local pickup">Local pickup</option>
                            <option value="Free shipping">Free shipping</option>
                     </select>
                     <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tax status</label>
                     <select class="form-control" name="tax_status" value="<?php echo $editshippingmethod->tax_status;?>">
                            <option value=""></option>
                            <option value="Taxable">Taxable</option>
                            <option value="None">None</option>
                     </select>
                     <span style="color:red;">{{ $errors->first('tax_status') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cost</label>
                    <input type="text" class="form-control" name="cost" value="<?php echo $editshippingmethod->cost;?>">
                    <span style="color:red;">{{ $errors->first('cost') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" class="form-control"><?php echo $editshippingmethod->description;?></textarea>
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
                  <h4 class="card-title">Add New Shipping Methods</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addshippingmethod')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                     <select class="form-control" name="title">
                            <option value=""></option>
                            <option value="Flat rate">Flat rate</option>
                            <option value="Local pickup">Local pickup</option>
                            <option value="Free shipping">Free shipping</option>
                     </select>
                     <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tax status</label>
                     <select class="form-control" name="tax_status">
                            <option value=""></option>
                            <option value="Taxable">Taxable</option>
                            <option value="None">None</option>
                     </select>
                     <span style="color:red;">{{ $errors->first('tax_status') }}</span>
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputEmail1">Cost</label>
                    <input type="text" class="form-control" name="cost">
                    <span style="color:red;">{{ $errors->first('cost') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                    <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new shipping method</button>
                    
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
                    <a href="{{ route('shippingclass')}}" style="float:right;"><button class="btn btn-gradient-primary" >Add Shipping Classes</button></a>
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title </th>
                          <th>Tax Status </th>
                          <th>Cost</th>
                          <th>Description</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i = 1;foreach($shipmethod as $shippingmethodval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $shippingmethodval->title;?></td>
                          <td><?php echo $shippingmethodval->tax_status;?></td>
                          <td><?php echo $shippingmethodval->cost;?></td>
                          <td><?php echo $shippingmethodval->description;?></td>
                          <td><a href="{{url('/shippingmethodedit/'.$shippingmethodval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/shippingmethoddelete/'.$shippingmethodval->id)}}"><i class="fa fa-trash"></i></a>
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
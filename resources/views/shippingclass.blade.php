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
            <?php if(isset($editshippingclass)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Shipping Class</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateshippingclass')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editshippingclass->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                    <input type="text" name="title" placeholder="Enter Title" class="form-control" value="{{$editshippingclass->title}}">
                    <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                    <input type="text" name="slug" placeholder="Enter Slug" class="form-control" value="{{$editshippingclass->slug}}">
                    <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                   
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" class="form-control" >{{$editshippingclass->description}}</textarea>
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
                  <h4 class="card-title">Add New Shipping Class</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addshippingclass')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                    <input type="text" name="title" placeholder="Enter Title" class="form-control">
                    <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                    <input type="text" name="slug" placeholder="Enter Slug" class="form-control">
                    <span style="color:red;">{{ $errors->first('slug') }}</span>
                    </div>
                   
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" class="form-control"></textarea>
                    <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new shipping class</button>
                    
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
                          <th>Slug</th>
                         
                          <th>Description</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i = 1;foreach($shipclass as $shipclassval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $shipclassval->title;?></td>
                          <td><?php echo $shipclassval->slug;?></td>
                        
                          <td><?php echo $shipclassval->description;?></td>
                          <td><a href="{{url('/shippingclassedit/'.$shipclassval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/shippingclassdelete/'.$shipclassval->id)}}"><i class="fa fa-trash"></i></a>
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
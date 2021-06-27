@include('header')
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Service Sub Category
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('servicecategory')}}">Service Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Service Sub Category</li>
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
            <?php if(isset($editservicecategory)){
            
            ?>
            
                
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Service Sub Category</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateservicecategory')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" value="<?php echo $pid; ?>" class="form-control" name="pid">  
                      
                      <input type="hidden" name="hiddenid" value="<?php echo $editservicecategory->id;?>">
                     <div class="form-group">
                      <label for="exampleInputUsername1">Service Sub Category</label>
                    <input type="text" name="servicecategory" placeholder="" class="form-control" value="<?php echo $editservicecategory->service_category;?>">
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
                  <h4 class="card-title">Add Service Sub Category</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addservicecategory')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" value="<?php echo $pid; ?>" class="form-control" name="pid">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Service Sub Category</label>
                    <input type="text" name="servicecategory" placeholder="" class="form-control">
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
                          <th>Service Sub Category</th>
                         
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php 
                     
                        
                        $i = 1;foreach($subcategory as $subcategoryval) {?>
                        
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $subcategoryval->service_category;?></td>
                          
                          <td><a href="{{url('/viewserviceedit/'.$subcategoryval->id.'/'.$subcategoryval->pid)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/servicecatdelete/'.$subcategoryval->id)}}"><i class="fa fa-trash"></i></a>
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
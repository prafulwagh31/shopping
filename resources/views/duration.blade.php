@include('header')

 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Duration
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Duration</li>
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
            <?php if(isset($editduration)){
            
            ?>
            
                
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Duration</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateduration')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editduration->id;?>">
                     <div class="form-group">
                      <label for="exampleInputUsername1">Duration</label>
                    <input type="text" name="duartion" placeholder="" class="form-control" value="<?php echo $editduration->duartion;?>">
                    <span style="color:red;">{{ $errors->first('duartion') }}</span>
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
                  <h4 class="card-title">Add New Duration</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addduration')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Duration</label>
                    <input type="text" name="duartion" placeholder="" class="form-control">
                    <span style="color:red;">{{ $errors->first('duartion') }}</span>
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
                          <th>Duration</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php 
                     
                        
                        $i = 1;foreach($durationdata as $durationdataval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $durationdataval->duartion;?></td>
                          
                          <td><a href="{{url('/durationedit/'.$durationdataval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/durationdelete/'.$durationdataval->id)}}"><i class="fa fa-trash"></i></a>
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
            'lengthChange' : false
        });
} );
</script>
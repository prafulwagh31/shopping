@include('header')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Attribute Terms
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">  Attribute Terms</li>
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
            <?php if(isset($editattrterms)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 700px;">
                <div class="card-body">
                  <h4 class="card-title">Edit  Attribute Terms</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateterms')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                       <input type="hidden" value="<?php echo $attributeid; ?>" class="form-control" name="attributeid">  
                       
                      <input type="hidden" name="hiddenid" value="<?php echo $editattrterms->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name" value="<?php echo $editattrterms->name;?>">
                    </div>
                      <?php if($attr == 'Color' || $attr == 'color') { ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Color</label>
                      <input type="color"  class="form-control" name="colordata" style="height:54px;" value="<?php echo $editattrterms->color;?>">
                    </div>
                    <?php }?>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Slug" name="slug" value="<?php echo $editattrterms->slug;?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" ><?php echo $editattrterms->description;?></textarea>
                    </div>
                    

                    <button type="submit" class="btn btn-gradient-primary mr-2">Update Terms</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 700px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Attribute Terms</h4>
                  
              
               
                  <form class="" method="POST" action="{{ url('/addterms')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                       <input type="hidden" value="<?php echo $attributeid; ?>" class="form-control" name="attributeid">  
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="name">
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Slug</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Slug" name="slug">
                    </div>
                    <?php if($attr == 'Color' || $attr == 'color') { ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Color</label>
                      <input type="color"  class="form-control" name="colordata" style="height:54px;">
                    </div>
                    <?php }?>
                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new Terms</button>
                    
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
                         
                          <th>Name </th>
                          
                          <th>Description</th>
                          <th>Count</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $i= 1 ;foreach($attributes as $attributestermsval){ ?>
                       <tr>
                           <td><?php echo $i;?></td>
                           <td><?php echo $attributestermsval->name;?></td>
                           <td><?php echo $attributestermsval->description;?></td>
                           <td>0</td>
                            <td><a href="{{url('/termsedit/'.$attributestermsval->id)}}"><i class="fa fa-edit"></i></a>
                           <a href="{{route('termsdelete',['attributeid' => $attributestermsval->attributeid ,'id' => $attributestermsval->id])}}"><i class="fa fa-trash"></i></a>
                          </td>
                       </tr>
                       <?php $i++;}?>
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

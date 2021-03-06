@include('header')
<style>
    
/*button style*/
.buttondata {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.buttondata2 {background-color: white;} 
</style>

 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Cust Category
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Cust Category</li>
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
                <div class="col-md-3">
                    <div class="card-body">
                        <button class="buttondata buttondata2"><a href="{{ url('campaigns')}}">Campaigns</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('addleads')}}">Add Leads</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('listleads')}}">List Leads</a></button>
                         <button class="buttondata buttondata2"><a href="{{ url('proposallistdata')}}">Proposal List</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('leadstatus')}}">Lead Status</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('leadsource')}}">Lead Source</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('industry')}}">Lead Industry</a></button>
                        <button class="buttondata buttondata2"><a href="{{ url('salesgroup')}}">Sales Group</a></button>
                       <button class="buttondata buttondata2"><a href="{{ url('contact')}}">Contacts</a></button>
                       <button class="buttondata buttondata2"><a href="{{ url('organization')}}">Organization</a></button>
                       <button class="buttondata buttondata2"><a href="{{ url('custcategory')}}">Cust Category</a></button>

                    </div>
                </div>
            <?php if(isset($editleadstatus)){
            
            ?>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Lead Status</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateleadstatus')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editleadstatus->id;?>">
                     <div class="form-group">
                      <label for="exampleInputUsername1">Lead Status</label>
                    <input type="text" name="leadstatus" placeholder="Enter Lead Status" class="form-control" value="<?php echo $editleadstatus->lead_status;?>">
                    </div>
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
          
            <div class="col-md-9 grid-margin stretch-card">
              <div class="card" style="height:265px;">
                <div class="card-body">
                  <h4 class="card-title">Add New Cust Catgory</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addcustcategory')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Cust Catgory</label>
                    <input type="text" name="custcategory" placeholder="Enter Cust Catgory" class="form-control">
                    </div>
                     
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new Cust Catgory</button>
                    
                  </form>
                </div>
              </div>
            </div>
            
            <?php }?>
            <div class="col-md-9 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                   
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Cust Catgory</th>
                         
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($data as $dataval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $dataval->category;?></td>
                        
                        
                          <td>
                          <a href="{{url('/custcategorydelete/'.$dataval->id)}}"><i class="fa fa-trash"></i></a>
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
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
              Lead Source
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lead Source</li>
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
            <?php if(isset($editleadsource)){
            
            ?>
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
                       

                    </div>
                </div>
            <div class="col-md-9 grid-margin stretch-card">
              <div class="card" style="height:265px;">
                <div class="card-body">
                  <h4 class="card-title">Edit Lead Source</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateleadsource')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editleadsource->id;?>"
                     <div class="form-group">
                      <label for="exampleInputUsername1">Lead Source</label>
                    <input type="text" name="leadsource" placeholder="Enter Lead Source" class="form-control" value="<?php echo $editleadsource->lead_source;?>" required>
                    </div>
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            </div>
            <?php }else {?>
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
                       

                    </div>
                </div>
            <div class="col-md-9 grid-margin stretch-card">
              <div class="card" style="height:265px;;">
                <div class="card-body">
                  <h4 class="card-title">Add New Lead Source</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/addleadsource')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Lead Source</label>
                    <input type="text" name="leadsource" placeholder="Enter Lead Source" class="form-control" required>
                    </div>
                     
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add new LeadSource</button>
                    
                  </form>
                </div>
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
                          <th>Lead Source</th>
                         
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1;foreach($leadsource as $leadsourceval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $leadsourceval->lead_source;?></td>
                        
                        
                          <td><a href="{{url('/leadsourceedit/'.$leadsourceval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/leadsourcedelete/'.$leadsourceval->id)}}"><i class="fa fa-trash"></i></a>
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
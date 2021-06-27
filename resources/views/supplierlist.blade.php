@include('header')
<div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Supplier
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Supplier</li>
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
            
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
                          <th>campaign</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                     
                        
                        $i = 1;foreach($suppliers as $supplier) {
                        $campagian = DB::table('crm_campaign')->where(['id' => $supplier->campaign])->first();
                        ?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $supplier->leadname;?></td>
                          <td><?php echo $supplier->phone;?></td>
                          <td><?php echo $supplier->email;?></td>
                          <td><?php if(isset($campagian)){ echo $campagian->campaign_name;}?></td>
                          
                          <td>
                              <!--<a href="{{url('/supplieredit/'.$supplier->id)}}"><i class="fa fa-edit"></i></a>-->
                          <a href="{{url('/supplierdelete/'.$supplier->id)}}"><i class="fa fa-trash"></i></a>
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
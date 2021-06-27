@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Vendor
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
              </ol>
            </nav>
          </div>
            <div class="row">
               <div class="col-md-12"> 
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
                <h4 class="card-title">Vendor List</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name </th>
                          <th>Email </th>
                          <th>Phone</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($vendor as $vendordata){
                          
                        ?>
                        <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $vendordata->name }} </td>
                        <td>{{ $vendordata->email }}</td>
                        <td>{{ $vendordata->mobile }}</td>
                        <td><?php if($vendordata->status == 0){?>
                        <a class="btn btn-danger" onclick="activate({{ $vendordata->id }})">Deactivate</a>
                        <?php }else {?>
                        <a class="btn btn-success"  onclick="deactivate({{ $vendordata->id }})">Activate</a>
                        <?php }?></td>
                        <td>
                          <a href="{{url('/vendordelete/'.$vendordata->id)}}"><i class="fa fa-trash"></i></a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@include('footer')
<script>
    function activate(id)
    {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('activatevendor') }}", 
            type:"POST",
            data:{vendorid: id},
            success: function(result){
            alert('Vendor activate successfully');
            location.reload();
        }});
    }
    function deactivate(id)
    {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('deactivatevendor') }}", 
            type:"POST",
            data:{vendorid: id},
            success: function(result){
            alert('Vendor deactivate successfully');
             location.reload();
        }});
    }
</script>


@include('header')


<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Plugin
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Plugin</li>
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
       
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: 550px;">
                <div class="card-body">
                  <h4 class="card-title">Plugin</h4>
                  
               
                  <form class="" method="POST" action="{{ url('/addplugin')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <label for="exampleInputUsername1">POS</label>
                    <div class="form-group">
                      
                     <label class="switch">
                      <input type="checkbox" name="pos" <?php if($data?->pos == '1'){echo 'checked';}?>>
                      <span class="slider round"></span>
                    </label>

                    </div>
                      <label for="exampleInputUsername1">CRM</label>
                    <div class="form-group">
                    
                     <label class="switch">
                      <input type="checkbox"   name="crm" <?php if($data?->crm == '1'){echo 'checked';}?>>
                      <span class="slider round"></span>
                    </label>

                    </div>
                    <button type="submit" name="submit">Submit</button>
                    
                  </form>
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
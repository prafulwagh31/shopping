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
              Timeslot
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Timeslot</li>
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
            
                
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Edit Timeslot</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updateduration')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editduration->id;?>">
                     <div class="form-group">
                      <label for="exampleInputUsername1">Timeslot</label>
                    <input type="text" name="durationdata" placeholder="" class="form-control" value="<?php echo $editduration->duartion;?>">
                    </div>
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            
                
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card" style="height:auto;">
                <div class="card-body">
                  <h4 class="card-title">Add New Timeslot</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addtimeslot')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                    <div class="form-group">
                      <label for="exampleInputUsername1">Service</label>
                        <select Class="form-control" name="service_id" onchange="getstaff(this)">
                            <option value=""></option>
                            <?php foreach($service as $serviceval){?>
                            <option value="{{$serviceval->id}}">{{$serviceval->service_name}}</option>
                            <?php }?>
                        </select>
                        <span style="color:red;">{{ $errors->first('service_id') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Staff</label>
                        <select Class="form-control" name="staff_id" id="staffdetails">
                            <option value=""></option>
                            <?php foreach($service as $serviceval){?>
                            <option value="{{$serviceval->id}}">{{$serviceval->service_name}}</option>
                            <?php }?>
                        </select>
                        <span style="color:red;">{{ $errors->first('staff_id') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Day</label>
                      <select class="form-control" name="day">
                          <option value=""></option>
                          <option value="Mon">Monday</option>
                          <option value="Tue">Tuesday</option>
                          <option value="Wed">Wednesday</option>
                          <option value="Thu">Thursday</option>
                          <option value="Fri">Friday</option>
                          <option value="Sat">Saturday</option>
                           <option value="Sun">Sunday</option>
                      </select>
                      <span style="color:red;">{{ $errors->first('day') }}</span>
                    </div>
                     <div class="form-group">
                      <label for="exampleInputUsername1">Duration</label>
                        <select class="form-control" name="duration" onchange="gettimeslot(this)">
                           <option value=""></option>
                                <?php foreach($durationdata as $durationdata) { ?>
                                <option value="<?php echo $durationdata->duartion;?>"><?php echo $durationdata->duartion;?></option>
                                <?php }?>
                        </select>
                        <span style="color:red;">{{ $errors->first('duration') }}</span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Timeslot</label>
                      <div id="timeslot"></div>
                      
                        <!--<select class="form-control" name="timeslot" id="timeslot">-->
                           
                        <!--</select>-->
                        
                    </div>
                    
                   
                    
                   
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
            <div class="col-md-6 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Staff Name</th>
                            <th>Date</th>
                            <th>Timeslot</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                       <?php 
                       $i = 1 ;
                       foreach($service_timeslot as $service_timeslot){
                       $servicedata = DB::table('services')->where('id','=',$service_timeslot->service_id)->first();
                       $staff = DB::table('tbl_staff')->where('id','=',$service_timeslot->staff_id)->first();
                       ?>
                       <tr>
                        <td><?php echo $i;?></td>
                       <td>{{$servicedata->service_name}}</td>
                        <td>@if(isset($staff)){{$staff->name}}@endif</td>
                       
                       <td>{{$service_timeslot->day}}</td>
                       <td>{{$service_timeslot->timeslot}}</td>
                       <td>
                          
                          <a href="{{url('/timeslotdelete/'.$service_timeslot->id)}}"><i class="fa fa-trash"></i></a>
                          
                          </td>
                         </tr>
                        <?php 
                        $i++;
                        }?>
                       
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
function getstaff(the)
{
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        var serviceid = $(the).val();
        $.ajax({
                url: "{{ route('getstaff') }}", 
                type:"POST",
                data:{serviceid:serviceid},
              
                success: function(result){
                $('#staffdetails').html(result);
    
            }});
}
function gettimeslot(the)
{
     $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        var duration = $(the).val();
        $.ajax({
                url: "{{ route('gettimeslot') }}", 
                type:"POST",
                data:{duration:duration},
              
                success: function(result){
                $('#timeslot').html(result);
    
            }});
}
</script>
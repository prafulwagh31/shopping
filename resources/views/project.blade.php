@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Projects
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Projects</li>
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
            <?php if(isset($editproject)){
            
            ?>
             <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add Projects</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/updateproject')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     <input type="hidden" name="hiddenid" value="<?php echo $editproject->id;?>">
                     
              
                    <div class="form-group">
                        <label><strong>Project Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Project Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editproject->prj_name;?>" name="prjname">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Status</label>
                          <select class="form-control" name="status" id="statustype" value="<?php echo $editproject->status;?>"  onchange="getexternallink(this)">
                                <option value="" data-select2-id="145">Select an Option</option>
                				<option value="Started" presence="1" data-select2-id="182">Started</option>
                				<option value="New" presence="1" data-select2-id="183">New</option>
                				<option value="In Progress" presence="1" data-select2-id="184">In Progress</option>
                				<option value="Waiting for feedback" presence="1" data-select2-id="185">Waiting for feedback</option>
                				<option value="On Hold" presence="1" data-select2-id="186">On Hold</option>
                				<option value="Completed" presence="1" data-select2-id="187">Completed</option>
                				<option value="Delivered" presence="1" data-select2-id="188">Delivered</option>
                				<option value="Archieved" presence="1" data-select2-id="189">Archieved</option>
                		  </select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Related To</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" value="<?php echo $editproject->related_to;?>" name="releatedto">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assigned To</label>
                            <select class="form-control" name="assignto" id="assignedto" value="<?php echo $editproject->assignedto;?>" onchange="getexternallink(this)">
                                <optgroup label="Users" data-select2-id="199">
                					<option selected="selected" value="1" data-select2-id="140">Alexca</option>
                				</optgroup>
                				<optgroup label="Groups" data-select2-id="200">
                                    <option value="3" data-select2-id="201">Team Selling</option>
					                <option value="4" data-select2-id="202">Marketing Group</option>
					                <option value="5" data-select2-id="203">Support Group</option>
                                </optgroup>
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Start Date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editproject->start_date;?>" name="sdate">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Target End Date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editproject->target_enddate;?>" name="tenddate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Actual End Date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editproject->actual_enddate;?>" name="aenddate">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Deal Name</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" value="<?php echo $editproject->deal_name;?>" name="dealname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Contact Name</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" value="<?php echo $editproject->contact_name;?>" name="contactname">
                            </div><br><br>
                            
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Custom Information</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Target Budget</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editproject->target_budget;?>" name="targetbudget">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Project Url</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editproject->project_url;?>" name="prjurl">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Priority</label>
                                <select class="form-control" name="priority" id="prioritytype" value="<?php echo $editproject->priority;?>"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="High" presence="1" data-select2-id="182">High</option>
                    				<option value="Medium" presence="1" data-select2-id="183">Medium</option>
                    				<option value="Low" presence="1" data-select2-id="184">Low</option>
                    		    </select>
                    		</div>
                    		<div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Progress</label>
                                <select class="form-control" name="progress" id="progresstype" value="<?php echo $editproject->progress;?>"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="10%" presence="1" data-select2-id="182">10%</option>
                    				<option value="20%" presence="1" data-select2-id="183">20%</option>
                    				<option value="30%" presence="1" data-select2-id="184">30%</option>
                    				<option value="40%" presence="1" data-select2-id="185">40%</option>
                    				<option value="50%" presence="1" data-select2-id="186">50%</option>
                    				<option value="60%" presence="1" data-select2-id="187">60%</option>
                    				<option value="70%" presence="1" data-select2-id="188">70%</option>
                    				<option value="80%" presence="1" data-select2-id="189">80%</option>
                    				<option value="90%" presence="1" data-select2-id="190">90%</option>
                    				<option value="100%" presence="1" data-select2-id="191">100%</option>
                    		    </select>
                    		</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-8">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondatatype"><?php echo $editproject->description;?></textarea>
                        </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add Projects</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addproject')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Project Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Project Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="prjname">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Status</label>
                          <select class="form-control" name="status" id="statustype"  onchange="getexternallink(this)">
                                <option value="" data-select2-id="145">Select an Option</option>
                				<option value="Started" presence="1" data-select2-id="182">Started</option>
                				<option value="New" presence="1" data-select2-id="183">New</option>
                				<option value="In Progress" presence="1" data-select2-id="184">In Progress</option>
                				<option value="Waiting for feedback" presence="1" data-select2-id="185">Waiting for feedback</option>
                				<option value="On Hold" presence="1" data-select2-id="186">On Hold</option>
                				<option value="Completed" presence="1" data-select2-id="187">Completed</option>
                				<option value="Delivered" presence="1" data-select2-id="188">Delivered</option>
                				<option value="Archieved" presence="1" data-select2-id="189">Archieved</option>
                		  </select>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Related To</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="releatedto">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assigned To</label>
                            <select class="form-control" name="assignto" id="assignedto"  onchange="getexternallink(this)">
                                <optgroup label="Users" data-select2-id="199">
                					<option selected="selected" value="1" data-select2-id="140">Alexca</option>
                				</optgroup>
                				<optgroup label="Groups" data-select2-id="200">
                                    <option value="3" data-select2-id="201">Team Selling</option>
					                <option value="4" data-select2-id="202">Marketing Group</option>
					                <option value="5" data-select2-id="203">Support Group</option>
                                </optgroup>
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Start Date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="sdate">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Target End Date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="tenddate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Actual End Date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="aenddate">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Deal Name</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="dealname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Contact Name</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="contactname">
                            </div><br><br>
                            
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Custom Information</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Target Budget</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="targetbudget">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Project Url</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="prjurl">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Priority</label>
                                <select class="form-control" name="priority" id="prioritytype"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="High" presence="1" data-select2-id="182">High</option>
                    				<option value="Medium" presence="1" data-select2-id="183">Medium</option>
                    				<option value="Low" presence="1" data-select2-id="184">Low</option>
                    		    </select>
                    		</div>
                    		<div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Progress</label>
                                <select class="form-control" name="progress" id="progresstype"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="10%" presence="1" data-select2-id="182">10%</option>
                    				<option value="20%" presence="1" data-select2-id="183">20%</option>
                    				<option value="30%" presence="1" data-select2-id="184">30%</option>
                    				<option value="40%" presence="1" data-select2-id="185">40%</option>
                    				<option value="50%" presence="1" data-select2-id="186">50%</option>
                    				<option value="60%" presence="1" data-select2-id="187">60%</option>
                    				<option value="70%" presence="1" data-select2-id="188">70%</option>
                    				<option value="80%" presence="1" data-select2-id="189">80%</option>
                    				<option value="90%" presence="1" data-select2-id="190">90%</option>
                    				<option value="100%" presence="1" data-select2-id="191">100%</option>
                    		    </select>
                    		</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-8">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondatatype"></textarea>
                        </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }?>
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
                          <th>Project Name</th>
                          <th>Related To</th>
                          <th>Contact Name</th>
                          <th>Status</th>
                          <th>Assigned To</th>
                          <th>Start Date</th>
                          <th>Target End Date</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($projectdata as $projectval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $projectval->prj_name;?></td>
                          <td><?php echo $projectval->related_to;?></td>
                          <td><?php echo $projectval->contact_name;?></td>
                          <td><?php echo $projectval->status;?></td>
                          <td><?php echo $projectval->assignedto;?></td>
                          <td><?php echo $projectval->start_date;?></td>
                          <td><?php echo $projectval->target_enddate;?></td>
                          <td><a href="{{url('/projectedit/'.$projectval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/projectdelete/'.$projectval->id)}}"><i class="fa fa-trash"></i></a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@include('footer')

<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: '{{ route('projects.storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
       
      $('.dropzoneimg').append('<input type="hidden" name="document[]" value="' + response.name + '">')
      uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDocumentMap[file.name]
      }
      $('.dropzoneimg').find('input[name="document[]"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('.dropzoneimg').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script>
<script>
    CKEDITOR.replace( 'descriptiondatatype' );
    CKEDITOR.replace('seodescription');
</script>
<script>
    $(document).ready(function(){
        $('#quantity').click(function(){
            if($(this).prop("checked") == true){
                console.log("Checkbox is checked.");
                $('#quantityinput').css('display','');
            }
            else if($(this).prop("checked") == false){
                $('#quantityinput').css('display','none');
            }
        });
        $('#shipping').click(function(){
            if($(this).prop("checked") == true){
                
                $('#shippingdetails').css('display','');
            }
            else if($(this).prop("checked") == false){
                $('#shippingdetails').css('display','none');
            }
        });
    });
    function getterms(the,count)
    {
        var attribute = $(the).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('getterms') }}", 
            type:"POST",
            data:{attribute: attribute},
            success: function(result){
            $("#attributeterm"+count+"").html(result);
        }});
    }
    
    
    function getperivewoption(the)
    {
        var optionarray = [];
        // for(var i = 0; i<= count;i++)
        // {
            var optiondata = $('the').val();
            alert(optiondata);
            optionarray.push(optiondata);
        // }
        console.log(optionarray);
    }
    function addotheroption()
    {
        $('#denomiationdata').append('<br><div class="row"><div class="col-md-4"><input type="text" class="form-control"  name="denomiation[]" placeholder="Rs:- 0.00"></div><div class="col-md-2"><span style="padding-left: 30px;"><i class="fa fa-trash"></i></span></div></div>');
    }
</script>
<script>
    $("#shippingrates").hide();
$("#checkboxid").click(function() {
    if($(this).is(":checked")) {
        $("#shippingrates").show();
    } else {
        $("#shippingrates").hide();
    }
});
</script>
<script>
    $("#requirement").hide();
$("#purchase").click(function() {
    if($(this).is(":checked")) {
        $("#requirement").show();
         $("#requireitems").hide();
    } else {
        $("#requirement").hide();
    }
});
</script>
<script>
    $("#requireitems").hide();
$("#quantity").click(function() {
    if($(this).is(":checked")) {
        $("#requireitems").show();
         $("#requirement").hide();
    } else {
        $("#requireitems").hide();
    }
});
$("#require").click(function() 
{
    $("#requireitems").hide();
     $("#requirement").hide();
});
</script>
<script>
    $("#limit").hide();
$("#checkboxitem").click(function() {
    if($(this).is(":checked")) {
        $("#limit").show();
    } else {
        $("#limit").hide();
    }
});
</script>
<script>
    $("#enddata").hide();
$("#enddate").click(function() {
    if($(this).is(":checked")) {
        $("#enddata").show();
    } else {
        $("#enddata").hide();
    }
});
</script>
<script>
    $("#country").hide();
$("#optionsRadios2").click(function() {
    if($(this).is(":checked")) {
        $("#country").show();
    } else {
        $("#country").hide();
    }
});
$("#optionsRadios1").click(function() 
{
    $("#country").hide();
    
});
</script>
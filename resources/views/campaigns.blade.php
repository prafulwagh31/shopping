@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Campaigns
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Campaigns</li>
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
            <?php if(isset($editcampaigns)){
            
            ?>
             <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Creating New Campaign</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/updatecampaigns')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     <input type="hidden" name="hiddenid" value="<?php echo $editcampaigns->id;?>">
              
                    <div class="form-group">
                        <label><strong>Campaign Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-12">
                          <label for="exampleInputUsername1">Campaign Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fname" value="<?php echo $editcampaigns->campaign_name;?>" required>
                        </div><br><br>
                       
                        
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Assigned Sales Group</label>
                                  <select class="form-control"  name="salegroupleads" required>
                                      <option></option>
                                        <?php
                                        foreach($salesuser as $salesuser)
                                        { ?>
                                        <option value="<?php echo $salesuser->id; ?>" <?php if($editcampaigns->sales_group ==  $salesuser->id){echo 'selected';}?>><?php echo $salesuser->group_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>  
                           
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Assigned Sales User</label>
                                  <select class="form-control"  name="saleuserleads" required>
                                      <option></option>
                                        <?php
                                        foreach($access_users as $access_users)
                                        { ?>
                                        <option value="<?php echo $access_users->id; ?>" <?php if($editcampaigns->sales_user ==  $access_users->id){echo 'selected';}?>><?php echo $access_users->name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Campaign Status</label>
                            <select class="form-control" name="campa" id="campaignstatus" value="<?php echo $editcampaigns->campaign_status;?>" onchange="getexternallink(this)" required>
                                <option></option>
                				<option value="Planning" color="#D9D9D9" presence="1" data-select2-id="162">Planning</option>
                				<option value="Active" color="#5ACCDB" presence="1" data-select2-id="170">Active</option>
                				<option value="Inactive" color="#CF9948" presence="1" data-select2-id="171">Inactive</option>
                				<option value="Completed" color="#00FF00" presence="1" data-select2-id="167" selected="selected">Completed</option>
                				<option value="Cancelled" color="#C48923" presence="1" data-select2-id="168">Canceled</option>
                			 </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Campaign Type</label>
                            <select class="form-control" name="campaign" id="campaigntype" value="<?php echo $editcampaigns->campaign_type;?>" onchange="getexternallink(this)" required>
                                <option></option>
                				<option value="Conference" presence="1" data-select2-id="182">Conference</option>
                				<option value="Webinar" presence="1" data-select2-id="183">Webinar</option>
                				<option value="Trade Show" presence="1" data-select2-id="184">Trade Show</option>
                				<option value="Public Relations" presence="1" data-select2-id="185">Public Relations</option>
                				<option value="Partners" presence="1" data-select2-id="186">Partners</option>
                				<option value="Referral Program" presence="1" data-select2-id="187">Referral Program</option>
                				<option value="Advertisement" presence="1" data-select2-id="188">Advertisement</option>
                				<option value="Banner Ads" presence="1" data-select2-id="189">Banner Ads</option>
                				<option value="Direct Mail" presence="1" data-select2-id="190">Direct Mail</option>
                				<option value="Email" presence="1" data-select2-id="191">Primary Email</option>
                				<option value="Telemarketing" presence="1" data-select2-id="192">Telemarketing</option>
                				<option value="Others" presence="1" data-select2-id="193">Others</option>
                                
                            </select>
                        </div>
                        </div>
                    
                    <div class="row">
                    <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Product</label>
                          <select class="form-control" name="productcategory" required>
                              <option></option>
                              <?php
                              foreach($category as $category)
                              {?>
                                  <option value="<?php echo $category->id;?>" <?php if($category->id == $editcampaigns->product){echo 'selected';}?>><?php echo $category->name;?></option>
                              <?php
                                  
                              }
                              
                              ?>
                              </select>
                           
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Target Audience</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="targetaudience" value="<?php echo $editcampaigns->target_audience;?>">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Expected Close Date</label>
                            <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="closingdate" value="<?php echo $editcampaigns->closedate;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Sponsor</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="sponsor" value="<?php echo $editcampaigns->sponsor;?>">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">TargetSize</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="targetsize" value="<?php echo $editcampaigns->targetsize;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Num Sent</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="numsent" value="<?php echo $editcampaigns->num_sent;?>">
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label><strong>Expectations & Actuals</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Budget Cost</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="budgetcost" value="<?php echo $editcampaigns->budget_cost;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Actual Cost</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualcost" value="<?php echo $editcampaigns->actual_cost;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Response</label>
                                <select class="form-control" name="expeceted" id="expected" value="<?php echo $editcampaigns->expeceted_response;?>"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="148">Select an Option</option>
                    				<option value="Excellent" color="#D9D9D9" presence="1" data-select2-id="162">Excellent</option>
                    				<option value="Good" color="#5ACCDB" presence="1" data-select2-id="170">Good</option>
                    				<option value="Average" color="#CF9948" presence="1" data-select2-id="171">Average</option>
                    				<option value="Poor" color="#00FF00" presence="1" data-select2-id="167" selected="selected">Poor</option>
                    			 </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Revenue</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedrevenue" value="<?php echo $editcampaigns->expected_revenue;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Sales Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedsalescount" value="<?php echo $editcampaigns->sales_count;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Actual Sales Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualsalescount" value="<?php echo $editcampaigns->actualsales_count;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Response Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedresponsecount" value="<?php echo $editcampaigns->response_count;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Actual Response Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualresponsecount" value="<?php echo $editcampaigns->actualresponse_count;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected ROI</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedroi" value="<?php echo $editcampaigns->expecetd_roi;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Actual ROI</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualroi" value="<?php echo $editcampaigns->actual_roi;?>">
                            </div>
                        </div>
                    
                </div>
                <div class="form-group">
                     <label><strong>Description Details</strong></label>
                     <div class="row">
                        <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondatacampaign"><?php echo $editcampaigns->description_campaign;?></textarea>
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
                  <h4 class="card-title">Creating New Campaign</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addcampaigns')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Campaign Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-12">
                          <label for="exampleInputUsername1">Campaign Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fname" required>
                        </div><br><br>
                        
                        </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Assigned Sales Group</label>
                                  <select class="form-control"  name="salegroupleads" required>
                                      <option></option>
                                        <?php
                                        foreach($salesuser as $salesuser)
                                        { ?>
                                        <option value="<?php echo $salesuser->id; ?>"><?php echo $salesuser->group_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>  
                           
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Assigned Sales User</label>
                                  <select class="form-control"  name="saleuserleads" required>
                                      <option></option>
                                        <?php
                                        foreach($access_users as $access_users)
                                        { ?>
                                        <option value="<?php echo $access_users->id; ?>"><?php echo $access_users->name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Campaign Status</label>
                            <select class="form-control" name="campa" id="campaignstatus"  onchange="getexternallink(this)" required>
                                <option></option>
                				<option value="Planning" color="#D9D9D9" presence="1" data-select2-id="162">Planning</option>
                				<option value="Active" color="#5ACCDB" presence="1" data-select2-id="170">Active</option>
                				<option value="Inactive" color="#CF9948" presence="1" data-select2-id="171">Inactive</option>
                				<option value="Completed" color="#00FF00" presence="1" data-select2-id="167" selected="selected">Completed</option>
                				<option value="Cancelled" color="#C48923" presence="1" data-select2-id="168">Canceled</option>
                			 </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Campaign Type</label>
                            <select class="form-control" name="campaign" id="campaigntype"  onchange="getexternallink(this)" required>
                                <option></option>
                				<option value="Conference" presence="1" data-select2-id="182">Conference</option>
                				<option value="Webinar" presence="1" data-select2-id="183">Webinar</option>
                				<option value="Trade Show" presence="1" data-select2-id="184">Trade Show</option>
                				<option value="Public Relations" presence="1" data-select2-id="185">Public Relations</option>
                				<option value="Partners" presence="1" data-select2-id="186">Partners</option>
                				<option value="Referral Program" presence="1" data-select2-id="187">Referral Program</option>
                				<option value="Advertisement" presence="1" data-select2-id="188">Advertisement</option>
                				<option value="Banner Ads" presence="1" data-select2-id="189">Banner Ads</option>
                				<option value="Direct Mail" presence="1" data-select2-id="190">Direct Mail</option>
                				<option value="Email" presence="1" data-select2-id="191">Primary Email</option>
                				<option value="Telemarketing" presence="1" data-select2-id="192">Telemarketing</option>
                				<option value="Others" presence="1" data-select2-id="193">Others</option>
                                
                            </select>
                        </div>
                        </div>
                    
                    <div class="row">
                    <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Product</label>
                            <select class="form-control js-example-basic-multiple" name="productcategory"  multiple="multiple" required>
                              <option></option>
                              <?php
                              foreach($category as $category)
                              {?>
                                  <option value="<?php echo $category->id;?>" ><?php echo $category->name;?></option>
                              <?php
                                  
                              }
                              
                              ?>
                              </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Target Audience</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="targetaudience">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Expected Close Date</label>
                            <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="closingdate">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Sponsor</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="sponsor">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">TargetSize</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="targetsize">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Num Sent</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="numsent">
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label><strong>Expectations & Actuals</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Budget Cost</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="budgetcost">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Actual Cost</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualcost">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Response</label>
                                <select class="form-control" name="expeceted" id="expected"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="148">Select an Option</option>
                    				<option value="Excellent" color="#D9D9D9" presence="1" data-select2-id="162">Excellent</option>
                    				<option value="Good" color="#5ACCDB" presence="1" data-select2-id="170">Good</option>
                    				<option value="Average" color="#CF9948" presence="1" data-select2-id="171">Average</option>
                    				<option value="Poor" color="#00FF00" presence="1" data-select2-id="167" selected="selected">Poor</option>
                    			 </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Revenue</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedrevenue">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Sales Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedsalescount">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Actual Sales Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualsalescount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected Response Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedresponsecount">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Actual Response Count</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualresponsecount">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Expected ROI</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="expectedroi">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Actual ROI</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="actualroi">
                            </div>
                        </div>
                    
                </div>
                <div class="form-group">
                     <label><strong>Description Details</strong></label>
                     <div class="row">
                        <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondatacampaign"></textarea>
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
                          <th>Campaign Name</th>
                          <th>Campaign Type</th>
                          <th>Campaign Status</th>
                          <th>Expected Revenue</th>
                          <th>Expected Close Date</th>
                        
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($campaignsdata as $campaignsval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $campaignsval->campaign_name;?></td>
                          <td><?php echo $campaignsval->campaign_type;?></td>
                          <td><?php echo $campaignsval->campaign_status;?></td>
                          <td><?php echo $campaignsval->expected_revenue;?></td>
                          <td><?php echo $campaignsval->closedate;?></td>
                          
                          <td><a href="{{url('/campaignsedit/'.$campaignsval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/campaignsdelete/'.$campaignsval->id)}}"><i class="fa fa-trash"></i></a>
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
    CKEDITOR.replace( 'descriptiondatacampaign' );
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
$(".js-example-basic-multiple").select2();
</script>
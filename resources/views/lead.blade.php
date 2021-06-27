@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Leads
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Leads</li>
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
            <?php if(isset($editlead)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Creating New Lead</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/updatelead')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     <input type="hidden" name="hiddenid" value="<?php echo $editlead->id;?>">
                     <?php $explode = explode(' ',$editlead->name);?>
              
                    <div class="form-group">
                        <label><strong>Lead Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">First Name</label>
                          <select class="inputElement select2 select2-offscreen" name="salutationtype"  tabindex="-1" title="" aria-invalid="false">
                    		<option value="">None</option>
                    		<option value="Mr.">Mr.</option>
                    		<option value="Ms.">Ms.</option>
                    		<option value="Mrs.">Mrs.</option>
                    		<option value="Dr.">Dr.</option>
                    		<option value="Prof.">Prof.</option>
                    	</select>&nbsp;<input id="Contacts_editView_fieldName_firstname" type="text" name="firstname" value="<?php echo $explode[0];?>" class="form-control">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Last Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lastname" value="<?php echo $explode[1];?>">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="primaryphone" value="<?php echo $editlead->primary_phone;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Company</label>
                           <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="company" value="<?php echo $editlead->company;?>"> 
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Mobile Phone</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mobilephone" value="<?php echo $editlead->mobile_phone;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Designation</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="designation" value="<?php echo $editlead->designation;?>"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Fax</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="faxlead" value="<?php echo $editlead->fax;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Lead Source</label>
                                  <select class="form-control" name="leadsource" id="leadsource"  onchange="getexternallink(this)" value="<?php echo $editlead->lead_source;?>">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Cold Call" presence="1" data-select2-id="182">Cold Call</option>
                    				<option value="Existing Customer" presence="1" data-select2-id="183">Existing Customer</option>
                    				<option value="Self Generated" presence="1" data-select2-id="184">Self Generated</option>
                    				<option value="Employee" presence="1" data-select2-id="185">Employee</option>
                    				<option value="Partner" presence="1" data-select2-id="186">Partner</option>
                    				<option value="Public Relations" presence="1" data-select2-id="187">Public Relations</option>
                    				<option value="Direct Mail" presence="1" data-select2-id="188">Direct Mail</option>
                    				<option value="Conference" presence="1" data-select2-id="189">Conference</option>
                    				<option value="Trade Show" presence="1" data-select2-id="190">Trade Show</option>
                    				<option value="Web Site" presence="1" data-select2-id="191">Web Site</option>
                    				<option value="Web Site" presence="1" data-select2-id="191">Word of Mouth</option>
                    				<option value="Web Site" presence="1" data-select2-id="191">Other</option>
                    		    </select>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Primary Email</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pleademail" value="<?php echo $editlead->primary_email;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Industry</label>
                                  <select class="form-control" name="leadindustry" id="leadindustry"  onchange="getexternallink(this)" value="<?php echo $editlead->industry;?>">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Apparel" presence="1" data-select2-id="182">Apparel</option>
                    				<option value="Banking" presence="1" data-select2-id="183">Banking</option>
                    				<option value="Biotechnology" presence="1" data-select2-id="184">Biotechnology</option>
                    				<option value="Chemicals" presence="1" data-select2-id="185">Chemicals</option>
                    				<option value="Communications" presence="1" data-select2-id="186">Communications</option>
                    				<option value="Construction" presence="1" data-select2-id="187">Construction</option>
                    				<option value="Consulting" presence="1" data-select2-id="188">Consulting</option>
                    				<option value="Education" presence="1" data-select2-id="189">Education</option>
                    				<option value="Electronics" presence="1" data-select2-id="190">Electronics</option>
                    				<option value="Energy" presence="1" data-select2-id="191">Energy</option>
                    				<option value="Engineering" presence="1" data-select2-id="192">Engineering</option>
                    				<option value="Entertainment" presence="1" data-select2-id="193">Entertainment</option>
                    				<option value="Environmental" presence="1" data-select2-id="194">Environmental</option>
                    				<option value="Finance" presence="1" data-select2-id="191">Finance</option>
                    				<option value="Food & Beverage" presence="1" data-select2-id="191">Food & Beverage</option>
                    				<option value="Government" presence="1" data-select2-id="191">Government</option>
                    				<option value="Healthcare" presence="1" data-select2-id="191">Healthcare</option>
                    				<option value="Hospitality" presence="1" data-select2-id="191">Hospitality</option>
                    				<option value="Insurance" presence="1" data-select2-id="191">Insurance</option>
                    				<option value="Machinery" presence="1" data-select2-id="191">Machinery</option>
                    				<option value="Manufacturing" presence="1" data-select2-id="191">Manufacturing</option>
                    				<option value="Media" presence="1" data-select2-id="191">Media</option>
                    				<option value="Not For Profit" presence="1" data-select2-id="191">Not For Profit</option>
                    				<option value="Recreation" presence="1" data-select2-id="191">Recreation</option>
                    				<option value="Retail" presence="1" data-select2-id="191">Retail</option>
                    				<option value="Shipping" presence="1" data-select2-id="191">Shipping</option>
                    				<option value="Technology" presence="1" data-select2-id="191">Technology</option>
                    				<option value="Telecommunications" presence="1" data-select2-id="191">Telecommunications</option>
                    				<option value="Transportation" presence="1" data-select2-id="191">Transportation</option>
                    				<option value="Utilities" presence="1" data-select2-id="191">Utilities</option>
                    				<option value="Other" presence="1" data-select2-id="191">Other</option>
                    		    </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Website</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="leadwebsite" value="<?php echo $editlead->website;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Annual Revenue</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="leadannualrevenue" value="<?php echo $editlead->annual_revenue;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Lead Status</label>
                                  <select class="form-control" name="leadstatus" id="leadstatus"  onchange="getexternallink(this)" value="<?php echo $editlead->lead_status;?>">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Attempted to Contact" presence="1" data-select2-id="182">Attempted to Contact</option>
                    				<option value="Cold" presence="1" data-select2-id="183">Cold</option>
                    				<option value="Contact in Future" presence="1" data-select2-id="184">Contact in Future</option>
                    				<option value="Contacted" presence="1" data-select2-id="185">Contacted</option>
                    				<option value="Hot" presence="1" data-select2-id="186">Hot</option>
                    				<option value="Junk Lead" presence="1" data-select2-id="187">Junk Lead</option>
                    				<option value="Lost Lead" presence="1" data-select2-id="188">Lost Lead</option>
                    				<option value="Not Contacted" presence="1" data-select2-id="189">Not Contacted</option>
                    				<option value="Pre Qualified" presence="1" data-select2-id="190">Pre Qualified</option>
                    				<option value="Qualified" presence="1" data-select2-id="191">Qualified</option>
                    				<option value="Warm" presence="1" data-select2-id="191">Warm</option>
                    		    </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Number of Employees</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="noofemployee" value="<?php echo $editlead->no_employees;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Rating</label>
                                  <select class="form-control" name="leadrating" id="leadrating"  onchange="getexternallink(this)" value="<?php echo $editlead->rating;?>">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Acquired" presence="1" data-select2-id="182">Acquired</option>
                    				<option value="Active" presence="1" data-select2-id="183">Active</option>
                    				<option value="Market Faile" presence="1" data-select2-id="184">Market Failed</option>
                    				<option value="Project Cancelled" presence="1" data-select2-id="185">Project Cancelled</option>
                    				<option value="Shutdown" presence="1" data-select2-id="186">Shutdown</option>
                    		    </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Secondary Email</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secoemail" value="<?php echo $editlead->secondary_email;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Assigned To</label>
                                  <select class="form-control" name="assignedto" id="assign"  onchange="getexternallink(this)" value="<?php echo $editlead->assigned_to;?>">
                                    <optgroup label="Users" data-select2-id="199">
                    					<option selected="selected" value="1" data-select2-id="140">Alexca</option>
                    				</optgroup>
                    				<optgroup label="Groups" data-select2-id="200">
                                        <option value="3" data-select2-id="201">Marketing Group</option>
    					                <option value="4" data-select2-id="202">Support Group</option>
    					                <option value="5" data-select2-id="203">Team Selling</option>
                                    </optgroup>	
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Email Opt Out</label><br>
                              <input type="checkbox" id="exampleInputUsername1" placeholder="" name="emailoutlead">
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Address Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Street</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="streetdescription"><?php echo $editlead->street;?></textarea>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">PO Box</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="poboxleaddescription"><?php echo $editlead->po_box;?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Postal Code</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="postalcodelead" value="<?php echo $editlead->postal_code;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">City</label>
                               <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="citylead" value="<?php echo $editlead->city;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Country</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="countrylead" value="<?php echo $editlead->country;?>">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">State</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="statelead" value="<?php echo $editlead->state;?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-8">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondatalead"><?php echo $editlead->lead_description;?></textarea>
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
                  <h4 class="card-title">Creating New Lead</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addlead')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Lead Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">First Name</label>
                          <select class="inputElement select2 select2-offscreen" name="salutationtype" tabindex="-1" title="" aria-invalid="false">
                    		<option value="">None</option>
                    		<option value="Mr.">Mr.</option>
                    		<option value="Ms.">Ms.</option>
                    		<option value="Mrs.">Mrs.</option>
                    		<option value="Dr.">Dr.</option>
                    		<option value="Prof.">Prof.</option>
                    	</select>&nbsp;<input id="Contacts_editView_fieldName_firstname" type="text" name="firstname" value="" class="form-control">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Last Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lastname">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="primaryphone">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Company</label>
                           <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="company"> 
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Mobile Phone</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mobilephone">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Designation</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="designation">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Fax</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="faxlead">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Lead Source</label>
                                  <select class="form-control" name="leadsource" id="leadsource"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Cold Call" presence="1" data-select2-id="182">Cold Call</option>
                    				<option value="Existing Customer" presence="1" data-select2-id="183">Existing Customer</option>
                    				<option value="Self Generated" presence="1" data-select2-id="184">Self Generated</option>
                    				<option value="Employee" presence="1" data-select2-id="185">Employee</option>
                    				<option value="Partner" presence="1" data-select2-id="186">Partner</option>
                    				<option value="Public Relations" presence="1" data-select2-id="187">Public Relations</option>
                    				<option value="Direct Mail" presence="1" data-select2-id="188">Direct Mail</option>
                    				<option value="Conference" presence="1" data-select2-id="189">Conference</option>
                    				<option value="Trade Show" presence="1" data-select2-id="190">Trade Show</option>
                    				<option value="Web Site" presence="1" data-select2-id="191">Web Site</option>
                    				<option value="Web Site" presence="1" data-select2-id="191">Word of Mouth</option>
                    				<option value="Web Site" presence="1" data-select2-id="191">Other</option>
                    		    </select>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Primary Email</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pleademail">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Industry</label>
                                  <select class="form-control" name="leadindustry" id="leadindustry"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Apparel" presence="1" data-select2-id="182">Apparel</option>
                    				<option value="Banking" presence="1" data-select2-id="183">Banking</option>
                    				<option value="Biotechnology" presence="1" data-select2-id="184">Biotechnology</option>
                    				<option value="Chemicals" presence="1" data-select2-id="185">Chemicals</option>
                    				<option value="Communications" presence="1" data-select2-id="186">Communications</option>
                    				<option value="Construction" presence="1" data-select2-id="187">Construction</option>
                    				<option value="Consulting" presence="1" data-select2-id="188">Consulting</option>
                    				<option value="Education" presence="1" data-select2-id="189">Education</option>
                    				<option value="Electronics" presence="1" data-select2-id="190">Electronics</option>
                    				<option value="Energy" presence="1" data-select2-id="191">Energy</option>
                    				<option value="Engineering" presence="1" data-select2-id="192">Engineering</option>
                    				<option value="Entertainment" presence="1" data-select2-id="193">Entertainment</option>
                    				<option value="Environmental" presence="1" data-select2-id="194">Environmental</option>
                    				<option value="Finance" presence="1" data-select2-id="191">Finance</option>
                    				<option value="Food & Beverage" presence="1" data-select2-id="191">Food & Beverage</option>
                    				<option value="Government" presence="1" data-select2-id="191">Government</option>
                    				<option value="Healthcare" presence="1" data-select2-id="191">Healthcare</option>
                    				<option value="Hospitality" presence="1" data-select2-id="191">Hospitality</option>
                    				<option value="Insurance" presence="1" data-select2-id="191">Insurance</option>
                    				<option value="Machinery" presence="1" data-select2-id="191">Machinery</option>
                    				<option value="Manufacturing" presence="1" data-select2-id="191">Manufacturing</option>
                    				<option value="Media" presence="1" data-select2-id="191">Media</option>
                    				<option value="Not For Profit" presence="1" data-select2-id="191">Not For Profit</option>
                    				<option value="Recreation" presence="1" data-select2-id="191">Recreation</option>
                    				<option value="Retail" presence="1" data-select2-id="191">Retail</option>
                    				<option value="Shipping" presence="1" data-select2-id="191">Shipping</option>
                    				<option value="Technology" presence="1" data-select2-id="191">Technology</option>
                    				<option value="Telecommunications" presence="1" data-select2-id="191">Telecommunications</option>
                    				<option value="Transportation" presence="1" data-select2-id="191">Transportation</option>
                    				<option value="Utilities" presence="1" data-select2-id="191">Utilities</option>
                    				<option value="Other" presence="1" data-select2-id="191">Other</option>
                    		    </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Website</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="leadwebsite">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Annual Revenue</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="leadannualrevenue">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Lead Status</label>
                                  <select class="form-control" name="leadstatus" id="leadstatus"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Attempted to Contact" presence="1" data-select2-id="182">Attempted to Contact</option>
                    				<option value="Cold" presence="1" data-select2-id="183">Cold</option>
                    				<option value="Contact in Future" presence="1" data-select2-id="184">Contact in Future</option>
                    				<option value="Contacted" presence="1" data-select2-id="185">Contacted</option>
                    				<option value="Hot" presence="1" data-select2-id="186">Hot</option>
                    				<option value="Junk Lead" presence="1" data-select2-id="187">Junk Lead</option>
                    				<option value="Lost Lead" presence="1" data-select2-id="188">Lost Lead</option>
                    				<option value="Not Contacted" presence="1" data-select2-id="189">Not Contacted</option>
                    				<option value="Pre Qualified" presence="1" data-select2-id="190">Pre Qualified</option>
                    				<option value="Qualified" presence="1" data-select2-id="191">Qualified</option>
                    				<option value="Warm" presence="1" data-select2-id="191">Warm</option>
                    		    </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Number of Employees</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="noofemployee">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Rating</label>
                                  <select class="form-control" name="leadrating" id="leadrating"  onchange="getexternallink(this)">
                                    <option value="" data-select2-id="145">Select an Option</option>
                    				<option value="Acquired" presence="1" data-select2-id="182">Acquired</option>
                    				<option value="Active" presence="1" data-select2-id="183">Active</option>
                    				<option value="Market Faile" presence="1" data-select2-id="184">Market Failed</option>
                    				<option value="Project Cancelled" presence="1" data-select2-id="185">Project Cancelled</option>
                    				<option value="Shutdown" presence="1" data-select2-id="186">Shutdown</option>
                    		    </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Secondary Email</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secoemail">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Assigned To</label>
                                  <select class="form-control" name="assignedto" id="assign"  onchange="getexternallink(this)">
                                    <optgroup label="Users" data-select2-id="199">
                    					<option selected="selected" value="1" data-select2-id="140">Alexca</option>
                    				</optgroup>
                    				<optgroup label="Groups" data-select2-id="200">
                                        <option value="3" data-select2-id="201">Marketing Group</option>
    					                <option value="4" data-select2-id="202">Support Group</option>
    					                <option value="5" data-select2-id="203">Team Selling</option>
                                    </optgroup>	
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Email Opt Out</label><br>
                              <input type="checkbox" id="exampleInputUsername1" placeholder="" name="emailoutlead">
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Address Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Street</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="streetdescription"></textarea>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">PO Box</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="poboxleaddescription"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Postal Code</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="postalcodelead">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">City</label>
                               <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="citylead">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Country</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="countrylead">
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">State</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="statelead">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-8">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondatalead"></textarea>
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
                          <th>Name</th>
                          <th>Company</th>
                          <th>Primary Phone</th>
                          <th>Website</th>
                          <th>Primary Email</th>
                          <th>Assigned To</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1; foreach($leaddata as $leadval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $leadval->name;?></td>
                          <td><?php echo $leadval->company;?></td>
                          <td><?php echo $leadval->primary_phone;?></td>
                          <td><?php echo $leadval->website;?></td>
                          <td><?php echo $leadval->primary_email;?></td>
                          <td><?php echo $leadval->assigned_to;?></td>
                          <td><a href="{{url('/leadedit/'.$leadval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/leaddelete/'.$leadval->id)}}"><i class="fa fa-trash"></i></a>
                          <a href="{{url('/leadconvert/'.$leadval->id)}}" class="btn btn-gradient-primary">Convert Lead To contact</a>
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
    CKEDITOR.replace('streetdescription');
    CKEDITOR.replace('poboxleaddescription');
    CKEDITOR.replace('descriptiondatalead');
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
@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Contacts
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contacts</li>
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
            <?php if(isset($editcontact)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Edit Contacts</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/updatecontact')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editcontact->id;?>">
                     <?php $explode = explode(' ',$editcontact->name);?>
                     
              
                    <div class="form-group">
                        <label><strong>Basic Information</strong></label>
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
                    	</select>&nbsp;<input id="Contacts_editView_fieldName_firstname" type="text" name="firstname" value="<?php echo $explode[0];?>" class="form-control">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Last Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lname" value="<?php echo $explode[1];?>">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Office Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="phone" value="<?php echo $editcontact->office_phone;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Organization Name </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="oname" value="<?php echo $editcontact->organization_name;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Mobile Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mobilehone" value="<?php echo $editcontact->mobile_phone;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Lead Source</label>
                          <select class="form-control" name="lead" id="source" value="<?php echo $editcontact->lead_src;?>" onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Cold Call">Cold Call</option>
                                	<option value="Existing Customer">Existing Customer</option>
                                	<option value="Self Generated">Self Generated</option>
                                	<option value="Employee">Employee</option>
                                	<option value="Partner">Partner</option>
                                	<option value="Public Relations">Public Relations</option>
                                	<option value="Direct Mail">Direct Mail</option>
                                	<option value="Conference">Conference</option>
                                	<option value="Trade Show">Trade Show</option>
                                	<option value="Web Site">Web Site</option>
                                	<option value="Word of mouth">Word of mouth</option>
                                	<option value="Other">Other</option>
                                
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Home Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="hphone" value="<?php echo $editcontact->home_phone;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Title</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="title" value="<?php echo $editcontact->title;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secphone" value="<?php echo $editcontact->secondary_phone;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Department</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="department" value="<?php echo $editcontact->department;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Fax</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fax" value="<?php echo $editcontact->fax;?>"> 
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Email </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pemail" value="<?php echo $editcontact->primary_email;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Date of Birth </label>
                          <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="dob" value="<?php echo $editcontact->dob;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assistant</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="assitant" value="<?php echo $editcontact->assitant;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Reports To</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="reports" value="<?php echo $editcontact->reports_to;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assistant Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="assitantphone" value="<?php echo $editcontact->assitant_phone;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Email </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="secemail" value="<?php echo $editcontact->secondary_email;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Email Opt Out  </label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="emailout">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Do Not Call</label><br>
                          <input type="checkbox"  id="exampleInputUsername1" placeholder="" name="donotcall">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Reference</label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="reference">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assigned To</label>
                          <select class="form-control" name="assignedto" id="assign" value="<?php echo $editcontact->assigned_to;?>" onchange="getexternallink(this)">
                                <optgroup label="Users" data-select2-id="199">
                					<option selected="selected" value="1" data-select2-id="140">Alexa</option>
                				</optgroup>
                				<optgroup label="Groups" data-select2-id="200">
                                    <option value="3" data-select2-id="201">Marketing Group</option>
					                <option value="4" data-select2-id="202">Support Group</option>
					                <option value="5" data-select2-id="203">Team Selling</option>
                                </optgroup>	
                                
                          </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Notify Owner </label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="notifyowner">
                        </div>
                        </div>
                        <div class="row">
                            
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Customer Portal Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Portal User</label><br>
                          <input type="checkbox"  id="exampleInputUsername1" placeholder="" name="portaluser" >
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Support Start Date </label><br>
                          <input type="date"  class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editcontact->support_startdate;?>" name="supportstartdate">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Support End Date </label>
                          <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editcontact->support_enddate;?>" name="supportenddate">
                        </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label><strong>Address Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Mailing Street </label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"><?php echo $editcontact->mailing_street;?></textarea>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Other Street</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="otherdescription"><?php echo $editcontact->other_street;?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing P.O. Box </label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingbox" value="<?php echo $editcontact->mailingpobox;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other P.O. Box </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="otherbox" value="<?php echo $editcontact->otherpobox;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing City</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingcity" value="<?php echo $editcontact->mailing_city;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other City</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="othercity" value="<?php echo $editcontact->other_city;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing State</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingstate" value="<?php echo $editcontact->mailing_state;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other State</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="otherstate" value="<?php echo $editcontact->other_state;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing Zip</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingzip" value="<?php echo $editcontact->mailing_zip;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other Zip</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="otherzip" value="<?php echo $editcontact->other_zip;?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing Country</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingcountry" value="<?php echo $editcontact->mailing_country;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other Country</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="othercountry" value="<?php echo $editcontact->other_country;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondata"><?php echo $editcontact->description;?></textarea>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Profile Picture</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label>Image</label>
                              <input type="file" name="img" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                              </div>
                              <div class="" style="color: red;">Note : Existing attachments(images/files) will be replaced</div>
                            </div>
                            <input type="hidden" name="image" value="<?php echo $editcontact->image;?>">
                                <img src="{{asset('contactimg/'.$editcontact->image)}}" style="width:200px;height:200px;">
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
                  <h4 class="card-title">Add Contacts</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addcontact')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Basic Information</strong></label>
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
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lname">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Office Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="phone">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Organization Name </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="oname">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Mobile Phone  </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mobilehone">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Lead Source  </label>
                          <select class="form-control" name="lead" id="source"  onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Cold Call">Cold Call</option>
                                	<option value="Existing Customer">Existing Customer</option>
                                	<option value="Self Generated">Self Generated</option>
                                	<option value="Employee">Employee</option>
                                	<option value="Partner">Partner</option>
                                	<option value="Public Relations">Public Relations</option>
                                	<option value="Direct Mail">Direct Mail</option>
                                	<option value="Conference">Conference</option>
                                	<option value="Trade Show">Trade Show</option>
                                	<option value="Web Site">Web Site</option>
                                	<option value="Word of mouth">Word of mouth</option>
                                	<option value="Other">Other</option>
                                
                            </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Home Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="hphone">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Title</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="title">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secphone">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Department</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="department">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Fax</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fax">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Email </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pemail">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Date of Birth </label>
                          <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="dob">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assistant</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="assitant">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Reports To</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="reports">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assistant Phone</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="assitantphone">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Email </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="secemail">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Email Opt Out  </label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="emailout">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Do Not Call</label><br>
                          <input type="checkbox"  id="exampleInputUsername1" placeholder="" name="donotcall">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Reference</label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="reference">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assigned To</label>
                          <select class="form-control" name="assignedto" id="assign"  onchange="getexternallink(this)">
                                <optgroup label="Users" data-select2-id="199">
                					<option selected="selected" value="1" data-select2-id="140">Alexa</option>
                				</optgroup>
                				<optgroup label="Groups" data-select2-id="200">
                                    <option value="3" data-select2-id="201">Marketing Group</option>
					                <option value="4" data-select2-id="202">Support Group</option>
					                <option value="5" data-select2-id="203">Team Selling</option>
                                </optgroup>	
                                
                          </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Notify Owner </label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="notifyowner">
                        </div>
                        </div>
                        <div class="row">
                            
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Customer Portal Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Portal User</label><br>
                          <input type="checkbox"  id="exampleInputUsername1" placeholder="" name="portaluser">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Support Start Date </label><br>
                          <input type="date"  class="form-control" id="exampleInputUsername1" placeholder="" name="supportstartdate">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Support End Date </label>
                          <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="supportenddate">
                        </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label><strong>Address Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Mailing Street </label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Other Street</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="otherdescription"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing P.O. Box </label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingbox">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other P.O. Box </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="otherbox">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing City</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingcity">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other City</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="othercity">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing State</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingstate">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other State</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="otherstate">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing Zip</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingzip">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other Zip</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="otherzip">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Mailing Country</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mailingcountry">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Other Country</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="othercountry">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptiondata"></textarea>
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Profile Picture</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label>Image</label>
                              <input type="file" name="img" class="file-upload-default">
                              <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                </span>
                              </div>
                              <div class="" style="color: red;">Note : Existing attachments(images/files) will be replaced</div>
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
                          <th>Office phone</th>
                          <th>Organization Name</th>
                          <th>Title</th>
                          <th>Assigned To</th>
                          <th>Mailing City</th>
                          <th>Mailing Country</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($contactdata as $contactval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $contactval->name;?></td>
                          <td><?php echo $contactval->office_phone;?></td>
                          <td><?php echo $contactval->organization_name;?></td>
                          <td><?php echo $contactval->title;?></td>
                          <td><?php echo $contactval->assigned_to;?></td>
                          <td><?php echo $contactval->mailing_city;?></td>
                          <td><?php echo $contactval->mailing_country;?></td>
                          <td><a href="{{url('/contactedit/'.$contactval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/contactdelete/'.$contactval->id)}}"><i class="fa fa-trash"></i></a>
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
    CKEDITOR.replace( 'description' );
    CKEDITOR.replace('otherdescription');
    CKEDITOR.replace('descriptiondata');
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
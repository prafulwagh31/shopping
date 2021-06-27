@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Organizations
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Organizations</li>
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
            <?php if(isset($editorganization)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Creating New Organization</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/updateorganizations')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                       <input type="hidden" name="hiddenid" value="<?php echo $editorganization->id;?>">
                     
              
                    <div class="form-group">
                        <label><strong>Organization Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Organization Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="organization_name" value="<?php echo $editorganization->organization_name;?>">
                          <span style="color:red;">{{ $errors->first('organization_name') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Website</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="website" value="<?php echo $editorganization->website;?>">
                          <span style="color:red;">{{ $errors->first('website') }}</span>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="primary_phone"  value="<?php echo $editorganization->primary_phone;?>">
                          <span style="color:red;">{{ $errors->first('primary_phone') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Ticker Symbol  </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="ticker_symbol"  value="<?php echo $editorganization->ticker_symbol;?>">
                           <span style="color:red;">{{ $errors->first('ticker_symbol') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Fax</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fax" value="<?php echo $editorganization->fax;?>">
                          <span style="color:red;">{{ $errors->first('fax') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Member Of</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" value="<?php echo $editorganization->member_of;?>" name="member_of">
                          <span style="color:red;">{{ $errors->first('member_of') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secondary_phone" value="<?php echo $editorganization->secondary_phone;?>">
                          <span style="color:red;">{{ $errors->first('secondary_phone') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Employees</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="employees" value="<?php echo $editorganization->employees;?>">
                          <span style="color:red;">{{ $errors->first('employees') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Email </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="primary_email" value="<?php echo $editorganization->primary_email;?>">
                          <span style="color:red;">{{ $errors->first('primary_email') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Email</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secondary_email" value="<?php echo $editorganization->secondary_email;?>">
                          <span style="color:red;">{{ $errors->first('secondary_email') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Ownership</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="oownership" value="<?php echo $editorganization->ownership;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Industry</label>
                          <select class="form-control" name="industry" id="industries" value="<?php echo $editorganization->industry;?>"  onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Apparel">Apparel</option>
                                	<option value="Banking">Banking</option>
                                	<option value="Biotechnology">Biotechnology</option>
                                	<option value="Chemicals">Chemicals</option>
                                	<option value="Communications">Communications</option>
                                	<option value="Construction">Construction</option>
                                	<option value="Consulting">Consulting</option>
                                	<option value="Education">Education</option>
                                	<option value="Electronics">Electronics</option>
                                	<option value="Energy">Energy</option>
                                	<option value="Engineering">Engineering</option>
                                	<option value="Entertainment">Entertainment</option>
                                	<option value="Environmental">Environmental</option>
                                	<option value="Finance">Finance</option>
                                	<option value="Food &amp; Beverage">Food &amp; Beverage</option>
                                	<option value="Government">Government</option>
                                	<option value="Healthcare">Healthcare</option>
                                	<option value="Hospitality">Hospitality</option>
                                	<option value="Insurance">Insurance</option>
                                	<option value="Machinery">Machinery</option>
                                	<option value="Manufacturing">Manufacturing</option>
                                	<option value="Media">Media</option>
                                	<option value="Not For Profit">Not For Profit</option>
                                	<option value="Recreation">Recreation</option>
                                	<option value="Retail">Retail</option>
                                	<option value="Shipping">Shipping</option>
                                	<option value="Technology">Technology</option>
                                	<option value="Telecommunications">Telecommunications</option>
                                	<option value="Transportation">Transportation</option>
                                	<option value="Utilities">Utilities</option>
                                	<option value="Other">Other</option>
                                
                            </select>
                            <span style="color:red;">{{ $errors->first('industry') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Rating</label>
                          <select class="form-control" name="rating" id="rating" value="<?php echo $editorganization->rating;?>" onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Acquired">Acquired</option>
                                	<option value="Active">Active</option>
                                	<option value="Market Failed">Market Failed</option>
                                	<option value="Project Cancelled">Project Cancelled</option>
                                	<option value="Shutdown">Shutdown</option>
                                
                            </select>
                            <span style="color:red;">{{ $errors->first('rating') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Type</label>
                          <select class="form-control" name="type" id="type" value="<?php echo $editorganization->type;?>" onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Analyst">Analyst</option>
                                	<option value="Competitor">Competitor</option>
                                	<option value="Customer">Customer</option>
                                	<option value="Integrator">Integrator</option>
                                	<option value="Investor">Investor</option>
                                	<option value="Partner">Partner</option>
                                	<option value="Press">Press</option>
                                	<option value="Prospect">Prospect</option>
                                	<option value="Reseller">Reseller</option>
                                	<option value="Other">Other</option>
                                
                            </select>
                            <span style="color:red;">{{ $errors->first('type') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">SIC Code</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->sic_code;?>" name="sic_code">
                          <span style="color:red;">{{ $errors->first('sic_code') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Email Opt Out  </label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="emailout">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Annual Revenue</label><br>
                          <div class="input-group">
                        	<span class="input-group-addon">$</span>
                        	<input id="Accounts_editView_fieldName_annual_revenue" type="text" class="form-control" value="<?php echo $editorganization->annual_revenue;?>" name="annual_revenue" value="" data-rule-currency="true">
                          <span style="color:red;">{{ $errors->first('annual_revenue') }}</span>
                         </div>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assigned To</label>
                          <select class="form-control" name="assigned_to" id="assign" value="<?php echo $editorganization->assigned_to;?>" onchange="getexternallink(this)">
                                <optgroup label="Users" data-select2-id="199">
                					<option selected="selected" value="1" data-select2-id="140">Alexa</option>
                				</optgroup>
                				<optgroup label="Groups" data-select2-id="200">
                                    <option value="3" data-select2-id="201">Marketing Group</option>
					                <option value="4" data-select2-id="202">Support Group</option>
					                <option value="5" data-select2-id="203">Team Selling</option>
                                </optgroup>	
                                
                          </select>
                          <span style="color:red;">{{ $errors->first('assigned_to') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Notify Owner</label><br>
                              <input type="checkbox" id="exampleInputUsername1" placeholder="" name="notifyowner">
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label><strong>Address Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Billing Address </label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="billing_address"><?php echo $editorganization->billing_address;?></textarea>
                               <span style="color:red;">{{ $errors->first('billing_address') }}</span>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Shipping Address</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="shipping_address"><?php echo $editorganization->shipping_address;?></textarea>
                              <span style="color:red;">{{ $errors->first('shipping_address') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing PO Box </label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->billing_pobox;?>" name="billing_pobox">
                         <span style="color:red;">{{ $errors->first('billing_pobox') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping PO Box </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->shipping_pobox;?>" name="shipping_pobox">
                          <span style="color:red;">{{ $errors->first('shipping_pobox') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing City</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->billing_city;?>" name="billing_city">
                         <span style="color:red;">{{ $errors->first('billing_city') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping City</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->shipping_city;?>" name="shipping_city">
                          <span style="color:red;">{{ $errors->first('shipping_city') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing State</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->billing_state;?>" name="billing_state">
                         <span style="color:red;">{{ $errors->first('billing_state') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping State </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->shipping_state;?>" name="shipping_state">
                          <span style="color:red;">{{ $errors->first('shipping_state') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing Postal Code</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->billing_postalcode;?>" name="billing_postalcode">
                         <span style="color:red;">{{ $errors->first('billing_postalcode') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping Postal Code</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->shipping_postalcode;?>" name="shipping_postalcode">
                          <span style="color:red;">{{ $errors->first('shipping_postalcode') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing Country</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->billing_country;?>" name="billing_country">
                         <span style="color:red;">{{ $errors->first('billing_country') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping Country</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editorganization->billing_country;?>" name="shipping_country">
                          <span style="color:red;">{{ $errors->first('shipping_country') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptionorg"><?php echo $editorganization->descriptionorg;?></textarea>
                          <span style="color:red;">{{ $errors->first('descriptionorg') }}</span>
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
                  <h4 class="card-title">Creating New Organization</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addorganizations')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Organization Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Organization Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="organization_name">
                          <span style="color:red;">{{ $errors->first('organization_name') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Website</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="website">
                          <span style="color:red;">{{ $errors->first('website') }}</span>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="primary_phone">
                          <span style="color:red;">{{ $errors->first('primary_phone') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Ticker Symbol  </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="ticker_symbol">
                          <span style="color:red;">{{ $errors->first('ticker_symbol') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Fax</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fax">
                          <span style="color:red;">{{ $errors->first('fax') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Member Of</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Type to Search" name="member_of">
                          <span style="color:red;">{{ $errors->first('member_of') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Phone </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secondary_phone">
                          <span style="color:red;">{{ $errors->first('secondary_phone') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Employees</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="employees">
                          <span style="color:red;">{{ $errors->first('employees') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Primary Email </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="primary_email">
                          <span style="color:red;">{{ $errors->first('primary_email') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Secondary Email</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="secondary_email">
                          <span style="color:red;">{{ $errors->first('secondary_email') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Ownership</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="ownership">
                          <span style="color:red;">{{ $errors->first('ownership') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Industry</label>
                          <select class="form-control" name="industry" id="industries"  onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Apparel">Apparel</option>
                                	<option value="Banking">Banking</option>
                                	<option value="Biotechnology">Biotechnology</option>
                                	<option value="Chemicals">Chemicals</option>
                                	<option value="Communications">Communications</option>
                                	<option value="Construction">Construction</option>
                                	<option value="Consulting">Consulting</option>
                                	<option value="Education">Education</option>
                                	<option value="Electronics">Electronics</option>
                                	<option value="Energy">Energy</option>
                                	<option value="Engineering">Engineering</option>
                                	<option value="Entertainment">Entertainment</option>
                                	<option value="Environmental">Environmental</option>
                                	<option value="Finance">Finance</option>
                                	<option value="Food &amp; Beverage">Food &amp; Beverage</option>
                                	<option value="Government">Government</option>
                                	<option value="Healthcare">Healthcare</option>
                                	<option value="Hospitality">Hospitality</option>
                                	<option value="Insurance">Insurance</option>
                                	<option value="Machinery">Machinery</option>
                                	<option value="Manufacturing">Manufacturing</option>
                                	<option value="Media">Media</option>
                                	<option value="Not For Profit">Not For Profit</option>
                                	<option value="Recreation">Recreation</option>
                                	<option value="Retail">Retail</option>
                                	<option value="Shipping">Shipping</option>
                                	<option value="Technology">Technology</option>
                                	<option value="Telecommunications">Telecommunications</option>
                                	<option value="Transportation">Transportation</option>
                                	<option value="Utilities">Utilities</option>
                                	<option value="Other">Other</option>
                                
                            </select>
                            <span style="color:red;">{{ $errors->first('industry') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Rating</label>
                          <select class="form-control" name="rating" id="rating"  onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Acquired">Acquired</option>
                                	<option value="Active">Active</option>
                                	<option value="Market Failed">Market Failed</option>
                                	<option value="Project Cancelled">Project Cancelled</option>
                                	<option value="Shutdown">Shutdown</option>
                                
                            </select>
                            <span style="color:red;">{{ $errors->first('rating') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Type</label>
                          <select class="form-control" name="type" id="type"  onchange="getexternallink(this)">
                                	<option value="">Select an Option</option>
                                	<option value="Analyst">Analyst</option>
                                	<option value="Competitor">Competitor</option>
                                	<option value="Customer">Customer</option>
                                	<option value="Integrator">Integrator</option>
                                	<option value="Investor">Investor</option>
                                	<option value="Partner">Partner</option>
                                	<option value="Press">Press</option>
                                	<option value="Prospect">Prospect</option>
                                	<option value="Reseller">Reseller</option>
                                	<option value="Other">Other</option>
                                
                            </select>
                            <span style="color:red;">{{ $errors->first('type') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">SIC Code</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="sic_code">
                          <span style="color:red;">{{ $errors->first('sic_code') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Email Opt Out  </label><br>
                          <input type="checkbox" id="exampleInputUsername1" placeholder="" name="emailout">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Annual Revenue</label><br>
                          <div class="input-group">
                        	<span class="input-group-addon">$</span>
                        	<input id="Accounts_editView_fieldName_annual_revenue" type="text" class="form-control" name="annual_revenue" value="" data-rule-currency="true">
                          <span style="color:red;">{{ $errors->first('annual_revenue') }}</span>
                         </div>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Assigned To</label>
                          <select class="form-control" name="assigned_to" id="assign"  onchange="getexternallink(this)">
                                <optgroup label="Users" data-select2-id="199">
                					<option selected="selected" value="1" data-select2-id="140">Alexa</option>
                				</optgroup>
                				<optgroup label="Groups" data-select2-id="200">
                                    <option value="3" data-select2-id="201">Marketing Group</option>
					                <option value="4" data-select2-id="202">Support Group</option>
					                <option value="5" data-select2-id="203">Team Selling</option>
                                </optgroup>	
                                
                          </select>
                          <span style="color:red;">{{ $errors->first('assigned_to') }}</span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Notify Owner </label><br>
                              <input type="checkbox" id="exampleInputUsername1" placeholder="" name="notifyowner">
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label><strong>Address Details</strong></label>
                        <div class="row">
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Billing Address </label>
                               <textarea class="form-control" id="exampleTextarea1" rows="4" name="billing_address"></textarea>
                               <span style="color:red;">{{ $errors->first('billing_address') }}</span>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Shipping Address</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="shipping_address"></textarea>
                              <span style="color:red;">{{ $errors->first('shipping_address') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing PO Box </label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="billing_pobox">
                         <span style="color:red;">{{ $errors->first('billing_pobox') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping PO Box </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="shipping_pobox">
                          <span style="color:red;">{{ $errors->first('shipping_pobox') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing City</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="billing_city">
                         <span style="color:red;">{{ $errors->first('billing_city') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping City</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="shipping_city">
                          <span style="color:red;">{{ $errors->first('shipping_city') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing State</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="billing_state">
                         <span style="color:red;">{{ $errors->first('billing_state') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping State </label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="shipping_state">
                          <span style="color:red;">{{ $errors->first('shipping_state') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing Postal Code</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="billing_postalcode">
                         <span style="color:red;">{{ $errors->first('billing_postalcode') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping Postal Code</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="shipping_postalcode">
                          <span style="color:red;">{{ $errors->first('shipping_postalcode') }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                         <label for="exampleInputUsername1">Billing Country</label>
                         <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="billing_country">
                         <span style="color:red;">{{ $errors->first('billing_country') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Shipping Country</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="shipping_country">
                          <span style="color:red;">{{ $errors->first('shipping_country') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Description Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                        <label for="exampleInputUsername1">Description</label>
                          <textarea class="form-control" id="exampleTextarea1" rows="4" name="descriptionorg"></textarea>
                          <span style="color:red;">{{ $errors->first('descriptionorg') }}</span>
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
                          <th>Organization Name</th>
                          <th>Billing City</th>
                          <th>Website</th>
                          <th>Primary Phone</th>
                          <th>Assigned To</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($organizationdata as $organizationval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $organizationval->organization_name;?></td>
                          <td><?php echo $organizationval->billing_city;?></td>
                          <td><?php echo $organizationval->website;?></td>
                          <td><?php echo $organizationval->primary_phone;?></td>
                          <td><?php echo $organizationval->assigned_to;?></td>
                          <td><a href="{{url('/organizationedit/'.$organizationval->id)}}"><i class="fa fa-edit"></i></a>
                          <a href="{{url('/organizationdelete/'.$organizationval->id)}}"><i class="fa fa-trash"></i></a>
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
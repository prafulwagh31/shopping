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

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Add Leads
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Leads</li>
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
               <a href="{{route('importlead')}}" class="btn bbtn-primary">Import Lead</a>
            <?php if(isset($editlead)){
            
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
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Edit Lead</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/updatedatalead')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     <input type="hidden" name="hiddenid" value="<?php echo $editlead->id;?>">
              
                    <div class="form-group">
                        <label><strong>Lead Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Lead Name</label>
                          <input id="exampleInputUsername1" type="text" name="leadnamedata" value="<?php echo $editlead->leadname;?>"  class="form-control">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Alias Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="aliasname" value="<?php echo $editlead->aliasname;?>">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Prospect / Customer</label>
                          <select class="form-control " name="customerprospect" id="customerprospect">
                              <option >&nbsp;</option>
                              <option value="Prospect" <?php if($editlead->prospect_customer == 'Prospect'){echo 'selected';}?>>Prospect</option>
                              <option value="Prospect / Customer" <?php if($editlead->prospect_customer == 'Prospect / Customer'){echo 'selected';}?>>Prospect / Customer</option>
                              <option value="Customer" <?php if($editlead->prospect_customer == 'Customer'){echo 'selected';}?>>Customer</option>
                              <option value="Not prospect, nor customer" <?php if($editlead->prospect_customer == 'Not prospect, nor customer'){echo 'selected';}?>>Not prospect, nor customer</option>
                          </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Supplier</label>
                          <select class="form-control " name="supplier" id="supplier">
                              <option >&nbsp;</option>
                              <option value="Yes" <?php if($editlead->vendor == 'Yes'){echo 'selected';}?>>Yes</option>
                              <option value="No" <?php if($editlead->vendor == 'No'){echo 'selected';}?>>No</option>
                          </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Status</label>
                                  <select class="form-control " name="statusleads" id="statusleads">
                                          <option value="Closed" <?php if($editlead->status == 'Closed'){echo 'selected';}?>>Closed</option>
                                          <option value="Open" <?php if($editlead->status == 'Open'){echo 'selected';}?>>Open</option>
                                  </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Barcode</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->barcode;?>" name="barcodeleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Address</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->address;?>" name="addressleads">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Zip Code</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->zipcode;?>" name="zipcodeleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">City</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->city;?>" name="cityleads">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Country</label>
                                  <select class="form-control"  name="countryleads">
                                        <?php
                                        foreach($countriesdata as $countriesdata)
                                        {$country = DB::table('countries')->where(array('id' => $countriesdata->id))->get(); ?>
                                        <option value="<?php echo $countriesdata->id; ?>" <?php if($editlead->country == $countriesdata->id){echo 'selected';}?>><?php echo $countriesdata->name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">EMail</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->email;?>" name="emailleads">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Web</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->web;?>" name="webleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                  <label for="exampleInputUsername1">Country Code</label>
                                 <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->countrycode;?>" name="countrycode" required>
                            </div>
                            <div class="form-group col-md-4">
                                  <label for="exampleInputUsername1">Mobile</label>
                                 <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->phone;?>" name="phoneleads" required>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Fax</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->fax;?>" name="faxleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Sales tax used</label>
                                  <select class="form-control" id="saletaxleads" name="saletaxleads">
                                        <option value="Yes" <?php if($editlead->salteax == 'Yes'){echo 'selected';}?>>Yes</option>
                                        <option value="No" <?php if($editlead->salteax == 'No'){echo 'selected';}?>>No</option>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">VAT ID</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" value="<?php echo $editlead->vatid;?>" name="vatidleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Third-party type</label>
                                  <select id="typeleads" class="form-control" name="typeleads">
                                     <option >&nbsp;</option>
                                        <option value="Governmental" <?php if($editlead->thirdparty == 'Governmental'){echo 'selected';}?>>Governmental</option>
                                        <option value="Large company" <?php if($editlead->thirdparty == 'Large company'){echo 'selected';}?>>Large company</option>
                                        <option value="Medium company" <?php if($editlead->thirdparty == 'Medium company'){echo 'selected';}?>>Medium company</option>
                                        <option value="Other" <?php if($editlead->thirdparty == 'Other'){echo 'selected';}?>>Other</option>
                                        <option value="Private individual" <?php if($editlead->thirdparty == 'Private individual'){echo 'selected';}?>>Private individual</option>
                                        <option value="Small company" <?php if($editlead->thirdparty == 'Small company'){echo 'selected';}?>>Small company</option>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Employees</label><br>
                              <select id="employeeleads" class="form-control" name="employeeleads">
                                   <option value="0">&nbsp;</option>
                                    <option value="1 - 5" <?php if($editlead->employees == '1 - 5'){echo 'selected';}?>>1 - 5</option>
                                    <option value="6 - 10" <?php if($editlead->employees == '6 - 10'){echo 'selected';}?>>6 - 10</option>
                                    <option value="11 - 50" <?php if($editlead->employees == '11 - 50'){echo 'selected';}?>>11 - 50</option>
                                    <option value="51 - 100" <?php if($editlead->employees == '51 - 100'){echo 'selected';}?>>51 - 100</option>
                                    <option value="100 - 500" <?php if($editlead->employees == '100 - 500'){echo 'selected';}?>>100 - 500</option>
                                    <option value="&gt; 500" <?php if($editlead->employees == '&gt; 500'){echo 'selected';}?>>&gt; 500</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Cust./Prosp. tags/categories</label>
                                  <select class="form-control"  name="categoriesleads">
                                      <option value="0"> select</option>
                                        <?php
                                        foreach($categories as $categories)
                                        { $subcategory = DB::table('tbl_categories')->where(array('pid' => $categories->id))->get(); ?>
                                        <option value="<?php echo $categories->id; ?>" <?php if($editlead->categories == $categories->id){echo 'selected';}?>><?php echo $categories->category; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Vendors tags/categories</label><br>
                              <select id="vendorleads" class="form-control" name="vendorleads">
                                  <option value="0">&nbsp;</option>
                                    <option value="1"></option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Sales Group</label>
                                  <select class="form-control"  name="salegroupleads" required>
                                      <option value="0">Select User</option>
                                        <?php
                                        foreach($salesuser as $salesuser)
                                        {$salegroup = DB::table('tbl_salesgroup')->where(array('id' => $salesuser->id))->get(); ?>
                                        <option value="<?php echo $salesuser->id; ?>" <?php if($editlead->salesgroup == $salesuser->id){echo 'selected';}?>><?php echo $salesuser->group_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>  
                           
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Sales User</label>
                                  <select class="form-control"  name="saleuserleads" required>
                                      <option value="0">Select User</option>
                                        <?php
                                        foreach($access_users as $access_users)
                                        { $accessuser = DB::table('access_users')->where(array('id' => $access_users->id))->get(); ?> ?>
                                        <option value="<?php echo $access_users->id; ?>" <?php if($editlead->salesuser == $access_users->id){echo 'selected';}?>><?php echo $access_users->name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="row">
                             <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Campegian</label>
                                  <select class="form-control"  name="campaign">
                                      <option value="0">Select Campegian</option>
                                        <?php
                                        foreach($crm_campaign as $crm_campaign)
                                        { ?>
                                        <option value="<?php echo $crm_campaign->id; ?>"><?php echo $crm_campaign->campaign_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                        <div class="form-group col-md-6">
                              <label>Image</label>
                                  <input type="file" name="imgleads" id="image" class="file-upload-default">
                                  <div class="input-group col-xs-6">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                      <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                    <span id="imageerrs"></span>
                                  </div>
                                  <img src="{{asset('images/'.$editlead->image)}}" style="width:50px;height:50px;">
                                  
                            </div>
                            <input type="hidden" name="hiddenimage" value="<?php echo $editlead->image;?>">
                        </div>
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
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add New Leads</h4>
                  
                
                  <form class="" method="POST" action="{{ route('addnewleads')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Lead Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Lead Name</label>
                          <input id="exampleInputUsername1" type="text" name="leadnamedata"  class="form-control" required>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Alias Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="aliasname">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Prospect / Customer</label>
                          <select class="form-control " name="customerprospect" id="customerprospect">
                              <option >&nbsp;</option>
                              <option value="Prospect">Prospect</option>
                              <option value="Prospect / Customer">Prospect / Customer</option>
                              <option value="Customer">Customer</option>
                              <option value="Not prospect, nor customer">Not prospect, nor customer</option>
                          </select>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Supplier</label>
                          <select class="form-control " name="supplier" id="supplier">
                              <option >&nbsp;</option>
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                          </select>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Status</label>
                                  <select class="form-control " name="statusleads" id="statusleads">
                                          <option value="Closed">Closed</option>
                                          <option value="Open">Open</option>
                                  </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Barcode</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="barcodeleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Address</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="addressleads">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Zip Code</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="zipcodeleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">City</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="cityleads">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Country</label>
                                  <select class="form-control"  name="countryleads">
                                        <?php
                                        foreach($countriesdata as $countriesdata)
                                        { ?>
                                        <option value="<?php echo $countriesdata->id; ?>"><?php echo $countriesdata->name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">EMail</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="emailleads">
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Web</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="webleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-2">
                                  <label for="exampleInputUsername1">Country Code</label>
                                 <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="countrycode" required>
                            </div>
                            <div class="form-group col-md-4">
                                  <label for="exampleInputUsername1">Mobile</label>
                                 <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="phoneleads" required>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Fax</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="faxleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Sales tax used</label>
                                  <select class="form-control" id="saletaxleads" name="saletaxleads">
                                        <option value="1" selected="">Yes</option>
                                        <option value="0">No</option>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">VAT ID</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="vatidleads">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Third-party type</label>
                                  <select id="typeleads" class="form-control" name="typeleads">
                                     <option >&nbsp;</option>
                                        <option value="Governmental">Governmental</option>
                                        <option value="Large company">Large company</option>
                                        <option value="Medium company">Medium company</option>
                                        <option value="Other">Other</option>
                                        <option value="8">Private individual</option>
                                        <option value="Small company">Small company</option>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Employees</label><br>
                              <select id="employeeleads" class="form-control" name="employeeleads">
                                   <option value="0">&nbsp;</option>
                                    <option value="1 - 5">1 - 5</option>
                                    <option value="6 - 10">6 - 10</option>
                                    <option value="11 - 50">11 - 50</option>
                                    <option value="51 - 100">51 - 100</option>
                                    <option value="100 - 500">100 - 500</option>
                                    <option value="&gt; 500">&gt; 500</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Cust./Prosp. tags/categories</label>
                                  <select class="form-control"  name="categoriesleads">
                                      <option value="0"> select</option>
                                        <?php
                                        foreach($categories as $categories)
                                        { ?>
                                        <option value="<?php echo $categories->id; ?>"><?php echo $categories->category; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Vendors tags/categories</label><br>
                              <select id="vendorleads" class="form-control" name="vendorleads">
                                  <option value="0">&nbsp;</option>
                                    <option value="1"></option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Sales Group</label>
                                  <select class="form-control"  name="salegroupleads" required>
                                      <option value="0">Select User</option>
                                        <?php
                                        foreach($salesuser as $salesuser)
                                        { ?>
                                        <option value="<?php echo $salesuser->id; ?>"><?php echo $salesuser->group_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>  
                           
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Sales User</label>
                                  <select class="form-control"  name="saleuserleads" required>
                                      <option value="0">Select User</option>
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
                                  <label for="exampleInputUsername1">Campegian</label>
                                  <select class="form-control"  name="campaign">
                                      <option value="0">Select Campegian</option>
                                        <?php
                                        foreach($crm_campaign as $crm_campaign)
                                        { ?>
                                        <option value="<?php echo $crm_campaign->id; ?>"><?php echo $crm_campaign->campaign_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div>
                        <div class="form-group col-md-6">
                              <label>Image</label>
                                  <input type="file" name="imgleads" id="image" class="file-upload-default">
                                  <div class="input-group col-xs-6">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                    <span class="input-group-append">
                                      <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                    </span>
                                  </div>
                                  <span id="imageerrs"></span>
                            </div>
                        </div>
                    </div>
                  
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                    
                  </form>
                </div>
              </div>
            </div>
            </div>
            <?php }?>
            
           
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
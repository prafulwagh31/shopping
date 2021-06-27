@include('header')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Create Invoice
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Invoice</li>
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
                  <h4 class="card-title">Creating New Proposal</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addnewleads')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     <input type="hidden" name="hiddenid" value="<?php echo $editlead->id;?>">
              
                    <div class="form-group">
                        <label><strong>Lead Details</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Lead Name</label>
                          <input id="exampleInputUsername1" type="text" name="leadnamedata"  class="form-control">
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
                          <label for="exampleInputUsername1">Vendor</label>
                          <select class="form-control " name="vendorleads" id="vendorleads">
                              <option >&nbsp;</option>
                              <option value="1">Yes</option>
                              <option value="2">No</option>
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
                                  <select class="form-control"  name="zoneregion">
                                        <?php
                                        foreach($countriesdata as $countriesdata)
                                        { ?>
                                        <option value="<?php echo $countriesdata->id; ?>">(<?php echo $countriesdata->sortname; ?>) <?php echo $countriesdata->name; ?></option>
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
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Phone</label>
                                 <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="phoneleads">
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
                                        <option value="Yes" selected="">Yes</option>
                                        <option value="No">No</option>
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
                                        <?php
                                        foreach($categories as $categories)
                                        { ?>
                                        <option value="<?php echo $categories->id; ?>"><?php echo $categories->name; ?></option>
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
                                  <label for="exampleInputUsername1">Sales User</label>
                                  <select class="form-control"  name="saleuserleads">
                                        <?php
                                        foreach($salesuser as $salesuser)
                                        { ?>
                                        <option value="<?php echo $salesuser->id; ?>"><?php echo $salesuser->user_name; ?></option>
                                                <?php }
                                                ?>
                                </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                              <label>Image</label>
                                  <input type="file" name="imgleads" id="image" class="file-upload-default">
                                  <div class="input-group col-xs-12">
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
            <?php }else {?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Create Invoice</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addcreateinvoice')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                      <input type="hidden" name="customerid" value="{{$invoproposal->id}}">
                      <input type="hidden" name="customeridnew" value="{{$invoproposal->customer_id}}">
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Proposal Id</label>
                          <input id="exampleInputUsername1" type="text" name="proposalid"  class="form-control" value="{{$invoproposal->proposal_ref_id}}">
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Customer Name</label>
                          <input id="exampleInputUsername1" type="text" name="customername"  class="form-control"  value="{{$invoproposal->customer_name}}">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label>Type</label><br>
                          <input type="radio" id="type"  name="aliasname" value="Standard">
                          <label for="Standard">Standard invoice</label><br>
                          <input type="radio" id="type"  name="aliasname" value="Down">
                          <label for="Down">Down payment invoice</label>
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Invoice Date</label>
                          <input type="date" name="invoicedate" class="form-control">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Payment Terms</label>
                                  <select class="form-control " name="paymentterm" id="statusleads">
                                         <option >&nbsp;</option>
                                         <option value="Due Upon Receipt">Due Upon Receipt</option>
                                         <option value="30 days">30 days</option>
                                         <option value="30 days of month-end">30 days of month-end</option>
                                         <option value="60 days">60 days</option>
                                         <option value="60 days of month-end">60 days of month-end</option>
                                         <option value="Order">Order</option>
                                         <option value="Delivery">Delivery</option>
                                         <option value="50-50">50-50</option>
                                         <option value="10 days">10 days</option>
                                         <option value="10 days of month-end">10 days of month-end</option>
                                         <option value="14 days">14 days</option>
                                         <option value="14 days of month-end">14 days of month-end</option>
                                  </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Payment Type</label>
                                 <select name="paymenttype" class="form-control">
                                     <option >&nbsp;</option>
                                     <option value="Bank transfer">Bank transfer</option>
                                     <option value="Cash">Cash</option>
                                     <option value="Check">Check</option>
                                     <option value="Credit card">Credit card</option>
                                     <option value="Debit payment order">Debit payment order</option>
                                 </select>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Note (public)</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="notepublic"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Note (private)</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="noteprivate"></textarea>
                        </div>
                       </div>
                       <div class="row">
                                <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Barcode</label>
                              <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="barcodeinvoice">
                            </div>
                      </div>
                    </div>
                  
                    
                    <button type="submit" class="btn btn-gradient-primary mr-2">Save</button>
                    
                  </form>
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
    CKEDITOR.replace( 'notepublic' );
    CKEDITOR.replace('noteprivate');
</script>
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
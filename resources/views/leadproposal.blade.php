@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Add Proposal
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Proposal</li>
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
            <?php if(isset($editleadpropdata)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add New Proposal</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addleadproposal')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     <input type="hidden" name="hiddenid" value="<?php echo $editleadpropdata->id;?>"
              
                    <div class="form-group">
                      <input type="hidden" name="customerid" value="{{$listlead->id}}">
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Customer Name</label>
                          <input id="exampleInputUsername1" type="text" name="customername"  class="form-control" value="{{$listlead->leadname}}">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Address</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="aliasname" value="{{$listlead->address}} {{$listlead->city }} {{$listlead->zipcode}} ">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Date</label>
                          <input type="date" name="proposaldate" class="form-control" value="<?php echo $editleadpropdata->proposal_date;?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Validity duration</label>
                         <input type="text" name="validityduration" class="form-control" value="<?php echo $editleadpropdata->duration;?>">
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Payment Terms</label>
                                  <select class="form-control " name="paymentterm" id="statusleads" value="<?php echo $editleadpropdata->payment_term;?>">
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
                                 <select name="paymenttype" class="form-control"value="<?php echo $editleadpropdata->payment_type;?>">
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
                                  <label for="exampleInputUsername1">Source</label>
                                 <select class="form-control" name="leadsource" value="<?php echo $editleadpropdata->source;?>">
                                     <option></option>
                                     <?php foreach($leadsource as $leadsource){?>
                                     <option value="{{$leadsource->id}}">{{$leadsource->lead_source}}</option>
                                     <?php }?>
                                 </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Availability delay</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder=" 15 Days" name="delay" value="<?php echo $editleadpropdata->delay;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Shipping method</label>
                                 <select id="selectshipping_method_id" class="form-control" name="shippingmethod"value="<?php echo $editleadpropdata->shipping_method;?>"><option >&nbsp;</option><option value="Courier Service">Courier Service</option><option value="In-Store Collection">In-Store Collection</option></select>
                            </div><br><br>
                           <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Delivery date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="deliverydate" value="<?php echo $editleadpropdata->delivery_date;?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Barcode</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="barcodeproposal" value="<?php echo $editleadpropdata->barcode;?>">
                        </div>
                        <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Note</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="noteproposal"><?php echo $editleadpropdata->note;?></textarea>
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
                  <h4 class="card-title">Add New Proposal</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addleadproposal')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                      <input type="hidden" name="customerid" value="{{$listlead->id}}">
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Customer Name</label>
                          <input id="exampleInputUsername1" type="text" name="customername"  class="form-control" value="{{$listlead->leadname}}">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Address</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="aliasname" value="{{$listlead->address}} {{$listlead->city }} {{$listlead->zipcode}} ">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Date</label>
                          <input type="date" name="proposaldate" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div><br><br>
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Validity duration</label>
                         <input type="text" name="validityduration" class="form-control">
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
                                  <label for="exampleInputUsername1">Source</label>
                                 <select class="form-control" name="leadsource">
                                     <option></option>
                                     <?php foreach($leadsource as $leadsource){?>
                                     <option value="{{$leadsource->id}}">{{$leadsource->lead_source}}</option>
                                     <?php }?>
                                 </select>
                            </div><br><br>
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Availability delay</label>
                                  <input type="text" class="form-control" id="exampleInputUsername1" placeholder=" 15 Days" name="delay">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Shipping method</label>
                                 <select id="selectshipping_method_id" class="form-control" name="shippingmethod"><option >&nbsp;</option><option value="Courier Service">Courier Service</option><option value="In-Store Collection">In-Store Collection</option></select>
                            </div><br><br>
                           <div class="form-group col-md-6">
                                  <label for="exampleInputUsername1">Delivery date</label>
                                  <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="deliverydate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Barcode</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="barcodeproposal">
                        </div>
                        <div class="form-group col-md-6">
                              <label for="exampleInputUsername1">Note</label>
                              <textarea class="form-control" id="exampleTextarea1" rows="4" name="noteproposal"></textarea>
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
    CKEDITOR.replace( 'noteproposal' );
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
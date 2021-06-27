@include('header')

<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Discount Codes
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Discount Codes</li>
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
            <?php if(isset($editdiscount)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Edit Discount Code</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatediscount')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editdiscount->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1"><strong>Discount code</strong></label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="discountcode" value="<?php echo $editdiscount->discountcode;?>">
                      Customers will enter this discount code at checkout.
                      <span style="color:red;">{{ $errors->first('discountcode') }}</span>
                    </div>
                  
                    <div class="form-group" >
                      <label for="exampleInputEmail1"><strong>Types</strong></label>
                      <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="types" id="types" value="Percentage"  <?php if($editdiscount->types == 'Percentage'){?> checked="checked" <?php }?>>Percentage</label><br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="types" id="types" value="Fixed Amount"  <?php if($editdiscount->types == 'Fixed Amount'){?> checked="checked" <?php }?>>Fixed Amount</label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="types" id="types" value="Free Shipping" <?php if($editdiscount->types == 'Free Shipping'){?> checked="checked" <?php }?>>Free Shipping</label>
                        <span style="color:red;">{{ $errors->first('types') }}</span>
                    </div>
                    <div class="form-group">
                        <label><strong>Countries</strong></label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                            <input type="radio" class="form-check-input" name="countries" id="optionsRadios1" value="All Countries"  <?php if($editdiscount->countries == 'All Countries'){?> checked="checked" <?php }?>>All Countries
                            </label>
                            <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                            <input type="radio" class="form-check-input" name="countries" id="optionsRadios2" value="Selected Countries" <?php if($editdiscount->countries == 'Selected Countries'){?> checked="checked" <?php }?>>Selected Countries
                            </label>
                            <div class="col-md-4" id="country">
                            <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="countriesdata[]">
                                <?php
                                foreach($country as $country)
                                { ?>
                                    <option value="<?php echo $country->countrycode; ?>"><?php echo $country->countryname; ?></option>
                                <?php }?>
                            </select>
                            <span style="color:red;">{{ $errors->first('countries') }}</span>
                            </div>
                            <br>
                            <br>
                        <div class="form-group">
                            <h6><strong>SHIPPING RATES</strong></h6>
                            <label class="form-check-label" style="padding-left: 30px;">
                            <input type="checkbox" class="form-check-input" name="shippingrate" id="checkboxid" >Exclude shipping rates over a certain amount
                                </label>
                                <br>
                            <input type="text" class="form-control col-md-6" id="shippingrates" placeholder="₹ 0.00" name="shippingrate" value="<?php echo $editdiscount->shippingrate;?>">
                            <span style="color:red;">{{ $errors->first('shippingrate') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Minimum requirements</strong></label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="minrequire" id="require" value="None" <?php if($editdiscount->minrequire == 'None'){?> checked="checked" <?php }?>>None</label><br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="minrequire" id="purchase" value="Minimum purchase amount (₹)" <?php if($editdiscount->minrequire == 'Minimum purchase amount (₹)'){?> checked="checked" <?php }?>>Minimum purchase amount (₹)</label><br>
                        <input type="text" class="form-control col-md-4" id="requirement" placeholder="₹ 0.00" name="minrequire">
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="minrequire" id="quantity" value="Minimum quantity of items" <?php if($editdiscount->minrequire == 'Minimum quantity of items'){?> checked="checked" <?php }?>>Minimum quantity of items</label><br>
                        <input type="text" class="form-control col-md-4" id="requireitems" placeholder="" name="minrequire">
                        <span style="color:red;">{{ $errors->first('minrequire') }}</span>
                    </div>
                    <div class="form-group">
                        <label><strong>Usage limits</strong></label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="checkbox" class="form-check-input" name="limitdata" id="checkboxitem" >Limit number of times this discount can be used in total</label>
                        <input type="text" class="form-control col-md-4" id="limit" placeholder="" name="limitdata" value="<?php echo $editdiscount->limitdata;?>">
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="checkbox" class="form-check-input" name="limitdata" id="limititem">Limit to one use per customer</label>
                        <span style="color:red;">{{ $errors->first('limitdata') }}</span>
                    </div>
                    <div class="form-group">
                    <label><strong>Active dates</strong></label>
                    <div class="col-md-6">
                        <h5 class="">Start date</h5>
                        <input type="date" class="form-control" name="startdate" value="<?php echo $editdiscount->startdate;?>">
                        <span style="color:red;">{{ $errors->first('startdate') }}</span>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <h5 class="">Start time</h5>
                        <input type="time" class="form-control" >
                    </div>   
                    <br>
                    <label class="form-check-label" style="padding-left: 30px;">
                    <input type="checkbox" class="form-check-input" name="dates" id="enddate">Set end date</label>
                    <div id="enddata">
                    <div class="col-md-6">
                        <h5 class="">End date</h5>
                        <input type="date" class="form-control" name="enddate" id="endd" value="<?php echo $editdiscount->enddate;?>">
                        <span style="color:red;">{{ $errors->first('enddate') }}</span>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <h5 class="">End time</h5>
                        <input type="time" class="form-control" name="endtime" id="endd">
                    </div>
                    </div>
                    </div>   
                        
                       
                          
                          

    
                    
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="seo_title" value="<?php echo $editdiscount->seo_title;?>">
                            <span style="color:red;">{{ $errors->first('seo_title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="seodescription" rows="4" name="seo_description" value="<?php echo $editdiscount->seo_description;?>"></textarea>
                        <span style="color:red;">{{ $errors->first('seo_description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="urlhandle" placeholder="" name="urlhande">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update Discount Code</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Create Discount Code</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/adddiscount')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1"><strong>Discount code</strong></label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="discountcode">
                      Customers will enter this discount code at checkout.
                      <span style="color:red;">{{ $errors->first('discountcode') }}</span>
                    </div>
                  
                    <div class="form-group" >
                      <label for="exampleInputEmail1"><strong>Types</strong></label>
                      <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="types" id="types" value="Percentage">Percentage</label><br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="types" id="types" value="Fixed Amount">Fixed Amount</label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="types" id="types" value="Free Shipping">Free Shipping</label>
                        <span style="color:red;">{{ $errors->first('types') }}</span>
                    </div>
                    <div class="form-group">
                        <label><strong>Countries</strong></label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                            <input type="radio" class="form-check-input" name="countries" id="optionsRadios1" value="All Countries">All Countries
                            </label>
                            <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                            <input type="radio" class="form-check-input" name="countries" id="optionsRadios2" value="Selected Countries">Selected Countries
                            </label>
                            <div class="col-md-4" id="country">
                            <select class="js-example-basic-multiple" multiple="multiple" style="width:100%" name="countriesdata[]">
                                <?php
                                foreach($country as $country)
                                { ?>
                                    <option value="<?php echo $country->countrycode; ?>"><?php echo $country->countryname; ?></option>
                                <?php }
                                ?>
                            </select>
                            <span style="color:red;">{{ $errors->first('countries') }}</span>
                            </div>
                            <br>
                            <br>
                        <div class="form-group">
                            <h6><strong>SHIPPING RATES</strong></h6>
                            <label class="form-check-label" style="padding-left: 30px;">
                            <input type="checkbox" class="form-check-input" name="shippingrate" id="checkboxid">Exclude shipping rates over a certain amount
                                </label>
                                <br>
                            <input type="text" class="form-control col-md-6" id="shippingrates" placeholder="₹ 0.00" name="shippingrate">
                             <span style="color:red;">{{ $errors->first('shippingrate') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Minimum requirements</strong></label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="minrequire" id="require" value="None">None</label><br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="minrequire" id="purchase" value="Minimum purchase amount (₹)">Minimum purchase amount (₹)</label><br>
                        <input type="text" class="form-control col-md-4" id="requirement" placeholder="₹ 0.00" name="minrequire">
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="radio" class="form-check-input" name="minrequire" id="quantity" value="Minimum quantity of items">Minimum quantity of items</label><br>
                        <input type="text" class="form-control col-md-4" id="requireitems" placeholder="" name="minrequire">
                        <span style="color:red;">{{ $errors->first('minrequire') }}</span>
                    </div>
                    <div class="form-group">
                        <label><strong>Usage limits</strong></label>
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="checkbox" class="form-check-input" name="limitdata" id="checkboxitem">Limit number of times this discount can be used in total</label>
                        <input type="text" class="form-control col-md-4" id="limit" placeholder="" name="limitdata">
                        <br>
                        <label class="form-check-label" style="padding-left: 30px;">
                        <input type="checkbox" class="form-check-input" name="limitdata" id="limititem">Limit to one use per customer</label>
                        <span style="color:red;">{{ $errors->first('limitdata') }}</span>
                    </div>
                    <div class="form-group">
                    <label><strong>Active dates</strong></label>
                    <div class="col-md-6">
                        <h5 class="">Start date</h5>
                        <input type="date" class="form-control" name="startdate">
                        <span style="color:red;">{{ $errors->first('startdate') }}</span>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <h5 class="">Start time</h5>
                        <input type="time" class="form-control" >

                    </div>   
                    <br>
                    <label class="form-check-label" style="padding-left: 30px;">
                    <input type="checkbox" class="form-check-input" name="dates" id="enddate">Set end date</label>
                    <div id="enddata">
                    <div class="col-md-6">
                        <h5 class="">End date</h5>
                        <input type="date" class="form-control" name="enddate" id="endd">
                        <span style="color:red;">{{ $errors->first('enddate') }}</span>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <h5 class="">End time</h5>
                        <input type="time" class="form-control" name="endtime" id="endd">
                    </div>
                    </div>
                    </div>   
                        
                       
                          
                          

    
                    
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                            <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="seo_title">
                            <span style="color:red;">{{ $errors->first('seo_title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="seodescription" rows="4" name="seo_description"></textarea>
                        <span style="color:red;">{{ $errors->first('seo_description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="urlhandle" placeholder="" name="urlhande">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add Discount Code</button>
                    
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
                          <th>Discount</th>
                          <th>Types</th>
                          <th>Shippingrates</th>
                          <th>Usagelimits</th>
                          <th>Startdate</th>
                          <th>Enddate</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($discount as $discountval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                          
                          <td><?php echo $discountval->discountcode;?></td>
                          <td><?php echo $discountval->types;?></td>
                          <td><?php echo $discountval->shippingrate;?></td>
                          <td><?php echo $discountval->limitdata;?></td>
                          <td><?php echo $discountval->startdate;?></td>
                          <td><?php echo $discountval->enddate;?></td>
                          <td><a href="{{url('/discountedit/'.$discountval->id)}}"><i class="fa fa-edit"></i></a> 
                             <a href="{{url('/discountdelete/'.$discountval->id)}}"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                    <?php    }?>
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
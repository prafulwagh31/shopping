@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Customers
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customers</li>
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
            <?php if(isset($editcustomer)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Edit Customer</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updatecustomer')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editcustomer->id;?>">
                          <?php $explode = explode(' ',$editcustomer->name);?>
                      
                    <div class="form-group">
                        <label><strong>Customer Overview</strong></label>
                        <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">First Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fname" value="<?php echo $explode[0]?>">
                        </div><br><br>
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">Last Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lname" value="<?php echo $explode[1];?>">
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">Email</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="email" value="<?php echo $editcustomer->email	;?>">
                        </div><br><br>
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">Phone Number</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pnumber" value="<?php echo $editcustomer->mobile	;?>">
                        </div>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Address</strong></label>
                        <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">First Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="fname"  value="<?php echo $explode[0];?>">
                        </div><br><br>
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">Last Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lname"  value="<?php echo $explode[1];?>">
                        </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Company</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="companyname"  value="<?php echo $editcustomer->company;?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Address</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="companyaddress"  value="<?php echo $editcustomer->address;?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Apartment, suite, etc.</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="apartment" value="<?php echo $editcustomer->apartment;?>">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">City</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="city" value="<?php echo $editcustomer->city;?>">
                        </div>
                        <div class="row">
                        <div class="col-md-8">
                        <div class="form-group">
                        <label for="exampleInputUsername1">Country/Region</label>
                            <br>
                            <select id="countries" name="country" class="form-control">
                                <option>Country/Region</option>
                                <?php
                                foreach($country as $country)
                                { ?>
                                    <option value="<?php echo $country->countrycode; ?>" <?php if($country->countrycode == $editcustomer->country) { echo 'selected';}?>><?php echo $country->countryname; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="exampleInputUsername1">Postal Code</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pcode" value="<?php echo $editcustomer->postalcode;?>">
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Phone Number</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="pnumber" value="<?php echo $editcustomer->mobile	;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Notes</strong></label>
                        <div class="form-group">
                        <label for="exampleInputUsername1">Note</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="note" value="<?php echo $editcustomer->notes;?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Tags</strong></label>
                        <div class="form-group">
                        <label for="exampleInputUsername1">Tag</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="tag"  value="<?php echo $editcustomer->tags;?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update Customers</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add Customers</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addcustomer')}}"  enctype="multipart/form-data">
                      {{ csrf_field() }}
                     
              
                    <div class="form-group">
                        <label><strong>Customer Overview</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Full Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="name">
                          <span style="color:red;">{{ $errors->first('name') }}</span>
                        </div><br><br>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">Email</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="email">
                          <span style="color:red;">{{ $errors->first('email') }}</span>
                        </div><br><br>
                        <div class="form-group col-md-4">
                          <label for="exampleInputUsername1">Phone Number</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mobile">
                          <span style="color:red;">{{ $errors->first('mobile') }}</span>
                        </div>
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label><strong>Address</strong></label>
                        <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputUsername1">Full Name</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="name">
                          <span style="color:red;">{{ $errors->first('name') }}</span>
                        </div><br><br>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Company</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="company">
                          <span style="color:red;">{{ $errors->first('company') }}</span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Address</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="address">
                          <span style="color:red;">{{ $errors->first('address') }}</span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Apartment, suite, etc.</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="apartment">
                          <span style="color:red;">{{ $errors->first('apartment') }}</span>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">City</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="city">
                          <span style="color:red;">{{ $errors->first('city') }}</span>
                        </div>
                        <div class="row">
                        <div class="col-md-8">
                        <div class="form-group">
                        <label for="exampleInputUsername1">Country/Region</label>
                            <br>
                            <select id="countries" name="country" class="form-control">
                                <option value="">Country/Region</option>
                                <?php
                                foreach($country as $country)
                                { ?>
                                    <option value="<?php echo $country->countrycode; ?>"><?php echo $country->countryname; ?></option>
                                <?php }
                                ?>
                            </select>
                            <span style="color:red;">{{ $errors->first('country') }}</span>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                        <label for="exampleInputUsername1">Postal Code</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="postalcode">
                          <span style="color:red;">{{ $errors->first('postalcode') }}</span>
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputUsername1">Phone Number</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="mobile">
                          <span style="color:red;">{{ $errors->first('mobile') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Notes</strong></label>
                        <div class="form-group">
                        <label for="exampleInputUsername1">Note</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="notes">
                          <span style="color:red;">{{ $errors->first('notes') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><strong>Tags</strong></label>
                        <div class="form-group">
                        <label for="exampleInputUsername1">Tag</label>
                          <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="tags">
                          <span style="color:red;">{{ $errors->first('tags') }}</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add Customers</button>
                    
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
                          <th>Email</th>
                          <th>Phonenumber</th>
                          <th>Company</th>
                          <th>Address</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($customer as $customerval) {?>
                        <tr>
                          <td><?php echo $i;?></td>

                          <td><?php echo $customerval->name;?></td>
                          <td><?php echo $customerval->email;?></td>
                          <td><?php echo $customerval->mobile;?></td>
                          <td><?php echo $customerval->company;?></td>
                          <td><?php echo $customerval->address;?></td>
                          <td><a href="{{url('/customeredit/'.$customerval->id)}}"><i class="fa fa-edit"></i></a>
                              <a href="{{url('/customerdelete/'.$customerval->id)}}"><i class="fa fa-trash"></i></a>
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
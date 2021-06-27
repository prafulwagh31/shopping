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
              List Leads
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                 <li class="breadcrumb-item"><a href="{{ url('crmdashboard')}}">CRM Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Leads</li>
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
                       <button class="buttondata buttondata2"><a href="{{ url('custcategory')}}">Cust Category</a></button>
                       

                    </div>
                </div>
            <div class="col-md-9 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Data table</h4>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Lead Name</th>
                          <th>City</th>
                          <th>Phone</th>
                          <th>Prospect / Customer</th>
                          <th>Creation date</th>
                          <th>Modified date</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($addleads as $addleadsval) {?>
                        <tr>
                           <td><?php echo $i;?></td>

                           <td><a href="{{ route('leadeview',$addleadsval->id)}}"><?php echo $addleadsval->leadname;?></a></td>
                           
                           <td><?php echo $addleadsval->city;?></td>
                           <td><?php if(isset($addleadsval->countrycode)){?><a href="https://wa.me/{{$addleadsval->countrycode}}{{$addleadsval->phone}}?text=Hello%2C+I+want+to+Enquire+about+your+services" target="_blank"><?php echo $addleadsval->phone;?></a><?php }else{ echo $addleadsval->phone;}?></td>
                           <td><?php echo $addleadsval->prospect_customer;?>
                           </td>
                           <td><?php echo $addleadsval->created_at;?>
                           </td>
                            <td><?php echo $addleadsval->updated_at;?></td>
                             <td><?php if($addleadsval->accountstatus == 'activated'){?>
                            <svg height="40" width="50">
                            <circle cx="20" cy="20" r="10" stroke="green" stroke-width="3" fill="green" />
                            </svg> <?php } ?></td>
                           <td><a href="{{url('/leaddataedit/'.$addleadsval->id)}}"><i class="fa fa-edit"></i></a>
                                <a href="{{url('/leaddatadelete/'.$addleadsval->id)}}"><i class="fa fa-trash"></i></a>
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
@include('header')


<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Gift Cards
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gift Cards</li>
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
            <?php if(isset($editgiftcard)){
            
            ?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Edit  Gift Card</h4>
                  
                 
                  <form class="" method="POST" action="{{ url('/updategiftcard')}}"  enctype="multipart/form-data" id="editgiftform">
                      {{ csrf_field() }}
                      <input type="hidden" name="hiddenid" value="<?php echo $editgiftcard->id;?>">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                      <input type="text" class="form-control" id="geditname" placeholder="Name" name="title" value="<?php echo $editgiftcard->title;?>">
                      <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                     
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" ><?php echo $editgiftcard->description;?></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    
                    <div class="form-group">
                            <label for="document">Media</label>
                            <div class="needsclick dropzone" id="document-dropzone" >
                    
                            </div>
                        </div>
                    <div class="dropzoneimg"></div>
                    
                    <div class="form-group">
                        <h6><strong>Denominations</strong></h6><br>
                        
                        <div id="denomiationdata">
                            <div class="row">
                                <div class="col-md-4">
                            <input type="text" class="form-control"  name="denomiation[]" placeholder="Rs:- 0.00" value="<?php echo $editgiftcard->denomiation;?>">
                            <span style="color:red;">{{ $errors->first('denomiation') }}</span>
                            </div><div class="col-md-2">
                            <span style="padding-left: 30px;"><i class="fa fa-trash"></i></span>
                            </div> 
                           
                            </div>
                        </div>
                        <br>
                        <div class="col-md-4">
                        <button onclick = "addotheroption()" type="button" class="btn" id="btndata" value="1">Add Another Option</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                        <input type="text" class="form-control" id="gedittitle" placeholder="" name="seo_title" value="<?php echo $editgiftcard->seo_title;?>">
                        <span style="color:red;">{{ $errors->first('seo_title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="geditseodescription" rows="4" name="seo_description"><?php echo $editgiftcard->seo_description;?></textarea>
                        <span style="color:red;">{{ $errors->first('seo_description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="gediturlhandle" placeholder="" name="urlhande">
                        <span id="gediturlhandleerr"></span>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Update Gift Card</button>
                    
                  </form>
                </div>
              </div>
            </div>
            <?php }else {?>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card" style="">
                <div class="card-body">
                  <h4 class="card-title">Add New Gift Cards</h4>
                  
                
                  <form class="" method="POST" action="{{ url('/addgiftcard')}}"  enctype="multipart/form-data" id="addgiftform">
                      {{ csrf_field() }}
                     
              
                    
                    <div class="form-group">
                      <label for="exampleInputUsername1">Title</label>
                      <input type="text" class="form-control" id="gname" placeholder="Name" name="title">
                      <span style="color:red;">{{ $errors->first('title') }}</span>
                    </div>
                  
                    <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                     
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="description"></textarea>
                      <span style="color:red;">{{ $errors->first('description') }}</span>
                    </div>
                    
                    <div class="form-group">
                            <label for="document">Media</label>
                            <div class="needsclick dropzone" id="document-dropzone">
                    
                            </div>
                        </div>
                    <div class="dropzoneimg"></div>
                    
                    <div class="form-group">
                        <h6><strong>Denominations</strong></h6><br>
                        
                        <div id="denomiationdata">
                            <div class="row">
                                <div class="col-md-4">
                            <input type="text" class="form-control"  name="denomiation[]" placeholder="Rs:- 0.00">
                            <span style="color:red;">{{ $errors->first('denomiation') }}</span>
                            </div><div class="col-md-2">
                            <span style="padding-left: 30px;"><i class="fa fa-trash"></i></span>
                            </div> 
                           
                            </div>
                        </div>
                        <br>
                        <div class="col-md-4">
                        <button onclick = "addotheroption()" type="button" class="btn" id="btndata" value="1">Add Another Option</button>
                        </div>

                    </div>
                    <div class="form-group">
                        <h6><strong>SEO</strong></h6><br>
                        <label for="exampleInputUsername1">SEO Page Title</label>
                            <input type="text" class="form-control" id="gtitle" placeholder="" name="seo_title">
                            <span style="color:red;">{{ $errors->first('seo_title') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO Description</label>
                        <textarea class="form-control" id="gseodescription" rows="4" name="seo_description"></textarea>
                        <span style="color:red;">{{ $errors->first('seo_description') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">SEO URL and Handle</label>
                        <input type="text" class="form-control" id="gurlhandle" placeholder="" name="urlhande">
                        <span id="gurlhandleerr"></span>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2">Add Gift Cards</button>
                    
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
                          <th>Title</th>
                          
                          <th>Description</th>
                          <th>Denomiation</th>
                          
                          <th>Actions</th>
                        </tr>
                      </thead>
                      
                        <tbody>
                        <?php $i = 1;foreach($giftcard as $giftcardval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                          
                          <td><?php echo $giftcardval->title;?></td>
                          <td><?php echo $giftcardval->description;?></td>
                          <td><?php echo $giftcardval->denomiation;?></td>
                          
                          <td><a href="{{url('/giftcardedit/'.$giftcardval->id)}}"><i class="fa fa-edit"></i></a>
                             <a href="{{url('/giftcarddelete/'.$giftcardval->id)}}"><i class="fa fa-trash"></i></a>
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
    function gvalidate()
    {
        alert();
        var gname = $('#gname').val();
        var gtitle = $('#gtitle').val();
        var gseodescription = $('#gseodescription').val();
        var gurlhandle = $('#gurlhandle').val();
        var flag = 0;
        if(gname == '')
        {
            $('#gnameerr').html('Enter Name');
            $('#gnameerr').css('color','red');
            flag = 1;
        }else
        {
            $('#gnameerr').html();
            flag = 0;
        }
        if(gtitle == '')
        {
            $('#gtitleerr').html('Enter SEO Title');
            $('#gtitleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#gtitleerr').html();
            flag = 0;
        }
        if(gseodescription == '')
        {
            $('#gseodescriptionerr').html('Enter SEO Descritpion');
            $('#gseodescriptionerr').css('color','red');
            flag = 1;
        }else
        {
             $('#gseodescriptionerr').html();
            flag = 0;
        }
        if(gurlhandle == '')
        {
            $('#gurlhandleerr').html('Enter URL Handle');
            $('#gurlhandleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#gurlhandleerr').html();
            flag = 0;
        }
        
        
        
        if(flag == 1)
        {
            
        }else
        {
            $('#addgiftform').submit();
        }
        
    }
</script>
<script>
    function gvalidate()
    {
        alert();
        var geditname = $('#geditname').val();
        var gedittitle = $('#gedittitle').val();
        var geditseodescription = $('#geditseodescription').val();
        var gediturlhandle = $('#gediturlhandle').val();
        var flag = 0;
        if(geditname == '')
        {
            $('#geditnameerr').html('Enter Name');
            $('#geditnameerr').css('color','red');
            flag = 1;
        }else
        {
            $('#geditnameerr').html();
            flag = 0;
        }
        if(gedittitle == '')
        {
            $('#gedittitleerr').html('Enter SEO Title');
            $('#gedittitleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#gedittitleerr').html();
            flag = 0;
        }
        if(geditseodescription == '')
        {
            $('#geditseodescriptionerr').html('Enter SEO Descritpion');
            $('#geditseodescriptionerr').css('color','red');
            flag = 1;
        }else
        {
             $('#geditseodescriptionerr').html();
            flag = 0;
        }
        if(gediturlhandle == '')
        {
            $('#gediturlhandleerr').html('Enter URL Handle');
            $('#gediturlhandleerr').css('color','red');
            flag = 1;
        }else
        {
             $('#gediturlhandleerr').html();
            flag = 0;
        }
        
        
        
        if(flag == 1)
        {
            
        }else
        {
            $('#editgiftform').submit();
        }
        
    }
</script>

@include('header')

<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
<?php
$currency = DB::table('currency')->get();
?>
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Setting
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Slider Setting</li>
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
       
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card" style="height: auto;">
                <div class="card-body">
                  <h4 class="card-title">Slider Setting</h4>
                  
               
                    <form action="{{ route('addslider')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <br>
                        <div class="form-group">
                                    <label for="document">Media</label>
                                    <div class="needsclick " id="">
                                    <input type="file" name="document" >
                                    </div>
                                </div>
                            
                        <div class="form-group">
                        <label for="document">Title</label>  
                        <input type="text" class="form-control" name="slidertitle">
                        </div>
                        <div class="col-md-8">
                        <button class="btn btn-gradient-primary mr-2">Upload</button>
                        </div>
                       <!--  <a class="btn btn-warning" href="">Export Bulk Data</a> -->
                    </form>
                </div>
              </div>
            </div>
             <div class="col-md-8 grid-margin stretch-card">
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
                          <th>Image</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                     
                        
                        $i = 1;foreach($banner as $bannerval) {?>
                        <tr>
                          <td><?php echo $i;?></td>
                            <td><?php echo $bannerval->title;?></td>
                          <td><img src="{{asset('banner')}}<?php echo '/'.$bannerval->document;?>" style="width:150px;height:150px"></td>
                          
                         <td>
                          <a href="{{url('/bannerdelete/'.$bannerval->id)}}"><i class="fa fa-trash"></i></a></td>
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
@include('footer')
<script>
$(document).ready( function () {
   
    $('#brand').DataTable({
            'lengthChange' : false;
        });
} );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: "{{ route('import.storeMedianew') }}",
    maxFilesize: 1, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
       
      $('.dropzoneimg').append('<input type="hidden" name="document" value="' + response.name + '">')
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
      $('.dropzoneimg').find('input[name="document"][value="' + name + '"]').remove()
    },
    init: function () {
      @if(isset($project) && $project->document)
        var files =
          {!! json_encode($project->document) !!}
        for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          file.previewElement.classList.add('dz-complete')
          $('.dropzoneimg').append('<input type="hidden" name="document" value="' + file.file_name + '">')
        }
      @endif
    }
  }
</script>
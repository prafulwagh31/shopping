@include('header')

<style>
/*button style*/
.buttonexp {
  border: none;
  color: white;
  padding: 7px 0px;
  width: 100px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.buttonexp2 {background-color: skyblue;} 
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Import Product
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Import Product</li>
              </ol>
            </nav>
          </div>
<button class="buttonexp buttonexp2"><a href="{{ url('product')}}">Product</a></button>
	<div class="row">
            <div class="row">
               <div class="col-md-12"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
    <div class="card bg-light mt-3 col-md-12">
        <div class="card-header">
            Add  Product
        </div>
        <div class="card-body">
            <form action="{{ route('import')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file" class="form-control">
                <br>
                <div class="form-group">
                            <label for="document">Media</label>
                            <div class="needsclick dropzone" id="document-dropzone">
                    
                            </div>
                        </div>
                    <div class="dropzoneimg"></div>
                <span style='color:red'>*Accept only JPG Format Image</span>
                <div class="col-md-4">
                <button class="btn btn-gradient-primary mr-2">Import Bulk Product</button>
                </div>
               <!--  <a class="btn btn-warning" href="">Export Bulk Data</a> -->
            </form>
        </div>
    </div>
    <div class="card bg-light mt-3 col-md-12">
        <div class="card-header">
            Update  Product
        </div>
        <div class="card-body">
            <form action="{{ route('updateimport')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file" class="form-control">
                <br>
                <div class="form-group">
                            <label for="document">Media</label>
                            <div class="needsclick dropzone" id="document-dropzone">
                    
                            </div>
                        </div>
                    <div class="dropzoneimg"></div>
                <span style='color:red'>*Accept only JPG Format Image</span>
                <div class="col-md-4">
                <button class="btn btn-gradient-primary mr-2">Import Bulk Product</button>
                </div>
               <!--  <a class="btn btn-warning" href="">Export Bulk Data</a> -->
            </form>
        </div>
    </div>
    <div class="row">
    <div class="card bg-light mt-3 col-md-12">
        <div class="card-header">
             Export Product
        </div>
        <div class="card-body">
            <form action="{{ route('export')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
               
                <button class="btn btn-gradient-primary mr-2">Export Bulk Product</button>
                </div>
               <!--  <a class="btn btn-warning" href="">Export Bulk Data</a> -->
            </form>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@include('footer')
<script>
  var uploadedDocumentMap = {}
  Dropzone.options.documentDropzone = {
    url: "{{ route('import.storeMedianew') }}",
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
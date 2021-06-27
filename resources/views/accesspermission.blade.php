@include('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Access Module
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Access Module</li>
              </ol>
            </nav>
          </div>
          
            <div class="row">
               <div class="col-md-12"> 
               @if(session()->has('error_message'))
                <center><div class="alert alert-danger">{{ session('error_message') }}</div></center>
                @endif
                @if(session()->has('success_message'))
                <center><div class="alert alert-success">{{ session('success_message') }}</div></center>
                @endif</div>
            </div>
          
          <div class="row">
           <form method="POST" action="{{ route('updatepermission')}}">
               {{ csrf_field() }}
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Access Module</h4>
                 <input type="hidden" name="userid" value="{{$accessuserid}}">
                <div class="row">
                  <div class="col-12">
                    <table id="" class="table">
                        
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Title</th>
                          <th>Permission</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          $userid = $accessuserid;
                          $i = 1;foreach($accessmodule as $accessmoduleval) {
                           $access_permission = DB::table('access_permission')->where(array('user_id' => $userid,'module_id' => $accessmoduleval->id))->first();
                          ?>
                        <tr>
                          <td><?php echo $i;?></td>
                           
                          <td><?php echo $accessmoduleval->title;?></td>
                          <td><input type='checkbox' name="permission[]" value="{{$accessmoduleval->id}}" <?php if(isset($access_permission)){if($access_permission->module_id == $accessmoduleval->id){echo 'checked';}}?>></td>
                        </tr>
                        <?php $i++; }?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <input type="submit" class="btn btn-primary">
           </form>
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

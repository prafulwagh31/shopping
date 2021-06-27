@include('header')
<style>
   /*button style*/
   .buttonbdata {
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
   .buttonbdata2 {background-color: skyblue;} 
</style>
<style>
   .opt { font-weight:bold;}
   .opt1 { color: red;}
   .opt2 { color: green;padding-left:20px;}
   hr{
   height: 1px;
   background-color: #ccc;
   border: 2px solid;
   }
   .tabcontent
   {
   overflow-y: auto !important;
   }
</style>
<div class="main-panel">
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title">
         Profile
      </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-4">
         @if(session()->has('error_message'))
         <center>
            <div class="alert alert-danger">{{ session('error_message') }}</div>
         </center>
         @endif
         @if(session()->has('success_message'))
         <center>
            <div class="alert alert-success">{{ session('success_message') }}</div>
         </center>
         @endif
      </div>
   </div>
   <div class="row">
      <div class="col-md-4 grid-margin stretch-card">
         <div class="card" style="height: 500px;">
            <div class="card-body">
               <h4 class="card-title">Profile</h4>
               <form class="" method="POST" action="{{ route('updateprofile')}}"  enctype="multipart/form-data" id="editbrandform">
                  {{ csrf_field() }}
                  <input type="hidden" name="hiddenid" value="<?php echo $admindetails->id;?>">
                  <div class="form-group">
                     <label for="exampleInputUsername1">Name</label>
                     <input type="text" class="form-control" id="editname" placeholder="Name" name="name" value="<?php echo $admindetails->name;?>">
                     <span id="editnameerr"></span>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Email</label>
                     <input type="text" class="form-control" id="editname" placeholder="Email" name="email" value="<?php echo $admindetails->email;?>">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Password</label>
                     <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $admindetails->password;?>" disabled>
                  </div>
                  <input type="checkbox" id="togglePassword">Show Password
                  <button type="submit" class="btn btn-gradient-primary mr-2" >Update Profile</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@include('footer')
<script>
   const togglePassword = document.querySelector('#togglePassword');
   const password = document.querySelector('#password');
   togglePassword.addEventListener('click', function (e) {
       // toggle the type attribute
       const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
       password.setAttribute('type', type);
       // toggle the eye slash icon
       this.classList.toggle('fa-eye-slash');
   });
</script>
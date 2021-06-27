<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from usebootstrap.com/preview-no-frame/purpleadmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Aug 2020 15:35:18 GMT -->
   <head>
      <meta charset="utf-8">
      <!-- Required meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title> Home | GCC Solution</title>
      <!-- plugins:css -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="{{asset('web/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}" >
      <link rel="stylesheet" href="{{asset('web/vendors/css/vendor.bundle.base.css')}}">
      <link rel="stylesheet" href="{{asset('web/dropzone/dropzone.css')}}">
      <link rel="stylesheet" href="{{asset('web/select2/select2.min.css')}}" />
      <!--<link rel="stylesheet" href="{{asset('web/dropzone/iconfonts/mdi/css/materialdesignicons.min.css')}}">-->
      <link rel="stylesheet" href="{{asset('web/css/dropify.min.css')}}">
      <!-- endinject -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
      <!-- endinject -->
      <link rel="stylesheet" href="{{asset('web/css/project.css')}}">
      <link rel="shortcut icon" href="{{asset('web/images/favicon.png')}}" />
      <link rel="stylesheet" href="{{asset('web/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}" />
      <link rel='canonical' href='index.html' />
      <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
      <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
      <script src="{{asset('web/js/project.js')}}"></script>
      <script data-ezscrex="false" data-cfasync="false" type="text/javascript">window.google_analytics_uacct = "UA-169123501-22";</script>
      <script data-ezscrex="false" data-cfasync="false" type="text/javascript">
         var _gaq = _gaq || [];
         _gaq.push(['e._setAccount', 'UA-169123501-22']);
         _gaq.push(['f._setAccount', 'UA-38339005-1']);
         _gaq.push(['e._setDomainName', 'usebootstrap.com']);
         _gaq.push(['f._setDomainName', 'usebootstrap.com']);
         _gaq.push(['e._setCustomVar',1,'template','old_site_noads',3]);
         _gaq.push(['e._setCustomVar',2,'t','120',3]);
         _gaq.push(['e._setCustomVar',3,'rid','0',2]);
         _gaq.push(['e._setCustomVar',4,'bra','mod1',3]);
         _gaq.push(['e._setAllowAnchor',true]);
         _gaq.push(['e._setSiteSpeedSampleRate', 10]);
         _gaq.push(['f._setCustomVar',1,'template','old_site_noads',3]);
         _gaq.push(['f._setCustomVar',2,'domain','usebootstrap.com',3]);
         _gaq.push(['f._setSiteSpeedSampleRate', 20]);
         _gaq.push(['e._trackPageview']);
         _gaq.push(['f._trackPageview']);
         
         
         (function() {
          var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
          ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
         })();
      </script>
      <script type="text/javascript">var ezouid = "1";</script>
      <base >
      <script type='text/javascript'>
         var ezoTemplate = 'old_site_noads';
         if(typeof ezouid == 'undefined')
         {
             var ezouid = 'none';
         }
         var ezoFormfactor = '1';
         var ezo_elements_to_check = Array();
      </script><!-- START EZHEAD -->
      <script data-ezscrex="false" type='text/javascript'>
         var soc_app_id = '0';
         var did = 198340;
         var ezdomain = 'usebootstrap.com';
         var ezoicSearchable = 1;
      </script>
      <!--{jquery}-->
      <!-- END EZHEAD -->
      <script data-ezscrex='false' data-pagespeed-no-defer data-cfasync='false'>
         function create_ezolpl(pvID, rv) {
             var d = new Date();
             d.setTime(d.getTime() + (365*24*60*60*1000));
             var expires = "expires="+d.toUTCString();
             __ez.ck.setByCat("ezux_lpl_198340=" + new Date().getTime() + "|" + pvID + "|" + rv + "; " + expires, 3);
         }
         function attach_ezolpl(pvID, rv) {
             if (document.readyState === "complete") {
                 create_ezolpl(pvID, rv);
             }
             if(window.attachEvent) {
                 window.attachEvent("onload", create_ezolpl, pvID, rv);
             } else {
                 if(window.onload) {
                     var curronload = window.onload;
                     var newonload = function(evt) {
                         curronload(evt);
                         create_ezolpl(pvID, rv);
                     };
                     window.onload = newonload;
                 } else {
                     window.onload = create_ezolpl.bind(null, pvID, rv);
                 }
             }
         }
         
         __ez.queue.addFunc("attach_ezolpl", "attach_ezolpl", ["de6bada3-da45-4989-6e4d-a71d731d0644", "false"], false, ['/detroitchicago/boise.js'], true, false, false, false);
      </script>
   </head>
   <style>
      body {font-family: Arial, Helvetica, sans-serif;}
      /* The Modal (background) */
      .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 250px;
      top: 0;
      width: 80%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }
      /* Modal Content */
      .modal-content {
      background-color: #fefefe;
      margin: auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      }
      /* The Close Button */
      .close {
      color: #aaaaaa;
      float: left;
      font-size: 28px;
      font-weight: bold;
      padding-left: 742px;
      }
      .close:hover,
      .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
      }
      .dataTables_wrapper
      {
      overflow-y:auto !important;
      }
   </style>
   <?php
      $data = DB::table('settings')->where('id', 1)->first();
      $groupname = DB::table('tbl_salesgroup')->where('id','=',session('user_id'))->first();
      if(isset($groupname))
      {
          $events = DB::table('tbl_addnewlead')
                  ->join('tbl_events', 'tbl_addnewlead.id', '=', 'tbl_events.lead_id')
                  ->select('tbl_addnewlead.id', 'tbl_addnewlead.leadname','tbl_events.*')
                  ->where('tbl_addnewlead.salesuser','=',$groupname->id)
                  ->get();
      }
      
             
      ?>
   <body>
      <div class="container-scroller container-main-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
         <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.html">
              <?php if(isset($data->logo)){?>
               <img src="{{asset('productimg')}}<?php echo '/'.$data->logo;?>" >
               <?php }else{?>
               <img src="{{asset('productimg')}}/logo.PNG" >
               <?php }?></a>
            <a class="navbar-brand brand-logo-mini" href="index.html">
                <?php if(isset($data->logo)){?>
                 <img src="{{asset('productimg')}}<?php echo '/'.$data->logo;?>">
                 <?php }else{?>
                 <img src="{{asset('productimg')}}/logo.PNG" >
                 <?php }?>
            </a>
         </div>
         <div class="navbar-menu-wrapper d-flex align-items-stretch">
            @include('menubar')
            <div class="search-field d-none d-md-block">
               <form class="d-flex align-items-center h-100" action="#">
                  <div class="input-group">
                     <div class="input-group-prepend bg-transparent">
                        <i class="input-group-text border-0 mdi mdi-magnify"></i>                
                     </div>
                     <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                  </div>
               </form>
            </div>
            <ul class="navbar-nav navbar-nav-right">
               <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                     <div class="nav-profile-img">
                        <img src="{{asset('web/images/faces/face1.jpg')}}" alt="image">
                        <span class="availability-status online"></span>             
                     </div>
                     <div class="nav-profile-text">
                        <p class="mb-1 text-black">{{ session('name')}}</p>
                     </div>
                  </a>
                  <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                     <a class="dropdown-item" href="{{ url('adminprofile')}}">
                     <i class="mdi mdi-cached mr-2 text-success"></i>
                     Profile
                     </a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{ url('admin/signout')}}">
                     <i class="mdi mdi-logout mr-2 text-primary"></i>
                     Signout
                     </a>
                  </div>
               </li>
               <li class="nav-item d-none d-lg-block full-screen-link">
                  <a class="nav-link">
                  <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                  </a>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                  <i class="mdi mdi-email-outline"></i>
                  <span class="count-symbol bg-warning"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                     <h6 class="p-3 mb-0">Messages</h6>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                           <img src="{{asset('web/images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                           <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                           <p class="text-gray mb-0">
                              1 Minutes ago
                           </p>
                        </div>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                           <img src="{{asset('web/images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                           <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                           <p class="text-gray mb-0">
                              15 Minutes ago
                           </p>
                        </div>
                     </a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                           <img src="{{asset('web/images/faces/face1.jpg')}}" alt="image" class="profile-pic">
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                           <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                           <p class="text-gray mb-0">
                              18 Minutes ago
                           </p>
                        </div>
                     </a>
                     <div class="dropdown-divider"></div>
                     <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                  </div>
               </li>
               <li class="nav-item dropdown">
                  <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                  <i class="mdi mdi-bell-outline"></i>
                  <span class="count-symbol bg-danger"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                     <h6 class="p-3 mb-0">Notifications</h6>
                     <?php 
                        if(isset($events))
                        {
                        foreach($events as $event){
                        if($event->event_start == date('Y-m-d'))
                         { 
                         ?>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                           <div class="preview-icon bg-success">
                              <i class="mdi mdi-calendar"></i>
                           </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                           <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                           <p class="text-gray ellipsis mb-0">
                              {{$event->event_title}}
                           </p>
                        </div>
                     </a>
                     <?php }
                        else{?>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                           <div class="preview-icon bg-info">
                              <i class="mdi mdi-link-variant"></i>
                           </div>
                        </div>
                        <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                           <h6 class="preview-subject font-weight-normal mb-1">Upcoming Event</h6>
                           <p class="text-gray ellipsis mb-0">
                              {{$event->event_title}}
                           </p>
                        </div>
                     </a>
                     <?php } } }?>
                     <div class="dropdown-divider"></div>
                     <h6 class="p-3 mb-0 text-center"><a href="{{route('seeallnotify')}}">See all notifications</a></h6>
                  </div>
               </li>
               <li class="nav-item nav-logout d-none d-lg-block">
                  <a class="nav-link" href="#">
                  <i class="mdi mdi-power"></i>
                  </a>
               </li>
               <li class="nav-item nav-settings d-none d-lg-block">
                  <a class="nav-link" href="#">
                  <i class="mdi mdi-format-line-spacing"></i>
                  </a>
               </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
            </button>
         </div>
      </nav>
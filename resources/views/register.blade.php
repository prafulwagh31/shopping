<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from usebootstrap.com/preview-no-frame/purpleadmin/pages/forms/basic_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Aug 2020 15:37:52 GMT -->
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Register</title>
      <!-- plugins:css -->
      <link rel="stylesheet" href="{{asset('web/vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
      <link rel="stylesheet" href="{{asset('web/vendors/css/vendor.bundle.base.css')}}">
      <!-- endinject -->
      <!-- inject:css -->
      <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
      <!-- endinject -->
      <link rel="shortcut icon" href="{{asset('web/images/favicon.png')}}" />
      <link rel='canonical' href='basic_elements.html' />
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
      <script data-ezscrex="false" type="text/javascript" data-cfasync="false">var _ezaq = {"ad_cache_level":0,"ad_lazyload_version":0,"city":"Sonipat","country":"IN","days_since_last_visit":-1,"domain_id":198340,"engaged_time_visit":0,"ezcache_level":1,"forensiq_score":-1,"form_factor_id":1,"framework_id":1,"is_return_visitor":false,"is_sitespeed":0,"last_page_load":"","last_pageview_id":"","lt_cache_level":0,"metro_code":0,"page_ad_positions":"","page_view_count":4,"page_view_id":"c3cc4fc5-eb1b-4f25-5195-d54e4a7e1c54","position_selection_id":0,"postal_code":"131001","pv_event_count":0,"response_time_orig":716,"serverid":"3.7.68.177:29163","state":"HR","t_epoch":1597160162,"template_id":120,"time_on_site_visit":0,"url":"https://usebootstrap.com/preview-no-frame/purpleadmin/pages/forms/basic_elements.html","user_id":0,"word_count":327,"worst_bad_word_level":0};var _ezExtraQueries = "&ez_orig=1";</script><script data-ezscrex='false' data-cfasync='false' type="text/javascript" src="../../../../detroitchicago/rochester3212.js?cb=191-2&amp;v=9" async></script>
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
         
         __ez.queue.addFunc("attach_ezolpl", "attach_ezolpl", ["c3cc4fc5-eb1b-4f25-5195-d54e4a7e1c54", "false"], false, ['/detroitchicago/boise.js'], true, false, false, false);
      </script>
   </head>
   <style>
      .inputs {
      margin-top: -9em;
      }
   </style>
   <body>
      <div class="container-scroller container-main-wrapper" >
         <!-- partial:../../partials/_navbar.html -->
         <!-- partial -->
         <?php
            $data = DB::table('settings')->where('id', 1)->first();
            ?> 
         <!-- partial:../../partials/_sidebar.html -->
         <div class="row">
            <div class="col-md-12">
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
         <div class="page-header" >
            <div class="app" style="height: 600px !important;">
               <div class="bg" style="height: 622px !important;"></div>
               @if(session()->has('error_message'))
               <center>
                  <div class="alert alert-danger">{{ session('error_message') }}</div>
               </center>
               @endif
               <form class="form-wrapper" method="POST" action="{{ route('registerdata') }}" style="padding: 10px!important;">
                  {{ csrf_field() }}
                  <header>
                     <center>Register</center>
                     <?php if(isset($data->logo)){?>
                     <img src="{{asset('productimg')}}<?php echo '/'.$data->logo;?>" style="width:100px;height:100px;">
                     <?php }else{?>
                     <img src="{{asset('productimg')}}/logo.PNG" style="width:100px;height:80px;">
                     <?php }?>
                  </header>
                  <div class="inputs">
                     <input type="text" name="name" placeholder="Name">
                     <span style="color:red;">{{ $errors->first('name') }}</span>
                     <input type="text" name="mobile" placeholder="Mobile">

                     <input type="text" name="email" placeholder=" email">
                     <span style="color:red;">{{ $errors->first('email') }}</span>
                     <input type="password" name="password" placeholder="password">
                     <span style="color:red;">{{ $errors->first('password') }}</span>
                     <button style="margin-top:114px;margin-bottom: 15px;">Register</button>
                     <p>You have an account? <a href="{{ route('login') }}">Login</a></p>
                  </div>
               </form>
            </div>
         </div>
         <!-- content-wrapper ends -->
         <!-- partial:partials/_footer.html -->
         <!-- partial -->
         
         <!-- main-panel ends -->
         <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <!-- Mirrored from usebootstrap.com/preview-no-frame/purpleadmin/pages/forms/basic_elements.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Aug 2020 15:37:59 GMT -->
</html>
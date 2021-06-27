@include('header')



 <div class="main-panel">
        <div class="content-wrapper" style="width:120% !important;">
          <div class="page-header">
            <h3 class="page-title">
              Overview
            </h3>
          </div>
          <div class="row">
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder card-text">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><span></span><a href="{{ url('campaigns')}}">Campaigns</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('addleads')}}">Add Leads</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('listleads')}}">List Leads</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('leadstatus')}}">Lead Status</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('leadsource')}}">Lead Source</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('industry')}}">Lead Industry</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
             <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('salesgroup')}}">Sales Group</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('contact')}}">Contacts</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
             <div class="col-md-2 stretch-card grid-margin" style="height: 130px;">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">
                  </h4>
                  <h2 class="mb-5"><a href="{{ url('organization')}}">Organizations</a></h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
          </div>
         
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix">
                    
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>                                    
                  </div>
                  
                </div>
              </div>
            </div>
            
        </div>
        
 <footer class="footer footerlunks" style="width:120% !important;">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://gcc.solution.com/" target="_blank">GCC Solution</a>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <!--<script src="{{asset('web/vendors/js/vendor.bundle.base.js')}}"></script>-->
  <script src="{{asset('web/dropzone/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('web/vendors/js/vendor.bundle.addons.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('web/js/off-canvas.js')}}"></script>
  <script src="{{asset('web/js/misc.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('web/js/dashboard.js')}}"></script>
  <script src="{{asset('web/js/alerts.js')}}"></script>
  <script src="{{asset('web/js/sweetalert.min.js')}}"></script>

<script src="{{asset('web/select2/select2.min.js')}}"></script>
<script src="{{asset('web/js/select2.js')}}"></script>
 <script src="{{asset('web/js/dropify.min.js')}}"></script>
  <script src="{{asset('web/js/file-upload.js')}}"></script>
   <!--<script src="{{asset('web/dropzone/dropzone.js')}}"></script>-->
  
  <script src="{{asset('web/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('web/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
   <script src="{{asset('web/assets/js/data-table.js')}}"></script>
   <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
   <script>
        window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainer", {
        	animationEnabled: true,
        	theme: "light2",
        	title:{
        		text: "Leads Chart"
        	},
        	data: [{        
        		type: "line",
              	indexLabelFontSize: 16,
        		dataPoints: [
        			{ y: 450 },
        			{ y: 414},
        			{ y: 520, indexLabel: "\u2191 highest",markerColor: "red", markerType: "triangle" },
        			{ y: 460 },
        			{ y: 450 },
        			{ y: 500 },
        			{ y: 480 },
        			{ y: 480 },
        			{ y: 410 , indexLabel: "\u2193 lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
        			{ y: 500 },
        			{ y: 480 },
        			{ y: 510 }
        		]
        	}]
        });
        chart.render();
        
        }
</script>


  <!-- End custom js for this page-->
</body>


<!-- Mirrored from usebootstrap.com/preview-no-frame/purpleadmin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Aug 2020 15:36:46 GMT -->
</html>
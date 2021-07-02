@include('header')

<style>
    #calendar {
  max-width: 1100px;
  margin: 40px auto;
}

.fc-button-group
{
  display: flex !important;
}
.fc-state-disabled
{
  display: none;
}
</style>


 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Overview
            </h3>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card  card-img-holder card-text">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>
                  <h4 class="font-weight-normal mb-3">Total Category
                  </h4>
                  <h2 class="mb-5"><span></span>{{ count($category) }}</h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                  
                  <h4 class="font-weight-normal mb-3">Total Brand
                  </h4>
                  <h2 class="mb-5">{{ count($brand) }}</h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card  card-img-holder ">
                <div class="card-body">
                  <img src="{{asset('web/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image"/>                                    
                  <h4 class="font-weight-normal mb-3">Total Product
                  </h4>
                  <h2 class="mb-5">{{ count($product) }}</h2>
                  <h6 class="card-text"></h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body" style="height: 500px;margin-bottom: 20px;">
                  <div class="clearfix">
                    <h4 class="card-title float-left">Monthly Leads Count</h4>
                    <a href="{{ url('listleads')}}" style="float:right">Leads</a>
                    
                    <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
                  </div>
                  <canvas id="my-chart"  height="300" width="500"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">CRM Statictis</h4>
                  <a href="{{ url('listleads')}}" style="float:right">Leads</a>
                   <canvas id="transaction-pie-chart" width="400" height="400"></canvas>
                  
                  </div>                                                      
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-5 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Sales Statictis</h4>
                      <a href="{{ url('orderlist')}}" style="float:right">Order List</a>
                       <canvas id="sale-pie-chart" width="400" height="400"></canvas>
                      
                      </div>                                                      
                    </div>
                </div>
                <div class="col-md-7 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body" style="height: 500px;margin-bottom: 20px;">
                      <div class="clearfix">
                        <h4 class="card-title float-left">Monthly Campagian Vs Leads Count</h4>
                        <a href="{{ url('campaigns')}}" style="float:right;">Campagian List </a><br>
                        <a href="{{ url('listleads')}}" style="float:right;">Lead List</a>
                        <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>                                     
                      </div>
                      <canvas id="my-chart-list"  height="300" width="500"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Events</h4>
                     <a href="{{ url('eventlist')}}" style="float:right">Event List</a>
                    
                     <div id='calendar'></div>
                    
                    </div>                                                      
                  </div>
                </div>
            </div>
          </div>
         
            <!--<div class="col-12 grid-margin">-->
            <!--  <div class="card">-->
            <!--    <div class="card-body">-->
            <!--      <h4 class="card-title">Deals</h4>-->
            <!--      <div class="table-responsive">-->
            <!--        <table class="table">-->
            <!--          <thead>-->
            <!--            <tr>-->
            <!--              <th>-->
            <!--                ID-->
            <!--              </th>-->
            <!--              <th>-->
            <!--                Deal Name-->
            <!--              </th>-->
            <!--              <th>-->
            <!--                Portfolio-->
            <!--              </th>-->
            <!--              <th>-->
            <!--                Category-->
            <!--              </th>-->
            <!--              <th>-->
            <!--                Created on-->
            <!--              </th>-->
            <!--              <th>-->
            <!--               Status-->
            <!--              </th>-->
            <!--            </tr>-->
            <!--          </thead>-->
            <!--          <tbody>-->
            <!--            <tr>-->
            <!--              <td>-->
            <!--                10020-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                Country Inn & Suits Inc.-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                ------->
            <!--              </td>-->
            <!--              <td>-->
            <!--               <button type="button button-outline-primary">Hotel</button>-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                12-07-2018-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                <label class="badge badge-gradient-warning">PROGRESS</label>                      -->
            <!--              </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--              <td>-->
            <!--                10020-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                Country Inn & Suits Inc.-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                ------->
            <!--              </td>-->
            <!--              <td>-->
            <!--               <button type="button button-outline-primary">Hotel</button>-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                12-07-2018-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                <label class="badge badge-gradient-warning">PROGRESS</label>                      -->
            <!--              </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--              <td>-->
            <!--                10020-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                Country Inn & Suits Inc.-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                ------->
            <!--              </td>-->
            <!--              <td>-->
            <!--               <button type="button button-outline-primary">Hotel</button>-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                12-07-2018-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                <label class="badge badge-gradient-warning">PROGRESS</label>                      -->
            <!--              </td>-->
            <!--            </tr>-->
            <!--            <tr>-->
            <!--              <td>-->
            <!--                10020-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                Country Inn & Suits Inc.-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                ------->
            <!--              </td>-->
            <!--              <td>-->
            <!--               <button type="button button-outline-primary">Hotel</button>-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                12-07-2018-->
            <!--              </td>-->
            <!--              <td>-->
            <!--                <label class="badge badge-gradient-warning">PROGRESS</label>                      -->
            <!--              </td>-->
            <!--            </tr>-->
            <!--          </tbody>-->
            <!--        </table>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
         

        </div>
        @php
        $todayevent = [];
        @endphp
        @foreach($eventtoday as $eventtodaydata)
        @php
            $eventtodayarray = ['id' => $eventtodaydata->id,'title' => $eventtodaydata->event_title,'start' => $eventtodaydata->event_start,'end' => $eventtodaydata->event_end];
            array_push($todayevent,$eventtodayarray);
            
        @endphp
        @endforeach
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0-rc.1/Chart.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
        $(function() {
                var ctx = document.getElementById("my-chart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct','Nov','Dec'],
                        datasets: [{
                            label: 'Leads', // Name the series
                            data: <?php echo json_encode($leads);?>, // Specify the data values array
                            fill: false,
                            borderColor: '#2196f3', // Add custom color border (Line)
                            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },{
                            label: 'Proposals', // Name the series
                            data: <?php echo json_encode($proposalcount);?>, // Specify the data values array
                            fill: false,
                            borderColor: '#b744cc', // Add custom color border (Line)
                            backgroundColor: '#b744cc', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },{
                            label: 'Invoices', // Name the series
                            data: <?php echo json_encode($invoicecount);?>, // Specify the data values array
                            fill: false,
                            borderColor: '#ffcd56', // Add custom color border (Line)
                            backgroundColor: '#ffcd56', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        }]},
                    options: {
                      responsive: true, // Instruct chart js to respond nicely.
                      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
                    }
                });
        });
        
        $(function() {
            var ctx2 = document.getElementById("transaction-pie-chart").getContext('2d');
            var myChart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ["Leads","Proposals","Invoices"],
                datasets: [{
                backgroundColor: [
                    "#2ecc71",
                    "#e74c3c",
                    "#ff6384",
                    "#36a2eb",
                    "#ffcd56",
                    "#b744cc"
                    
                ],
                data: <?php echo json_encode($crm);?>,
                }]
            }
            });
  
        });
        
        $(function() {
            var ctx2 = document.getElementById("sale-pie-chart").getContext('2d');
            var myChart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ["Today","Monthly","Weekly"],
                datasets: [{
                backgroundColor: [
                    "#5d5dd8",
                    "#37cea5",
                    "#ce7637",
                    
                    
                ],
                data: <?php echo json_encode($orderdata);?>,
                }]
            }
            });
  
        });
            
        
        
            
        </script>
        <script>
        $(function() {
                var ctx = document.getElementById("my-chart-list").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct','Nov','Dec'],
                        datasets: [{
                            label: 'Leads', // Name the series
                            data: <?php echo json_encode($leadscampen);?>, // Specify the data values array
                            fill: false,
                            borderColor: '#b744cc', // Add custom color border (Line)
                            backgroundColor: '#b744cc', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        },{
                            label: 'Campagian', // Name the series
                            data: <?php echo json_encode($campagian);?>, // Specify the data values array
                            fill: false,
                            borderColor: '#2196f3', // Add custom color border (Line)
                            backgroundColor: '#2196f3', // Add custom color background (Points and Fill)
                            borderWidth: 1 // Specify bar border width
                        }]},
                    options: {
                      responsive: true, // Instruct chart js to respond nicely.
                      maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height 
                    }
                });
        });
        </script>
        @include('footer')
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script>
   
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month,agendaWeek,agendaDay'
    },
    events: <?php echo json_encode($eventallarray);?>,
    selectable:true,
    selectHelper:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Enter Event Title");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Added Successfully");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Event Removed");
       }
      })
     }
    },

   });
  });
   
  </script>
        

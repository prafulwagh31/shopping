@include('header')

<?php

$groupnamedata = DB::table('tbl_salesgroup')->where('id','=',session('user_id'))->first();
$eventsdata = DB::table('tbl_addnewlead')
            ->join('tbl_events', 'tbl_addnewlead.id', '=', 'tbl_events.lead_id')
            ->select('tbl_addnewlead.id', 'tbl_addnewlead.leadname','tbl_events.*')
            ->where('tbl_addnewlead.salesuser','=',$groupnamedata->id)
            ->get();
       
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
 <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              Notification
            </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('dashboard')}}">Dashboard</a></li>
                
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
           
            <div class="col-md-12 grid-margin stretch-card">
               <div class="card">
              <div class="card-body">
                <h4 class="card-title">Notification</h4>
                <input type='button' value='Delete' id='delete'><br><br>
                <div class="row">
                  <div class="col-12">
                    <table id="order-listing" class="table">
                        
                      <thead>
                        <tr>
                          
                          <th>#</th>
                          <th>Event Title</th>
                          <th>Event Startdate </th>
                          <th>Event Enddate </th>
                          <th>Event Created by</th>
                          
                          
                          
                        </tr>
                      </thead>
                      <tbody>
                          
                        <?php $i = 1;foreach($eventsdata as $eventsdatafinal){
                            
                       
                        ?>
                        <tr>
                        <td><?php echo $i;?></td>

                          <td><?php echo $eventsdatafinal->event_title;?></td>
                          <td><?php echo $eventsdatafinal->event_start;?></td>
                          <td><?php echo $eventsdatafinal->event_end;?></td>
                          <td><?php echo $eventsdatafinal->leadname;?></td>
                       
                          
                        </tr>
                        <?php $i++;}?>
                        
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
    $(document).ready(function(){

  $('#delete').click(function(){

    var post_arr = [];

    // Get checked checkboxes
    $('#order-listing input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {
        var id = this.id;
        var splitid = id.split('_');
        var postid = splitid[1];

        post_arr.push(postid);
        
      }
    });
$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    if(post_arr.length > 0){

        var isDelete = confirm("Do you really want to delete records?");
        if (isDelete == true) {
           // AJAX Request
           $.ajax({
              url: "{{ route('deletemultipleproductdata') }}",
              type: 'POST',
              data: { post_id: post_arr},
              success: function(response){
                 $.each(post_arr, function( i,l ){
                     $("#tr_"+l).remove();
                 });
              }
           });
        } 
    } 
  });
 
});
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
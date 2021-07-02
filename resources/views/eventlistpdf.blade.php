<style type="text/css">
   table, td, th {
   border: 1px solid black;
   }
   table {
   border-collapse: collapse;
   width: 100%;
   }
   .table-no-border tr td th{
   border : none;
   }
   td {
   height: 50px;
   vertical-align: middle;
   text-align: center;
   }
</style>
<h4>Event List</h4><br>
<table style="width:100%" class="table table-striped table-bordered table-hover">
   <thead>
      <tr>
        <th>#</th>
        <th>Event Title </th>
        <th>Event Start </th>
        <th>Event End </th>
       
        <th>Lead</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 1;foreach($eventlist as $eventlistdata){
            ?>
        <tr>
        
        <td>{{ $i }}</td>
        <td>{{$eventlistdata->event_title}} </td>
        <td>{{$eventlistdata->event_start}} </td>
        <td>{{$eventlistdata->event_end}}</td>
        <td>{{$eventlistdata->leadname}}</td>
        
       
        </tr>
        <?php $i++;}?>
   </tbody>
</table>
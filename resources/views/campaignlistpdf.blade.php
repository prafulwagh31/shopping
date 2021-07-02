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
<h4>Campaign List</h4><br>
<table style="width:100%" class="table table-striped table-bordered table-hover">
   <thead>
      <tr>
          <th>#</th>
          <th>Campaign Name</th>
          <th>Campaign Type</th>
          <th>Campaign Status</th>
          <th>Expected Revenue</th>
          <th>Expected Close Date</th>
      </tr>
   </thead>
   <tbody>
     <?php $i = 1;foreach($campaignsdata as $campaignsval) {?>
        <tr>
          <td><?php echo $i;?></td>

          <td><?php echo $campaignsval->campaign_name;?></td>
          <td><?php echo $campaignsval->campaign_type;?></td>
          <td><?php echo $campaignsval->campaign_status;?></td>
          <td><?php echo $campaignsval->expected_revenue;?></td>
          <td><?php echo $campaignsval->closedate;?></td>
          
          
        </tr>
        <?php $i++; }?>
   </tbody>
</table>
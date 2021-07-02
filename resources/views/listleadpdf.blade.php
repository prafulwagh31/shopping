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
<h4>Lead List</h4><br>
<table style="width:100%" class="table table-striped table-bordered table-hover">
   <thead>
      <tr>
        <th>#</th>
        <th>Lead Name</th>
        <th>City</th>
        <th>Phone</th>
        <th>Prospect / Customer</th>
        <th>Creation date</th>
        <th>Modified date</th>
        <th>Status</th>
      </tr>
   </thead>
   <tbody>
     <?php $i = 1;foreach($addleads as $addleadsval) {?>
         <tr>
         <td><?php echo $i;?></td>

         <td><?php echo $addleadsval->leadname;?></td>

         <td><?php echo $addleadsval->city;?></td>
         <td><?php if(isset($addleadsval->countrycode)){?><?php echo $addleadsval->phone;?><?php }else{ echo $addleadsval->phone;}?></td>
         <td><?php echo $addleadsval->prospect_customer;?>
         </td>
         <td><?php echo $addleadsval->created_at;?>
         </td>
          <td><?php echo $addleadsval->updated_at;?></td>
           <td><?php echo $addleadsval->accountstatus;?></td>
        

         </tr>
      <?php $i++; }?>
   </tbody>
</table>
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
<h4>Order List</h4><br>
<table style="width:100%" class="table table-striped table-bordered table-hover">
   <thead>
      <tr>
         <th>#</th>
         <th>Order Id</th>
         <th>User Name </th>
         <th>Order date </th>
         <th>Payment method</th>
         <th >Payment Status</th>
         <th >Order Status</th>
         <th >Shipping Charges</th>
         <th>Total Amount</th>
      </tr>
   </thead>
   <tbody>
      <?php $i = 1;foreach($orderlist as $orderlistdata){
         ?>
      <tr>
         <td>{{ $i }}</td>
         <td>{{$orderlistdata->order_id}} </td>
         <td>{{ $orderlistdata->firstName }} {{ $orderlistdata->lastName }}</td>
         <td>{{ $orderlistdata->orderdate }}</td>
         <td>{{ $orderlistdata->paymentmethod }}</td>
         <td>{{ $orderlistdata->paymentstatus }}</td>
         <td>{{ $orderlistdata->orderstatus }}</td>
         <td>{{ $orderlistdata->shipping_charges }}</td>
         <td>{{ $orderlistdata->total_amount }}</td>
      </tr>
      <?php $i++;}?>
   </tbody>
</table>
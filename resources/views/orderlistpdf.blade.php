<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style type="text/css">
     
  </style>
  <body>
    <table class="table table-bordered" >
    
     
     
      <tbody>
         <tr>
        <td>#</td>
        <td>Order Id </td>
        <td>User Name </td>
        <td>Order date </td>
        <td>Payment metdod</td>
        <td>Payment Status</td>
        <td>Order Status</td>
        <td>Shipping Charges</td>
        <td>Total Amount</td>
      </tr>
      <tr>
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
      </tr>
      </tbody>
    </table>
  </body>
</html>
<head>
 <title></title>
</head>

<style>
#customers {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

#customers tr:nth-child(even) {
  background-color: #dddddd;
}

label,
textarea {
    font-size: .8rem;
    letter-spacing: 1px;
     margin-left:350px;
     
}
textarea {
    padding: 10px;
    line-height: 1.5;
    border-radius: 5px;
    border: 1px solid #ccc;
    box-shadow: 1px 1px 1px #999;
    margin-left:350px;
}

label {
    display: block;
    margin-bottom: 10px;
    margin-left:350px;
    margin-top:50px;
}
.td-25{
    width: 25%;
}
.td-50{
    width: 50%;
}
.td-100{
    width: 100%;
}
.td-40{
    width: 30%;
}
.td-60{
    width: 70%;
}
</style>
<body>
<h1></h1>
    <table width="100%"  class=" customers">
      <tr>
        <td class="td-50">
            <img src="http://thadathilfarmresort.com/shoppingcatnew/public/logo.png" style="width: 200px; height: 100px">
            
    <!--<img src="{{ public_path('logo.png') }}" style="width: 200px; height: 200px">-->
  
        </td>
        <?php
        $date = date('Y-m-d',strtotime($proposallist->proposal_date));
       
        ?>
        <td class="td-50"> <h3>Commercial proposal</h3>
        <span>Ref. : <?php echo $proposallist->proposal_ref_id;?></span><br>
        <span>Proposal Date : <?php echo $proposallist->proposal_date;?></span><br>
        <span>Validity Ending Date : <?php echo date('Y-m-d', strtotime($date. ' + '.$proposallist->duration.'days')); ?></span></td>
        
     </tr>
      <!--<tr>-->
         
      <!--  <td></td>-->
      
      <!--</tr>-->
      <!--<tr>-->
       
      <!--  <td></td>-->
        
      <!--</tr>-->
    </table>
    
 <br>
<hr>
  <table width="100%" border="0">
      <tr>
        <td>From,</td>
       
        <td>To,</td>
      </tr>
      <tr>
        <td>GCC Solution</td>
        <td><?php echo $info->leadname;?></td>
      </tr>
      <tr>
        <td>Phone: 08086950999</td>
         <td>Phone: <?php echo $info->phone;?></td>
      </tr>
        <tr>
      <td>Email: rasheedkwt@gmail.com</td>
     <td>Email: <?php echo $info->email;?></td></tr>
        <tr>
      <td>Web: https://gehobenbuilders.com</td>
       <td>Address: <?php echo $info->address;?><?php echo $info->city;?>,<?php echo $info->zipcode;?></td>
    </tr>

    </table>
    <br><br>
    <hr>
    <h3>Detail</h3>
    <table  id="customers" width="100%">
          <tr>
            <td>Sr No.</td>
            <td >Description</td>
            <td >Price</td>
            <td >Tax</td>
            <td >Tax Price</td>
            <td >Qty</td>
            <td >Discount</td>
          
            <td >Total</td>
          </tr>
           <?php 
           $i =1 ;
           $sum =0;
           $tax =0;
           $finaltaxprice = 0;
           $finaltaxpricewith = 0;
           foreach($proposalitem as $proposalitemval){
               if($proposalitemval->product_type == 1)
               {
                    $product = DB::table('tbl_product')->where('id','=',$proposalitemval->product_id)->first();
                    $productname = $product->product_name;
                       $taxdata = DB::table('tbl_tax')->where('id','=',$product->tax)->first();
                       if($taxdata != '')
                       {
                       $taxtype = DB::table('tax_type')->where('id','=',$taxdata->tax_type)->first();
                       $taxtypefinal = $taxtype->taxtype;
                       }else
                       {
                           $taxtypefinal = 0;
                       }
                       $sum += $proposalitemval->total;
                       if($proposalitemval->taxtype == 'excluding')
                       {
                            $tax += $proposalitemval->tax;
                       }
                      $taxprice =$proposalitemval->totaltax - $proposalitemval->total;
                      $finaltaxprice += $taxprice;
                      $finaltaxpricewith += $proposalitemval->totaltax;
               }else
               {
                    $product = DB::table('custom_product')->where('id','=',$proposalitemval->product_id)->first();
                    $productname = $product->productname;
                       $taxdata = DB::table('tbl_tax')->where('id','=',$product->tax)->first();
                       if($taxdata != '')
                       {
                       $taxtype = DB::table('tax_type')->where('id','=',$taxdata->tax_type)->first();
                       $taxtypefinal = $taxtype->taxtype;
                       }else
                       {
                           $taxtypefinal = 0;
                       }
                       
                       $sum += $proposalitemval->total;
                       if($proposalitemval->taxtype == 'excluding')
                       {
                            $tax += $proposalitemval->tax;
                       }
                      $taxprice =$proposalitemval->totaltax - $proposalitemval->total;
                      $finaltaxprice += $taxprice;
                      $finaltaxpricewith += $proposalitemval->totaltax;
               }
          
           ?>
           <tr class="row">
               <td><?php echo $i;?></td>
                <td><?php echo  $productname; ?></td>
               
               <td><?php echo  $proposalitemval->price; ?></td>
                <td><?php echo  $proposalitemval->tax;  ?>% (<?php echo $taxtypefinal;?>)</td>
                <td><?php echo  $taxprice; ?></td>
               <td ><?php echo  $proposalitemval->qty; ?></td>
               <td ><?php echo  $proposalitemval->discount; ?>%</td>
               
               <td ><?php echo  $proposalitemval->total; ?></td>
               
           </tr>
           <?php
           $i++;
           }
           $taxpercentage = $sum * ($tax/100);
         
           $totaltax = $sum + $taxpercentage;
           
           ?>
           
    </table>
   <table width="100%" border="0">
      <tr>
        <td class="td-60"><span>Planned date of delivery : <?php echo $proposallist->delivery_date; ?></span>
        </td>
        
         <td class="td-40">
         <span style="">Total(excl. tax)</span> <span style="padding-left:23px;"><?php echo number_format($sum, 2, '.', '');;?></span> 
       
        </td>
       
       
      </tr>
      <tr>
        <td class="td-60"><span>Payment terms : <?php echo $proposallist->payment_term; ?></span></td>
        <td class="td-40">
        <?php if($proposallist->payment_term == 'Due Upon Receipt'){?>
        <span style="">Tax</span> <span style="padding-left:98px;"><?php echo number_format($finaltaxprice, 2, '.', '');?></span> 
        <?php }else{?>
        <span style="">Tax</span> <span style="padding-left:98px;"><?php echo number_format($finaltaxprice, 2, '.', '');?></span> 
        <?php }?>
         
        </td>
       
      </tr>
      <tr>
        <td class="td-60"><span>Payment type : <?php echo $proposallist->payment_type; ?></span></td>
        <td class="td-40">
         <span style="">Total(inc. tax)</span> <span style="padding-left:30px;"><?php echo number_format($finaltaxpricewith, 2, '.', '');?></span> 
        </td>
         
      </tr>
        

    </table>
     <label for="w3review">Written Acceptance & Signature</label>
     <textarea id="w3review" name="w3review" rows="4" cols="4">
        </textarea>
  


</body>
</html>
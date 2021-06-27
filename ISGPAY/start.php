
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Merchant Test Page</title>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
<style type='text/css'>
    <!--
    h1       { font-family:Arial,sans-serif; font-size:20pt; font-weight:600; margin-bottom:0.1em; color:#08185A;}
    h2       { font-family:Arial,sans-serif; font-size:14pt; font-weight:100; margin-top:0.1em; color:#08185A;}
    h2.co    { font-family:Arial,sans-serif; font-size:24pt; font-weight:100; margin-top:0.1em; margin-bottom:0.1em; color:#08185A}
    h3       { font-family:Arial,sans-serif; font-size:16pt; font-weight:100; margin-top:0.1em; margin-bottom:0.1em; color:#08185A}
    h3.co    { font-family:Arial,sans-serif; font-size:16pt; font-weight:100; margin-top:0.1em; margin-bottom:0.1em; color:#FFFFFF}
    body     { font-family:Verdana,Arial,sans-serif; font-size:10pt; background-color:#FFFFFF; color:#08185A}
    th       { font-family:Verdana,Arial,sans-serif; font-size:8pt; font-weight:bold; background-color:#E1E1E1; padding-top:0.5em; padding-bottom:0.5em;  color:#08185A}
    tr       { height:25px; }
    .shade   { height:25px; background-color:#E1E1E1 }
    .title   { height:25px; background-color:#C1C1C1 }
    td       { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A }
    td.red   { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#FF0066 }
    td.green { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#008800 }
    p        { font-family:Verdana,Arial,sans-serif; font-size:10pt; color:#FFFFFF }
    p.blue   { font-family:Verdana,Arial,sans-serif; font-size:7pt;  color:#08185A }
    p.red    { font-family:Verdana,Arial,sans-serif; font-size:7pt;  color:#FF0066 }
    p.green  { font-family:Verdana,Arial,sans-serif; font-size:7pt;  color:#008800 }
    div.bl   { font-family:Verdana,Arial,sans-serif; font-size:7pt;  color:#C1C1C1 }
    div.red  { font-family:Verdana,Arial,sans-serif; font-size:7pt;  color:#FF0066 }
    li       { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#FF0066 }
    input    { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A; background-color:#E1E1E1; font-weight:bold }
    select   { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A; background-color:#E1E1E1; font-weight:bold; }
    textarea { font-family:Verdana,Arial,sans-serif; font-size:8pt;  color:#08185A; background-color:#E1E1E1; font-weight:normal; scrollbar-arrow-color:#08185A; scrollbar-base-color:#E1E1E1 }
    >
    
</style>

<script type="text/javascript">
function showhide(payment_type) {
    if ( payment_type == "wt" || payment_type == "") {
    	  
        document.getElementById("Name").style.display = 'none';
        document.getElementById("CardNo").style.display = 'none';
        document.getElementById("CardExpiry").style.display = 'none';
        document.getElementById("CVV").style.display = 'none';

        document.getElementById("Name").style.display = 'none';  
        document.getElementById("FirstName").style.display = 'none';
        document.getElementById("LastName").style.display = 'none';

 
        document.getElementById("Address").style.display = 'none';
        document.getElementById("Street").style.display = 'none';

        document.getElementById("City").style.display = 'none';
        document.getElementById("ZIP").style.display = 'none';
        document.getElementById("State").style.display = 'none';

        document.getElementById("Address").style.display = 'none';
      
        document.getElementById("bankCodetr").style.display = 'none';
     
    }else if (payment_type == "nb"){

        document.getElementById("CardNo").style.display = 'none';
        document.getElementById("CardExpiry").style.display = 'none';
        document.getElementById("CVV").style.display = 'none';
      	 
         
        document.getElementById("Name").style.display = 'table-row';
        document.getElementById("FirstName").style.display = 'table-row';
        document.getElementById("LastName").style.display = 'table-row';

        document.getElementById("Address").style.display = 'table-row';
        document.getElementById("Street").style.display = 'table-row';

 	    document.getElementById("City").style.display = 'table-row';
        document.getElementById("ZIP").style.display = 'table-row';
        document.getElementById("State").style.display = 'table-row';

        document.getElementById("Address").style.display = 'table-row';

        document.getElementById("bankCodetr").style.display = 'table-row';

	}else {
    	document.getElementById("CardNo").style.display = 'table-row';
        document.getElementById("CardExpiry").style.display = 'table-row';
        document.getElementById("CVV").style.display = 'table-row';
		
		document.getElementById("Name").style.display = 'none';
        document.getElementById("FirstName").style.display = 'none';
        document.getElementById("LastName").style.display = 'none';

         document.getElementById("Address").style.display = 'none';
         document.getElementById("Street").style.display = 'none';

         document.getElementById("City").style.display = 'none';
         document.getElementById("ZIP").style.display = 'none';
         document.getElementById("State").style.display = 'none';
        
		document.getElementById("bankCodetr").style.display = 'none';
				 }} </script>

 <script>
window.onload = function() {
		//alert("OnloadFunction");
		
		showhide("");
	}
	</script>
    </head>
<body>


<center><h1>TEST MERCHANT</h1></center>
<!-- The "Pay Now!" button submits the form and gives control to the form 'action' parameter -->
    <form   action="ProcessState.php" method="post" accept-charset="ISO-8859-1">

<!-- get user input -->
        <table width="80%" align="center" border="0" cellpadding='0' cellspacing='0'>

		<tr>
          <td><b>Order Parameters</b></td>
        </tr>
		
       <tr class="shade">
       <td align="right"><strong><em>Merchant Txn. Ref. No: *</em></strong></td>
        <td><input class="textbox"type="text" name="TxnRefNo" id="TxnRefNo" value="" size="40" maxlength="40"/></td>
       </tr>

     <tr class="shade">
       <td align="right"><strong><em>Amount: *</em></strong></td>
        <td><input class="textbox"type="text"  name="Amount" id="Amount" value="" size="12" maxlength="40"/></td>
       </tr>
       
       <tr class="shade">
       <td align="right"><strong><em>Currency Code: *</em></strong></td>
        <td><input class="textbox"type="text"  name="Currency" id="Currency" value=""  size="40" maxlength="40"/></td>
       </tr>
       
        <tr class="shade">
       <td align="right"><strong><em>Txn Type: *</em></strong></td>
        <td><input class="textbox"type="text"  name="TxnType" id="TxnType" value="Pay" size="40" maxlength="40"/></td>
      </tr>   	 
    
  
		<tr>
          <td><b>Optional Parameters</b></td>
        </tr>
		
		      <tr class="shade">
       <td align="right"><strong><em>Order Info: </em></strong></td>
        <td><input class="textbox"type="text"  name="OrderInfo" id="OrderInfo"  size="40" maxlength="40"/></td>
        </tr>   	     	
    
        <tr class="shade">
       <td align="right"><strong><em>CardHolder Email: </em></strong></td>
        <td><input class="textbox"type="text"  name="Email" id="Email" value="" size="40" maxlength="40"/></td>
       	     
        <tr class="shade">
       <td align="right"><strong><em>CardHolder Phone: </em></strong></td>
        <td><input class="textbox"type="text"  name="Phone" id="Phone" value="" size="40" maxlength="40"/></td>
       </tr>

		
        
		<tr>
          <td><b>Payment Method</b></td>
        </tr>
		
		<tr class="shade">
       <td align="right"><strong><em>Payment Method: *</em></strong>
        <td><input type="radio" id="one" name="payOpt" value="cc"  onchange="showhide(this.value);" />
        Credit card
       <input type="radio" id="two" name="payOpt" value="dc" onchange="showhide(this.value);"/>
       Debit Card
	   <input type="radio" id="three" name="payOpt" value="nb"  onchange="showhide(this.value);"/>
       NetBanking
      <input type="radio" id="four" name="payOpt" value="wt" onchange="showhide(this.value);"/>
       Wallet 
      <input type="radio" checked="checked" id="seven"  name="payOpt" value="" onchange="showhide(this.value);" />
       3-Party </td>
       </td> </tr>
        
	   
        <td>&nbsp;</td>
		
      <td><input type="submit" name="SubButL" value="Submit"/></td>
    </tr>
	</table>
    </form>

</body>
</body>
</html>

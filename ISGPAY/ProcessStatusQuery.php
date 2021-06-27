<?php

ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// get inputs
$data = $_POST;

require_once ('/lib/Utility.php');
require_once('/lib/config.php');
$utility = new Utility();


$EncKey = ENC_KEY;
$SECURE_SECRET = SECURE_SECRET;
$gatewayURL = STATUSURL;
$data['PassCode'] = PASSCODE;
$data['BankId'] = BANKID;
$data['MerchantId'] = MERCHANTID;
$data['TerminalId'] = TERMINALID;


//Remove Unwanted POST Variable
unset($data["SubButL"]);

//------ remove null values
$data = array_filter($data);

//------- sort on keys
$value=ksort($data);

$dataToPostToPG="";

$SecureHash = $utility->generateSecurehash($data);



foreach ($data as $key => $value) 
{
     if("" == trim($value) && $value === NULL)
	 {

	 }
	 else
	{
		$dataToPostToPG=$dataToPostToPG.$key."=".urlencode($value)."&";

	}
}

$dataToPostToPG="SecureHash=".urlencode($SecureHash)."&".$dataToPostToPG;
$dataToPostToPG=substr($dataToPostToPG, 0, -1);


//Generate Secure hash on parameters

$response = "";

// Do Post to Payment Gateway

set_time_limit(0);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$gatewayURL");
curl_setopt($ch, CURLOPT_WRITEFUNCTION, 'cgets');
curl_setopt($ch, CURLOPT_BUFFERSIZE, 128);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 1000000);
curl_setopt($ch, CURLOPT_POSTFIELDS,	$dataToPostToPG);
curl_exec($ch);
$info = curl_getinfo($ch);

function cgets($ch, $string) 
{
    global $response;
	$length = strlen($string);
    $response .= $string;
    flush();
    return $length;
}
//Parse and Show response received from PG
$responseArray = parseResponse($response);
showResponse($responseArray);


//Parse Response received
function parseResponse($response)
{
	$responseArray = array();	
	if($response)	
	{
		$params = explode("&", $response);
		foreach ($params as $value) 
		{
			$responseParams = explode("=", $value);
			$responseArray[$responseParams[0]] = $responseParams[1];
		}
	}		
	return $responseArray;


}


//Show response received
function showResponse($responseArray)
{

	
?>	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head><title>Refund Response</title>
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
    -->
    
</style>

<script type="text/javascript" language="JavaScript">
    
function enableAmt(value){

	//alert('hello');
	if(value=='Capture')
		{
		//alert('in cap');
		document.getElementById("captr").style.visibility = 'visible';
		document.getElementById("reftr").style.visibility = 'hidden'; 
		}
	else if(value=='Refund')
	   {
		//alert('in ref');
		document.getElementById("reftr").style.visibility = 'visible'; 
		document.getElementById("captr").style.visibility = 'hidden';
	   }
	else
		{
		document.getElementById("reftr").style.visibility = 'visible'; 
		document.getElementById("captr").style.visibility = 'hidden';
		}
}
	       
</script>
    



</head>
<body onload="enableAmt('Refund')">

<!-- Start Branding Table -->
<table width="100%" border="2" cellpadding="2" bgcolor="#C1C1C1">
    <tr>
        <td class="shade" width="90%"><h2 class="co">&nbsp;Virtual Payment Client Example</h2></td>
        <td bgcolor="#C1C1C1" align="center"><h3 class="co"></h3></td>
    </tr>
</table>
<!-- End Branding Table -->

<center><h1>Status Response</h1></center>

<!-- The "Pay Now!" button submits the form, transferring control -->
<form action="New.php" method="post">


<!-- get user input -->
<table width="60%" align="center" border="0" cellpadding='0' cellspacing='0'>

   
    <tr>
        <td colspan="3">&nbsp;<hr width="75%">&nbsp;</td>
    </tr>
    <tr class="title">
        <td colspan="3" height="25"><p><strong>&nbsp;Basic Status Transaction Fields</strong></p></td>
    </tr>
  
    <tr class="shade">
        <td>Response Info</td>
        <td><strong><em>Merchant Txn. Ref. No</em></strong></td>
        <td><?php echo $responseArray['TxnRefNo'];	 ?>
	 </td>
    </tr>

	

	  <tr>
        <td>&nbsp;</td>
        <td><strong><em> Amount </em></strong></td>
        <td><?php  echo $responseArray['Amount']; ?>
	 </td>
    </tr> 



	 <tr class="shade">
        <td>&nbsp;</td>
        <td><strong><em>Terminal Id: </em></strong></td>
        <td><?php  echo $responseArray['TerminalId']; ?>
	 
	 </td>
    </tr>

	<tr>
        <td>Merchant Info</td>
        <td><strong><em>Merchant Id:: </em></strong></td>
        <td><?php echo $responseArray['MerchantId']; ?>
	 </td>
    </tr>




<tr class="shade">
        <td>Merchant Info</td>
        <td><strong><em>Bank Id:: </em></strong></td>
        <td><?php  echo $responseArray['BankId'];?>
	 </td>
    </tr>

	<tr>
        <td>&nbsp;</td>
        <td><strong><em>TxnType: </em></strong></td>
        <td><?php   echo $responseArray['TxnType']; ?>
	 </td>
    </tr>

	 <tr  class="shade">
		<td>&nbsp;</td>
        <td><strong><em>RetRefNo</em></strong></td>
        <td><?php  echo $responseArray['RetRefNo'];?>
	 </td>
    </tr>


 <tr>
		<td>&nbsp;</td>
        <td><strong><em>ResponseCode</em></strong></td>
        <td><?php  echo $responseArray['ResponseCode']; ?>
	 </td>
    </tr>

	 <tr class="shade">
		<td>&nbsp;</td>
        <td><strong><em>AuthCode</em></strong></td>
        <td><?php echo $responseArray['AuthCode']; ?>
	 </td>
    </tr>

	<tr>
		<td>&nbsp;</td>
        <td><strong><em>pgTxnId</em></strong></td>
        <td><?php  echo $responseArray['pgTxnId']; ?>
	 </td>
    </tr>
	
	<tr class="shade">
		<td>&nbsp;</td>
        <td><strong><em>routerID</em></strong></td>
        <td><?php  echo $responseArray['routerID']; ?>
	 </td>
    </tr>
	
	<tr>
		<td>&nbsp;</td>
        <td><strong><em>TXN_CURRENCY</em></strong></td>
        <td><?php  echo $responseArray['TXN_CURRENCY']; ?>
	 </td>
    </tr>
	
	<tr class="shade">
		<td>&nbsp;</td>
        <td><strong><em>payOpt</em></strong></td>
        <td><?php  echo $responseArray['payOpt']; ?>
	 </td>
    </tr>
	
	<tr>
		<td>&nbsp;</td>
        <td><strong><em>txnDate</em></strong></td>
        <td><?php  echo $responseArray['txnDate']; ?>
	 </td>
    </tr>
	
	<tr class="shade">
		<td>&nbsp;</td>
        <td><strong><em>Amount</em></strong></td>
        <td><?php  echo $responseArray['Amount']/100; ?>
	 </td>
    </tr>
	<tr>
		<td>&nbsp;</td>
        <td><strong><em>PassCode</em></strong></td>
        <td><?php  echo $responseArray['PassCode']; ?>
	 </td>
    </tr>
  
</table>

</form>
</body>
</html>

<?php	
}
?>

<?php

require_once ('lib/Utility.php');
require_once('lib/config.php');
$utility = new Utility();

$EncKey = ENC_KEY;
$SECURE_SECRET = SECURE_SECRET;


$EncData=trim($_POST['EncData']);
$merchantId = trim($_POST['MerchantId']);
$bankID  = trim($_POST['BankId']);
$terminalId =  trim($_POST['TerminalId']);

if($bankID=="" && $merchantId=="" && $terminalId=="" && $EncData=="" )
{
	echo "Invalid data";
	exit();
}
if(empty($bankID) && empty($merchantId) && empty($terminalId) && empty($EncData) )
{
	echo "Invalid data";
	exit();
}


$data=$utility->decrypt($EncData, $EncKey); 
$data=substr($data, 0, -2);

$dataArray=explode("::",$data);

foreach ($dataArray as $key => $value) 
{
	$valuesplit=explode("||",$value);
	$dataFromPostFromPG[$valuesplit[0]]=urldecode($valuesplit[1]);
}

// SecureHash got in reply
$SecureHash=$dataFromPostFromPG['SecureHash'];
		
//remove SecureHash from data 	
unset($dataFromPostFromPG['SecureHash']);
		
//remove null or empty data
unset($dataFromPostFromPG['']);
		
//remove null or empty data
array_filter($dataFromPostFromPG);
		
//sort data array
ksort($dataFromPostFromPG);

$txnRefNo= $utility->null2unknown("TxnRefNo",$dataFromPostFromPG);
$merchantId= $utility->null2unknown("MerchantId",$dataFromPostFromPG);
$amount= $utility->null2unknown("Amount",$dataFromPostFromPG);
$terminalId= $utility->null2unknown("TerminalId",$dataFromPostFromPG);
$responseCode= $utility->null2unknown("ResponseCode",$dataFromPostFromPG);
$message= $utility->null2unknown("Message",$dataFromPostFromPG);
$retRefNo = $utility->null2unknown("RetRefNo",$dataFromPostFromPG);
$batchNo= $utility->null2unknown("BatchNo",$dataFromPostFromPG);
$authCode= $utility->null2unknown("AuthCode",$dataFromPostFromPG);
$bankID= $utility->null2unknown("BankId",$dataFromPostFromPG);
$issuerRefNo= $utility->null2unknown("issuerRefNo",$dataFromPostFromPG);
$firstName= $utility->null2unknown("firstName",$dataFromPostFromPG);
$lastName= $utility->null2unknown("lastName",$dataFromPostFromPG);
$addressZip= $utility->null2unknown("addressZip",$dataFromPostFromPG);	
$pgTxnId= $utility->null2unknown("pgTxnId",$dataFromPostFromPG);	

$SecureHash_final = $utility->generateSecurehash($dataFromPostFromPG);

$hashValidated = 'Invalid Hash';
if( $SecureHash_final == $SecureHash )
{
	$hashValidated = 'CORRECT';
}


if($hashValidated == 'CORRECT' && $responseCode == '00')
{
	//Write your sucess transaction code for ex: Notification to customer, updating order/payment status, updating Inventory etc
	//Show success message to customer	
	echo "<h4>Your Transaction ID for Order $txnRefNo  is ".$pgTxnId .".</h4>";
    echo "<h4>We have received a payment of Rs. " . $amount/100 . ". Your order will soon be shipped.</h4>";
}
else if($hashValidated == 'CORRECT' && $responseCode == 'CAN')
{
	//Write your sucess transaction code for ex: Notification to customer, updating order/payment status, updating Inventory etc
	//Show success message to customer	
	echo "<h4>Your Transaction ID for Order $txnRefNo  is ".$pgTxnId .".</h4>";
    echo "<h4>Your order is cancelled. $message</h4>";
}
else
{
	//Write your sucess transaction code for ex: Notification to customer, updating order/payment status, updating Inventory etc
	//Show failure message to customer	
	echo "<h4>Your Transaction ID for Order $txnRefNo  is ".$pgTxnId .".</h4>";
    echo "<h4>Your payment is not processed. $message</h4>";
}

echo "<BR><h4>Complete Response from PG For reference :<h4>";
print "<pre>";
print_r($dataFromPostFromPG);

	
?>
<br>
<a href=""><button class="btn btn-primary">Back</button></a>
</a>
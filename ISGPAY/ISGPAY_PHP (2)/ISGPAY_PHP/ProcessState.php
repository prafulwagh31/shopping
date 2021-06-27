<?php

set_time_limit(0);

require_once ('C:/xampp/htdocs/kopaymentsphp/lib/Utility.php');
require_once('C:/xampp/htdocs/kopaymentsphp/lib/config.php');
$utility = new Utility();


$EncKey = ENC_KEY;
$SECURE_SECRET = SECURE_SECRET;
$gatewayURL = GATEWAYURL;


// get inputs
$data = $_POST;

$data['Version'] = VERSION;
$data['PassCode'] = PASSCODE;
$data['BankId'] = BANKID;
$data['MerchantId'] = MERCHANTID;
$data['MCC'] = MCC;
$data['TerminalId'] = TERMINALID;
$data['ReturnURL'] = RETURNURL;

//Remove Unwanted POST Variable
	unset($data["SubButL"]);
//------ remove null values
	$data = array_filter($data);
//------- sort on keys
	ksort($data);

	$dataToPostToPG="";
	foreach ($data as $key => $value) 
	{
		if("" == trim($value) && $value === NULL)
		{

		}
		else
		{
			$dataToPostToPG=$dataToPostToPG.$key."||".($value)."::";
		}
	}

//Generate Secure hash on parameters
$SecureHash = $utility->generateSecurehash($data);
//Appending hash and data with ::
$dataToPostToPG="SecureHash||".urlencode($SecureHash)."::".$dataToPostToPG;
//Removing last 2 characters (::)
$dataToPostToPG=substr($dataToPostToPG, 0, -2);

/*encrypting data with AES------START**************************************************************************/	

$EncData=$utility->encrypt($dataToPostToPG, $EncKey); 
	
/*END--encrypting data with AES ------END*************************************************************************/  

?>

<html lang="en">
	<body>
		<form  action="<?php echo $gatewayURL ?>" method="post" name="server_request" target="_top" >
			<input type="hidden" name="EncData" id="EncData" value="<?php echo  $EncData; ?>">
			<input type="hidden" name="MerchantId" id="MerchantId" value="<?php echo $data['MerchantId']; ?>" />
			<input type="hidden" name="BankId" id="BankId" value="<?php echo $data['BankId']; ?>" />
			<input type="hidden" name="TerminalId" id="TerminalId" value="<?php echo $data['TerminalId']; ?>">
			<input type="hidden" name="Version" id="Version" value="<?php echo $data['Version']; ?>">
		</form>
	</body>

	<script type="text/javascript">
		document.server_request.submit(); 
	</script>
</html>
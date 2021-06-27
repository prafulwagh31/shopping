<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>



<head><title>Virtual Payment Client Example</title>
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
</style></head>
<body>

<!-- Start Branding Table -->
<table width="100%" border="2" cellpadding="2" bgcolor="#C1C1C1">
    <tr>
        <td class="shade" width="90%"><h2 class="co">&nbsp;Virtual Payment Client Example</h2></td>
        <td bgcolor="#C1C1C1" align="center"><h3 class="co">MiGS</h3></td>
    </tr>
</table>
<!-- End Branding Table -->

<center><h1>StatusQueryAPI</h1></center>

<!-- The "Pay Now!" button submits the form, transferring control -->
<form action="./ProcessStatusQuery.php" method="post">


<!-- get user input -->
<table width="80%" align="center" border="0" cellpadding='0' cellspacing='0'>

   
    <tr>
        <td colspan="3">&nbsp;<hr width="75%">&nbsp;</td>
    </tr>
    <tr class="title">
        <td colspan="3" height="25"><p><strong>&nbsp;Status Query Fields</strong></p></td>
    </tr>
  
    <tr class="shade">
        <td>Transaction Info</td>
        <td align="right"><strong><em>Merchant Txn. Ref. No </em></strong></td>
        <td><input type="text" name="TxnRefNo" value="" size="40" maxlength="40"/></td>
    </tr>

    <hr>
   
    <tr>
        <td>&nbsp;</td>
        <td align="right"><strong><em>Txn Type: </em></strong></td>
        <td><input type="text" name="TxnType" value="Status" size="40" maxlength="40" value="Status"/></td>
    </tr>
    
   
    
    <tr>    
        <td colspan="2">&nbsp;</td> 
        <td><input type="submit" name="SubButL" value="submit"/></td>
    </tr>
    
    
   

</table>

</form>
</body>
</html>

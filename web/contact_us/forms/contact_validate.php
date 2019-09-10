<?php

// Turn off all error reporting
error_reporting(0);

$Geo_Location_Continent__c = $_POST["Geo_Location_Continent__c"];
$Geo_Location__c = $_POST["Geo_Location__c"];
$Type_of_Inquiry__c = $_POST["Type_of_Inquiry__c"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$company = $_POST["company"];
$city = $_POST["city"];
$zip = $_POST["zip"];
$state = $_POST["state"];
$country = $_POST["country"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$Design_Reg_Product_1__c = $_POST["Design_Reg_Product_1__c"];
$Customer_Comments__c = $_POST["Customer_Comments__c"];
$mailing_list__c = $_POST["mailing_list__c"];
$Product_Line_Interest__c = $_POST["Product_Line_Interest__c"];
$Lead_Source_Identifier__c = $_POST["Lead_Source_Identifier__c"];

$apps = $_POST["apps"];

$image = $_POST["image"];
$signin = $_POST["signin"];

$password = "$image$signin";

 ?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Submit Comments</title>







<SCRIPT LANGUAGE="JavaScript"><!--
setTimeout('document.web_lead_form.submit()',1000);
//--></SCRIPT>



</head>

<body>







<?php if ( 

$password != "image/image1.bmpzmb4hh" & 
$password != "image/image2.bmpnvcaeu" &
$password != "image/image3.bmpdnyr3p" &
$password != "image/image4.bmp9wvkha" &
$password != "image/image5.bmpvp6lwp" &
$password != "image/image6.bmpamtvyn" &
$password != "image/image7.bmpaabhyd" &
$password != "image/image8.bmpvgmm8b" &
$password != "image/image9.bmpkwhlsp" &
$password != "image/image10.bmpwkcvef" &

$password != "image/image1.bmpZMb4HH" & 
$password != "image/image2.bmpnVCaeU" &
$password != "image/image3.bmpDNYr3p" &
$password != "image/image4.bmp9wvkhA" &
$password != "image/image5.bmpvP6Lwp" &
$password != "image/image6.bmpAmtVyN" &
$password != "image/image7.bmpaAbhyD" &
$password != "image/image8.bmpvgMM8B" &
$password != "image/image9.bmpkwHlsp" &
$password != "image/image10.bmpWKCVEf"
){ ?>

<center>
<p><br><p><br><p><br><p class="style5">The text you entered was incorrect!<p class="style5">Click on the Back button to try again.</p></font>
</center>		

	<?php } else { ?>




<div id="apDiv3" class="body">



<center><table cellpadding="0" cellspacing="0" border="0" width="500">
	
<tr><td align="center" height="120"><img src="please_wait.gif" height=50%>
<p><font face="arial">Please Wait</font>
	
</td></tr>






<form name="web_lead_form" id="web_lead_form" action="https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8" method="POST">


<input type=hidden name="oid" value="00D300000000ZfZ">

<?php if ( $Lead_Source_Identifier__c != "Murata Power" ) { ?>
  <?php } else { ?>
  <input type=hidden name="retURL" value="http://power.murata.com/contact/forms/thankyou.php">
<?php }  ?>

<?php if ( $Lead_Source_Identifier__c != "Murata Wireless" ) { ?>
  <?php } else { ?>
  <input type=hidden name="retURL" value="http://wireless.murata.com/contact/forms/thankyou.php">
<?php }  ?>

<?php if ( $Lead_Source_Identifier__c != "Murata MPS" ) { ?>
  <?php } else { ?>
  <input type=hidden name="retURL" value="http://www.murata-ps.com/contact_us/forms/thankyou.php">
<?php }  ?>



<input type=hidden name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="<?php echo $Type_of_Inquiry__c; ?>">
<input type=hidden name="first_name" id="first_name" value="<?php echo $first_name; ?>">
<input type=hidden name="last_name" id="last_name" value="<?php echo $last_name; ?>">
<input type=hidden name="company" id="company" value="<?php echo $company; ?>">
<input type=hidden name="city" id="city" value="<?php echo $city; ?>">
<input type=hidden name="zip" id="zip" value="<?php echo $zip; ?>">
<input type=hidden name="state" id="state" value="<?php echo $state; ?>">
<input type=hidden name="country" id="country" value="<?php echo $country; ?>">
<input type=hidden name="phone" id="phone" value="<?php echo $phone; ?>">
<input type=hidden name="email" id="email" value="<?php echo $email; ?>">
<input type=hidden name="Design_Reg_Product_1__c" id="Design_Reg_Product_1__c" value="<?php echo $Design_Reg_Product_1__c; ?>">
<input type=hidden name="Product_Line_Interest__c" id="Product_Line_Interest__c" value="<?php echo $Product_Line_Interest__c; ?>">
<input type=hidden name="Customer_Comments__c" id="Customer_Comments__c" value="<?php echo $Customer_Comments__c; ?>">
<input type=hidden name="mailing_list__c" id="mailing_list__c" value="<?php echo $mailing_list__c; ?>">

<input type="hidden" name="lead_source" id="lead_source" value="Web Direct">
<input type="hidden" name="Lead_Source_Identifier__c" id="Lead_Source_Identifier__c" value="<?php echo $Lead_Source_Identifier__c; ?>">
<input type="hidden" name="apps" id="apps" value="<?php echo $apps; ?>">

<input type=hidden name="Geo_Location__c" id="Geo_Location__c" value="<?php echo $Geo_Location__c; ?>">

<input type=hidden name="Geo_Location_Continent__c" id="Geo_Location_Continent__c" value="<?php echo $Geo_Location_Continent__c; ?>">

<input type="hidden" name="recordType" id="recordType" title="Lead Record Type" value="01280000000Q5CY">



</form>


</table>

</div>


	<?php }  ?>







</body>
</html>

<?php  ?>
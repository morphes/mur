<?php


// Turn off all error reporting
error_reporting(0);



$full_name = $_POST["full_name"];
$title = $_POST["title"];
$email = $_POST["email"];
$telephone = $_POST["telephone"];
$company_name = $_POST["company_name"];
$postal_address = $_POST["postal_address"];
$website = $_POST["website"];
$murata_product_number = $_POST["murata_product_number"];
$evk_reg_code = $_POST["evk_reg_code"];
$platform = $_POST["platform"];
$support = $_POST["support"];
$annual_quantity = $_POST["annual_quantity"];
$end_use = $_POST["end_use"];
$others_involved = $_POST["others_involved"];
$assembly_location = $_POST["assembly_location"];
$civilian = $_POST["civilian"];
$laws = $_POST["laws"];


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

$password != "../forms/image/image1.bmpzmb4hh" & 
$password != "../forms/image/image2.bmpnvcaeu" &
$password != "../forms/image/image3.bmpdnyr3p" &
$password != "../forms/image/image4.bmp9wvkha" &
$password != "../forms/image/image5.bmpvp6lwp" &
$password != "../forms/image/image6.bmpamtvyn" &
$password != "../forms/image/image7.bmpaabhyd" &
$password != "../forms/image/image8.bmpvgmm8b" &
$password != "../forms/image/image9.bmpkwhlsp" &
$password != "../forms/image/image10.bmpwkcvef" &

$password != "../forms/image/image1.bmpZMb4HH" & 
$password != "../forms/image/image2.bmpnVCaeU" &
$password != "../forms/image/image3.bmpDNYr3p" &
$password != "../forms/image/image4.bmp9wvkhA" &
$password != "../forms/image/image5.bmpvP6Lwp" &
$password != "../forms/image/image6.bmpAmtVyN" &
$password != "../forms/image/image7.bmpaAbhyD" &
$password != "../forms/image/image8.bmpvgMM8B" &
$password != "../forms/image/image9.bmpkwHlsp" &
$password != "../forms/image/image10.bmpWKCVEf"
){ ?>

<center>
<p><br><p><br><p><br><p class="style5">The text you entered was incorrect!<p class="style5">Click on the Back button to try again.</p></font>
</center>		

	<?php } else { ?>




<div id="apDiv3" class="body">



<center><table cellpadding="0" cellspacing="0" border="0" width="500">
	
<tr><td align="center" height="120">&nbsp;
	
</td></tr>








<form name="web_lead_form" id="web_lead_form" action="thankyou.php" method="POST">




<input type=hidden name="full_name" id="full_name" value="<?php echo $full_name; ?>">
<input type=hidden name="title" id="full_name" value="<?php echo $title; ?>">
<input type=hidden name="company_name" id="company_name" value="<?php echo $company_name; ?>">
<input type=hidden name="email" id="email" value="<?php echo $email; ?>">
<input type=hidden name="telephone" id="telephone" value="<?php echo $telephone; ?>">
<input type=hidden name="postal_address" id="postal_address" value="<?php echo $postal_address; ?>">
<input type=hidden name="website" id="website" value="<?php echo $website; ?>">
<input type=hidden name="murata_product_number" id="murata_product_number" value="<?php echo $murata_product_number; ?>">
<input type=hidden name="evk_reg_code" id="evk_reg_code" value="<?php echo $evk_reg_code; ?>">
<input type=hidden name="platform" id="platform" value="<?php echo $platform; ?>">
<input type=hidden name="support" id="support" value="<?php echo $support; ?>">
<input type=hidden name="annual_quantity" id="annual_quantity" value="<?php echo $annual_quantity; ?>">
<input type=hidden name="end_use" id="end_use" value="<?php echo $end_use; ?>">
<input type=hidden name="others_involved" id="others_involved" value="<?php echo $others_involved; ?>">
<input type=hidden name="assembly_location" id="assembly_location" value="<?php echo $assembly_location; ?>">
<input type=hidden name="civilian" id="civilian" value="<?php echo $civilian; ?>">
<input type=hidden name="laws" id="laws" value="<?php echo $laws; ?>">



</form>


</table>

</div>









	<?php }  ?>



















</body>
</html>

<?php  ?>
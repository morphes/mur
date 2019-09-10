<?php

// Turn off all error reporting
error_reporting(0);

 if ( $_POST["full_name"] == "" ){ ?>

<html>
<body>
<center>
<p><br><p><br><p><br><p class="style5">You are not authorized to view this page. </font>
</center>
</body>
</html>		

	<?php } else { ?>

<?php 
$to = "modules@murata.com";
$subject = "Registration - Murata Wireless Module"; 


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





$visitormail = "darrenash@murata.com";


 

$headers = "From: no_replies@murata.com" .  "\r\n" .
		"Cc: $visitormail\r\n".
			"MIME-Version: 1.0\r\n" .
			"Content-type: text/html; charset=UTF-8";



$body = "<html><body>".





"<p><font face=arial size=2>Full name: $full_name</font></p>".
"<p><font face=arial size=2>Title: $title</font></p>".
"<p><font face=arial size=2>Email: $email</font></p>".
"<p><font face=arial size=2>Telephone: $telephone</font></p>".
"<p><font face=arial size=2>Company name: $company_name</font></p>".
"<p><font face=arial size=2>Address: $postal_address</font></p>".
"<p><font face=arial size=2>Website: $website</font></p>".
"<p><font face=arial size=2>Murata Product Number: $murata_product_number</font></p>".
"<p><font face=arial size=2>EVK Registration Code: $evk_reg_code</font></p>".
"<p><font face=arial size=2>About your platform: $platform</font></p>".
"<p><font face=arial size=2>Will you be purchasing a support contract?: $support</font></p>".
"<p><font face=arial size=2>Estimated annual module quantity?: $annual_quantity</font></p>".
"<p><font face=arial size=2>End use of your product: $end_use</font></p>".
"<p><font face=arial size=2>Legal Business Name & Country of other Involved parties such as EMS, ODM: $others_involved</font></p>".
"<p><font face=arial size=2>Location where Murata products will be assembled into end products: $assembly_location</font></p>".
"<p><font face=arial size=2>I affirm Murata products will be used for civilian purposes only.: $civilian</font></p>".
"<p><font face=arial size=2>I affirm to comply to the applicable nation's laws relating to export control of controlled products.: $laws</font></p>".




"</body></html>"; 






if (!mail($to, $subject, $body, $headers)) {
  header( 'Location: http://wireless.murata.com/contact/confirm_error.php' ) ;
 } 
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Murata Confirm</title>

<style type="text/css">
<!--

.body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #5b6770;
}
-->
</style>

</head>



<body bgcolor="ffffff" topmargin=10 marginheight="10">






            <table cellpadding="5" width="500">

<tr><td colspan="2" class="body"><b>Confirmation</b>
</td></tr>

            <tr>
            <td>&nbsp;</td>
            </tr>

            <tr>
            <td colspan="2" class="body"><b> Thank you <?php echo $full_name; ?>, below is the information you submitted.</b></td>
            </tr>

            <tr>
            <td colspan="2">&nbsp;</td>
            </tr>


<tr><td class="body">Full name </td><td class="body"><?php echo $full_name; ?></td></tr>
<tr><td class="body">Title </td><td class="body"><?php echo $title; ?></td></tr>
<tr><td class="body">Email </td><td class="body"><?php echo $email; ?></td></tr>
<tr><td class="body">Telephone </td><td class="body"><?php echo $telephone; ?></td></tr>
<tr><td class="body">Company name </td><td class="body"><?php echo $company_name; ?></td></tr>
<tr><td class="body">Address </td><td class="body"><?php echo $postal_address; ?></td></tr>
<tr><td class="body">Website </td><td class="body"><?php echo $website; ?></td></tr>
<tr><td class="body">Murata Product Number </td><td class="body"><?php echo $murata_product_number; ?></td></tr>
<tr><td class="body">EVK Registration Code </td><td class="body"><?php echo $evk_reg_code; ?></td></tr>
<tr><td class="body">About your platform </td><td class="body"><?php echo $platform; ?></td></tr>
<tr><td class="body">Will you be purchasing a support contract? </td><td class="body"><?php echo $support; ?></td></tr>
<tr><td class="body">Estimated annual module quantity? </td><td class="body"><?php echo $annual_quantity; ?></td></tr>
<tr><td class="body">End use of your product </td><td class="body"><?php echo $end_use; ?></td></tr>
<tr><td class="body">Legal Business Name & Country of other Involved parties such as EMS, ODM </td><td class="body"><?php echo $others_involved; ?></td></tr>
<tr><td class="body">Location where Murata products will be assembled into end products </td><td class="body"><?php echo $assembly_location; ?></td></tr>
<tr><td class="body">I affirm Murata products will be used for civilian purposes only. </td><td class="body"><?php echo $civilian; ?></td></tr>
<tr><td class="body">I affirm to comply to the applicable nation's laws relating to export control of controlled products. </td><td class="body"><?php echo $laws; ?></td></tr>




  

            </table>



</body>
</html>


<?php

?>



	<?php }  ?>

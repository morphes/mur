<?php 

// Turn off all error reporting
error_reporting(0);

$referralz=$_SERVER['HTTP_REFERER']; 
$originz="http://wireless.murata.com/contact/reg/registration.php"; 
$newlocation="http://wireless.murata.com/eng/products/support/register-product.html"; 
$refervalid=0; 
if($referralz==$originz) $refervalid=1; 
if((!$refervalid) OR ($_POST["validated"]!=variable-passed-from-form)){ 
echo "<script type=\"text/JavaScript\"><!--\n "; 
echo "top.location.href = \"$newlocation\"; \n// --></script>"; 
exit; 
} 

?> 



<?php



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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
<title>Murata Electronics</title>


<style type="text/css">
<!--

.body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333333;
}
-->
</style>

</head>
<body bgcolor="ffffff" topmargin=10 marginheight="10">







<p><br>

 <table width="700" border="0" cellspacing="0" cellpadding="4">

<tr><td class="body">

<form id="signin_form" name="signin_form" method="POST" action="registration_validate.php" >
Type the characters you see in the picture below.
<br>


<script language="JavaScript">
<!--

function random_imglink(){
var myimages=new Array()

myimages[1]="../forms/image/image1.bmp"
myimages[2]="../forms/image/image2.bmp"
myimages[3]="../forms/image/image3.bmp"
myimages[4]="../forms/image/image4.bmp"
myimages[5]="../forms/image/image5.bmp"
myimages[6]="../forms/image/image6.bmp"
myimages[7]="../forms/image/image7.bmp"
myimages[8]="../forms/image/image8.bmp"
myimages[9]="../forms/image/image9.bmp"
myimages[10]="../forms/image/image10.bmp"

var ry=Math.floor(Math.random()*myimages.length)
if (ry==0)
ry=1
document.write('<img src="'+myimages[ry]+'" border=0><input type="hidden" name="image" value="'+myimages[ry]+'" />')
}
random_imglink()
//-->
</script>
<p><input name="signin" type="text" class="body" id="signin" size="30" />

<br><i><font size="1">letters are not case-sensitive</i></font>

<p><input name="submit" type="submit" class="body" id="submit" value="submit" />







  </table>



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









</body>
</html>
<?php

?>
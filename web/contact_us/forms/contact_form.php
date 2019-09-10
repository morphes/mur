<?php 

// Turn off all error reporting
error_reporting(0);

$part_name = $_GET['part'];

$Lead_Source_Identifier__c = $_POST["Lead_Source_Identifier__c"];

$referralz=$_SERVER['HTTP_REFERER']; 

$newreferer = $Lead_Source_Identifier__c;

$originz1="Murata Power"; 
$originz2="Murata Wireless"; 
$originz3="Murata MPS"; 

$newlocation="http://www.murata.com"; 
$refervalid=0; 
if( $newreferer == $originz1 || $newreferer == $originz2 || $newreferer == $originz3 ) 

$refervalid=1; 
if((!$refervalid) OR ($_POST["validated"]!=variable-passed-from-form)){ 
echo "<script type=\"text/JavaScript\"><!--\n "; 
echo "top.location.href = \"$newlocation\"; \n// --></script>"; 
exit; 
} 

?> 


<?php
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
$datasheet = $_POST["datasheet"];
$quantity = $_POST["quantity"];
$sample_quantity = $_POST["sample_quantity"];
$estimated_annual_usage = $_POST["estimated_annual_usage"];
$production_start_date = $_POST["production_start_date"];
$application = $_POST["application"];
$NPI = $_POST["NPI"];
$DCDC = $_POST["DCDC"];
$POL = $_POST["POL"];
$ACDC = $_POST["ACDC"];
$DPM = $_POST["DPM"];
$MAG = $_POST["MAG"];
$MAGDB = $_POST["MAGDB"];
$quantity = $_POST["quantity"];
$title = $_POST["title"];
$website = $_POST["website"];
$evk_reg_code = $_POST["evk_reg_code"];
$platform = $_POST["platform"];
$support = $_POST["support"];
$annual_quantity = $_POST["annual_quantity"];
$end_use = $_POST["end_use"];
$others_involved = $_POST["others_involved"];
$assembly_location = $_POST["assembly_location"];
$civilian = $_POST["civilian"];
$laws = $_POST["laws"];

$MCCAPACITORS_enews = $_POST["MCCAPACITORS_enews"];
$PCAPACITORS_enews = $_POST["PCAPACITORS_enews"];
$CIEF_enews = $_POST["CIEF_enews"];
$ESD_enews = $_POST["ESD_enews"];
$WIRELESS_enews = $_POST["WIRELESS_enews"];
$SOUND_enews = $_POST["SOUND_enews"];
$TIMING_enews = $_POST["TIMING_enews"];
$CTPP_enews = $_POST["CTPP_enews"];
$SENSORS_enews = $_POST["SENSORS_enews"];
$RF_enews = $_POST["RF_enews"];
$CERAMIC_enews = $_POST["CERAMIC_enews"];
$HFCCONNECTORS_enews = $_POST["HFCCONNECTORS_enews"];
$RFID_enews = $_POST["RFID_enews"];
			
$DCDC_enews = $_POST["DCDC_enews"];
$ACDC_enews = $_POST["ACDC_enews"];
$DPM_enews = $_POST["DPM_enews"];
$MAG_enews = $_POST["MAG_enews"];
$ADS_enews = $_POST["ADS_enews"];
$TP_enews = $_POST["TP_enews"];
$EOLV_enews = $_POST["EOLV_enews"];

$form_name = $_POST["form_name"];

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


<!--START Google Analytic-->
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
 (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-5860679-1', 'auto');
 ga('send', 'pageview');
</script>
<!--END Google Analytic-->

<!--START GA MPS-->
<script type="text/javascript">
//<![CDATA[
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
    })();

    var _gaq = _gaq || [];

_gaq.push(['_setAccount', 'UA-3923220-1']);
_gaq.push(['_trackPageview']);


//]]>
</script>
<!--END GA MPS-->


</head>
<body bgcolor="ffffff" topmargin=10 marginheight="10">







<p><br>

 <table width="700" border="0" cellspacing="0" cellpadding="4">

<tr><td class="body">

<form id="signin_form" name="signin_form" method="POST" action="contact_validate.php" >
Type the characters you see in the picture below.
<br>


<script language="JavaScript">
<!--

function random_imglink(){
var myimages=new Array()

myimages[1]="image/image1.bmp"
myimages[2]="image/image2.bmp"
myimages[3]="image/image3.bmp"
myimages[4]="image/image4.bmp"
myimages[5]="image/image5.bmp"
myimages[6]="image/image6.bmp"
myimages[7]="image/image7.bmp"
myimages[8]="image/image8.bmp"
myimages[9]="image/image9.bmp"
myimages[10]="image/image10.bmp"

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



<p><font color="#FFFFFF"><?php echo $Geo_Location__c; ?> <?php echo $Geo_Location_Continent__c; ?></font>



  </table>





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

<input type=hidden name="mailing_list__c" id="mailing_list__c" value="<?php echo $mailing_list__c; ?>">
<input type=hidden name="Lead_Source_Identifier__c" id="Lead_Source_Identifier__c" value="<?php echo $Lead_Source_Identifier__c; ?>">
<input type=hidden name="apps" id="apps" value="<?php echo $apps; ?>">

<input type=hidden name="Geo_Location__c" id="Geo_Location__c" value="<?php echo $Geo_Location__c; ?>">

<input type=hidden name="Geo_Location_Continent__c" id="Geo_Location_Continent__c" value="<?php echo $Geo_Location_Continent__c; ?>">


<input type=hidden name="apps" id="apps" value="<?php echo $apps; ?>">



<input type=hidden name="Customer_Comments__c" id="Customer_Comments__c" 
value=" <?php echo $Customer_Comments__c; ?>

<?php if ( $form_name != "enews" ) { ?>
  <?php } else { ?>
 -E-News Request- 
- Multilayer Ceramic Capacitors <?php echo $MCCAPACITORS_enews; ?> 
- Polymer Capacitors <?php echo $PCAPACITORS_enews; ?>
- Chip Inductors and EMI Filters <?php echo $CIEF_enews; ?>
- ESD Devices <?php echo $ESD_enews; ?>
- Wireless Module Solutions <?php echo $WIRELESS_enews; ?>
- Sound Components <?php echo $SOUND_enews; ?>
- Products for Timing Applications <?php echo $TIMING_enews; ?>
- Circuit and Thermal Protection <?php echo $CTPP_enews; ?>
- Sensors <?php echo $SENSORS_enews; ?>
- RF & Microwave Components <?php echo $RF_enews; ?>
- Ceramic Applied Products <?php echo $CERAMIC_enews; ?>
- High Frequency Coaxial Connectors <?php echo $HFCCONNECTORS_enews; ?>
- RFID Solutions <?php echo $RFID_enews; ?>
- DC/DC Converters <?php echo $DCDC_enews; ?>
- AC/DC Converters <?php echo $ACDC_enews; ?>
- Digital Panel Meters and Instruments <?php echo $DPM_enews; ?>
- Magnetics <?php echo $MAG_enews; ?>
- Data Acquisition <?php echo $ADS_enews; ?>
- Technical Papers <?php echo $TP_enews; ?>
- End-Of-Life Notices <?php echo $EOLV_enews; ?>
<?php }  ?>

<?php if ( $form_name != "technical" ) { ?>
  <?php } else { ?>
 -Technical Request- 
 -Which Murata Power Solutions 
product line would you like 
assistance with? <?php echo $apps; ?> 
 -Do you have  
a product data sheet? <?php echo $datasheet; ?> 
<?php }  ?>

<?php if ( $form_name != "quotation" ) { ?>
  <?php } else { ?>
 -Quotation Request- 
 -Quantity: <?php echo $quantity; ?> 
<?php }  ?>

<?php if ( $form_name != "sample" ) { ?>
  <?php } else { ?>
 -Sample Request- 
 -Quantity: <?php echo $sample_quantity; ?>  
 -Estimated Annual Usage: <?php echo $estimated_annual_usage; ?>  
 -Production Start Date: <?php echo $production_start_date; ?>  
 -Application: <?php echo $application; ?>  
<?php }  ?>

<?php if ( $form_name != "literature" ) { ?>
  <?php } else { ?>
 -Literature Request- 
 -New Product Catalog: <?php echo $NPI; ?> 
 -DC-DC Converter Data Book: <?php echo $DCDC; ?> 
 -PoL Converter Guide: <?php echo $POL; ?> 
 -AC-DC Power Supply Data Book: <?php echo $ACDC; ?> 
 -Digital Panel Meter Data Book: <?php echo $DPM; ?> 
 -Magnetics Selection Guide: <?php echo $MAG; ?> 
 -Magnetics Data Book: <?php echo $MAGDB; ?> 
<?php }  ?>

<?php if ( $form_name != "register" ) { ?>
  <?php } else { ?>
 -Register Product- 
 -Title: <?php echo $title; ?> 
 -Website: <?php echo $website; ?> 
 -Murata Product Number: <?php echo $Design_Reg_Product_1__c; ?> 
 -EVK Registration Code: <?php echo $evk_reg_code; ?> 
 -Tell us about your platform: <?php echo $platform; ?> 
 -Will you be purchasing a support contract? <?php echo $support; ?> 
 -Estimated annual module quantity? <?php echo $annual_quantity; ?> 
 -End use of your product: <?php echo $end_use; ?> 
 -Legal Business Name & Country of other
	Involved parties such as EMS, ODM: <?php echo $others_involved; ?> 
 -Location where Murata products will be
	assembled into end products: <?php echo $assembly_location; ?> 
 -Civilian Use: <?php echo $civilian; ?> 
 -Comply with Laws: <?php echo $laws; ?> 
<?php }  ?>
">

    
      
</form>












</body>
</html>
<?php

?>
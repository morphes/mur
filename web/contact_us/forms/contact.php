<?php
     // Test form
	 
	 
     // Turn off all error reporting
      error_reporting(0);

			$part_name = $_GET['part'];  

			$form_name = $_GET['form'];  
			  
			$host = $_SERVER['HTTP_HOST'];

			  			  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Contact</title>
<style type="text/css">
<!--

.body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #5b6770;
}
-->
</style>

<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>




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

<script language="Javascript" type="text/javascript"/>

function printStateMenu(country) {
	var stateSelect = '';
	if (country == 'United States') {
		stateSelect = '<select name="state" id="state" onChange="document.getElementById(\'stateValue\').innerHTML = this.value;" style="width: 275px"><option> Please Select </option><option value="AL"> Alabama </option><option value="AZ"> Arizona </option><option value="AR"> Arkansas </option><option value="CA"> California </option><option value="CO"> Colorado </option><option value="CT"> Connecticut </option><option value="DE"> Delaware </option><option value="DC"> District Of Columbia </option><option value="FL"> Florida </option><option value="GA"> Georgia </option><option value="ID"> Idaho </option><option value="IL"> Illinois </option><option value="IN"> Indiana </option><option value="IA"> Iowa </option><option value="KS"> Kansas </option><option value="KY"> Kentucky </option><option value="LA"> Louisiana </option><option value="ME"> Maine </option><option value="MD"> Maryland </option><option value="MA"> Massachusetts </option><option value="MI"> Michigan </option><option value="MN"> Minnesota </option><option value="MS"> Mississippi </option><option value="MO"> Missouri </option><option value="MT"> Montana </option><option value="NE"> Nebraska </option><option value="NV"> Nevada </option><option value="NH"> New Hampshire </option><option value="NJ"> New Jersey </option><option value="NM"> New Mexico </option><option value="NY"> New York </option><option value="NC"> North Carolina </option><option value="ND"> North Dakota </option><option value="OH"> Ohio </option><option value="OK"> Oklahoma </option><option value="OR"> Oregon </option><option value="PA"> Pennsylvania </option><option value="PR"> Puerto Rico </option><option value="RI"> Rhode Island </option><option value="SC"> South Carolina </option><option value="SD"> South Dakota </option><option value="TN"> Tennessee </option><option value="TX"> Texas </option><option value="UT"> Utah </option><option value="VT"> Vermont </option><option value="VA"> Virginia </option><option value="WA"> Washington </option><option value="WV"> West Virginia </option><option value="WI"> Wisconsin </option><option value="WY"> Wyoming </option></select>';	
	}
	else if (country == 'Canada') {
		stateSelect = '<select name="state" id="state" onChange="document.getElementById(\'stateValue\').innerHTML = this.value;" style="width: 275px"><option> Please Select </option><option value="AB"> Alberta </option><option value="BC"> British Columbia </option><option value="MB"> Manitoba </option><option value="NB"> New Brunswick </option><option value="NS"> Nova Scotia </option><option value="ON"> Ontario </option><option value="PE"> Prince Edward Island </option><option value="QC"> Quebec </option><option value="SK"> Saskatchewan </option></select>';
	}
		else if (country == 'China') {
		stateSelect = '<select name="state" id="state" onChange="document.getElementById(\'stateValue\').innerHTML = this.value;" style="width: 275px"><option> Please Select </option><option value="Anhui"> Anhui </option><option value="Yunnan"> Yunnan </option><option value="Henan"> Henan </option><option value="Hebei"> Hebei </option><option value="Hainan"> Hainan </option><option value="Gansu"> Gansu </option><option value="Jilin"> Jilin </option><option value="Hunan"> Hunan </option><option value="Hubei"> Hubei </option><option value="Jiangxi"> Jiangxi </option><option value="Jiangsu"> Jiangsu </option><option value="Shanxi"> Shanxi </option><option value="Shandong"> Shandong </option><option value="Sichuan"> Sichuan </option><option value="Chongqing"> Chongqing </option><option value="Shanghai"> Shanghai </option><option value="Qinghai"> Qinghai </option><option value="Tianjin"> Tianjin </option><option value="Fujian"> Fujian </option><option value="Beijing"> Beijing </option><option value="Guangdong"> Guangdong </option><option value="Zhejiang"> Zhejiang </option><option value="Macao"> Macao </option><option value="Sahaliyan"> Sahaliyan </option><option value="Guizhou"> Guizhou </option><option value="Liaoning"> Liaoning </option><option value="Shaanxi"> Shaanxi </option></select>';
	}
	else {
		stateSelect = '<select name="state" id="state" disabled  style="width: 275px"><option value="">State/Province...</option></select>';
		document.getElementById('stateValue').innerHTML = '';
	}
	document.getElementById('stateSelect').innerHTML = stateSelect;
	document.getElementById('countryValue').innerHTML = document.getElementById('country').value;
	document.getElementById('stateValue').innerHTML = document.getElementById('state').value;
}

</script>




</head>
<body bgcolor="ffffff" topmargin=10 marginheight="10">









<script type="text/javascript">

<!--

function validate_form ( )
{
	valid = true;
 


<!------ Form Validation------------->

        if ( document.contact_form.Type_of_Inquiry__c.value.selectedIndex == 0 )
        {
                alert ( "Enter Type of Inquiry" );
                valid = false;
        }


        if ( document.contact_form.Design_Reg_Product_1__c.value == "" & document.contact_form.Type_of_Inquiry__c.value != "Website Feedback" )
        {
                alert ( "Enter Product of Interest" );
                valid = false;
        }
		

		<!----------------Form Validation Sample Requests Form---------------->
						<?php if ( $form_name != "sample" ) { ?>
        <?php } else { ?>   		
		
		
		if ( document.contact_form.sample_quantity.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Sample Request" )
        {
                alert ( "Enter Quantity" );
                valid = false;
        } 	
		
		if ( document.contact_form.estimated_annual_usage.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Sample Request" )
        {
                alert ( "Enter Annual Usage" );
                valid = false;
        } 	
		
		if ( document.contact_form.production_start_date.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Sample Request" )
        {
                alert ( "Enter Production Start Date" );
                valid = false;
        } 		
		
		if ( document.contact_form.application.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Sample Request" )
        {
                alert ( "Enter Application" );
                valid = false;
        } 				
			
		<?php }  ?>	
		<!----------------Form Validation Sample Requests Form---END------------->
 
						<?php if ( $form_name != "sample" & $form_name != "register" ) { ?>
						
		if ( document.contact_form.Customer_Comments__c.value == "" )
        {
                alert ( "Enter Inquiry" );
                valid = false;

        }						
						
        <?php } else { ?>  		
		<?php }  ?>			
		
		        if ( document.contact_form.first_name.value == "" )
        {
                alert ( "Enter your First Name" );
                valid = false;
        }
		
		        if ( document.contact_form.last_name.value == "" )
        {
                alert ( "Enter your Last Name" );
                valid = false;
        }

        if ( document.contact_form.company.value == "" )
        {
                alert ( "Enter Company Name" );
                valid = false;
        }

        if ( document.contact_form.city.value == "" )
        {
                alert ( "Enter City/Town" );
                valid = false;
        }

        if ( document.contact_form.zip.value == "" )
        {
                alert ( "Enter Zip/Post Code" );
                valid = false;
        }



        if ( document.contact_form.country.value == "United States" )
        {


        if ( document.contact_form.state.selectedIndex == 0 )
        {
                alert ( "Please select a State" );
                valid = false;
        }
        }

        if ( document.contact_form.country.value == "Canada" )
        {


        if ( document.contact_form.state.selectedIndex == 0 )
        {
                alert ( "Please select a Province" );
                valid = false;
        }
        }
		
        if ( document.contact_form.country.value == "China" )
        {


        if ( document.contact_form.state.selectedIndex == 0 )
        {
                alert ( "Please select a Province" );
                valid = false;
        }
        }		

 

        if ( document.contact_form.country.selectedIndex == 0 )
        {
                alert ( "Please select a Country" );
                valid = false;
        }
	
        if ( document.contact_form.phone.value == "" )
        {
                alert ( "Enter Telephone Number" );
                valid = false;

        }

   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = document.contact_form.email.value;
   if(reg.test(address) == false) {
                alert ( "Invalid Email Address" );
                valid = false;
   }
   

		<!----------------Auto Fill Geolocation---------------->
		
		
	var geo_location =(geoplugin_city()+", "+geoplugin_regionName()+", "+geoplugin_countryName()+", "+geoplugin_continentCode());
        if ( document.contact_form.Geo_Location__c.value == "" )
        {	
		        ( document.contact_form.Geo_Location__c.value = (geo_location) );
}

	var geo_location_continent =(geoplugin_continentCode());
        if ( document.contact_form.Geo_Location_Continent__c.value == "" )
        {	
		        ( document.contact_form.Geo_Location_Continent__c.value = (geo_location_continent) );
}


   
		<!----------------Form Validation Register Products Form----------------> 
		<?php if ( $form_name != "register" ) { ?>
        <?php } else { ?>   
   
		if ( document.contact_form.title.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Title" );
                valid = false;
        }   
		
		if ( document.contact_form.website.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Website" );
                valid = false;
        }  

		if ( document.contact_form.platform.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Platform" );
                valid = false;
        }  

		if ( document.contact_form.support.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Support Contract" );
                valid = false;
        } 

		if ( document.contact_form.annual_quantity.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Annual Quantity" );
                valid = false;
        } 

		if ( document.contact_form.end_use.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter End Use" );
                valid = false;
        } 

		if ( document.contact_form.others_involved.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Other involved parties" );
                valid = false;
        } 

		if ( document.contact_form.assembly_location.value == "" & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert ( "Enter Assembly Location" );
                valid = false;
        } 
		
		if ( document.contact_form.civilian.checked == false & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert("Affirm for Civilian Use Only");
        	valid = false;
        }

        if ( document.contact_form.laws.checked == false & document.contact_form.Type_of_Inquiry__c.value == "Register Product" )
        {
                alert("Affirm to Comply to Laws");
        	valid = false;
        }
	<?php }  ?>
		<!----------------Form Validation Register Products Form--END-------------->   	 		
	




		

		
		<!----------------Auto Assign Lead Source Identifier (website)---------------->
		
	

var web = ( document.contact_form.host.value );

if ( web.match("power")
 ) {
        ( document.contact_form.Lead_Source_Identifier__c.value = "Murata Power" );
			
}	

if ( web.match("wireless")
 ) {
        ( document.contact_form.Lead_Source_Identifier__c.value = "Murata Wireless" );
			
}	

if ( web.match("murata-ps")
 ) {
        ( document.contact_form.Lead_Source_Identifier__c.value = "Murata MPS" );
			
}		
		
		
		<!----------------Auto Assign Category ---------------->
		
	

var str = ( document.contact_form.Design_Reg_Product_1__c.value );

if ( str.match("DR3") || 
str.match("DR4") || 
str.match("DR5") || 
str.match("DR7") || 
str.match("DR8") || 
str.match("RX5") || 
str.match("RX6") || 
str.match("TR1") || 
str.match("TR3") || 
str.match("TR7") || 
str.match("TR8") || 
str.match("TRC") || 
str.match("TX5") || 
str.match("TX6")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "Low-Power ICs" );
			
}

if ( str.match("LPR2430") || 
str.match("DNT") || 
str.match("SN8000") || 
str.match("SN820") || 
str.match("TYPE 1BW") || 
str.match("TYPE 1BX") || 
str.match("TYPE VZ") || 
str.match("TYPE WM") || 
str.match("TYPE WS") || 
str.match("TYPE WT") || 
str.match("TYPE YD") || 
str.match("TYPE ZD") || 
str.match("TYPE ZF") || 
str.match("TYPE ZP") || 
str.match("TYPE ZX") || 
str.match("TYPE ZY") || 
str.match("WIT") || 
str.match("WSN")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "RF Modules" );
}

if ( str.match("HO1") || 
str.match("HX1") || 
str.match("OP4") || 
str.match("PX1") || 
str.match("RF1") || 
str.match("RF2") || 
str.match("RF3") || 
str.match("RO2") || 
str.match("RO3") || 
str.match("RP1") || 
str.match("SAF") || 
str.match("SC3") || 
str.match("SF1") || 
str.match("SF2")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "Saw-Based Components" );
}

if ( str.match("DN-2") || 
str.match("DN-9") || 
str.match("HN-1") || 
str.match("HN-2") || 
str.match("HN-3") || 
str.match("HN-5") || 
str.match("LG2") || 
str.match("LG9") || 
str.match("SEM") || 
str.match("SN2") || 
str.match("SN802") || 
str.match("SN90") || 
str.match("SNAP") || 
str.match("TYPE 1CD - IMP003") || 
str.match("TYPE YD WITH AYLA IOT CLOUD SOFTWARE") || 
str.match("ZN-2")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "Wireless Connectivity Platforms" );
}

if ( str.match("C1U") || 
str.match("D1U") || 
str.match("MPA") || 
str.match("MVA") || 
str.match("S1U")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "AC-DC Power Supplies" )
}

if ( str.match("BEI") || 
str.match("BWR") || 
str.match("DRQ") || 
str.match("DWR") || 
str.match("EMH") || 
str.match("HPH") || 
str.match("HPQ") || 
str.match("LME") || 
str.match("MEA") || 
str.match("MEE") || 
str.match("MEF") || 
str.match("MEJ") || 
str.match("MER") || 
str.match("MEU") || 
str.match("MEV") || 
str.match("MGJ") || 
str.match("MMV") || 
str.match("MPD") || 
str.match("MTE") || 
str.match("MTU") || 
str.match("MYB") || 
str.match("MYD") || 
str.match("MYG") || 
str.match("MYL") || 
str.match("MYS") || 
str.match("MYUS") || 
str.match("NCM") || 
str.match("NCS") || 
str.match("NDH") || 
str.match("NDL") || 
str.match("NDS") || 
str.match("NDT") || 
str.match("NDY") || 
str.match("NKA") || 
str.match("NKE") || 
str.match("NMA") || 
str.match("NMD") || 
str.match("NME") || 
str.match("NMF") || 
str.match("NMG") || 
str.match("NMH") || 
str.match("NMJ") || 
str.match("NMK") || 
str.match("NML") || 
str.match("NMR") || 
str.match("NMS") || 
str.match("NMT") || 
str.match("NMV") || 
str.match("NPH") || 
str.match("NTA") || 
str.match("NTE") || 
str.match("NTH") || 
str.match("NTV") || 
str.match("NXE") || 
str.match("OKD") || 
str.match("OKI") || 
str.match("OKL") || 
str.match("OKR") || 
str.match("OKX") || 
str.match("OKY") || 
str.match("PAE") || 
str.match("PAH") || 
str.match("PAQ") || 
str.match("PWR") || 
str.match("RBE") || 
str.match("RBQ") || 
str.match("RUW") || 
str.match("SPM") || 
str.match("UEE") || 
str.match("UEI") || 
str.match("UHE") || 
str.match("ULE") || 
str.match("ULS") || 
str.match("ULT") || 
str.match("UQQ") || 
str.match("UVQ") || 
str.match("UWE") || 
str.match("UWQ") || 
str.match("UWR") || 
str.match("UWS")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "DC-DC Converters" );
}

if ( str.match("LXDC")
 ) {
        ( document.contact_form.Product_Line_Interest__c.value = "Micro DC-DC Converters" );
}



<!------ Form Filter no Cross-Site scripting ------------->


						<?php if ( $form_name != "quotation" ) { ?>
        <?php } else { ?>  

var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.quantity.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.quantity.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
      <?php }  ?>
	  
	  
						<?php if ( $form_name != "sample" ) { ?>
        <?php } else { ?>  

var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.sample_quantity.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.sample_quantity.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.estimated_annual_usage.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.estimated_annual_usage.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
    var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.production_start_date.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.production_start_date.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
 	  
	      var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.application.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.application.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
 
      <?php }  ?>	 
	  
	  
	  						<?php if ( $form_name != "register" ) { ?>
        <?php } else { ?>  

var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.title.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.title.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.website.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.website.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.platform.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.platform.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.support.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.support.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.annual_quantity.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.annual_quantity.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.end_use.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.end_use.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.others_involved.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.others_involved.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.assembly_location.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.assembly_location.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.civilian.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.civilian.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.laws.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.laws.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. quantity");
  	return false;
  	}
  }	
  
 
      <?php }  ?>

  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.mailing_list__c.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.mailing_list__c.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. checkbox");
  	return false;
  	}
  }	
	
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.Type_of_Inquiry__c.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.Type_of_Inquiry__c.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. type");
  	return false;
  	}
  }		
		
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.first_name.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.first_name.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. name");
  	return false;
  	}
  }
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.last_name.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.last_name.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. name");
  	return false;
  	}
  }
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.company.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.company.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. company");
  	return false;
  	}
  }
  
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.city.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.city.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. city");
  	return false;
  	}
  }    

var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.zip.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.zip.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. zip");
  	return false;
  	}
  }   
	
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.country.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.country.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. country");
  	return false;
  	}
  }  
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.state.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.state.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. state");
  	return false;
  	}
  }  
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.phone.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.phone.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. phone");
  	return false;
  	}
  }   
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.email.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.email.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. email");
  	return false;
  	}
  }  
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.Design_Reg_Product_1__c.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.Design_Reg_Product_1__c.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. product");
  	return false;
  	}
  }  
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.Customer_Comments__c.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.Customer_Comments__c.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. inquiry");
  	return false;
  	}
  } 
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.Lead_Source_Identifier__c.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.Lead_Source_Identifier__c.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. Lead Source Identifier");
  	return false;
  	}
  } 

 
 
 

        return valid;
}

//-->





</script>











<!---------------Contact Form--------------> 

<form name="contact_form" id="contact_form" action="contact_form.php?part=<?php echo $part_name ?>"
method="POST" class="body" onsubmit="return validate_form( )">

<table border="0"><tr><td>



   <table width="600"  border="0"  cellspacing="15" cellpadding="1">
   
   
   
  
   
<?php if ( $form_name != "" ) { ?>   

<?php if ( $form_name != "register" ) { ?>
  <?php } else { ?>

   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="Register Product">
<?php }  ?>

<?php if ( $form_name != "enews" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>E-News</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="E-News">
<?php }  ?>

<?php if ( $form_name != "technical" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>Technical Request</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="Technical Request">
<?php }  ?>

<?php if ( $form_name != "quotation" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>Quotation Request</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="Quotation Request">   
<?php }  ?>

<?php if ( $form_name != "sample" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>Sample Request</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="Sample Request"> 
<?php }  ?>

<?php if ( $form_name != "literature" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>Literature Request</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="Literature Request">  
<?php }  ?>

<?php if ( $form_name != "general" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>General Request</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="General Request"> 
<?php }  ?>

<?php if ( $form_name != "website" ) { ?>
  <?php } else { ?>
   <tr><td colspan="3" class="body"><strong>Website Feedback</strong></td></tr>
   <input type="hidden" name="Type_of_Inquiry__c" id="Type_of_Inquiry__c" value="Website Feedback">  
<?php }  ?>
 


  <?php } else { ?>  
  
        <tr>
        <td align="right"><span class="body">* Type of Inquiry </td>
        <td colspan="2" align="left"><span class="body">
<select name="Type_of_Inquiry__c" type="text" class="body" id="Type_of_Inquiry__c" style="width: 275px">
<option value=""></option>
<option value="General Request">General Request</option>
<option value="Technical Request">Technical Request</option>
<option value="Quotation Request">Quotation Request</option>
<option value="Sample Request">Sample Request</option>
<option value="Literature Request">Literature Request</option>
<option value="Website Feedback">Website Feedback</option>
</select>
	</td>
      </tr>
      
<?php }  ?>



<!--General Request----------->
<!--General Request----END---->




<!--ENews Request----------->
<?php if ( $form_name != "enews" ) { ?>     
  <?php } else { ?> 

<tr><td colspan="3"><table border="0" width=100%>

<tr><td width="300"><img src="/js/mps/logo_150_m.gif" alt="Newsletter" title="e-Specifier Newsletter"><br />
			<b>Passive Component</b><br />
			<input type="checkbox" class="checkbox" name="MCCAPACITORS_enews" value="YES">
			Multilayer Ceramic Capacitors<br />
			<input type="checkbox" class="checkbox" name="PCAPACITORS_enews" value="YES">
			Polymer Capacitors<br />
			<input type="checkbox" class="checkbox" name="CIEF_enews" value="YES">
			Chip Inductors and EMI Filters<br />
			<input type="checkbox" class="checkbox" name="ESD_enews" value="YES">
			ESD Devices<br />
			<input type="checkbox" class="checkbox" name="WIRELESS_enews" value="YES">
			Wireless  Module Solutions<br />
			<input type="checkbox" class="checkbox" name="SOUND_enews" value="YES">
			Sound Components<br />
			<input type="checkbox" class="checkbox" name="TIMING_enews" value="YES">
			Products for Timing Applications<br />
			<input type="checkbox" class="checkbox" name="CTPP_enews" value="YES">
			Circuit and Thermal Protection<br />
			<input type="checkbox" class="checkbox" name="SENSORS_enews" value="YES">
			Sensors<br />
			<input type="checkbox" class="checkbox" name="RF_enews" value="YES">
			RF & Microwave Components<br />
			<input type="checkbox" class="checkbox" name="CERAMIC_enews" value="YES">
			Ceramic Applied Products<br />
			<input type="checkbox" class="checkbox" name="HFCCONNECTORS_enews" value="YES">
			High Frequency Coaxial Connectors<br />
			<input type="checkbox" class="checkbox" name="RFID_enews" value="YES">
			RFID Solutions
	
    </td>	
        
		<td valign="top" width="300"><img src="/js/mps/logo_150_mps.gif" alt="Newsletter" title="e-Specifier Newsletter"><br />
			<b>Power Product</b><br />
			<input type="checkbox" class="checkbox" name="DCDC_enews" value="YES">
			DC/DC Converters<br />
			<input type="checkbox" class="checkbox" name="ACDC_enews" value="YES">
			AC/DC Converters<br />
			<input type="checkbox" class="checkbox" name="DPM_enews" value="YES">
			Digital Panel Meters and Instruments<br />
			<input type="checkbox" class="checkbox" name="MAG_enews" value="YES">
			Magnetics<br />
			<input type="checkbox" class="checkbox" name="TP_enews" value="YES">
			Technical Papers <span style="color:green">(new)</span><br />
			<input type="checkbox" class="checkbox" name="EOLV_enews" value="YES">
			End-Of-Life Notices <span style="color:green">(new)</span>
</td></tr>
</table></td></tr>

<input type="hidden" name="Design_Reg_Product_1__c" id="Design_Reg_Product_1__c" value="e-news">


<?php }  ?>
<!--ENews Request----END------->





<!--Technical Request----------->
<?php if ( $form_name != "technical" ) { ?>     
  <?php } else { ?> 
  
          <tr>
        <td align="right" valign="top"><span class="body">Which Murata Power Solutions<br />
product line would you like<br />
assistance with?</td>
        <td bgcolor="#8D8D8D">
        
        <table align="left" bgcolor="#FFFFFF">
        <tr><td align="right"><span class="body"><input type="radio" class="radio" value="DC/DC Converters / PC-104 Power / Electronic Load" name="apps" id="dc_apps"></td>
        <td align="left"><span class="body">DC/DC Converters / PC-104 Power / Electronic Load	</td>
      </tr>

        <tr>
        <td align="right"><span class="body">
			<input type="radio" class="radio" value="AC/DC Converters" name="apps" id="ac_apps"></td>
        <td align="left"><span class="body">AC/DC Converters	</td>
      </tr>

        <tr>
        <td align="right"><span class="body">
			<input type="radio" class="radio" value="Digital Panel Meters and Instruments" name="apps" id="dmp_apps"></td>
        <td align="left"><span class="body">Digital Panel Meters and Instruments <span class="star">*</span>
				<div id="notes" class="notes" style="display:none;">
					<span>Please note:</span> With safety as our primary concern, we cannot provide technical assistance for Panel Meters used in the following non-commercial applications: <b>motorcycles, automobiles, recreational vehicles (boats, motor homes, etc.), residential installations and hobbyist.</b>
				</div>	</td>
      </tr>


        <tr>
        <td align="right"><span class="body">
			<input type="radio" class="radio" value="Magnetics" name="apps" id="mag_apps"></td>
        <td align="left"><span class="body">Magnetics	</td>
      </tr>

        <tr>
        <td align="right"><span class="body">
			<input type="radio" class="radio" value="Other" name="apps" id="oth_apps"></td>
        <td align="left"><span class="body">Other	</td>
      </tr></table>


        <tr>
        <td align="right"><span class="body">
			<label>Do you have <br />a product data sheet?</label></span></td>
        <td colspan="2" align="left"><span class="body"><input type="radio" class="radio-yesno" value="1" name="datasheet"  class="datasheet"> Yes
			<input type="radio" class="radio-yesno" value="0" name="datasheet" class="datasheet"> No</td>
      </tr>
  
  <?php }  ?>
<!--Technical Request---END-------->



<!--Literature Request----------->
<?php if ( $form_name != "literature" ) { ?>     

  <?php } else { ?> 
  
          <tr bgcolor="#8D8D8D">
        <td colspan="3"  align="right" valign="top">
        
        <table width=100% bgcolor="#FFFFFF" align="left" cellpadding="0" cellspacing="8">
        
                <tr><td align="right"><span class="body">&nbsp;</td>
				<td align="left"><strong>Product line(s)</strong></td>
				<td align="left"><img src="pdf.png" border="0" ALT=""> <strong>Download Link</strong></td></tr>
        
        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="Industrial" value="YES"></td>
				<td align="left"><span class="body">Industrial Products Brochure <img src="http://www.murata-ps.com/isroot/cd4power/SiteImages/new.gif" border="0" ALT=""></td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/industrial_app_products.pdf" target="blank" class="blue"> Download PDF</a></td></tr>
                
        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="DCDC" value="YES"></td>
				<td align="left"><span class="body">DC-DC Converter Data Book <img src="http://www.murata-ps.com/isroot/cd4power/SiteImages/new.gif" border="0" ALT=""></td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/mps_dcdc.pdf" target="blank" class="blue"> Download PDF</a></td></tr>

        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="POL" value="YES" style="visibility:hidden"></td>
				<td align="left"><span class="body">PoL Converter Guide <img src="http://www.murata-ps.com/isroot/cd4power/SiteImages/new.gif" border="0" ALT=""> <span style="color:#FF0000">(download only)</span> </td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/mps_dcdc_pol.pdf" target="blank" class="blue"> Download PDF</a></td></tr>
                

        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="ACDC" value="YES"></td>
				<td align="left"><span class="body">AC-DC Power Supply Data Book </td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/mps_acdc.pdf" target="blank" class="blue"> Download PDF</a></td></tr>
                
        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="DPM" value="YES"></td>
				<td align="left"><span class="body">Digital Panel Meter Data Book</td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/mps_meter.pdf" target="blank" class="blue"> Download PDF</a></li>
</td></tr>

        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="MAG" value="YES"></td>
				<td align="left"><span class="body">Power Magnetics Selector Guide</td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/mps_magnetic.pdf" target="blank" class="blue"> Download PDF</a></td></tr>

        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="MAGDB" value="YES" style="visibility:hidden"></td>
				<td align="left"><span class="body">Inductor Selector Guide <span style="color:#FF0000">(download only)</span></td>
				<td align="left"><span class="body"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/Inductor_Selector_Guide.pdf" target="blank" class="blue"> Download PDF</a></td></tr>
            
        <tr><td align="right"><span class="body">&nbsp;</td>
				<td align="left"><strong>Market Brochure(s)</strong></td>
				<td align="left"><img src="pdf.png" border="0" ALT=""> <strong>Download Link</strong></td></tr>
			
        <tr><td align="right"><span class="body"><input type="checkbox" class="checkbox" name="HC" value="YES" style="visibility:hidden"></td>
        <td align="left">Healthcare Brochure 
        <span style="color:#FF0000"> <img src="http://www.murata-ps.com/isroot/cd4power/SiteImages/new.gif" border="0" ALT="">(download only)</span></td>
		<td align="left"><img src="pdf.png" border="0" ALT=""> <a href="http://www.murata-ps.com/datasheet/?http://www.murata-ps.com/data/catalogs/murata_healthcare.pdf" target="blank" class="blue"> Download PDF</a></td></tr>
        
        </table>
</td>
      </tr>
  
  <?php }  ?>
<!--Literature Request----END---->


<!--Website Feedback----------->
<!--Website Feedback----END---->












<!--Product of Interest--don't show for Register or ENews--->

<?php if ( $form_name == "register" || $form_name == "enews" ) { ?>
        <?php } else { ?>
            <tr>
	<td align="right" class="body"><?php if ( $form_name != "website" ) { ?>*<?php }  ?> Product of Interest</td>
	<td colspan="2" align="left"><input name="Design_Reg_Product_1__c" type="text" class="body" id="Design_Reg_Product_1__c" value="<?php echo strtoupper($part_name) ?>" size="40" onblur="this.value=this.value.toUpperCase()"/></td>
      </tr>

  <?php }  ?>
      
<!--Quotation Request----------->
<?php if ( $form_name != "quotation" ) { ?>     
  <?php } else { ?> 
  
     <tr>
        <td align="right"><span class="body">Quantity </td>
	<td colspan="2" align="left"><input name="quantity" type="text" class="body" id="quantity" size="40" />
	</td>
      </tr>

  <?php }  ?>
<!--Quotation Request----END---->      
      

      
      
      
      
<!--Sample Request----------->
<?php if ( $form_name != "sample" ) { ?>     
  <?php } else { ?> 
  
       <tr>
        <td align="right"><span class="body">* Quantity </td>
	<td colspan="2" align="left"><input name="sample_quantity" type="text" class="body" id="sample_quantity" size="40" />
	</td>
      </tr>
  
     <tr>
        <td align="right"><span class="body">* Estimated Annual Usage </td>
	<td colspan="2" align="left"><input name="estimated_annual_usage" type="text" class="body" id="estimated_annual_usage" size="40" />
	</td>
      </tr>
      
           <tr>
        <td align="right"><span class="body">* Production Start Date </td>
	<td colspan="2" align="left"><input name="production_start_date" type="text" class="body" id="production_start_date" size="40" />
	</td>
      </tr>
      
                 <tr>
        <td align="right"><span class="body">* Application </td>
	<td colspan="2" align="left"><input name="application" type="text" class="body" id="application" size="40" />
	</td>
      </tr>

  <?php }  ?>
<!--Sample Request----END---->      
      
<?php if ( $form_name != "register" ) { ?>
            <tr>
	<td align="right" class="body">* Please enter your inquiry here</td>
	<td colspan="2" align="left"><textarea name="Customer_Comments__c" id="Customer_Comments__c" rows="5" cols="42" class="body"></textarea></td>
      </tr>
        <?php } else { ?> 
        <input type="hidden" name="Customer_Comments__c" id="Customer_Comments__c" value="">
  <?php }  ?>

     <tr>
        <td align="right"><span class="body">* First Name </td>
	<td colspan="2" align="left"><input name="first_name" type="text" class="body" id="first_name" size="40" />
	</td>
      </tr>


     <tr>
        <td align="right"><span class="body">* Last Name </td>
	<td colspan="2" align="left"><input name="last_name" type="text" class="body" id="last_name" size="40" />
	</td>
      </tr>

      <tr>
	<td align="right" class="body">* Company Name</td>
	<td colspan="2" align="left"><input name="company" type="text" class="body" id="company" size="40" /></td>

      </tr>



      <tr>
	<td align="right" class="body">* City/Town</td>
	<td colspan="2" align="left"><input name="city" type="text" class="body" id="city" size="40" /></td>

      </tr>

      <tr>
	<td align="right" class="body">* Zip/Post Code</td>
	<td colspan="2" align="left"><input name="zip" type="text" class="body" id="zip" size="40" /></td>

      </tr>
      

 
      
     <input type="hidden" name="Geo_Location__c" id="Geo_Location__c" value=""> 
        
     <input type="hidden" name="Geo_Location_Continent__c" id="Geo_Location_Continent__c" value=""> 




   <tr>
        <td  align="right" class="body">* Country</td>
        <td  colspan="2" align="left" class="body">
        
<select onchange="printStateMenu(this.value);" id="country" name="country" size="1" style="width: 275px">
	  <option>Select country…</option>            
      <OPTION value="United States">United States</OPTION>
      <OPTION value="United Kingdom">United Kingdom</OPTION>
      <OPTION value="Canada">Canada</OPTION>
      <OPTION value="Afghanistan">Afghanistan</OPTION>
      <OPTION value="Albania">Albania</OPTION>
      <OPTION value="Algeria">Algeria</OPTION>
      <OPTION value="Andorra">Andorra</OPTION>
      <OPTION value="Angola">Angola</OPTION>
      <OPTION value="Antigua and Barbuda">Antigua and Barbuda</OPTION>
      <OPTION value="Argentina">Argentina</OPTION>
      <OPTION value="Armenia">Armenia</OPTION>
      <OPTION value="Australia">Australia</OPTION>
      <OPTION value="Austria">Austria</OPTION>
      <OPTION value="Azerbaijan">Azerbaijan</OPTION>
      <OPTION value="Bahamas">Bahamas</OPTION>
      <OPTION value="Bahrain">Bahrain</OPTION>
      <OPTION value="Bangladesh">Bangladesh</OPTION>
      <OPTION value="Barbados">Barbados</OPTION>
      <OPTION value="Belarus">Belarus</OPTION>
      <OPTION value="Belgium">Belgium</OPTION>
      <OPTION value="Belize">Belize</OPTION>
      <OPTION value="Benin">Benin</OPTION>
      <OPTION value="Bhutan">Bhutan</OPTION>
      <OPTION value="Bolivia">Bolivia</OPTION>
      <OPTION value="Bosnia-Herzegovina">Bosnia-Herzegovina</OPTION>
      <OPTION value="Botswana">Botswana</OPTION>
      <OPTION value="Brazil">Brazil</OPTION>
      <OPTION value="Brunei">Brunei</OPTION>
      <OPTION value="Bulgaria">Bulgaria</OPTION>
      <OPTION value="Burkina Faso">Burkina Faso</OPTION>
      <OPTION value="Burundi">Burundi</OPTION>
      <OPTION value="Cambodia">Cambodia</OPTION>
      <OPTION value="Cameroon">Cameroon</OPTION>
      <OPTION value="Canada">Canada</OPTION>
      <OPTION value="Cape Verde">Cape Verde</OPTION>
      <OPTION value="Central African Republic">Central African Republic</OPTION>
      <OPTION value="Chad">Chad</OPTION>
      <OPTION value="Chile">Chile</OPTION>
      <OPTION value="China">China</OPTION>
      <OPTION value="Colombia">Colombia</OPTION>
      <OPTION value="Comoros">Comoros</OPTION>
      <OPTION value="Costa Rica">Costa Rica</OPTION>
      <OPTION value="Cote d'Ivoire">Cote d'Ivoire</OPTION>
      <OPTION value="Croatia">Croatia</OPTION>
      <OPTION value="Cuba">Cuba</OPTION>
      <OPTION value="Cyprus">Cyprus</OPTION>
      <OPTION value="Czech Republic">Czech Republic</OPTION>
      <OPTION value="Denmark">Denmark</OPTION>
      <OPTION value="Djibouti">Djibouti</OPTION>
      <OPTION value="Dominica">Dominica</OPTION>
      <OPTION value="Dominican Republic">Dominican Republic</OPTION>
      <OPTION value="East Timor">East Timor</OPTION>
      <OPTION value="Ecuador">Ecuador</OPTION>
      <OPTION value="Egypt">Egypt</OPTION>
      <OPTION value="El Salvador">El Salvador</OPTION>
      <OPTION value="Equatorial Guinea">Equatorial Guinea</OPTION>
      <OPTION value="Eritrea">Eritrea</OPTION>
      <OPTION value="Estonia">Estonia</OPTION>
      <OPTION value="Ethiopia">Ethiopia</OPTION>
      <OPTION value="Fiji">Fiji</OPTION>
      <OPTION value="Finland">Finland</OPTION>
      <OPTION value="France">France</OPTION>
      <OPTION value="French Guiana">French Guiana</OPTION>
      <OPTION value="Gabon">Gabon</OPTION>
      <OPTION value="Gambia">Gambia</OPTION>
      <OPTION value="Georgia">Georgia</OPTION>
      <OPTION value="Germany">Germany</OPTION>
      <OPTION value="Ghana">Ghana</OPTION>
      <OPTION value="Greece">Greece</OPTION>
      <OPTION value="Grenada">Grenada</OPTION>
      <OPTION value="Guatemala">Guatemala</OPTION>
      <OPTION value="Guinea">Guinea</OPTION>
      <OPTION value="Guinea-Bissau">Guinea-Bissau</OPTION>
      <OPTION value="Guyana">Guyana</OPTION>
      <OPTION value="Haiti">Haiti</OPTION>
      <OPTION value="Honduras"> Honduras</OPTION>
      <OPTION value="Hong Kong">Hong Kong</OPTION>
      <OPTION value="Hungary">Hungary</OPTION>
      <OPTION value="Iceland">Iceland</OPTION>
      <OPTION value="India">India</OPTION>
      <OPTION value="Indonesia">Indonesia</OPTION>
      <OPTION value="Iran">Iran</OPTION>
      <OPTION value="Iraq">Iraq</OPTION>
      <OPTION value="Ireland">Ireland</OPTION>
      <OPTION value="Israel">Israel</OPTION>
      <OPTION value="Italy">Italy</OPTION>
      <OPTION value="Jamaica">Jamaica</OPTION>
      <OPTION value="Japan">Japan</OPTION>
      <OPTION value="Jordan">Jordan</OPTION>
      <OPTION value="Kazakhstan">Kazakhstan</OPTION>
      <OPTION value="Kenya">Kenya</OPTION>
      <OPTION value="Kiribati">Kiribati</OPTION>
      <OPTION value="Korea">Korea</OPTION>
      <OPTION value="Kosovo">Kosovo</OPTION>
      <OPTION value="Kuwait">Kuwait</OPTION>
      <OPTION value="Kyrgyzstan">Kyrgyzstan</OPTION>
      <OPTION value="Laos">Laos</OPTION>
      <OPTION value="Latvia">Latvia</OPTION>
      <OPTION value="Lebanon">Lebanon</OPTION>
      <OPTION value="Lesotho">Lesotho</OPTION>
      <OPTION value="Liberia">Liberia</OPTION>
      <OPTION value="Libya">Libya</OPTION>
      <OPTION value="Liechtenstein">Liechtenstein</OPTION>
      <OPTION value="Lithuania">Lithuania</OPTION>
      <OPTION value="Luxembourg">Luxembourg</OPTION>
      <OPTION value="Macedonia">Macedonia</OPTION>
      <OPTION value="Madagascar">Madagascar</OPTION>
      <OPTION value="Malawi">Malawi</OPTION>
      <OPTION value="Malaysia">Malaysia</OPTION>
      <OPTION value="Maldives">Maldives</OPTION>
      <OPTION value="Mali">Mali</OPTION>
      <OPTION value="Malta">Malta</OPTION>
      <OPTION value="Marshall Islands">Marshall Islands</OPTION>
      <OPTION value="Mauritania">Mauritania</OPTION>
      <OPTION value="Mauritius">Mauritius</OPTION>
      <OPTION value="Mexico">Mexico</OPTION>
      <OPTION value="Micronesia">Micronesia</OPTION>
      <OPTION value="Moldova">Moldova</OPTION>
      <OPTION value="Monaco">Monaco</OPTION>
      <OPTION value="Mongolia">Mongolia</OPTION>
      <OPTION value="Montenegro">Montenegro</OPTION>
      <OPTION value="Morocco">Morocco</OPTION>
      <OPTION value="Mozambique">Mozambique</OPTION>
      <OPTION value="Myanmar">Myanmar</OPTION>
      <OPTION value="Namibia">Namibia</OPTION>
      <OPTION value="Nauru">Nauru</OPTION>
      <OPTION value="Nepal">Nepal</OPTION>
      <OPTION value="Netherlands">Netherlands</OPTION>
      <OPTION value="New Zealand">New Zealand</OPTION>
      <OPTION value="Nicaragua">Nicaragua</OPTION>
      <OPTION value="Niger">Niger</OPTION>
      <OPTION value="Nigeria">Nigeria</OPTION>
      <OPTION value="North Korea">North Korea</OPTION>
      <OPTION value="Norway">Norway</OPTION>
      <OPTION value="Oman">Oman</OPTION>
      <OPTION value="Other">Other</OPTION>
      <OPTION value="Pakistan">Pakistan</OPTION>
      <OPTION value="Palau">Palau</OPTION>
      <OPTION value="Panama">Panama</OPTION>
      <OPTION value="Papua New Guinea">Papua New Guinea</OPTION>
      <OPTION value="Paraguay">Paraguay</OPTION>
      <OPTION value="Peru">Peru</OPTION>
      <OPTION value="Philippines">Philippines</OPTION>
      <OPTION value="Poland">Poland</OPTION>
      <OPTION value="Portugal">Portugal</OPTION>
      <OPTION value="Qatar">Qatar</OPTION>
      <OPTION value="Republic of Congo">Republic of Congo</OPTION>
      <OPTION value="Romania">Romania</OPTION>
      <OPTION value="Russian Federation">Russian Federation</OPTION>
      <OPTION value="Rwanda">Rwanda</OPTION>
      <OPTION value="Saint Christopher and Nevis">Saint Christopher and Nevis</OPTION>
      <OPTION value="Saint Lucia">Saint Lucia</OPTION>
      <OPTION value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</OPTION>
      <OPTION value="Samoa">Samoa</OPTION>
      <OPTION value="San Marino">San Marino</OPTION>
      <OPTION value="Sao Tome and Principe">Sao Tome and Principe</OPTION>
      <OPTION value="Saudi Arabia">Saudi Arabia</OPTION>
      <OPTION value="Senegal">Senegal</OPTION>
      <OPTION value="Serbia">Serbia</OPTION>
      <OPTION value="Seychelles">Seychelles</OPTION>
      <OPTION value="Sierra Leone">Sierra Leone</OPTION>
      <OPTION value="Singapore">Singapore</OPTION>
      <OPTION value="Slovakia">Slovakia</OPTION>
      <OPTION value="Slovenia">Slovenia</OPTION>
      <OPTION value="Solomon Islands">Solomon Islands</OPTION>
      <OPTION value="Somalia">Somalia</OPTION>
      <OPTION value="South Africa">South Africa</OPTION>
      <OPTION value="Spain">Spain</OPTION>
      <OPTION value="Sri Lanka">Sri Lanka</OPTION>
      <OPTION value="Sudan">Sudan</OPTION>
      <OPTION value="Suriname">Suriname</OPTION>
      <OPTION value="Swaziland">Swaziland</OPTION>
      <OPTION value="Sweden">Sweden</OPTION>
      <OPTION value="Switzerland">Switzerland</OPTION>
      <OPTION value="Syrian Arab Republic">Syrian Arab Republic</OPTION>
      <OPTION value="Taiwan">Taiwan</OPTION>
      <OPTION value="Tajikistan">Tajikistan</OPTION>
      <OPTION value="Tanzania">Tanzania</OPTION>
      <OPTION value="Thailand">Thailand</OPTION>
      <OPTION value="Togo">Togo</OPTION>
      <OPTION value="Tonga">Tonga</OPTION>
      <OPTION value="Trinidad and Tobago">Trinidad and Tobago</OPTION>
      <OPTION value="Tunisia">Tunisia</OPTION>
      <OPTION value="Turkey">Turkey</OPTION>
      <OPTION value="Turkmenistan">Turkmenistan</OPTION>
      <OPTION value="Tuvalu">Tuvalu</OPTION>
      <OPTION value="Uganda">Uganda</OPTION>
      <OPTION value="Ukraine">Ukraine</OPTION>
      <OPTION value="United Arab Emirates">United Arab Emirates</OPTION>
      <OPTION value="United Kingdom">United Kingdom</OPTION>
      <OPTION value="United States">United States</OPTION>
      <OPTION value="Uruguay">Uruguay</OPTION>
      <OPTION value="Uzbekistan">Uzbekistan</OPTION>
      <OPTION value="Vanuatu">Vanuatu</OPTION>
      <OPTION value="Vatican">Vatican</OPTION>
      <OPTION value="Venezuela">Venezuela</OPTION>
      <OPTION value="Viet Nam">Viet Nam</OPTION>
      <OPTION value="Western Sahara">Western Sahara</OPTION>
      <OPTION value="Yemen">Yemen</OPTION>
      <OPTION value="Zambia">Zambia</OPTION>
      <OPTION value="Zimbabwe">Zimbabwe</OPTION>
          </select>
</td>
</tr>



   <tr>
	<td align="right" class="body">State/Province</td>
        <td colspan="2" align="left" class="body">

          
<p id="stateSelect"><select name="state" id="state" disabled="disabled" style="width: 275px"><option value="">State/Province......</option></select></p>          
          
          
</td>
</tr>


      <tr>
	<td align="right" class="body">* Telephone</td>
	<td colspan="2" align="left"><input name="phone" type="text" class="body" id="phone" size="40" /></td>

      </tr>

      <tr>
	<td align="right" class="body">* Email</td>
	<td colspan="2" align="left"><input name="email" type="text" class="body" id="email" size="40" /></td>

      </tr>




<!--Register Product----------->

<?php if ( $form_name != "register" ) { ?>
  <?php } else { ?>


     <tr>
        <td align="right"><span class="body">* Title </td>
	<td align="left"><input name="title" type="text" class="body" id="title" size="40" />
	</td>
      </tr>

      <tr>
	<td align="right" class="body">* Website</td>
	<td align="left"><input name="website" type="text" class="body" id="website" size="40" /></td>
      </tr>

    
      <tr>
	<td align="right" class="body">* Murata Product Number</td>
	<td colspan="2" align="left"><input name="Design_Reg_Product_1__c" type="text" class="body" id="Design_Reg_Product_1__c" value="<?php echo strtoupper($part_name) ?>" size="40" onblur="this.value=this.value.toUpperCase()"/></td>
      </tr>

      <tr>
	<td align="right" class="body">EVK Registration Code
	(Found in the EVK Quick Start Guide,
	required for access software update) :</td>
	<td align="left"><input name="evk_reg_code" type="text" class="body" id="evk_reg_code" size="40" /></td>
      </tr>

      <tr>
	<td align="right" class="body">* Tell us about your platform
	(platform name, processor, OS)</td>
	<td align="left"><input name="platform" type="text" class="body" id="platform" size="40" /></td>
      </tr>

      <tr>
	<td align="right" class="body">* Will you be purchasing a support contract?</td>
	<td align="left"><input name="support" type="text" class="body" id="support" size="40" /></td>
      </tr>

      <tr>
	<td align="right" class="body">* Estimated annual module quantity?</td>
	<td align="left"><input name="annual_quantity" type="text" class="body" id="annual_quantity" size="40" /></td>
      </tr>


      <tr>
	<td align="right" class="body">* End use of your product
	(e.g. civil use media player)</td>
	<td align="left"><textarea name="end_use" rows="5" cols="42" class="body"></textarea></td>
      </tr>

      <tr>
	<td align="right" class="body">* Legal Business Name & Country of other
	Involved parties such as EMS, ODM</td>
	<td align="left"><textarea name="others_involved" rows="5" cols="42" class="body"></textarea></td>
      </tr>

      <tr>
	<td align="right" class="body">* Location where Murata products will be
	assembled into end products</td>
	<td align="left"><textarea name="assembly_location" rows="5" cols="42" class="body"></textarea></td>
      </tr>

      <tr>
	<td  align="left" class="body" colspan="2">&nbsp;
	</td>
	</tr>

      <tr>
	<td colspan="2"  align="left" class="body">    <input type="checkbox" name="civilian" value="yes"/>
 * I affirm Murata products will be used for civilian purposes only. I affirm that Murata products will not be used in any weapons systems or for any goods or systems specially designed or intended for military end-use or military end users. I affirm the following statements: 

<p>Any export by the customer of Murata products should be done in accordance with the relevant export control laws of their respective country.
Murata does not approve the use of its components and products for the use, development, production, or stockpiling of any weapons (including but not limited to Weapons of Mass Destruction or conventional weapons), or goods or systems specially designed or intended for military end-use or military end users.
In case the customer should resell the Murata products to a third party, we desire the customer to confirm or identify the end user and end use of such resell items.
The customer will not resell Murata products as they are to any third party, when the customer has known or found a sufficient reason to suspect that the Murata products might be used for the development, production, use or stockpiling of any weapons (including but not limited to Weapons of Mass Destruction or conventional weapons), or goods or systems specially designed or intended for military end-use or military end-users.
If the customer should dispose of the Murata products, we request them to take reasonable measures to protect the products from being used by any other party in a manner contrary to the above key elements.
</td>

	</tr>

      <tr>
	<td colspan="2" align="left" class="body"><input type="checkbox" name="laws" value="yes"/>
* I affirm to comply to the applicable nation's laws relating to export control of controlled products. Further, I understand Murata wireless module products are classified as controlled products under U.S. and Japan export control law.
In using Murata wireless modules, Customer agrees and accepts the Specifications, Conditions, Notice, and Disclaimer contained in the wireless module data sheet of the Murata product used.

</td>
	</tr>

<?php }  ?>

<!--Register Product----END---->



      <tr>
	<td align="right" class="body"><input type="checkbox" name="mailing_list__c" checked/> Add me to mailing list
	</td>
	<td colspan="2" align="left" class="body" >&nbsp;
	</td>
	</tr>


<tr>
        <td colspan="3" align="right" class="body"><input name="submit" type="submit" class="body" id="submit" value="submit" />
   
   
        
<!-- state and country hidden values-->

<p style="display:none;" id='countryValue'></p>

<p style="display:none;" id='stateValue'></p>

<!--END state and country hidden values-->        
        
        </td>
      </tr>
      
      

      
</table>
</td></tr>



</table>

<input type="hidden" name="Product_Line_Interest__c" id="Product_Line_Interest__c" value="<?php echo $Product_Line_Interest__c; ?>">
<input type="hidden" name="Lead_Source_Identifier__c" id="Lead_Source_Identifier__c" value="<?php echo $Lead_Source_Identifier__c; ?>">

<input type="hidden" name="host" id="host" value="<?php echo $host; ?>">

<input type="hidden" name="form_name" id="form_name" value="<?php echo $form_name; ?>">

</form>





</td>
</tr>



</table>




<!-----------------------------------------Contact Us form END-------------------------------------------------------->





</body>
</html>

<?php ?>

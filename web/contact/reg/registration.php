
<?php

// Turn off all error reporting
error_reporting(0);
       


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registration</title>
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









<script type="text/javascript">

<!--

function validate_form ( )
{
	valid = true;
 
<!------ Form Validation------------->



        if ( document.contact_form.full_name.value == "" )
        {
                alert ( "Enter your Name" );
                valid = false;
        }

        if ( document.contact_form.title.value == "" )
        {
                alert ( "Enter Your Title" );
                valid = false;
        }


   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = document.contact_form.email.value;
   if(reg.test(address) == false) {
                alert ( "Invalid Email Address" );
                valid = false;
   }

        if ( document.contact_form.telephone.value == "" )
        {
                alert ( "Enter Telephone Number" );
                valid = false;

        }


        if ( document.contact_form.company_name.value == "" )
        {
                alert ( "Enter Company Name" );
                valid = false;
        }


        if ( document.contact_form.postal_address.value == "" )
        {
                alert ( "Enter Address" );
                valid = false;

        }


        if ( document.contact_form.website.value == "" )
        {
                alert ( "Enter Website" );
                valid = false;

        }


        if ( document.contact_form.murata_product_number.value == "" )
        {
                alert ( "Enter Murata Product Number" );
                valid = false;

        }


        if ( document.contact_form.evk_reg_code.value == "" )
        {
                alert ( "Enter EVK Registration Code" );
                valid = false;

        }


        if ( document.contact_form.platform.value == "" )
        {
                alert ( "Enter Your Platform" );
                valid = false;

        }


        if ( document.contact_form.support.value == "" )
        {
                alert ( "Enter Need Support Contract" );
                valid = false;

        }


        if ( document.contact_form.annual_quantity.value == "" )
        {
                alert ( "Enter Annual Quantity" );
                valid = false;

        }


        if ( document.contact_form.end_use.value == "" )
        {
                alert ( "Enter End use" );
                valid = false;

        }



        if ( document.contact_form.others_involved.value == "" )
        {
                alert ( "Enter Involved parties" );
                valid = false;

        }



        if ( document.contact_form.assembly_location.value == "" )
        {
                alert ( "Enter Assembly Location" );
                valid = false;

        }



        if ( document.contact_form.civilian.checked == false)
        {
                alert("Affirm for Civilian Use Only");
        	valid = false;
        }

        if ( document.contact_form.laws.checked == false)
        {
                alert("Affirm to Comply to Laws");
        	valid = false;
        }
		
		
		
		
	
<!------ Form Filter no Cross-Site scripting ------------->



var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.full_name.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.full_name.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. name");
  	return false;
  	}
  }		
  
var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.title.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.title.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. to1");
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

  for (var i = 0; i < document.contact_form.telephone.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.telephone.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. telephone");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.company_name.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.company_name.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. company name");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.postal_address.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.postal_address.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. address");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.website.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.website.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. website");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.evk_reg_code.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.evk_reg_code.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. evk reg code");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.murata_product_number.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.murata_product_number.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. product number");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.platform.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.platform.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. platform");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.support.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.support.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. support contract");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.annual_quantity.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.annual_quantity.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. annual quantity");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.end_use.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.end_use.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. end use");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.others_involved.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.others_involved.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. others involved");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.assembly_location.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.assembly_location.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. assembly location");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.civilian.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.civilian.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. civilian use");
  	return false;
  	}
  }	
  
  var iChars = ":<>=";

  for (var i = 0; i < document.contact_form.laws.value.length; i++) {
  	if (iChars.indexOf(document.contact_form.laws.value.charAt(i)) != -1) {
  	alert ("Special characters are not allowed.\n Please remove them and try again. laws");
  	return false;
  	}
  }	
  


        return valid;
}

//-->





</script>











<!---------------Registration Form--------------> 

<form name="contact_form" id="contact_form" action="registration_form.php"
method="POST" class="body" onsubmit="return validate_form( )">

<table border="0"><tr><td>



   <table width="600"  border="0"  cellspacing="15" cellpadding="0">







     <tr>
        <td width="800" align="right"><span class="body">* Full Name </td>
	<td align="left"><input name="full_name" type="text" class="body" id="full_name" size="40" />
	</td>
      </tr>

     <tr>
        <td align="right"><span class="body">* Title </td>
	<td align="left"><input name="title" type="text" class="body" id="title" size="40" />
	</td>
      </tr>


      <tr>
	<td align="right" class="body">* Email</td>
	<td align="left"><input name="email" type="text" class="body" id="email" size="40" /></td>

      </tr>

      <tr>
	<td align="right" class="body">* Telephone</td>
	<td align="left"><input name="telephone" type="text" class="body" id="telephone" size="40" /></td>

      </tr>


      <tr>
	<td align="right" class="body">* Company Name</td>
	<td align="left"><input name="company_name" type="text" class="body" id="company_name" size="40" /></td>

      </tr>


      <tr>
	<td align="right" class="body">Address</td>
	<td align="left"><textarea name="postal_address" rows="5" cols="42" class="body"></textarea></td>

      </tr>


      <tr>
	<td align="right" class="body">* Website</td>
	<td align="left"><input name="website" type="text" class="body" id="website" size="40" /></td>

      </tr>


      <tr>
	<td align="right" class="body">* Murata Product Number</td>
	<td align="left"><input name="murata_product_number" type="text" class="body" id="murata_product_number" size="40" /></td>

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






<tr>


        <td colspan="2" align="right" class="body"><input name="submit" type="submit" class="body" id="submit" value="submit" /></td>
      </tr>
</table>
</td></tr>



</table>

</form>





</td>
</tr>



</table>




<!-----------------------------------------Contact Us form END-------------------------------------------------------->





</body>
</html>

<?php ?>

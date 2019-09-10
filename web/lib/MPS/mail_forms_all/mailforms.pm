package mailforms;
require 5.001;
require Exporter;

@ISA= qw(Exporter);
@EXPORT=qw(MailFormsAll MailFormREP MailFormRSM MailFormFAE MailFormsSA MailFormsEMEA MailFormsASIA);

use SharedLib::Script::API;
use Mail::Sendmail;
use TLEProcess;
use Util::Debug qw(Debug);
use zipDeCoder;
use SharedLib::LogFile qw(LogFile);

$DEBUG = 2;

#################################################################################
#*****      MailFormsAll()    Website Form Mail for All
#*****      2011-04-12        v0.1.0
#*****      2011-04-23        v0.2.0	Heather Merten Routing
#################################################################################

sub MailFormsAll{

#################################################################################
#			Veriables
#################################################################################

##BOF This Form Script Switches

	my($anonymous);
	my($to_default);
	my($cc_default);
	my($thankyou);
	my($email);
	my($spam);
#when no email provided, what should be the default from address
#also used to send thank you forms from address
	$anonymous				="Murata Power Solution <no-reply\@murata-ps.com>";
#if no to address is select what is defaul (Webmaster)
	$to_default				="webmaster\@murata-ps.com";
#defaul CC (Webmaster)
#	$cc_default				="webmaster\@murata-ps.com, mmorgovsky\@murata-ps.com";
	$cc_default				="webmaster\@murata-ps.com";
#Thank you email
#set to 1=ON
#set to 0=OFF
	$thankyou				="1";
#this is for Spam prevention if its a robot it will submit to a fake email field
	$email					=GetInput("email");
##EOF This Form Script Switches		

##BOF Contact info veriables
	my($subject);
	my($required_name);
	my($title);
	my($required_company);
	my($required_address);
	my($address2);
	my($mailstop);
	my($required_city);
	my($state);
	my($zip);
	my($country);
	my($required_phone);
	my($fax);
	my($required_email);
	
	$subject				=GetInput("subject");
	$required_name			=GetInput("required_name");
	$title					=GetInput("title");
	$required_company		=GetInput("required_company");
	$required_address		=GetInput("required_address");
	$address2				=GetInput("address2");
	$mailstop				=GetInput("mailstop");
	$required_city			=GetInput("required_city");
	$state					=GetInput("state");
	$zip					=GetInput("zip");
	$country				=GetInput("country");
	$required_phone			=GetInput("required_phone");
	$fax					=GetInput("fax");
	$required_email			=GetInput("required_email");
##BOF Contact info veriables

##BOF Common
	my($options);
	my($comment);
	my($mailing);

	$options				="";
	$comment				=GetInput("comment");
	$mailing				=GetInput("mailing");
	
##BOF Comments Fix
#$comment =~ s/(\)|\()//g;
#$comment =~ s/(\))/[/g;
#$comment =~ s/(\()/]/g;

##EOF Comments Fix
##EOF Common

##BOF Catalog request & Email Sign up veriables


	my($DCDC);
	my($ACDC);
	my($DMS);
	my($ADS);
	my($MAG);
	my($NPI);

	my($dcdc_quantity);
	my($acdc_quantity);
	my($dms_quantity);
	my($ads_quantity);
	my($mag_quantity);
	my($npi_quantity);
	
	my($PC104);
	my($EOL);
	my($TP);
	my($MCCAPACITORS);
	my($PCAPACITORS);
	my($CIEF);
	my($ESD);
	my($WIRELESS);
	my($SOUND);
	my($TIMING);
	my($CTPP);
	my($SENSORS);
	my($RF);
	my($CERAMIC);
	my($HFCCONNECTORS);
	my($RFID);

	$DCDC 					=GetInput("DCDC");
	$ACDC 					=GetInput("ACDC");
	$DPM					=GetInput("DPM");
	$MAG					=GetInput("MAG");
	$ADS					=GetInput("ADS");
	$NPI					=GetInput("NPI");

	$PC104					=GetInput("PC104");
	$EOL					=GetInput("EOL");
	$TP						=GetInput("TP");
	$MCCAPACITORS 			=GetInput("MCCAPACITORS");
	$PCAPACITORS 			=GetInput("PCAPACITORS");
	$CIEF 					=GetInput("CIEF");
	$ESD 					=GetInput("ESD");
	$WIRELESS 				=GetInput("WIRELESS");
	$SOUND 					=GetInput("SOUND");
	$TIMING 				=GetInput("TIMING");
	$CTPP 					=GetInput("CTPP");
	$SENSORS 				=GetInput("SENSORS");
	$RF 					=GetInput("RF");
	$CERAMIC 				=GetInput("CERAMIC");
	$HFCCONNECTORS 			=GetInput("HFCCONNECTORS");
	$RFID 					=GetInput("RFID");
	
	$dcdc_quantity				=GetInput("dcdc_quantity");	
	$acdc_quantity				=GetInput("acdc_quantity");
	$dms_quantity				=GetInput("dms_quantity");
	$ads_quantity				=GetInput("ads_quantity");
	$mag_quantity				=GetInput("mag_quantity");
	$npi_quantity				=GetInput("npi_quantity");
##EOF Catalog request & Email Sign up veriables

##BOF Product
	my($qty1);
	my($product1);
	my($price1);

	my($serial);
	
	my($qty2);
	my($product2);
	my($price2);
	
	my($qty3);
	my($product3);
	my($price3);
	
	my($product8);

	$qty1				=GetInput("qty1");
	$product1			=GetInput("product1");
	$price1				=GetInput("price1");

	$serial				=GetInput("serial1");
	
	$qty2				=GetInput("qty2");
	$product2			=GetInput("product2");
	$price2				=GetInput("price2");
	
	$qty3				=GetInput("qty3");
	$product3			=GetInput("product3");
	$price3				=GetInput("price3");
	
	$product8			=GetInput("product8");
##EOF Product

##BOF Special
	my($BasePart);
	my($Vin);
	my($Vin1);
	my($Vin2);
	my($Vout1);
	my($Vout2);
	my($Vout3);
	my($Mout1);
	my($Mout2);
	my($Mout3);
	my($Isolation);
	my($IVolts);
	my($HeatSink);
	my($Height);
	my($Length);
	my($Width);
	my($IVoltage);
	my($UVLO);
	my($OVLO);
	my($OCL);
	my($OSCP);
	my($OVP);
	my($OnOff);
	my($Remote);
	my($SyncF);
	my($TShutdown);
	my($LCSharing);
	my($Business);
	my($Program);
	my($eau);
	my($EstYears);
	my($TarPrice);
	my($SampMonth);
	my($SampYear);
	my($ProdMonth);
	my($ProdYear);
	
	$BasePart				=GetInput("BasePart");
	$Vin					=GetInput("Vin");
	$Vin1					=GetInput("Vin1");
	$Vin2					=GetInput("Vin2");
	$Vout1					=GetInput("Vout1");
	$Vout2					=GetInput("Vout2");
	$Vout3					=GetInput("Vout3");
	$Mout1					=GetInput("Mout1");
	$Mout2					=GetInput("Mout2");
	$Mout3					=GetInput("Mout3");
	$Isolation				=GetInput("Isolation");
	$IVolts					=GetInput("IVolts");
	$IVoltage				=GetInput("IVoltage");
	$Height					=GetInput("Height");
	$Length					=GetInput("Length");
	$Width					=GetInput("Width");
	$HeatSink				=GetInput("HeatSink");
	$UVLO					=GetInput("UVLO");
	$OVLO					=GetInput("OVLO");
	$OCL					=GetInput("OCL");
	$OSCP					=GetInput("OSCP");
	$OVP					=GetInput("OVP");
	$OnOff					=GetInput("OnOff");
	$Remote					=GetInput("Remote");
	$SyncF					=GetInput("SyncF");
	$TShutdown				=GetInput("TShutdown");
	$LCSharing				=GetInput("LCSharing");
	$Business				=GetInput("Business");
	$Program				=GetInput("Program");
	$eau					=GetInput("eau");
	$EstYears				=GetInput("EstYears");
	$TarPrice				=GetInput("TarPrice");
	$SampMonth				=GetInput("SampMonth");
	$SampYear				=GetInput("SampYear");
	$ProdMonth				=GetInput("ProdMonth");
	$ProdYear				=GetInput("ProdYear");
##EOF Special

##BOF Support
	my($datasheet);
	my($apps);
	$datasheet			=GetInput("datasheet");
	$apps				=GetInput("apps");
##EOF Support

##BOF Sample
my($prodchart);
my($samplechart1);
my($samplechart2);
my($samplechart3);

my($appl_prog1)=GetInput("appl_prog1");
my($appl_prog2)=GetInput("appl_prog2");
my($appl_prog3)=GetInput("appl_prog3");

my($start_date1)=GetInput("start_date1");
my($start_date2)=GetInput("start_date2");
my($start_date3)=GetInput("start_date3");

my($annual_use1)=GetInput("annual_use1");
my($annual_use2)=GetInput("annual_use2");
my($annual_use3)=GetInput("annual_use3");
$prodchart = "\t Quantity: $qty1\n".
	"\t Model/Part No $product1\n";
if($product8 ne ""){
$prodchart .= "\t 8 Number : $product8\n";
}
$samplechart1 = "
\t Estimated Annual Usage: $annual_use1
\t Production Start Date: $start_date1
\t Program Name/Application: $appl_prog1
";
	my($eREP)					= &MailFormsREP($country, $state, $zip);
	my($eFAE)					= &MailFormsFAE($country, $state, $zip);
	my($eRSM)					= &MailFormsRSM($country, $state, $zip);
	my($eSA, $fSA)				= &MailFormsSA($country);
	my($eEMEA, $oEMEA, $cEMEA)	= &MailFormsEMEA($country);
	my($eASIA, $oASIA, $cASIA)	= &MailFormsASIA($country);

##EOF Sample
#################################################################################
#			Mailing by Subject
#################################################################################
#FROM : Default
#if($required_email eq "")
#{
#        $required_email=$anonymous;
#}
#SPAM - Possible SPAM
	if(($email ne "") or ($required_email eq $anonymous) or ($comment =~ m/http:/))
	{
		$spam				="(Possible SPAM) ";
	}
#TO : Default
my($recipient) = $to_default;
#CC : Default
my($cc) = $cc_default;

#Don't Sent SPAM
if($spam eq "")
{
	##BOF Base on subject
	if($subject eq "eNewsletter")
	{
		$recipient = 'sasmith@murata-ps.com';
	}
	elsif(($subject eq "Website Feedback") or ($subject eq "Customer Feedback") or ($subject eq "Powerchannel Feedback"))
	{
	#	$recipient = 'michael.morgovsky@murata-ps.com';
		$recipient = 'jsutherby@murata-ps.com, michael.morgovsky@murata-ps.com';
	}
	elsif(($subject eq "Catalog") or ($subject eq "Powerchannel Catalog")){
		if(($country eq "Albania") or ($country eq "Algeria") or ($country eq "Andorra") or ($country eq "Angola") or ($country eq "Australia") or ($country eq "Austria") or ($country eq "Azerbaijan") or ($country eq "Bangladesh") or ($country eq "Belarus") or ($country eq "Belgium") or ($country eq "Canary Islands") or ($country eq "Central African Republic") or ($country eq "Chad") or ($country eq "Channel Islands") or ($country eq "China") or ($country eq "Corsica") or ($country eq "Croatia") or ($country eq "Czech Republic") or ($country eq "Czechoslovakia") or ($country eq "Denmark") or ($country eq "Egypt") or ($country eq "Estonia") or ($country eq "Ethiopia") or ($country eq "Finland") or ($country eq "France") or ($country eq "Georgia") or ($country eq "Germany") or ($country eq "Ghana") or ($country eq "Gibraltar") or ($country eq "Greece") or ($country eq "Greenland") or ($country eq "Hungary") or ($country eq "Iceland") or ($country eq "India") or ($country eq "Indonesia") or ($country eq "Iraq") or ($country eq "Ireland") or ($country eq "Israel") or ($country eq "Italy") or ($country eq "Japan") or ($country eq "Jordan") or ($country eq "Kazakhstan") or ($country eq "Kenya") or ($country eq "Kirghizia (Kyrgyzstan") or ($country eq "Korea") or ($country eq "Kuwait") or ($country eq "Laos") or ($country eq "Latvia") or ($country eq "Lebanon") or ($country eq "Liberia") or ($country eq "Libya") or ($country eq "Liechtenstein") or ($country eq "Lithuania") or ($country eq "Luxembourg") or ($country eq "Madagascar") or ($country eq "Madeira Islands") or ($country eq "Malaysia") or ($country eq "Malta") or ($country eq "Mauritius") or ($country eq "Monaco") or ($country eq "Mongolia") or ($country eq "Morocco") or ($country eq "Mozambique") or ($country eq "Namibia") or ($country eq "Nauru") or ($country eq "Nepal") or ($country eq "Netherlands") or ($country eq "Netherlands Antilies") or ($country eq "New Zealand") or ($country eq "Niger") or ($country eq "Nigeria") or ($country eq "Northern Ireland") or ($country eq "Norway") or ($country eq "Oman") or ($country eq "Pakistan") or ($country eq "Poland") or ($country eq "Portugal") or ($country eq "Qatar") or ($country eq "Rhodesia") or ($country eq "Romania") or ($country eq "Russia") or ($country eq "Rwanda") or ($country eq "Saudi Arabia") or ($country eq "Scotland") or ($country eq "Senegal") or ($country eq "Servia (Montenegro") or ($country eq "Seychelles") or ($country eq "Sierra Leone") or ($country eq "Singapore") or ($country eq "Slovakia") or ($country eq "Slovenia") or ($country eq "Somalia") or ($country eq "Somalia Southern Reg") or ($country eq "South Africa") or ($country eq "Spain") or ($country eq "Sri Lanka") or ($country eq "Sudan") or ($country eq "Swaziland") or ($country eq "Sweden") or ($country eq "Switzerland") or ($country eq "Syria") or ($country eq "Tadzhikistan") or ($country eq "Taiwan") or ($country eq "Tajikistan") or ($country eq "Tanzania") or ($country eq "Thailand") or ($country eq "Togo") or ($country eq "Tonga") or ($country eq "Tunisia") or ($country eq "Turkey") or ($country eq "Turkmenistan") or ($country eq "U.S.S.R.") or ($country eq "Uganda") or ($country eq "Ukraine") or ($country eq "United Arab Emirates") or ($country eq "United Kingdom") or ($country eq "Uzbekistan") or ($country eq "Vatican City") or ($country eq "Vietnam") or ($country eq "Wales") or ($country eq "Yugoslavia") or ($country eq "Zaire") or ($country eq "Zambia") or ($country eq "Zimbabwe") or ($country eq "Armenia") or ($country eq "Bulgaria") or ($country eq "Cameroon") or ($country eq "Congo") or ($country eq "Cyprus") or ($country eq "Gabon") or ($country eq "Gambia") or ($country eq "Hong Kong") or ($country eq "Macedonia") or ($country eq "Moldova") or ($country eq "Philippines") or ($country eq "Western Sahara") or ($country eq "Western Samoa") or ($country eq "Yemen") or ($country eq "Yemen Arab Rep"))
		{
			$recipient = 'sarah.smith@murata-ps.com';
			$options .= " assigned to: Sarah Smith";	
		}
		else
		{
			if(($eREP ne "") and ($subject ne "Powerchannel Catalog"))
			{
				$recipient = $eREP;
				$options .= " assigned to: $recipient";	
			}
			else
			{
				$options .= " assigned to: Webmaster";	
			}
		}
	}
	elsif($subject eq "RMA")
	{
			$recipient = 'bdooley@murata-ps.com';
			if($eFAE ne "")
			{
				$cc .= ', ' . $eFAE . ', ' . $eREP;
			}
			$options .= " assigned to: $recipient";	
	}
	elsif($subject eq "Technical Support")
	{
		if($eFAE ne "")
		{
			$recipient = $eFAE;
			$cc .= ', '.$eRSM.', '.$eREP;
			$options .= " assigned to: $recipient";	
	
		}
		elsif($eSA ne "")
		{
			$recipient = $fSA;
			$cc .= ', '. $eSA;
			$options .= " assigned to: $recipient";	
		}
		elsif($eEMEA ne "")
		{
			$recipient = $eEMEA;
			$cc .= $cEMEA;
			$options .= $oEMEA;
			
		}
		elsif($eASIA ne "")
		{
			$recipient = $eASIA;
			$options .=  $oASIA;	
			if($cASIA ne "")
			{
				$cc	.= $cASIA;
			}
		}
	}
	elsif(($subject eq "General") or ($subject eq "RFQ") or ($subject eq "Sample"))
	{
		if($eREP ne "")
		{
			$recipient = $eREP;
			$cc .= ', '.$eRSM;
			$options .= " assigned to: $recipient";	
		}
		elsif($eSA ne "")
		{
			$recipient = $eSA;
			$cc .= ', '. $fSA;
			$options .= " assigned to: $recipient";	
		}
		elsif($eEMEA ne "")
		{
			$recipient = $eEMEA;
			$cc .= $cEMEA;
			$options .= $oEMEA;
			
		}
		elsif($eASIA ne "")
		{
			$recipient = $eASIA;
			$options .=  $oASIA;	
			if($cASIA ne "")
			{
				$cc	.= $cASIA;
			}
		}
	}
	elsif($subject eq "Special")
	{
		if($eREP ne "")
		{
			$recipient = $eREP;
			$cc .= ', '.$eRSM.', '.$eFAE;
			$options .= " assigned to: $recipient";	
		}
		elsif($eSA ne "")
		{
			$recipient = $eSA;
			$cc .= ', '. $fSA;
			$options .= " assigned to: $recipient";	
		}
		elsif($eEMEA ne "")
		{
			$recipient = $eEMEA;
			$cc .= $cEMEA;
			$options .= $oEMEA;
			
		}
		elsif($eASIA ne "")
		{
			$recipient = $eASIA;
			$options .=  $oASIA;	
			if($cASIA ne "")
			{
				$cc	.= $cASIA;
			}
		}
	}
##EOF Base on subject
}
##BOF Data Acquisition Components / A/D Converters

if(($apps eq "Data Acquisition Components / A/D Converters") or ($ADS ne ""))
{
		$cc .= ', help@datel.com';
}
##EOF Data Acquisition Components / A/D Converters

##BOF Based on mailing list
if(($country eq "United States") or ($country eq "Canada") or ($country eq "Puerto Rico") or ($country eq "Mexico"))
{
	if(($subject ne "Website Feedback") and ($subject ne "Powerchannel Feedback") and ($spam eq ""))
	{
		$cc .= ', heather.merten@murata-ps.com';
		if($apps eq "Digital Panel Meters and Instruments")
		{
			$cc .= ', Roy.Cabral@murata-ps.com';
		}
	}

}
if ($mailing  eq "1")
{
		$mailing = "Yes";
		$cc .= ', Sarah.Smith@murata-ps.com';
		$options .= " and Email List";
} else {
	$mailing = "No";
}
##BOF Based on mailing list

if ($datasheet eq "1"){
  $datasheet = "Yes";
} else {
  $datasheet = "No";
}

my($mess);
$mess = "Subject: Request from Murata Power Solutions : $subject\n\n".
	
#################################################################################
#			Mail Body
#################################################################################
	##BOF Contact info
	"Contact Details\n".
	"\t Name : $required_name\n".
	"\t Title : $title\n".
	"\t Company : $required_company\n".
	"\t Address : $required_address\n".
	"\t Address2 : $address2\n".
	"\t Mailstop : $mailstop\n".
	"\t City : $required_city\n".
	"\t State : $state\n".
	"\t zip : $zip\n".
	"\t Country : $country\n".
	"\t Phone : $required_phone\n".
	"\t Fax : $fax\n".
	"\t Email : $required_email\n".
	 "\n".
	"Comments/Suggestion:\n".
	"\t $comment\n".
	"\n";

##MM Test of routing loukup
#$mess .="Contact Details by country, state, zip\n".
#		"\t eREP: $eREP\n".
#		"\t eFAE: $eFAE\n".
#		"\t eRSM: $eRSM\n".
#		"\t eEMEA: $eEMEA\n".
#		"\t \t oEMEA: $oEMEA\n".
#		"\t \t cEMEA: $cEMEA\n".
#		"\t eASIA: $eASIA\n".
#		"\t \t oASIA: $oASIA\n".
#		"\t \t cASIA: $cASIA\n".
#		"\n";

	 ##EOF Contact info
if(($subject ne "eNewsletter") and ($subject ne "eNewsletterT")){
	 ##BOF Common
$mess .= "Mailing List? $mailing\n".
	"\n";
	 ##EOF Common
}
if(($subject eq "RFQ") or ($subject eq "Technical Support") or ($subject eq "RMA") or ($subject eq "RFQT") or ($subject eq "Technical SupportT") or ($subject eq "RMAT") or ($subject eq "Test")){
	 ##BOF Product
$mess .= "Product(s) info\n".
	"\t Quantity : $qty1\n".
	"\t Product : $product1\n".
	"\t Price : $price1\n";
if($serial ne ""){
$mess .= "\t serial : $serial\n";
}
$mess .= "\n";
if(($product2 ne "") and ($product2 ne "none")){
$mess .= "\t Quantity 2 : $qty2\n".
	"\t Product 2 : $product2\n".
	"\t Price 2 : $price2\n".
	"\n";
}
if(($product3 ne "") and ($product3 ne "none")){
$mess .= "\t Quantity 3 : $qty3\n".
	"\t Product 3 : $product3\n".
	"\t Price 3 : $price3\n".
	"\n";
}
	 ##EOF Product
}
if(($subject eq "Technical Support") or ($subject eq "Technical SupportT") or ($subject eq "Test")){
	 ##BOF Support
$mess .= "Type of Product:\n".
	"\t $apps\n".
	"\n".
	"Do You Have A Data Sheet : $datasheet\n".
	"\n";
	 ##EOF Support
}
if(($subject eq "Special") or ($subject eq "SpecialT") or ($subject eq "Test")){
	 ##BOF Special
$mess .= "Special - Custom\n".
	"\t Input Voltage : $Vin Volts \n".
	"\t Input Voltage Range : $Vin1 Volts\t". "to $Vin2 Volts \n".
	"\t Output Voltage 1 : $Vout1 Volts \n".
	"\t Output Voltage 2 : $Vout2 Volts \n".
	"\t Output Voltage 3 : $Vout3 Volts \n".
	"\t Maximum Output 1 : $Mout1 Amps \n".
	"\t Maximum Output 2 : $Mout2 Amps \n".
	"\t Maximum Output 3 : $Mout3 Amps \n".
	"\t Is isolation required : $Isolation \n".
	"\t Isolation Voltage : $IVolts Volts $IVoltage \n".
	"\n".
	"\t Available Area : $Height x $Length x $Width \n".
	"\t Heatsink/Baseplate : $HeatSink \n".
	"\n".
	"SPECIAL FEATURES: \n".
	"\t Input Undervoltage Lockout : $UVLO \n".
	"\t Input Overvoltage Shutdown : $OVLO \n".
	"\t Output Current Limiting : $OCL \n".
	"\t Output Short-Circuit Protection : $OSCP \n".
	"\t Output Overvoltage Protection : $OVP \n".
	"\t On/Off Control Pin : $OnOff \n".
	"\t Remote Sense Pins : $Remote \n".
	"\t Sync Function Pin : $SyncF \n".
	"\t Thermal Shutdown : $TShutdown \n".
	"\t Load/Current Sharing : $LCSharing \n".
	"\n".
	"APPLICATION INFORMATION: \n".
	"\t Company\'s main business : $Business \n".
	"\t Program/Product to be used : $Program \n".
	"\t Estimated annual usage : $eau \n".
	"\t Estimated years of usage : $EstYears \n".
	"\t Target price per unit in volume(USD) : $TarPrice \n".
	"\t Delivery date for samples : $SampMonth\t". "$SampYear \n".
	"\t Availability date for production quantities : $ProdMonth\t". "$ProdYear \n".
	"\n";
	 ##EOL Special
}
if(($subject eq "Sample") or ($subject eq "SampleT") or ($subject eq "Test")){
	 ##BOF Sample
$mess .= "Requested Murata Power Solutions parts:\n".
	"$prodchart".
	"\n".
	"MANUFACTURING INFORMATION\n".
	"$samplechart1".
	"\n";
	 ##EOF Sample
}
if(($subject eq "Catalog") or ($subject eq "Powerchannel Catalog") or ($subject eq "CatalogT") or ($subject eq "Powerchannel CatalogT") or ($subject eq "Test")){
	 ##BOF Catalog Request
$mess .= "Catalogs: \n".
	"\t DC/DC Converters : $DCDC\n\t".
		"\t Quantity : $dcdc_quantity\n".
		"\n".
	"\t AC/DC Power Supplies : $ACDC\n\t".
		"\t Quantity : $acdc_quantity\n".
		"\n".
	"\t Digital Panel Meters : $DPM\n\t".
		"\t Quantity : $dms_quantity\n".
		"\n".
	"\t Data Acquisition : $ADS\n\t".
		"\t Quantity : $ads_quantity\n".
		"\n".
	"\t Magnetics : $MAG\n\t".
		"\t Quantity : $mag_quantity\n".
		"\n".
	"\t NPI Catalog : $NPI\n\t".
		"\t Quantity : $npi_quantity\n".
	"\n";
	 ##EOF Catalog Request
}
if(($subject eq "eNewsletter") or ($subject eq "eNewsletterT") or ($subject eq "Test")){
	 ##BOF Product of interest
$mess .= "E-News\n".
	"\t My Product Interests Are:\n".
	"\t \t DC/DC : $DCDC\n".
	"\t \t AC/DC : $ACDC\n".
	"\t \t Digital Panel Meters : $DPM\n".
	"\t \t Magnetics : $MAG\n".
	"\t \t Data Acquisition : $ADS\n".
	"\t \t PC 104 : $PC104\n".
	"\t \t Technical Papers : $TP\n".
	"\t \t End-of-Life : $EOL\n".
	 "\n".
	"\t My Component Interests Are:\n".
	"\t \t Multilayer Ceramic Capacitors : $MCCAPACITORS\n".
	"\t \t Polymer Capacitors : $PCAPACITORS\n".
	"\t \t Chip Inductors and EMI Filters : $CIEF\n".
	"\t \t ESD Devices : $ESD\n".
	"\t \t Wireless Communications Modules Solutions : $WIRELESS \n".
	"\t \t Sound Components : $SOUND \n".
	"\t \t Products for Timing Applications : $TIMING \n".
	"\t \t Circuit and Thermal Protection Products : $CTPP \n".
	"\t \t Sensors : $SENSORS \n".
	"\t \t RF and Microwave Components, Sub-Modules : $RF \n".
	"\t \t Ceramic Applied Products : $CERAMIC \n".
	"\t \t High Frequency Coaxial Connectors : $HFCCONNECTORS \n".
	"\t \t RFID Solutions : $RFID \n".
	"\t \n";
}
	 ##EOF Product of interest
	 	##BOF Mail function
	%mail = ( To      => "$recipient",
				Cc      => "$cc",
				From    => "$anonymous",
				Subject => $spam."Request from Murata Power Solutions : $subject : $country : $state $options",
				Message => $mess);
 	
#################################################################################
#			Send
#################################################################################
sendmail(%mail) or AddContent("<p style='font-size:larger; color:red'><b>$Mail::Sendmail::error</b></p>");
#################################################################################
#			Log
#################################################################################

LogFile("WWW-FORM-START\n\t$spam\n TO:$recipient\n CC:$cc\n Subject: Request from Murata Power Solutions : $subject : $country : $state $options\n Message:\n $mess\nWWW-FORM-END"); 



#################################################################################
#			Thank you Email
#################################################################################
#is thank you turned on?
if($thankyou)
{
	#only if it's not spam
	if($spam eq "")
	{
		#only of email address exists
		if(($required_email ne $anonymous) and $subject ne "eNewsletter")
		{
			$messthankyou = "Dear $required_name,\n".
			"\n".
			"Thank you for your request to Murata Power Solutions.\n".
			"\n".
			"Your request has been sent to the appropriate individual(s) at Murata Power Solutions. If you have requested information to be sent to you, it will be mailed shortly. If you have any questions or comment in the interim, please visit our office locations page: http://www.murata-ps.com/offices.html.\n".
			"\n".
			"Original Form Details\n".
			"\n";
			%mailthankyou = ( To      => "$required_email",
						From    => $anonymous,
						Subject => "Murata Power Solutions : Thank you for your request",
						Message => $messthankyou . $mess);
			sendmail(%mailthankyou) or AddContent("<p style='font-size:larger; color:red'><b>$Mail::Sendmail::error</b></p>");
		}
	}
}
##EOF Mail function



}
#################################################################################
#*****      MailFormsREP()    Website Form Mail for Reps
#*****      2011-04-23        v0.2.0	Heather Merten Routing
#################################################################################

sub MailFormsREP{
   my($countryREP, $stateREP, $zipREP) = @_;
   my($emailREP);
   if($countryREP eq "United States")
   {
#   	AddContent("<p><b>Country US</b></p>");

		if(($stateREP eq "Arizona") or ($stateREP eq "New Mexico"))
		{
			$emailREP = 'arizona@thomlukesales.com';
		}
		elsif(($stateREP eq "Indiana") or ($stateREP eq "Kentucky") or ($stateREP eq "Michigan") or ($stateREP eq "Ohio") or ($stateREP eq "West Virginia"))
		{
			$emailREP = 'bgiudice@aemg-reps.com';
		}
		elsif(($stateREP eq "Colorado") or ($stateREP eq "Wyoming"))
		{
			$emailREP = 'colorado@thomlukesales.com';
		}
		elsif($stateREP eq "Georgia")
		{
			$emailREP = 'cwatters@aemg-reps.com';
		}
		elsif($stateREP eq "Nevada")
		{
			if(($zipREP eq "88901") or ($zipREP eq "88905") or ($zipREP eq "89002") or ($zipREP eq "89004") or ($zipREP eq "89005") or ($zipREP eq "89006") or ($zipREP eq "89007") or ($zipREP eq "89009") or ($zipREP eq "89011") or ($zipREP eq "89012") or ($zipREP eq "89014") or ($zipREP eq "89015") or ($zipREP eq "89016") or ($zipREP eq "89018") or ($zipREP eq "89019") or ($zipREP eq "89021") or ($zipREP eq "89024") or ($zipREP eq "89025") or ($zipREP eq "89026") or ($zipREP eq "89027") or ($zipREP eq "89028") or ($zipREP eq "89029") or ($zipREP eq "89030") or ($zipREP eq "89031") or ($zipREP eq "89032") or ($zipREP eq "89033") or ($zipREP eq "89034") or ($zipREP eq "89036") or ($zipREP eq "89037") or ($zipREP eq "89039") or ($zipREP eq "89040") or ($zipREP eq "89044") or ($zipREP eq "89046") or ($zipREP eq "89052") or ($zipREP eq "89053") or ($zipREP eq "89054") or ($zipREP eq "89067") or ($zipREP eq "89070") or ($zipREP eq "89074") or ($zipREP eq "89077") or ($zipREP eq "89081") or ($zipREP eq "89084") or ($zipREP eq "89085") or ($zipREP eq "89086") or ($zipREP eq "89087") or ($zipREP eq "89101") or ($zipREP eq "89102") or ($zipREP eq "89103") or ($zipREP eq "89104") or ($zipREP eq "89105") or ($zipREP eq "89106") or ($zipREP eq "89107") or ($zipREP eq "89108") or ($zipREP eq "89109") or ($zipREP eq "89110") or ($zipREP eq "89111") or ($zipREP eq "89112") or ($zipREP eq "89113") or ($zipREP eq "89114") or ($zipREP eq "89115") or ($zipREP eq "89116") or ($zipREP eq "89117") or ($zipREP eq "89118") or ($zipREP eq "89119") or ($zipREP eq "89120") or ($zipREP eq "89121") or ($zipREP eq "89122") or ($zipREP eq "89123") or ($zipREP eq "89124") or ($zipREP eq "89125") or ($zipREP eq "89126") or ($zipREP eq "89127") or ($zipREP eq "89128") or ($zipREP eq "89129") or ($zipREP eq "89130") or ($zipREP eq "89131") or ($zipREP eq "89132") or ($zipREP eq "89133") or ($zipREP eq "89134") or ($zipREP eq "89135") or ($zipREP eq "89136") or ($zipREP eq "89137") or ($zipREP eq "89138") or ($zipREP eq "89139") or ($zipREP eq "89140") or ($zipREP eq "89141") or ($zipREP eq "89142") or ($zipREP eq "89143") or ($zipREP eq "89144") or ($zipREP eq "89145") or ($zipREP eq "89146") or ($zipREP eq "89147") or ($zipREP eq "89148") or ($zipREP eq "89149") or ($zipREP eq "89150") or ($zipREP eq "89151") or ($zipREP eq "89152") or ($zipREP eq "89153") or ($zipREP eq "89154") or ($zipREP eq "89155") or ($zipREP eq "89156") or ($zipREP eq "89157") or ($zipREP eq "89158") or ($zipREP eq "89159") or ($zipREP eq "89160") or ($zipREP eq "89161") or ($zipREP eq "89162") or ($zipREP eq "89163") or ($zipREP eq "89164") or ($zipREP eq "89165") or ($zipREP eq "89166") or ($zipREP eq "89169") or ($zipREP eq "89170") or ($zipREP eq "89173") or ($zipREP eq "89177") or ($zipREP eq "89178") or ($zipREP eq "89179") or ($zipREP eq "89180") or ($zipREP eq "89183") or ($zipREP eq "89185") or ($zipREP eq "89191") or ($zipREP eq "89193") or ($zipREP eq "89195") or ($zipREP eq "89199"))
			{
				$emailREP = 'arizona@thomlukesales.com';
			}
			else
			{
				$emailREP = 'drecht@rechtassociates.com';
			}
		}
		elsif(($stateREP eq "Delaware") or ($stateREP eq "Maryland") or ($stateREP eq "Virginia"))
		{
			$emailREP = 'kcampbell@mechtronics.net';
		}
		elsif($stateREP eq "Florida")
		{
			$emailREP = 'lcraft@milltechsales.com';
		}
		elsif(($stateREP eq "Arkansas") or ($stateREP eq "Louisiana") or ($stateREP eq "Oklahoma") or ($stateREP eq "Texas"))
		{
			$emailREP = 'mikem@rames.com';
		}
		elsif(($stateREP eq "Illinois") or ($stateREP eq "Iowa") or ($stateREP eq "Kansas") or ($stateREP eq "Minnesota") or ($stateREP eq "Missouri") or ($stateREP eq "Nebraska") or ($stateREP eq "North Dakota") or ($stateREP eq "South Dakota") or ($stateREP eq "Wisconsin"))
		{
			$emailREP = 'paune@stanclothier.com';
		}
		elsif(($stateREP eq "Oregon") or ($stateREP eq "Washington"))
		{
			$emailREP = 'sales@westmarkco.com';
		}
		elsif(($stateREP eq "Connecticut") or ($stateREP eq "Maine") or ($stateREP eq "Massachusetts") or ($stateREP eq "New Hampshire") or ($stateREP eq "Rhode Island") or ($stateREP eq "Vermont"))
		{
			$emailREP = 'sdichiara@ut.com';
		}
		elsif(($stateREP eq "Alabama") or ($stateREP eq "Mississippi") or ($stateREP eq "Tennessee"))
		{
			$emailREP = 'sjones@aemg-reps.com';
		}
		elsif(($stateREP eq "North Carolina") or ($stateREP eq "South Carolina"))
		{
			$emailREP = 'tkuhl@aemg-reps.com';
		}
		elsif(($stateREP eq "Idaho") or ($stateREP eq "Montana") or ($stateREP eq "Utah"))
		{
			$emailREP = 'utah@thomlukesales.com';
		}
		elsif($stateREP eq "Hawaii")
		{
			$emailREP = 'skowalski@ckassoc.com';
		}
		elsif(($stateREP eq "California"))
		{
			if((($zipREP >= 90001) and ($zipREP <= 92327)) or (($zipREP >= 92329) and ($zipREP <= 92382)) or (($zipREP >= 92385) and ($zipREP <= 92386)) or (($zipREP >= 92391) and ($zipREP <= 93199)) or (($zipREP >= 93205) and ($zipREP <= 93206)) or (($zipREP >= 93215) and ($zipREP <= 93216)) or (($zipREP >= 93224) and ($zipREP <= 93226)) or (($zipREP >= 93240) and ($zipREP <= 93241)) or (($zipREP >= 93249) and ($zipREP <= 93255)) or (($zipREP >= 93283) and ($zipREP <= 93285)) or (($zipREP >= 93301) and ($zipREP <= 93242)) or (($zipREP >= 93427) and ($zipREP <= 93449)) or (($zipREP >= 93451) and ($zipREP <= 93510)) or (($zipREP >= 93518) and ($zipREP <= 93519)) or (($zipREP >= 93523) and ($zipREP <= 93524)) or (($zipREP >= 93527) and ($zipREP <= 93528)) or (($zipREP >= 93531) and ($zipREP <= 93539)) or (($zipREP >= 93543) and ($zipREP <= 93544)) or (($zipREP >= 93550) and ($zipREP <= 93599)) or ($zipREP == 93203) or ($zipREP == 93220) or ($zipREP == 93222) or ($zipREP == 93238) or ($zipREP == 93243) or ($zipREP == 93263) or ($zipREP == 93268) or ($zipREP == 93276) or ($zipREP == 93280) or ($zipREP == 93287) or ($zipREP == 93516))
			{
				$emailREP = 'skowalski@ckassoc.com';
			}
			elsif((($zipREP >= 93201) and ($zipREP <= 93202)) or (($zipREP >= 93207) and ($zipREP <= 93212)) or (($zipREP >= 93218) and ($zipREP <= 93219)) or (($zipREP >= 93227) and ($zipREP <= 93237)) or (($zipREP >= 93244) and ($zipREP <= 93247)) or (($zipREP >= 93256) and ($zipREP <= 93262)) or (($zipREP >= 93265) and ($zipREP <= 93267)) or (($zipREP >= 93270) and ($zipREP <= 93275)) or (($zipREP >= 93277) and ($zipREP <= 93279)) or (($zipREP >= 93290) and ($zipREP <= 93292)) or (($zipREP >= 93512) and ($zipREP <= 93515)) or (($zipREP >= 93529) and ($zipREP <= 93530)) or (($zipREP >= 93541) and ($zipREP <= 93542)) or (($zipREP >= 93545) and ($zipREP <= 93549)) or (($zipREP >= 93601) and ($zipREP <= 96162)) or ($zipREP == 92328) or ($zipREP == 92384) or ($zipREP == 92389) or ($zipREP == 93204) or ($zipREP == 93221) or ($zipREP == 93223) or ($zipREP == 93239) or ($zipREP == 93242) or ($zipREP == 93282) or ($zipREP == 93286) or ($zipREP == 93246) or ($zipREP == 93450) or ($zipREP == 93517) or ($zipREP == 93522) or ($zipREP == 93526))
			{
				$emailREP .= ', drecht@rechtassociates.com';
			}
			else 
			{
				$emailREP = 'skowalski@ckassoc.com';
				$emailREP .= ', drecht@rechtassociates.com';
			}
		}
		elsif($stateREP eq "New Jersey")
		{
			if(($zipREP >= 7000) and ($zipREP <= 7999))
			{
				$emailREP = 'carol@gsatech.com';
			}
			elsif(($zipREP >= 8000) and ($zipREP <= 8799))
			{
				$emailREP = 'kcampbell@mechtronics.net';
			}
			elsif(($zipREP >= 8800) and ($zipREP <= 8999))
			{
				$emailREP = 'carol@gsatech.com';
			}
			else
			{
				$emailREP = 'carol@gsatech.com';
				$emailREP .= ', kcampbell@mechtronics.net';
			}
		}
		elsif($stateREP eq "New York")
		{
			if(($zipREP >= 12000) and ($zipREP <= 14999))
			{
				$emailREP = 'cfisher@gmarep.com';
			}
			elsif(($zipREP >= 10001) and ($zipREP <= 11999))
			{
				$emailREP = 'carol@gsatech.com';
			}
			else
			{
				$emailREP = 'carol@gsatech.com';
				$emailREP .= ', cfisher@gmarep.com';
			}
		}
		elsif($stateREP eq "Pennsylvania")
		{
			if(($zipREP >= 15001) and ($zipREP <= 16751))
			{
				$emailREP = 'bgiudice@aemg-reps.com';
			}
			elsif(($zipREP >= 16801) and ($zipREP <= 19640))
			{
				$emailREP = 'kcampbell@mechtronics.net';
			}
			else
			{
				$emailREP = 'bgiudice@aemg-reps.com';
				$emailREP .= ', kcampbell@mechtronics.net';
			}
		}
	}
	elsif($countryREP eq "Canada")
	{
		if(($stateREP eq "Alberta") or ($stateREP eq "British Columbia") or ($stateREP eq "Manitoba") or ($stateREP eq "Northwest Territories") or ($stateREP eq "Nunavut") or ($stateREP eq "Saskatchewan") or ($stateREP eq "Yukon"))
		{
			$emailREP = 'gmaleads@gmarep.com';
		}
		elsif(($stateREP eq "New Brunswick") or ($stateREP eq "Newfoundland and Labrador") or ($stateREP eq "Nova Scotia") or ($stateREP eq "Ontario") or ($stateREP eq "Prince Edward Island") or ($stateREP eq "Quebec"))
		{
			$emailREP = 'sterling@gmarep.com';
		}
		else
		{
			$emailREP = 'sterling@gmarep.com';
			$emailREP .= ', gmaleads@gmarep.com';
		}
	}
#	AddContent("<p><b>Rep Email: $emailREP | Rep Country: $countryREP | Rep State: $stateREP | Rep Zip $zipREP</b></p>");
	return($emailREP);
}

#################################################################################
#*****      MailFormsRSM()    Website Form Mail for Reps
#*****      2011-04-23        v0.2.0	Heather Merten Routing
#################################################################################
sub MailFormsRSM{
   my($countryRSM, $stateRSM, $zipRSM) = @_;
   my($emailRSM);
   if($countryRSM eq "United States")
   {
		if(($stateRSM eq "Connecticut") or ($stateRSM eq "Delaware") or ($stateRSM eq "Maine") or ($stateRSM eq "Maryland") or ($stateRSM eq "Massachusetts") or ($stateRSM eq "New Hampshire") or ($stateRSM eq "New Jersey") or ($stateRSM eq "New York") or ($stateRSM eq "North Carolina") or ($stateRSM eq "Rhode Island") or ($stateRSM eq "South Carolina") or ($stateRSM eq "Vermont") or ($stateRSM eq "Virginia") or ($stateRSM eq "West Virginia"))
		{
			$emailRSM = 'jferreira@murata.com';
		}
		elsif(($stateRSM eq "Alaska") or ($stateRSM eq "Arizona") or ($stateRSM eq "California") or ($stateRSM eq "Colorado") or ($stateRSM eq "Hawaii") or ($stateRSM eq "Idaho") or ($stateRSM eq "Montana") or ($stateRSM eq "Nevada") or ($stateRSM eq "New Mexico") or ($stateRSM eq "Oregon") or ($stateRSM eq "Utah") or ($stateRSM eq "Washington") or ($stateRSM eq "Wyoming"))
		{
			$emailRSM = 'tkroiss@murata.com, pscarbo@murata.com';
		}
		elsif(($stateRSM eq "Alabama") or ($stateRSM eq "Arkansas") or ($stateRSM eq "Florida") or ($stateRSM eq "Georgia") or ($stateRSM eq "Illinois") or ($stateRSM eq "Indiana") or ($stateRSM eq "Iowa") or ($stateRSM eq "Kansas") or ($stateRSM eq "Kentucky") or ($stateRSM eq "Louisiana") or ($stateRSM eq "Michigan") or ($stateRSM eq "Minnesota") or ($stateRSM eq "Mississippi") or ($stateRSM eq "Missouri") or ($stateRSM eq "Nebraska") or ($stateRSM eq "North Dakota") or ($stateRSM eq "Ohio") or ($stateRSM eq "Oklahoma") or ($stateRSM eq "South Dakota") or ($stateRSM eq "Tennessee") or ($stateRSM eq "Texas") or ($stateRSM eq "Wisconsin"))
		{
			$emailRSM = 'vvictor@murata.com';
		}
		elsif($stateRSM eq "Pennsylvania")
		{
			if(($zipRSM >= 15001) and ($zipRSM <= 16751))
			{
				$emailRSM = 'vvictor@murata.com';
			}
			elsif(($zipRSM >= 16801) and ($zipRSM <= 19640))
			{
				$emailRSM = 'jferreira@murata.com';
			}
			else
			{
				$emailRSM = 'vvictor@murata.com, jferreira@murata.com';
			}		
		}
	}
	elsif($countryRSM eq "Puerto Rico")
	{
		$emailRSM = 'vvictor@murata.com';
	}
	#North America
	elsif($countryRSM eq "Canada")
	{
		if(($stateRSM eq "New Brunswick") or ($stateRSM eq "Newfoundland and Labrador") or ($stateRSM eq "Nova Scotia") or ($stateRSM eq "Ontario") or ($stateRSM eq "Prince Edward Island") or ($stateRSM eq "Quebec"))
		{
			$emailRSM = 'jferreira@murata.com';
		}
		elsif(($stateRSM eq "Alberta") or ($stateRSM eq "British Columbia") or ($stateRSM eq "Manitoba") or ($stateRSM eq "Northwest Territories") or ($stateRSM eq "Nunavut") or ($stateRSM eq "Saskatchewan") or ($stateRSM eq "Yukon"))
		{
			$emailRSM = 'tkroiss@murata.com, pscarbo@murata.com';
		}
		else
		{
			$emailRSM = 'tkroiss@murata.com, pscarbo@murata.com, jferreira@murata.com';
		}
	}
	return($emailRSM);
}

#################################################################################
#*****      MailFormsFAE()    Website Form Mail for Reps
#*****      2011-04-23        v0.2.0	Heather Merten Routing
#################################################################################

sub MailFormsFAE{
   my($countryFAE, $stateFAE, $zipFAE) = @_;
   my($emailFAE);
   if($countryFAE eq "United States")
   {
		if(($stateFAE eq "Alaska") or ($stateFAE eq "Arizona") or ($stateFAE eq "Arkansas") or ($stateFAE eq "California") or ($stateFAE eq "Colorado") or ($stateFAE eq "Hawaii") or ($stateFAE eq "Idaho") or ($stateFAE eq "Illinois") or ($stateFAE eq "Iowa") or ($stateFAE eq "Kansas") or ($stateFAE eq "Louisiana") or ($stateFAE eq "Minnesota") or ($stateFAE eq "Missouri") or ($stateFAE eq "Montana") or ($stateFAE eq "Nebraska") or ($stateFAE eq "Nevada") or ($stateFAE eq "New Mexico") or ($stateFAE eq "North Dakota") or ($stateFAE eq "Oklahoma") or ($stateFAE eq "Oregon") or ($stateFAE eq "South Dakota") or ($stateFAE eq "Texas") or ($stateFAE eq "Utah") or ($stateFAE eq "Washington") or ($stateFAE eq "Wisconsin") or ($stateFAE eq "Wyoming"))
		{
			$emailFAE = 'pknauber@murata.com';
		}
		elsif(($stateFAE eq "Alabama") or ($stateFAE eq "Connecticut") or ($stateFAE eq "Delaware") or ($stateFAE eq "Florida") or ($stateFAE eq "Georgia") or ($stateFAE eq "Indiana") or ($stateFAE eq "Kentucky") or ($stateFAE eq "Maine") or ($stateFAE eq "Maryland") or ($stateFAE eq "Massachusetts") or ($stateFAE eq "Michigan") or ($stateFAE eq "Mississippi") or ($stateFAE eq "New Hampshire") or ($stateFAE eq "New Jersey") or ($stateFAE eq "New York") or ($stateFAE eq "North Carolina") or ($stateFAE eq "Ohio") or ($stateFAE eq "Pennsylvania") or ($stateFAE eq "Rhode Island") or ($stateFAE eq "South Carolina") or ($stateFAE eq "Tennessee") or ($stateFAE eq "Vermont") or ($stateFAE eq "Virginia") or ($stateFAE eq "West Virginia"))
		{
			$emailFAE = 'rjungling@murata.com';
		}
	}
	#North America
	elsif($countryFAE eq "Canada")
	{
		if(($stateFAE eq "Alberta") or ($stateFAE eq "British Columbia") or ($stateFAE eq "Manitoba") or ($stateFAE eq "Northwest Territories") or ($stateFAE eq "Nunavut") or ($stateFAE eq "Saskatchewan") or ($stateFAE eq "Yukon"))
		{
			$emailFAE = 'pknauber@murata.com';
		}
		elsif(($stateFAE eq "New Brunswick") or ($stateFAE eq "Newfoundland and Labrador") or ($stateFAE eq "Nova Scotia") or ($stateFAE eq "Ontario") or ($stateFAE eq "Prince Edward Island") or ($stateFAE eq "Quebec"))
		{
			$emailFAE = 'rjungling@murata.com';
		}
		else
		{
			$emailFAE = 'pknauber@murata.com, rjungling@murata.com';
		}
	}
	return($emailFAE);
}
#################################################################################
#*****      MailFormsSA()    Website Form Mail for Reps
#*****      2011-06-20        v0.2.0	Heather Merten Routing
#################################################################################
sub MailFormsSA{
   my($countrySA) = @_;
   my($emailSA) = '';
   my($emailFAESA) = '';
   my($ccSA) = '';
	if(($countrySA eq "Argentina") or ($countrySA eq "Bolivia") or ($countrySA eq "Brazil") or ($countrySA eq "Chile") or ($countrySA eq "Colombia") or ($countrySA eq "Ecuador") or ($countrySA eq "French Guiana") or ($countrySA eq "Guyana") or ($countrySA eq "Paraguay") or ($countrySA eq "Peru") or ($countrySA eq "Suriname") or ($countrySA eq "Uruguay") or ($countrySA eq "Venezuela"))
	{
		$emailSA = 'heather.merten@murata-ps.com';
		$emailFAESA = 'rjungling@murata.com';
	}
	return($emailSA, $emailFAESA);
}

#################################################################################
#*****      MailFormsEMEA()    Website Form Mail for Reps
#*****      2011-04-23        v0.2.0	Routing
#################################################################################
sub MailFormsEMEA{
   my($countryEMEA) = @_;
   my($emailEMEA) = '';
   my($optionsEMEA) = '';
   my($ccEMEA) = '';
	if(($countryEMEA eq "Ireland") or ($countryEMEA eq "United Kingdom"))
	{
			$emailEMEA = 'enquiry@murata.co.uk';
			$optionsEMEA = " assigned to: Murata UK";
			$ccEMEA = ', skunii@murata.nl, hluedeke@murata.de, pmolteni@murata.eu';
	}
	elsif(($countryEMEA eq "Liechtenstein") or ($countryEMEA eq "Switzerland"))
	{
			$emailEMEA = 'info@murata.ch';
			$optionsEMEA = " assigned to: Murata CH";
			$ccEMEA = ', skunii@murata.nl, hluedeke@murata.de, pmolteni@murata.eu';
	}
	elsif(($countryEMEA eq "Angola") or ($countryEMEA eq "Austria") or ($countryEMEA eq "Bahrain") or ($countryEMEA eq "Benin") or ($countryEMEA eq "Botswana") or ($countryEMEA eq "Bulgaria") or ($countryEMEA eq "Burkina Faso") or ($countryEMEA eq "Burundi") or ($countryEMEA eq "Cameroon") or ($countryEMEA eq "Central African Republic") or ($countryEMEA eq "Chad") or ($countryEMEA eq "Czech Republic") or ($countryEMEA eq "Denmark") or ($countryEMEA eq "Djibouti") or ($countryEMEA eq "Egypt") or ($countryEMEA eq "Equatorial Guinea") or ($countryEMEA eq "Eritrea") or ($countryEMEA eq "Ethiopia") or ($countryEMEA eq "Gabon") or ($countryEMEA eq "Gambia") or ($countryEMEA eq "Germany") or ($countryEMEA eq "Ghana") or ($countryEMEA eq "Guinea") or ($countryEMEA eq "Guinea-Bissau") or ($countryEMEA eq "Hungary") or ($countryEMEA eq "Iran") or ($countryEMEA eq "Iraq") or ($countryEMEA eq "Ivory Coast") or ($countryEMEA eq "Jordan") or ($countryEMEA eq "Kenya") or ($countryEMEA eq "Kuwait") or ($countryEMEA eq "Lebanon") or ($countryEMEA eq "Lesotho") or ($countryEMEA eq "Liberia") or ($countryEMEA eq "Libya") or ($countryEMEA eq "Madagascar") or ($countryEMEA eq "Malawi") or ($countryEMEA eq "Mali") or ($countryEMEA eq "Mauritania") or ($countryEMEA eq "Mozambique") or ($countryEMEA eq "Namibia") or ($countryEMEA eq "Niger") or ($countryEMEA eq "Nigeria") or ($countryEMEA eq "Oman") or ($countryEMEA eq "Poland") or ($countryEMEA eq "Qatar") or ($countryEMEA eq "Romania") or ($countryEMEA eq "Rwanda") or ($countryEMEA eq "Saudi Arabia") or ($countryEMEA eq "Senegal") or ($countryEMEA eq "Sierra Leone") or ($countryEMEA eq "Slovakia") or ($countryEMEA eq "Somalia") or ($countryEMEA eq "Sudan") or ($countryEMEA eq "Swaziland") or ($countryEMEA eq "Syria") or ($countryEMEA eq "Tanzania, United Republic of ") or ($countryEMEA eq "Togo") or ($countryEMEA eq "Uganda") or ($countryEMEA eq "United Arab Emirates") or ($countryEMEA eq "Western Sahara") or ($countryEMEA eq "Yemen") or ($countryEMEA eq "Zaire") or ($countryEMEA eq "Zambia") or ($countryEMEA eq "Zimbabwe"))
	{
			$emailEMEA = 'info@murata.de';
			$optionsEMEA = " assigned to: Murata DE";
			$ccEMEA = ', skunii@murata.nl, hluedeke@murata.de, pmolteni@murata.eu';
	}
	elsif(($countryEMEA eq "Algeria") or ($countryEMEA eq "Belgium") or ($countryEMEA eq "Congo, The Democratic Republic of the") or ($countryEMEA eq "France") or ($countryEMEA eq "Gibraltar") or ($countryEMEA eq "Monaco") or ($countryEMEA eq "Morocco") or ($countryEMEA eq "Tunisia"))
	{
			$emailEMEA = 'info@murata.fr';
			$optionsEMEA = " assigned to: Murata FR";
			$ccEMEA = ', skunii@murata.nl, hluedeke@murata.de, pmolteni@murata.eu';
	}
	elsif(($countryEMEA eq "Andorra") or ($countryEMEA eq "Armenia") or ($countryEMEA eq "Azerbaijan") or ($countryEMEA eq "Belarus") or ($countryEMEA eq "Estonia") or ($countryEMEA eq "Finland") or ($countryEMEA eq "Georgia") or ($countryEMEA eq "Iceland") or ($countryEMEA eq "Israel") or ($countryEMEA eq "Kazakhstan") or ($countryEMEA eq "Kirghizia (Kyrgyzstan)") or ($countryEMEA eq "Latvia") or ($countryEMEA eq "Lithuania") or ($countryEMEA eq "Luxembourg") or ($countryEMEA eq "Moldova") or ($countryEMEA eq "Netherlands") or ($countryEMEA eq "Norway") or ($countryEMEA eq "Portugal") or ($countryEMEA eq "Russia") or ($countryEMEA eq "South Africa") or ($countryEMEA eq "Spain") or ($countryEMEA eq "Sweden") or ($countryEMEA eq "Tadzhikistan") or ($countryEMEA eq "Turkmenistan") or ($countryEMEA eq "Ukraine") or ($countryEMEA eq "Uzbekistan"))
	{
			$emailEMEA = 'info@murata.nl';
			$optionsEMEA = " assigned to: Murata NL";
			$ccEMEA = ', skunii@murata.nl, hluedeke@murata.de, pmolteni@murata.eu';
	}
	elsif(($countryEMEA eq "Albania") or ($countryEMEA eq "Bosnia and Herzegovina") or ($countryEMEA eq "Croatia") or ($countryEMEA eq "Cyprus") or ($countryEMEA eq "Greece") or ($countryEMEA eq "Italy") or ($countryEMEA eq "Macedonia") or ($countryEMEA eq "Malta") or ($countryEMEA eq "Montenegro") or ($countryEMEA eq "Serbia") or ($countryEMEA eq "Slovenia") or ($countryEMEA eq "Turkey") or ($countryEMEA eq "Yugoslavia, Federal Republic of"))
	{
			$emailEMEA = 'abrivio@murata.it';
			$optionsEMEA = " assigned to: Murata IT";
			$ccEMEA = ', skunii@murata.nl, hluedeke@murata.de, pmolteni@murata.eu';
	}
	return($emailEMEA, $optionsEMEA, $ccEMEA);
}
#################################################################################
#*****      MailFormsASIA()    Website Form Mail for Reps
#*****      2011-04-23        v0.2.0	Routing
#################################################################################
sub MailFormsASIA{
   my($countryASIA) = @_;
   my($emailASIA) = '';
   my($optionsASIA) = '';
   my($ccASIA) = '';
	if($countryASIA eq "Korea")
	{
		$emailASIA = 'nakor@murata.co.jp';
		$optionsASIA = " assigned to: YJ Yang";
		$ccASIA = ', paul.jap@murata-ps.com';
	}
	elsif ($countryASIA eq "Taiwan" )
	{
		$emailASIA = 'daniel.wu@mail.murata.com.tw';
		$optionsASIA = " assigned to: Daniel Wu";
		$ccASIA = ', paul.jap@murata-ps.com';
	}
	elsif(($countryASIA eq "China") or ($countryASIA eq "Hong Kong") or ($countryASIA eq "Macau"))
	{
			$emailASIA = 'oliverxie@sz.murata.com.cn, peterfu@sz.murata.com.cn';
			$optionsASIA = " assigned to: Oliver Xie and Peter Fu";
			$ccASIA = ', paul.jap@murata-ps.com';
	}
	elsif(($countryASIA eq "Bangladesh") or ($countryASIA eq "Borneo") or ($countryASIA eq "Brunei") or ($countryASIA eq "Burma (Myanmar)") or ($countryASIA eq "Cambodia") or ($countryASIA eq "East Timor") or ($countryASIA eq "Kampuchea") or ($countryASIA eq "Laos") or ($countryASIA eq "Maldives") or ($countryASIA eq "Mongolia") or ($countryASIA eq "Nepal") or ($countryASIA eq "Sri Lanka") or ($countryASIA eq "India" ) or ($countryASIA eq "Indonesia" ) or ($countryASIA eq "Malaysia" ) or ($countryASIA eq "Pakistan" ) or ($countryASIA eq "Philippines" ) or ($countryASIA eq "Singapore" ) or ($countryASIA eq "Thailand" ) or ($countryASIA eq "Vietnam" ))
	{
			$emailASIA = 'dantan@murata.com.sg';
			$optionsASIA = " assigned to: Dan Tan";
			$ccASIA = ', paul.jap@murata-ps.com';
	}
	elsif(($countryASIA eq "Papua New Guinea") or ($countryASIA eq "Australia" ) or ($countryASIA eq "New Zealand" ))
	{	
			$emailASIA = 'rita.zheng@murata-ps.com';
			$optionsASIA = " assigned to: Rita Zheng";
			$ccASIA = ', paul.jap@murata-ps.com';
	}
	elsif($countryASIA eq "Japan")
	{
			$emailASIA = 'genroku.mizumoto@murata-ps.com, tadashi.hazawa@murata-ps.com, toshiaki.yamashita@murata-ps.com';
			$optionsASIA = " assigned to: Genroku Mizumoto and/or Tadashi Hazawa and/or Toshiaki Yamashita";
			$ccASIA = ', paul.jap@murata-ps.com';
	}
	return($emailASIA, $optionsASIA, $ccASIA);
}

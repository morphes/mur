<?php
//error_reporting (E_ALL ^ E_NOTICE);
error_reporting (0);

////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////BOF: No referal URL////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
if(!$_SERVER['HTTP_REFERER'])
{
			echo "<h1> Error: 500: Form not submitted</h1> (no direct submissions are allowed)";
}
else
{
////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////COF: No referal URL////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

	//declair ver
	$spam						= '';
	$messsage					= '';
	$MailFormsSA				= '';
	$MailFormsSA_cc				= '';
	$MailFormsASM				= '';
	$MailFormsASM_cc			= '';
	$MailFormsREP				= '';
	$MailFormsREP_cc			= '';
	$MailFormsFAE				= '';
	$MailFormsFAE_cc			= '';
	$MailFormsEMEA				= '';
	$MailFormsEMEA_cc			= '';
	$optionsEMEA				= '';
	$MailFormsASIA				= '';
	$MailFormsASIA_cc			= '';
	$optionsASIA				= '';
	
	$row1 						= '';
	$row2 						= '';
	$row3 						= '';
	$row4 						= '';
	$row5 						= '';
	
	$subject					= '';
	$comment 					= '';
	$name						= '';
	$title						= '';
	$company					= '';
	$street						= '';
	$street2					= '';
	$mailstop					= '';
	$city						= '';
	$zip						= '';
	$state						= '';
	$country 					= '';
	$phone						= '';
	$ext						= '';
	$email						= '';
	$newsletter					= '';
	
	$DCDC 						= '';
	$ACDC 						= '';
	$DPM						= '';
	$MAG						= '';
	$ADS						= '';
	$NPI						= '';
	$MAGDB						= '';
	
	$PC104						= '';
	$EOLV						= '';
	$TP							= '';
	$RFID 						= '';
	$CIEF 						= '';
	$ESD 						= '';
	$WIRELESS 					= '';
	$SOUND 						= '';
	$TIMING			 			= '';
	$CTPP 						= '';
	$SENSORS 					= '';
	$RF 						= '';
	$CERAMIC 					= '';
	$HFCCONNECTORS 				= '';
	$MCCAPACITORS 				= '';
	$PCAPACITORS 				= '';
	
	$qty_sample 				= '';
	$part_number 				= '';
	$qty_sample11 				= '';
	$part_number11 				= '';
	$qty_sample21 				= '';
	$part_number21 				= '';
	
	$appl_prog					= '';
	$start_date					= '';
	$annual_use					= '';
	$ts_product 				= '';
	
	$rma_serial					= '';
	$rma_serial11				= '';
	$rma_serial21				= '';
	$rma_serial31				= '';
	$rma_serial41				= '';
	$rma_serial51				= '';
	$rma_product				= '';
	$rma_product11				= '';
	$rma_product21				= '';
	$rma_product31				= '';
	$rma_product41				= '';
	$rma_product51				= '';
	$rma_qty					= '';
	$rma_qty11					= '';
	$rma_qty21					= '';
	$rma_qty31					= '';
	$rma_qty41					= '';
	$rma_qty51					= '';
	
	$qty						= '';
	$product					= '';
	$price						= '';
	$qty11						= '';
	$product11					= '';
	$price11					= '';
	$qty21						= '';
	$product21					= '';
	$price21					= '';
	$qty31						= '';
	$product31					= '';
	$price31					= '';
	$qty41						= '';
	$product41					= '';
	$price41					= '';
	$qty51						= '';
	$product51					= '';
	$price51					= '';
	
	$datasheet					= '';
	$apps						= '';
	
	$mf_catalog_csv				= '';
	$mail_forms_csv_data		= '';
	$contact_info				= '';
	$mail_forms_csv_contact_info= '';
	$catalog 					= '';
	$mf_catalog_csv 			= '';
	$poi 						= '';
	$mf_poi_csv 				= '';
	$sample 					= '';
	$mf_sample_csv 				= '';
	$rfq 						= '';
	$mf_rfq_csv 				= '';
	$tech_support				= '';
	$mf_tech_support_csv 		= '';
	$rma 						= '';
	$mf_rma_csv 				= '';
	$pch_catalog 				= '';
	$mf_pch_catalog_csv 		= '';
	$special					= '';
	$mf_special_csv				= '';
	
	$requestedProductName		= '';
	$productRequested			= '';
	
	//get value
	$row1						= $_POST['row1'];
	$row2						= $_POST['row2'];
	$row3						= $_POST['row3'];
	$row4						= $_POST['row4'];
	$row5						= $_POST['row5'];
	
	$qty_sample 				= $_POST['qty_sample'];
	$part_number 				= $_POST['part_number'];
	$qty_sample11 				= $_POST['qty_sample11'];
	$part_number11				= $_POST['part_number11'];
	$qty_sample21 				= $_POST['qty_sample21'];
	$part_number21 				= $_POST['part_number21'];
	
	$subject					= $_POST['subject'];
	$comment 					= strip_tags(stripslashes(trim($_POST['comment'])));
	//$comment = nl2br($comment);
	
	if(preg_match("/http:/i",$comment) || preg_match("/url=/i",$comment) || preg_match("/link=/i",$comment) || preg_match("/\[/",$comment) || preg_match("/\]/",$comment) || preg_match("/www/i",$comment))
	{
		$spam = "(Possible SPAM) ";
	}
	if(preg_match("/murata-ps\.com/i",$comment))
	{
		$spam = "";
	}
	$name						= $_POST['name'];
	$name						= strip_tags(stripslashes(trim($_POST['name'])));
	$title						= strip_tags(stripslashes(trim($_POST['title'])));
	$company					= strip_tags(stripslashes(trim($_POST['company'])));
	$street						= strip_tags(stripslashes(trim($_POST['street'])));
	$street2					= strip_tags(stripslashes(trim($_POST['street2'])));
	$mailstop					= strip_tags(stripslashes(trim($_POST['mailstop'])));
	$city						= strip_tags(stripslashes(trim($_POST['city'])));
	$zip						= strip_tags(stripslashes(trim($_POST['zip'])));
	$state						= $_POST['state'];
	$country 					= $_POST['country'];
	$phone						= $_POST['phone'];
	$ext						= $_POST['ext'];
	$email						= $_POST['email'];
	$newsletter					= $_POST['newsletter'];
	
	$DCDC 						= $_POST['DCDC'];
	$ACDC 						= $_POST['ACDC'];
	$DPM						= $_POST['DPM'];
	$MAG						= $_POST['MAG'];
	$ADS						= $_POST['ADS'];
	$NPI						= $_POST['NPI'];
	
	$PC104						= $_POST['PC104'];
	$EOLV						= $_POST['EOLV'];
	$TP							= $_POST['TP'];
	$RFID	 					= $_POST['RFID'];
	$CIEF 						= $_POST['CIEF'];
	$ESD 						= $_POST['ESD'];
	$WIRELESS 					= $_POST['WIRELESS'];
	$SOUND	 					= $_POST['SOUND'];
	$TIMING 					= $_POST['TIMING'];
	$CTPP 						= $_POST['CTPP'];
	$SENSORS 					= $_POST['SENSORS'];
	$RF 						= $_POST['RF'];
	$CERAMIC 					= $_POST['CERAMIC'];
	$HFCCONNECTORS	 			= $_POST['HFCCONNECTORS'];
	$MCCAPACITORS 				= $_POST['MCCAPACITORS'];
	$PCAPACITORS 				= $_POST['PCAPACITORS'];
	
	$dcdc_quantity				= strip_tags(stripslashes(trim($_POST['dcdc_quantity'])));	
	$acdc_quantity				= strip_tags(stripslashes(trim($_POST['acdc_quantity'])));
	$dms_quantity				= strip_tags(stripslashes(trim($_POST['dms_quantity'])));
	$ads_quantity				= strip_tags(stripslashes(trim($_POST['ads_quantity'])));
	$mag_quantity				= strip_tags(stripslashes(trim($_POST['mag_quantity'])));
	$npi_quantity				= strip_tags(stripslashes(trim($_POST['npi_quantity'])));
	
	$appl_prog					= strip_tags(stripslashes(trim($_POST['appl_prog'])));
	$start_date					= strip_tags(stripslashes(trim($_POST['start_date'])));
	$annual_use					= strip_tags(stripslashes(trim($_POST['annual_use'])));
	$ts_product					= strip_tags(stripslashes(trim($_POST['ts_product'])));
	
	$rma_serial					= strip_tags(stripslashes(trim($_POST['rma_serial'])));
	$rma_serial11				= strip_tags(stripslashes(trim($_POST['rma_serial11'])));
	$rma_serial21				= strip_tags(stripslashes(trim($_POST['rma_serial21'])));
	$rma_serial31				= strip_tags(stripslashes(trim($_POST['rma_serial31'])));
	$rma_serial41				= strip_tags(stripslashes(trim($_POST['rma_serial41'])));
	$rma_serial51				= strip_tags(stripslashes(trim($_POST['rma_serial51'])));
	$rma_product				= strip_tags(stripslashes(trim($_POST['rma_product'])));
	$rma_product11				= strip_tags(stripslashes(trim($_POST['rma_product11'])));
	$rma_product21				= strip_tags(stripslashes(trim($_POST['rma_product21'])));
	$rma_product31				= strip_tags(stripslashes(trim($_POST['rma_product31'])));
	$rma_product41				= strip_tags(stripslashes(trim($_POST['rma_product41'])));
	$rma_product51				= strip_tags(stripslashes(trim($_POST['rma_product51'])));
	$rma_qty					= strip_tags(stripslashes(trim($_POST['rma_qty'])));
	$rma_qty11					= strip_tags(stripslashes(trim($_POST['rma_qty11'])));
	$rma_qty21					= strip_tags(stripslashes(trim($_POST['rma_qty21'])));
	$rma_qty31					= strip_tags(stripslashes(trim($_POST['rma_qty31'])));
	$rma_qty41					= strip_tags(stripslashes(trim($_POST['rma_qty41'])));
	$rma_qty51					= strip_tags(stripslashes(trim($_POST['rma_qty51'])));
	
	$qty						= strip_tags(stripslashes(trim($_POST['qty'])));
	$product					= strip_tags(stripslashes(trim($_POST['product'])));
	$price						= strip_tags(stripslashes(trim($_POST['price'])));
	$qty11						= strip_tags(stripslashes(trim($_POST['qty11'])));
	$product11					= strip_tags(stripslashes(trim($_POST['product11'])));
	$price11					= strip_tags(stripslashes(trim($_POST['price11'])));
	$qty21						= strip_tags(stripslashes(trim($_POST['qty21'])));
	$product21					= strip_tags(stripslashes(trim($_POST['product21'])));
	$price21					= strip_tags(stripslashes(trim($_POST['price21'])));
	$qty31						= strip_tags(stripslashes(trim($_POST['qty31'])));
	$product31					= strip_tags(stripslashes(trim($_POST['product31'])));
	$price31					= strip_tags(stripslashes(trim($_POST['price31'])));
	$qty41						= strip_tags(stripslashes(trim($_POST['qty41'])));
	$product41					= strip_tags(stripslashes(trim($_POST['product41'])));
	$price41					= strip_tags(stripslashes(trim($_POST['price41'])));
	$qty51						= strip_tags(stripslashes(trim($_POST['qty51'])));
	$product51					= strip_tags(stripslashes(trim($_POST['product51'])));
	$price51					= strip_tags(stripslashes(trim($_POST['price51'])));
	
	$BasePart					= strip_tags(stripslashes(trim($_POST['BasePart'])));
	$Vin						= strip_tags(stripslashes(trim($_POST['Vin'])));
	$Vin1						= strip_tags(stripslashes(trim($_POST['Vin1'])));
	$Vin2						= strip_tags(stripslashes(trim($_POST['Vin2'])));
	$Vout1						= strip_tags(stripslashes(trim($_POST['Vout1'])));
	$Vout2						= strip_tags(stripslashes(trim($_POST['Vout2'])));
	$Vout3						= strip_tags(stripslashes(trim($_POST['Vout3'])));
	$Mout1						= strip_tags(stripslashes(trim($_POST['Mout1'])));
	$Mout2						= strip_tags(stripslashes(trim($_POST['Mout2'])));
	$Mout3						= strip_tags(stripslashes(trim($_POST['Mout3'])));
	$Isolation					= strip_tags(stripslashes(trim($_POST['Isolation'])));
	$IVolts						= strip_tags(stripslashes(trim($_POST['IVolts'])));
	$IVoltage					= strip_tags(stripslashes(trim($_POST['IVoltage'])));
	$Height						= strip_tags(stripslashes(trim($_POST['Height'])));
	$Length						= strip_tags(stripslashes(trim($_POST['Length'])));
	$Width						= strip_tags(stripslashes(trim($_POST['Width'])));
	$Dimension 					= strip_tags(stripslashes(trim($_POST['Dimension'])));
	$HeatSink					= strip_tags(stripslashes(trim($_POST['HeatSink'])));
	$UVLO						= strip_tags(stripslashes(trim($_POST['UVLO'])));
	$OVLO						= strip_tags(stripslashes(trim($_POST['OVLO'])));
	$OCL						= strip_tags(stripslashes(trim($_POST['OCL'])));
	$OSCP						= strip_tags(stripslashes(trim($_POST['OSCP'])));
	$OVP						= strip_tags(stripslashes(trim($_POST['OVP'])));
	$OnOff						= strip_tags(stripslashes(trim($_POST['OnOff'])));
	$Remote						= strip_tags(stripslashes(trim($_POST['Remote'])));
	$SyncF						= strip_tags(stripslashes(trim($_POST['SyncF'])));
	$TShutdown					= strip_tags(stripslashes(trim($_POST['TShutdown'])));
	$LCSharing					= strip_tags(stripslashes(trim($_POST['LCSharing'])));
	$Business					= strip_tags(stripslashes(trim($_POST['Business'])));
	$Program					= strip_tags(stripslashes(trim($_POST['Program'])));
	$eau						= strip_tags(stripslashes(trim($_POST['eau'])));
	$EstYears					= strip_tags(stripslashes(trim($_POST['EstYears'])));
	$TarPrice					= strip_tags(stripslashes(trim($_POST['TarPrice'])));
	$SampMonth					= strip_tags(stripslashes(trim($_POST['SampMonth'])));
	$SampYear					= strip_tags(stripslashes(trim($_POST['SampYear'])));
	$ProdMonth					= strip_tags(stripslashes(trim($_POST['ProdMonth'])));
	$ProdYear					= strip_tags(stripslashes(trim($_POST['ProdYear'])));
	$apps						= $_POST['apps'];
	$datasheet					= $_POST['datasheet'];
	////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////BOF: No State selected/////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	if((($country == 'United States' ) || ($country == 'Canada')) && $state == '')
	{
				echo "<h1> Error: No State / Province provided, Form not submitted</h1>";
	}
	else
	{
	////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////COF: No State selected/////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
		
		////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////// BOF: Minimum Entered /////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////
		if(!$name || !$company || !$street || !$city || !$zip || !$country || !$phone || !$email)
		{
					echo "<h1> Error 600 Form not submitted</h1>(one or more of the required field is missing)";
		}
		else
		{
		////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////// BOF: Minimum Entered /////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////
			
			
			if($datasheet == 1){
				$datasheet = 'Yes';
			}else{
				$datasheet = 'No';
			}
			
			if ($newsletter  == "YES"){
				$newsletter = "YES";
			}else{
				$newsletter = "NO";
			}
			
			$requestedProductName		= strip_tags(stripslashes(trim($_POST['requestedProductName'])));
			$productRequested			= strip_tags(stripslashes(trim($_POST['productRequested'])));
			
			$recipient = '';
			$MailFormsDefault = ', mps.webmaster@murata.com';
			// additional worldwide CC
			//$MailFormsMarketing = ', spimpis@murata.com, skunii@murata.com';
// 2013-11-26 no message monitoring of MPS - per Pimpis request
//			$MailFormsMarketing = ', skunii@murata.com';
			
//			$recipient_cc = $MailFormsDefault . $MailFormsMarketing;
			
			$thankyou = '';
			$eol="\r\n";
			
			$country_subject = array("Albania","Algeria","Andorra","Angola","Australia","Austria","Azerbaijan","Bangladesh","Belarus","Belgium","Canary Islands","Central African Republic","Chad","Channel Islands","China","Corsica","Croatia","Czech Republic","Denmark","Egypt","Estonia","Ethiopia","Finland","France","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Hungary","Iceland","India","Indonesia","Iraq","Ireland","Israel","Italy","Japan","Jordan","Kazakhstan","Kenya","Kyrgystan","Korea","Kuwait","Laos","Latvia","Lebanon","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Madagascar","Madeira Islands","Malaysia","Malta","Mauritius","Monaco","Mongolia","Morocco","Mozambique","Namibia","Nauru","Nepal","Netherlands","Netherlands Antilies","New Zealand","Niger","Nigeria","Northern Ireland","Norway","Oman","Pakistan","Poland","Portugal","Qatar","Rhodesia","Romania","Russia","Rwanda","Saudi Arabia","Scotland","Senegal","Serbia and Montenegro","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Somalia","Somalia Southern Reg","South Africa","Spain","Sri Lanka","Sudan","Swaziland","Sweden","Switzerland","Syria","Tadzhikistan","Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Tunisia","Turkey","Turkmenistan","Uganda","Ukraine","United Arab Emirates","United Kingdom","Uzbekistan","Vatican City","Vietnam","Wales","Zaire","Zambia","Zimbabwe","Armenia","Bulgaria","Cameroon","Congo","Cyprus","Gabon","Gambia","Hong Kong","Macedonia","Moldova","Philippines","Western Sahara","Western Samoa","Yemen");
			
			//*****************************************************************************************
			//	MailFormsREP
			//*****************************************************************************************
			//United States
			$stateREP_arizona = array("","Arizona","New Mexico");
			//arizona@thomlukesales.com
			$stateREP_bgiudice = array("","Indiana","Kentucky","Michigan","Ohio","West Virginia");
			//bgiudice@aemg-reps.com
			$stateREP_colorado = array("","Colorado","Wyoming");
			//colorado@thomlukesales.com
			$stateREP_cwatters = array("","Georgia");
			//cwatters@aemg-reps.com
			$stateREP_Nevada = array("","Nevada");
			$zipREP_nevada = array("","88901","88905","89002","89004","89005","89006","89007","89009","89011","89012","89014","89015","89016","89018","89019","89021","89024","89025","89026","89027","89028","89029","89030","89031","89032","89033","89034","89036","89037","89039","89040","89044","89046","89052","89053","89054","89067","89070","89074","89077","89081","89084","89085","89086","89087","89101","89102","89103","89104","89105","89106","89107","89108","89109","89110","89111","89112","89113","89114","89115","89116","89117","89118","89119","89120","89121","89122","89123","89124","89125","89126","89127","89128","89129","89130","89131","89132","89133","89134","89135","89136","89137","89138","89139","89140","89141","89142","89143","89144","89145","89146","89147","89148","89149","89150","89151","89152","89153","89154","89155","89156","89157","89158","89159","89160","89161","89162","89163","89164","89165","89166","89169","89170","89173","89177","89178","89179","89180","89183","89185","89191","89193","89195","89199");
			
			//arizona@thomlukesales.com
			//else drecht@rechtassociates.com
			//2014-04-28 drecht@rechtassociates.com replaced by jaufang@rechtassociates.com
			
			//kcampbell@mechtronics.net
			$stateREP_kcampbell = array("","Delaware","Maryland","Virginia");
			//lcraft@milltechsales.com
			$stateREP_lcraft = array("","Florida");
			//mikem@rames.com
			$stateREP_mikem = array("","Arkansas","Louisiana","Oklahoma","Texas");
			//paune@stanclothier.com
			$stateREP_paune = array("","Illinois","Iowa","Kansas","Minnesota","Missouri","Nebraska","North Dakota","South Dakota","Wisconsin");
			//sales@westmarkco.com
			$stateREP_sales = array("","Oregon","Washington");
			//sdichiara@ut.com
			$stateREP_sdichiara = array("","Connecticut","Maine","Massachusetts","New Hampshire","Rhode Island","Vermont");
			//sjones@aemg-reps.com
			$stateREP_sjones = array("","Alabama","Mississippi","Tennessee");
			//pkuhl@aemg-reps.com
			$stateREP_pkuhl = array("","North Carolina","South Carolina");
			//utah@thomlukesales.com
			$stateREP_utah = array("","Idaho","Montana","Utah");
			//utah@thomlukesales.com
			$stateREP_skowalski = array("","Hawaii");
			//skowalski@ckassoc.com
			$stateREP_skowalski_CA = array("","California");
			
			//2012-09-04 no longer used
			//$zipREP_skowalski_CA = array("","90001","92327","92329","92382","92385","92386","92391","93199","93205","93206","93215","93216","93224","93226","93240","93241","93249","93255","93283","93285","93301","93242","93427","93449","93451","93510","93518","93519","93523","93524","93527","93528","93531","93539","93543","93544","93550","93599","93203","93220","93222","93238","93243","93263","93268","93276","93280","93287","93516");
			
			//2012-09-04
			$zipREP_skowalski_CA_one	= range(90001,92327);
			$zipREP_skowalski_CA_two	= range(92329,92382);
			$zipREP_skowalski_CA_thr	= range(92385,92386);
			$zipREP_skowalski_CA_fou	= range(92391,93199);
			$zipREP_skowalski_CA_fiv	= range(93205,93206);
			$zipREP_skowalski_CA_six	= range(93215,93216);
			$zipREP_skowalski_CA_sev	= range(93224,93226);
			$zipREP_skowalski_CA_eig	= range(93240,93241);
			$zipREP_skowalski_CA_nin	= range(93249,93255);
			$zipREP_skowalski_CA_ten	= range(93283,93285);
			$zipREP_skowalski_CA_tenone	= range(93301,93242);
			$zipREP_skowalski_CA_tentwo	= range(93427,93449);
			$zipREP_skowalski_CA_tenrhr	= range(93451,93510);
			$zipREP_skowalski_CA_tenfou	= range(93518,93519);
			$zipREP_skowalski_CA_tenfiv	= range(93523,93524);
			$zipREP_skowalski_CA_tensix	= range(93527,93528);
			$zipREP_skowalski_CA_tensev	= range(93531,93539);
			$zipREP_skowalski_CA_teneig	= range(93543,93544);
			$zipREP_skowalski_CA_tennin	= range(93550,93599);
			$zipREP_skowalski_CA_twe	= array("","93203","93220","93222","93238","93243","93263","93268","93276","93280","93287","93516","93516");
			
			//skowalski@ckassoc.com
			//2012-09-04 no longer used
			//$zipREP_rechtassociates_CA = array("","93201","93202","93207","93212","93218","93219","93227","93237","93244","93247","93256","93262","93265","93267","93270","93275","93277","93279","93290","93292","93512","93515","93529","93530","93541","93542","93545","93549","93601","96162","92328","92384","92389","93204","93221","93223","93239","93242","93282","93286","93246","93450","93517","93522","93526");
			
			//2012-09-04
			$zipREP_rechtassociates_CA_one		= range(93201,93202);
			$zipREP_rechtassociates_CA_two		= range(93207,93212);
			$zipREP_rechtassociates_CA_thr		= range(93218,93219);
			$zipREP_rechtassociates_CA_fou		= range(93227,93237);
			$zipREP_rechtassociates_CA_fiv		= range(93244,93247);
			$zipREP_rechtassociates_CA_six		= range(93256,93262);
			$zipREP_rechtassociates_CA_sev		= range(93265,93267);
			$zipREP_rechtassociates_CA_nin		= range(93270,93275);
			$zipREP_rechtassociates_CA_ten		= range(93277,93279);
			$zipREP_rechtassociates_CA_tenone	= range(93290,93292);
			$zipREP_rechtassociates_CA_tentwo	= range(93512,93515);
			$zipREP_rechtassociates_CA_tenthr	= range(93529,93530);
			$zipREP_rechtassociates_CA_tenfou	= range(93541,93542);
			$zipREP_rechtassociates_CA_tenfiv	= range(93545,93549);
			$zipREP_rechtassociates_CA_tensix	= range(93601,96162);
			$zipREP_rechtassociates_CA_tensev	= array("","92328","92384","92389","93204","93221","93223","93239","93242","93282","93286","93246","93450","93517","93522","93526");
			
			//drecht@rechtassociates.com
			//else skowalski@ckassoc.com, drecht@rechtassociates.com
			//2014-04-28 drecht@rechtassociates.com replaced by jaufang@rechtassociates.com
			$stateREP_carol = array("","New Jersey");
			$zipREP_carol_NJ    = range(7000,7999);
			$zipREP_carol_NJtwo = range(8800,8999);
			
			//carol@gsatech.com
			$zipREP_kcampbell_NJ = range(8000,8799);
			//kcampbell@mechtronics.net
			//else carol@gsatech.com, kcampbell@mechtronics.net
			$stateREP_cfisher = array("","New York");
			$zipREP_cfisher = range(12000,14999);
			//cfisher@gmarep.com
			$zipREP_carol = range(10001,11999);
			//carol@gsatech.com
			//else carol@gsatech.com, cfisher@gmarep.com
			$stateREP_bgiudice_PA = array("","Pennsylvania");
			$zipREP_bgiudice_PA = range(15001,16751);
			//bgiudice@aemg-reps.com
			$zipREP_kcampbell_PA = range(16801,19640);
			//kcampbell@mechtronics.net
			//else bgiudice@aemg-reps.com, kcampbell@mechtronics.net
			
			//*** Canada ****************************************************************
			$stateREP_CA_gmaleads = array("","Alberta","British Columbia","Manitoba","Northwest Territories","Nunavut","Saskatchewan","Yukon Territory");
			//gmaleads@gmarep.com
			$stateREP_CA_sterling = array("","New Brunswick","Newfoundland and Labrador","Nova Scotia","Ontario","Prince Edward Island","Quebec");
			//sterling@gmarep.com
			
			//else sterling@gmarep.com, gmaleads@gmarep.com
			
			//United States
			//Area 1
			$stateASM_akillen = array("","Connecticut","Delaware","Maine","Maryland","Massachusetts","New Hampshire","New Jersey","Rhode Island","Vermont","Virginia","West Virginia");
			//akillen@murata.com
			
			//Area 2
			$stateASM_mrucker = array("","Alabama","Florida","Georgia","Indiana","Kentucky","Michigan","Mississippi","North Carolina","Ohio","South Carolina","Tennessee");
			//mrucker@murata.com
			
			//Area 3
			$stateASM_dkenneth = array("","Illinois","Iowa","Kansas","Minnesota","Missouri","Nebraska","North Dakota","Ohio","South Dakota","Wisconsin");
			//dkenneth@murata.com
			
			//Area 4
			$stateASM_rboyd = array("","Arizona","Arkansas","Colorado","Louisiana","Montana","New Mexico","Oklahoma","Texas","Utah","Wyoming");
			//rboyd@murata.com
			
			//Area 5
			$stateASM_kblake = array("","Alaska","Idaho","Nevada","Oregon","Washington");
			//kblake@murata.com
			
			//Area 6
			$stateASM_mterai = array("","Hawaii");
			//mterai@murata.com
			
			$stateASM_kblake_mterai = array("","California");
			
			//NY split between dkenneth and akillen
			$stateASM_NY = array("","New York");
			//dkenneth@murata.com
			//akillen@murata.com
			
			$stateASM_PA = array("","Pennsylvania");
			//Pennsylvania - mrucker@murata.com and or akillen@murata.com
			
			//Canada
			$stateASM_CA_dkenneth = array("","New Brunswick","Newfoundland and Labrador","Nova Scotia","Ontario","Prince Edward Island","Quebec");
			//akillen@murata.com
			//2012-05-10
			$stateASM_CA_kblake = array("","Alberta","British Columbia","Manitoba","Northwest Territories","Nunavut","Saskatchewan","Yukon Territory");
			//kblake@murata.com
			
			//United States
			
			$stateFAE_thashimoto = array("","Alaska","Arizona","Arkansas","California","Colorado","Hawaii","Idaho","Montana","Nevada","New Mexico","Oregon","Utah","Washington","Wyoming");
			
			$stateTSM_mbral = array("","Arizona","Colorado","Montana","Nevada","New Mexico","Utah","Wyoming");
			
			//United States
			$stateFAE_rjungling = array("","Alabama","Connecticut",	"Delaware","Florida","Georgia","Illinois","Iowa","Indiana","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Nebraska","New Hampshire","New Jersey","New York","North Carolina","North Dakota","Ohio","Oklahoma","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Vermont","Virginia","West Virginia","Wisconsin");
			
			$stateTSM_dlongden = array("","Connecticut","Delaware","Maine","Maryland","Massachusetts","New Hampshire","New Jersey","New York","Rhode Island","Vermont","Virginia","West Virginia");
			// 2014-07-31 dlonden is not assigned to North Carolina, South Carolina > asigned to David Montenegro 
			$stateTSM_dmontenegro = array("","Alabama","Florida","Georgia","Louisiana","Mississippi","North Carolina","Oklahoma","South Carolina","Tennessee","Texas");
			
			// states that have no TSM/TSA
			$stateTSM_none = array("","Illinois","Iowa","Kansas","Minnesota","Missouri","Nebraska","North Dakota","South Dakota","Wisconsin");
			//2014-01-28 placing new Technical Sales Engineer in the CC
			// once moved into the to line, will require clean up of other TSE/TSM
			// Indiana, Kentucky, Michigan, Ohio, Pennsylvania
			
			// 2014-07-31 dlongdon is not assigned to Indiana, Kentucky, Michigan, Ohio, West Pennsylvania > assign to aswartz
			$stateTSE_aswartz_to = array("","Indiana","Kentucky","Michigan","Ohio","Pennsylvania");
			
			$stateTSE_aswartz_cc = array("","Illinois","Iowa","Kansas","Minnesota","Missouri","Nebraska","North Dakota","South Dakota","Wisconsin");
			//Canada
			//2012-05-10
			$stateFAE_CA_thashimoto = array("","Alberta","British Columbia","Manitoba","Northwest Territories","Nunavut","Saskatchewan","Yukon Territory");
			//Canada
			$stateFAE_CA_rjungling	= array("","New Brunswick","Newfoundland and Labrador","Nova Scotia","Ontario","Prince Edward Island","Quebec");
			$stateTSM_CA_dlongden	= array("","New Brunswick","Newfoundland and Labrador","Nova Scotia","Ontario","Prince Edward Island","Quebec");
			
			switch ($country){
			case "United States":
			if($key = array_search($_POST['state'], $stateREP_arizona)){
				$MailFormsREP = $recipient = ", arizona@thomlukesales.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_bgiudice)){
				$MailFormsREP = $recipient = ", bgiudice@aemg-reps.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_colorado)){
				$MailFormsREP = $recipient = ", colorado@thomlukesales.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_cwatters)){
				$MailFormsREP = $recipient = ", cwatters@aemg-reps.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_Nevada)){
				if($key = array_search($_POST['zip'], $zipREP_nevada)){
					$MailFormsREP = $recipient = ", arizona@thomlukesales.com";
				}else{
					$MailFormsREP = $recipient = ", jaufang@rechtassociates.com";
				}
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_kcampbell)){
//2013-11-26 per David Longodon request to remove kcampbell@mechtronics.net
//				$MailFormsREP = $recipient = ", kcampbell@mechtronics.net, kchristian@mechtronics.net";
				$MailFormsREP = $recipient = ", kchristian@mechtronics.net";

			}
			
			elseif($key = array_search($_POST['state'], $stateREP_lcraft)){
				$MailFormsREP = $recipient = ", lcraft@milltechsales.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_mikem)){
				$MailFormsREP = $recipient = ", mikem@rames.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_paune)){
				$MailFormsREP = $recipient = ", paune@stanclothier.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_sales)){
				$MailFormsREP = $recipient = ", sales@westmarkco.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_sdichiara)){
				$MailFormsREP = $recipient = ", sdichiara@ut.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_sjones)){
				$MailFormsREP = $recipient = ", sjones@aemg-reps.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_pkuhl)){
				$MailFormsREP = $recipient = ", pkuhl@aemg-reps.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_utah)){
				$MailFormsREP = $recipient = ", utah@thomlukesales.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_skowalski)){
				$MailFormsREP = $recipient = ", skowalski@ckassoc.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_skowalski_CA)){
			//	if($key = array_search($_POST['zip'], $zipREP_skowalski_CA)){
			//2012-09-04
				if($key = array_search($_POST['zip'], $zipREP_skowalski_CA_one) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_two) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_thr) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_fou) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_fiv) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_six) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_sev) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_eig) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_nin) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_ten) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tenone) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tentwo) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tenrhr) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tenfou) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tenfiv) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tensix) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tensev) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_teneig) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_tennin) || 
					$key = array_search($_POST['zip'], $zipREP_skowalski_CA_twe)){
					$MailFormsREP = $recipient = ", skowalski@ckassoc.com";
			//	}elseif ($key = array_search($_POST['zip'], $zipREP_rechtassociates_CA)){
			//2012-09-04
				}elseif ($key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_one) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_two) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_thr) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_fou) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_fiv) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_six) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_sev) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_nin) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_ten) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tenone) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tentwo) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tenthr) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tenfou) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tenfiv) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tensix) ||
					$key = array_search($_POST['zip'], $zipREP_rechtassociates_CA_tensev)){
					$MailFormsREP = $recipient = ", jaufang@rechtassociates.com";
				}
				else{
					$MailFormsREP = $recipient = ", skowalski@ckassoc.com, jaufang@rechtassociates.com";
				}
			}
			elseif($key = array_search($_POST['state'], $stateREP_carol)){
				if($key = array_search($_POST['zip'], $zipREP_carol_NJ) || $key = array_search($_POST['zip'], $zipREP_carol_NJtwo)){
					$MailFormsREP = $recipient = ", carol@gsatech.com";
				}elseif($key = array_search($_POST['zip'], $zipREP_kcampbell_NJ)){
					$MailFormsREP = $recipient = ", kcampbell@mechtronics.net, kchristian@mechtronics.net";
				}else{
					$MailFormsREP = $recipient = ", carol@gsatech.com, kcampbell@mechtronics.net, kchristian@mechtronics.net";
				}
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_cfisher)){
				if($key = array_search($_POST['zip'], $zipREP_cfisher)){
					$MailFormsREP = $recipient = ", cfisher@gmarep.com";
				}elseif($key = array_search($_POST['zip'], $zipREP_carol)){
					$MailFormsREP = $recipient = ", carol@gsatech.com";
				}else{
					$MailFormsREP = $recipient = ", carol@gsatech.com, cfisher@gmarep.com";
				}
			}
			
			elseif($key = array_search($_POST['state'], $stateREP_bgiudice_PA)){
				if($key = array_search($_POST['zip'], $zipREP_bgiudice_PA)){
					$MailFormsREP = $recipient = ", bgiudice@aemg-reps.com";
				}elseif($key = array_search($_POST['zip'], $zipREP_kcampbell_PA)){
					$MailFormsREP = $recipient = ", kcampbell@mechtronics.net, kchristian@mechtronics.net";
				}else{
					$MailFormsREP = $recipient = ", bgiudice@aemg-reps.com, kcampbell@mechtronics.net, kchristian@mechtronics.net";	
				}
			}
			else{
				$MailFormsASM = $recipient = $MailFormsDefault;
			}
			
			//Area 1
			if($key = array_search($_POST['state'], $stateASM_akillen)){
				$MailFormsASM = $recipient = ", akillen@murata.com";
			}
			
			//Area 2
			elseif($key = array_search($_POST['state'], $stateASM_mrucker)){
				$MailFormsASM = $recipient = ", mrucker@murata.com";
			}
			
			//Area 3
			elseif($key = array_search($_POST['state'], $stateASM_dkenneth)){
				$MailFormsASM = $recipient = ", dkenneth@murata.com";
			}

			//Area 4
			elseif($key = array_search($_POST['state'], $stateASM_rboyd)){
				$MailFormsASM = $recipient = ", rboyd@murata.com";
			}
			
			//Area 5
			elseif($key = array_search($_POST['state'], $stateASM_kblake)){
				$MailFormsASM = $recipient = ", kblake@murata.com";
			}
			
			//Area 6
			elseif($key = array_search($_POST['state'], $stateASM_mterai)){
				$MailFormsASM = $recipient = ", mterai@murata.com";
			}
			
			//Area 5+6
			elseif($key = array_search($_POST['state'], $stateASM_kblake_mterai)){
				$MailFormsASM = $recipient = ", mterai@murata.com, kblake@murata.com";
			}
			
			elseif($key = array_search($_POST['state'], $stateASM_PA)){
				if(($_POST['zip'] >= 15001) and ($_POST['zip'] <= 16751))
					{
						$MailFormsASM = $recipient = ", mrucker@murata.com";
					}
				elseif(($_POST['zip'] >= 16801) and ($_POST['zip'] <= 19640))
					{
						$MailFormsASM = $recipient = ", akillen@murata.com";
					}
				else
					{
						$MailFormsASM = $recipient = ", mrucker@murata.com, akillen@murata.com";
					}
			}
			
			elseif($key = array_search($_POST['state'], $stateASM_NY)){
				if(($_POST['zip'] >= 10001) and ($_POST['zip'] <= 11999))
					{
						$MailFormsASM = $recipient = ", akillen@murata.com";
						//carol@gsatech.com
					}
				elseif(($_POST['zip'] >= 12000) and ($_POST['zip'] <= 14999))
					{
						$MailFormsASM = $recipient = ", dkenneth@murata.com";
						//cfisher@gmarep.com
					}
				else
					{
						$MailFormsASM = $recipient = ", akillen@murata.com, dkenneth@murata.com";
					}
			}
			
//			elseif($key = array_search($_POST['state'], $stateASM_Nevada)){
//				if($key = array_search($_POST['zip'], $zipASM_nevada)){
//					$MailFormsASM = $recipient = ", pscarbo@murata.com";
//				}else{
//					$MailFormsASM = $recipient = ", kblake@murata.com";
//				}
//			}
			
			else{
				$MailFormsASM = $recipient = $MailFormsDefault;
			}
			
			
			if($key = array_search($_POST['state'], $stateFAE_thashimoto))
				{
					$MailFormsFAE = $recipient = ", tomoaki.hashimoto@murata.com, mschiano@murata.com,";
					//New TSM CC 2012-10-05
					if($key = array_search($_POST['state'], $stateTSM_mbral))
					{
						$MailFormsFAE_cc = ", mbral@murata.com";
					}
			}
			//from 6/28 to 7/16/2012
			//if($key = array_search($_POST['state'], $stateFAE_rkowssari)){
			//	$MailFormsFAE = $recipient = ", rjungling@murata.com";
			//	$recipient_cc .= ', rkowssari@murata.com';
			//}
			
			
			//elseif($key = array_search($_POST['state'], $stateFAE_rjungling)){
			//	$MailFormsFAE = $recipient = ", rjungling@murata.com";
			//}
			elseif($key = array_search($_POST['state'], $stateFAE_rjungling)){
				if($key = array_search($_POST['state'], $stateTSM_dlongden))
				{
					$MailFormsFAE = ", dlongden@murata.com";
					$MailFormsFAE_cc = ", rjungling@murata.com";
				}
				elseif($key = array_search($_POST['state'], $stateTSM_dmontenegro))
				{
					$MailFormsFAE = ", dmontenegro@murata.com";
					$MailFormsFAE_cc = ", rjungling@murata.com";
				}
				elseif($key = array_search($_POST['state'], $stateTSE_aswartz_to))
				{
					$MailFormsFAE = ", aswartz@murata.com";
					$MailFormsFAE_cc = ", rjungling@murata.com";
				}
				else
				{
					$MailFormsFAE = ", rjungling@murata.com";
				}
				if($key = array_search($_POST['state'], $stateTSE_aswartz_cc))
					{
						$MailFormsFAE_cc .= ", aswartz@murata.com";
					}
			}
			else{
				$MailFormsASM = $recipient = $MailFormsDefault;
			}
			break;
			
			//*** Canada ***********************************************************
			case "Canada":
			//MailFormsREP
			if($key = array_search($_POST['state'], $stateREP_CA_gmaleads)){
				$MailFormsREP = $recipient = ", gmaleads@gmarep.com";
			}
			if($key = array_search($_POST['state'], $stateREP_CA_sterling)){
				$MailFormsREP = $recipient = ", sterling@gmarep.com";
			}
			if(empty($MailFormsREP)){
				$MailFormsREP = $recipient = ", sterling@gmarep.com, gmaleads@gmarep.com";
			}
			
			//	MailFormsFAE
			
			
			if($key = array_search($_POST['state'], $stateFAE_CA_thashimoto)){
				$MailFormsFAE = $recipient = ", tomoaki.hashimoto@murata.com, mschiano@murata.com,";
			}
			//from 6/28 to 7/16/2012
			//if($key = array_search($_POST['state'], $stateFAE_CA_rkowssari)){
			//	$MailFormsFAE = $recipient = ", rjungling@murata.com";
			//	$recipient_cc .= ', rkowssari@murata.com';
			//}
			
			//if($key = array_search($_POST['state'], $stateFAE_CA_rjungling)){
			//	$MailFormsFAE = $recipient = ", rjungling@murata.com";
			//}
			if($key = array_search($_POST['state'], $stateFAE_CA_rjungling)){
				if($key = array_search($_POST['state'], $stateTSM_CA_dlongden)){
					$MailFormsFAE = ", dlongden@murata.com";
					$MailFormsFAE_cc = ", rjungling@murata.com";
				}
				else
				{
					$MailFormsFAE = ", rjungling@murata.com";
				}
			}
			if(empty($MailFormsFAE)){
				$MailFormsFAE = $recipient = ", tomoaki.hashimoto@murata.com, mschiano@murata.com, rjungling@murata.com";
			}
			
			//$recipient = $MailFormsFAE;
			
			//MailFormsASM
			if($key = array_search($_POST['state'], $stateASM_CA_dkenneth)){
				$MailFormsASM = $recipient = ", dkenneth@murata.com";
			}
			if($key = array_search($_POST['state'], $stateASM_CA_kblake)){
				$MailFormsASM = $recipient = ", kblake@murata.com";
			}
			if(empty($MailFormsASM)){
				$MailFormsASM = $recipient = ", kblake@murata.com, akillen@murata.com";
			}
			//$recipient = $MailFormsASM;
			break;
			
			case "Puerto Rico":
				$recipient = ", mrucker@murata.com, rjungling@murata.com, dmontenegro@murata.com";
				$optionsEMEA = $options .= " assigned to: Puerto Rico TBD";
			break;
			
			case "Ireland":
			case "United Kingdom":
				$MailFormsEMEA = $recipient = ', enquiry@murata.co.uk';
				$MailFormsEMEA_cc = ', hluedeke@murata.com, pmolteni@murata.com';
				$optionsEMEA = $options .= " assigned to: Murata UK";
			break;
			
			case "Liechtenstein":
			case "Switzerland":
				$MailFormsEMEA = $recipient = ', info@murata.ch';
				$MailFormsEMEA_cc = ', hluedeke@murata.com, pmolteni@murata.com';
				$optionsEMEA = $options .= " assigned to: Murata CH";
			break;
			
			case "Angola":
			case "Austria":
			case "Bahrain":
			case "Benin":
			case "Botswana":
			case "Bulgaria":
			case "Burkina Faso":
			case "Burundi":
			case "Cameroon":
			case "Central African Republic":
			case "Chad":
			case "Czech Republic":
			case "Denmark":
			case "Djibouti":
			case "Egypt":
			case "Equatorial Guinea":
			case "Eritrea":
			case "Ethiopia":
			case "Gabon":
			case "Gambia":
			case "Germany":
			case "Ghana":
			case "Guinea":
			case "Guinea-Bissau":
			case "Hungary":
			case "Iran":
			case "Iraq":
			case "Ivory Coast":
			case "Jordan":
			case "Kenya":
			case "Kuwait":
			case "Lebanon":
			case "Lesotho":
			case "Liberia":
			case "Libya":
			case "Madagascar":
			case "Malawi":
			case "Mali":
			case "Mauritania":
			case "Mozambique":
			case "Namibia":
			case "Niger":
			case "Nigeria":
			case "Oman":
			case "Poland":
			case "Qatar":
			case "Romania":
			case "Rwanda":
			case "Saudi Arabia":
			case "Senegal":
			case "Sierra Leone":
			case "Slovakia":
			case "Somalia":
			case "Sudan":
			case "Swaziland":
			case "Syria":
			case "Tanzania, United Republic of":
			case "Togo":
			case "Uganda":
			case "United Arab Emirates":
			case "Western Sahara":
			case "Yemen":
			case "Zaire":
			case "Zambia":
			case "Zimbabwe":
				$MailFormsEMEA = $recipient = ', info@murata.de';
				$MailFormsEMEA_cc = ', hluedeke@murata.com, pmolteni@murata.com';
				$optionsEMEA = $options .= " assigned to: Murata DE";
			break;
			
			case "Algeria":
			case "Belgium":
			case "Congo":
			case "France":
			case "Gibraltar":
			case "Monaco":
			case "Morocco":
			case "Tunisia":
				$MailFormsEMEA = $recipient = ', info@murata.fr';
				$MailFormsEMEA_cc = ', hluedeke@murata.com, pmolteni@murata.com';
				$optionsEMEA = $options .= " assigned to: Murata FR";
			break;
			
			case "Andorra":
			case "Armenia":
			case "Azerbaijan":
			case "Belarus":
			case "Estonia":
			case "Finland":
			case "Georgia":
			case "Iceland":
			case "Israel":
			case "Kazakhstan":
			case "Kyrgyzstan":
			case "Latvia":
			case "Lithuania":
			case "Luxembourg":
			case "Moldova":
			case "Netherlands":
			case "Norway":
			case "Russia":
			case "South Africa":
			case "Sweden":
			case "Tadzhikistan":
			case "Turkmenistan":
			case "Ukraine":
			case "Uzbekistan":
				$MailFormsEMEA = $recipient = ', info@murata.nl';
				$MailFormsEMEA_cc = ', hluedeke@murata.com, pmolteni@murata.com';
				$optionsEMEA = $options .= " assigned to: Murata NL";
			break;
			
			case "Albania":
			case "Bosnia and Herzegovina":
			case "Croatia":
			case "Cyprus":
			case "Greece":
			case "Italy":
			case "Macedonia":
			case "Malta":
			case "Montenegro":
			case "Portugal":
			case "Serbia":
			case "Slovenia":
			case "Spain":
			case "Turkey":
			case "Yugoslavia":
					$MailFormsEMEA = $recipient = ', abrivio@murata.com';
					$MailFormsEMEA_cc = ', hluedeke@murata.com, pmolteni@murata.com';
					$optionsEMEA = $options .= " assigned to: Murata IT";
			break;
			
			case "Korea":
					$MailFormsASIA = $recipient = ', hyojin.cho＠murata.com';
					$optionsASIA = $options .= " assigned to: Hyo-Jin CHO";
			break;
			
			case "Taiwan":
					$MailFormsASIA = $recipient = ', Daniel.Wu@murata.com';
					$optionsASIA = $options .= " assigned to: Daniel Wu";
			break;
			
			case "China":
			case "Hong Kong":
			case "Macau":
					$MailFormsASIA = $recipient = ', peter.fu@murata.com';
					$optionsASIA = $options .= " assigned to: Peter Fu";
			break;
			
			case "Papua New Guinea":
			case "Australia":
			case "New Zealand":
					$MailFormsASIA = $recipient = ', ssano_takamichi@murata.com';
					$recipient_cc .= ', fusami_yoshikawa@murata.com';
					$optionsASIA = $options .= " assigned to: Sano Takamichi";
			break;
			
			
			case "Bangladesh":
			case "Borneo":
			case "Brunei":
			case "Burma":
			case "Myanmar":
			case "Cambodia":
			case "East Timor":
			case "Kampuchea":
			case "Laos":
			case "Maldives":
			case "Mongolia":
			case "Nepal":
			case "Sri Lanka":
			case "India":
			case "Indonesia":
			case "Malaysia":
			case "Pakistan":
			case "Philippines":
			case "Singapore":
			case "Thailand":
			case "Vietnam":
				$MailFormsASIA = $recipient = ', georgina.lim@murata.com';
				$recipient_cc .= ', takeshi.koyama@murata.com, laypin.peh@murata.com, dan.tan@murata.com';
				$optionsASIA = $options .= " assigned to: Georgina Lim Cher Mui";
			break;
			
			case "Japan":
				$MailFormsASIA = $recipient = ', atsushi.gommori@murata.com';
				$recipient_cc .= ', takahiro.nonaka@murata.com, sachiko.ishikawa@murata.com';
				$optionsASIA = $options .= " assigned to: Art Gommori";
			break;
			
			case "Argentina":
			case "Bolivia":
			case "Brazil":
			case "Chile":
			case "Colombia":
			case "Ecuador":
			case "French Guiana":
			case "Guyana":
			case "Paraguay":
			case "Peru":
			case "South Georgia and the South Sandwich Islands":
			case "Suriname":
			case "Uruguay":
			case "Venezuela":
					$MailFormsSA = $recipient = ', werlinton.kanashiro@murata.com';
					$options .= " assigned to: Werlinton Kanashiro";
			break;
			
			case "Belice":
			case "Costa Rica":
			case "El Salvador":
			case "Guatemala":
			case "Honduras":
			case "Mexico":
			case "Nicaragua":
			case "Panama":
					$MailFormsSA = $recipient = ', hflores@murata.com';
					$options .= " assigned to: Horacio Flores";
			break;
			
			
			default:
			break;
			}
			
			//################### start collect messages/body ###################################
			// BOF Contact info
				$contact_info .= '================================'.$eol;
				$contact_info .= 'Contact Details'.$eol;
				$contact_info .= '================================'.$eol;
				$contact_info .= 'Name: '.$name.$eol;
				$contact_info .= 'Title: '.$title.$eol;
				$contact_info .= 'Company: '.$company.$eol;
				$contact_info .= 'Address: '.$street.$eol;
				$contact_info .= 'Address2: '.$street2.$eol;
				$contact_info .= 'Mailstop: '.$mailstop.$eol;
				$contact_info .= 'City: '.$city.$eol;
				$contact_info .= 'zip: '.$zip.$eol;
				$contact_info .= 'Country: '.$country.$eol;
				$contact_info .= 'State/Province: '.$state.$eol;
				$contact_info .= 'Phone: '.$phone.' ext: '.$eol;
				$contact_info .= 'Email: '.$email.$eol;
				$contact_info .= '~~~~~~~~~~~~~~~~~~'.$eol;
				$contact_info .= 'Comments: '.$eol.'~~~~~~~~~~~~~~~~~~'.$eol.$comment.$eol.$eol;
			// CSV
				$remove = array("\n", "\r\n", "\r", ",");
				$comment = str_replace($remove, ' ', $comment);
				//$mail_forms_csv_contact_info_headers_feedback = "Name,Title,Company,Phone,Ext,Email,Address,Address2,Mailstop,City,ZIP,Country,State,Newsletter,Comments\n";
				$DateOfRequest = date("Y-m-d H:i:s \E\S\T");
				$mail_forms_csv_contact_info_headers = "Name,Title,Company,Phone,Ext,Email,Address,Address2,Mailstop,City,ZIP,Country,State,Newsletter,Comments,YYYY-MM-DD HH-MM-SS Zone\n";
				$mail_forms_csv_contact_info = "\"".$name."\",\"".$title."\",\"".$company."\",\"".$phone."\",\"".$ext."\",\"".$email."\",\"".$street."\",\"".$street2."\",\"".$mailstop."\",\"".$city."\",\"".$zip."\",\"".$country."\",\"".$state."\",\"".$newsletter."\",\"".$comment."\",\"".$DateOfRequest."\"\n";
				//$mail_forms_csv_data = $mail_forms_csv_contact_info;
			//EOF Contact info
			
			//BOF Catalog Request
				$catalog .= 'Catalogs:'.$eol;
				$catalog .= '================================'.$eol;
				$catalog .= 'New Product Catalog: '.$NPI.$eol;
				$catalog .= '--------------------------------'.$eol;
				$catalog .= 'DC/DC Converters: '.$DCDC.$eol;
				$catalog .= '--------------------------------'.$eol;
				$catalog .= 'AC/DC Power Supplies: '.$ACDC.$eol;
				$catalog .= '--------------------------------'.$eol;
				$catalog .= 'Digital Panel Meters: '.$DPM.$eol;
				$catalog .= '--------------------------------'.$eol;
				$catalog .= 'Data Acquisition: '.$ADS.$eol;
				$catalog .= '--------------------------------'.$eol;
				$catalog .= 'Magnetics Selection Guide: '.$MAG.$eol;
				$catalog .= '--------------------------------'.$eol.$eol;
			//CSV
				$mf_catalog_csv_headers = "New Product Catalog,DC/DC Converters,AC/DC Power Supplies,Digital Panel Meters,Data Acquisition,Magnetics Selection Guide,";
				$mf_catalog_csv = "\"".$NPI."\",\"".$DCDC."\",\"".$ACDC."\",\"".$DPM."\",\"".$ADS."\",\"".$MAG."\",";
			//EOF Catalog Request
			
			//BOF Powerchannel Catalog Request
				$pch_catalog .= 'Catalogs:'.$eol;
				$pch_catalog .= '================================'.$eol;
				$pch_catalog .= 'New Product Catalog: '.$NPI.$eol;
				$pch_catalog .= 'Quantity: '.$npi_quantity.$eol;
				$pch_catalog .= '--------------------------------'.$eol;
				$pch_catalog .= 'DC/DC Converters: '.$DCDC.$eol;
				$pch_catalog .= 'Quantity: '.$dcdc_quantity.$eol;
				$pch_catalog .= '--------------------------------'.$eol;
				$pch_catalog .= 'AC/DC Power Supplies: '.$ACDC.$eol;
				$pch_catalog .= 'Quantity: '.$acdc_quantity.$eol;
				$pch_catalog .= '--------------------------------'.$eol;
				$pch_catalog .= 'Digital Panel Meters: '.$DPM.$eol;
				$pch_catalog .= 'Quantity: '.$dms_quantity.$eol;
				$pch_catalog .= '--------------------------------'.$eol;
				$pch_catalog .= 'Data Acquisition Components: '.$ADS.$eol;
				$pch_catalog .= 'Quantity: '.$ads_quantity.$eol;
				$pch_catalog .= '--------------------------------'.$eol;
				$pch_catalog .= 'Magnetics: '.$MAG.$eol;
				$pch_catalog .= 'Quantity: '.$mag_quantity.$eol;
				$pch_catalog .= '--------------------------------'.$eol.$eol;
			//CSV
				$mf_pch_catalog_csv_headers = "New Product Catalog,Quantity,DC/DC Converters,Quantity,AC/DC Power Supplies,Quantity,Digital Panel Meters,Quantity,Data Acquisition,Quantity,Magnetics Selection Guide,Quantity,";
				$mf_pch_catalog_csv = "\"".$NPI."\",\"".$npi_quantity."\",\"".$DCDC."\",\"".$dcdc_quantity."\",\"".$ACDC."\",\"".$acdc_quantity."\",\"".$DPM."\",\"".$dms_quantity."\",\"".$ADS."\",\"".$ads_quantity."\",\"".$MAG."\",\"".$mag_quantity."\",";
			//EOF Powerchannel Catalog Request
			
			//BOF eNewsletter - Product of interest
				$poi .= 'E-NEWS'.$eol;
				$poi .= '================================'.$eol.$eol;
				$poi .= 'My Product Interests Are:'.$eol;
				$poi .= '-----------------------------------'.$eol.$eol;
				$poi .= 'DC/DC: '.$DCDC.$eol;
				$poi .= 'AC/DC: '.$ACDC.$eol;
				$poi .= 'Digital Panel Meters: '.$DPM.$eol;
				$poi .= 'Magnetics: '.$MAG.$eol;
				$poi .= 'Data Acquisition: '.$ADS.$eol;
				$poi .= 'PC 104: '.$PC104.$eol;
				$poi .= 'Technical Papers: '.$TP.$eol;
				$poi .= 'End-of-Life: '.$EOLV.$eol.$eol;
				$poi .= '-----------------------------------'.$eol;
				$poi .= 'My Component Interests Are:'.$eol;
				$poi .= '-----------------------------------'.$eol.$eol;
				$poi .= 'Multilayer Ceramic Capacitors: '.$MCCAPACITORS.$eol;
				$poi .= 'Polymer Capacitors: '.$PCAPACITORS.$eol;
				$poi .= 'Chip Inductors and EMI Filters: '.$CIEF.$eol;
				$poi .= 'ESD Devices: '.$ESD.$eol;
				$poi .= 'Wireless Communications Modules Solutions: '.$WIRELESS.$eol;
				$poi .= 'Sound Components: '.$SOUND.$eol;
				$poi .= 'Products for Timing Applications: '.$TIMING.$eol;
				$poi .= 'Circuit and Thermal Protection Products: '.$CTPP.$eol;
				$poi .= 'Sensors: '.$SENSORS.$eol;
				$poi .= 'RF and Microwave Components, Sub-Modules: '.$RF.$eol;
				$poi .= 'Ceramic Applied Products: '.$CERAMIC.$eol;
				$poi .= 'High Frequency Coaxial Connectors: '.$HFCCONNECTORS.$eol;
				$poi .= 'RFID Solutions: '.$RFID.$eol;
			//CSV
				$mf_poi_csv_headers = "DC/DC,AC/DC,Digital Panel Meters,Magnetics,Data Acquisition,PC 104,Technical Papers,End-of-Life,Multilayer Ceramic Capacitors,Polymer Capacitors,Chip Inductors and EMI Filters,ESD Devices,Wireless Communications Modules Solutions,Sound Components,Products for Timing Applications,Circuit and Thermal Protection Products,Sensors,RF and Microwave Components Sub-Modules,Ceramic Applied Products,High Frequency Coaxial Connectors,RFID Solutions,";
				$mf_poi_csv = "\"".$DCDC."\",\"".$ACDC."\",\"".$DPM."\",\"".$MAG."\",\"".$ADS."\",\"".$PC104."\",\"".$TP."\",\"".$EOLV."\",\"".$MCCAPACITORS."\",\"".$PCAPACITORS."\",\"".$CIEF."\",\"".$ESD."\",\"".$WIRELESS."\",\"".$SOUND."\",\"".$TIMING."\",\"".$CTPP."\",\"".$SENSORS."\",\"".$RF."\",\"".$CERAMIC."\",\"".$HFCCONNECTORS."\",\"".$RFID."\",";
			//EOF eNewsletter - Product of interest
			
			//BOF General
			
			//EOF General
			
			//BOF Sample
				$sample .= 'Requested Murata Power Solutions parts: '.$eol;
				$sample .= "=========================================".$eol;
				$sample .= 'Sample Quantity: '.$qty_sample.$eol;
				$sample .= 'Part Number: '.$part_number.$eol;
				$sample .= '-----------------------------------'.$eol;
				$sample .= 'Estimated Annual Usage: '.$annual_use.$eol;
				$sample .= 'Production Start Date: '.$start_date.$eol;
				$sample .= 'Application: '.$appl_prog.$eol;
				$sample .= '-----------------------------------'.$eol;
			if(!empty($row1)){
				$sample .= "Sample Quantity-1: ".$qty_sample11.$eol;
				$sample .= "Part Number-1: ".$part_number11.$eol;
				$sample .= '-----------------------------------'.$eol;
			//CSV
				$mf_sample_csv = "\"".$qty_sample."\",\"".$part_number."\",\"".$qty_sample11."\",\"".$part_number11."\", ".", ".", \"".$annual_use."\",\"".$start_date."\",\"".$appl_prog."\",";
			}
			if(!empty($row2)){
				$sample .= "Sample Quantity-2: ".$qty_sample21.$eol;
				$sample .= "Part Number-2: ".$part_number21.$eol;
				$sample .= '-----------------------------------'.$eol;
			//CSV
				$mf_sample_csv = "\"".$qty_sample."\",\"".$part_number."\",\"".$qty_sample11."\",\"".$part_number11."\",\"".$qty_sample21."\",\"".$part_number21."\",\"".$annual_use."\",\"".$start_date."\",\"".$appl_prog."\",";
			}
			else{
			//CSV
				//$mf_sample_csv_headers = "Sample Quantity,Part Number,Estimated Annual Usage,Production Start Date,Application\n";
				//$mf_sample_csv = $qty_sample.", ".$part_number.", ".$annual_use.", ".$start_date.", ".$appl_prog.", ";
				$mf_sample_csv_headers = "Sample Quantity,Part Number,Sample Quantity2,Part Number2,Sample Quantity3,Part Number3,Estimated Annual Usage,Production Start Date,Application,";
				$mf_sample_csv = "\"".$qty_sample."\",\"".$part_number."\", ".", ".", ".", ".",\"".$annual_use."\",\"".$start_date."\",\"".$appl_prog."\",";
			}
			//EOF Sample
			
			//BOF Request For Quote (RFQ)
				$rfq .= $eol."Product(s) info: ".$eol;
				$rfq .= "================================".$eol;
				$rfq .= "Quantity: ".$qty.$eol;
				$rfq .= "Product: ".$product.$eol;
			if(!empty($row1)){
				$rfq .= "================================".$eol;
				$rfq .= "Quantity-1: ".$qty11.$eol;
				$rfq .= "Product-1: ".$product11.$eol;
				$mf_rfq_csv = "\"".$qty."\",\"".$product."\",\"".$qty11."\",\"".$product11."\", ".", ".", ".", ".", ".", ".", ".", ".", ";
			}
			if(!empty($row2)){
				$rfq .= "================================".$eol;
				$rfq .= "Quantity-2: ".$qty21.$eol;
				$rfq .= "Product-2: ".$product21.$eol;
				$rfq .= "Price-2: ".$price21.$eol.$eol;
				$mf_rfq_csv = "\"".$qty."\",\"".$product."\",\"".$qty11."\",\"".$product11."\",\"".$qty21."\",\"".$product21."\", ".", ".", ".", ".", ".", ".", ";
			}
			if(!empty($row3)){
				$rfq .= "================================".$eol;
				$rfq .= "Quantity-3: ".$qty31.$eol;
				$rfq .= "Product-3: ".$product31.$eol;
				$rfq .= "Price-3: ".$price31.$eol.$eol;
				$mf_rfq_csv = "\"".$qty."\",\"".$product."\",\"".$qty11."\",\"".$product11."\",\"".$qty21."\",\"".$product21."\",\"".$qty31."\",\"".$product31."\", ".", ".", ".", ".", ";
			}
			if(!empty($row4)){
				$rfq .= "================================".$eol;
				$rfq .= "Quantity-4: ".$qty41.$eol;
				$rfq .= "Product-4: ".$product41.$eol;
				$rfq .= "Price-4: ".$price41.$eol.$eol;
				$mf_rfq_csv = "\"".$qty."\",\"".$product."\",\"".$qty11."\",\"".$product11."\",\"".$qty21."\",\"".$product21."\",\"".$qty31."\",\"".$product31."\",\"".$qty41."\",\"".$product41."\", ".", ".", ";
			}
			if(!empty($row5)){
				$rfq .= "================================".$eol;
				$rfq .= "Quantity-5: ".$qty51.$eol;
				$rfq .= "Product-5: ".$product51.$eol;
				$rfq .= "Price-5: ".$price51.$eol.$eol;
				$mf_rfq_csv = "\"".$qty."\",\"".$product."\",\"".$qty11."\",\"".$product11."\",\"".$qty21."\",\"".$product21."\",\"".$qty31."\",\"".$product31."\",\"".$qty41."\",\"".$product41."\",\"".$qty51."\",\"".$product51."\", ";
			}
			else{
			//CSV
				$mf_rfq_csv_headers = "Quantity,Product,Quantity1,Product1,Quantity2,Product2,Quantity3,Product3,Quantity4,Product4,Quantity5,Product5,";
				$mf_rfq_csv = "\"".$qty."\",\"".$product."\", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ";
			}
			//EOF Request For Quote (RFQ)
			
			//BOF Technical Support
				$tech_support .= $eol."Type of Product: ".$eol;
				$tech_support .= "---------------------------------".$eol;
				$tech_support .= $apps.$eol;
				$tech_support .= "Do You Have A Data Sheet: ".$datasheet.$eol;
				$tech_support .= $eol."Product(s) info: ".$eol;
				$tech_support .= "---------------------------------".$eol;
				$tech_support .= "Product Name :".$ts_product.$eol;
			//CSV
				$mf_tech_support_csv_headers = "Type of Product,Data Sheet,Product Name,";
				$mf_tech_support_csv = "\"".$apps."\",\"".$datasheet."\",\"".$product."\",";
			//EOF Technical Support
			
			//BOF RMA
				$rma .= "Return Material Authorization (RMA)".$eol;
				$rma .= "===================================".$eol;
				$rma .= "Serial: ". $rma_serial.$eol;
				$rma .= "Product: ". $rma_product.$eol;
				$rma .= "Quantity: ". $rma_qty.$eol;
			if(!empty($row1)){
				$rma .= "---------------------------------".$eol;
				$rma .= "Serial-1: ".$rma_serial11.$eol;
				$rma .= "Product-1: ".$rma_product11.$eol;
				$rma .= "Quantity-1: ".$rma_qty11.$eol.$eol;
				$mf_rma_csv = "\"".$rma_serial."\",\"".$rma_product."\",\"".$rma_qty."\",\"".$rma_serial11."\",\"".$rma_product11."\",".$rma_qty11."\", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ";
				}
			if(!empty($row2)){
				$rma .= "---------------------------------".$eol;
				$rma .= "Serial-2: ".$rma_serial21.$eol;
				$rma .= "Product-2: ".$rma_product21.$eol;
				$rma .= "Quantity-2: ".$rma_qty21.$eol.$eol;
				$mf_rma_csv = "\"".$rma_serial."\",\"".$rma_product."\",\"".$rma_qty."\",\"".$rma_serial11."\",\"".$rma_product11."\",\"".$rma_qty11."\",\"".$rma_serial21."\",\"".$rma_product21."\",\"".$rma_qty21."\", ".", ".", ".", ".", ".", ".", ".", ".", ".", ";
				}
			if(!empty($row3)){
				$rma .= "---------------------------------".$eol;
				$rma .= "Serial-3: ".$rma_serial31.$eol;
				$rma .= "Product-3: ".$rma_product31.$eol;
				$rma .= "Quantity-3: ".$rma_qty31.$eol.$eol;
				$mf_rma_csv = "\"".$rma_serial."\",\"".$rma_product."\",\"".$rma_qty."\",\"".$rma_serial11."\",\"".$rma_product11."\",".$rma_qty11."\",\"".$rma_serial21."\",\"".$rma_product21."\",\"".$rma_qty21."\",\"".$rma_serial31."\",\"".$rma_product31."\",\"".$rma_qty31."\", ".", ".", ".", ".", ".", ".", ";
				}
			if(!empty($row4)){
				$rma .= "---------------------------------".$eol;
				$rma .= "Serial-4: ".$rma_serial41.$eol;
				$rma .= "Product-4: ".$rma_product41.$eol;
				$rma .= "Quantity-4: ".$rma_qty41.$eol.$eol;
				$mf_rma_csv = "\"".$rma_serial."\",\"".$rma_product."\",\"".$rma_qty."\",\"".$rma_serial11."\",\"".$rma_product11."\",".$rma_qty11."\",\"".$rma_serial21."\",\"".$rma_product21."\",\"".$rma_qty21."\",\"".$rma_serial31."\",\"".$rma_product31."\",\"".$rma_qty31."\",\"".$rma_serial41."\",\"".$rma_product41."\",\"".$rma_qty41."\", ".", ".", ".", ";
				}
			if(!empty($row5)){
				$rma .= "---------------------------------".$eol;
				$rma .= "Serial-5: ".$rma_serial51.$eol;
				$rma .= "Product-5: ".$rma_product51.$eol;
				$rma .= "Quantity-5: ".$rma_qty51.$eol.$eol;
				$mf_rma_csv = "\"".$rma_serial."\",\"".$rma_product."\",\"".$rma_qty."\",\"".$rma_serial11."\",\"".$rma_product11."\",".$rma_qty11."\",\"".$rma_serial21."\",\"".$rma_product21."\",\"".$rma_qty21."\",\"".$rma_serial31."\",\"".$rma_product31."\",\"".$rma_qty31."\",\"".$rma_serial41."\",\"".$rma_product41."\",\"".$rma_qty41."\",\"".$rma_serial51."\",\"".$rma_product51."\",\"".$rma_qty51."\",";
				}
			else{
			//CSV
				$mf_rma_csv_headers = "Serial,Product,Quantity,Serial1,Product1,Quantity1,Serial2,Product2,Quantity2,Serial3,Product3,Quantity3,Serial4,Product4,Quantity4,Serial5,Product5,Quantity5,";
				$mf_rma_csv = "\"".$rma_serial."\",\"".$rma_product."\",\"".$rma_qty."\", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ".", ";
				}
			//EOF RMA
			
			//BOF Special
				$special .= 'Special - Custom'.$eol;
				$special .= '--------------------------------'.$eol;
					$special .= 'Original Part Number: '.$requestedProductName.$eol;
					$special .= '--------------------------------'.$eol;
				$special .= 'Input Voltage: '.$Vin.' Volts'.$eol;
				$special .= 'Input Voltage Range: '.$Vin1.' Volts to '.$Vin2.' Volts'.$eol;
				$special .= 'Output Voltage 1: '.$Vout1.' Volts'.$eol;
				$special .= 'Output Voltage 2: '.$Vout2.' Volts'.$eol;
				$special .= 'Output Voltage 3: '.$Vout3.' Volts'.$eol;
				$special .= 'Maximum Output 1: '.$Mout1.' Amps'.$eol;
				$special .= 'Maximum Output 2: '.$Mout2.' Amps'.$eol;
				$special .= 'Maximum Output 3: '.$Mout3.' Amps'.$eol;
				$special .= 'Is isolation required: '.$Isolation.$eol;
				$special .= 'Isolation Voltage: '.$IVolts.' Volts '.$IVoltage.$eol.$eol;
				$special .= '--------------------------------'.$eol;
				//$special .= 'Available Area: '.$Height.' x '.$Length.' x '.$Width.$eol;
				$special .= 'Available Area: '.$Dimension.$eol;
				$special .= 'Heatsink/Baseplate: '.$HeatSink.$eol;
				$special .= '--------------------------------'.$eol.$eol;
				$special .= 'SPECIAL FEATURES:'.$eol;
				$special .= '-----------------------------------'.$eol;
				$special .= 'Input Undervoltage Lockout: '.$UVLO.$eol;
				$special .= 'Input Overvoltage Shutdown: '.$OVLO.$eol;
				$special .= 'Output Current Limiting: '.$OCL.$eol;
				$special .= 'Output Short-Circuit Protection: '.$OSCP.$eol;
				$special .= 'Output Overvoltage Protection: '.$OVP.$eol;
				$special .= 'On/Off Control Pin: '.$OnOff.$eol;
				$special .= 'Remote Sense Pins: '.$Remote.$eol;
				$special .= 'Sync Function Pin: '.$SyncF.$eol;
				$special .= 'Thermal Shutdown: '.$TShutdown.$eol;
				$special .= 'Load/Current Sharing: '.$LCSharing.$eol.$eol;
				$special .= '-----------------------------------'.$eol;
				$special .= 'APPLICATION INFORMATION:'.$eol;
				$special .= '-----------------------------------'.$eol;
				$special .= 'Companys main business: '.$Business.$eol;
				$special .= 'Program/Product to be used: '.$Program.$eol;
				$special .= 'Estimated annual usage: '.$eau.$eol;
				$special .= 'Estimated years of usage: '.$EstYears.$eol;
				$special .= 'Target price per unit in volume(USD): '.$TarPrice.$eol;
				$special .= 'Delivery date for samples: '.$SampMonth.' '.$SampYear.$eol;
				$special .= 'Availability date for production quantities: '.$ProdMonth.' '.$ProdYear.$eol;
			//CSV
				$mf_special_csv_headers = "Original Product Name,Input Voltage,Input Voltage Range (Volts), to (Volts),Output Voltage 1(Volts),Output Voltage 2(Volts),Output Voltage 3(Volts),Maximum Output 1(Amps),Maximum Output 2(Amps),Maximum Output 3(Amps),Is isolation required,Isolation Voltage,Volts,Available Area,Heatsink/Baseplate,Input Undervoltage Lockout,Input Overvoltage Shutdown,Output Current Limiting,Output Short-Circuit Protection,Output Overvoltage Protection,On/Off Control Pin,Remote Sense Pins,Sync Function Pin,Thermal Shutdown,Load/Current Sharing,Companys main business,Program/Product to be used,Estimated annual usage,Estimated years of usage,Target price per unit in volume(USD),Delivery date for samples SampMonth,SampYear,Availability date for production quantities ProdMonth,ProdYear,";
				$mf_special_csv = "\"".$requestedProductName."\",\"".$Vin."\",\"".$Vin1."\",\"".$Vin2."\",\"".$Vout1."\",\"".$Vout2."\",\"".$Vout3."\",\"".$Mout1."\",\"".$Mout2."\",\"".$Mout3."\",\"".$Isolation."\",\"".$IVolts."\",\"".$IVoltage."\",\"".$Dimension."\",\"".$HeatSink."\",\"".$UVLO."\",\"".$OVLO."\",\"".$OCL."\",\"".$OSCP."\",\"".$OVP."\",\"".$OnOff."\",\"".$Remote."\",\"".$SyncF."\",\"".$TShutdown."\",\"".$LCSharing."\",\"".$Business."\",\"".$Program."\",\"".$eau."\",\"".$EstYears."\",\"".$TarPrice."\",\"".$SampMonth."\",\"".$SampYear."\",\"".$ProdMonth."\",\"".$ProdYear."\",";
			//EOL Special
			//################### end collect messages/body ###################################
			
			//*****************************************************************************************
			//	MailForms by Subject
			//*****************************************************************************************
			switch($subject){
				case "eNewsletter":
					$recipient = "sgodin@murata.com ";
					$options .= " assigned to: ".$recipient;
					$message = $contact_info;
					$message .= $poi;
					$mail_forms_csv = 'mf_poi_eNewsletter.csv';
					$mail_forms_csv_data_headers = $mf_poi_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_poi_csv.$mail_forms_csv_contact_info;
				break;
				
				case "General":
							if(!empty($MailFormsREP)){
									$recipient = $MailFormsREP;
									$recipient_cc .= $MailFormsASM;
									$options = " assigned to: $recipient";
							}
							elseif(!empty($MailFormsASM)){
									$recipient = $MailFormsASM;
									$recipient_cc .= $MailFormsASM_cc;
									$options = " assigned to: $recipient";
							}
							elseif(!empty($MailFormsSA)){
									$recipient = $MailFormsSA;
									$recipient_cc .= $MailFormsSA_cc;
									$options = " assigned to: $recipient";
							}
							elseif(!empty($MailFormsASIA)){
									$recipient = $MailFormsASIA;
									$recipient_cc .= $MailFormsASIA_cc;
									$options =  $optionsASIA;
							}
							elseif(!empty($MailFormsEMEA)){
									$recipient = $MailFormsEMEA;
									$recipient_cc .= $MailFormsEMEA_cc;
									$options = $optionsEMEA;
							}
							else{
									$recipient = $MailFormsDefault;
									$options = " assigned to: Webmaster";
							}
							$message = $contact_info;
							$mail_forms_csv = 'mf_general.csv';
							$mail_forms_csv_data = $mail_forms_csv_contact_info;
							$mail_forms_csv_data_headers = $mail_forms_csv_contact_info_headers;
					break;
			
				case "Sample":
					if(!empty($MailFormsREP)){
						$recipient = $MailFormsREP;
						$recipient_cc .= $MailFormsASM;
						$options = " assigned to: $recipient";
					}
					elseif(!empty($MailFormsASM)){
						$recipient = $MailFormsASM;
						$recipient_cc .= $MailFormsASM_cc;
						$options = " assigned to: $recipient";
			
					}
					elseif(!empty($MailFormsSA)){
						$recipient = $MailFormsSA;
						$recipient_cc .= $MailFormsSA_cc;
						$options = " assigned to: $recipient";
					}	
					elseif(!empty($MailFormsASIA)){
						$recipient = $MailFormsASIA;
						$recipient_cc .= $MailFormsASIA_cc;
						$options =  $optionsASIA;
					}
					elseif(!empty($MailFormsEMEA)){
						$recipient = $MailFormsEMEA;
						$recipient_cc .= $MailFormsEMEA_cc;
						$options = $optionsEMEA;
					}
					else{
						$recipient = $MailFormsDefault;
						$options = " assigned to: Webmaster";
					}
					$message = $contact_info;
					$message .= $sample;
					$mail_forms_csv = 'mf_sample.csv';
					$mail_forms_csv_data_headers = $mf_sample_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_sample_csv.$mail_forms_csv_contact_info;
				break;
				
				case "RFQ":
					if(!empty($MailFormsREP)){
						$recipient = $MailFormsREP;
						$recipient_cc .= $MailFormsASM;
						$options = " assigned to: $recipient";
					}
					elseif(!empty($MailFormsASM)){
						$recipient = $MailFormsASM;
						$recipient_cc .= $MailFormsASM_cc;
						$options = " assigned to: $recipient";
			
					}
					elseif(!empty($MailFormsSA)){
						$recipient = $MailFormsSA;
						$recipient_cc .= $MailFormsSA_cc;
						$options = " assigned to: $recipient";
					}	
					elseif(!empty($MailFormsASIA)){
						$recipient = $MailFormsASIA;
						$recipient_cc .= $MailFormsASIA_cc;
						$options =  $optionsASIA;
					}
					elseif(!empty($MailFormsEMEA)){
						$recipient = $MailFormsEMEA;
						$recipient_cc .= $MailFormsEMEA_cc;
						$options = $optionsEMEA;
					}
					else{
						$recipient = $MailFormsDefault;
						$options = " assigned to: Webmaster";
					}
					$message = $contact_info;
					$message .= $rfq;
					$mail_forms_csv = 'mf_rfq.csv';
					$mail_forms_csv_data_headers = $mf_rfq_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_rfq_csv.$mail_forms_csv_contact_info;
				break;
				
				case "Technical Support":
					if(!empty($MailFormsFAE)){
						$recipient = $MailFormsFAE;
						$recipient = implode(',',array_unique(explode(',', $recipient)));
						$recipient_cc .= $MailFormsASM.', '.$MailFormsREP.', '.$MailFormsFAE_cc;
						$recipient_cc = implode(',',array_unique(explode(',', $recipient_cc)));
						$options = " assigned to: $recipient";
					}
					elseif(!empty($MailFormsSA)){
						$recipient = $MailFormsSA;
						$recipient_cc .= $MailFormsSA_cc;
						$options = " assigned to: $recipient";
					}	
					elseif(!empty($MailFormsASIA)){
						$recipient = $MailFormsASIA;
						$recipient_cc .= $MailFormsASIA_cc;
						$options =  $optionsASIA;
					}
					elseif(!empty($MailFormsEMEA)){
						$recipient = $MailFormsEMEA;
						$recipient_cc .= $MailFormsEMEA_cc;
						$options = $optionsEMEA;
					}
					else{
						$recipient = $MailFormsDefault;
						$options = " assigned to: Webmaster";
					}
					$message = $contact_info;
					$message .= $tech_support;
					$mail_forms_csv = 'mf_tech_support.csv';	
					$mail_forms_csv_data_headers = $mf_tech_support_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_tech_support_csv.$mail_forms_csv_contact_info;
				break;
			
				case "RMA":
					$recipient = 'kdoiron@murata.com';
						if((!empty($MailFormsREP)) and (!empty($MailFormsFAE))){
							$recipient_cc .= $MailFormsREP. ', ' .$MailFormsFAE. ', ' .$MailFormsFAE_cc;
							$recipient_cc = implode(',',array_unique(explode(',', $recipient_cc)));
						}
					$options .= " assigned to: $recipient";
					$message = $contact_info;
					$message .= $rma;
					$mail_forms_csv = 'mf_rma.csv';
					$mail_forms_csv_data = $mf_rma_csv.$mail_forms_csv_contact_info;
				break;
				
				case "Catalog":
					if(!empty($MailFormsEMEA)){
							$recipient = $MailFormsEMEA;
							$options = $optionsEMEA;
					}
					elseif(!empty($MailFormsREP)){
							$recipient = $MailFormsREP;
							$options = " assigned to: $recipient";
					}
					else{
							$recipient = $MailFormsDefault;
							$options = " assigned to: Webmaster";
					}
				// Add EMEA, SA, ASIA to CC of catalog
					if(!empty($MailFormsSA)){
							$recipient_cc  = $MailFormsSA;
							}
					elseif(!empty($MailFormsASIA)){
							$recipient_cc = $MailFormsASIA;
							}
					elseif(!empty($MailFormsEMEA)){
							$recipient_cc = $MailFormsEMEA_cc;
							}
					$message = $contact_info;
					$message .= $catalog;
					$mail_forms_csv = 'mf_catalog.csv';
					$mail_forms_csv_data_headers = $mf_catalog_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_catalog_csv.$mail_forms_csv_contact_info;
				break;
				
				case "Powerchannel Catalog":
					if(!empty($MailFormsEMEA)){
							$recipient = $MailFormsEMEA;
							$options = $optionsEMEA;
					}
					else{
							$recipient = $MailFormsDefault;
							$options = " assigned to: Webmaster";
					}
					// Add EMEA, SA, ASIA to CC of catalog
							if(!empty($MailFormsSA)){
											$recipient_cc  = $MailFormsSA;
							}
							elseif(!empty($MailFormsASIA)){
											$recipient_cc = $MailFormsASIA;
							}
							elseif(!empty($MailFormsEMEA)){
											$recipient_cc = $MailFormsEMEA_cc;
							}
					$message = $contact_info;
					$message .= $pch_catalog;
					$mail_forms_csv = 'mf_pch_catalog.csv';
					$mail_forms_csv_data_headers = $mf_pch_catalog_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_pch_catalog_csv.$mail_forms_csv_contact_info;
				break;
				
				case "Special":
					if(!empty($MailFormsREP)){
						$recipient = $MailFormsREP;
						$recipient_cc .= ($MailFormsASM.$MailFormsFAE.$MailFormsFAE_cc);
						$recipient_cc = implode(',',array_unique(explode(',', $recipient_cc)));
						$options .= " assigned to: $recipient";
					}
					elseif(!empty($MailFormsASM)){
						$recipient = $MailFormsASM;
						$recipient_cc .= $MailFormsASM_cc;
						$options .= " assigned to: $recipient";
					}
					elseif(!empty($MailFormsFAE)){
						$recipient = $MailFormsFAE;
						$recipient_cc .= $MailFormsFAE_cc;
						$options .= " assigned to: $recipient";
					}
					elseif(!empty($MailFormsSA)){
						$recipient = $MailFormsSA;
						$recipient_cc .= $MailFormsSA_cc;
						$options .= " assigned to: $recipient";
					}	
					elseif(!empty($MailFormsASIA)){
						$recipient = $MailFormsASIA;
						$recipient_cc .= $MailFormsASIA_cc;
						$options .= " assigned to: $recipient";
					}
					elseif(!empty($MailFormsEMEA)){
						$recipient = $MailFormsEMEA;
						$recipient_cc .= $MailFormsEMEA_cc;
						$options .= " assigned to: $recipient";
					}
					else{
						$recipient = $MailFormsDefault;
						$options .= " assigned to: Webmaster";
					}
					$message = ''.$eol;
					$message .= $contact_info;
					$message .= $special;
					$mail_forms_csv = 'mf_special.csv';
					$mail_forms_csv_data_headers = $mf_special_csv_headers.$mail_forms_csv_contact_info_headers;
					$mail_forms_csv_data = $mf_special_csv.$mail_forms_csv_contact_info;
				break;
				
				default:
					//"Feedback"
					//"Customer Feedback"
					//"Website Feedback"
					//"Powerchannel Feedback"
//					$recipient = ', jsutherby@murata.com';
//					$recipient_cc ='mmorgovsky@murata.com';
					$recipient = ', mmorgovsky@murata.com';
					$options = " assigned to: ".ltrim($recipient,',');
					$message = ''.$eol;
					$message .= $contact_info;
					$subject = 'Feedback';
					$mail_forms_csv = 'mf_feedback_new.csv';
					$mail_forms_csv_data = $mail_forms_csv_contact_info;
					$mail_forms_csv_data_headers = $mail_forms_csv_contact_info_headers;
				break;
			}
			
			//BOF Data Acquisition Components / A/D Converters
			if(($apps == "Data Acquisition Components / A/D Converters") || (!empty($ADS))){
					$recipient_cc .= ', help@datel.com';
			}
			//EOF Data Acquisition Components / A/D Converters
			if ($datasheet == "1"){
			  $datasheet = "YES";
			}else{
			  $datasheet = "NO";
			}
			
			if(($country == 'United States') || ($country == 'Canada') || ($country == 'Mexico') || ($country == 'Puerto Rico')){
				if($subject !== "Feedback"){
//					Business development 
//					$recipient_cc .= ', hmerten@murata.com';
				}
			}
			
			
			//BOF Based on mailing list
			if ($newsletter  == "YES"){
				$newsletter = "YES";
				$recipient_cc .= ', sgodin@murata.com, dkamil@murata.com';
				$options .= " and Email List";
			} else {
				$newsletter = "NO";
				}
			if(!empty($newsletter)){
				$message .= $eol."~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~".$eol;
				$message .= "   Mailing List? - ".$newsletter;
				$message .= $eol."~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~".$eol;
			}else{
				$message .= $eol."~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~".$eol;
				$message .= "   Mailing List? - ".$newsletter;
				$message .= $eol."~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~".$eol;
			}
			//BOF Based on mailing list
			
			if($apps == "Digital Panel Meters and Instruments"){
				$recipient_cc .= ', rcabral@murata.com';
			}

			if($apps == "AC/DC Converters"){
//				$recipient_cc .= ', dgerman@murata.com';
			}

			if($subject !== "Feedback"){
//					Marketing
// 2013-11-26 no message monitoring of MPS - per Pimpis request
//					$recipient_cc .= $MailFormsMarketing;
			}

			$test = strip_tags(stripslashes(trim($_POST['test'])));
			
			switch($test){
			
			case "display":
				echo "<h1> Mail NOT SENT</h1>";
				echo '<pre>';
				echo '<font color="green" size="5"><b>Recipient: '.ltrim($recipient,',')."</b></font>".$eol;
				echo '<font color="gray" size="4"><b>Recipient_cc: '.ltrim($recipient_cc,',')."</b></font>".$eol;
				echo '<font color="orange" size="4"><b>Options: '.ltrim($options,',')."</b></font>".$eol.$eol;
				echo 'MailFormsREP: '.ltrim($MailFormsREP,',').$eol;
				echo 'MailFormsREP_cc: '.ltrim($MailFormsREP_cc,',').$eol;
				echo 'MailFormsASM: '.ltrim($MailFormsASM,',').$eol;
				echo 'MailFormsASM_cc: '.ltrim($MailFormsASM_cc,',').$eol;
				echo 'MailFormsFAE: '.ltrim($MailFormsFAE,',').$eol;
				echo 'MailFormsFAE_cc: '.ltrim($MailFormsFAE_cc,',').$eol;
				echo 'MailFormsSA: '.ltrim($MailFormsSA,',').$eol;
				echo 'MailFormsSA_cc: '.ltrim($MailFormsSA_cc,',').$eol;
				echo 'MailFormsASIA: '.ltrim($MailFormsASIA,',').$eol;
				echo 'MailFormsASIA_cc: '.ltrim($MailFormsASIA_cc,',').$eol;
				echo 'MailFormsEMEA: '.ltrim($MailFormsEMEA,',').$eol;
				echo 'MailFormsEMEA_cc: '.ltrim($MailFormsEMEA_cc,',').$eol;
				echo '</pre>';
				echo "^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^";
				echo '<pre>';
				echo 'To: '.$to;
				echo 'CC: '.ltrim($recipient_cc,',').$eol;
				echo 'Subject: '.$subj;
				echo $message.$eol;
				echo $headers.$eol;
				echo '</pre>';
			break;
			
			case "cc-mm":
				// Send 
				$to = ltrim($recipient,',').$eol;  
				$subj = "Request from Murata Power Solutions : ".$subject." -- ".$options.$eol; 
				$body = $message.$eol;
				$headers = "From: no-reply@murata-ps.com".$eol;
				$headers .= "CC:".ltrim($recipient_cc,',').", mmorgovsky@murata.com".$eol; 
				$headers .= 'X-Mailer: Murata Power Solutions'.$eol;
				$headers .= "Return-Path:<no-reply@murata-ps.com>".$eol;
			//	$headers .= "MIME-Version: 1.0".$eol; 
			//	$headers .= "Content-Type: text/html; charset=utf-8".$eol; 
			//	$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
				$ok = mail($to, $subj, $body, $headers, '-fno-reply@murata-ps.com');
				echo $ok?"<h1> Mail Sent</h1>":"<h1> Mail not SENT</h1>";
			break;
			
			default:
				// Send 
				$to = ltrim($recipient,',').$eol;  
				$subj = $spam."Request from Murata Power Solutions : ".$subject." -- ".$options.$eol; 
				$body = $message.$eol;
				$recipient_cc .= $MailFormsDefault;
				$headers .= "CC:".ltrim($recipient_cc,',').$eol; 
			//	$headers .= 'X-Mailer: PHP/' . phpversion().$eol;
					$headers .= 'X-Mailer: Murata Power Solutions'.$eol;
			//	$headers .= "MIME-Version: 1.0".$eol; 
			//	$headers .= "Content-Type: text/html; charset=utf-8".$eol; 
			//	$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
				//test if email field provided
				if($email){
					$ok = mail($to, $subj, $body, $headers, '-fno-reply@murata-ps.com');
					echo $ok?"<h1>Thank you for your interest in Murata Power Solutions.</h1><p>Your request has been sent to the appropriate individual(s) at Murata Power Solutions. If you have requested information to be sent to you, it will be mailed shortly.</p>":"<h1> Error: Form not submitted</h1>";
				}
				else
				{
					echo "<h1> Error: No Email provided, Form not submitted</h1>";
				}
			//	if($spam)
			//	{
			//		echo "<hr>posible Spam";
			//	}
				//Send to Customer
				$tto = $email.$eol;
				$tsubj = "Murata Power Solutions : Thank you for your request".$eol;
				$tbody  = "Dear $name,".$eol;
				$tbody .= " ".$eol;
				$tbody .= "Thank you for your request to Murata Power Solutions.".$eol;
				$tbody .= " ".$eol;
				$tbody .= "Your request has been sent to the appropriate individual(s) at Murata Power Solutions. If you have requested information to be sent to you, it will be mailed shortly. If you have any questions or comment in the interim, please visit our office locations page: http://www.murata-ps.com/en/contact/sales-locations.html".$eol;
				$tbody .= " ".$eol;
				$tbody .= "Original Form Details".$eol;
					$tbody .= " ".$eol;
				$tbody .= $message.$eol;
					$tbody .= " ".$eol;
				$headers = 'X-Mailer: Murata Power Solutions'.$eol;
				if(!$spam){
					if($email){
						$tok = mail($tto, $tsubj, $tbody, $theaders, '-fno-reply@murata-ps.com');
						echo $ok?".":"<h3> Error: Thank you not sent</h3>";
					}
				}
			
			break;
			}
			
			if($email){
				$csv_file = 'var/MPS/'.$mail_forms_csv;
				if(!file_exists($csv_file)){
				//	$mail_forms_csv_contact_info_1st_time
					$csvHandle = fopen($csv_file, "w");
					$csvData = $mail_forms_csv_data_headers.$mail_forms_csv_data;
				//	echo 'Created NEW file and added data';
				}
				else{
					$csvHandle = fopen($csv_file, "a") or die('<b>ERROR!</b> You might have '.$csv_file.' opened. Close it and re-submit the form!');
					$csvData = $mail_forms_csv_data;
				//	echo 'Added data to existing file';
				}
			
				if (is_writable($csv_file)) {
					if (fwrite($csvHandle, $csvData) === FALSE) {
						echo "Error - cannot write to log"; //for testing
					exit;
					} 
				}
				fclose($csvHandle);
			}
		////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////// EOF: Minimum Entered /////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////
		}
		////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////// EOF: Minimum Entered /////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////
		
	////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////EOF: No State selected/////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	}
	////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////EOF: No State selected/////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	
////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////EOF: No referal URL////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
}
////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////EOF: No referal URL////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
?>
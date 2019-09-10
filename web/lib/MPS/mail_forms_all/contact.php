<script type="text/javascript" src="/js/mps/jquery-1.5.2.min.js"></script>
<script type="text/javascript" src="/js/mps/jquery.highlightFade.js"></script>
<script type="text/javascript" src="/js/mps/MailForms_validate.js"></script>
<script type="text/javascript" src="/js/mps/MailForms_addFormField.js"></script>
<script type="text/javascript" src="/js/mps/jquery.validate.min.js"></script>
<script type="text/javascript" src="/js/mps/additional-methods.min.js"></script>

<link rel="stylesheet" type="text/css" href="/js/mps/MailForms.css" media="all" />

<!--[if lt IE 9]>
	<link href="/js/mps/MailForms_ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script>
	jQuery.noConflict();
</script>
<?
$formtype = '';
if(isset($_GET['form'])){
$formtype = $_GET['form'];
}
?>
<?if ($_SERVER['REQUEST_URI'] != "/contact-mena?form=Newsletter"){?>
<div class="page-title category-title"><h1><?if($formtype=="Catalog"):?>Catalog Request Form
<?elseif($formtype=="Newsletter"):?>e-newsletter Sign-Up Form
<?elseif($formtype=="PowerchannelCatalog"):?>Catalog Request Form
<?elseif($formtype=="RFQ"):?>Request a Quote Form
<?elseif($formtype=="RMA"):?>Returns/Repairs Request Form
<?elseif($formtype=="Sample"):?>Sample Request Form
<?elseif($formtype=="Special"):?>Requesting a Special/Custom DC-DC Converter Form
<?elseif($formtype=="General"):?>Sales Contact Form
<?elseif($formtype=="TechnicalSupport"):?>Technical Support Form
<?else : ?>Website Feedback Form<?endif?></h1></div>
<?}?>
<!--div style="float:right;margin-bottom:20px;"><a href="?form=General">General</a> | <a href="?form=">Feedback</a> | <a href="?form=Catalog">Catalog</a> | <a href="?form=PowerchannelCatalog">Powerchannel Catalog</a> | <a href="?form=Newsletter">Newsletter</a> | <a href="?form=RFQ">RFQ</a> | <a href="?form=RMA">RMA</a> | <a href="?form=Sample">Sample</a> | <a href="?form=Special">Special</a> | <a href="?form=TechnicalSupport">Technical Support</a></div><br clear="all" /-->
<?php if ($_SERVER['REQUEST_URI'] == "/contact-mena?form=Newsletter") : ?>
	<form id="MailForm" method="post" action="thankyou-mena">
<?php else : ?>
	<form id="MailForm" method="post" action="thankyou<?if($formtype): echo "?formtype=$formtype"; else : echo "?formtype=Feedback"; endif?>">
	<?if($formtype=="General"):?><input type="hidden" name="subject" value="General" /><?endif?>
<?php endif?>
<?php
$tett = '';
if(isset($_GET['test'])){
	$tett = $_GET['test'];
}
if($tett):
echo "<input type=hidden name=test value=\"$tett\">";
echo "<h2>test = $tett</h2>";
endif;
?>
<?php
error_reporting (E_ALL ^ E_NOTICE);
if(isset($_GET['form'])){
$form = $_GET['form'];
}
switch($form){
	case "Catalog":
		include('subjCatalog.php');
	break;

	case "Newsletter":
		include('subjNewsletter.php');
	break;

	case "PowerchannelCatalog":
		include('subjPowerchannelCatalog.php');
	break;

	case "RFQ":
		include('subjRFQ.php');
	break;

	case "RMA":
		include('subjRMA.php');
	break;

	case "Sample":
		include('subjSample.php');
	break;

	case "Special":
		include('subjSpecial.php');
	break;

	case "TechnicalSupport":
		include('subjTechnicalSupport.php');
	break;

	default:

	break;
}
include('subjFeedback.php');
?>
</form>

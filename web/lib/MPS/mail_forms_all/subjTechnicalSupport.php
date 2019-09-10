<input type="hidden" name="subject" value="Technical Support" />
<script>
jQuery(function(){
  jQuery('input.radio-dpm').click(function(event){
    jQuery("#notes").show("slow");
  })
});
jQuery(function(){
  jQuery('input.radio').click(function(event){
    jQuery("#notes").hide("slow");
  })
});
</script>
<fieldset class="main">
	<legend>Technical Support</legend>
	<p>
	<label style="margin-top:20px;">Which Murata Power Solutions<br />product line would you like<br />assistance with?<br /><img src="/js/mps/putty5.jpg" alt="Support" title="Technical Support"></label>
	<fieldset class="select_field_checkbox">
		<legend>Select one</legend>
			<input type="radio" class="radio" value="DC/DC Converters / PC-104 Power / Electronic Load" name="apps" id="dc_apps">
			DC/DC Converters / PC-104 Power / Electronic Load
			<br />
			<input type="radio" class="radio" value="AC/DC Converters" name="apps" id="ac_apps">
			AC/DC Converters
			<br />
			<input type="radio" class="radio-dpm" value="Digital Panel Meters and Instruments" name="apps" id="dmp_apps">
			Digital Panel Meters and Instruments <span class="star">*</span>
				<div id="notes" class="notes" style="display:none;">
					<span>Please note:</span> With safety as our primary concern, we cannot provide technical assistance for Panel Meters used in the following non-commercial applications: <b>motorcycles, automobiles, recreational vehicles (boats, motor homes, etc.), residential installations and hobbyist.</b>
				</div>
			<br />
			<input type="radio" class="radio" value="Data Acquisition Components / A/D Converters" name="apps" id="ad_apps">
			Data Acquisition Components / A/D Converters
			<br />
			<input type="radio" class="radio" value="Magnetics" name="apps" id="mag_apps">
			Magnetics
			<br />
			<input type="radio" class="radio" value="Other" name="apps" id="oth_apps">
			Other
	</fieldset>
		</p>
		<p style="margin-top:10px;">
			<label for="ts_product">Product Name:</label>
			<input id="ts_product" name="ts_product" type="text" class="text"  value="<? if(isset($_GET['productRequested'])){ echo $_GET['productRequested'];} ?>"/>
		</p>
		<p>
			<label>Do you have <br />a product data sheet?</label>
			<input type="radio" class="radio-yesno" value="1" name="datasheet" class="datasheet"> Yes
			<input type="radio" class="radio-yesno" value="0" name="datasheet" class="datasheet"> No
		</p>
</fieldset>

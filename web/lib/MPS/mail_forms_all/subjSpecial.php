<input type="hidden" name="subject" value="Special" />
<input type="hidden" name="requestedProductName" value="<? if(isset($_GET['requestedProductName'])){ echo $_GET['requestedProductName'];} ?>" />
<fieldset class="main">
	<legend>Requesting A Special/Custom DC-DC Converter</legend>
	<p>
	<label style="margin-top:20px;">Input:</label>
	<fieldset class="select_field">
		<legend>Input Voltage</legend>
			<ul class="special">
				<li class="first">Input Voltage:</li>
				<li><input name="Vin" size="5" maxlength="5" value="<? if(isset($_GET['NomVin'])){ echo $_GET['NomVin'];} ?>"></li>
				<li>&nbsp;Volts</li>
			</ul>
			<ul class="special">
				<li class="first">Input Voltage Range:</li>
				<li><input name="Vin1" size="5" maxlength="5" value="<? if(isset($_GET['loVin'])){ echo $_GET['loVin'];} ?>"></li><li>Volts to</li><li class=second><input name="Vin2"  size="5" maxlength="5" value="<? if(isset($_GET['hiVin'])){ echo $_GET['hiVin'];} ?>"></li>
				<li>&nbsp;Volts</li>
			</ul>
	</fieldset>
	<label style="margin-top:20px;">Output:</label>
	<fieldset class="select_field">
		<legend>Output Voltages</legend>
			<ul class="special">
				<li class="first">Output 1:</li>
				<li><input name="Vout1" size=5 maxlength=5 value="<? if(isset($_GET['V1out'])){ echo $_GET['V1out'];} ?>"></li>
				<li>&nbsp;Volts</li>
			</ul>
			<ul class="special">
				<li class="first">Output 2:</li>
				<li><input name="Vout2" size=5 maxlength=5 value="<? if(isset($_GET['V2out'])){ echo $_GET['V2out'];} ?>"></li>
				<li>&nbsp;Volts</li>
			</ul>
			<ul class="special">
				<li class="first">Output 3:</li>
				<li><input name="Vout3" size=5 maxlength=5 value="<? if(isset($_GET['V3out'])){ echo $_GET['V3out'];} ?>"></li>
				<li>&nbsp;Volts</li>
			</ul>		
	</fieldset>
	<label style="margin-top:20px;">Output Currents:</label>
	<fieldset class="select_field">
		<legend>Maximum Output Currents</legend>
			<ul class="special">
				<li class="first">Output 1:</li>
				<li><input name="Mout1" size=5 maxlength=5 value="<? if(isset($_GET['I1out'])){ echo $_GET['I1out'];} ?>"></li>
				<li>&nbsp;Amps</li>
			</ul>
			<ul class="special">
				<li class="first">Output 2:</li>
				<li><input name="Mout2" size=5 maxlength=5 value="<? if(isset($_GET['I2out'])){ echo $_GET['I2out'];} ?>"></li>
				<li>&nbsp;Amps</li>
			</ul>
			<ul class="special">
				<li class="first">Output 3:</li>
				<li><input name="Mout3" size=5 maxlength=5 value="<? if(isset($_GET['I3out'])){ echo $_GET['I3out'];} ?>"></li>
				<li>&nbsp;Amps</li>
			</ul>		
	</fieldset>
	<label style="margin-top:20px;">Isolation:</label>
	<fieldset class="select_field">
		<legend>Does the converter require I/O isolation?</legend>
			<ul class="special">
				<li class="first1">Require I/O isolation?</li>
				<li><input type="radio" class="radio" name="Isolation" id="isoYes" value="Yes" checked="true" onclick="isoVoltage.style.display = 'block'">&nbsp;Yes</li>
				<li><input type="radio" class="radio" name="Isolation" id="isoNo" value="No" onclick="isoVoltage.style.display = 'none'">&nbsp;No</li>
			</ul>
		<div id="isoVoltage">
			<ul class="special">
				<li class="first1">What isolation voltage?</li>
				<li><input name="IVolts" value="" size=5 maxlength=5></li>
				<li>&nbsp;Volts&nbsp;</li>
				<li><input type="radio" class="radio" name="IVoltage" value="DC"> DC</li>
				<li><input type="radio" class="radio" name="IVoltage" value="AC"> AC</li>
			</ul>
		</div>	
	</fieldset>
	<script>
		var isoVoltage = document.getElementById("isoVoltage");
	</script>
	<label style="margin-top:20px;">Footprint:</label>
	<fieldset class="select_field">
		<legend>Package/Footprint</legend>
			<ul class="special">
				<li class="first1">Available Area</li>
				<li><input name="Dimension" value="<? if(isset($_GET['Dimension'])){ echo $_GET['Dimension'];} ?>" size=25 maxlength=25></li>
				<!--<li><input name="Height" value="" size=5 maxlength=5>&nbsp;x&nbsp;</li>
				<li><input name="Length" value="" size=5 maxlength=5>&nbsp;x&nbsp;</li>
				<li><input name="Width" value="" size=5 maxlength=5></li>-->
				<li>&nbsp;Inches</li>
			</ul>
			<ul class="special">
				<li class="first1">Require a heatsink?</li>
				<li><input type="radio" class="radio" name="HeatSink" value="Yes">&nbsp;Yes</li>
				<li><input type="radio" class="radio" name="HeatSink" value="No" checked="true">&nbsp;No</li>
			</ul>
	</fieldset>
	<label style="margin-top:20px;">Special Features:</label>
	<fieldset class="select_field_checkbox">
		<legend>Special Features (Do you require any of the following functions?)</legend>
			<input type="checkbox" class="checkbox" name="UVLO" value="Yes">
			Input Undervoltage Lockout<br />
			<input type="checkbox" class="checkbox" name="OVLO" value="Yes">
			Input Overvoltage Shutdown<br />
			<input type="checkbox" class="checkbox" name="OCL" value="Yes">
			Output Current Limiting<br />
			<input type="checkbox" class="checkbox" name="OSCP" value="Yes">
			Output Short-Circuit Protection<br />
			<input type="checkbox" class="checkbox" name="OVP" value="Yes">
			Output Overvoltage Protection<br />
			<input type="checkbox" class="checkbox" name="OnOff" value="Yes">
			On/Off Control Pin<br />
			<input type="checkbox" class="checkbox" name="Remote" value="Yes">
			Remote Sense Pins<br />
			<input type="checkbox" class="checkbox" name="SyncF" value="Yes">
			Sync Pin<br />
			<input type="checkbox" class="checkbox" name="TShutdown" value="Yes">
			Thermal Shutdown<br />
			<input type="checkbox" class="checkbox" name="LCSharing" value="Yes">
			Load/Current Sharing<br />
	</fieldset>
	<label style="margin-top:20px;">Application Info:</label>
	<fieldset class="select_field">
		<legend>Application Information</legend>
			<ul class="appsinfo">
				<li class="first">Your company main business</li>
				<li><input name="Business" value="" size=25 maxlength=60></li>
			</ul>
			<ul class="appsinfo">
				<li class="first">Program/product in which this power converter will be used</li>
				<li><input name="Program" value="" size=25 maxlength=150></li>
			</ul>
			<ul class="appsinfo">
				<li class="first">Estimated annual usage (EAU)</li>
				<li><input name="eau" value="" size=5 maxlength=10>&nbsp;Units/Year</li>
			</ul>
			<ul class="appsinfo">
				<li class="first">Estimated years of usage</li>
				<li><input name="EstYears" value="" size=5 maxlength=5>&nbsp;Years</li>
			</ul>
			<ul class="appsinfo">
				<li class="first">Target price per unit in volume ($)</li>
				<li><input name="TarPrice" value="" size=5 maxlength=5>&nbsp;Dollars</li>
			</ul>
			<ul class="appsinfo">
				<li class="first">Requested delivery date<br />for samples</li>
				<li><input name="SampMonth" value="" size=5 maxlength=5>&nbsp;Month&nbsp;</li>
				<li><input name="SampYear" value="" size=5 maxlength=5>&nbsp;Year</li>
			</ul>
			<ul class="appsinfo">
				<li class="first">Requested availability date<br />for production quantities</li>
				<li><input name="ProdMonth" value="" size=5 maxlength=5>&nbsp;Month&nbsp;</li>
				<li><input name="ProdYear" value="" size=5 maxlength=5>&nbsp;Year</li>
			</ul>		
	</fieldset>
	</p>
</fieldset>

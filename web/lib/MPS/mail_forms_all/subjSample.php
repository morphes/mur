<script>document.title = "Sample | " + document.title</script>
<input type="hidden" name="subject" value="Sample" />
<fieldset class="main">
	<legend>Sample Request</legend>
		<input id="sampleid" type="hidden" value="1">
		<p class="add-field-sample" id="add-field-sample"><a href="#" onClick="addFormFieldSample(); return false;">Add More Fields</a></p>
		<p>
			<label for="qty_sample"><span class="star">*</span>Sample Quantity:</label>
			<input id="qty_sample" name="qty_sample" type="text" class="text" />
		</p>
		<p>
			<label for="part_number"><span class="star">*</span>Part Number:</label>
			<input id="part_number" name="part_number" type="text" class="text" value="<?php echo $_GET['requestedProductName']; ?>" />
		</p>
		<div id="sampleadd"></div>
</fieldset>
<fieldset class="main">
	<legend>Production Schedule</legend>
		<p>
			<label for="annual_use"><span class="star">*</span>Estimated Annual Usage:</label>
			<input id="annual_use" name="annual_use" type="text" class="text" />
		</p>
		<p>
			<label for="start_date"><span class="star">*</span>Production Start Date:</label>
			<input id="start_date" name="start_date" type="text" class="text" />
		</p>
		<p>
			<label for="appl_prog"><span class="star">*</span>Application:</label>
			<input id="appl_prog" name="appl_prog" type="text" class="text" />
		</p>
</fieldset>

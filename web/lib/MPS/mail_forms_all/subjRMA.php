<script>document.title = "RMA | " + document.title</script>
<input type="hidden" name="subject" value="RMA" />
<fieldset class="main">
	<legend>Return Material Authorization (RMA)</legend>	
	<input id="rmaid" type="hidden" value="1">

		<p class="add-field-rma" id="add-field-rma"><a href="#" onClick="addFormFieldRMA(); return false;">Add More Products</a></p>
		<p>
			<label for="rma_qty">Quantity:</label>
			<input id="rma_qty" name="rma_qty" type="text" class="text-rma" />
		</p>
		<p>
			<label for="rma_product"><span class="star">*</span>Product:</label>
			<input id="rma_product" name="rma_product" type="text" class="text-rma" value="<?echo $_GET['productRequested']; ?>" />
		</p>
		<p>
			<label for="rma_serial">Serial No./Date Code:</label>
			<input id="rma_serial" name="rma_serial" type="text" class="text-rma" />
		</p>
	<div id="rmaadd"></div>
</fieldset>

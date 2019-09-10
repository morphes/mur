<script>document.title = "Request For Quote | " + document.title</script>
<input type="hidden" name="subject" value="RFQ" />
<fieldset class="main">
	<legend>Request For Quote</legend>
	
	<input id="rfqid" type="hidden" value="1">

		<p class="add-field-rfq" id="add-field-rfq"><a href="#" onClick="addFormFieldRFQ(); return false;">Add more part numbers</a></p>
                <p>
                        <label for="product"><span class="star">*</span>Product:</label>
                        <input id="product" name="product" type="text" class="text-rfq" value="<?echo $_GET['productRequested']; ?>" />
                </p>
		<p>
			<label for="qty">Quantity:</label>
			<input id="qty" name="qty" type="text" class="text-rfq" />
		</p>
	<div id="rfqadd"></div>
</fieldset>

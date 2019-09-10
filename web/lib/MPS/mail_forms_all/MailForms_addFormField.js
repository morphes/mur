function addFormFieldSample() {
	var id = document.getElementById("sampleid").value;
	var limit = 3;
	$("#sampleadd").append("<div class='samplerow' id='row" + id + "'><hr /><p><label class='sample-label' for='qty_sample" + id + "1'>Sample Quantity:</label><input type='text' name='qty_sample" + id + "1' id='qty_sample" + id + "1' class='text'></p><p><label class='sample-label' for='part_number" + id + "1'>Part Number:</label><input type='text' name='part_number" + id + "1' id='part_number" + id + "1' class='text'></p><a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'><img src='delete.png' alt='remove' title='Remove'></a><input type='hidden' id='row" + id + "' name='row" + id + "' value='row" + id + "'><br clear='all' /></div>");
		
	$('#row' + id).highlightFade({
		speed:1000
	});
	
	id = (id - 1) + 2;
	document.getElementById("sampleid").value = id;

	 var count = $(".samplerow").length;
		if (count >= 2) {
	        document.getElementById("add-field").style.display = 'none';
			//alert("You have reached the limit of total 3 sets of inputs");
	    } 
}

function removeFormField(id) {
	$(id).remove();
	var count = $(".samplerow").length;
	if (count < 2) {
		document.getElementById("add-field").style.display = 'block';
	}
}

function addFormFieldRMA() {
	var id = document.getElementById("rmaid").value;
	var limit = 6;
	$("#rmaadd").append("<div class='rmarow' id='row" + id + "'><hr /><p><label class='rma-label' for='rma_qty" + id + "1'>Quantity:</label><input type='text' name='rma_qty" + id + "1' id='rma_qty" + id + "1' class='text-rma'></p><p><label class='rma-label' for='rma_product" + id + "1'>Product:</label><input type='text' name='rma_product" + id + "1' id='rma_product" + id + "1' class='text-rma'></p><p><label class='rma-label' for='rma_serial" + id + "1'>Serial No.\/Date Code:</label><input type='text' name='rma_serial" + id + "1' id='rma_serial" + id + "1' class='text-rma'></p><a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'><img src='delete.png' alt='remove' title='Remove'></a><input type='hidden' id='row" + id + "' name='row" + id + "' value='row" + id + "'><br clear='all' /></div>");
		
	$('#row' + id).highlightFade({
		speed:1000
	});
	
	id = (id - 1) + 2;
	document.getElementById("rmaid").value = id;

	 var count = $(".rmarow").length;
		if (count >= 5) {
	        document.getElementById("add-field-rma").style.display = 'none';
			//alert("You have reached the limit of total 6 sets of inputs");
	    } 
}

function removeFormField(id) {
	$(id).remove();
	var count = $(".rmarow").length;
	if (count < 5) {
		document.getElementById("add-field-rma").style.display = 'block';
	}
}

function addFormFieldRFQ() {
	var id = document.getElementById("rfqid").value;
	var limit = 6;
	$("#rfqadd").append("<div class='rfqrow' id='row" + id + "'><hr /><p><label class='rfq-label' for='qty" + id + "1'>Quantity:</label><input type='text' name='qty" + id + "1' id='qty" + id + "1' class='text-rfq'></p><p><label class='rfq-label' for='product" + id + "1'>Product:</label><input type='text' name='product" + id + "1' id='product" + id + "1' class='text-rfq'></p><p><label class='rfq-label' for='price" + id + "1'>Target Price:</label><input type='text' name='price" + id + "1' id='price" + id + "1' class='text-rfq'></p><a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'><img src='delete.png' alt='remove' title='Remove'></a><input type='hidden' id='row" + id + "' name='row" + id + "' value='row" + id + "'><br clear='all' /></div>");
		
	$('#row' + id).highlightFade({
		speed:1000
	});
	
	id = (id - 1) + 2;
	document.getElementById("rfqid").value = id;

	 var count = $(".rfqrow").length;
		if (count >= 5) {
	        document.getElementById("add-field-rfq").style.display = 'none';
			//alert("You have reached the limit of total 6 sets of inputs");
	    } 
}

function removeFormField(id) {
	$(id).remove();
	var count = $(".rfqrow").length;
	if (count < 5) {
		document.getElementById("add-field-rfq").style.display = 'block';
	}
}


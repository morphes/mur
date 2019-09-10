jQuery(document).ready(function(){
	// validate signup form on keyup and submit
	$("#MailForm").validate({
		rules: {
			name: "required",
			company: "required",
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				number: true,
				minlength: 5, // will count space 
        		maxlength: 20

				//phoneUS: true
			},
			ext: {
				required: false,
				number: true,
				minlength: 1, // will count space 
        		maxlength: 5

				//phoneUS: true
			},
			street: "required",
			city: "required",
			country: "required",
			zip: {
				required: true,
				//number: true,
				minlength: 4,
        		maxlength: 10
			},
			state: "required",
			appl_prog: "required",
			start_date: "required",
			annual_use: "required",
			part_number: "required",
			part_number11: "required",
			part_number21: "required", 
			qty_sample: {
				required: true,
				number: true,
				minlength: 1,
        		maxlength: 7
			},
			qty_sample11: {
				required: true,
				number: true,
				minlength: 1,
        		maxlength: 7
			},
			qty_sample21: {
				required: true,
				number: true,
				minlength: 1,
        		maxlength: 7
			},
			product: "required",
			product11: "required",
			product21: "required",
			product31: "required",
			product41: "required",
			product51: "required"		
		},
		messages: {
			name: "<img src='required.png'>",
			company: "<img src='required.png'>",
			email: "<img src='required.png'>",
			phone: "",
			street: "<img src='required.png'>",
			city: "<img src='required.png'>",
			country: "<img src='required.png'>",
			zip: "<img src='required.png'>",
			state: "<img src='required.png'>",
			appl_prog: "<img src='required.png'>",
			start_date: "<img src='required.png'>",
			annual_use: "<img src='required.png'>",
			part_number: "<img src='required.png'>",
			part_number11: "<img src='required.png'>",
			part_number21: "<img src='required.png'>", 
			qty_sample: "<img src='required.png'>",
			qty_sample11: "<img src='required.png'>",
			qty_sample21: "<img src='required.png'>",
			product: "<img src='required.png'>",
			product11: "<img src='required.png'>",
			product21: "<img src='required.png'>",
			product31: "<img src='required.png'>",
			product41: "<img src='required.png'>",
			product51: "<img src='required.png'>"		
		}
	});

});

jQuery(document).ready(function(){
	// when any option from country list is selected
	$("select[name='country']").change(function(){

		// path of ajax-loader gif image
		var ajaxLoader = "<img src='ajax-loader.gif' alt='loading...' style='margin-left:150px;' />";

		// get the selected option value of country
		var optionValue = $("select[name='country']").val();
		/**
		 * pass country value through GET method as query string
		 * if we get response from data_state.php, then only the stateAjax div is displayed
		 * otherwise the stateAjax div remains hidden
		 */
		$("#stateAjax")
			.html(ajaxLoader)
			.load('data_state.php', "country="+optionValue+"&status=1", function(response){
				if(response) {
					$("#stateAjax").css('display', '');
				} else {
					$("#stateAjax").css('display', 'none');
				}
		});
	});
});
//here we gonna assign label 'width' for all labels from the biggest one
jQuery(document).ready(function() {
    var max = 0;
    $("label").each(function(){
        if ($(this).width() > max)
            max = $(this).width();
    });
    $("label").width(max);
});

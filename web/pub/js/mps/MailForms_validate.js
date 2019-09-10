jQuery(document).ready(function($){
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
				minlength: 5,
        		maxlength: 25

				//phoneUS: true
			},
			ext: {
				required: false,
				number: true,
				minlength: 1,
        		maxlength: 6

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
			name: "<img src='/js/mps/required.png'>",
			company: "<img src='/js/mps/required.png'>",
			email: "<img src='/js/mps/required.png'>",
			phone: "",
			street: "<img src='/js/mps/required.png'>",
			city: "<img src='/js/mps/required.png'>",
			country: "<img src='/js/mps/required.png'>",
			zip: "<img src='/js/mps/required.png'>",
			state: "<img src='/js/mps/required.png'>",
			appl_prog: "<img src='/js/mps/required.png'>",
			start_date: "<img src='/js/mps/required.png'>",
			annual_use: "<img src='/js/mps/required.png'>",
			part_number: "<img src='/js/mps/required.png'>",
			part_number11: "<img src='/js/mps/required.png'>",
			part_number21: "<img src='/js/mps/required.png'>", 
			qty_sample: "<img src='/js/mps/required.png'>",
			qty_sample11: "<img src='/js/mps/required.png'>",
			qty_sample21: "<img src='/js/mps/required.png'>",
			product: "<img src='/js/mps/required.png'>",
			product11: "<img src='/js/mps/required.png'>",
			product21: "<img src='/js/mps/required.png'>",
			product31: "<img src='/js/mps/required.png'>",
			product41: "<img src='/js/mps/required.png'>",
			product51: "<img src='/js/mps/required.png'>"		
		}
	});

});

jQuery(document).ready(function($){
	// when any option from country list is selected
	$("select[name='country']").change(function(){
		// path of ajax-loader gif image
		var ajaxLoader = "<img src='/js/mps/ajax-loader.gif' alt='loading...' style='margin-left:150px;' />";
		// get the selected option value of country
		var optionValue = $("select[name='country']").val();
		/**
		 * pass country value through GET method as query string
		 * if we get response from data_state.php, then only the stateAjax div is displayed
		 * otherwise the stateAjax div remains hidden
		 */
		$("#stateAjax")
			.html(ajaxLoader)
			.load('/MPS/data_state.php', "country="+optionValue+"&status=1", function(response){
				if(response) {
					$("#stateAjax").css('display', '');
				} else {
					$("#stateAjax").css('display', 'none');
				}
		});
	});
});
//here we gonna assign label 'width' for all labels from the biggest one
jQuery(document).ready(function($) {
    var max = 0;
    $("label").each(function(){
        if ($(this).width() > max)
            max = $(this).width();
    });
    $("label").width(max);
});

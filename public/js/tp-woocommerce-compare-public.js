(function( $ ) {
	'use strict';

	$( document ).ready(function() {
		//alert(tpwc.display_url);
		//console.log( "ready!" );
		console.log(tpwc);

		tp_compare_load_compale_button();
		tp_compare_load_view_compale_button();

		$(".tpwc-compare-toggle").on( "click", function() {
			$(".tp_compare_link_box").slideToggle();
			// if($(this).text() == 'close'){
			// 	$(this).text('Show');
			// } else {
			// 	$(this).text('close');
			// }
		});

		$(".tpwc-compare").on( "click", function() {
			var pid = $(this).data('pid');
			lity(tpwc.display_url+'&pid='+pid);
		});

		$("#tp-compare-link").on( "click", function() {
			var pid = $(this).data('pid');
			//lity(tpwc.display_url+'&pid='+pid);
			lity(tpwc.display_url+'&pid='+pid);
		});

		
		if($(".tp_compare_build_page_ajax").length) {
			tp_compare_load_compare_table();
		}

	});

	$(document).on('tpwclity:close', function(event, instance) {
		//console.log('Lightbox closed');
		tp_compare_update_tp_compare_link();
	});

})( jQuery );

function tp_compare_item_remove(pid){
	
	var array = localStorage.getItem('tp_compare');
	var arraynum = parseInt(localStorage.getItem("tp_compare_num"));

	arraynum -= 1;
	// Parse it to something usable in js
	array = JSON.parse(array);

	array.splice(array.indexOf(pid), 1); //deleting

	localStorage.setItem('tp_compare', JSON.stringify(array));
	localStorage.setItem('tp_compare_num', JSON.stringify(arraynum));

	jQuery.ajax({
		type: "post",
		//dataType : "json",
		url : tpwc.ajax_url,
		//url: '<?php echo $ajaxlink; ?>',
		data: {
			action: "tp_compare_load_compare_table",
			tp_compare: localStorage.getItem("tp_compare"),
		},
		beforeSend: function() {
			jQuery(".tp-compare-roller").show();
		},
		success: function(response) {

			jQuery('.tp-compare-roller').hide();
			jQuery("#tp-compare-ajax-results").html(response);

			jQuery('#tpwc-bb-pid-'+pid+'').html(tpwc.text1);

			if(localStorage.getItem("tp_compare_num") == 0){
				jQuery('#tp-compare-ajax-results').html('<div class="tpwc-empty">Your compare is empty.</div>');
			}
			
		}
	});

}

function tp_compare_short_description_highest_box() {
	// Select and loop the container element of the elements you want to equalise
    jQuery('.tp-compare-items').each(function(){  
      
		// Cache the highest
		var highestBox = 0;
		
		// Select and loop the elements you want to equalise
		jQuery('.tp-compare-item-short-description', this).each(function(){
		  
		  // If this box is higher than the cached highest then store it
		  if(jQuery(this).height() > highestBox) {
			highestBox = jQuery(this).height(); 
		  }
		
		});  
			  
		// Set the height of all those children to whichever was highest 
		jQuery('.tp-compare-item-short-description',this).height(highestBox);
					  
	}); 
}

function tp_compare_long_description_highest_box() {
	// Select and loop the container element of the elements you want to equalise
    jQuery('.tp-compare-items').each(function(){  
      
		// Cache the highest
		var highestBox = 0;
		
		// Select and loop the elements you want to equalise
		jQuery('.tp-compare-item-long-description', this).each(function(){
		  
		  // If this box is higher than the cached highest then store it
		  if(jQuery(this).height() > highestBox) {
			highestBox = jQuery(this).height(); 
		  }
		
		});  
			  
		// Set the height of all those children to whichever was highest 
		jQuery('.tp-compare-item-long-description',this).height(highestBox);
					  
	}); 
}

function tp_compare_name_highest_box() {
	// Select and loop the container element of the elements you want to equalise
    jQuery('.tp-compare-items').each(function(){  
      
		// Cache the highest
		var highestBox = 0;
		
		// Select and loop the elements you want to equalise
		jQuery('.tp-compare-item-name', this).each(function(){
		  
		  // If this box is higher than the cached highest then store it
		  if(jQuery(this).height() > highestBox) {
			highestBox = jQuery(this).height(); 
		  }
		
		});  
			  
		// Set the height of all those children to whichever was highest 
		jQuery('.tp-compare-item-name',this).height(highestBox);
					  
	}); 
}

function tp_compare_rating_highest_box() {
	// Select and loop the container element of the elements you want to equalise
    jQuery('.tp-compare-items').each(function(){  
      
		// Cache the highest
		var highestBox = 0;
		
		// Select and loop the elements you want to equalise
		jQuery('.tp-compare-item-rating', this).each(function(){
		  
		  // If this box is higher than the cached highest then store it
		  if(jQuery(this).height() > highestBox) {
			highestBox = jQuery(this).height(); 
		  }
		
		});  
			  
		// Set the height of all those children to whichever was highest 
		jQuery('.tp-compare-item-rating',this).height(highestBox);
					  
	}); 
}

function tp_compare_register_session_storage(pid){
	//window.localStorage.clear();
	var limit_products_to_compare = tpwc.limit_products_to_compare;
	var title_max_products = '';
	
	if(localStorage.getItem("tp_compare") === null && pid){
		var array = [pid];
		// Store after JSON stringifying (is this a verb?) it
		localStorage.setItem('tp_compare', JSON.stringify(array));
		localStorage.setItem('tp_compare_num', 1);
    }
    else if(localStorage.getItem("tp_compare") && pid){

		// Retrieve the array from local storage
		var array = localStorage.getItem('tp_compare');
		var arraynum = parseInt(localStorage.getItem('tp_compare_num'));
		// Parse it to something usable in js
		array = JSON.parse(array);

        if (array.includes(pid)) {

        }
        else{
            if(array.length < limit_products_to_compare){
				array.push(pid);
				arraynum += 1;
				localStorage.setItem('tp_compare', JSON.stringify(array));
				localStorage.setItem('tp_compare_num', arraynum);
            }
            else{
				title_max_products = '<div class="tp_compare_title_max_products tp-compare-blink">You can compare maximum '+limit_products_to_compare+' products</div>';
				jQuery('#tp_compare_title_max_products_ajax').html(title_max_products);
            }
        }
    }

}

function tp_compare_load_compare_table() {
	if(localStorage.getItem("tp_compare")){
		jQuery.ajax({
			type: "post",
			//dataType : "json",
			url : tpwc.ajax_url,
			//url: '<?php echo $ajaxlink; ?>',
			data: {
				action: "tp_compare_load_compare_table",
				tp_compare: localStorage.getItem("tp_compare"),
				//nonce: nonce
			},
			beforeSend: function() {
				jQuery(".tp-compare-roller").show();
			},
			success: function(response) {
	
				jQuery('.tp-compare-roller').hide();
				jQuery("#tp-compare-ajax-results").html(response);
	
				//jQuery('#tpwc-bb-pid-'+pid+'').html(tpwc.text1);

				tp_compare_name_highest_box();
        		tp_compare_short_description_highest_box();
        		tp_compare_long_description_highest_box();
				tp_compare_rating_highest_box();
				
			}
	    });
	}
	else{
		jQuery('#tp-compare-ajax-results').html('Your compare is empty');
	}
}

function tp_compare_load_compale_button() {
	if(localStorage.getItem("tp_compare") && localStorage.getItem("tp_compare_num") && localStorage.getItem("tp_compare_num") != 0){
		//alert(localStorage.getItem("tp_compare"));
		var button = '<span id="tp-compare-link" class="tp-compare-link tp-compare-link-button1" data-pid="-1">'+tpwc.text1+'</span>';
		jQuery('body').append(button);
	}
}

function tp_compare_load_view_compale_button() {
	if(localStorage.getItem("tp_compare") && localStorage.getItem("tp_compare_num") && localStorage.getItem("tp_compare_num") != 0){
		jQuery('.tpwc-compare').each(function(i, obj) {
			//console.log(obj);
			var button = tpwc.text2;
			var pid = jQuery(obj).data("pid");
			//console.log(pid);
			var array = localStorage.getItem('tp_compare');
			if(array.includes(pid)){
				jQuery(obj).html(button);
			}
		});
	}
}

function tp_compare_update_tp_compare_link() {
	if(localStorage.getItem("tp_compare_num") === null || localStorage.getItem("tp_compare_num") == 0){
		jQuery('#tp-compare-link').hide();
	}
	else{
		jQuery('#tp-compare-link').show();
	}
}
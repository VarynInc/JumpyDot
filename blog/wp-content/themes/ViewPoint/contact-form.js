jQuery(document).ready(function() {
	
	//if submit button is clicked
	jQuery('#submit').click(function () {		
		
		//Get the data from all the fields
		var name = jQuery('input[name=name]');
		var email = jQuery('input[name=email]');
		var website = jQuery('input[name=website]');
		var comment = jQuery('textarea[name=comment]');

		//Simple validation to make sure user entered something
		//If error found, add hightlight class to the text field
		if (name.val()=='') {
			name.addClass('hightlight');
			return false;
		} else name.removeClass('hightlight');
		
		if (email.val()=='') {
			email.addClass('hightlight');
			return false;
		} else email.removeClass('hightlight');
		
		if (comment.val()=='') {
			comment.addClass('hightlight');
			return false;
		} else comment.removeClass('hightlight');

		//organize the data properly
		var data = 'name=' + name.val() + '&email=' + email.val() + '&comment='  + encodeURIComponent(comment.val());
		
		//disabled all the text fields
		jQuery('.text').attr('disabled','true');
		
		//show the loading sign
		jQuery('.loading').show();
		
		$.ajax({
			//this is the php file that processes the data and send mail
			url: "index.php",	
			
			//GET method is used
			type: "POST",

			//pass the data			
			data: data,		
			
			//Do not cache the page
			cache: false,
			
			//success
			success: function (html) {				
				//if process.php returned 1/true (send mail success)
				if (html==1) {					
					//hide the form
					jQuery('.form').fadeOut('slow');					
					
					//show the success message
					jQuery('.done').fadeIn('slow');
					
				//if process.php returned 0/false (send mail failed)
				} else alert('Sorry, unexpected error. Please try again later.');				
			}		
		});
		
		//cancel the submit button default behaviours
		return false;
	});	
});	

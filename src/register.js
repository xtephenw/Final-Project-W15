$(document).ready(function() {
  $("#register, #login").click(function(event) {
    var name = ($(event.target).attr('id') == 'register') ? 'Registration' : 'Login';
    $('#message').slideUp('fast');

    $.post('service.php', $('#mainform').serialize() 
        +'&action='+ $(event.target).attr('id'), function(data) {
			var code = $(data)[0].nodeName.toLowerCase();

		$('#message').removeClass('error');
		$('#message').removeClass('success');
		$('#message').addClass(code);
		if(code == 'success') {
			//var parsed_data = JSON.parse(data);
			// alert( "Data Loaded: " + parsed_data );
			var jsonText = data; //JSON.stringify(data);
			$('#message').html(name + ' was successful.' + jsonText);
			$('#dbase').html(jsonText);
			//if (data.length>0){ 
			//	$('#database').html(parsed_data);      			
			//}	 		
		}else if(code == 'error') {
			$('#message').html('An error occurred, please try again.');
		}
		$('#message').slideDown('fast');
    });
    return event.preventDefault();
  });
});
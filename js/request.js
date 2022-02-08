$( document ).ready(function() {	
	$('#request').submit(function(){	  
		$(".wait").css('display', 'flex');
		var from=$(this).children('#startDate').val();
		var to=$(this).children('#endDate').val();    
		$.ajax({
			type: "POST",
			dataType: "text",
			url: "php/handler.php",
			data: {
				from : from,
				to : to
			},
			success: function(msg){
				$("#result").html(msg);
				$(".wait").css('display', 'none');
			}
		});
		return false;
	});  
});

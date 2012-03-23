$(function() {
	
	var hideNextMessage = function() {
		$("#messages li:eq(0)").fadeOut("slow", function() {
			$(this).remove();
			if($("#messages li").length) {
				setTimeout(hideNextMessage, 1000);
			} else {
				$("#messages").remove();
			}
		});
	}
	
	if($("#messages li").length) {
		setTimeout(hideNextMessage, 3000);
	}
	
	$("#signin").validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			username: {
				required: "Please enter your username"
			},
			password: {
				required: "Please enter your password"
			}
		}
	});
	
	
});

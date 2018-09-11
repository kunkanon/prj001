$(document).ready(function(){
	$("#btn-login-submit").click(function(e){
		e.preventDefault();
		var logindata = {
		'usrLogin' : $("#loginEmail").val(),
		'usrPswd' : $("#loginPswd").val()
		};
		$.ajax({
	 		url: "../control/o.auth.user.php",
	  		data: logindata,
	  		type: "POST",
	  		dataType: "JSON"
		}).done(function(dataset){
			console.log(dataset);
			if(dataset["count"]==1){
				$("#message-success").show(1000);
				var routedata = {
					'type' : 'mainview',
					'code' : dataset['user'],
					'category' : dataset['category']
				}
				$.ajax({
					url: '../control/routes.php',
					data: routedata,
					type: "POST",
	  				dataType: "JSON"
				}).done(function(resultset){
					if(resultset[0]){
						
					}else{
						$("#message-error").show(1000);
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR.responseText);
					$("#message-error").show(1000);
				})
			}else{
				$("#message-error").show(1000);
			}
			
		})
		.fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			$("#message-error").show(1000);
		})
	});
})
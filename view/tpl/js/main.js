$(document).ready(function(){
	$("#btn-login-submit").click(function(e){
		e.preventDefault();
		var logindata = {
		'usrLogin' : $("#loginEmail").val(),
		'usrPswd' : $("#loginPswd").val()
		}
		$.ajax({
	 		url: "../control/o.auth.user.php",
	  		data: logindata,
	  		method: "POST",
	  		datatype: "JSON"
		}).done(function(e){
			
		})
		.fail(function(jqXHR, textStatus, errorThrown){

		})
	});
})
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



!function(t){"use strict";t('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var o=t(this.hash);if((o=o.length?o:t("[name="+this.hash.slice(1)+"]")).length)return t("html, body").animate({scrollTop:o.offset().top-70},1e3,"easeInOutExpo"),!1}}),t(document).scroll(function(){100<t(this).scrollTop()?t(".scroll-to-top").fadeIn():t(".scroll-to-top").fadeOut()}),t(".js-scroll-trigger").click(function(){t(".navbar-collapse").collapse("hide")}),t("body").scrollspy({target:"#mainNav",offset:80});var o=function(){100<t("#mainNav").offset().top?t("#mainNav").addClass("navbar-shrink"):t("#mainNav").removeClass("navbar-shrink")};o(),t(window).scroll(o),t(".portfolio-item").magnificPopup({type:"inline",preloader:!1,focus:"#username",modal:!0}),t(document).on("click",".portfolio-modal-dismiss",function(o){o.preventDefault(),t.magnificPopup.close()}),t(function(){t("body").on("input propertychange",".floating-label-form-group",function(o){t(this).toggleClass("floating-label-form-group-with-value",!!t(o.target).val())}).on("focus",".floating-label-form-group",function(){t(this).addClass("floating-label-form-group-with-focus")}).on("blur",".floating-label-form-group",function(){t(this).removeClass("floating-label-form-group-with-focus")})})}(jQuery);
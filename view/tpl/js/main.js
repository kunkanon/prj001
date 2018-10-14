$(document).ready(function(){
	$("#usridhid").hide();
	$("#pjhid").hide();
	$("#registerlitro").hide();
	$("#registerlitrosel").change(function(){
		$("#registerlitro").val($(this).val());
	});
	$("#newcolcolhid").hide();
	$("#newcolcol").change(function(){
		$("#newcolcolhid").val($(this).val());
	});
	$("#newcoltrashhid").hide();
	$("#newcoltrash").change(function(){
		$("#newcoltrashhid").val($(this).val());
	});
	$("#newcolid").hide();
	$("#btn-login-submit").click(function(e){
		e.preventDefault();
		var logindata = {
		'usrLogin' : $("#accessemail").val(),
		'usrPswd' : $("#accesspass").val()
		};
		$.ajax({
	 		url: "../control/o.auth.user.php",
	  		data: logindata,
	  		type: "POST",
	  		dataType: "JSON"
		}).done(function(dataset){
			if(dataset["count"]==1){
				/*$("#message-success").show(1000);*/
				var routedata = {
					'type' : 'mainview',
					'code' : dataset["user"]
				}
				$.ajax({
					url: '../control/routes.php',
					data: routedata,
					type: "POST",
	  				dataType: "JSON"
				}).done(function(resultset){
					if(resultset[0]==1){
						window.location="../view/"+resultset[1]+"/index.php?gs="+resultset[2]+"&gd="+resultset[3];
					}else{
						swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR.responseText);
					swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
				})
			}else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Algo deu errado'
				})
			}
			
		})
		.fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	});

	$("#registerButton").click(function(e){
		e.preventDefault();
		var regdata = {
			'name' : $("#registername").val(),
			'email' : $("#registeremail").val(),
			'cpf' : $("#registercpf").val(),
			'rg' : $("#registerrg").val(),
			'address' : $("#registeraddress").val(),
			'number' : $("#registernumber").val(),
			'cep' : $("#registercep").val(),
			'bairro' : $("#registerbairro").val(),
			'cidade' : $("#registercidade").val(),
			'estado' : $("#registerestado").val(),
			'litro' : $("#registerlitro").val(),
			'phone' : $("#registerphone").val(),
			'pswd'  : $("#registerpswd").val(),
			'pj'    : $("#pjhid").val()
		};
		$.ajax({
	 		url: "../control/o.cad.user.php",
	  		data: regdata,
	  		type: "POST",
	  		dataType: "JSON"
		}).done(function(dataset){
			if(dataset[0]==1){
				var routedata = {
					'type' : 'firstaccess',
					'code' : dataset[1]
				}
				$.ajax({
					url: '../control/routes.php',
					data: routedata,
					type: "POST",
	  				dataType: "JSON"
				}).done(function(resultset){
					if(resultset[0]==1){
						window.location="../view/"+resultset[1]+"/index.php?gs="+resultset[2]+"&gd="+resultset[3];
					}else{
						swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR.responseText);
					swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
					})
				})
			}else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Algo deu errado'
				})
			}
		})
		.fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	});

	$(".tblcolbtncol").click(function(e){
		x = $(this).attr("id");
		routedata = {
			'type' : 'newcol',
			'code' : x
		}
		$.ajax({
			url: '../../control/routes.php',
			data: routedata,
			type: "POST",
				dataType: "JSON"
		}).done(function(resultset){
			if(resultset[0]==1){
				window.location="../"+resultset[1]+"/index.php?gs="+resultset[2]+"&gd="+resultset[3]+"gc="+x;
			}else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Algo deu errado'
				})
			}
		})
		.fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	});

	$("#newcolregister").click(function(e){
		e.preventDefault();
		processdata = {
		'type' : 'newcolregister',
		'diacol' : $("#newcolday").val(),
		'trashfull' : $("#newcoltrashhid").val(),
		'active' : $("#newcolcolhid").val(),
		'idcol' : $("#newcolid").val()
	};
	$.ajax({
		url: '../../control/o.new.coleta.php',
		data: processdata,
		type: "POST",
		dataType: "JSON"
	}).done(function(result){
		if(result[0]==1){
			swal(
			  'Sucesso!',
			  'Coleta cadastrada com sucesso!',
			  'success'
			);
		var routedata = {
          'type' : 'mycols',
          'code' : $("#usridhid").val()
        }
		$.ajax({
          url: '../../control/routes.php',
          data: routedata,
          type: "POST",
            dataType: "JSON"
        }).done(function(resultset){
          if(resultset[0]==1){
            window.location="../"+resultset[1]+"/index.php?gs="+resultset[2]+"&gd="+resultset[3];
          }else{
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'Algo deu errado'
            })
          }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
          console.log(jqXHR.responseText);
          swal({
              type: 'error',
              title: 'Oops...',
              text: 'Algo deu errado'
            })
        })
		}
	}).fail(function(jqXHR, textStatus, errorThrown){
		console.log(jqXHR.responseText);
		swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
	})

	});
	$(".btn-disable").click(function(e){
  		e.preventDefault();
  		xx = $(this).attr("id");
  		updateData = {
  			'type' : 'disable',
  			'code' : xx
  		};
  		$.ajax({
  			url: '../../control/o.update.status.php',
  			data: updateData,
  			type: "POST",
  			dataType: "JSON"
  		}).done(function(result){
  			if(result[0]==1){
  				swal(
				  'Sucesso!',
				  'Coleta atualizada com sucesso!',
				  'success'
				)
				edit= "#edit_"+xx;
  				$(edit).attr("disabled",true);
  				xx1 = "#"+xx;
  				$(xx1).removeClass("btn-danger");
  				$(xx1).removeClass("btn-disable");
  				$(xx1).addClass("btn-success");
  				$(xx1).addClass("btn-enable");
  				$(xx1).text("ATIVAR");
  			}else{
  				swal({
				  	type: 'error',
				  	title: 'Oops...',
				  	text: 'Algo deu errado'
				})
  			}
  		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})
	$(".btn-enable").click(function(e){
  		e.preventDefault();
  		xx = $(this).attr("id");
  		updateData = {
  			'type' : 'enable',
  			'code' : xx
  		};
  		$.ajax({
  			url: '../../control/o.update.status.php',
  			data: updateData,
  			type: "POST",
  			dataType: "JSON"
  		}).done(function(result){
  			if(result[0]==1){
  				swal(
				  'Sucesso!',
				  'Coleta atualizada com sucesso!',
				  'success'
				)
  				edit= "#edit_"+xx;
  				$(edit).removeAttr("disabled");
  				xx1 = "#"+xx;
  				$(xx1).removeClass("btn-success");
  				$(xx1).removeClass("btn-enable");
  				$(xx1).addClass("btn-danger");
  				$(xx1).addClass("btn-disable");
  				$(xx1).text("DESATIVAR");
  			}else{
  				swal({
				  	type: 'error',
				  	title: 'Oops...',
				  	text: 'Algo deu errado'
				})
  			}
  		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})
	$(".btn-edit").click(function(e){
  		e.preventDefault();
  		xx = $(this).attr("id");
  		updateData = {
  			'type' : 'coleta_edit',
  			'code' : xx
  		};
  		$.ajax({
  			url: '../../control/routes.php',
  			data: updateData,
  			type: "POST",
  			dataType: "JSON"
  		}).done(function(result){
  			if(result[0]==1){
  				window.location="../"+result[1]+"/index.php";
  			}else{
  				swal({
				  	type: 'error',
				  	title: 'Oops...',
				  	text: 'Algo deu errado'
				})
  			}
  		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	});
	$("#tbl-dash-relatorio").hide();
	$("#relatoriosubmit").click(function(e){
		e.preventDefault();
		datoform = {
			'dataini' : $("#dataini").val(),
			'datafin' : $("#datafim").val(),
			'code'	  : $("#pjhid")
		}
		$.ajax({
			url: '../../control/o.generate.report.php',
			data: datoform,
			type: "POST",
			dataType: "JSON"
		}).done(function(response){
			console.log(response);
			if(response[0]==1){
				$("#tbl-dash-relatorio").html($repsonse[1]);
				$("#tbl-dash-relatorio").show();
			}else if(response[0]==0){
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Sem datos para gerar relatório'
				})
			}else{
				swal({
				  	type: 'error',
				  	title: 'Oops...',
				  	text: 'Algo deu errado'
				})
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})

	$(".btnpjcoleta").click(function(){
		x = $(this).attr("id");
		param = {
			'type' : 'activecoletapj',
			'idcoleta' : x,
			'iduserpj' : $("#pjhid").val()
		}
		$.ajax({
			url: '../../control/o.update.pj.coleta.php',
			data: param,
			type: "POST",
			dataType: "JSON"
		}).done(function(response){
			if(response[0]==1){
				id_x = "#"+x;
				$(id_x).removeClass("btn-success");
				$(id_x).removeClass("btnpjcoleta");
				$(id_x).addClass("btn-danger");
				$(id_x).addClass("btnpjcoletadisable");
				$(id_x).text("DESATIVAR");
				swal(
				  'Sucesso!',
				  'Coleta atualizada com sucesso!',
				  'success'
				)
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	});
	$(".btnrequestcoleta").click(function(){
		x = $(this).attr("id");
		usrcode = $("#pjhid").val();
		param = {
			'type' : 'requestgarbage',
			'idcoleta' : x,
			'iduserpj' : usrcode
		}
		$.ajax({
			url: '../../control/o.request.garbage.php',
			data: param,
			type: "POST",
			dataType: "JSON"
		}).done(function(response){
			if(response[0]==1){
				var routedata = {
					'type' : 'mycols',
					'code' : usrcode
				}
				$.ajax({
					url: '../../control/routes.php',
					data: routedata,
					type: "POST",
	  				dataType: "JSON"
				}).done(function(resultset){
					if(resultset[0]==1){
						swal(
						  'Sucesso!',
						  'Coleta solicitada com sucesso!',
						  'success'
						)
						id_x = "#"+x;
						$(id_x).prop("disabled",true);
						$(id_x).text("AGUARDANDO AUTORIZAÇÃO");
					}else{
						swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR.responseText);
					swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
				})
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})
	$(".btnauthusergarbage").click(function(){
		id_usr = $("#pjhid").val();
		x = $(this).attr("id");
		params = {
			'type': 'updateAuthuser',
			'iduser' : id_usr,
			'codeColeta': x
		}
		$.ajax({
			url:'../../control/o.update.status.coleta.php',
			data: params,
			type: "POST",
			dataType: "JSON"
		}).done(function(response){
			if(response[0]==1){
				var routedata = {
					'type' : 'mycols',
					'code' : id_usr
				}
				$.ajax({
					url: '../../control/routes.php',
					data: routedata,
					type: "POST",
	  				dataType: "JSON"
				}).done(function(resultset){
					if(resultset[0]==1){
						swal(
						  'Sucesso!',
						  'Coleta solicitada com sucesso!',
						  'success'
						)
						id_x = "#"+x;
						$(id_x).prop("disabled",true);
						$(id_x).text("AUTORIZADO");
						$(id_x).removeClass("btnauthusergarbage");
					}else{
						swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR.responseText);
					swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
				})	
			}else{
				swal({
				  type: 'error',
				  title: 'Oops...',
				  text: 'Algo deu errado'
				})	
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})
	$(".btnfinalizacoleta").click(function(){
		x = $(this).attr("id");
		usrcode = $("#pjhid").val();
		param = {
			'type' : 'finalizacoleta',
			'idcoleta' : x,
			'iduserpj' : usrcode
		}
		$.ajax({
			url: '../../control/o.request.garbage.php',
			data: param,
			type: "POST",
			dataType: "JSON"
		}).done(function(response){
			if(response[0]==1){
				var routedata = {
					'type' : 'mycols',
					'code' : usrcode
				}
				$.ajax({
					url: '../../control/routes.php',
					data: routedata,
					type: "POST",
	  				dataType: "JSON"
				}).done(function(resultset){
					if(resultset[0]==1){
						swal(
						  'Sucesso!',
						  'Coleta solicitada com sucesso!',
						  'success'
						)
						id_x = "#"+x;
						$(id_x).prop("disabled",true);
						$(id_x).text("COLETA FINALIZADA");
						$(id_x).removeClass("btnfinalizacoleta");
					}else{
						swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
					}
				})
				.fail(function(jqXHR, textStatus, errorThrown){
					console.log(jqXHR.responseText);
					swal({
						  type: 'error',
						  title: 'Oops...',
						  text: 'Algo deu errado'
						})
				})
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})
	$(".btnratingpj").click(function(){
		x = $(this).attr("id");
		usrcode = $("#pjhid").val();
		param = {
			'type' : 'routeAvaliacao',
			'idcoleta' : x,
			'iduserpj' : usrcode
		}
		$.ajax({
			url: '../../control/route.rating.php',
			data: param,
			type: "POST",
			dataType: "JSON"
		}).done(function(resultset){
			if(resultset[0]==1){
				window.location="../"+resultset[1]+"/";
			}else{
				swal({
			  		type: 'error',
			  		title: 'Oops...',
			  		text: 'Algo deu errado'
				})	
			}
		}).fail(function(jqXHR, textStatus, errorThrown){
			console.log(jqXHR.responseText);
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Algo deu errado'
			})
		})
	})
})

!function(t){"use strict";t('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var o=t(this.hash);if((o=o.length?o:t("[name="+this.hash.slice(1)+"]")).length)return t("html, body").animate({scrollTop:o.offset().top-70},1e3,"easeInOutExpo"),!1}}),t(document).scroll(function(){100<t(this).scrollTop()?t(".scroll-to-top").fadeIn():t(".scroll-to-top").fadeOut()}),t(".js-scroll-trigger").click(function(){t(".navbar-collapse").collapse("hide")}),t("body").scrollspy({target:"#mainNav",offset:80});var o=function(){100<t("#mainNav").offset().top?t("#mainNav").addClass("navbar-shrink"):t("#mainNav").removeClass("navbar-shrink")};o(),t(window).scroll(o),t(".portfolio-item").magnificPopup({type:"inline",preloader:!1,focus:"#username",modal:!0}),t(document).on("click",".portfolio-modal-dismiss",function(o){o.preventDefault(),t.magnificPopup.close()}),t(function(){t("body").on("input propertychange",".floating-label-form-group",function(o){t(this).toggleClass("floating-label-form-group-with-value",!!t(o.target).val())}).on("focus",".floating-label-form-group",function(){t(this).addClass("floating-label-form-group-with-focus")}).on("blur",".floating-label-form-group",function(){t(this).removeClass("floating-label-form-group-with-focus")})})}(jQuery);
var name_val = ''
	var email_val = '';
	var phone_val = '';
	var msg_val = '';
	var comp_val = '';
	var emailRegex = /^[a-zA-Z0-9._]+[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z]{2,4}$/;
	var numericExpression = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;

(function($) {
	// FLexslider function
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation : "slide",
			animationLoop : false,
			itemWidth : 285,
			itemMargin : 20,
			start : function(slider) {
				$('body').removeClass('loading');
			}
		});
	});
	// FLexslider function
	// Logo Switch function
	$('.switch').click(function() {
		$(this).toggleClass('push');
		return false;
	})
	// Logo Switch function
	// Input Animation
	$(".flp label").each(function() {
		var sop = '<span class="ch">';
		var scl = '</span>';
		$(this).html(sop + $(this).html().split("").join(scl + sop) + scl);
		$(".ch:contains(' ')").html("&nbsp;")
	})
	var d;
	//animation time
	$(".flp input").focus(function() {
		var tm = $(this).outerHeight() / 2.1 * -1.1 + "px";

		$(this).next().addClass("focussed").children().stop(true).each(function(i) {
			d = i * 50;
			//delay
			$(this).delay(d).animate({
				top : tm
			}, 200, 'easeOutBack');
		})
	})
	$(".flp input").blur(function() {
		//animate the label down if content of the input is empty
		if ($(this).val() == "") {
			$(this).next().removeClass("focussed").children().stop(true).each(function(i) {
				d = i * 50;
				$(this).delay(d).animate({
					top : 0
				}, 500, 'easeInOutBack');
			})
		}
	})
	//animation time
	$(".flp textarea").focus(function() {
		//calculate movement for .ch = half of input heigh
		var tm = $(this).outerHeight() / 5 * -1.1 + "px";
		$(this).next().addClass("focussed").children().stop(true).each(function(i) {
			d = i * 50;
			//delay
			$(this).delay(d).animate({
				top : tm
			}, 200, 'easeOutBack');
		})
	})
	$(".flp textarea").blur(function() {
		//animate the label down if content of the input is empty
		if ($(this).val() == "") {
			$(this).next().removeClass("focussed").children().stop(true).each(function(i) {
				d = i * 50;
				$(this).delay(d).animate({
					top : 0
				}, 500, 'easeInOutBack');
			})
		}
	})
	// Input Animation End

	// Navigation
	$(window).scroll(function() {
		var abc = $(this).scrollTop()
		var position_holder = new Array();
		var i = 0;
		$('.anchorlink').each(function() {
			position_holder[i] = $(this).attr('rel');
			i++;
		});

		var curr_pos_win = $(this).scrollTop() + $('.main-nav').offset().top + $('.main-nav').height() - $(window).scrollTop();

		for ( i = (position_holder.length) - 1; i >= 0; i--) {
			if ($(position_holder[i]).offset().top < curr_pos_win) {
				$('.anchorlink').each(function() {
					if ($(this).attr('rel') == position_holder[i]) {
						var classCheck = $(this).attr('class');
						if (classCheck.indexOf("active") > -1) {

						} else {
							$('.anchorlink').removeClass('active_nav'); {
								$(this).addClass('active_nav');

							}

						}
					}
				});

				break;
			}
		}

	});

	$('[rel^="#"]').bind('click.smoothscroll', function(e) {
		e.preventDefault();

		var target = $(this).attr("rel");
		$target = $(target);
		goto = parseInt($target.offset().top) - parseInt(0)
		$('html, body').stop().animate({
			'scrollTop' : goto
		}, 500, 'swing', function() {

		});
	});
	// Navigation

	$('.theme-content').on('touchstart touchend', function(e) {
		//alert(22)
		// e.preventDefault();
		if ($('.theme-content').hasClass('hover_effect')) {
			//alert(2)
			$('.hover_effect').removeClass('hover_effect');
		}
		$(this).addClass('hover_effect');
		setTimeout(function() {
			$('.hover_effect').removeClass('hover_effect');
		}, 1000)

	});
	// var minusV =  15;
	// var intro = $('#intro-section').outerHeight(true) - minusV;
	// var aboutH = $('#about').outerHeight(true) + intro - minusV;
	// var portfolioH = $('#portfolio').outerHeight(true) + aboutH - minusV;
	// var common_featuresH = $('#common-features').outerHeight(true) + portfolioH - minusV;
	// var contactH = $('#contact').outerHeight(true) + common_featuresH - minusV;

	$(window).scroll(function() {
		if ($('li[rel^="#about"]').hasClass('active_nav')) {
			$('body').addClass('about_top');
		} else {
			$('.about_top').removeClass('about_top');
			$('.fortfolio_top').removeClass('fortfolio_top');
		}

		if ($('li[rel^="#portfolio"]').hasClass('active_nav')) {
			$('body').addClass('fortfolio_top');
		} else {
			$('.fortfolio_top').removeClass('fortfolio_top');
		}

		if ($('li[rel^="#common-features"]').hasClass('active_nav')) {
			$('body').addClass('feature_top');
		} else {
			$('.feature_top').removeClass('feature_top');
		}

		if ($('li[rel^="#contact"]').hasClass('active_nav')) {
			$('body').addClass('contactH');
		} else {
			$('.contactH').removeClass('contactH');
		}
	})
	//form validation
	$(".succses").hide();
	

	jQuery('#submit').click(function() {
		validateForm();
	});
	jQuery('#name,#company,#email,#msg,#phone').blur(function() {
		//var newvar = jQuery(this);
		validateForm2(this);
	});
	function validateForm2(abc) {
		//$('.input-field').removeClass('error');
		//name
		//alert(jQuery(abc).val());
		if (jQuery(abc).val() != "") {
			jQuery(abc).parent().removeClass('error');
			//name_val = $(abc).val();
		} else {
			jQuery(abc).parent().addClass('error');
		}
		//email
		if ($(abc).attr('id') == 'email') {
			if ((jQuery(abc).val() != "" || jQuery(abc).val() != null) && (jQuery(abc).val().match(emailRegex))) {
				jQuery(abc).parent().removeClass('error');
				//name_val = $(abc).val();
			} else {
				jQuery(abc).parent().addClass('error');
			}
		}
		//phone
		if ($(abc).attr('id') == 'phone') {
			if ((jQuery(abc).val() != "") && (jQuery(abc).val().match(numericExpression))) {
				jQuery(abc).parent().removeClass('error');
				//name_val = $(abc).val();
			} else {
				jQuery(abc).parent().addClass('error');
			}
		}
	}
	
})(jQuery);

function validateForm() {
		$('.input-field').removeClass('error');
		//name
		if (document.forms["myForm"]["name"].value != "") {
			$('#field1').removeClass('error');
			name_val = document.forms["myForm"]["name"].value;
		} else {
			$('#field1').addClass('error');
		}
		//company name
		if (document.forms["myForm"]["company"].value != "") {
			$('#field2').removeClass('error');
			comp_val = document.forms["myForm"]["company"].value;
		} else {
			$('#field2').addClass('error');
		}
		//email
		if ((document.forms["myForm"]["email"].value != null || document.forms["myForm"]["email"].value != "") && (document.forms["myForm"]["email"].value.match(emailRegex))) {
			$('#field4').removeClass('error');
			email_val = document.forms["myForm"]["email"].value;
		} else {
			$('#field4').addClass('error');
		}
		//phone number
		if ((document.forms["myForm"]["phone"].value != "") && (document.forms["myForm"]["phone"].value.match(numericExpression))) {
			$('#field3').removeClass('error');
			phone_val = document.forms["myForm"]["phone"].value;
		} else {
			$('#field3').addClass('error');

		}
		//message
		if (document.forms["myForm"]["msg"].value != "") {
			$('#field5').removeClass('error');
			msg_val = document.forms["myForm"]["msg"].value;
		} else {
			$('#field5').addClass('error');
		}
		
		
		if (name_val != '' && email_val != '' && phone_val != '' && comp_val != '' && msg_val != '') {
			$(".succses").fadeIn("slow");
			$.post('mail.php', {
				name : name_val,
				email : email_val,
				company : comp_val,
				phone : phone_val,
				msg : msg_val,
			}, function(data) {
				if (data == 1) {
					setTimeout(function() {
						//alert('messege sent successfull');
						document.forms["myForm"]["name"].value = "";
						document.forms["myForm"]["email"].value = "";
						document.forms["myForm"]["company"].value = "";
						document.forms["myForm"]["phone"].value = "";
						document.forms["myForm"]["msg"].value = "";
						$('#name,#company,#email,#msg,#phone').next().removeClass("focussed").children().stop(true).each(function(i) {
							d = i * 50;
							$(this).delay(d).animate({
								top : 0
							}, 500, 'easeInOutBack');
						})
						setTimeout(function() {
						$(".succses").css({'display':'none'});
						//jQuery('#name,#company,#email,#msg,#phone').next().removeClass("focussed");
						}, 5100);
					}, 500);

				}
			});
		}


	}


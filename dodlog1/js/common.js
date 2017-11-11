$(document).ready(function() {

	$(".btn_top_nav").click(function(){
		$(this).next().slideToggle();
	});
	$(".btn_block1_nav").click(function(){
		$(this).next().slideToggle()
	});

	$(".top-nav a,.block1-nav a,.footer-nav a").click(function(){
		var width = $('body').innerWidth();
		if(width<993)$(this).parent().parent().slideToggle();
	});

	$(".btn_close_nav").click(function(){
		$(this).parent().slideToggle();
	});

	$(".close-window-call").click(function(){
		$(this).parent().parent().slideToggle();
	});

	$(".open-window-call").click(function(){
		$(".call").slideToggle();
	});

	var link = $(".top-nav a");
	var $logo = $(".logo");
	var $nav = $(".top-nav");
	$(document).scroll(function () {
	    var s_top = $("body").scrollTop();
		var width = $('body').innerWidth();

	    if(s_top < 65 && width < 993){
	    	$logo.show();
	     	$nav.hide();
	    }else if(s_top > 65 && width < 992){
	    	$logo.hide();
	    	$nav.show();
	    }else if(width > 992){
	    	$logo.show();
	    	$nav.show();
	    }
 		
 		s_top = s_top+96;
 		var ad = $("#advantages").offset().top;
	    var os = $("#our_services").offset().top;
	    var co = $("#feedback").offset().top;
	    //console.log(s_top,os,pr,co);
	    if(s_top > ad && s_top < os){
			link.removeClass("active");
			$('a[href="#advantages"]').addClass("active");
	    }else if(s_top > os && s_top < co){
			link.removeClass("active");
			$('a[href="#our_services"]').addClass("active");
	    }else if(s_top > co){
			link.removeClass("active");
			$('a[href="#feedback"]').addClass("active");
	    }else{
	    	link.removeClass("active");
			$('a[href="#home"]').addClass("active");
	    }
	});

	$(window).resize(function () {
		var s_top = $("body").scrollTop();
		var width = $('body').innerWidth();
		if(width > 992){
	    	$logo.show();
	    	$nav.show();
	    }else if(width < 992 && s_top > 65){
	    	$logo.hide();
	    	$nav.show();
	    }else{
	    	$logo.show();
	     	$nav.hide();
	    }
	});

	//Таймер обратного отсчета
	//Документация: http://keith-wood.name/countdown.html
	//<div class="countdown" date-time="2015-01-07"></div>
	//var austDay = new Date($(".countdown").attr("date-time"));
	//$(".countdown").countdown({until: austDay, format: 'yowdHMS'});

	//Попап менеджер FancyBox
	//Документация: http://fancybox.net/howto
	//<a class="fancybox"><img src="image.jpg" /></a>
	//<a class="fancybox" data-fancybox-group="group"><img src="image.jpg" /></a>
	//$(".fancybox").fancybox();

	//Навигация по Landing Page
	//$(".top_mnu") - это верхняя панель со ссылками.
	//Ссылки вида <a href="#contacts">Контакты</a>
	$(".top-nav,.block1-nav,.footer-nav").navigation();

	//Добавляет классы дочерним блокам .block для анимации
	//Документация: http://imakewebthings.com/jquery-waypoints/
	$(".block1").waypoint(function(direction) {
		if (direction === "down") {
			$(".class").addClass("active");
		} else if (direction === "up") {
			$(".class").removeClass("deactive");
		};
	}, {offset: 100});

	//Плавный скролл до блока .div по клику на .scroll
	//Документация: https://github.com/flesler/jquery.scrollTo
	$(".block5 button").click(function() {
		$.scrollTo($("#feedback"), 800, {
			offset: -90
		});
	});

	//Кнопка "Наверх"
	//Документация:
	//http://api.jquery.com/scrolltop/
	//http://api.jquery.com/animate/
	$("#top").click(function () {
		$("body, html").animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	
	//Аякс отправка форм
	//Документация: http://api.jquery.com/jquery.ajax/
	$(".call .send").click(function() {
		$.ajax({
			type: "GET",
			url: "mail.php",
			data: $("form").serialize()
		}).done(function() {
			alert("Спасибо за заявку!");
			setTimeout(function() {
				$(".call").slideToggle();
				$('input').val("");
				$('textarea').val("");
			}, 1000);
		});
		return false;
	});//Аякс отправка форм
	//Документация: http://api.jquery.com/jquery.ajax/
	$(".btnBlock button").click(function() {
		$.ajax({
			type: "GET",
			url: "mail.php",
			data: $("form").serialize()
		}).done(function() {
			alert("Спасибо за заявку!");
			setTimeout(function() {
				$('input').val("");
				$('textarea').val("");
			}, 1000);
		});
		return false;
	});

});
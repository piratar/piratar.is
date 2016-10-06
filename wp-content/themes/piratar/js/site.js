$(function(){
	
    $('.site-main menu a').slice(0,-1).click(function(event) { 
		
		var currentId = $(this).parent().attr('id');
        if (currentId == "menu-item-38328" && "menu-item-30" ) {
		
            
        } else {
            
            event.preventDefault();
            $(".searchicon").removeClass('selected');
			$(".searchbox").hide();
            $("#mobile-back").addClass("on");
 
            if($(this).parent().hasClass("selected")) {
                $("#"+currentId).removeClass('selected');
                $("#svunta_"+currentId).hide();
                $('menu a').parent().removeClass('selected');
                $('.submenu').removeClass("open");
                $('.overlayer').removeClass("open");
                $("#mobile-back").removeClass("on");
            } else {
                $('menu li').removeClass('selected')
                $('.submenu div.rammi').hide();
                $(this).parent().addClass('selected');
                $("#svunta_"+currentId).show();	
                $('.submenu').addClass("open");
                $('.overlayer').addClass("open");

            }
            
        }

	});


    // Mobile menu

    $("#mobile-back").on("click", function(event){
        $('.submenu').removeClass("open");
        $('.submenu div.rammi').hide();
        $("#mobile-back").removeClass("on");
        event.preventDefault();
    });

    $("#mobile-button a").on("click", function(event){
        $("header .menubar").toggle();
        if (!$("body").hasClass("mobile-open")) {
            $("body").addClass("mobile-open");
        } else {
            $("body").removeClass("mobile-open");
            $('.submenu').removeClass("open");
            $('.overlayer').removeClass("open");
            $('.submenu div.rammi').hide();
        }
        event.preventDefault();
    });

    // Fixed menu kosningar

    if ($("body").hasClass("site-kosningar") && $(".menu-fixed").length) {

        moveMenu();

        $(window).resize(moveMenu);
    
        $(window).scroll(function(){

            moveMenu();

            var elm_top = $(".section-kosningar").offset().top;
            var scroll_top = $(window).scrollTop();

            if (elm_top - scroll_top < 112) {
                $("body").addClass("kosningar-fixed");
            } else {
                $("body").removeClass("kosningar-fixed");
            }

        });

        $(".menu-fixed li a").click(function(){
            elm = $(this).attr("href");
            $('html, body').animate({
                scrollTop: $(elm).offset().top - 150
            }, 250);
        });

    }

    function moveMenu() {
        if (document.documentElement.clientWidth > 976) {
            if (!$(".menu-fixed").hasClass("menu-moved")) {
                $(".menu-fixed").addClass("menu-moved").prependTo(".section-kosningar");
            }
        } else {
            if ($(".menu-fixed").hasClass("menu-moved")) {
                $(".menu-fixed").removeClass("menu-moved").prependTo(".section-kosningar .col-sm-12");
            }
        }
    }
    
    // Frambjóðendur

    $(".section-people .person").on("click", function(event){
        link = $(this).find(".person-wrap a").attr("href");
        if (event.ctrlKey || event.shiftKey || event.metaKey) {
            window.open(link, '_blank');
        } else {
            window.location = link;
        }
        //event.stopPropagation();
        event.preventDefault();
    });

    $('.overlayer').click(function() { 
		
		var currentId = $("menu .selected").attr('id');   
        $("#svunta_"+currentId).hide();
        $('menu a').parent().removeClass('selected');
        $('.submenu').removeClass("open");
        $('.overlayer').removeClass("open");


	});
    
    $('a.searchicon').click(function(event) { 
		var currentId = $(this).parent().attr('id');
		event.preventDefault();
	    event.stopPropagation();
		if($(this).hasClass("selected")) {
			$("header").removeClass("search-on");
			$(this).removeClass('selected');
            $('.overlayer').animate({ opacity: 0 },100);
			$(".searchbox").hide();
			
		} else {
            $("header").addClass("search-on");
			$("#menu-main-menu li").removeClass('selected');
            $(".submenu .rammi").hide();
            $('menu a').parent().removeClass('selected');
            $('.submenu').removeClass("open");
            $('.overlayer').removeClass("open");
            $(this).addClass('selected');
			$(".searchbox").show();
            $("header .searchbox form #s").focus();
            $("body").one("click", function(event){
                 if ($("header").hasClass("search-on")) {
                    $('a.searchicon').trigger("click");   
                 }
                 
            });
		}
        
	});

    $(".searchbox").on("click", function(event){
        event.stopPropagation();
    });
    
    var clientId = '6797026f054749d59c8e87943c3706e7';
	$(".instagram.tag").instagram({
        hash: "piratar",
		show: 15,
		clientId: clientId,
		//standard_resolution
		image_size:'thumbnail',
		onComplete : function (photos, data) {
			getImages();
			$(".instagram.tag").hide();
		}
	});

	function getImages() {
		$('#intagram1').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(1)").html());
		$('#intagram2').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(2)").html());
		$('#intagram3').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(3)").html());
		$('#intagram4').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(4)").html());
		$('#intagram5').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(5)").html());
		$('#intagram6').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(6)").html());
		$('#intagram7').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(7)").html());
		$('#intagram8').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(8)").html());
		$('#intagram9').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(9)").html());
		$('#intagram10').html("<div class='instagrammerki'><i class='fa fa-instagram'></i></div>" + $(".instagram-placeholder:nth-child(10)").html());
	}
    
    $.ajax({
        'url': 'https://apis.is/weather/observations/en',
        'type': 'GET',
        'dataType': 'json',
        'data': { 'stations' : '422', 'time' : '1h', 'anytime' : '1' },
        'success': function(response) {
        var data = response;
            $(".weatherhitastig").html(data.results[0].T + "° " + data.results[0].D + " " + data.results[0].FX + " m/s")

        }
    });

});

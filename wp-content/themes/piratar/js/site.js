$(function(){
	
    $('menu a').slice(0,-1).click(function(event) { 
		
		var currentId = $(this).parent().attr('id');
        if (currentId == "menu-item-38328" && "menu-item-30" ) {
		
            
        } else {
            
            event.preventDefault();
            $(".searchicon").removeClass('selected');
			$(".searchbox").hide();
 
            if($(this).parent().hasClass("selected")) {
                $("#"+currentId).removeClass('selected');
                $("#svunta_"+currentId).hide();
                $('menu a').parent().removeClass('selected');
                $('.submenu').removeClass("open");
                $('.overlayer').removeClass("open");
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

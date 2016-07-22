$(function(){
	
    $('#grunge').click(function(){
		//$(this).toggleClass('open');
	});
    
    $('menu a').click(function(event) { 
		console.log("click");
		var currentId = $(this).parent().attr('id');
        if (currentId == "menu-item-37244" && "menu-item-30" ) {
			
            
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
    
    currentPos = $(document).scrollTop();
	if (currentPos > 34) {
		//$("header").addClass("scroll");
	} else {
		//$("header").removeClass("scroll");
	}
    
    $('a.searchicon').click(function(event) { 
		var currentId = $(this).parent().attr('id');
		event.preventDefault();
	
		if($(this).hasClass("selected")) {
			
			$(this).removeClass('selected');
            $('.overlayer').animate({ opacity: 0 },100);
			$(".searchbox").hide();
			
		} else {
			$("#menu-main-menu li").removeClass('selected');
                //$(this).parent().addClass('selected');
                $(".submenu .rammi").hide();
                $('menu a').parent().removeClass('selected');
                $('.submenu').removeClass("open");
                $('.overlayer').removeClass("open");
            $(this).addClass('selected');
			$(".searchbox").show();
		}
        
	});
    
    $('.activatemap').click(function(event) { 
		$(".activatemap").hide();
	});
    
    $('#showtours a').click(function(event) { 
		var currentId = $(this).parent().attr('id');
        var currentTitle = $(this).attr('title');
        var currenthref = $(this).attr('href');
		event.preventDefault();
        $('.showtours').slick('slickUnfilter');
        $('.showtours').slick('slickFilter','.'+currentId);
        var filtered = true;

        $('div#filtertitle').html("<a href='"+currenthref+"'>View all tours in <strong>" + currentTitle + "</strong></a>")
        $('#showtours a').parent().removeClass('selected');
        if (currentId == "daytours") { 
            $('.toursdisplayed').show(); 
            $('.js-filter').parent().removeClass("selected");
            $(".toursdisplayed li:first").addClass("selected");
        } else {  
            $('.toursdisplayed').hide(); 
            $('.js-filter').parent().removeClass("selected");
            $(".toursdisplayed li:first").addClass("selected");
        }
        $('#'+currentId).addClass('selected');
	});
    
	
    
    SamuelLJackson();
    
    //var clientId = '81f0e65a47e14fda85d8983ddc2e6df8';
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

$(window).scroll(function () {
	topbar = $(".topbar").height();
	windowheight = $( window ).height()-topbar;
	currentPos = $(document).scrollTop();
	if (currentPos > 44) {
		//$("header").addClass("scroll");
	} else {
		//$("header").removeClass("scroll");
	}
});

function SamuelLJackson() {
	$(".stardinskiptirmali").html($(window).width());
	staerd = $(".wrapper").width()/6;
	$(".kynning").width(staerd*2);
	$(".facebook").width(staerd*2);
	$(".twitter").width(staerd);
	$(".instagram").width(staerd);
	$(".kynning, .facebook, .instagram, .twitter").height(staerd);
}
var d = new Date();
if (d.getHours() < 10) {
    getHours = "0" + d.getHours();
} else {
    getHours = d.getHours();
}
if (d.getMinutes() < 10) {
    getMinutes = "0" + d.getMinutes();
} else {
    getMinutes = d.getMinutes();
}
//document.getElementById("localtime").innerHTML = getHours + ":" + getMinutes;

//var myVar = setInterval(myTimer, 1000);

/*function myTimer() {
    var d = new Date();
    if (d.getHours() < 10) {
        getHours = "0" + d.getHours();
    } else {
        getHours = d.getHours();
    }
    if (d.getMinutes() < 10) {
        getMinutes = "0" + d.getMinutes();
    } else {
        getMinutes = d.getMinutes();
    }
    document.getElementById("localtime").innerHTML = getHours + ":" + getMinutes;
}*/
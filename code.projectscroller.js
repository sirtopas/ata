var currentPage;
var firstProject;
$(window).load(function () {
    $(function () {
        $('img.rollover').hover(function () {
            var e = $(this);
            e.data('originalSrc', e.attr('src'));
            e.attr('src', e.attr('data-rollover'));
        }, function () {
            var e = $(this);
            e.attr('src', e.data('originalSrc'));
        });
    });
$( ".indexProjectBoxImgHolder" ).mouseenter(function() {
$(this).children('img').fadeOut(500);
});
$( ".indexProjectBoxImgHolder" ).mouseleave(function() {
$(this).children('img').fadeIn(500);
});

});

$(document).keydown(function (e) {
    if (e.keyCode == 37 && !$("#lightbox").is(":visible")) {
        jQuery('html,body').animate({
            scrollTop: 0
        }, 0);
        $(".leftArrow:visible").each(function () {
            this.onclick();
        });
        jQuery('html,body').animate({
            scrollTop: 0
        }, 0);
        return false;
    }
});
$(document).keydown(function (e) {
    if (e.keyCode == 39 && !$("#lightbox").is(":visible")) {
        jQuery('html,body').animate({
            scrollTop: 0
        }, 0);
        $(".rightArrow:visible").each(function () {
            this.onclick();
        });
        jQuery('html,body').animate({
            scrollTop: 0
        }, 0);
        return false;
    }
});



$(document).ready(function () {
	$currentPage = 'home';
	loadProject('home','0');
	$firstProject = $('.projectContent:first').attr('id');
FastClick.attach(document.body);
$("#logo_header").hide();
});



function loadProject(projectId, currId) {
	$currentPage = projectId;
    jQuery('html,body').animate({
        scrollTop: 0
    }, 0);
    $('#' + currId).addClass('projectContent');
    $('#' + currId).addClass('projectContent');
    $("#L" + currId).hide();
    $("#R" + currId).hide();
    $("#L" + projectId).show();
    $("#R" + projectId).show();
    //$('.leftArrow:first').hide();
	
		
	if(projectId != "contact" && projectId != "news" && projectId != "home" && projectId != "index"){
		var currImages = $('#' + currId + ' img');
		var currList = $("#" + currId + " img");
		var images = $('#' + projectId + ' img');
		var listItems = $('#' + projectId + " img");
		
		listItems.each(function (idx, img) {
			var src = $(img).attr("src");
			$(img).attr("src", "../wp-content/themes/ata/loader.gif");
		});
		
		
			
		jQuery('html,body').animate({
			scrollTop: 0
		}, 0);
		$('#' + projectId).removeClass('projectContent');
		var $maxImgHeight = $(window).height() - 200;
		$('#newProject .lazy').css({
			"max-height": $maxImgHeight + 'px'
		});
		jQuery('html,body').animate({
			scrollTop: 0
		}, 0);
		
		var $maxImgHeight2 = $(window).height();
		$maxImgHeight2 = $maxImgHeight2 - 150;
		$('.lazy').css({
			"max-height": $maxImgHeight2 + 'px'
		});
		$("img.lazy").lazyload({
        effect: "fadeIn"
    });
	$('.projectFooter').hide();
	setLinkStatuses('projects');
	}
	else
	{
		$('.projectFooter').hide();
		$('#' + projectId).removeClass('projectContent');
		setLinkStatuses(projectId);
		$("img.lazy").lazyload({
        //effect: "fadeIn"
		
    });
	}
	
    jQuery('html,body').animate({
        scrollTop: 0
    }, 0);

    scrollTop: 0;
    var $toTop = $('.arrowDown');
    $toTop.fadeIn();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            //alert("test");
            $toTop.fadeOut();
        }
    });
}


function loadContact() {
var contactImages = $(".contactItem img");
    contactImages.each(function (idx, img) {
	//window.alert("width" + $(img).attr("width"));
	//window.alert("height" + $(img).attr("height"));
	//window.alert($(img).classes());
	$(img).show();
	$(img).addClass("lazy");
	$(img).width(300).height(300);
        $(img).attr("src", "../wp-content/themes/ata/loader_300.gif");
    });
    var $visibleProject = "";
    try {
        $visibleProject = $(".rightArrow:visible").first().attr("id");
        $visibleProject = $visibleProject.substring(1);
    } catch (err) {
        $visibleProject = $(".leftArrow:visible").first().attr("id");
        $visibleProject = $visibleProject.substring(1);
    }
	
    loadProject('contact', $visibleProject);
    $(".contactItem a").each(function () {
        $(this).addClass('lightbox_trigger');
    });

    setLinkStatuses('contact');
    $('.lightbox_trigger').click(function (e) {
        e.preventDefault();
		$('body').css("overflow-y","hidden");
        var image_href = $(this).attr("href");
        $('#lightbox').html('<img src="' + image_href + '" />');
        var $maxLightboxImgHeight = $(window).height() - 80;
        $('#lightbox img').css({
            "max-height": $maxLightboxImgHeight + 'px'
        });
		$('#lightbox img').css({
			"padding-top":  (($(window).height() - $(this).height()) / 8 ) + 'px'
		});
        $('#lightbox').fadeIn(500);
    });
	$('#lightbox').live('click', function () {
        $('#lightbox').fadeOut(500);
		$('body').css("overflow-y","scroll");
    });
}

function sortDate() {
$('div#indexCont').fadeTo('fast',0, function(){
    $('div#indexCont>div').tsort({attr:'data-yearstarted'},{attr:'data-yearcompleted'});
	$('div#indexCont').fadeTo('fast',1);
});
}

function sortStatus() {
$('div#indexCont').fadeTo('fast',0, function(){
	$('div#indexCont>div').tsort({attr:'data-status'});
	$('div#indexCont').fadeTo('fast',1);
});
}

function sortCategory() {
$('div#indexCont').fadeTo('fast',0, function(){
	$('div#indexCont>div').tsort({attr:'data-category'});
	$('div#indexCont').fadeTo('fast',1);
});
}

function sortLocation() {
$('div#indexCont').fadeTo('fast',0, function(){
	$('div#indexCont>div').tsort({attr:'data-uk'},{attr:'data-location'});
	$('div#indexCont').fadeTo('fast',1);
});
}

function sortProject() {
$('div#indexCont').fadeTo('fast',0, function(){
	$('div#indexCont>div').tsort({attr:'id'});
	$('div#indexCont').fadeTo('fast',1);
});
}

function loadNews() {

	var newsImages = $(".newsItem img");
    newsImages.each(function (idx, img) {
        $(img).attr("src", "../wp-content/themes/ata/loader_300.gif");
		$(img).removeClass();
		$(img).addClass('lazy');
    });
	var contactImages = $(".contactItem img");
    contactImages.each(function (idx, img) {
        $(img).attr("style", "");
		$(img).attr("src", "../wp-content/themes/ata/loader_300.gif");
    });
	
    loadProject('news', $currentPage);
	
    /*$("img.lazy").lazyload({
        effect: "fadeIn"
    });*/
    $(".newsItem a").each(function () {
        $(this).addClass('lightbox_trigger');
    });
    $('.lightbox_trigger').click(function (e) {
        e.preventDefault();
		$('body').css("overflow-y","hidden");
        var image_href = $(this).attr("href");
        $('#lightbox').html('<img src="' + image_href + '" />');
        var $maxLightboxImgHeight = $(window).height() - 80;
        $('#lightbox img').css({
            "max-height": $maxLightboxImgHeight + 'px'
        });
		$('#lightbox img').css({
			"padding-top":  0 + 'px'
		});
		$('#lightbox img').css({
			"padding-top":  (($(window).height() - $(this).height()) / 16) + 'px'
		});
        $('#lightbox').fadeIn(500);

    });
	$('#lightbox').live('click', function () {
        $('#lightbox').fadeOut(500);
		$('body').css("overflow-y","scroll");
    });
    setLinkStatuses('contact');
}

function loadIndex() {
    loadProject('index', $currentPage);
	setLinkStatuses('index');
}

function loadHome() {
    loadProject('home', $currentPage);
	setLinkStatuses('home');
}


jQuery(document).ready(function ($) {
    var lightbox =
        '<div id="lightbox">' +
        '</div>';
    $('body').append(lightbox);
    $('.lightbox_trigger').click(function (e) {
        e.preventDefault();
		$('body').css("overflow-y","hidden");
        var image_href = $(this).attr("href");
        $('#lightbox').html('<img src="' + image_href + '" />');
        var $maxLightboxImgHeight = $(window).height() - 80;
        $('#lightbox img').css({
            "max-height": $maxLightboxImgHeight + 'px'
        });
		
        $('#lightbox').fadeIn(500);

		$('#lightbox img').css({
			"padding-top":  (($(window).height() - $(this).height()) / 4 ) + 'px'
		});
    });
	var contactImages = $(".contactItem img");
    contactImages.each(function (idx, img) {
        var src = $(img).attr("src");
        $(img).attr("data-original", src);
        $(img).attr("src", "../wp-content/themes/ata/loader_300.gif");
        $(img).addClass('lazy');
    });
	var newsImages = $(".newsItem img");
    newsImages.each(function (idx, img) {
        var src = $(img).attr("src");
        $(img).attr("data-original", src);
        $(img).attr("src", "../wp-content/themes/ata/loader_300.gif");
        $(img).addClass('lazy');
    });
    $('#lightbox').live('click', function () {
        $('#lightbox').fadeOut(500);
		$('body').css("overflow-y","scroll");
    });

    $(window).resize(function () {
        $('#lightbox').css('height',  '100%');
        $('#lightbox img').css('height', 'auto');
		 $('#lightbox img').css('max-height', '95%');
		  
        var $maxContentImgHeight = $(window).height() * 0.8;
        $('#lightbox img').css({
            "max-height": $maxContentImgHeight + 'px'
        });
		var $maxImgHeight2 = $(window).height();
		$maxImgHeight2 = $maxImgHeight2 - 150;
		$('.lazy').css({
			"max-height": $maxImgHeight2 + 'px'
		});
		$('#lightbox img').css({
			"padding-top":  0 + 'px'
		});
		$('#lightbox img').css({
			"padding-top":  (($('#lightbox').height() - $(this).height()) / 4 ) + 'px'
		});
		// This is the code causing problems for rotating screen
    });
});


function loadProjects() {
           loadProject($firstProject, $currentPage);
}

$(function () {
    //Enable swiping...
        $("html").swipe({
        //Generic swipe handler for all directions
        swipeLeft: function (event, direction, distance, duration, fingerCount) {
            $(".rightArrow:visible").each(function () {
                this.onclick();
            });
        },
        swipeRight: function (event, direction, distance, duration, fingerCount) {
            $(".leftArrow:visible").each(function () {
                this.onclick();
            });
        },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold: 100
    });
});

function setLinkStatuses(currentPage) {
	if(currentPage == 'home')
	{
		$("#logo_header").hide();
	}
	else
	{
		$("#logo_header").show();
	}
    $('#homeLink').removeClass('active');
    $('#contactLink').removeClass('active');
	$('#projectsLink').removeClass('active');
	$('#indexLink').removeClass('active');
	$('#homeLink').addClass('inactive');
    $('#contactLink').addClass('inactive');
	$('#projectsLink').addClass('inactive');
	$('#indexLink').addClass('inactive');
	
	$('#' + currentPage + 'Link').addClass('active');
	
}

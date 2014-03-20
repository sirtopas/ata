$(function(){
    $('img.rollover').hover(function(){
        var e = $(this);
        e.data('originalSrc', e.attr('src'));
        e.attr('src', e.attr('data-rollover'));
    }, function(){
        var e = $(this);
        e.attr('src', e.data('originalSrc'));
    }); /* a preloader could easily go here too */
});
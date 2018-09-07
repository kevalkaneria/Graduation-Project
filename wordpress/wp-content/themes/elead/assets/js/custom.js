jQuery(document).ready(function($) {

/*------------------------------------------------
            PRELOADER
------------------------------------------------*/

$('#loader').fadeOut();
$('#loader-container').fadeOut();

/*------------------------------------------------
                BACK TO TOP
------------------------------------------------*/

 $(window).scroll(function(){
    if ($(this).scrollTop() > 1) {
    $('.backtotop').fadeIn();
    } else {
    $('.backtotop').fadeOut();
    }
    });
    $('.backtotop').click(function(){
    $('html, body').animate({scrollTop: '0px'}, 800);
    return false;
});

/*------------------------------------------------
                MENU ACTIVE AND STICKY
------------------------------------------------*/

$('.main-navigation ul li').click(function(){
    $('.main-navigation ul li').removeClass('current-menu-item');
    $(this).addClass('current-menu-item');
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();  
    if (scroll > 1) {
        $(".site-header.sticky-header").addClass("is-sticky");
    }
    else {
         $(".site-header.sticky-header").removeClass("is-sticky");
    }
});

$('.main-navigation .menu-toggle').click(function(){
    $('.main-navigation ul.menu').slideToggle();
});

$('.topbar-toggle').click(function(){
    $('.widget-area-wrapper').fadeToggle('open-topbar');
});

$('.main-navigation ul li.menu-item-has-children > a').click(function() {
   $(this).parent().find('.sub-menu').first().slideToggle();
   $(this).toggleClass('dropdown-toggled');
});

if ($(window).width() < 992) {
    $('.main-navigation .menu-toggle').click(function(){
       $('.widget-area-wrapper').css("display", "none");
    });

    $('.topbar-toggle').click(function(){
       $('.main-navigation ul.menu').css("display", "none");
       $('.main-navigation').removeClass('toggled');
    });
    $('.main-navigation ul.menu').css("display", "none");
}
else {
    $('.main-navigation ul.menu').css("display", "block");
}

$(window).resize(function(){
    if ($(window).width() < 992) {
        $('.main-navigation .menu-toggle').click(function(){
           $('.widget-area-wrapper').css("display", "none");
        });

        $('.topbar-toggle').click(function(){
           $('.main-navigation ul.menu').css("display", "none");
           $('.main-navigation').removeClass('toggled');
        });
    }
    else {
        $('.main-navigation ul.menu').css("display", "block");
    }

    if ($(window).width() > 992) {
        $('.topbar-toggle').click(function(){
           $('.main-navigation ul.menu').css("display", "block");
        });
    }
});
$(window).resize(function(){
if ($(window).width() < 992) {
   $('.top-bar .social-icons').insertAfter('.main-navigation .nav-menu');
} else {
   $('.main-navigation .social-icons').insertAfter('.top-bar #news-ticker');
}   

if ($(window).width() < 500) {
    $('#our-courses .hentry:nth-child(2) .course-single-link').insertBefore('#our-courses .hentry:nth-child(2) .entry-container');
}
else {
    $('#our-courses .hentry:nth-child(2) .course-single-link').insertAfter('#our-courses .hentry:nth-child(2) .entry-container');
}  
});

if ($(window).width() < 992) {
   $('.top-bar .social-icons').insertAfter('.main-navigation .nav-menu');
} else {
   $('.main-navigation .social-icons').insertAfter('.top-bar #news-ticker');
}

if ($(window).width() < 500) {
    $('#our-courses .hentry:nth-child(2) .course-single-link').insertBefore('#our-courses .hentry:nth-child(2) .entry-container');
}
else {
    $('#our-courses .hentry:nth-child(2) .course-single-link').insertAfter('#our-courses .hentry:nth-child(2) .entry-container');
}

$(window).resize(function(){

  $('.abroad-countries-list .hentry').mouseenter(function() {
        $('.abroad-countries-list .hentry').removeClass('active');
        $(this).addClass('active');
    });

    $('.abroad-countries-list .hentry').mouseleave(function() {
        $('.abroad-countries-list .hentry').removeClass('active');
        $('.abroad-countries-list .hentry:nth-child(2)').addClass('active');
    });

});

$('.hentry.sticky .entry-header ul.post-categories').insertAfter('.hentry.sticky .entry-header .entry-title');
$('.sticky .entry-footer').insertAfter('.sticky .entry-header ul.post-categories');



if( $(window).width() > 992 ) {
    var activeCountry = $('.abroad-countries-list .hentry:nth-child(2)');
    activeCountry.addClass('active');

    $('.abroad-countries-list .hentry').mouseenter(function() {
        $('.abroad-countries-list .hentry').removeClass('active');
        $(this).addClass('active');
    });

    $('.abroad-countries-list .hentry').mouseleave(function() {
        $('.abroad-countries-list .hentry').removeClass('active');
        $('.abroad-countries-list .hentry:nth-child(2)').addClass('active');
    });
}

/*------------------------------------------------
                SLIDER
-----------------------------)-------------------*/
var $ease = $('#main-slider').data('effect');

$("#main-slider").slick({
    cssEase: $ease
});

$('.news-ticker-slider').slick();

$(".testimonial-slider").slick({
    fade: true,
    cssEase: 'linear',
    customPaging : function(slider, i) {
        var thumb = $(slider.$slides[i]).data('thumb');
        return '<a><img src="'+thumb+'"></a>';
    },
});

$('.widget_post_slider .regular').slick();
/*------------------------------------------------
                    COUNTER   
------------------------------------------------*/
function count($this){
    var current = parseInt($this.html(), 10);
    current = current + 1; /* Where 50 is increment */
    $this.html(++current);
    if(current > $this.data('count')){
        $this.html($this.data('count'));
    } 
    else {    
        setTimeout(function(){count($this)}, 50);
    }
}        
    
$(".stat-count").each(function() {
    $(this).data('count', parseInt($(this).html(), 10));
    $(this).html('0');
    count($(this));
});



/*------------------------------------------------
                    PARALLAX   
------------------------------------------------*/
$.stellar({
    horizontalScrolling: false,
    verticalOffset: 3000
});

/*------------------------------------------------
                TABS -TEAM-SINGLE 
------------------------------------------------*/
$('.nav-tabs li').click(function() {
    var tab_id = $(this).attr('data-tab');

    $('ul.nav-tabs li').removeClass('active');
    $(this).addClass('active');
    $('.tab-content').removeClass('active');
    $('.tab-content').hide();
    $("#"+tab_id).show();
});

/*------------------------------------------------
                    COURSES    
------------------------------------------------*/
if( $(window).width() > 500 ) {
    $('.course-style .course-single-link').each(function(){
        $(this).siblings('.course-style .entry-container').after(this);
    });
}

/*------------------------------------------------
                    STICKY POST   
------------------------------------------------*/
if($('.blog .archive-blog-wrapper article').hasClass('sticky')) {
    $('body').addClass('has-sticky-post');
}
else {
    $('body').addClass('no-sticky-post');
}

$('.main-navigation .menu-item-has-children > a').after('<button class="dropdown-toggle" aria-expanded="false"><span class="screen-reader-text">expand child menu</span><i class="fa fa-angle-down"></i></button>');
$('.main-navigation button.dropdown-toggle').click(function() {
   $(this).toggleClass('active');
   $(this).parent().find('.sub-menu').first().slideToggle();
});
/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});
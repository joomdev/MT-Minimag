jQuery(function ($) {
    "use strict";
    /* ---------------------------------------------
    Menu Toggle 
    ------------------------------------------------ */
    $('.nav-toggler').click(function () {
        $('.navigation').toggleClass('show');
        $(this).toggleClass('open');
    });

    /* ---------------------------------------------
    Mobile Menus
    ------------------------------------------------ */
    $('li.menu-item-has-children span').click(function () {
        $(this).parent().toggleClass('open');
    });

    // Search Box
    $(".close").click(function () {
        $(".search-content").removeClass("open");
    });
    $(".header-search").click(function () {
        $(".search-content").addClass("open");
    });

    /* ---------------------------------------------
    Preloader
    ------------------------------------------------ */
    $(document).ready(function () {
        $('#wp-preloader').removeClass('d-flex');
        $('#wp-preloader').addClass('d-none');
    });

    /* ---------------------------------------------
    Back To Top
    ------------------------------------------------ */
    $(window).scroll(function () {
        // when page scrolled to 500px, enable back-to-top
        if ($(this).scrollTop() >= 500) {
            $('a#backtotop').fadeIn(500);
        } else {
            $('a#backtotop').fadeOut(500);
        }

        // when page scrolled to 100px, enable sticky header
        if ($(this).scrollTop() >= 100) {
            $('.enable-sticky-header').addClass('sticky-header');
        } else {
            $('.enable-sticky-header').removeClass('sticky-header');
        }
    });

    $("a#backtotop").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
    });

    /* ---------------------------------------------
    Infinite Scroll
    ------------------------------------------------ */

    // Hides Load More when posts are less
    var $nextLink = $('.pagination .next');
    if ( !$nextLink.length ) {
        $('.view-more-button').hide();
    }

    if (jQuery.fn.infiniteScroll) {
        $('.mtminimag-posts').infiniteScroll({
            path: '.pagination .next',
            append: 'article.entry-blog',
            hideNav: 'nav.pagination',
            responseType: 'document',
            button: '.view-more-button',
            scrollThreshold: false,
            history: false,
        });
    }

    // Adding .active class to first slide
    $("div.slides:first").addClass('active');

    /* ---------------------------------------------
    Offcanvas
    ------------------------------------------------ */
    $('body').click(function () {
        $('.offcanvas-icon').removeClass('open');
        $('.offcanvas-sidebar').removeClass('open');
    });    
    $('.offcanvas-icon').click( function () {
        $(this).toggleClass('open');
        $('.offcanvas-sidebar').toggleClass('open');
    });
    $('.offcanvas-icon, .offcanvas-sidebar').click(function (event) {
        event.stopPropagation();
    });

    /* ---------------------------------------------
    Slider
    ------------------------------------------------ */
    $('.carousel-item', '.partial-slides').each(function () {
        var next = $(this).next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo($(this));
    }).each(function () {
        var prev = $(this).prev();
        if (!prev.length) {
            prev = $(this).siblings(':last');
        }
        prev.children(':nth-last-child(2)').clone().prependTo($(this));
    });
});
(function ($) {
    "use strict";

    // var for header_fix
    var $header = $('#bx_main_header');
    var $header_fix = 'header_fix';
    var $t_offset = $('#bx_main_header').offset().top;
    // script for header_fix
    $(window).scroll(function () {
        if ($(this).scrollTop() > $t_offset) {
            $('#bx_main_header').addClass('header_fix');
            // $header.next().css('paddingTop', $t_offset);
        } else {
            $('#bx_main_header').removeClass('header_fix');
            // $header.next().css('paddingTop', '0px');

        }
    });
    // script for mobile menu
    var $menu_bar = $('.bx_manubar');
    var $menu = $('.bx_menu');
    var $overlay = $("<div class='overlay header'></div>");
    $('body').append($overlay);
    $overlay.hide();
    $menu_bar.on("click", function () {
        $menu.toggleClass('open');
        $menu_bar.children().toggleClass('close');
        $overlay.toggle();
    });
    $overlay.on("click", function () {
        $menu.removeClass('open');
        $menu_bar.children().removeClass('close');
        $overlay.hide();
    });

    // Banner slider
    $('.bx_banner_slider_content').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 1200,
        autoplayHoverPause: true,
        pagination: true,
        items: 1
    });
    // Popular author slider
    $('.best_seller_book_slider').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 800,
        autoplayHoverPause: true,
        pagination: true,
        responsiveClass: true,
        margin: 30,
        responsive: {
            0: {
                items: 2,
                nav: false,
                margin: 10,
                dots: false,
                slideBy:1
            },
            768: {
                items: 2,
                nav: false,
                margin: 10,
                dots: false,
                slideBy:2
            },
            1140: {
                items: 6,
                nav: true,
                loop: true,
                dots: false,
                slideBy:3
            }
        }
    });
    $('.bx_author_book_content').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 800,
        autoplayHoverPause: true,
        pagination: true,
        responsiveClass: true,
        margin: 30,
        responsive: {
            0: {
                items: 2,
                nav: false,
                margin: 10,
                dots: false,
                slideBy:1
            },
            768: {
                items: 2,
                nav: false,
                margin: 10,
                dots: false,
                slideBy:2
            },
            1140: {
                items: 6,
                nav: true,
                loop: true,
                dots: false,
                slideBy:3
            }
        }
    });

    $('.bx_book_details_slider').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 3000,
        smartSpeed: 800,
        autoplayHoverPause: true,
        pagination: true,
        responsiveClass: true,
        margin: 30,
        responsive: {
            0: {
                items: 2,
                nav: false,
                margin: 10,
                dots: false,
                slideBy:1
            },
            768: {
                items: 2,
                nav: false,
                margin: 10,
                dots: false,
                slideBy:2
            },
            1140: {
                items: 6,
                nav: true,
                loop: true,
                dots: false,
                slideBy:3
            }
        }
    });
    // Sponsor slider
    $('.bx_sponsor_content').owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 1000,
        autoplayHoverPause: true,
        pagination: false,
        responsiveClass: true,

        responsive: {
            0: {
                items: 2,
                nav: false,
                dots: false,
                center: true,
            },
            600: {
                items: 3,
                nav: false,
                dots: false,
            },
            1140: {
                items: 6,
                nav: false,
                loop: true,
                dots: false,
            }
        }
    });
    /**
     * back to top button
     */
    var mybutton = $("#bx_back_to_top");
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            mybutton[0].style.display = "block";
        } else {
            mybutton[0].style.display = "none";
        }
    }

    mybutton.on("click", function () {
        topFunction();
    });

    function topFunction() {
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
        return false;
    }
    /**
     * menu var
     */
    var author_menu = $('#bx_nav_author'),
     author_menu_item = $('#bx_nav_author_menu');
    author_menu.hover(function () {
        author_menu_item.addClass('sub_menu_show');
        author_menu_item.hover(function () {
            $(this).addClass('sub_menu_show');
        }, function () {
            $(this).removeClass('sub_menu_show');
        });
    },
    function () {
        author_menu_item.removeClass('sub_menu_show');
    }
    );
    var publisher_menu = $('#bx_nav_publisher'),
     publisher_menu_item = $('#bx_nav_publisher_menu');
     publisher_menu.hover(function () {
        publisher_menu_item.addClass('sub_menu_show');
        publisher_menu_item.hover(function () {
            $(this).addClass('sub_menu_show');
        }, function () {
            $(this).removeClass('sub_menu_show');
        });
    },
    function () {
        publisher_menu_item.removeClass('sub_menu_show');
    }
    );


})(jQuery);

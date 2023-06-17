(function ($) {

    /*-------------------------------------
    On Scroll
    -------------------------------------*/
    $(window).on('scroll', function () {
        // Sticky Header
        if ($('body').hasClass('sticky-header')) {
            var stickyPlaceHolder = $("#rt-sticky-placeholder");
            var mainMenu = $("#header-menu");
            var menuHeight = mainMenu.outerHeight() || 0;
            var headerTopbar = $('#header-topbar').outerHeight() || 0;
            var targrtScroll = headerTopbar + menuHeight;

            // Main Menu
            if ($(window).scrollTop() > targrtScroll) {
                mainMenu.addClass('rt-sticky');
                stickyPlaceHolder.height(menuHeight);
            } else {
                mainMenu.removeClass('rt-sticky');
                stickyPlaceHolder.height(0);
            }

            //Mobile Menu
            var mobileMenu = $("#meanmenu");
            var mobileTopHeight = $('#mobile-menu-sticky-placeholder');

            if ($(window).scrollTop() > mobileMenu.outerHeight() + headerTopbar) {
                mobileMenu.addClass('rt-sticky');
                mobileTopHeight.height(mobileMenu.outerHeight());
            } else {
                mobileMenu.removeClass('rt-sticky');
                mobileTopHeight.height(0);
            }
        }
    });

    /*-------------------------------------
    On load and resize
    -------------------------------------*/
    $(window).on("load resize", function () {
        if (MyThemeObj.myThemeStickySidebar === 'enable') {
            $('#sticky_sidebar').myThemeStickySidebar({
                additionalMarginTop: Number(MyThemeObj.lsSideOffset) + 10,
                additionalMarginBottom: 20,
            });
        }
    });

    /*-------------------------------------
    Tooltip
    -------------------------------------*/
    $('[data-toggle="tooltip"]').tooltip();

    /*-------------------------------------
    Video Popup
    -------------------------------------*/
    var yPopup = $(".popup-youtube");
    if (yPopup.length) {
        yPopup.magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }

    function rtPreloader() {
        var $preloader = $('#preloader');
        if (!$preloader.length) {
            return;
        }
        $preloader.delay(1000).fadeOut('slow');
    }

    // Window Ready
    jQuery(document).ready(function ($) {
        rtPreloader();

        $('.input-group .form-control').on('focus', function () {
            $(this).parent('.input-group').addClass('active');
        }).on('focusout', function () {
            $(this).parent('.input-group').removeClass('active');
        });


        /* Scroll to top */
        $('.scrollToTop').on('click', function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('.scrollToTop').fadeIn();
            } else {
                $('.scrollToTop').fadeOut();
            }
        });


        // Mobile Menu

        var mobileMenu = $('.offscreen-navigation nav ul');

        if (mobileMenu.length) {
            mobileMenu.children("li").addClass("menu-item-parent");

            mobileMenu.find(".menu-item-has-children > a, .page_item_has_children > a").append('<span class="pointer"></span>')
            mobileMenu.find(".menu-item-has-children > a > .pointer, .page_item_has_children > a > .pointer").on("click", function (e) {
                e.preventDefault();
                $(this).parent().toggleClass("opened");
                var n = $(this).parent().next(".sub-menu, .children"),
                    s = $(this).parent().closest(".menu-item-parent").find(".sub-menu, .children");
                //mobileMenu.find(".sub-menu, .children").not(s).slideUp(250).prev('a').removeClass('opened'); 
                n.slideToggle(250);
            });

            mobileMenu.find('.menu-item:not(.menu-item-has-children, .page_item_has_children) > a').on('click', function (e) {
                $('.rt-slide-nav').slideUp();
                $('body').removeClass('slidemenuon');
            });
        }


        $('.sidebarBtn.circle-btn').on('click', function (e) {
            e.preventDefault();
            $('.overly-sidebar-wrapper').addClass('show');
            $('.offcanvas-menu-btn').addClass('menu-status-open');
        });

        $('.mean-bar .sidebarBtn').on('click', function (e) {
            e.preventDefault();

            if ($('.rt-slide-nav').is(":visible")) {
                $('.rt-slide-nav').slideUp();
                $('body').removeClass('slidemenuon');
            } else {
                $('.rt-slide-nav').slideDown();
                $('body').addClass('slidemenuon');
            }

        });

    });

    // Window Load
    $(window).on('load', function () {
        // Scripts needs loading inside content area
        mytheme_content_load_scripts();
    });

    // Elementor Frontend Load
    $(window).on('elementor/frontend/init', function () {
        if (elementorFrontend.isEditMode()) {
            elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
                mytheme_content_load_scripts();
            });
        }
    });

    function mytheme_content_load_scripts() {
        console.log('init')
    }

})(jQuery);
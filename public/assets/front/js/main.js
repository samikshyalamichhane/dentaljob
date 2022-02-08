(function($) {
    "use strict";

    $(".site-menu-toggle").click(function() {
        var $this = $(this);
        if ($("body").hasClass("menu-open")) {
            $this.removeClass("open");
            $(".js-site-navbar").fadeOut(400);
            $("body").removeClass("menu-open");
        } else {
            $this.addClass("open");
            $(".js-site-navbar").fadeIn(400);
            $("body").addClass("menu-open");
        }
    });

    $(document).ready(function() {
        $(".close-nav").click(function() {
            $(".site-navbar").slideToggle("slow");
            $(".site-menu-toggle").removeClass("open");
        });
    });

    $("#datepicker-range-start").Zebra_DatePicker({
        direction: true,
        pair: $("#datepicker-end"),
        default_position: "above",
        container: $(".vertical-calendar-box"),
    });

    $("#datepicker-range-end").Zebra_DatePicker({
        direction: 1,
        default_position: "above",
        container: $(".veritcal-calendar-box1"),
    });
    $("nav .dropdown").hover(
        function() {
            var $this = $(this);
            $this.addClass("show");
            $this.find("> a").attr("aria-expanded", true);
            $this.find(".dropdown-menu").addClass("show");
        },
        function() {
            var $this = $(this);
            $this.removeClass("show");
            $this.find("> a").attr("aria-expanded", false);
            $this.find(".dropdown-menu").removeClass("show");
        }
    );

    $("#dropdown04").on("show.bs.dropdown", function() {
        console.log("show");
    });

    // aos
    AOS.init({
        duration: 1000,
    });

    // home slider
    $(".home-slider").owlCarousel({
        loop: true,
        autoplay: true,
        margin: 10,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        nav: true,
        autoplayHoverPause: true,
        items: 1,
        autoheight: true,
        navText: [
            "<span class='ion-chevron-left'></span>",
            "<span class='ion-chevron-right'></span>",
        ],
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            600: {
                items: 1,
                nav: false,
            },
            1000: {
                items: 1,
                nav: true,
            },
        },
    });

    // owl carousel
    var majorCarousel = $(".js-carousel-1");
    majorCarousel.owlCarousel({
        loop: true,
        autoplay: true,
        stagePadding: 7,
        margin: 20,
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        nav: true,
        autoplayHoverPause: true,
        items: 3,
        navText: [
            "<span class='ion-chevron-left'></span>",
            "<span class='ion-chevron-right'></span>",
        ],
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            600: {
                items: 2,
                nav: false,
            },
            1000: {
                items: 3,
                nav: true,
                loop: false,
            },
        },
    });

    // owl carousel
    var major2Carousel = $(".js-carousel-2");
    major2Carousel.owlCarousel({
        loop: true,
        autoplay: true,
        stagePadding: 7,
        margin: 20,
        // animateOut: 'fadeOut',
        // animateIn: 'fadeIn',
        nav: true,
        autoplayHoverPause: true,
        autoHeight: true,
        width: 50,
        items: 1,
        navText: [
            "<span class='ion-chevron-left'></span>",
            "<span class='ion-chevron-right'></span>",
        ],
        responsive: {
            0: {
                items: 1,
                nav: false,
                loop: true,
            },
        },
    });

    var siteStellar = function() {
        $(window).stellar({
            responsive: false,
            parallaxBackgrounds: true,
            parallaxElements: true,
            horizontalScrolling: false,
            hideDistantElements: false,
            scrollProperty: "scroll",
        });
    };
    siteStellar();

    var smoothScroll = function() {
        var $root = $("html, body");

        $('a.smoothscroll[href^="#"]').click(function() {
            $root.animate({
                    scrollTop: $($.attr(this, "href")).offset().top,
                },
                500
            );
            return false;
        });
    };
    smoothScroll();

    // var dateAndTime = function() {
    //     $('#m_date').datepicker({
    //         'format': 'm/d/yyyy',
    //         'autoclose': true
    //     });
    //     $('#checkin_date, #checkout_date').datepicker({
    //         'format': 'd MM, yyyy',
    //         'autoclose': true
    //     });
    //     $('#m_time').timepicker();
    // };
    // dateAndTime();

    var windowScroll = function() {
        $(window).scroll(function() {
            var $win = $(window);
            if ($win.scrollTop() > 200) {
                $(".js-site-header").addClass("scrolled");
                $(".Zebra_DatePicker").addClass("bottom-space");
                $(".site-logo").addClass("small-height");
            } else {
                $(".js-site-header").removeClass("scrolled");
                $(".Zebra_DatePicker").addClass("bottom-space");
                $(".site-logo").removeClass("small-height");
            }
        });
    };
    windowScroll();

    var goToTop = function() {
        $(".js-gotop").on("click", function(event) {
            event.preventDefault();

            $("html, body").animate({
                    scrollTop: $("html").offset().top,
                },
                500,
                "easeInOutExpo"
            );

            return false;
        });

        $(window).scroll(function() {
            var $win = $(window);
            if ($win.scrollTop() > 200) {
                $(".js-top").addClass("active");
            } else {
                $(".js-top").removeClass("active");
            }
        });
    };
})(jQuery);

async function checkRoom(datas, url) {
    $(".loading").removeClass("d-none");
    try {
        const formData = {
            datas,
        };
        const { data } = await axios.post(url, formData);

        $(".loading").addClass("d-none");

        if (data.status) {
            alert(data.message);
        }
        if (data.available) {
            $(".roomContent").html(data.html);
            $("#checkAvailabiltyModal").modal();
        }
    } catch (error) {
        $(".loading").addClass("d-none");
        console.log(error.response.data.message);
    }
}
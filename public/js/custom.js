// on scroll fixed shrink  nav 
$(window).on("scroll", function() {
    if ($(window).scrollTop()) {
        $('nav').addClass('nav-scroll');
        $('a.navbar-brand').addClass('display');
        $('a.nav-link').addClass('text-black');

    } else {
        $('nav').removeClass('nav-scroll');
        $('.mega-menu').removeClass('p-left');
        $('a.navbar-brand').removeClass('display');
        $('a.nav-link').removeClass('text-black');
    }
})

//  on click close side nav
$(function() {
    var navMain = $(".navbar-collapse");
    navMain.on("click", "a:not([data-toggle])", null, function() {
        navMain.collapse('hide');
    });
    $('.close-nav-btn').on('click', function() {
        $('.navbar-collapse').toggleClass('show');
    });
    // scroll top
    $(window).scroll(function() {
        if ($(this).scrollTop() > 500) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });
    // back to top btn
    $('#back-to-top').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 500);
        return false;
    });
    // close complete profile section
    $('.close-btn').click(function() {
        $('.d-complete-profile').addClass('d-none');
    });

    // edit  job seeker profile
    $('.edit-btn').click(function() {
        $('.basic-info-box').toggleClass('d-none');
        $('.basic-info-form').toggleClass('display-block');
    });
    // preferred loction
    $(".checked").click(function() {
        if ($(this).is(":checked")) {
            $(".preferred-address").show(300);
        } else {
            $(".preferred-address").hide(200);
        }
    });
    $(".unchecked").click(function() {
        $(".preferred-address").hide(200);
    });
    // planned date
    // $(".preferred-date").hide();
    // $(".checked-date").click(function() {
    //     if ($(this).is(":checked")) {
    //         $(".preferred-date").show(300);
    //     } else {
    //         $(".preferred-date").hide(200);
    //     }
    // });
    // $(".no-date").click(function() {
    //     $(".preferred-date").hide(200);
    // });

    $(".preferred-date").hide();
    $(".start_date_yes").click(function() {
        if ($(this).is(":checked")) {
            $(".preferred-date").show(300);
        } else {
            $(".preferred-date").hide(200);
        }
    });
    $(".start_date_no").click(function() {
        $(".preferred-date").hide(200);
    });

    // $(document).ready(function() {
    //     if ($('#sdy').is(':checked')) {
    //         $(".preferred-date").show(300);
    //     }
    // });


    // range salary
    $(".salary-input-range").hide();
    $(".range-salary").click(function() {
        if ($(this).is(":checked")) {
            $(".salary-input-range").show(300);
            $(".salary-input-fixed").hide(200);
        } else {
            $(".salary-input-range").hide(200);

        }
    });
    // fixed salary
    $(".salary-input-fixed").hide();
    $(".fixed-salary").click(function() {
        if ($(this).is(":checked")) {
            $(".salary-input-fixed").show(300);
            $(".salary-input-range").hide(200);
        } else {
            $(".salary-input-fixed").hide(200);
        }
    });
    $(".negotiable-salary").click(function() {
        if ($(this).is(":checked")) {
            $(".salary-input-fixed").hide(300);
            $(".salary-input-range").hide(200);
        }
    });

    // salary
    // on check other uncheck
    $('input.tick').on('change', function() {
        $('input.tick').not(this).prop('checked', false);
    });
    $('input.tick-one').on('change', function() {
        $('input.tick-one').not(this).prop('checked', false);
    });
    $('input.tick-two').on('change', function() {
        $('input.tick-two').not(this).prop('checked', false);
    });
    $('input.tick-three').on('change', function() {
        $('input.tick-three').not(this).prop('checked', false);
    });
    $('input.tick-four').on('change', function() {
        $('input.tick-four').not(this).prop('checked', false);
    });
    // $('.close-nav').on('click', function() {
    //     $('.navbar-collapse').removeClass('show');
    // }); 
    // active nav
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('a');
    const menuLength = menuItem.length
    for (i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].className = 'active'
        }
    }
    // add more input
    "use strict";

    var itemTemplate = $('.example-template').detach(),
        editArea = $('.work-form'),
        itemNumber = 1;

    $(document).on('click', '.add-work-box  .add_field_button', function(event) {
        var item = itemTemplate.clone();
        item.find('[id]').attr('id', function() {
            return $(this).attr('id') + '_' + itemNumber;
        });
        ++itemNumber;
        item.appendTo('.work-form');
        $('.save-btn').addClass('d-block');

    });

    // $(document).on('click', '.work-form  .rem', function(event) {
    //     editArea.children('.example-template').last().remove();
    // });
    $(document).on('click', '.work-form .del', function(event) {
        var target = $(event.target),
            row = target.closest('.example-template');
        row.remove();
    });

    // image preview
    $(function() {
        Test = {
            UpdatePreview: function(obj) {
                // if IE < 10 doesn't support FileReader
                if (!window.FileReader) {
                    // don't know how to proceed to assign src to image tag
                } else {
                    var reader = new FileReader();
                    var target = null;

                    reader.onload = function(e) {
                        target = e.target;
                        $("img").prop("src", target.result);
                    };
                    reader.readAsDataURL(obj.files[0]);
                }
            }
        };
    });
    // pdf preview
    $("#myResume").on("change", function(e) {
        var file = e.target.files[0]
        if (file.type == "application/pdf") {
            var fileReader = new FileReader();
            fileReader.onload = function() {
                var pdfData = new Uint8Array(this.result);
                // Using DocumentInitParameters object to load binary data.
                var loadingTask = pdfjsLib.getDocument({
                    data: pdfData
                });
                loadingTask.promise.then(function(pdf) {
                    console.log('PDF loaded');

                    // Fetch the first page
                    var pageNumber = 1;
                    pdf.getPage(pageNumber).then(function(page) {
                        console.log('Page loaded');

                        var scale = .9;
                        var viewport = page.getViewport({
                            scale: scale
                        });
                        // Prepare canvas using PDF page dimensions
                        var canvas = $("#pdfViewer")[0];
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        // Render PDF page into canvas context
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        var renderTask = page.render(renderContext);
                        renderTask.promise.then(function() {
                            console.log('Page rendered');
                        });
                    });
                }, function(reason) {
                    // PDF loading error
                    console.error(reason);
                });
            };
            fileReader.readAsArrayBuffer(file);
        }
    });
    $("#myCoverLetter").on("change", function(e) {
        var file = e.target.files[0]
        if (file.type == "application/pdf") {
            var fileReader = new FileReader();
            fileReader.onload = function() {
                var pdfData = new Uint8Array(this.result);
                // Using DocumentInitParameters object to load binary data.
                var loadingTask = pdfjsLib.getDocument({
                    data: pdfData
                });
                loadingTask.promise.then(function(pdf) {
                    console.log('PDF loaded');

                    // Fetch the first page
                    var pageNumber = 1;
                    pdf.getPage(pageNumber).then(function(page) {
                        console.log('Page loaded');

                        var scale = .9;
                        var viewport = page.getViewport({
                            scale: scale
                        });

                        // Prepare canvas using PDF page dimensions
                        var canvas = $("#pdfViewerOne")[0];
                        var context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;

                        // Render PDF page into canvas context
                        var renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        var renderTask = page.render(renderContext);
                        renderTask.promise.then(function() {
                            console.log('Page rendered');
                        });
                    });
                }, function(reason) {
                    // PDF loading error
                    console.error(reason);
                });
            };
            fileReader.readAsArrayBuffer(file);
        }
    });


});
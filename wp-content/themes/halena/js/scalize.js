(function ($) {
    "use strict";

    //----------------------------------------//
    // Variable
    //----------------------------------------//
    var variable = {
        width: 0,
        height: 0,
        selector: '.item-point',
        styleSelector: 'circle',
        animationSelector: '',
        animationPopoverIn: '',
        animationPopoverOut: '',
        onInit: null,
        getSelectorElement: null,
        getValueRemove: null
    }

    //----------------------------------------//
    // Scaling
    //----------------------------------------//
    var scaling = {
        settings: null,
        //----------------------------------------//
        // Initialize
        //----------------------------------------//
        init: function (el, options) {
            this.settings = $.extend(variable, options);
            this.event(el);

            scaling.layout(el);
            $(window).on('load', function () {
                scaling.layout(el);
            });
            $(el).find('.scalize-target').on('load', function () {
                scaling.layout(el);
            });
            $(window).on('resize', function () {
                scaling.layout(el);
            });
        },

        //----------------------------------------//
        // Event
        //----------------------------------------//
        event: function (elem) {

            // Set Style Selector
            if (this.settings.styleSelector) {
                $(this.settings.selector).addClass(this.settings.styleSelector);
            }

            // Set Animation
            if (this.settings.animationSelector) {
                if (this.settings.animationSelector == 'marker') {
                    $(this.settings.selector).addClass(this.settings.animationSelector);
                    $(this.settings.selector).append('<div class="pin"></div>')
                    $(this.settings.selector).append('<div class="pulse"></div>')
                } else {
                    $(this.settings.selector).addClass(this.settings.animationSelector);
                }
            }

            // Event On Initialize
            if ($.isFunction(this.settings.onInit)) {
                this.settings.onInit();
            }

            // Content add class animated element
            $(elem).find('.scalize-content').addClass('animated');

            // Wrapper selector hide by Agnihd
            //$(this.settings.selector).wrapAll( "<div class='wrap-selector' />");

            // Wrapper selector added  by Agnihd
            $(this.settings.selector).parents(elem.selector).each(function () {
                var $par = $(this);
                $par.find(scaling.settings.selector).wrapAll("<div class='wrap-selector' />");
            })

            // Event Selector
            $(this.settings.selector).each(function () {
                // Toggle
                $('.toggle', this).on('click', function (e) {

                    e.preventDefault();
                    $(this).closest(scaling.settings.selector).toggleClass('active');

                    // Selector Click
                    var content = $(this).closest(scaling.settings.selector).data('scalize-popover'),
                        id = $(content);

                    if ($(this).closest(scaling.settings.selector).hasClass('active') && !$(this).closest(scaling.settings.selector).hasClass('disabled')) {
                        if ($.isFunction(scaling.settings.getSelectorElement)) {
                            scaling.settings.getSelectorElement($(this).closest(scaling.settings.selector));
                        }
                        //id.fadeIn();
                        id.delay(1).slideDown();
                        scaling.layout(elem);
                        id.removeClass(scaling.settings.animationPopoverOut);
                        id.addClass(scaling.settings.animationPopoverIn);
                    } else {
                        if ($.isFunction(scaling.settings.getValueRemove)) {
                            scaling.settings.getValueRemove($(this).closest(scaling.settings.selector));
                        }
                        id.removeClass(scaling.settings.animationPopoverIn);
                        id.addClass(scaling.settings.animationPopoverOut);
                        //id.delay(200).fadeOut();
                        id.slideUp();
                    }
                });

                // Exit
                var target = $(this).data('scalize-popover'),
                    idTarget = $(target);
                idTarget.find('.exit').on('click', function (e) {
                    e.preventDefault();
                    // selector.removeClass('active');
                    $('[data-scalize-popover="' + target + '"]').removeClass('active');
                    idTarget.removeClass(scaling.settings.animationPopoverIn);
                    idTarget.addClass(scaling.settings.animationPopoverOut);
                    //idTarget.delay(200).fadeOut();
                    idTarget.slideUp();
                });
            });
        },

        //----------------------------------------//
        // Layout
        //----------------------------------------//
        layout: function (elem) {

            $(elem).each(function () {
                // Get Original Image
                var image = new Image();
                image.src = $(this).find('.scalize-target').attr("src");

                var image_width = $(this).find('.scalize-target').attr("width"),
                    image_height = $(this).find('.scalize-target').attr("height");

                // Variable
                var width = image_width, //image.naturalWidth,
                    height = image_height, //image.naturalHeight,
                    getWidthLess = $(this).width(),
                    parentWidth = $(this).parent().width(),
                    setPersenWidth = getWidthLess / width * 100,
                    setHeight = height * setPersenWidth / 100;

                // Set Heigh Element
                $(this).css("height", setHeight);

                // Resize Width modified by AgniHD
                // if( $(window).width() < width ){ // hide by AgniHD
                if (parentWidth < width) {
                    $(this).stop().css("width", "100%");
                } else {
                    $(this).stop().css("width", width);
                }
            })

            // Set Position Selector modified by AgniHD
            $(this.settings.selector).each(function () {

                var getCoordinates = $(this).data("scalize-coordinates").split(',');

                // Get Original Image
                var image_new = new Image();
                image_new.src = $(this).parents(elem.selector).find('.scalize-target').attr("src");

                var image_new_width = $(this).parents(elem.selector).find('.scalize-target').attr("width");

                var width_new = image_new_width, //image_new.naturalWidth,
                    getWidthLess_new = $(this).parents(elem.selector).width(),
                    parentWidth_new = $(this).parents(elem.selector).parent().width(),
                    setPersenWidth_new = getWidthLess_new / width_new * 100;

                //if( $(window).width() ){ // hide by Agnihd   
                if (parentWidth_new < width_new) { // added by Agnihd
                    var getTop = getCoordinates[1] * setPersenWidth_new / 100,
                        getLeft = getCoordinates[0] * setPersenWidth_new / 100;
                } else {
                    var getTop = getCoordinates[1],
                        getLeft = getCoordinates[0];
                }
                $(this).css("top", getTop + "px");
                $(this).css("left", getLeft + "px");

                // Target Position
                var target = $(this).data('scalize-popover');
                $(target).css("left", getLeft + "px");

                if ($(target).hasClass('bottom')) {
                    var getHeight = $(target).outerHeight(),
                        getTopBottom = getTop - getHeight;
                    $(target).css("top", getTopBottom + "px");
                } else if ($(target).hasClass('center')) {
                    var getHeight = $(target).outerHeight() * 0.50,
                        getTopBottom = getTop - getHeight;
                    $(target).css("top", getTopBottom + "px");
                } else {
                    $(target).css("top", getTop + "px");
                }

                $('.toggle', this).css('width', $(this).outerWidth());
                $('.toggle', this).css('height', $(this).outerHeight());

                // Toggle Size
                if ($(this).find('.pin')) {
                    var widthThis = $('.pin', this).outerWidth(),
                        heightThis = $('.pin', this).outerHeight();
                    $('.toggle', this).css('width', widthThis);
                    $('.toggle', this).css('height', heightThis);
                }
            });
        }

    };

    //----------------------------------------//
    // Scalize Plugin
    //----------------------------------------//
    $.fn.scalize = function (options) {
        return scaling.init(this, options);
    };

}(jQuery));
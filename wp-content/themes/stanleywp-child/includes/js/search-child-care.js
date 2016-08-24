var Search = function ($) {

    // IE mode
    var isRTL = false;
    var isIE8 = false;
    var isIE9 = false;
    var isIE10 = false;
    var isIE11 = false;
    var responsive = true;
    var responsiveHandlers = [];

    var handleInit = function () {

        if ($('body').css('direction') === 'rtl') {
            isRTL = true;
        }

        isIE8 = !!navigator.userAgent.match(/MSIE 8.0/);
        isIE9 = !!navigator.userAgent.match(/MSIE 9.0/);
        isIE10 = !!navigator.userAgent.match(/MSIE 10.0/);
        isIE11 = !!navigator.userAgent.match(/MSIE 11.0/);

        if (isIE10) {
            jQuery('html').addClass('ie10'); // detect IE10 version
        }
        if (isIE11) {
            jQuery('html').addClass('ie11'); // detect IE11 version
        }

    }

    // Handle the layout reinitialization on window resize
    var handleResponsiveOnResize = function () {
        var resize;
        if (isIE8) {
            // your code here...
        } else {
            // your code here...
        }
    }

    var action_do_search = function (param1, param2, param3) {
        param1 = param1 || 'DEFAULT PARAMETER VALUE HERE';
        param2 = param2 || 'DEFAULT PARAMETER VALUE HERE';
        param3 = param3 || 'DEFAULT PARAMETER VALUE HERE';
        var response = {};
        response.status = false;
        $.ajax({
            type: "POST",
            url: search_directory.custom_query_search_callback,
            dataType: "json",
            data: {param1: param1, param2: param2, param3: param3},
            async: false,
            success: function (data) {
                response = jQuery.parseJSON(data);
            }
        });
        return response;
    }

    var handleSearchDirectory = function () {
        if ($("body").hasClass("PAGE-TEMPLATE-CLASS-HERE")) {
            var form = $("#FORM-ID-HERE");

            var validate_rules = {
                'FIELD-1-NAME-HERE': {
                    required: true,
                    lettersonly: true,
                },
                'FIELD-2-NAME-HERE': {
                    required: true,
                    minlength: 1,
                    maxlength: 2,
                    digits: true,
                },
                'FIELD-3-NAME-HERE': {
                    required: true,
                    email: true,
                },
            };

            var validate_messages = {
                'FIELD-1-NAME-HERE': {
                    required: 'Please enter your name',
                    lettersonly: 'No special characters are allowed',
                },
                'FIELD-2-NAME-HERE': {
                    required: 'Please enter your mobile number',
                },
                'FIELD-3-NAME-HERE': {
                    required: 'Please enter a valid email address',
                },
            };

            $.validator.addMethod("lettersonly", function (value, element) {
                return this.optional(element) || /^([a-z Ã±Ã¡Ã£Ã¢Ã¤Ã Ã©ÃªÃ«Ã¨Ã­Ã®Ã¯Ã¬Ã³ÃµÃ´Ã¶Ã²ÃºÃ»Ã¼Ã¹Ã§]{2,60})$/i.test(value);
            });

            form.validate({
                rules: validate_rules,
                messages: validate_messages,
                submitHandler: function (form) {
                    // do other things for a valid form
                    var param1 = $("#FIELD-1-ID-HERE").val();
                    var param2 = $("#FIELD-2-ID-HERE").val();
                    var param3 = $("#FIELD-3-ID-HERE").val();
                    var response = action_do_search(param1, param2, param3);
                    if (response.status) {
                        // do something when response is success
                        var mockup = response.mockup;
                        var coordinates_array = responsive.coordinates;
                        $('#SEARCH-RESULT-DIV-ID-HERE').html(mockup);
                        // Do something when coordinates
                        $.each(coordinates_array, function (i, item_data) {
                            // ...Your code here
                        });

                    } else {
                        // do something when response is false
                    }
                    return false;
                }
            });

        }
    }

    return {
        init: function () {
            // Init core variables
            handleInit();
            // Handle Search Directory functionality
            handleSearchDirectory();
        },
    };

}(jQuery);

jQuery(document).ready(function () {
    Search.init();
});
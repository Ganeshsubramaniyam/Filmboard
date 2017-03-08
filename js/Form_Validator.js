/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery(function () {
    "use strict";
    if (jQuery("#contactfrm").length) {

        jQuery("#contactfrm").validate({
            // debug: true,
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                    target: ".result"
                });
            },
            onkeyup: false,
            onclick: false,
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            errorElement: "div",
            success: function (element) {
                element.closest('.form-group').removeClass('has-error');
            },
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                    minlength: 10,
                    digits: true
                },
                comment: {
                    required: true,
                    minlength: 10,
                    maxlength: 350
                }
            }
        });
    }

    if (jQuery("#profilefrm").length) {

        jQuery("#profilefrm").validate({
            // debug: true,
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                    target: ".result"
                });
            },
            onkeyup: false,
            onClick: false,
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            errorElement: "div",
            success: function (element) {
                element.closest('.form-group').removeClass('has-error');
            },
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                birthdate: {
                    required: true,
                },
                Gender: {
                    required: true,
                    maxlength: 6
                },
                mobileno: {
                    required: true,
                    minlength: 10,
                    digits: true
                },
                location: {
                    required: true,
                }

            }
        });
    }

    if (jQuery("#signupfrm").length) {

        jQuery("#signupfrm").validate({
            // debug: true,
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                    target: ".result"
                });
            },
            onkeyup: false,
            onClick: false,
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            errorElement: "div",
            success: function (element) {
                element.closest('.form-group').removeClass('has-error');
            },
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                retypepass: {
                    required: true,
                    minlength: 6,
                    equalTo: '[name="password"]'
                }

            }
        });



    }
    
    if (jQuery("#loginfrm").length) {

        jQuery("#loginfrm").validate({
            // debug: true,
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                    target: ".result"
                });
            },
            onkeyup: false,
            onClick: false,
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            errorElement: "div",
            success: function (element) {
                element.closest('.form-group').removeClass('has-error');
            },
            rules: {
                username: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    
                }
            }
        });



    }

    if (jQuery("#uploadfrm").length) {

        jQuery("#uploadfrm").validate({
            // debug: true,
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            },
            submitHandler: function (form) {
                jQuery(form).ajaxSubmit({
                    target: ".result"
                });
            },
            onkeyup: false,
            onClick: false,
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            errorElement: "div",
            success: function (element) {
                element.closest('.form-group').removeClass('has-error');
            },
            rules: {
                videoname: {
                    required: true
                },
                moviealbumname:
                {
                    required: true
                },
                starcast: {
                    required: true
                },
                releaseyear: {
                    required: true,
                    number:true,
                    minlength:4
                },
                language: {
                    required: true
                },
                agerestrict: {
                    required: true
                },
                license: {
                    required: true
                }
            }
        });
    }
});

/******/ (() => { // webpackBootstrap
    /******/ 	"use strict";
    var __webpack_exports__ = {};
    /*!*******************************************************************!*\
      !*** ./resources/src/js/custom/authentication/sign-in/general.js ***!
      \*******************************************************************/
    // Class definition

    var KTSigninGeneral = function () {
        // Elements
        var form;
        var submitButton;
        var validator; // Handle form

        var handleForm = function handleForm(e) {
            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            validator = FormValidation.formValidation(form, {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'O email é obrigatório'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'A senha é obrigatória'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })
                }
            }); // Handle form submit

            submitButton.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault(); // Validate form

                validator.validate().then(function (status) {
                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on'); // Disable button to avoid multiple click

                        submitButton.disabled = true;
                        $.ajax({
                            url: form.getAttribute('action'),
                            method: 'POST',
                            data: {
                                email: form.querySelector('[name="email"]').value,
                                password: form.querySelector('[name="password"]').value
                            },
                            dataType: 'json',
                            success: function success(response) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;

                                if (response.status == 'success') {
                                    form.querySelector('[name="email"]').value = "";
                                    form.querySelector('[name="password"]').value = "";

                                    if (response.redirect) {
                                        window.location.href = response.url;
                                    }
                                } else {
                                    Swal.fire('Erro', response.message, 'error');
                                }
                            },
                            error: function error(response) {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;
                                Swal.fire('Erro', 'Ocorreu um erro ao tentar se conectar', 'error');
                            }
                        });
                    } else {
                        // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Desculpe, mas não foi possível realizar o login. Verifique seus dados e tente novamente.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        }; // Public functions


        return {
            // Initialization
            init: function init() {
                form = document.querySelector('#kt_sign_in_form');
                submitButton = document.querySelector('#kt_sign_in_submit');
                handleForm();
            }
        };
    }(); // On document ready


    KTUtil.onDOMContentLoaded(function () {
        KTSigninGeneral.init();
    });
    /******/ })()
;

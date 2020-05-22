$(document).ready(function () {
    var form = $('form#marker');
    form.validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 255,
            },
            latitude: {
                required: true
            },
            longitude: {
                required: true
            },
            count_population: {
                required: true,
                digits: true
            },
        },
        messages: {
            name: {
                required: 'Пожалуйста, укажите название.',
                minlength: 'Пожалуйста, укажите название не меньше 3 символов',
                maxlength: 'Пожалуйста, укажите название не больше 255 символов',
            },
            latitude: {
                required: 'Пожалуйста, укажите широту.',
            },
            longitude: {
                required: 'Пожалуйста, укажите долготу.',
            }, count_population: {
                required: 'Пожалуйста, укажите количество населения целым числом.',
                digits: 'Пожалуйста, укажите число.',
            },

        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        }
    });

    $(document).on('submit', '#marker', function (e) {
        e.preventDefault();

        $.ajax({
            method: form.get(0).method,
            url: form.get(0).action,
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if (response['status'] == 'success') {
                    form.get(0).reset();
                    form.find('.result-info').append(response['content']);
                } else {
                    var errors = response['errors'];
                    var flattenErrors = [];
                    Object.keys(errors).forEach(function (key) {
                        errors[key].forEach(function (error) {
                            flattenErrors.push(error);
                        });
                    });

                    var lastErrorElement = null;
                    flattenErrors.forEach(function (error) {
                        var errorElement = $('<p class="form-error"></p>');
                        errorElement.text(error);
                        if (lastErrorElement === null) {
                            form.prepend(errorElement);
                        } else {
                            lastErrorElement.after(errorElement);
                        }
                        lastErrorElement = errorElement;
                    });
                }
            }
        });
    });

});


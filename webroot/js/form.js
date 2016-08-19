jQuery.validator.setDefaults({
    highlight: function (element, errorClass, validClass) {
        if (element.type === "radio") {
            this.findByName(element.name).addClass(errorClass).removeClass(validClass);
        } else {
            $(element).closest('.form-group').removeClass('border-validade-success has-feedback').addClass('border-validade-error has-feedback');
            $(element).closest('.form-group').find('i.fa').remove();
            $(element).closest('.form-group').append('<i class="fa fa-exclamation form-control-feedback"></i>');
        }
    },
    unhighlight: function (element, errorClass, validClass) {
        if (element.type === "radio") {
            this.findByName(element.name).removeClass(errorClass).addClass(validClass);
        } else {
            $(element).closest('.form-group').removeClass('border-validade-error has-feedback').addClass('border-validade-success has-feedback');
            $(element).closest('.form-group').find('i.fa').remove();
            $(element).closest('.form-group').append('<i class="fa fa-check form-control-feedback"></i>');
        }
    }
});
$("selector").validate({ errorPlacement: function(error, element) {} });
function Form() {

    var $this = this;
    this.form = null;
    this.imagePreview = function (input, target, callback) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                target.attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

            if (callback !== undefined) {
//                callback();
            }
        }
    };

    this.inputMasks = function (inputs) {
        $.each(inputs, function (el, mask) {
            switch (mask) {
                case 'cpf':
                    $(el).setMask({mask: '999.999.999-99', autoTab: false});
                    break;
                case 'rg':
                    $(el).setMask({mask: '99999999-9', autoTab: false});
                    break;
                case 'cnpj':
                    $(el).setMask({mask: '99.999.999/9999-99', autoTab: false});
                    break;
                case 'cep':
                    $(el).setMask({mask: '99999-999', autoTab: false});
                    break;
                case 'date':
                    $(el).setMask({mask: '39/19/9999', autoTab: false});
                    break;
                case 'date-time':
                    $(el).setMask({mask: '39/19/9999 29:59', autoTab: false});
                    break;
                case 'decimal':
                    $(el).setMask({mask: '99,999.999.999.999', type: 'reverse', defaultValue: '000', autoTab: false});
                    break;
                case 'decimal-5-2':
                    $(el).setMask({mask: '99,999', type: 'reverse', defaultValue: '000', autoTab: false});
                    break;
                case 'decimal-7-2':
                    $(el).setMask({mask: '99,99999', type: 'reverse', autoTab: false});
                    break;
                case 'decimal-15-3':
                    $(el).setMask({mask: '999,999999999999', type: 'reverse', autoTab: false});
                    break;
                case 'decimal-9-2':
                    $(el).setMask({mask: '99,9999999', type: 'reverse', autoTab: false});
                    break;
                case 'decimal-10-4':
                    $(el).setMask({mask: '9999,999999', type: 'reverse', autoTab: false});
                    break;
                case 'integer':
                    $(el).setMask({mask: '999999', type: 'reverse', autoTab: false});
                    break;
                case 'phone':
                    $(el).setMask({mask: '(99) 9999-99999', autoTab: false});
                    var value = $.trim($(el).val());
                    if (value != '') {
                        if (value.length > 14) {
                            $(el).setMask({mask: '(99) 99999-9999', autoTab: false});
                        }
                    }
                    $(el).keyup(function () {
                        value = $.trim($(el).val());
                        if (value != '') {
                            if (value.length > 14) {
                                $(el).setMask({mask: '(99) 99999-9999', autoTab: false});
                            } else {
                                $(el).setMask({mask: '(99) 9999-99999', autoTab: false});
                            }
                        }
                    });
                    break;
            }
        });
    };

    this.validateInit = function () {
        $.validator.setDefaults({
            ignore: '',
            highlight: function (element, errorClass, validClass) {
                if (element.type === "radio") {
                    this.findByName(element.name).addClass(errorClass).removeClass(validClass);
                } else {
                    $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error has-feedback');
                    $(element).closest('.form-group').find('i.fa').remove();
                    $(element).closest('.form-group').append('<i class="fa fa-exclamation fa-lg form-control-feedback icon-validate"></i>');
                    $(element).closest('.form-group').find('i.fa').css('right', '-15px');
                    if (!$(element).closest('.form-group').children(":first").is('label')) {
                        $(element).closest('.form-group').find('i.fa').css('top', 0);
                    }
                }
            },
            unhighlight: function (element, errorClass, validClass) {
                if (element.type === "radio") {
                    this.findByName(element.name).removeClass(errorClass).addClass(validClass);
                } else {
                    $(element).closest('.form-group').removeClass('has-error has-feedback').addClass('has-success has-feedback');
                    $(element).closest('.form-group').find('i.fa').remove();
                    $(element).closest('.form-group').append('<i class="fa fa-check fa-lg form-control-feedback icon-validate"></i>');
                    $(element).closest('.form-group').find('i.fa').css('right', '-15px');
                    if (!$(element).closest('.form-group').children(":first").is('label')) {
                        $(element).closest('.form-group').find('i.fa').css('top', 0);
                    }
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter($(element).closest('.form-group').find('.icon-validate'));
            }
        });
        $.validator.addMethod("cpf", function (value, element) {
            value = $.trim(value);
            value = value.replace('.', '');
            value = value.replace('.', '');
            cpf = value.replace('-', '');
            while (cpf.length < 11)
                cpf = "0" + cpf;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = 11;
            for (i = 0; i < 11; i++) {
                a[i] = cpf.charAt(i);
                if (i < 9)
                    b += (a[i] * --c);
            }
            if ((x = b % 11) < 2) {
                a[9] = 0
            } else {
                a[9] = 11 - x
            }
            b = 0;
            c = 11;
            for (y = 0; y < 10; y++)
                b += (a[y] * c--);
            if ((x = b % 11) < 2) {
                a[10] = 0;
            } else {
                a[10] = 11 - x;
            }

            var retorno = true;
            if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg))
                retorno = false;
            return this.optional(element) || retorno;
        }, "Informe um CPF válido.");
        $.validator.addMethod("cnpj", function (cnpj, element) {
            cnpj = $.trim(cnpj); // retira espaços em branco
            // DEIXA APENAS OS NÚMEROS
            cnpj = cnpj.replace('/', '');
            cnpj = cnpj.replace('.', '');
            cnpj = cnpj.replace('.', '');
            cnpj = cnpj.replace('-', '');
            var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
            digitos_iguais = 1;
            if (cnpj.length < 14 && cnpj.length < 15) {
                return false;
            }
            for (i = 0; i < cnpj.length - 1; i++) {
                if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
                    digitos_iguais = 0;
                    break;
                }
            }

            if (!digitos_iguais) {
                tamanho = cnpj.length - 2
                numeros = cnpj.substring(0, tamanho);
                digitos = cnpj.substring(tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) {
                    soma += numeros.charAt(tamanho - i) * pos--;
                    if (pos < 2) {
                        pos = 9;
                    }
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(0)) {
                    return false;
                }
                tamanho = tamanho + 1;
                numeros = cnpj.substring(0, tamanho);
                soma = 0;
                pos = tamanho - 7;
                for (i = tamanho; i >= 1; i--) {
                    soma += numeros.charAt(tamanho - i) * pos--;
                    if (pos < 2) {
                        pos = 9;
                    }
                }
                resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                if (resultado != digitos.charAt(1)) {
                    return false;
                }
                return true;
            } else {
                return false;
            }
        }, "Informe um CNPJ válido.");

        $.validator.addMethod("minDate", function (value, element, dateField) {
            if ($.trim($(dateField).val()) != '') {
                var date = $(dateField).val();

                if (date.length <= 7)
                    date = '1/' + date;
                if (value.length <= 7)
                    value = '1/' + value;
                minDateParts = date.split('/');
                minDate = parseInt(minDateParts[2] + minDateParts[1] + minDateParts[0]);

                maxDateParts = value.split('/');
                maxDate = parseInt(maxDateParts[2] + maxDateParts[1] + maxDateParts[0]);

                if (minDate > maxDate) {
                    return false;
                } else {
                    return true;
                }

            } else {
                return true;
            }
        });

        $.validator.addMethod("maxDate", function (value, element, dateField) {
            if ($.trim($(dateField).val()) != '') {
                var date = $(dateField).val();

                if (date.length <= 7)
                    date = '1/' + date;
                if (value.length <= 7)
                    value = '1/' + value;
                minDateParts = date.split('/');
                minDate = parseInt(minDateParts[2] + minDateParts[1] + minDateParts[0]);

                maxDateParts = value.split('/');
                maxDate = parseInt(maxDateParts[2] + maxDateParts[1] + maxDateParts[0]);

                if (minDate < maxDate) {
                    return false;
                } else {
                    return true;
                }

            } else {
                return true;
            }
        });

        $.validator.addMethod("minDateMonth", function (value, element, dateField) {
            if ($.trim($(dateField).val()) != '') {
                var date = $(dateField).val();

                if (date.length <= 7)
                    date = '1/' + date;
                if (value.length <= 7)
                    value = '1/' + value;
                minDateParts = date.split('/');
                minDate = parseInt(minDateParts[2] + minDateParts[1]);

                maxDateParts = value.split('/');
                maxDate = parseInt(maxDateParts[2] + maxDateParts[1]);

                if (minDate > maxDate) {
                    return false;
                } else {
                    return true;
                }

            } else {
                return true;
            }
        });

        $.validator.addMethod("maxDateMonth", function (value, element, dateField) {
            if ($.trim($(dateField).val()) != '') {
                var date = $(dateField).val();

                if (date.length <= 7)
                    date = '1/' + date;
                if (value.length <= 7)
                    value = '1/' + value;
                minDateParts = date.split('/');
                minDate = parseInt(minDateParts[2] + minDateParts[1]);

                maxDateParts = value.split('/');
                maxDate = parseInt(maxDateParts[2] + maxDateParts[1]);

                if (minDate <= maxDate) {
                    return false;
                } else {
                    return true;
                }

            } else {
                return true;
            }
        });
    };
    this.validate = function (el, options) {
        $this.form = el;
        $(el).validate(options);
    };
    this.reset = function () {
        $($this.form).find('i.form-control-feedback').remove();
        $($this.form).find('label.error').remove();
        $($this.form).find('.has-error').removeClass('has-error');
        $($this.form).find('.has-success').removeClass('has-success');
        $($this.form).find('.select2-hidden-accessible').select2("val", "");
        $($this.form)[0].reset();
        $($this.form).find("input[type=text]").val("");
    };
}
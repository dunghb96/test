(function($) {
    $('#regis-form').validate({
        rules: {
            cris_no: {
                required: true,
                number: true,
                min: 0,
                maxlength: 7,
                minlength: 7
            },
            invoice_no: {
                equalTo: '#cris_no',
            },
            // invoice_amount: {
            //     required: true,
            //     number: true
            // },
            // address: {
            //     required: true,
            //     maxlength: 256
            // },
            name: {
                maxlength: 256
            },
            // mail: {
            //     required: true,
            //     email: true,
            //     maxlength: 256
            // },
            // check_code: {
            //     required: true,
            // },
            invoice_day: {
                validDate: true
            },

            // invoice_mail_info: {
            // },
            // customFile: {
            //     extension: "pdf"
            // },
            estimate_day: {
                validDate: true
            },
            // estimate_no: {
            //     number: true
            // },
            // estimate_amount: {
            //     number: true
            // },
            contact_day: {
                validDate: true
            },
            // contact_answer: {
            //     required: true,
            // },
            fix_day: {
                validDate: true
            },
            // fix_info: {
            // },
            pay_day: {
                validDate: true
            },
            // pay_amount: {
            //     number: true
            // },
            // pay_to: {
            //     maxlength: 20
            // },
            // status: {
            //     required: true,
            //     maxlength: 20
            // },
        },
        messages: {
            cris_no: {
                required: 'CRIS No. を入力してください。',
                maxlength: '7桁の半角数字を入力してください。',
                minlength: '7桁の半角数字を入力してください。',
                number: '数を入力してください。',
                min: '負の数は入力しないでください。',
            },
            invoice_no: {
                equalTo: 'Cris Noと一致しません',
            },
            // address: {
            //     required: '都道府県 を入力してください。',
            // },
            name: {
                maxlength: '256文字以内で入力してください。'
            },
            // mail: {
            //     required: 'メールアドレス を入力してください。',
            //     email: 'メールアドレス形式で指定してください。',
            // },
            // check_code: {
            //     required: '点検コード等 を入力してください。',
            //     number: '数を入力してください。'
            // },
            // invoice_day: {
            //     required: '発行日 を入力してください。',
            // },
            // invoice_no: {
            //     required: 'No. を入力してください。',
            //     number: true
            // },
            // invoice_amount: {
            //     required: '金額 を入力してください。',
            //     number: true
            // },
            // invoice_mail_info: {

            // },
            // customFile: {
            //     extension: "PDFファイル形式を入力してください"
            // },
            // estimate_day: {

            // },
            // estimate_no: {
            //     number: true
            // },
            // estimate_amount: {
            //     number: true
            // },
            // contact_day: {
            // },
            // contact_answer: {
            //     required: '可否 を入力してください。',
            // },
            // fix_day: {
            // },
            // fix_info: {
            // },
            // pay_day: {
            // },
            // pay_amount: {
            //     number: true
            // },
            // pay_to: {
            //     maxlength: 20
            // },
            // status: {
            //     required: true,
            //     maxlength: 20
            // },
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.closest('.show-error').length > 0) {
                element.closest('.show-error').find('.form-group').after(error);
            } else {
                error.insertAfter(element); // default error placement.
            }
        },

    });

    jQuery.validator.addMethod("validDate", function(dtValue, element) {
        return !$(element).is(":invalid");
    }, "この日付は存在しません。");

    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        console.log(fileName);
        $('[name=filename]').val(fileName.replace(/C:\\fakepath\\/i, ''));
    });
})(jQuery)

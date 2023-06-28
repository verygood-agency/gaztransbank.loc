// AJAX FORM
var options_ajax = {
    beforeSubmit: showRequest_ajax,  // pre-submit callback
    success: showResponse_ajax
};

function showResponse_ajax(responseText, statusText, xhr, $form) {
    var formElementId = $($form[0]).attr("id");

    $('.preloader').hide();
    var obj = jQuery.parseJSON(responseText);

    if (obj.modalname) {
        var Modal = window.Modal,
          BX = window.BX;

        if (!Modal || !(BX && BX.ajax)) {
            return;
        }

        var data = {};
        data['NAME'] = obj.modalname;
        data['CONTENT'] = obj.modalcontent;

        var modal = new Modal({
            preloaderColor: '#B9120C',
            effect: 'modal-fade',
            contentEffect: 'modal-zoom-out',
            content: function () {
                var m = this;
                m._isAsyncContent = true;
                BX.ajax({
                    url: '/local/modal/modal.php',
                method: 'POST',
                  data: data,
                  onsuccess(res) {
                    m.setContent(res);
                },
                onfailure(e) {
                    m.setContent(e, true);
                },
            });

                return false;
            }
        });

        modal.show();
    } else {
        Swal.fire({
            icon: obj.status,
            html: obj.text,
        })
    }

    if (obj.status == "success") {
        $("#" + formElementId + " input[type='text'],textarea").val('');
        if ($.magnificPopup && $.magnificPopup.close) {
            $.magnificPopup.close();
        }

        //Очистка файлов
        if (obj.file == "reset") {
            $('#file').val("");
            $('.file-w__title').text($('.file-w__title').data('title'));
            $('#file_error').text("");
            $('#button-delete').hide();
        }

        //Событие в я.метрику
        console.log(formElementId);
        if (formElementId == "product-form-ved-0") {
            ym(57270994,'reachGoal','lid');
            console.log("reachGoal");
        }
    }
    //Сброс капчи
    if (obj.captcha == "reset") {
        console.log('3');
        grecaptcha.reset();
    }
}


function showRequest_ajax(formData, jqForm, options) {
    var formElementId = $(jqForm[0]).attr("id");

    if (!checkform("#"+formElementId+" .req-form","#"+formElementId+" .form-phone","#"+formElementId+" .form-email")) {
        return false;
    }

    if ($("#"+formElementId+" .form-phone").length && $("#"+formElementId+" .form-email").length) {
        if (!$("#"+formElementId+" .form-phone").val()&&!$("#"+formElementId+" .form-email").val()) {
            $("#"+formElementId+" .form-phone").addClass("empty_field");
            $("#"+formElementId+" .form-email").addClass("empty_field");
            return false;
        }
        else{
            $("#"+formElementId+" .form-phone").removeClass("empty_field");
            $("#"+formElementId+" .form-email").removeClass("empty_field");
        }
    }

    if ($("#"+formElementId+' input[name="phone"]').length) {
        if ($("#"+formElementId+' input[name="phone"]').val().length > 0 && $("#"+formElementId+' input[name="phone"]').val().replace(/[\D]+/g, '').length != 11) {
            Swal.fire({
                icon: 'warning',
                title: 'Внимание',
                text: 'Укажите корректный номер телефона'
            })
            return false;
        }
    }

    if ($('#' + formElementId + " .agree_checkbox").length) {
        if (!$('#' + formElementId + " .agree_checkbox").is(":checked")) {
            Swal.fire({
                icon: 'warning',
                title: 'Внимание',
                text: 'Необходимо подтвердить согласие с обработкой персональных данных'
            })
            return false;
        }
    }

    $('.preloader').show();
}

function checkform(classname, phoneclass, emailclass) {
    var x = true;
    if (classname != false) {
        $(classname).removeClass('empty_field');
        $(classname+":visible").each(function() {
            if ($(this).val() != '') {
                $(this).removeClass('empty_field');
            } else {
                $(this).addClass('empty_field');
                x = false;
            }
        });
    }
    var reg = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ()]{7,10}$/;
    if (phoneclass != false) {
        var inputVal = $(phoneclass).val();
        if (inputVal) {
            if (!reg.test(inputVal)) {
                $(phoneclass).addClass('empty_field');
                x = false;
            } else {
                $(phoneclass).removeClass('empty_field');
            }
        }

    }
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (emailclass != false) {
		if($(emailclass).length){
            var inputVal_email = $(emailclass).val();
            if (inputVal_email) {
                if (!re.test(inputVal_email)) {
                    $(emailclass).addClass('empty_field');
                    x = false;
                }
            }
            else{
                $(emailclass).removeClass('empty_field');
            }
		}
    } else {
        $(emailclass).removeClass('empty_field');
    }
    return x;
}


$(document).ready(function() {
    $('.ajax-form').ajaxForm(options_ajax);
});

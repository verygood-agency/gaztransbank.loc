<?php
/**
 * @var string $callbackTitle //заголовок
 * @var string $eventName? //почтовое событие
 * @var string $sectionId? //id раздела
 */

global $APPLICATION;
global $reCaptchaKey;
?>

<div class="request-form">
    <div class="request-form__container">
        <div class="wrapper wrapper_default">
            <div class="request-form__content">
                <div class="request-form__title">
                    <h2><?=$callbackTitle?></h2>
                </div>
                <div class="request-form__description">
                    Заполните простую форму и мы свяжемся с Вами в ближайшее время
                </div>
                <div class="request-form__form-wrapper">
                    <form id="callback" action="#" class="request-form__form">
                        <input name="eventname" type="hidden" value="<?=$eventName?>" />
                        <input name="sectionid" type="hidden" value="<?=$sectionId?>" />
                        <input name="title" type="hidden" value="<?=$callbackTitle?>" />
                        <div class="request-form__form-content">
                            <div class="request-form__fields-groups">
                                <div class="request-form__fields-group">
                                    <div class="request-form__fields">
                                        <div class="request-form__field">
                                            <input name="fio" class="request-form__field-input" type="text" placeholder="ФИО" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="request-form__fields-group">
                                    <div class="request-form__fields">
                                        <div class="request-form__field">
                                            <input name="organization" class="request-form__field-input" type="text" placeholder="Организация" required />
                                        </div>
                                        <div class="request-form__field">
                                            <input name="phone" class="request-form__field-input" type="tel" placeholder="Телефон" inputmode="tel" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <div class="g-recaptcha" data-sitekey="<?=$reCaptchaKey?>"></div>
                            <div class="request-form__footer-wrapper">
                                <div class="request-form__footer">
                                    <div class="request-form__consent">
                                        <div class="consent consent--white">
                                            <label class="consent__container">
                                                <input name="consent" type="checkbox" class="consent__input visually-hidden">
                                                <span class="consent__checkbox"></span>
                                                <span class="consent__text">Я соглашаюсь <a href="/policy/">с условиями</a>, даю свое согласие на <a href="/policy/">обработку персональных данных</a></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="request-form__submit">
                                        <button class="btn btn_box btn_red" type="submit">Оставить заявку</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="request-form__picture">
                    <div class="picture">
                        <picture>
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/callback-form/2.png" alt="Обратный звонок. ООО КБ «ГТ банк»" loading="lazy" />
                        </picture>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //Загрузка библиотеки reCaptcha
    $('input[name="fio"]').bind("change", fLoadRecaptcha);
    $('input[name="organization"]').bind("change", fLoadRecaptcha);
    $('input[name="phone"]').bind("change", fLoadRecaptcha);
    $('input[name="consent"]').bind("change", fLoadRecaptcha);

    function funcBefore () { // функция выполняемая пока не получен ответа от страницы, на которую отправили данные
    };

    function funcSuccess (data) { // функция выполняемая после получения ответа от страницы, на которую отправили данные (в функцию передается параметр data - данные)
        //console.log(data);
        data = JSON.parse(data);

        Swal.fire({
            icon: data["status"],
            html: data["text"],
        })

        if (data["status"] == "success") {
          document.getElementById('callback').reset();

          console.log($('#callback input[name="eventname"]').val());
          //Событие в я.метрику
          if ($('#callback input[name="eventname"]').val() == "FORM_UL_VED_CALLBACK") {
            console.log("reachGoal");
            ym(57270994,'reachGoal','lid');
          }
        }
    };

    $(document).ready(function (){
        $("#callback").submit(function(e) {
          e.preventDefault();

          if(! $('#callback .g-recaptcha-response').val()) {
            Swal.fire({
              icon: 'warning',
              title: 'Внимание',
              text: 'Необходимо пройти проверку "Я не робот"'
            })

          } else {
            var data = $('#callback').serializeArray();

            //console.log(data);

            $.ajax({
              url: "/local/ajax/forms/call2.php",
              type: "POST",
              data: data,
              dataType: "html",
              beforeSend: funcBefore,
              success: funcSuccess
            });
          }
        });
    });
</script>
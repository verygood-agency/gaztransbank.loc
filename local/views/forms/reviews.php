<?php
/**
 * @var string $id
 * @var string $name
 */

global $reCaptchaKey;
?>
<div class="popup popup-small mfp-hide" id="product-open-<?php echo $id; ?>">
    <h2 class="popup__title t-popup-title">

    </h2>
    <div class="popup__content">
        <?
//        echo $id;
//        echo $name;
//        echo $type;
        ?>
        <form id="product-form-<?php echo $id; ?>" action="/local/ajax/forms/reviews.php" method="post" class="form popup-form ajax-form">
            <?php echo bitrix_sessid_post() ?>
            <input type="hidden" name="product" value="<?php echo $name; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <div class="form__item form__item__offset">
                <input
                    name="name"
                    type="text"
                    class="input input_default"
                    placeholder="Ваше имя*"
                    required
                >
            </div>
            <div class="form__item form__item__offset">
                <input
                    name="email"
                    type="text"
                    class="input input_default"
                    placeholder="E-mail*"
                    required
                >
            </div>
            <div class="form__item form__item__offset">
                <input
                        name="age"
                        type="text"
                        class="input input_default"
                        placeholder="Ваш возраст"
                >
            </div>
            <div class="form__item form__item__offset">
                <input
                        name="profession"
                        type="text"
                        class="input input_default"
                        placeholder="Ваша профессия"
                >
            </div>
            <div class="form__item form__item__offset">
                <input
                        name="city"
                        type="text"
                        class="input input_default"
                        placeholder="Место проживания"
                >
            </div>
            <div class="form__item form__item_offset">
                <textarea
                        name="message"
                        class="textarea textarea_default reviews-form__textarea"
                        placeholder="Сообщение*"
                        required
                ></textarea>
            </div>
            <div class="form__item form__item__offset">
                <div class="file-w">
                    <input id="file" name="file" type="file" class="file-w__input" accept=".jpg,.jpеg,.pdf">
                    <label for="file" class="file-w__label">
                        <img class="file-w__ico" src="<?= SITE_TEMPLATE_PATH ?>/images/paper-clip.svg" alt="">
                        <span class="file-w__title" data-title="Прикрепить файл">
                            Прикрепить файл
                        </span>
                        <img id="button-delete" class="button-delete" src="<?= SITE_TEMPLATE_PATH ?>/images/button-delete.png" alt="">
                    </label>
                </div>
            </div>
            <div id="file_error" class="form__item form__item_offset" style="color: red"></div>
            <script>
              $('#file').bind('change', function() {
                var size = this.files[0].size;
                var name = this.files[0].name;
                var fileExtension = ['jpg', 'jpеg', 'pdf']; // допустимые типы файлов
                if(5242880<size){
                  $('#file_error').text("Файл должен быть меньше 5 мегабайт");
                } else if ($.inArray(name.split('.').pop().toLowerCase(), fileExtension) == -1) {
                  $('#file_error').text("У файла неверный тип. Разрешены следующие типы файлов: jpg, jpеg и pdf");
                } else {
                  $('#file_error').text("");
                }
                $('#button-delete').show();
              });
              $('#button-delete').bind("click", function(event) {
                event.preventDefault();
                $('#file').val("");
                $('.file-w__title').text($('.file-w__title').data('title'));
                $('#file_error').text("");
                $('#button-delete').hide();
              });
            </script>
            <style>
              .button-delete {
                margin-left: 8px;
                width: 15px;
                height: 15px;
                display: none;
              }
            </style>
            <div class="form__item form__item__offset">
                <label class="checkbox checkbox_default popup-form__checkbox">
                    <input type="checkbox" name="agree_checkbox" class="checkbox__input agree_checkbox">
                    <span class="checkbox__label checkbox__label_small">
                        Согласен с <a href="/policy/" target="_blank">условиями обработки моих персональных данных</a>
                    </span>
                </label>
            </div>
            <div class="form__item form__item__offset">
                <a href="/feedback/rules_check_feedback_clients.pdf" target="_blank" style="color: #07559c;">Порядок, сроки рассмотрения обращений потребителей</a>
            </div>
            <br>
            <div class="g-recaptcha" data-sitekey="<?=$reCaptchaKey?>"></div>
            <br>
            <div class="form__item form__item__offset">
                <button class="btn btn__default btn_blue">
                    <span class="btn__title">
                        Отправить
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
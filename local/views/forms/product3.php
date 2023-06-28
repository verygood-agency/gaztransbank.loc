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
        //echo $id;
        //echo $name;
        //echo $type;
        ?>
        <form id="product-form-<?php echo $id; ?>" action="/local/ajax/forms/call3.php" method="post" class="form popup-form ajax-form">
            <?php echo bitrix_sessid_post() ?>
            <input name="eventname" type="hidden" value="<?=$eventName?>" />
            <input name="sectionid" type="hidden" value="<?=$sectionId?>" />
            <input name="title" type="hidden" value="<?=$callbackTitle?>" />
            
            <div class="form__item form__item__offset">
                <input name="fio" type="text" class="input input_default" placeholder="Ф.И.О." required>
            </div>
            <div class="form__item form__item__offset">
                <input name="phone" type="text" class="input input_default phone-mask" placeholder="Мобильный телефон" required>
            </div>
            <div class="form__item form__item__offset">
                <input name="email" type="email" class="input input_default" placeholder="Электронная почта" required>
            </div>
            <div class="form__item form__item__offset">
                <label class="checkbox checkbox_default popup-form__checkbox">
                    <input type="checkbox" name="consent" class="checkbox__input agree_checkbox">
                    <span class="checkbox__label checkbox__label_small">
                        Согласен с <a href="/policy/" target="_blank">условиями обработки моих персональных данных</a>
                    </span>
                </label>
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
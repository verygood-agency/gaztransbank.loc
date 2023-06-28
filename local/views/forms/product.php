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
        <form id="product-form-<?php echo $id; ?>" action="/local/ajax/forms/product.php" method="post" class="form popup-form ajax-form">
            <?php echo bitrix_sessid_post() ?>
            <input type="hidden" name="product" value="<?php echo $name; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <div class="form__item form__item__offset">
                <input
                    name="name"
                    type="text"
                    class="input input_default"
                    placeholder="Ф.И.О."
                    required
                >
            </div>
            <?if ($type <> "card-debet" && $type <> "card-credit") {?>
            <div class="form__item form__item__offset">
                <input
                    name="city"
                    type="text"
                    class="input input_default"
                    placeholder="Город"
                >
            </div>
            <?}?>
            <div class="form__item form__item__offset">
                <input
                    name="phone"
                    type="text"
                    class="input input_default phone-mask"
                    placeholder="Мобильный телефон"
                    required
                >
            </div>
            <div class="form__item form__item__offset">
                <label class="checkbox checkbox_default popup-form__checkbox">
                    <input type="checkbox" name="agree_checkbox" class="checkbox__input agree_checkbox">
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
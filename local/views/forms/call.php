<?
global $APPLICATION;
global $reCaptchaKey;
?>

<div class="wrapper wrapper_default">
    <form action="#" class="callback-form js_form_product2" onsubmit="return false;">
        <input type="hidden" name="title" value="Обратный звонок">
        <input type="hidden" name="section" value="70">
        <input type="hidden" name="event" value="FORM_CALLBACK">
        <div class="callback-form__container">
            <div class="callback-form__content">
                <h2 class="callback-form__title">Обратный звонок</h2>
                <div class="callback-form__description">Введите номер телефона и мы перезвоним Вам в ближайшее время</div>
                <div class="callback-form__fields">
                    <input type="text" name="phone" class="callback-form__input phone-mask" placeholder="Телефон">
                    <button class="callback-form__submit" id="ButtonCallback" type="submit">Заказать звонок</button>
                </div>
                <div class="callback-form__consent">
                    <div class="consent consent--white">
                        <label class="consent__container">
                            <input type="checkbox" name="consent" class="consent__input visually-hidden" checked required>
                            <span class="consent__checkbox"></span>
                            <span class="consent__text">Я соглашаюсь <a href="/policy/" target="_blank">с условиями</a>, даю свое согласие на <a href="/policy/" target="_blank">обработку</a> и разрешаю сделать запрос в бюро кредитных историй</span>
                        </label>
                    </div>
                </div>
                <br>
                <div class="g-recaptcha" data-sitekey="<?=$reCaptchaKey?>"></div>
            </div>
            <div class="callback-form__picture">
                <div class="picture">
                    <picture>
                        <source srcset="<?=SITE_TEMPLATE_PATH?>/images/callback-form/1.png" type="image/jpg">
                        <img width="409" height="381" loading="lazy" alt="Обратный звонок. ООО КБ «ГТ банк»">
                    </picture>
                </div>

            </div>
        </div>
    </form>
</div>
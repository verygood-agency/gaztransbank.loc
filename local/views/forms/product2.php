<?
global $APPLICATION;
global $reCaptchaKey;
?>

<div class="card-advantages__form">
  <form action="#" class="card-form js_form_product2" onsubmit="return false;">
    <input type="hidden" name="title" value="<?=$arParams["TITLE"]?>">
    <input type="hidden" name="product" value="<?=$arParams["PRODUCT"]?>">
    <input type="hidden" name="section" value="<?=$arParams["SECTION_ID"]?>">
    <input type="hidden" name="event" value="<?=$arParams["EVENT_NAME"]?>">
    <div class="card-form__container">
      <fieldset class="card-form__content">
        <legend class="card-form__title"><?=$arParams["TITLE"]?></legend>
        <p class="card-form__description">Заполните простую форму и мы свяжемся с Вами в ближайшее время</p>
        <div class="card-form__fields-wrapper">
          <div class="card-form__fields">
            <div class="card-form__field"><input type="text" class="card-form__input" name="name" required placeholder="ФИО" aria-label="ФИО"></div>
            <div class="card-form__field"><input type="text" class="card-form__input" name="phone" required placeholder="Телефон" aria-label="Телефон"></div>
            <div class="card-form__field card-form__field--submit"><button class="button button--contained button--color-secondary button--size-l" type="submit"><span class="button-content">Оставить заявку</span></button></div>
            <div class="card-form__field card-form__field--consent">
              <div class="consent"><label class="consent__container"><input type="checkbox" name="consent" class="consent__input visually-hidden" checked required> <span class="consent__checkbox"></span> <span class="consent__text">Я соглашаюсь <a href="/policy/">с условиями</a>, даю свое согласие на обработку персональных данных</span></label></div>
            </div>
          </div>
          <div class="g-recaptcha" data-sitekey="<?=$reCaptchaKey?>"></div>
        </div>
      </fieldset>
    </div>
    <div class="card-form__picture">
      <div class="picture">
        <picture><img src="<?=$arParams["IMG"]?>" alt="<?=$arParams["TITLE"]?>" loading="lazy"></picture>
      </div>
    </div>
  </form>
</div>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$component->SetResultCacheKeys(array("ID", "NAME"));
$this->setFrameMode(true);

?>
<div class="app">
  <div class="first-screen">
    <div class="first-screen__picture">
      <?if ($arResult["DETAIL_PICTURE"]) {?>
        <div class="picture">
          <picture>
            <?foreach ($arResult["DETAIL_PICTURE"]['SOURCES'] as $arSource) {?>
              <source
                  srcset="<?= $arSource['SRCSET'] ?>"
                  sizes="100vw"
                  type="<?= $arSource['TYPE'] ?>"
              />
            <?}?>
            <img
                alt="<?=$arResult["PROPERTIES"]["HEADING"]["VALUE"];?>"
                src="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>"
                width="<?= $arResult["DETAIL_PICTURE"]['WIDTH'] ?>"
                height="<?= $arResult["DETAIL_PICTURE"]['HEIGHT'] ?>"
            >
          </picture>
        </div>
      <?}?>
    </div>
    <div class="first-screen__container">
      <div class="wrapper wrapper_default">
        <div class="first-screen__content">
          <div class="first-screen__title">
            <h1><?=htmlspecialchars_decode($arResult["NAME"])?></h1>
          </div>
          <div class="first-screen__description">
            <?=$arResult["PREVIEW_TEXT"]?>
          </div>
          <div class="first-screen__btn">
            <a href="#product-open-ved-0" data-title="Заявка на открытие валютного счёта" class="inline-t-popup btn btn_box btn_red">Оставить заявку</a>
            <?php echo view('forms.product', ['id' => 'ved-0', 'name' => 'Валютный счёт']); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?if ($arResult["PROPERTIES"]["ADVANTAGES1_IMAGE"]["VALUE"]) {?>
    <section class="box">
      <div class="box__container">
        <div class="wrapper wrapper_default">
          <div class="box__content">
            <div class="from-business">
              <div class="from-business__items-wrapper">
                <ul class="from-business__items">
                  <?foreach ($arResult["PROPERTIES"]["ADVANTAGES1_IMAGE"]["VALUE"] as $arAdvantages) {?>
                    <li class="from-business__item">
                      <div class="from-business__item-icon" aria-hidden="true">
                        <img src="<?=$arAdvantages["SRC"]?>" alt="<?=$arAdvantages["DESCRIPTION"]?>">
                      </div>
                      <div class="from-business__item-text"><?=$arAdvantages["DESCRIPTION"]?></div>
                    </li>
                  <?}?>
                </ul>
              </div>
              <div class="from-business__footer-wrapper">
                <div class="from-business__footer">
                  <div class="from-business__question">Вас заинтересовало наше предложение?</div>
                  <div class="from-business__button"><a href="#product-open-ved-0" data-title="Заявка на открытие валютного счёта" class="inline-t-popup btn btn_box btn_red">Оставить заявку</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?}?>
  <?if ($arResult["PROPERTIES"]["ADVANTAGES2_TEXT"]["VALUE"]) {?>
    <section class="box box--color-bg-blue">
      <div class="box__container">
        <div class="wrapper wrapper_default">
          <div class="box__title">
            <h2><?=$arResult["PROPERTIES"]["ADVANTAGES2_TITLE"]["VALUE"]?></h2>
          </div>
          <div class="box__content">
            <div class="business-advantages">
              <div class="business-advantages__items business-advantages__items--col-2">
                <div class="advantages-list">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["ADVANTAGES2_TEXT"]["VALUE"]["TEXT"])?>
                </div>
              </div>
              <div class="business-advantages__footer">
                <?if (!empty(preg_replace('/<!--(.|\s)*?-->/', '', htmlspecialchars_decode($arResult["PROPERTIES"]["ADVANTAGES2_EXPLANATION"]["VALUE"]["TEXT"])))) {?>
                  <div class="business-advantages__explanation">
                    <?=htmlspecialchars_decode($arResult["PROPERTIES"]["ADVANTAGES2_EXPLANATION"]["VALUE"]["TEXT"])?>
                  </div>
                <?}?>
                <?if ($arResult["PROPERTIES"]["LINK_TARIFF"]["VALUE"]) {?>
                  <div class="business-advantages__button"><a href="<?=$arResult["PROPERTIES"]["LINK_TARIFF"]["VALUE"]?>" class="btn btn_box btn_red">Посмотреть тарифы</a></div>
                <?}?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?}?>
  <?if ($arResult["PROPERTIES"]["ADVANTAGES3_IMAGE"]["VALUE"]) {?>
    <section class="box box--color-bg-blue box--no-offset-top">
      <div class="box__container">
        <div class="wrapper wrapper_default">
          <div class="box__title">
            <h2><?=$arResult["PROPERTIES"]["ADVANTAGES3_TITLE"]["VALUE"]?></h2>
          </div>
          <div class="box__content">
            <div class="advantages2">
              <ul class="advantages2__items">
                <?foreach ($arResult["PROPERTIES"]["ADVANTAGES3_IMAGE"]["VALUE"] as $arAdvantages) {?>
                  <li class="advantages2__item">
                    <div class="advantages2__item-icon" aria-hidden="true">
                      <img src="<?=$arAdvantages["SRC"]?>" alt="<?=$arAdvantages["DESCRIPTION"]?>">
                    </div>
                    <div class="advantages2__item-text"><?=$arAdvantages["DESCRIPTION"]?></div>
                  </li>
                <?}?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?}?>
  <?if ($arResult["PROPERTIES"]["OPENING_TEXT"]["VALUE"]) {?>
    <section class="box">
      <div class="box__container">
        <div class="wrapper wrapper_default">
          <div class="box__title">
            <h2><?=$arResult["PROPERTIES"]["OPENING_TITLE"]["VALUE"]?></h2>
          </div>
          <div class="box__content">
            <div class="business-advantages">
              <div class="business-advantages__items">
                <div class="advantages-list">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["OPENING_TEXT"]["VALUE"]["TEXT"])?>
                </div>
              </div>
              <div class="business-advantages__footer"></div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?}?>
  <style>
    .request-form__container {
      background-color: #003566;
    }
    .btn_red:hover {
      background: #07559D !important;
    }
  </style>
  <?
  $callbackTitle = "Заявка на открытие счёта в валюте";
  $eventName = 'FORM_UL_VED_CALLBACK';
  $sectionId = '109';
  include $_SERVER['DOCUMENT_ROOT']."/local/views/forms/call2.php";
  ?>

</div>
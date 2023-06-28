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
      <?if ($arResult["PREVIEW_PICTURE"]) {?>
        <div class="picture">
          <picture>
            <?foreach ($arResult["PREVIEW_PICTURE"]['SOURCES'] as $arSource) {?>
              <source
                  srcset="<?= $arSource['SRCSET'] ?>"
                  sizes="100vw"
                  type="<?= $arSource['TYPE'] ?>"
              />
            <?}?>
            <img
                alt="<?=$arResult["PROPERTIES"]["HEADING"]["VALUE"];?>"
                src="<?= $arResult["PREVIEW_PICTURE"]['SRC'] ?>"
                width="<?= $arResult["PREVIEW_PICTURE"]['WIDTH'] ?>"
                height="<?= $arResult["PREVIEW_PICTURE"]['HEIGHT'] ?>"
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
            <a href="#product-open-rko-0" data-title="Отправить заявку на открытие счета" class="inline-t-popup btn btn_box btn_red">Отправить заявку</a>
            <?php echo view('forms.product', ['id' => 'rko-0', 'name' => 'РКО']); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?if ($arResult["PROPERTIES"]["PROMOTION_ON"]["VALUE"] == "Да") {?>
    <div class="for-business">
      <div class="for-business__container" style="background-color: #003566">
        <div class="wrapper wrapper_default">
          <div class="for-business__title" style="color: #fff">
            <h2><?=$arResult["PROPERTIES"]["PROMOTION_TITLE"]["VALUE"]?></h2>
          </div>
          <div class="for-business__body">
            <ul class="for-business__items">
              <?foreach ($arResult["PROPERTIES"]["PROMOTION"]["VALUE"] as $arPromotion) {?>
                <li class="for-business__item">
                  <div class="for-business__item-icon" style="justify-content: left;">
                    <img src="<?=$arPromotion["SRC"]?>" alt="<?=$arPromotion["DESCRIPTION"]?>">
                  </div>
                  <div class="for-business__item-text" style="color: #fff">
                    <?=$arPromotion["DESCRIPTION"]?>
                  </div>
                </li>
              <?}?>
            </ul>
          </div>
          <div class="for-business__footer">
            <?if ($arResult["PROPERTIES"]["PROMOTION_NOTE1"]["VALUE"]["TEXT"]) {?>
              <div class="for-business__disclaimer" style="color: #fff; opacity: 0.7">
                <?=htmlspecialchars_decode($arResult["PROPERTIES"]["PROMOTION_NOTE1"]["VALUE"]["TEXT"])?>
              </div>
            <?}?>
            <?if ($arResult["PROPERTIES"]["PROMOTION_BTN"]["VALUE"]) {?>
              <div class="for-business__btn">
                <a href="#product-open-rko-0" data-title="<?=$arResult["PROPERTIES"]["PROMOTION_BTN"]["VALUE"]?>" class="inline-t-popup btn btn_box btn_red"><?=$arResult["PROPERTIES"]["PROMOTION_BTN"]["VALUE"]?></a>
              </div>
            <?}?>
          </div>
          <?if ($arResult["PROPERTIES"]["PROMOTION_NOTE2"]["VALUE"]["TEXT"]) {?>
            <br>
            <div class="for-business__disclaimer" style="color: #fff; font-size: 16px">
              <?=htmlspecialchars_decode($arResult["PROPERTIES"]["PROMOTION_NOTE2"]["VALUE"]["TEXT"])?>
            </div>
          <?}?>
        </div>
      </div>
    </div>
  <?}?>
  <div class="for-business">
    <div class="for-business__container">
      <div class="wrapper wrapper_default">
        <div class="for-business__title">
          <h2><?=$arResult["PROPERTIES"]["ADVANTAGES_TITLE"]["VALUE"]?></h2>
        </div>
        <div class="for-business__body">
          <ul class="for-business__items" style="grid-gap: 0px 30px;">
            <?foreach ($arResult["PROPERTIES"]["ADVANTAGES"]["VALUE"] as $arAdvantages) {?>
              <li class="for-business__item">
                <div class="for-business__item-icon">
                  <img src="<?=$arAdvantages["SRC"]?>" alt="<?=$arAdvantages["DESCRIPTION"]?>">
                </div>
                <div class="for-business__item-text" style="font-size: 18px">
                  <?=$arAdvantages["DESCRIPTION"]?>
                </div>
              </li>
            <?}?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <?
  $callbackTitle = "Подать заявку на открытие счета";
  $eventName = 'FORM_UL_SCHET';
  $sectionId = '62';
  include $_SERVER['DOCUMENT_ROOT']."/local/views/forms/call2.php";
  ?>

  <div class="conditions">
    <div class="conditions__container">
      <div class="wrapper wrapper_default">
        <div class="conditions__title">
          <h2><?=$arResult["PROPERTIES"]["CONDITIONS_TITLE"]["VALUE"]?></h2>
        </div>
        <div class="conditions__content">
          <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "doc-section", Array(
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "N",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
            "FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
            "IBLOCK_ID" => getIblockIdByCode('rko-documents'),	// Инфоблок
            "IBLOCK_TYPE" => "buiznes",	// Тип инфоблока
            "SECTION_CODE" => "",	// Код раздела
            "SECTION_FIELDS" => array(	// Поля разделов
              0 => "CODE",
              1 => "NAME",
              2 => "",
            ),
            "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
            "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
            "SECTION_USER_FIELDS" => array(	// Свойства разделов
              0 => "",
              1 => "",
            ),
            "SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
            "TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
            "VIEW_MODE" => "LINE",	// Вид списка подразделов
          ),
            false
          );?>
          <br><br><br>
          <?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tarifs-section", Array(
            "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
            "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
            "CACHE_GROUPS" => "N",	// Учитывать права доступа
            "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
            "CACHE_TYPE" => "A",	// Тип кеширования
            "COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",	// Показывать количество
            "FILTER_NAME" => "sectionsFilter",	// Имя массива со значениями фильтра разделов
            "IBLOCK_ID" => getIblockIdByCode('rko-tarifs'),	// Инфоблок
            "IBLOCK_TYPE" => "buiznes",	// Тип инфоблока
            "SECTION_CODE" => "",	// Код раздела
            "SECTION_FIELDS" => array(	// Поля разделов
              0 => "CODE",
              1 => "NAME",
              2 => "",
            ),
            "SECTION_ID" => $_REQUEST["SECTION_ID"],	// ID раздела
            "SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
            "SECTION_USER_FIELDS" => array(	// Свойства разделов
              0 => "",
              1 => "",
            ),
            "SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
            "TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
            "VIEW_MODE" => "LINE",	// Вид списка подразделов
          ),
            false
          );?>
        </div>
      </div>
    </div>
  </div>

</div>
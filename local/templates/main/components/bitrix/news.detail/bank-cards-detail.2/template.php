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
<div class="banner banner--debit-card">
  <div class="banner__container">
    <?if ($arResult["DETAIL_PICTURE"]) {?>
      <div class="banner__picture">
        <div class="picture">
          <picture>
            <?foreach ($arResult["DETAIL_PICTURE"]["SOURCES"] as $arSource) {?>
              <source
                  srcset="<?= $arSource['SRCSET'] ?>"
                  sizes="100vw"
                  type="<?= $arSource['TYPE'] ?>"
              />
            <?}?>
            <img
                alt="<?=$arResult["DETAIL_PICTURE"]["ALT"];?>"
                src="<?= $arResult["DETAIL_PICTURE"]['SRC'] ?>"
            >
          </picture>
        </div>
      </div>
    <?}?>
    <div class="banner__content-container">
      <div class="wrapper wrapper_default">
        <div class="banner__content">
          <div class="banner__title">
            <h1><?=$arResult["NAME"]?></h1>
          </div>
          <div class="banner__description"><?=$arResult["DETAIL_TEXT"]?></div>
          <div class="banner__btn"><a class="btn btn_box btn_red inline-t-popup" href="#product-open-card-issue-<?=$arResult['ID']; ?>" data-title="<?=$arResult['NAME']; ?> - оставить заявку">Заполнить заявку</a></div>
        </div>
      </div>
    </div>
  </div>
  <?if ($arResult["PROPERTIES"]["ADVANTAGE_CIRCLE"]["VALUE"]) {?>
    <div class="banner__advantages">
      <div class="wrapper wrapper_default">
        <ul class="banner__advantages-items">
          <?foreach ($arResult["PROPERTIES"]["ADVANTAGE_CIRCLE"]["VALUE"] as $arAdvantage) {?>
            <li class="banner__advantages-item">
              <div class="banner-advantage">
                <div class="banner-advantage__container">
                  <div class="banner-advantage__value-content">
                    <div class="banner-advantage__value-wrapper">
                      <div class="banner-advantage__value" title="<?=$arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_TEXT"]["VALUE"]?>">
                        <?
                        if ($arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_PICTURE"]["VALUE"]) {
                          $arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_PICTURE"]["VALUE"] = CFile::GetPath($arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_PICTURE"]["VALUE"]);
                          echo ('<img src="'. $arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_PICTURE"]["VALUE"]. '">');
                        } else {
                          echo ($arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_TEXT"]["VALUE"]);
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                  <div class="banner-advantage__content">
                    <div class="banner-advantage__title"><?=$arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_TITLE"]["VALUE"]?></div>
                    <div class="banner-advantage__description"><?=$arAdvantage["SUB_VALUES"]["ADVANTAGE_CIRCLE_DESCRIPTION"]["VALUE"]?></div>
                  </div>
                </div>
              </div>
            </li>
          <?}?>
        </ul>
      </div>
    </div>
  <?}?>
</div>
<?if ($arResult['PROPERTIES']['TYPE']['VALUE'] == "Кредитная") {
  echo view('forms.product', ['id' => 'card-issue-'. $arResult['ID'], 'name' => $arResult['NAME'], 'type' => 'card-credit']);
} else {
  echo view('forms.product', ['id' => 'card-issue-'. $arResult['ID'], 'name' => $arResult['NAME'], 'type' => 'card-debet']);
}?>
<?if ($arResult["PROPERTIES"]["ADVANTAGE_DETAIL"]["VALUE"]) {?>
  <div class="box box--bg-blue-light">
    <div class="box__container">
      <div class="wrapper wrapper_default">
        <div class="box__title">
          <h2>Преимущества карты</h2>
        </div>
        <div class="box__content">
          <div class="card-advantages">
            <div class="card-advantages__items-wrapper">
              <div class="card-advantages__items card-advantages__items--l-3">
                <?foreach ($arResult["PROPERTIES"]["ADVANTAGE_DETAIL"]["VALUE"] as $arAdvantage) {?>
                  <div class="card-advantages__item">
                    <div class="card-advantage">
                      <div class="card-advantage__container">
                        <div class="card-advantage__head">
                          <?if ($arAdvantage["SUB_VALUES"]["ADVANTAGE_DETAIL_PICTURE"]["VALUE"]) {?>
                            <div class="card-advantage__icon">
                              <?$arAdvantage["SUB_VALUES"]["ADVANTAGE_DETAIL_PICTURE"]["VALUE"] = CFile::GetPath($arAdvantage["SUB_VALUES"]["ADVANTAGE_DETAIL_PICTURE"]["VALUE"]);?>
                              <img src="<?=$arAdvantage["SUB_VALUES"]["ADVANTAGE_DETAIL_PICTURE"]["VALUE"]?>">
                            </div>
                          <?}?>
                          <div class="card-advantage__title">
                            <h3><?=$arAdvantage["SUB_VALUES"]["ADVANTAGE_DETAIL_TITLE"]["VALUE"]?></h3>
                          </div>
                        </div>
                        <ul class="card-advantage__items">
                          <?=htmlspecialchars_decode($arAdvantage["SUB_VALUES"]["ADVANTAGE_DETAIL_LIST"]["VALUE"]["TEXT"])?>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?}?>
              </div>
            </div>
            <?$APPLICATION->IncludeFile("/local/views/forms/product2.php", [
              "TITLE" => "Подать заявку на открытие карты",
              "IMG" => SITE_TEMPLATE_PATH. "/images/callback-form/3.png",
              "PRODUCT" => $arResult['NAME'],
              "SECTION_ID" => "71",
              "EVENT_NAME" => "FORM_FL_CARD_DEBET",
            ], [
              "MODE"      => "php",
              "SHOW_BORDER" => "false",
              "NAME" => "форма"
            ]);?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?}?>
<?if ($arResult["PROPERTIES"]["CASHBACK"]["VALUE"]) {?>
  <div class="box">
    <div class="box__container">
      <div class="wrapper wrapper_default">
        <div class="box__title">
          <h2><?=$arResult["PROPERTIES"]["CASHBACK_TITLE"]["VALUE"]?></h2>
        </div>
        <div class="box__description"><?=$arResult["PROPERTIES"]["CASHBACK_DESCRIPTION"]["VALUE"]?></div>
        <div class="box__content">
          <div class="cashback-categories">
            <div class="cashback-categories__items-wrapper">
              <div class="cashback-categories__items">
                <?foreach ($arResult["PROPERTIES"]["CASHBACK"]["VALUE"] as $arCashback) {?>
                  <div class="cashback-categories__item">
                    <div class="cashback-category">
                      <div class="cashback-category__container">
                        <?if ($arCashback["SUB_VALUES"]["CASHBACK_PICTURE"]["VALUE"]) {?>
                          <div class="cashback-category__icon">
                            <?$arCashback["SUB_VALUES"]["CASHBACK_PICTURE"]["VALUE"] = CFile::GetPath($arCashback["SUB_VALUES"]["CASHBACK_PICTURE"]["VALUE"]);?>
                            <img src="<?=$arCashback["SUB_VALUES"]["CASHBACK_PICTURE"]["VALUE"]?>">
                          </div>
                        <?}?>
                        <div class="cashback-category__title">
                          <h3><?=$arCashback["SUB_VALUES"]["CASHBACK_TEXT"]["VALUE"]?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                <?}?>
              </div>
            </div>
<!--            <div class="cashback-categories__buttons-wrapper">-->
<!--              <div class="cashback-categories__buttons">-->
<!--                <div class="cashback-categories__button"><a class="button button--outlined button--color-primary button--size-m" href="#"><span class="button-content">Подробнее о категориях</span></a></div>-->
<!--              </div>-->
<!--            </div>-->
          </div>
        </div>
      </div>
    </div>
  </div>
<?}?>
<?if ($arResult["PROPERTIES"]["PROMOTION_GTB"]["VALUE"]) {?>
  <div class="box box--bg-blue-light">
    <div class="box__container">
      <div class="wrapper wrapper_default">
        <div class="box__title">
          <h2>Акции по программе лояльности «Газтрансбанка» по картам Энергия</h2>
        </div>
        <div class="box__content">
          <?
          global $arFilterPromotionGtb;
          $arFilterPromotionGtb = array("ID" => $arResult["PROPERTIES"]["PROMOTION_GTB"]["VALUE"]);

          $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "bank-cards-promotion",
            Array(
              "ACTIVE_DATE_FORMAT" => "d.m.Y",
              "ADD_SECTIONS_CHAIN" => "N",
              "AJAX_MODE" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "CACHE_FILTER" => "N",
              "CACHE_GROUPS" => "Y",
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "CHECK_DATES" => "Y",
              "DETAIL_URL" => "",
              "DISPLAY_BOTTOM_PAGER" => "N",
              "DISPLAY_DATE" => "Y",
              "DISPLAY_NAME" => "Y",
              "DISPLAY_PICTURE" => "Y",
              "DISPLAY_PREVIEW_TEXT" => "Y",
              "DISPLAY_TOP_PAGER" => "N",
              "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
              "FILTER_NAME" => "arFilterPromotionGtb",
              "HIDE_LINK_WHEN_NO_DETAIL" => "N",
              "IBLOCK_ID" => "69",
              "IBLOCK_TYPE" => "chastnim",
              "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
              "INCLUDE_SUBSECTIONS" => "Y",
              "MESSAGE_404" => "",
              "NEWS_COUNT" => "20",
              "PAGER_BASE_LINK_ENABLE" => "N",
              "PAGER_DESC_NUMBERING" => "N",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => ".default",
              "PAGER_TITLE" => "Новости",
              "PARENT_SECTION" => "",
              "PARENT_SECTION_CODE" => "",
              "PREVIEW_TRUNCATE_LEN" => "",
              "PROPERTY_CODE" => array("DESCRIPTION_SHORT",""),
              "SET_BROWSER_TITLE" => "N",
              "SET_LAST_MODIFIED" => "N",
              "SET_META_DESCRIPTION" => "N",
              "SET_META_KEYWORDS" => "N",
              "SET_STATUS_404" => "N",
              "SET_TITLE" => "N",
              "SHOW_404" => "N",
              "SORT_BY1" => "ACTIVE_FROM",
              "SORT_BY2" => "SORT",
              "SORT_ORDER1" => "DESC",
              "SORT_ORDER2" => "ASC",
              "STRICT_SECTION_CHECK" => "N",
              "CUSTOM_LINK_DETAIL" => "Y",
            )
          );?>
        </div>
      </div>
    </div>
  </div>
<?}?>
<?if ($arResult["PROPERTIES"]["PROMOTION_MIR"]["VALUE"]) {?>
  <div class="box box--bg-blue">
    <div class="box__container">
      <div class="wrapper wrapper_default">
        <div class="box__title">
          <h2>Получайте кешбэк до 50% по программе лояльности для держателей карт «Мир»</h2>
        </div>
        <div class="box__content">
          <?
          global $arFilterPromotionMir;
          $arFilterPromotionMir = array("ID" => $arResult["PROPERTIES"]["PROMOTION_MIR"]["VALUE"]);

          $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "bank-cards-promotion",
            Array(
              "ACTIVE_DATE_FORMAT" => "d.m.Y",
              "ADD_SECTIONS_CHAIN" => "N",
              "AJAX_MODE" => "N",
              "AJAX_OPTION_ADDITIONAL" => "",
              "AJAX_OPTION_HISTORY" => "N",
              "AJAX_OPTION_JUMP" => "N",
              "AJAX_OPTION_STYLE" => "Y",
              "CACHE_FILTER" => "N",
              "CACHE_GROUPS" => "Y",
              "CACHE_TIME" => "36000000",
              "CACHE_TYPE" => "A",
              "CHECK_DATES" => "Y",
              "DETAIL_URL" => "",
              "DISPLAY_BOTTOM_PAGER" => "N",
              "DISPLAY_DATE" => "Y",
              "DISPLAY_NAME" => "Y",
              "DISPLAY_PICTURE" => "Y",
              "DISPLAY_PREVIEW_TEXT" => "Y",
              "DISPLAY_TOP_PAGER" => "N",
              "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE",""),
              "FILTER_NAME" => "arFilterPromotionMir",
              "HIDE_LINK_WHEN_NO_DETAIL" => "N",
              "IBLOCK_ID" => "69",
              "IBLOCK_TYPE" => "chastnim",
              "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
              "INCLUDE_SUBSECTIONS" => "Y",
              "MESSAGE_404" => "",
              "NEWS_COUNT" => "20",
              "PAGER_BASE_LINK_ENABLE" => "N",
              "PAGER_DESC_NUMBERING" => "N",
              "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
              "PAGER_SHOW_ALL" => "N",
              "PAGER_SHOW_ALWAYS" => "N",
              "PAGER_TEMPLATE" => ".default",
              "PAGER_TITLE" => "Новости",
              "PARENT_SECTION" => "",
              "PARENT_SECTION_CODE" => "",
              "PREVIEW_TRUNCATE_LEN" => "",
              "PROPERTY_CODE" => array("DESCRIPTION_SHORT",""),
              "SET_BROWSER_TITLE" => "N",
              "SET_LAST_MODIFIED" => "N",
              "SET_META_DESCRIPTION" => "N",
              "SET_META_KEYWORDS" => "N",
              "SET_STATUS_404" => "N",
              "SET_TITLE" => "N",
              "SHOW_404" => "N",
              "SORT_BY1" => "ACTIVE_FROM",
              "SORT_BY2" => "SORT",
              "SORT_ORDER1" => "DESC",
              "SORT_ORDER2" => "ASC",
              "STRICT_SECTION_CHECK" => "N",
              "CUSTOM_TITLE" => "Y",
              "CUSTOM_DESCRIPTION" => "Y",
              "CUSTOM_BTN_LINK" => "https://privetmir.ru/promo/",
              "CUSTOM_TEXT_PATH" => "/chastnym-litsam/bankovskie-karty/text_mir.php",
            )
          );?>
        </div>
      </div>
    </div>
  </div>
<?}?>
<?if (
    $arResult["PROPERTIES"]["CONDITIONS_TEXT"]["VALUE"]["TEXT"] ||
    $arResult["PROPERTIES"]["CONDITIONS_FILE"]["VALUE"] ||
    $arResult["PROPERTIES"]["RATE_TEXT"]["VALUE"]["TEXT"] ||
    $arResult["PROPERTIES"]["RATE_FILE"]["VALUE"] ||
    $arResult["PROPERTIES"]["LIST_TEXT"]["VALUE"]["TEXT"] ||
    $arResult["PROPERTIES"]["LIST_FILE"]["VALUE"] ||
    $arResult["PROPERTIES"]["SECURITY_TEXT"]["VALUE"]["TEXT"] ||
    $arResult["PROPERTIES"]["SECURITY_FILE"]["VALUE"]
) {?>
  <div class="conditions">
    <div class="conditions__container">
      <div class="wrapper wrapper_default">
        <div class="conditions__title">
          <h2>Ознакомьтесь с условиями</h2>
        </div>
        <div class="conditions__content">
          <div class="faq-w">
            <?if ($arResult["PROPERTIES"]["CONDITIONS_TEXT"]["VALUE"]["TEXT"] || $arResult["PROPERTIES"]["CONDITIONS_FILE"]["VALUE"]) {?>
              <div class="toggle-w toggle-w_b-offset toggle-w_light">
                <div class="toggle-w__header"><span class="toggle-w__title h4 title title_light">Условия</span> <i class="toggle-w__arrow"></i></div>
                <div class="toggle-w__content">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["CONDITIONS_TEXT"]["VALUE"]["TEXT"])?>
                  <?if ($arResult["PROPERTIES"]["CONDITIONS_FILE"]["VALUE"]) {?>
                    <?foreach ($arResult['PROPERTIES']['CONDITIONS_FILE']['VALUE'] as $keyFile => $idFile) {?>
                      <a href="<?=CFile::GetPath($idFile); ?>" target="_blank" class="doc doc_offset">
                        <img class="doc__ico" src="/local/templates/main/images/document.svg">
                        <span class="doc__title title title_semi">
                          <?=$arResult['PROPERTIES']['CONDITIONS_FILE']['DESCRIPTION'][$keyFile];?>
                        </span>
                      </a>
                    <?}?>
                  <?}?>
                </div>
              </div>
            <?}?>
            <?if ($arResult["PROPERTIES"]["RATE_TEXT"]["VALUE"]["TEXT"] || $arResult["PROPERTIES"]["RATE_FILE"]["VALUE"]) {?>
              <div class="toggle-w toggle-w_b-offset toggle-w_light">
                <div class="toggle-w__header"><span class="toggle-w__title h4 title title_light">Тарифы</span> <i class="toggle-w__arrow"></i></div>
                <div class="toggle-w__content">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["RATE_TEXT"]["VALUE"]["TEXT"])?>
                  <?if ($arResult["PROPERTIES"]["RATE_FILE"]["VALUE"]) {?>
                    <?foreach ($arResult['PROPERTIES']['RATE_FILE']['VALUE'] as $keyFile => $idFile) {?>
                      <a href="<?=CFile::GetPath($idFile); ?>" target="_blank" class="doc doc_offset">
                        <img class="doc__ico" src="/local/templates/main/images/document.svg">
                        <span class="doc__title title title_semi">
                          <?=$arResult['PROPERTIES']['RATE_FILE']['DESCRIPTION'][$keyFile];?>
                        </span>
                      </a>
                    <?}?>
                  <?}?>
                </div>
              </div>
            <?}?>
            <?if ($arResult["PROPERTIES"]["LIST_TEXT"]["VALUE"]["TEXT"] || $arResult["PROPERTIES"]["LIST_FILE"]["VALUE"]) {?>
              <div class="toggle-w toggle-w_b-offset toggle-w_light">
                <div class="toggle-w__header"><span class="toggle-w__title h4 title title_light">Список необходимых документов</span> <i class="toggle-w__arrow"></i></div>
                <div class="toggle-w__content">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["LIST_TEXT"]["VALUE"]["TEXT"])?>
                  <?if ($arResult["PROPERTIES"]["LIST_FILE"]["VALUE"]) {?>
                    <?foreach ($arResult['PROPERTIES']['LIST_FILE']['VALUE'] as $keyFile => $idFile) {?>
                      <a href="<?=CFile::GetPath($idFile); ?>" target="_blank" class="doc doc_offset">
                        <img class="doc__ico" src="/local/templates/main/images/document.svg">
                        <span class="doc__title title title_semi">
                          <?=$arResult['PROPERTIES']['LIST_FILE']['DESCRIPTION'][$keyFile];?>
                        </span>
                      </a>
                    <?}?>
                  <?}?>
                </div>
              </div>
            <?}?>
            <?if ($arResult["PROPERTIES"]["SECURITY_TEXT"]["VALUE"]["TEXT"] || $arResult["PROPERTIES"]["SECURITY_FILE"]["VALUE"]) {?>
              <div class="toggle-w toggle-w_b-offset toggle-w_light">
                <div class="toggle-w__header"><span class="toggle-w__title h4 title title_light">Безопасность</span> <i class="toggle-w__arrow"></i></div>
                <div class="toggle-w__content">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["SECURITY_TEXT"]["VALUE"]["TEXT"])?>
                  <?if ($arResult["PROPERTIES"]["SECURITY_FILE"]["VALUE"]) {?>
                    <?foreach ($arResult['PROPERTIES']['SECURITY_FILE']['VALUE'] as $keyFile => $idFile) {?>
                      <a href="<?=CFile::GetPath($idFile); ?>" target="_blank" class="doc doc_offset">
                        <img class="doc__ico" src="/local/templates/main/images/document.svg">
                        <span class="doc__title title title_semi">
                          <?=$arResult['PROPERTIES']['SECURITY_FILE']['DESCRIPTION'][$keyFile];?>
                        </span>
                      </a>
                    <?}?>
                  <?}?>
                </div>
              </div>
            <?}?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?}?>
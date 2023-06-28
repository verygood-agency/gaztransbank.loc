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


$component->SetResultCacheKeys(array("ITEMS"));
$this->setFrameMode(true);
?>
<div class="actions">
  <?if ($arParams["CUSTOM_TEXT_PATH"]) {?>
    <div class="actions__text">
      <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => $arParams["CUSTOM_TEXT_PATH"]
      )); ?>
    </div>
  <?}?>
  <div class="actions__cards">
    <div class="actions__cards-items">
      <?foreach ($arResult["ITEMS"] as $arItem) {?>
        <div class="actions__cards-item">
          <?if ($arParams["CUSTOM_LINK_DETAIL"] == "Y") {?>
            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>?return=<?=$APPLICATION->GetCurPage()?>" class="action-card">
          <?} else {?>
            <div class="action-card">
          <?}?>
            <div class="action-card__container">
              <?if ($arItem["PREVIEW_PICTURE"]) {?>
                <div class="action-card__picture">
                  <div class="picture">
                    <picture>
                      <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>">
                    </picture>
                  </div>
                </div>
              <?}?>
              <div class="action-card__content">
                <?if ($arParams["CUSTOM_TITLE"] == "Y" || $arParams["CUSTOM_DESCRIPTION"] == "Y") {?>
                  <div class="action-card__text">
                    <?if ($arParams["CUSTOM_TITLE"] == "Y") {?>
                      <div class="action-card__title">
                        <h3><?=$arItem["NAME"]?></h3>
                      </div>
                    <?}?>
                    <?if ($arParams["CUSTOM_DESCRIPTION"] == "Y") {?>
                      <div class="action-card__description"><?=$arItem["PREVIEW_TEXT"]?></div>
                    <?}?>
                  </div>
                <?}?>
                <div class="action-card__value-container">
                  <div class="action-card__value"><?=$arItem["PROPERTIES"]["DESCRIPTION_SHORT"]["VALUE"]?></div>
                </div>
              </div>
            </div>
          <?if ($arParams["CUSTOM_LINK_DETAIL"] == "Y") {?>
            </a>
          <?} else {?>
            </div>
          <?}?>
        </div>
      <?}?>
    </div>
  </div>
  <?if ($arParams["CUSTOM_BTN_LINK"]) {?>
    <div class="actions__buttons">
      <div class="actions__buttons-items">
        <div class="actions__buttons-item"><a class="button button--outlined button--color-primary button--size-m" href="<?=$arParams["CUSTOM_BTN_LINK"]?>" target="_blank"><span class="button-content">Смотреть все акции</span></a></div>
      </div>
    </div>
  <?}?>
</div>
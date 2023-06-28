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

$_REQUEST["return"] = htmlspecialchars($_REQUEST["return"]);
if (!$_REQUEST["return"]) {
  $_REQUEST["return"] = "/chastnym-litsam/bankovskie-karty/";
}
?>
<div class="action-detail">
  <div class="action-detail__container">
    <div class="wrapper wrapper_default">
      <div class="action-detail__title">
        <h1><?=$arResult["NAME"]?></h1>
      </div>
      <div class="action-detail__content">
        <div class="action-detail__content-row">
          <div class="action-detail__card">
            <div class="action-card">
              <div class="action-card__container">
                <?if ($arResult["DETAIL_PICTURE"]) {?>
                  <div class="action-card__picture">
                    <div class="picture">
                      <picture>
                        <source srcset="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" type="<?=$arResult["DETAIL_PICTURE"]["CONTENT_TYPE"]?>">
                        <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>">
                      </picture>
                    </div>
                  </div>
                <?}?>
                <div class="action-card__content">
                  <div class="action-card__value-container">
                    <div class="action-card__value"><?=$arResult["PROPERTIES"]["DESCRIPTION_SHORT"]["VALUE"]?></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="action-detail__text-wrapper">
            <div class="action-detail__text">
              <div class="text">
                <?=$arResult["DETAIL_TEXT"]?>
              </div>
            </div>
            <?if ($_REQUEST["return"]) {?>
              <div class="action-detail__back-link"><a class="button button--outlined button--color-primary button--size-m" href="<?=$_REQUEST["return"]?>"><span class="button-content">Назад</span></a></div>
            <?}?>
          </div>
        </div>
      </div>
      <?if ($arResult["PROPERTIES"]["FAQ1_TITLE"]["VALUE"] && ($arResult["PROPERTIES"]["FAQ1_TEXT"]["VALUE"]["TEXT"] || $arResult["PROPERTIES"]["FAQ1_FILE"]["VALUE"])) {?>
        <div class="action-detail__faq">
          <div class="faq-w">
            <div class="toggle-w toggle-w_b-offset toggle-w_light" id="bx_3218110189_1166">
              <div class="toggle-w__header"><span class="toggle-w__title h4 title title_light"><?=$arResult["PROPERTIES"]["FAQ1_TITLE"]["VALUE"]?></span> <i class="toggle-w__arrow"></i></div>
              <div class="toggle-w__content">
                <div class="content toggle-w__desc">
                  <?=htmlspecialchars_decode($arResult["PROPERTIES"]["FAQ1_TEXT"]["VALUE"]["TEXT"])?>
                  <?if ($arResult["PROPERTIES"]["FAQ1_FILE"]["VALUE"]) {?>
                    <?foreach ($arResult['PROPERTIES']['FAQ1_FILE']['VALUE'] as $keyFile => $idFile) {?>
                      <a href="<?=CFile::GetPath($idFile); ?>" target="_blank" class="doc doc_offset">
                        <img class="doc__ico" src="/local/templates/main/images/document.svg">
                        <span class="doc__title title title_semi">
                          <?=$arResult['PROPERTIES']['FAQ1_FILE']['DESCRIPTION'][$keyFile];?>
                        </span>
                      </a>
                    <?}?>
                  <?}?>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?}?>
    </div>
  </div>
</div>
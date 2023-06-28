<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$this->setFrameMode(true);
$component->SetResultCacheKeys(array("ITEMS"));

?>
<div class="row">
   <?foreach($arResult["ITEMS"] as $arItem){?>
   <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="col col--lg-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="kredit-tile kredit-tile_offset">
            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="h4 kredit-tile__title">
                <?=$arItem['NAME'];?>
            </a>
            <div class="kredit-tile__desc">
              <div class="preview-kredit content">
                <?=$arItem['PREVIEW_TEXT'];?>
                <?if ($arItem['PROPERTIES']['PREVIEW_LIST']['VALUE']) {
                  if (count($arItem['PROPERTIES']['PREVIEW_LIST']['VALUE']) > 1) {?>
                    <div class="row">
                      <?foreach($arItem['PROPERTIES']['PREVIEW_LIST']['VALUE'] as $list){?>
                        <div class="col col--lg-6">
                          <?=htmlspecialchars_decode($list['TEXT'])?>
                        </div>
                      <?}?>
                    </div>
                  <?} else {
                    foreach($arItem['PROPERTIES']['PREVIEW_LIST']['VALUE'] as $list){
                      echo ($list);
                    }
                  }
                }?>
              </div>
            </div>

            <div class="kredit-info kredit-info_b-offset">
                <?
                foreach($arItem['PROPERTIES']['CONDITIONS']['VALUE'] as $key=>$line){
                    ?>
                    <div class="kredit-info__item">
                    <span class="kredit-info__title">
                        <?=$arItem['PROPERTIES']['CONDITIONS']['DESCRIPTION'][$key];?>
                    </span>
                        <span class="kredit-info__desc">
                        <?=$arItem['PROPERTIES']['CONDITIONS']['VALUE'][$key];?>
                    </span>
                    </div>
                <?}?>
            </div>
            <div class="kredit-nav">
                <a href="#product-open-credit-<?php echo $arItem['ID']; ?>" data-title="<?php echo $arItem['NAME']; ?> - оставить заявку" class="kredit-nav__btn inline-t-popup btn btn_default btn_blue">
                    <span class="btn__title">
                        Отправить заявку
                    </span>
                </a>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="link link_blue link_decorated kredit-nav__link">
                    Подробнее
                </a>
            </div>
        </div>
    </div>
   <?}?>
</div>
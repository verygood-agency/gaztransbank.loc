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
$component->SetResultCacheKeys(array("ITEMS"));
$this->setFrameMode(true);
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
                <?=$arItem['PREVIEW_TEXT'];?>
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
                <a data-title="Заявка на кредит" href="#product-open-kredit-<?php echo $arItem['ID']; ?>" class="inline-t-popup kredit-nav__btn btn btn_default btn_blue">
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

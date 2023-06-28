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
?>
<div class="row">
<?foreach($arResult["ITEMS"] as $arItem){?>
<?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
    <div class="col col--lg-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="box box_middle box_white simple-tile simple-tile_offset match-height block-jeight">
            <h3 class="simple-tile__title simple-tile__title_m-offset blue h3"><?=$arItem['NAME'];?></h3>
            <div class="simple-tile__desc">
                <p>
                    <?=$arItem['PREVIEW_TEXT'];?>
                </p>
            </div>
        </div>
    </div>
<?}?>
</div>
    
    

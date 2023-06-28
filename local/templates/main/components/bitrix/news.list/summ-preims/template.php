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
        <div class="col col--md-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="progress">
                <span class="progress__title title title_light">
                    <?=$arItem['PREVIEW_TEXT'];?>
                </span>
                <span class="progress__price h4 title title_bold">
                   <?=$arItem['NAME'];?>
                </span>
                <span class="progress__line"></span>
                <span class="progress__date title title_semi">
                    <?=$arItem['DETAIL_TEXT'];?>
                </span>
            </div>
        </div>
    <?}?>
</div>

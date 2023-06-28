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
<div class="box box_white rekv-box box_default">
    <div class="lr-table">
       <?foreach($arResult["ITEMS"] as $arItem){
            
        ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        
        foreach($arItem['PROPERTIES']['ITEM']['VALUE'] as $i=> $value){
            
        ?>
        <div class="lr-table__row" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="lr-table__col lr-table__left">
                <span class="title title_semi">
                   <?=$arItem['PROPERTIES']['ITEM']['DESCRIPTION'][$i];?>
                    
                </span>
            </div>
            <div class="lr-table__col lr-table__right">
              
                <?=$arItem['PROPERTIES']['ITEM']['~VALUE'][$i]['TEXT'];?>
            </div>
        </div>
        <?}}?>
    </div>
</div>

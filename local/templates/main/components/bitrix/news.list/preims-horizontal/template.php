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
   <?foreach($arResult["ITEMS"] as $arItem){
    
    ?>
    <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>59, 'height'=>59), BX_RESIZE_IMAGE_EXACT, true,false,false,85); 
    
	?>
    <div class="col col--lg-3 col--md-6">
        <div class="preim preim_b-offset" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="preim__pic">
                <img src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
            </div>
            <div class="preim__desc">
                <p>
                    <?=$arItem['PREVIEW_TEXT'];?>
                </p>
            </div>
        </div>
    </div>
    <?}?>
</div>

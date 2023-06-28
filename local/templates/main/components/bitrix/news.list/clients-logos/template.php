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

<div class="partners-slider swiper-container">
    <div class="swiper-wrapper">
       <?foreach($arResult["ITEMS"] as $arItem){
        $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>149, 'height'=>149), BX_RESIZE_IMAGE_EXACT, true,false,false,65); 
        ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="partner-tile partner-tile_offset">
                <img class="partner-tile__pic" src="<?=$img['src'];?>" alt="">
            </div>
        </div>
        <?}?>
    </div>
    <div class="swiper-pagination"></div>
</div>

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

<div class="box-sale__items">
   <?foreach($arResult["ITEMS"] as $arItem){
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>34, 'height'=>34), BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,75);
    $link = $arItem['PROPERTIES']['LINK']['VALUE'];

    ?>
    <a href="<?=$link;?>" class="box-sale-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <span class="box-sale-item__ico">
            <img class="" src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
        </span>
        <span class="box-sale-item__title"><?=$arItem['NAME'];?></span>
    </a>
    <?}?>
</div>

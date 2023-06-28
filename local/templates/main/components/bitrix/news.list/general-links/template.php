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
   <?foreach($arResult["ITEMS"] as $key => $arItem){
    $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>170, 'height'=>170), BX_RESIZE_IMAGE_EXACT, true,false,false,65); 
    ?>
    <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $link = $arItem['PROPERTIES']['LINK']['VALUE'];
	?>
    <div class="col col--lg-4  col--sm-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$link;?>" class="pic-link pic-link_b-offset pic-link_white">
            <span class="pic-link__title">
                <?=$arItem['NAME'];?>
            </span>
            <img class="pic-link__img" src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" <?if($key <> 0){print ('loading="lazy"');}?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
        </a>
    </div>
    <?}?>
</div>


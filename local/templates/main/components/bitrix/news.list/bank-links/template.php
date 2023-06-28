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
<?foreach($arResult["ITEMS"] as $arItem){
  $ico = CFile::GetPath($arItem['PROPERTIES']['ICON']['VALUE']);      
?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="col col--lg-6" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE'];?>" class="doc doc_offset">
            <img class="doc__ico" src="<?=$ico;?>" width="27" height="33" loading="lazy" alt="ООО КБ «ГТ банк»">
            <span class="doc__title title title_semi">
                <?=$arItem['NAME'];?>
            </span>
        </a>
    </div>
<?}?>
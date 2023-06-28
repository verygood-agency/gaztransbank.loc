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

<div class="docs">
   <?foreach($arResult["ITEMS"] as $arItem){
    $docs = $arItem['PROPERTIES']['DOCS']['VALUE'];
    
        foreach($docs as $key=> $item){
    ?>
          
           <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    $fileUrl = CFile::GetPath($arItem['PROPERTIES']['DOCS']['VALUE'][$key]);       
    
	?>
          
            <a href="<?=$fileUrl;?>" class="doc doc_offset" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
                <span class="doc__title title title_semi">
                    <?=$arItem['PROPERTIES']['DOCS']['DESCRIPTION'][$key];?>
                </span>
            </a>
        <?}?>
    
    
    <?}?>
</div>

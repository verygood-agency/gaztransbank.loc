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

<div class="section section_default table-section" id="tarif-list">
   <?foreach($arResult["ITEMS"] as $arItem){

        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
       <a name="<?=$arItem['PROPERTIES']['ANCHOR']['VALUE']?>"></a>
        <div class="box box_white box_default box-table">
           <h3 class="h3 table-section__title section__title">
               <?=$arItem['NAME']?>
           </h3>
           <div class="table-wrapper table-wrapper__bottom">
               <div class="content table_content table-wrapper__bottom">
                   <?=$arItem["PREVIEW_TEXT"];?>
               </div>
               <?if(!empty($arItem['PROPERTIES']['FILES']['VALUE'])){?>
                   <div class="doc-inside">
                       <?foreach($arItem['PROPERTIES']['FILES']['VALUE'] as $key=> $item){
                           $fileSrc = CFile::GetPath($arItem['PROPERTIES']['FILES']['VALUE'][$key]);
                           ?>
                           <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset" style="margin-bottom: 1rem;">
                               <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="<?=$arItem['PROPERTIES']['FILE']['DESCRIPTION'][$key];?>. ООО КБ «ГТ банк»">
                               <span class="doc__title title title_semi">
                                  <?echo($arItem['PROPERTIES']['FILES']['DESCRIPTION'][$key]);?>
                                </span>
                           </a>
                       <?}?>
                   </div>
               <?}?>
           </div>
        </div>
    <?}?>
</div>
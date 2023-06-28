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
<div class="faq-w">
   <?if($arParams['NO_WRAPPER'] != 'Y'){?>
    <div class="wrapper wrapper_default">
      <?}?>
       <?foreach($arResult["ITEMS"] as $arItem){
        
        ?>
        <?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
        <div class="toggle-w toggle-w_b-offset toggle-w_light" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="toggle-w__header">
                <span class="toggle-w__title h4 title title_light"><?=$arItem['NAME']?></span>
                <i class="toggle-w__arrow"></i>
            </div>
            <div class="toggle-w__content content">
              <div class="section__desc section__desc_b-offset">
                  <?=$arItem["PREVIEW_TEXT"];?>
              </div>
               
               <?=$arItem["DETAIL_TEXT"];?>
               
               <?if(!empty($arItem['PROPERTIES']['FILES']['VALUE'])){?>
               <div class="doc-inside">
               <?foreach($arItem['PROPERTIES']['FILES']['VALUE'] as $key=> $item){
                    $fileSrc = CFile::GetPath($arItem['PROPERTIES']['FILES']['VALUE'][$key]);
                ?>
<!--
                <pre>
                    <?print_r($item)?>
                </pre>
-->
                <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset">
                    <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="<?=$arItem['PROPERTIES']['FILE']['DESCRIPTION'][$key];?>. ООО КБ «ГТ банк»">
                    <span class="doc__title title title_semi">
                          <?print_r($arItem['PROPERTIES']['FILES']['DESCRIPTION'][$key]);?>
                    </span>
                </a>
                <?}?>
                </div>
               <?}?>
               
               
            </div>
        </div>
        <?}?>
    <?if($arParams['NO_WRAPPER'] != 'Y'){?></div><?}?>
</div>
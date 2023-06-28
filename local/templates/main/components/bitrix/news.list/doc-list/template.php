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

<div class="faq-w" id="faq-w">
    <?if($arParams['NO_WRAPPER'] != 'Y'){?>
        <div class="wrapper wrapper_default">
    <?}?>
    <?foreach($arResult["ITEMS"] as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        if ($arItem['PREVIEW_TEXT'] || $arItem['PROPERTIES']['SRC']['VALUE'] || $arItem['PROPERTIES']['FILE']['VALUE']) {
        ?>
            <div class="toggle-w toggle-w_b-offset toggle-w_light" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

                <div class="toggle-w__header ">
                    <? if(!empty($arItem['PROPERTIES']['ICO']['VALUE'])){
                        $icon = CFile::GetPath($arItem['PROPERTIES']['ICO']['VALUE']);
                        ?>
                        <div class="pic-w">
                            <div class="pic-w__ico">
                                <img class="pic-w__ico" src="<?=$icon;?>" loading="lazy" alt="ООО КБ «ГТ банк»">
                            </div>
                            <span class="pic-w__title">
                                <?=$arItem['NAME']?>
                            </span>
                        </div>
                    <?}else{?>
                        <span class="toggle-w__title h4 title title_light"><?=$arItem['NAME']?></span>
                        <i class="toggle-w__arrow"></i>
                    <?}?>
                </div>

                <div class="toggle-w__content">
                    <?if(!empty($arItem['PREVIEW_TEXT']) && $arItem['PROPERTIES']['TYPE']['VALUE'] <> "Документы и текст"){?>
                        <div class="content toggle-w__desc">
                            <?=htmlspecialchars_decode($arItem['PREVIEW_TEXT']);?>
                        </div>
                        <?if (!empty($arItem['PROPERTIES']['SRC']['VALUE']) || !empty($arItem['PROPERTIES']['FILE']['VALUE'])) {echo ("<br><br>");};?>
                    <?}?>

                    <?foreach($arItem['PROPERTIES']['SRC']['VALUE'] as $key => $itemSRC){
                        ?>
                        <a href="<?=$itemSRC;?>" target="_blank" class="doc doc_offset">
                            <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="<?=$arItem['PROPERTIES']['SRC']['DESCRIPTION'][$key];?>. ООО КБ «ГТ банк»">
                            <span class="doc__title title title_semi">
                                <?echo($arItem['PROPERTIES']['SRC']['DESCRIPTION'][$key]);?>
                            </span>
                        </a>
                    <?}?>

                    <?foreach($arItem['PROPERTIES']['FILE']['VALUE'] as $key => $item){
                        $fileSrc = CFile::GetPath($item);
                        ?>
                        <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset">
                            <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="<?=$arItem['PROPERTIES']['FILE']['DESCRIPTION'][$key];?>. ООО КБ «ГТ банк»">
                            <span class="doc__title title title_semi">
                                <?echo($arItem['PROPERTIES']['FILE']['DESCRIPTION'][$key]);?>
                            </span>
                        </a>
                    <?}?>

                    <?if(!empty($arItem['PREVIEW_TEXT']) && $arItem['PROPERTIES']['TYPE']['VALUE'] == "Документы и текст"){?>
                        <div class="toggle-w__desc">
                            <?=htmlspecialchars_decode($arItem['PREVIEW_TEXT']);?>
                        </div>
                    <?}?>
                </div>
            </div>
        <?}?>
    <?}?>
    <?if($arParams['NO_WRAPPER'] != 'Y'){?>
        </div>
    <?}?>
</div>


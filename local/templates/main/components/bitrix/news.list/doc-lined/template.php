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

<div class="doc-list">
    <?foreach($arResult["ITEMS"] as $arItem){?>

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

        <?foreach($arItem['PROPERTIES']['FILE']['VALUE'] as $key=> $item){
            $fileSrc = CFile::GetPath($item);
            ?>
        <a href="<?=$fileSrc;?>" target="_blank" class="doc doc_offset">
            <img class="doc__ico" src="<?=SITE_TEMPLATE_PATH?>/images/document.svg" width="27" height="33" loading="lazy" alt="Документ. ООО КБ «ГТ банк»">
            <span class="doc__title title title_semi"><?=$arItem['PROPERTIES']['FILE']['DESCRIPTION'][$key]?></span>
        </a>
        <?}?>

        <?if(!empty($arItem['PREVIEW_TEXT']) && $arItem['PROPERTIES']['TYPE']['VALUE'] == "Документы и текст"){?>
            <div class="toggle-w__desc">
                <?=htmlspecialchars_decode($arItem['PREVIEW_TEXT']);?>
            </div>
        <?}?>

    <?}?>
</div>


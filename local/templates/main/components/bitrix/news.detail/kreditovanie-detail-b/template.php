<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
$component->SetResultCacheKeys(array("ID", "NAME"));
$this->setFrameMode(true);

$img=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array('width'=>950, 'height'=>950), BX_RESIZE_IMAGE_PROPORTIONAL, true,false,false,65);
?>

<div class="section section_white section_default section_b-s-offset">
    <div class="wrapper wrapper_default">
        <div class="ipoteka-up pos-relative">

            <div class="row">
                <div class="col col--lg-7">
                    <h1 class="page-title">
                        <?php echo $arResult['NAME']; ?>
                    </h1>
                    <h4 class="h4 page-desc title title_light">
                        <?=$arResult['PREVIEW_TEXT'];?>
                    </h4>
                    <div class="text-info text-info__bottom">

                        <div class="row">
                            <?
                            foreach($arResult['PROPERTIES']['CONDITIONS']['VALUE'] as $key=>$line){
                                ?>
                                <div class="col col--sm-4">
                                    <span class="text-info__title title title_block">
                                        <?=$arResult['PROPERTIES']['CONDITIONS']['DESCRIPTION'][$key];?>
                                    </span>
                                    <span class="h4 text-info__desc title title_block title_bold">
                                        <?=$arResult['PROPERTIES']['CONDITIONS']['VALUE'][$key];?>
                                    </span>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <a data-title="Заявка на кредит" href="#product-open-kredit-<?php echo $arResult['ID']; ?>" class="inline-t-popup btn btn_default btn-bordered_red">Отправить заявку</a>
                </div>
                <div class="col col--lg-5">
                    <div class="ipoteka-up__img img_bottom">
                        <img src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="100%" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section section_default">

    <?foreach($arResult['PROPERTIES']['TEXT']['VALUE'] as $key=> $Item){
        ?>
        <div class="wrapper wrapper_default">
            <div class="box box_white box_default box-table">
                <h3 class="h3 table-section__title section__title">
                    <?echo($arResult['PROPERTIES']['TEXT']['DESCRIPTION'][$key]);?>
                </h3>
                <div class="table-wrapper table-wrapper__bottom">
                    <div class="content">
                        <?echo htmlspecialchars_decode($Item['TEXT']); ?>
                    </div>
                </div>
            </div>
        </div>
    <?}?>

    <?if ($arResult['PROPERTIES']['DOCUMENTS']['VALUE']) {?>
        <div class="faq-w">
            <div class="wrapper wrapper_default">
                <div class="toggle-w toggle-w_b-offset toggle-w_light">

                    <div class="toggle-w__header">
                        <span class="toggle-w__title h4 title title_light">Документы</span>
                        <i class="toggle-w__arrow"></i>
                    </div>

                    <div class="toggle-w__content">
                        <?php foreach ($arResult['PROPERTIES']['DOCUMENTS']['VALUE'] as $num => $value): ?>
                            <a href="<?php echo CFile::GetPath($value); ?>" target="_blank" class="doc doc_offset">
                                <img class="doc__ico" src="/local/templates/main/images/document.svg" width="27" height="33" loading="lazy" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>">
                                <span class="doc__title title title_semi">
                                    <?php echo $arResult['PROPERTIES']['DOCUMENTS']['DESCRIPTION'][$num]; ?>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
</div>

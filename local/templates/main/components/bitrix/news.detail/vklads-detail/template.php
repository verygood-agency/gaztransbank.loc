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

$img=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array('width'=>500, 'height'=>365), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
$img2=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"], Array('width'=>1000, 'height'=>650), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
?>
<div class="section section_default">
    <div class="wrapper wrapper_default">
        <div class="l-sale">
            <div class="l-sale__content">
                <h1 class="h3 l-sale__title">
                    Вклад «<?php echo $arResult['NAME']; ?>»
                </h1>
                <?if ($arResult['PROPERTIES']['POSTSCRIPT']['VALUE']) {?>
                  <h2 class="vklad-postscript">
                    <?=$arResult['PROPERTIES']['POSTSCRIPT']['VALUE']?>
                  </h2>
                <?}?>
                <div class="vklad-number">
                    <div class="vklad-number__item">
                      <?if ($arResult['PROPERTIES']['STAVKA']['VALUE']){?>
                        <div class="vklad-number__up"><?php echo $arResult['PROPERTIES']['STAVKA']['VALUE']; ?></div>
                        <div class="vklad-number__down">Ставка</div>
                      <?}?>
                    </div>
                    <div class="vklad-number__item">
                        <?if ($arResult['PROPERTIES']['MIN']['VALUE']){?>
                            <div class="vklad-number__up"><?php echo $arResult['PROPERTIES']['MIN']['VALUE']; ?></div>
                            <div class="vklad-number__down">Минимальная сумма вклада</div>
                        <?}?>
                    </div>
                    <div class="vklad-number__item">
                        <?if ($arResult['PROPERTIES']['SROC']['VALUE']){?>
                            <div class="vklad-number__up"><?php echo $arResult['PROPERTIES']['SROC']['VALUE']; ?></div>
                            <div class="vklad-number__down">Срок вклада</div>
                        <?}?>
                    </div>
                </div>
                <?if ($arResult["PROPERTIES"]["PROLONGATION"]["VALUE"] <> "Да" && false) {?>
                  <div class="l-sale__btns">
                      <a
                          href="#product-open-vklad-<?php echo $arResult['ID']; ?>" data-title="Заявка на открытие вклада - <?=$arResult['NAME'];?>"
                          class="btn btn_default btn-bordered_blue l-sale__btn inline-t-popup"
                      >Открыть вклад</a>
                  </div>
                <?}?>
            </div>
            <?php if($arResult['DETAIL_PICTURE']['SRC']):?>
            <div class="l-sale__pic" style="background-image: url('<?=$img['src'];?>')">
                <img src="<?=$img2['src'];?>" width="<?=$img2['width'];?>" height="<?=$img2['height'];?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">

                <?$this->SetViewTarget('META-IMAGE');?>
                    <meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['DETAIL_PICTURE']['SRC'];?>" />
                    <meta property="og:image:alt" content="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" />
                    <meta property="vk:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['DETAIL_PICTURE']['SRC'];?>" />
                    <meta property="vk:image:alt" content="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" />
                    <meta property="fb:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['DETAIL_PICTURE']['SRC'];?>" />
                    <meta property="fb:image:alt" content="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" />
                    <meta name="twitter:image" content="https://<?=$_SERVER['HTTP_HOST']?><?php echo $arResult['DETAIL_PICTURE']['SRC'];?>" />
                    <meta name="twitter:image:alt" content="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" />
                <?$this->EndViewTarget();?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if(!empty($arResult['PROPERTIES']['ADV']['VALUE'])):?>
    <div class="section section_default">
        <div class="wrapper wrapper_default">
            <div class="vklad-info">
                <div class="vklad-info__row">
                    <?php foreach ($arResult['PROPERTIES']['ADV']['VALUE'] as $num => $val):?>
                        <div class="vklad-info__item-wrapper">
                            <div class="vklad-info__item">
                                <div class="vklad-info__item-content">
                                    <?php if($arResult['PROPERTIES']['ADV']['DESCRIPTION'][$num]):?>
                                        <div class="vklad-info__icon-wrapper">
                                            <img class="vklad-info__icon" src="<?php echo $arResult['PROPERTIES']['ADV']['DESCRIPTION'][$num]; ?>" loading="lazy" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="vklad-info__title-wrapper">
                                        <span class="vklad-info__title"><?php echo $val; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?if ($arResult["PROPERTIES"]["PROLONGATION"]["VALUE"] == "Да" || true) {$vkladBTN = false;} else {$vkladBTN = true;}?>
<?php $vkladId = $arResult['ID']; ?>
<?php $vkladName = $arResult['NAME']; ?>
<?php $vkladType = $arResult['PROPERTIES']['FORMULA']['VALUE'];?>
<?include $_SERVER['DOCUMENT_ROOT']."/local/calcs/vklad.php"; ?>


<?if ($arResult['PROPERTIES']['TEXT']['VALUE']){

    foreach($arResult['PROPERTIES']['TEXT']['VALUE'] as $key => $Item){
        if (empty(preg_replace('/<!--(.|\s)*?-->/', '', htmlspecialchars_decode($arResult['PROPERTIES']['TEXT']['DESCRIPTION'][$key]))) &&
            empty(preg_replace('/<!--(.|\s)*?-->/', '', htmlspecialchars_decode($Item['TEXT'])))){
            unset($arResult['PROPERTIES']['TEXT']['VALUE'][$key]);
        }
    }

    if ($arResult['PROPERTIES']['TEXT']['VALUE']){?>
        <div class="section section_default">
            <?foreach($arResult['PROPERTIES']['TEXT']['VALUE'] as $key=> $Item){
                ?>
                <div class="wrapper wrapper_default">
                    <div class="box box_white box_default box-table">
                        <h3 class="h3 table-section__title section__title">
                            <?echo htmlspecialchars_decode($arResult['PROPERTIES']['TEXT']['DESCRIPTION'][$key]);?>
                        </h3>
                        <div class="table-wrapper table-wrapper__bottom">
                            <div class="content table_content">
                                <?echo htmlspecialchars_decode($Item['TEXT']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    <?}
}?>

<div class="section section_default vklad-info__block">
    <div class="wrapper wrapper_default">
        <div class="content">
            <div class="row">
                <div class="col col--lg-6 vklad-footer__left">
                    <?php echo $arResult['DETAIL_TEXT'];?>
                </div>
                <div class="col col--lg-6">
                    <?php foreach ($arResult['PROPERTIES']['DOCS']['VALUE'] as $num => $val):?>
                        <a href="<?php echo CFile::GetPath($val);?>" class="doc doc_offset">
                            <img class="doc__ico" src="/local/templates/main/images/document.svg" width="27" height="33" loading="lazy" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>">
                            <span class="doc__title title title_semi">
                                <?php echo $arResult['PROPERTIES']['DOCS']['DESCRIPTION'][$num];?>
                            </span>
                        </a>
                    <?php endforeach;?>
                    <div class="vklad-footer__right">
                        <div class="vklad-footer__title">
                            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/chastnym-litsam/vklady/vklad-detail-title.php"
                            )); ?>
                        </div>
                        <div class="vklad-footer__block">
                            <div class="row">
                                <div class="col--lg-3 col--sm-2">
                                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/chastnym-litsam/vklady/vklad-detail-picture.php"
                                    )); ?>
                                </div>
                                <div class="col--lg-9 col--sm-10">
                                    <div class="vklad-footer__text">
                                        <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "EDIT_TEMPLATE" => "",
                                            "PATH" => "/chastnym-litsam/vklady/vklad-detail-text.php"
                                        )); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



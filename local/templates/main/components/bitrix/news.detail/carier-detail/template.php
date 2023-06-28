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
$component->SetResultCacheKeys(array("ID", "NAME"));

$this->setFrameMode(true);
?>

<?
$zp = $arResult['PROPERTIES']['ZAP']['VALUE'];
$addr = $arResult['PROPERTIES']['ADDR']['VALUE'];
$zan = $arResult['PROPERTIES']['ZAN']['VALUE'];
$treb = $arResult['PROPERTIES']['TREB']['VALUE'];
$banner = $arResult['PROPERTIES']['BANNER']['VALUE'];
$exp = $arResult['PROPERTIES']['EXP']['VALUE'];



?>
<div class="section section_default">
    <div class="wrapper wrapper_default">
        <div class="page-header page-header_b-offset page-header_flex">
            <h1 class="page-title">
                <?=$arResult["NAME"];?>
            </h1>
        </div>
        <div class="content">

            <div class="box box_b-offset">
               <?if(empty($zp)){?>
                    <h4 class="h4">з/п не указана</h4>
                <?} else {?>
                    <h4 class="h4"><?php echo $zp; ?></h4>
                <?}?>
            </div>

            <div class="box box_b-offset">
                <a href="#vacancy-popup-<?php echo $arResult['ID']; ?>" class="kredit-nav__btn btn btn_default btn_blue inline-popup">
                    <span class="btn__title">Откликнуться</span>
                </a>

               <?if(!empty($addr)){?>
                <span class="vacancy-adress">
                    <img src="<?=SITE_TEMPLATE_PATH?>/images/pin.png" width="23" height="33" loading="lazy" alt="<?=$arResult["NAME"];?>. ООО КБ «ГТ банк»" class="vacancy-icon">
                    <span class="vacancy-adress__title"><?=$addr;?></span>
                </span>
                <?}?>
                <?if(!empty($exp)){?>
                <div class="vacancy-more vacancy-expirience">
                    Требуемый опыт работы:<?=$exp;?>
                </div>
                <?}?>
                <?if(!empty($zan)){?>
                <div class="vacancy-more vacancy-time">
                    Полная занятость, полный день
                </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
<div class="section section_default">
            <div class="wrapper wrapper_default">
                <div class="content">
                   <?foreach($treb as $key=> $item){?>
                    <div class="box box_b-offset">
                        <h4 class="h4"><?=$arResult['PROPERTIES']['TREB']['DESCRIPTION'][$key];?></h4>
                        <?=$arResult['PROPERTIES']['TREB']['~VALUE'][$key]["TEXT"];?>

                    </div>
                    <?}?>
                </div>
            </div>
        </div>

<?if(!empty($banner)){
    $pic = CFile::GetPath($banner);
?>
<div class="section section_default section_b-offset">
    <div class="wrapper wrapper_default">
        <a href="#" class="alone-img">
            <img src="<?=$pic;?>" loading="lazy" alt="<?=$arResult["NAME"];?>. ООО КБ «ГТ банк»">
        </a>
    </div>
</div>
<?}?>

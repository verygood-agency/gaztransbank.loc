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
use \Bas\Pict;
?>

<div class="section section_default">
    <div class="wrapper wrapper_default">
        <h1 class="page-title">
            <?=$arResult["NAME"]?>
        </h1>
        
        <div class="content">
            <?=$arResult["DETAIL_TEXT"];?>
        </div>
    </div>
</div>

<!--<div class="section section_default section_b-l-offset section_gray">-->
<!--    <div class="wrapper wrapper_default">-->
<!--       --><?// if(!empty($arResult['PROPERTIES']['BANER']['VALUE'])){
//
//       $img = CFile::GetPath($arResult['PROPERTIES']['BANER']['VALUE']);
//
//        ?>
<!--       --><?//if(empty($arResult['PROPERTIES']['BANER']['DESCRIPTION'])){?>
<!--        <div class="single-banner">-->
<!--            <picture>-->
<!--                <img src="--><?//=$img;?><!--" alt="">-->
<!--            </picture>-->
<!--        </div>-->
<!--        --><?//}else{?>
<!--        <a href="--><?//=$arResult['PROPERTIES']['BANER']['DESCRIPTION'];?><!--" class="single-banner">-->
<!--            <picture>-->
<!--                <img src="--><?//=$img;?><!--" alt="">-->
<!--            </picture>-->
<!--        </a>    -->
<!--        --><?//}?>
<!--        --><?//}?>
<!--    </div>-->
<!--</div>-->
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

<div class="row">
<?foreach($arResult["ITEMS"] as $arItem){?>
    <div class="col col--lg-4">
        <div class="box box_middle box_white simple-tile simple-tile_offset match-height">
            <h3 class="simple-tile__title simple-tile__title_m-offset blue h3"><?=$arItem['NAME'];?></h3>
            <div class="simple-tile__desc">
                <p>
                    <?=$arItem['PREVIEW_TEXT'];?>
                </p>
            </div>
        </div>
    </div>
<?}?>    
</div>
    

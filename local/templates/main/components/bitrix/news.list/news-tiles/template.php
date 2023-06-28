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

<div class="news">
    <div class="row">
       <?foreach($arResult["ITEMS"] as $arItem){
        if(!empty($arItem['DATE_ACTIVE_FROM'])){
            $date = FormatDate("d F Y",strtotime($arItem["DATE_ACTIVE_FROM"]));
        }else{
            $date = FormatDate("d F Y",strtotime($arItem["DATE_CREATE"]));
        }
        
        ?>
        <div class="col col--lg-4 col--md-6">
           <div class="news-tile news-tile_offset">
                <span class="date date_default news-tile__date light">
                    <?=$date;?>
                </span>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="news-tile__title light">
                    <?=$arItem['NAME'];?>
                </a>
                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="btn btn__medium btn_gray">
                    <span class="btn__title">Подробнее</span>
                </a>
            </div>            
        </div>
        <?}?>
    </div>
    <div class="row">
        <div class="col col--lg-12">
            <div class="pagination">
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
                    <?=$arResult["NAV_STRING"]?>
                <?endif;?>
            </div>
        </div>
    </div>
</div>


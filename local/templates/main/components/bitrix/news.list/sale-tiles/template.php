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

<div class="articles">
    <div class="row">
       <?foreach($arResult["ITEMS"] as $key => $arItem){
    if(!empty($arItem["PREVIEW_PICTURE"])){
        $img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array("width" => 412, "height" => 250), BX_RESIZE_IMAGE_EXACT ,true,false,false,75);
    }else{
        $img['src']= SITE_TEMPLATE_PATH.'/images/sale-no-photo.jpg';
    }?>
        <div class="col col--lg-4 col--md-6">
            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="article article_b-offset">
                <span class="article__img">
                    <img class="article__pic" src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" <?if($key <> 0){print ('loading="lazy"');}?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                </span>
                <span class="article__title">
                    <?=$arItem['NAME'];?>
                </span>
            </a>
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


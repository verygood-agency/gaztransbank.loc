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

if ($arResult["ITEMS"]) {
?>
  <div class="section section_default section_gray">
      <div class="wrapper wrapper_default">
          <div class="promotions">
              <div class="promotions__head">
                  <h2 class="promotions__title">
                      Акции
                  </h2>
                  <a class="promotions__link" href="<?=$arResult[ITEMS][0][LIST_PAGE_URL]?>">Все акции</a>
              </div>
              <div class="promotions__content">
                  <div class="promotions__items">
                      <?foreach($arResult["ITEMS"] as $arItem){
                          if(!empty($arItem["PREVIEW_PICTURE"])){
                              $img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array("width" => 720, "height" => 405), BX_RESIZE_IMAGE_EXACT ,true,false,false,75);
                              $WebPimg = Pict::getWebp($arItem["PREVIEW_PICTURE"]);
                          }else{
                              $img['src']= SITE_TEMPLATE_PATH.'/images/sale-no-photo.jpg';
                          }?>
                          <div class="promotions__item">
                              <div class="promotion">
                                  <div class="promotion__container">
                                      <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="promotion__picture">
                                          <div class="picture picture--ratio">
                                              <picture>
                                                  <source srcset="<?=$WebPimg['WEBP_SRC'];?>" type="image/webp">
                                                  <source srcset="<?=$img['src'];?>" type="image/jpg">
                                                  <img width="<?=$img['width'];?>" height="<?=$img['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                                              </picture>
                                          </div>
                                      </a>
                                      <div class="promotion__text">
                                          <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="promotion__title"><?=$arItem['NAME'];?></a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      <?}?>
                  </div>
              </div>
          </div>
      </div>
  </div>
<?}?>
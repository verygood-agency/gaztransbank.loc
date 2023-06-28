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
use Bitrix\Main\Security\Random;

$templateId = "slider-". Random::getString(12);
?>
<div id="<?=$templateId?>" class="first-screen">
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <?foreach ($arResult["ITEMS"] as $keySlider => $arSlider) {?>
        <div class="swiper-slide">
          <?if ($arSlider["PREVIEW_PICTURE"]) {?>
            <div class="first-screen__picture">
              <div class="picture">
                <picture>
                  <?foreach ($arSlider["PREVIEW_PICTURE"]["SOURCES"] as $arSource) {?>
                    <source
                        srcset="<?= $arSource['SRCSET'] ?>"
                        sizes="100vw"
                        type="<?= $arSource['TYPE'] ?>"
                    />
                  <?}?>
                  <img
                      alt="<?=$arSlider["PREVIEW_PICTURE"]["ALT"];?>"
                      src="<?= $arSlider["PREVIEW_PICTURE"]['SRC'] ?>"
                      width="<?= $arSlider["PREVIEW_PICTURE"]['WIDTH'] ?>"
                      height="<?= $arSlider["PREVIEW_PICTURE"]['HEIGHT'] ?>"
                  >
                </picture>
              </div>
            </div>
          <?}?>
          <div class="first-screen__container">
            <div class="wrapper wrapper_default">
              <div class="first-screen__content">
                <div class="first-screen__title <?if ($arSlider["PROPERTIES"]["COLOR"]["VALUE"] == "Чёрный") {?>first-screen__color-black<?}?>">
                  <h1><?=htmlspecialchars_decode($arSlider["NAME"])?></h1>
                </div>
                <div class="first-screen__description <?if ($arSlider["PROPERTIES"]["COLOR"]["VALUE"] == "Чёрный") {?>first-screen__color-black<?}?>">
                  <?=$arSlider["PREVIEW_TEXT"]?>
                </div>
                <?if ($arSlider["PROPERTIES"]["LINK"]["VALUE"] && $arSlider["PROPERTIES"]["LINK"]["DESCRIPTION"]) {?>
                  <div class="first-screen__btn">
                    <a href="<?=$arSlider["PROPERTIES"]["LINK"]["VALUE"]?>" class="btn btn_box btn_red"><?=$arSlider["PROPERTIES"]["LINK"]["DESCRIPTION"]?></a>
                  </div>
                <?}?>
              </div>
            </div>
          </div>
        </div>
      <?}?>
    </div>
    <?if (count($arResult["ITEMS"]) > 1) {?>
    <div class="first-screen__navigation-wrapper">
      <div class="first-screen__navigation">
        <button class="first-screen__nav first-screen__nav--prev">
          <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 1L2 6L7 11" stroke="inherit" stroke-width="2" stroke-linecap="round" />
          </svg>
        </button>
        <div class="first-screen__pagination"></div>
        <button class="first-screen__nav first-screen__nav--next">
          <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1 11L6 6L1 1" stroke="inherit" stroke-width="2" stroke-linecap="round" />
          </svg>
        </button>
      </div>
    </div>
    <?}?>
  </div>
  <?if (count($arResult["ITEMS"]) > 1) {?>
    <script>
      (function(window) {
        window.addEventListener('DOMContentLoaded', function() {
          var root = document.getElementById('<?=$templateId?>'),
            Swiper = window.Swiper,
            classNames = {
              disabledSlide: 'first-screen__nav--disabled',
              hiddenSlide: 'first-screen__nav--hidden',
              lockSlide: 'first-screen__nav--lock',
              duplicateSlide: 'swiper-slide-duplicate',
              bulletClass: 'first-screen__bullet',
              bulletActiveClass: 'first-screen__bullet--active',
            },
            selectors = {
              swiperContainer: '.swiper-container',
              prevBtn: '.first-screen__nav--prev',
              nextBtn: '.first-screen__nav--next',
              pagination: '.first-screen__pagination',
            };

          if (!root || !Swiper) {
            return;
          }

          var swiperContainerEl = root.querySelector(selectors.swiperContainer);
          if (!swiperContainerEl) {
            return;
          }

          var prevBtn = root.querySelector(selectors.prevBtn),
            nextBtn = root.querySelector(selectors.nextBtn),
            paginationEl = root.querySelector(selectors.pagination);

          new Swiper(swiperContainerEl, {
            direction: 'horizontal',
            loop: true,
            slidesPerView: 1,
            autoplay: {
              delay: 5000,
            },
            lazy: {
              loadPrevNext: true,
            },
            navigation: {
              prevEl: prevBtn,
              nextEl: nextBtn,
              disabledClass: classNames.disabledSlide,
              hiddenClass: classNames.hiddenSlide,
              lockClass: classNames.lockSlide
            },
            pagination: {
              el: paginationEl,
              bulletClass: classNames.bulletClass,
              bulletActiveClass: classNames.bulletActiveClass,
              clickable: true,
              type: 'bullets'
            }
          });
        });
      })(window);
    </script>
  <?}?>
</div>
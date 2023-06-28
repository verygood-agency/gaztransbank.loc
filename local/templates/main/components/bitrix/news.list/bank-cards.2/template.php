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


$component->SetResultCacheKeys(array("ITEMS"));
$this->setFrameMode(true);
?>
<div class="cards">
  <div class="cards__container">
    <div class="wrapper wrapper_default">
      <ul class="cards__items">
        <?foreach ($arResult["ITEMS"] as $keyItem => $arItem) {?>
          <?if ($arItem['PROPERTIES']['ARCHIVE']['VALUE'] == "Да") {continue;}?>
          <li class="cards__item">
            <div class="card">
              <div class="card__container">
                <?
                if ($arItem["PREVIEW_PICTURE"]) {
                  $img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>715, 'height'=>450), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
                  ?>
                  <div class="card__picture">
                    <div class="picture">
                      <picture>
                        <source srcset="<?=$img['src'];?>" type="image/png">
                        <img src="<?=$img['src'];?>" <?if($keyItem <> 0){echo('loading="lazy"');}?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                      </picture>
                    </div>
                  </div>
                <?}?>
                <div class="card__content">
                  <div class="card__title"><?=$arItem['NAME'];?></div>
                  <div class="card__description"><?=$arItem['PREVIEW_TEXT'];?></div>
                  <div class="card__properties">
                    <ul class="card__properties-items">
                      <?foreach($arItem['PROPERTIES']['ADVANTAGE']['VALUE'] as $keyAdvantage => $advantage) {?>
                        <li class="card__properties-item">
                          <div class="card__properties-item-label"><?=$advantage?></div>
                          <div class="card__properties-item-value"><?=$arItem['PROPERTIES']['ADVANTAGE']['DESCRIPTION'][$keyAdvantage]?></div>
                        </li>
                      <?}?>
                    </ul>
                  </div>
                  <div class="card__buttons">
                    <ul class="card__buttons-items">
                      <li class="card__buttons-item"><a class="button button--contained button--color-primary button--size-m inline-t-popup" href="#product-open-card-issue-<?=$arItem['ID']; ?>" data-title="<?=$arItem['NAME']; ?> - оставить заявку"><span class="button-content">Оформить карту</span></a></li>
                      <li class="card__buttons-item"><a class="button button--outlined button--color-primary button--size-m" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span class="button-content">Подробнее</span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <?if ($arItem['PROPERTIES']['TYPE']['VALUE'] == "Кредитная") {
            echo view('forms.product', ['id' => 'card-issue-'. $arItem['ID'], 'name' => $arItem['NAME'], 'type' => 'card-credit']);
          } else {
            echo view('forms.product', ['id' => 'card-issue-'. $arItem['ID'], 'name' => $arItem['NAME'], 'type' => 'card-debet']);
          }?>
        <?}?>
      </ul>
    </div>
  </div>
</div>
<div class="accordion-section">
  <div class="accordion-section__container">
    <div class="wrapper wrapper_default">
      <div class="accordion-section__summary" tabindex="0" role="button" aria-expanded="false" aria-controls="id-0005154902436270703-content">
        <div id="id-0005154902436270703-summary" class="accordion-section__summary-content">Архивные карты</div>
        <div class="accordion-section__summary-expand" data-hide-text="Скрыть" data-show-text="Показать">
          <div class="accordion-section__summary-expand-text">Показать</div>
          <div class="accordion-section__summary-expand-icon"></div>
        </div>
      </div>
      <div class="collapse collapse--hidden">
        <div class="collapse__wrapper">
          <div class="collapse__wrapper-inner">
            <div id="id-0005154902436270703-content" class="accordion-section__region" aria-labelledby="id-0005154902436270703-summary" role="region">
              <div class="accordion-section__details">
                <div class="links">
                  <ul>
                    <?foreach ($arResult["ITEMS"] as $arItem) {?>
                      <?if ($arItem['PROPERTIES']['ARCHIVE']['VALUE'] != "Да") {continue;}?>
                      <li><a><?=$arItem['NAME'];?></a></li>
                    <?}?>
                  </ul>
                </div>
                <div class="text">
                  <?
                  $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "text1.php"
                  ));
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
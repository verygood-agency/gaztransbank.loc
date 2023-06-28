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
$component->SetResultCacheKeys(array("ITEMS"));

$this->setFrameMode(true);

use Local\helpers\Component;
use Local\helpers\JavaScript;

$sTemplateId = Component::getComponentUniqueId($this);
?>
<div class="row">
  <?foreach($arResult["ITEMS"]["DEPOSITS"] as $arItem){
      $sOpenDepositBtnId = $sTemplateId . '_btn_' . $arItem['ID'];
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

      $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>197, 'height'=>340), BX_RESIZE_IMAGE_EXACT, true,false,false,85);
      ?>
      <div class="col col--lg-6">
          <div class="deposit-tile deposit-tile_b-offset"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
              <?if ($arItem["PREVIEW_PICTURE"]) {?>
                <div class="deposit-tile__img">
                    <img src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                </div>
              <?}?>
              <div class="deposit-tile__content">
                  <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="deposit-tile__title">
                      <?=$arItem['NAME'];?>
                  </a>
                  <?if(!empty($arItem['PREVIEW_TEXT'])){?>
                  <div class="deposit-tile__desc">
                      <p><?=$arItem['PREVIEW_TEXT'];?></p>
                  </div>
                  <?}?>
                  <div class="deposit-infos deposit-infos_b-offset">
                     <?if(!empty($arItem['PROPERTIES']['STAVKA']['VALUE'])){?>
                      <div class="deposit-info__item">
                          <span class="deposit-info__title">
                              Ставка
                          </span>
                          <span class="deposit-info__desc">
                              <?=$arItem['PROPERTIES']['STAVKA']['VALUE'];?>
                          </span>
                      </div>
                      <?}?>
                      <?if(!empty($arItem['PROPERTIES']['MIN']['VALUE'])){?>
                      <div class="deposit-info__item">
                          <span class="deposit-info__title">
                              Минимальная сумма
                          </span>
                          <span class="deposit-info__desc">
                              <?=$arItem['PROPERTIES']['MIN']['VALUE'];?>
                          </span>
                      </div>
                      <?}?>
                      <?if(!empty($arItem['PROPERTIES']['SROC']['VALUE'])){?>
                      <div class="deposit-info__item">
                          <span class="deposit-info__title">
                              Срок вклада
                          </span>
                          <span class="deposit-info__desc">
                              <?=$arItem['PROPERTIES']['SROC']['VALUE'];?>
                          </span>
                      </div>
                      <?}?>
                  </div>
                  <div class="item-options">
                      <?if(!empty($arItem['PROPERTIES']['POPOLNENIE']['VALUE'])){?>
                          <span class="item-option iconed iconed_center">
                              <i class="item-option__ico success"></i>
                              <span class="item-option__title">Пополнение</span>
                          </span>
                      <?}else{?>
                              <span class="item-option iconed iconed_center">
                                  <i class="item-option__ico remove"></i>
                                  <span class="item-option__title">Пополнение</span>
                              </span>
                      <?}?>

                      <?if(!empty($arItem['PROPERTIES']['SNYATIE']['VALUE'])){?>
                          <span class="item-option iconed iconed_center">
                              <i class="item-option__ico success"></i>
                              <span class="item-option__title">Частичное снятие</span>
                          </span>
                      <?}else{?>
                          <span class="item-option iconed iconed_center">
                              <i class="item-option__ico remove"></i>
                              <span class="item-option__title">Частичное снятие</span>
                          </span>
                      <?}?>

                  </div>

                  <div class="deposit-tile__nav">
<!--                      <a id="--><?//= $sOpenDepositBtnId; ?><!--" href="javascript:void(0);" class="deposit-tile__btn btn btn_default btn-bordered_red">-->
<!--                          Открыть вклад-->
<!--                      </a>-->
                      <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="link link_blue link_decorated">
                          Подробнее
                      </a>
                  </div>
                  <script>
                      (function (window) {
                          var Modal = window.Modal,
                              BX = window.BX,
                              btn = document.getElementById('<?= $sOpenDepositBtnId; ?>');

                          if (!btn || !Modal || !(BX && BX.ajax)) {
                              return;
                          }

                          var data = {};
                          data['ID'] = '<?=$arItem["ID"];?>';
                          data['NAME'] = '<?=$arItem["NAME"];?>';

                          var modal = new Modal({
                              preloaderColor: '#B9120C',
                              effect: 'modal-fade',
                              contentEffect: 'modal-zoom-out',
                              content: function () {
                                  var m = this;
                                  m._isAsyncContent = true;
                                  BX.ajax({
                                      url: <?= JavaScript::toObject($this->GetFolder() . '/parts/modal.php'); ?>,
                                      method: 'POST',
                                      data: data,
                                      onsuccess(res) {
                                          m.setContent(res);
                                      },
                                      onfailure(e) {
                                          m.setContent(e, true);
                                      },
                                  });

                                  return false;
                              }
                          });

                          btn.addEventListener('click', function () {
                              modal.show();
                          });
                      })(window);
                  </script>
              </div>
          </div>
      </div>
  <?}?>
</div>
<?if ($arResult["ITEMS"]["PROLONGATION"]) {?>
  <h3 class="h3 table-section__title section__title">Вклады, доступные только для пролонгации</h3>
  <div class="row">
    <?foreach($arResult["ITEMS"]["PROLONGATION"] as $arItem){
      $sOpenDepositBtnId = $sTemplateId . '_btn_' . $arItem['ID'];
      $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
      $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

      $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>197, 'height'=>340), BX_RESIZE_IMAGE_EXACT, true,false,false,85);
      ?>
      <div class="col col--lg-6">
        <div class="deposit-tile deposit-tile_b-offset"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
          <?if ($arItem["PREVIEW_PICTURE"]) {?>
            <div class="deposit-tile__img">
              <img src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="<?=$img['height'];?>" loading="lazy" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
            </div>
          <?}?>
          <div class="deposit-tile__content">
            <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="deposit-tile__title">
              <?=$arItem['NAME'];?>
            </a>
            <?if(!empty($arItem['PREVIEW_TEXT'])){?>
              <div class="deposit-tile__desc">
                <p><?=$arItem['PREVIEW_TEXT'];?></p>
              </div>
            <?}?>
            <div class="deposit-infos deposit-infos_b-offset">
              <?if(!empty($arItem['PROPERTIES']['STAVKA']['VALUE'])){?>
                <div class="deposit-info__item">
                          <span class="deposit-info__title">
                              Ставка
                          </span>
                  <span class="deposit-info__desc">
                              <?=$arItem['PROPERTIES']['STAVKA']['VALUE'];?>
                          </span>
                </div>
              <?}?>
              <?if(!empty($arItem['PROPERTIES']['MIN']['VALUE'])){?>
                <div class="deposit-info__item">
                          <span class="deposit-info__title">
                              Минимальная сумма
                          </span>
                  <span class="deposit-info__desc">
                              <?=$arItem['PROPERTIES']['MIN']['VALUE'];?>
                          </span>
                </div>
              <?}?>
              <?if(!empty($arItem['PROPERTIES']['SROC']['VALUE'])){?>
                <div class="deposit-info__item">
                          <span class="deposit-info__title">
                              Срок вклада
                          </span>
                  <span class="deposit-info__desc">
                              <?=$arItem['PROPERTIES']['SROC']['VALUE'];?>
                          </span>
                </div>
              <?}?>
            </div>
            <div class="item-options">
              <?if(!empty($arItem['PROPERTIES']['POPOLNENIE']['VALUE'])){?>
                <span class="item-option iconed iconed_center">
                              <i class="item-option__ico success"></i>
                              <span class="item-option__title">Пополнение</span>
                          </span>
              <?}else{?>
                <span class="item-option iconed iconed_center">
                                  <i class="item-option__ico remove"></i>
                                  <span class="item-option__title">Пополнение</span>
                              </span>
              <?}?>

              <?if(!empty($arItem['PROPERTIES']['SNYATIE']['VALUE'])){?>
                <span class="item-option iconed iconed_center">
                              <i class="item-option__ico success"></i>
                              <span class="item-option__title">Частичное снятие</span>
                          </span>
              <?}else{?>
                <span class="item-option iconed iconed_center">
                              <i class="item-option__ico remove"></i>
                              <span class="item-option__title">Частичное снятие</span>
                          </span>
              <?}?>

            </div>

            <div class="deposit-tile__nav">
              <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="link link_blue link_decorated">
                Подробнее
              </a>
            </div>
          </div>
        </div>
      </div>
    <?}?>
  </div>
<?}?>
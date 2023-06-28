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
<div class="section section_default section_b-middle section_gray">
    <div class="wrapper wrapper_default">
        <div class="card-list">
            <?php foreach ($arResult["ITEMS"] as $key => $arItem): ?>
                <?php
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'],
                    CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                    array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                $img=CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array('width'=>715, 'height'=>450), BX_RESIZE_IMAGE_EXACT, true,false,false,65);
                ?>

                <div class="card-item">
                    <div class="card-item__img">
                        <img class="card-item__pic" src="<?=$img['src'];?>" width="<?=$img['width'];?>" height="100%" <?if($key <> 0){print ('loading="lazy"');}?> alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                    </div>
                    <div class="card-item__content">
                        <h3 class="h3 card-item__title">
                            <?php echo $arItem['NAME']; ?>
                        </h3>

                        <?foreach($arItem['PROPERTIES']['ADVANTAGE']['VALUE'] as $key => $Item){?>
                            <div class="card-item__section card-item__section_offset">
                                <h4 class="h4 card-item__sub">
                                    <?echo ($arItem['PROPERTIES']['ADVANTAGE']['VALUE'][$key]);?>
                                </h4>
                                <div class="card-item__desc">
                                    <p>
                                        <?echo($arItem['PROPERTIES']['ADVANTAGE']['DESCRIPTION'][$key]);?>
                                    </p>
                                </div>
                            </div>
                        <?}?>

                        <div class="card-item__section card-item__section_offset">
                            <div class="kredit-nav">
                                <?if ($arItem['PROPERTIES']['ARCHIVE']['VALUE'] != "Да") {?>
                                  <a href="#product-open-card-issue-<?php echo $arItem['ID']; ?>" data-title="<?php echo $arItem['NAME']; ?> - оставить заявку" class="kredit-nav__btn inline-t-popup btn btn_default btn_blue">
                                      <span class="btn__title">
                                          Заказать карту
                                      </span>
                                  </a>
                                <?}?>
                                <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="link link_blue link_decorated kredit-nav__link">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?if ($arItem['PROPERTIES']['TYPE']['VALUE'] == "Кредитная") {
                    echo view('forms.product', ['id' => 'card-issue-'. $arItem['ID'], 'name' => $arItem['NAME'], 'type' => 'card-credit']);
                } else {
                    echo view('forms.product', ['id' => 'card-issue-'. $arItem['ID'], 'name' => $arItem['NAME'], 'type' => 'card-debet']);
                }?>
            <?php endforeach;?>
        </div>
    </div>
</div>
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
<div class="" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
<?foreach($arResult["ITEMS"] as $arItem){?>
  <?foreach($arItem['PROPERTIES']['FILE']['VALUE'] as $key=> $item){
    $fileUrl = CFile::GetPath($arItem['PROPERTIES']['FILE']['VALUE'][$key]);
    ?>
    <a href="<?=$fileUrl;?>" class="doc-iconed garanty__doc-iconed blue iconed iconed_start">
        <span class="doc-iconed__ico iconed__ico">
            <img class="sertificat-ico" src="<?=SITE_TEMPLATE_PATH?>/images/sertificat-ico.svg" width="17" height="25.813" loading="lazy" alt="ООО КБ «ГТ банк»">
        </span>
        <span class="doc-iconed__desc">
            <?=$arItem['PROPERTIES']['FILE']['DESCRIPTION'][$key];?>
        </span>
    </a>
  <?}?>
  <?foreach($arItem['PROPERTIES']['SRC']['VALUE'] as $key => $itemSRC){
    ?>
    <a href="<?=$itemSRC;?>" target="_blank" class="doc-iconed garanty__doc-iconed blue iconed iconed_start">
      <span class="doc-iconed__ico iconed__ico">
          <img class="sertificat-ico" src="<?=SITE_TEMPLATE_PATH?>/images/sertificat-ico.svg" width="17" height="25.813" loading="lazy" alt="ООО КБ «ГТ банк»">
      </span>
      <span class="doc-iconed__desc">
          <?echo($arItem['PROPERTIES']['SRC']['DESCRIPTION'][$key]);?>
      </span>
    </a>
  <?}?>
<?}?>
</div>

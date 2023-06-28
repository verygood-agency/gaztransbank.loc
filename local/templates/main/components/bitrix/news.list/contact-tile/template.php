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

<?foreach($arResult["ITEMS"] as $i=> $arItem){?>
<?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        $city = $arItem['PROPERTIES']['CITY']['VALUE'];
    
?>

<div class="contact-item match-height" <?=$this->GetEditAreaId($arItem['ID']);?>>
    <h6 class="contact__title">
        <?=$city;?>
    </h6>
    <div class="contact-lines">
        <?if($i != 0){?>
        <?if(!empty($arItem['PREVIEW_TEXT'])){?>
        <div class="contact-line preview">
            <?=$arItem['PREVIEW_TEXT'];?>
        </div>
        <?}?>
        <?}?>

        <?foreach($arItem['PROPERTIES']['INFO']['VALUE'] as $key=> $line){?>
        <span class="contact-line">
            <span class="contact-line__title">
                <?=$arItem['PROPERTIES']['INFO']['VALUE'][$key];?>
            </span>
            <?
if(preg_match("([0-9-]+)", $arItem['PROPERTIES']['INFO']['DESCRIPTION'][$key])==1){
                    
                        $phoneNumb = str_replace(array(' ', '(' , ')', '-'), '', $arItem['PROPERTIES']['INFO']['DESCRIPTION'][$key]);
                        $phoneNumb = trim($phoneNumb);
                        $phoneNumb = 'tel:'.$phoneNumb;
                    
}else{
    $phoneNumb = 'mailto:'.$arItem['PROPERTIES']['INFO']['DESCRIPTION'][$key];
}
                    ?>
            <a href="<?=$phoneNumb;?>" class="contact-line__desc">
                <?=$arItem['PROPERTIES']['INFO']['DESCRIPTION'][$key];?>
            </a>
        </span>
        <?}?>
        <?if($i == 0){?>
        <?if(!empty($arItem['PREVIEW_TEXT'])){?>
        <div class="contact-line preview">
            <?=$arItem['PREVIEW_TEXT'];?>
        </div>
        <?}}?>

        <?
                    if($arItem['PROPERTIES']['TIME']['VALUE']){
                 ?>
        <div class="contact-lines">
            
            <span class="contact-line times-lines">
                <span class="contact-line__title">
                    Режим работы:</span>
                    <div class="times">
                    <?
                        foreach($arItem['PROPERTIES']['TIME']['VALUE'] as $key=> $line){
                    ?>
                    <span class="contact-line__desc"><?=$arItem['PROPERTIES']['TIME']['VALUE'][$key]?></span>
                    <?}?>
                    </div>
               </div> 
           
        
        <?}?>


    </div>
</div>

<?}?>

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

<?foreach($arResult["ITEMS"] as $arItem){
    $rekvisits = $arItem['PROPERTIES']['REKVISITS'];
    
?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
   
   <? if(!empty($arItem['PROPERTIES']['REKVISITS']['DESCRIPTION'])){?>
   
   
    <div class="box box_white rekv-box box_default" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="lr-table">
           <?foreach($arItem['PROPERTIES']['REKVISITS']['DESCRIPTION'] as $key=> $item){?>

            <div class="lr-table__row">
                <div class="lr-table__col lr-table__left">
                    <span class="title title_semi">
                        <?=$arItem['PROPERTIES']['REKVISITS']['DESCRIPTION'][$key];?>
                    </span>
                </div>
                <div class="lr-table__col lr-table__right">
                   <?=htmlspecialchars_decode($arItem['PROPERTIES']['REKVISITS']['VALUE'][$key]['TEXT']);?>
                </div>
            </div>
            <?}?>
        </div>
    </div>
    
    <?}?>
    
    <? if(!empty($arItem['PROPERTIES']['PAY_REKVISITS']['DESCRIPTION'])){?>
    
    <div class="section section_default">
         <h3 class="h3 section__title">Платежные реквизиты</h3>
        <div class="box box_white rekv-box box_default" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="lr-table">
               <?foreach($arItem['PROPERTIES']['PAY_REKVISITS']['DESCRIPTION'] as $key=> $item){?>

                <div class="lr-table__row">
                    <div class="lr-table__col lr-table__left">
                        <span class="title title_semi">
                            <?=$arItem['PROPERTIES']['PAY_REKVISITS']['DESCRIPTION'][$key];?>
                        </span>
                    </div>
                    <div class="lr-table__col lr-table__right">
                       <?=htmlspecialchars_decode($arItem['PROPERTIES']['PAY_REKVISITS']['VALUE'][$key]['TEXT']);?>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
    <?}?>
    
    
    <?}?>
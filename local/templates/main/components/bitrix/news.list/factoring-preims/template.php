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
<div class="faq-w">
<?foreach($arResult["ITEMS"] as $arItem){
    
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
       <div class="toggle-w toggle-w_b-offset toggle-w_light">
            <div class="toggle-w__header">
                <span class="toggle-w__title h4 title title_light">
                    <?=$arItem['NAME'];?>
                </span>
                <i class="toggle-w__arrow"></i>
            </div>
            <div class="toggle-w__content">
                <table class="table table_light tarif-table table_large">
                    <tbody>
                       <?foreach($arItem['PROPERTIES']['LINE']['VALUE'] as $key=> $item){?>
                        <tr>
                            <td>
                                <div class="tarif-table__title tarif-table__title_middle">
                                    <?=$arItem['PROPERTIES']['LINE']['VALUE'][$key];?>
                                </div>
                            </td>
                            <td>
                                <div class="tarif-table__title">
                                    <?=$arItem['PROPERTIES']['LINE']['DESCRIPTION'][$key];?>
                                </div>
                            </td>
                        </tr>
                        <?}?>
                    </tbody>
                </table>
            </div>
       </div>
<?}?>
</div>    
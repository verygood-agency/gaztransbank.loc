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
<?if ($arResult["SECTION"]["PATH"]["0"]["CODE"]):?>
    <?if($arResult["SECTION_PP"]["UF_TYPE"] == "14"):
        //Вид: текст под номером (не используется. верстка не адаптирована под мобильную версию)
        ?>
        <div class="section section_default">
            <div class="wrapper wrapper_default">
                <h2 class="h2 section__title section__title__offset"><?=$arResult["SECTION_PP"]["UF_NAME"]?></h2>
                <div class="b-steps b-steps_top">
                    <?foreach($arResult["ITEMS"] as $key=> $arItem){
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <div class="b-step step-block  <?if(count($arResult["ITEMS"]) != $key+1):?>b-step_arrow<?endif;?>">
                            <?if(count($arResult["ITEMS"]) != $key+1):?>
                                <div class="arrow-r b-step__arrow-r"></div>
                            <?endif;?>
                            <span class="b-step__numb">
                                <?echo $key+1;?>
                            </span>
                            <div class="b-step__content">
                                <span class="b-step__desc">
                                    <?echo $arItem['NAME'];?>
                                </span>
                            </div>
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
    <?elseif($arResult["SECTION_PP"]["UF_TYPE"] == "15"):
        //Вид: текст под стрелкой
        ?>
        <div class="section ">
            <div class="wrapper wrapper_default">
                <h2 class="h2 section__title section__title_m-offset"><?=$arResult["SECTION_PP"]["UF_NAME"]?></h2>
                <div class="b-steps-wr">
                    <div class="b-steps b-steps_wrap">
                        <?foreach($arResult["ITEMS"] as $key=> $arItem){
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="b-step <? if($key == (sizeof($arResult["ITEMS"])-1 )){?>b-step_active<?}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <span class="b-step__numb">
                                    <?=$key+1;?>
                                </span>
                                <div class="b-step__content">
                                    <div class="arrow-r b-step__arrow-r"></div>
                                    <span class="b-step__title">
                                        <?=$arItem['NAME'];?>
                                    </span>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    <?else:
        //Вид: текст справа от номера
        ?>
        <div class="section section_default section_gray section_last">
            <div class="wrapper wrapper_default">
                <div class="issue-card">
                    <div class="issue-card__container">
                        <div class="issue-card__title"><?=$arResult["SECTION_PP"]["UF_NAME"]?></div>
                        <div class="issue-card__items-wrapper issue-card__items">
                            <?foreach($arResult["ITEMS"] as $key=> $arItem){
                                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                                ?>
                                <div class="issue-card__item">
                                    <div class="issue-card-item">
                                        <div class="issue-card-item__container">
                                            <div class="issue-card-item__num"><?echo $key+1;?></div>
                                            <div class="issue-card-item__text-wrapper">
                                                <div class="issue-card-item__text">
                                                    <?if ($arItem['NAME']):?>
                                                        <div class="issue-card-item__title"><?= $arItem['NAME'];?></div>
                                                    <?endif;?>
                                                    <?if ($arItem['PREVIEW_TEXT']):?>
                                                        <div class="issue-card-item__description"><?= $arItem['PREVIEW_TEXT'];?></div>
                                                    <?endif;?>
                                                </div>
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
    <?endif;?>
<?endif;?>
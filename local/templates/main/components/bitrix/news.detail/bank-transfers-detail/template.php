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
$this->setFrameMode(true);
?>

<?
$zp = $arResult['PROPERTIES']['ZAP']['VALUE'];
$addr = $arResult['PROPERTIES']['ADDR']['VALUE'];
$zan = $arResult['PROPERTIES']['ZAN']['VALUE'];
$treb = $arResult['PROPERTIES']['TREB']['VALUE'];
$banner = $arResult['PROPERTIES']['BANNER']['VALUE'];
$exp = $arResult['PROPERTIES']['EXP']['VALUE'];


?>
<div class="section section_default">
    <div class="wrapper wrapper_default">
        <h1 class="page-title">
            <?php echo $arResult['NAME'];?>
        </h1>

        <div class="translate-block">
            <div class="translate-block__left">
                <div class="block__left-logo">
                    <img src="<?php echo $arResult['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>">
                </div>
                <div class="block__left-content">
                    <div class="left-block__title">
                        <?php echo $arResult['PROPERTIES']['FIRST_BLOCK_TITLE']['VALUE']; ?>
                    </div>
                    <div class="left-block__text">
                        <?php echo $arResult['PROPERTIES']['FIRST_BLOCK_TEXT']['VALUE']; ?>
                    </div>
                </div>
<!--                <div class="block__left__photo">-->
<!--                    <img src="/local/templates/main/images/globus.png" alt="--><?//=$arResult["PREVIEW_PICTURE"]["ALT"]?><!--" title="--><?//=$arResult["PREVIEW_PICTURE"]["TITLE"]?><!--">-->
<!--                </div>-->
            </div>
            <div class="translate-block__right">
                <div class="block__right-title">
                    <?php echo $arResult['PROPERTIES']['SECOND_BLOCK_TITLE']['VALUE']; ?>
                </div>
                <div class="block__right-text">
                    <?php echo $arResult['PROPERTIES']['SECOND_BLOCK_TEXT']['VALUE']; ?>
                </div>
                <?php if($arResult['PROPERTIES']['SECOND_BLOCK_LINK']['VALUE']):?>
                    <a href="<?php echo $arResult['PROPERTIES']['SECOND_BLOCK_LINK']['VALUE']; ?>" class="btn btn_red btn_default">
                        Онлайн перевод
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if($arResult['PREVIEW_TEXT']):?>
    <div class="section section_default">
        <div class="wrapper wrapper_default">
            <div class="content mb">
                <h2 class="h2 section__title section__title__offset">Как отправить</h2>
                <?php echo htmlspecialchars_decode($arResult['PREVIEW_TEXT']);?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty($arResult['PROPERTIES']['HOW_TO_GET']['VALUE'])):?>
    <section class="section section_default section_gray">
        <div class="wrapper wrapper_default">
            <div class="issue-card">
                <div class="issue-card__container">
                    <div class="issue-card__title">Как получить</div>
                    <div class="issue-card__items-wrapper issue-card__items">
                        <?foreach($arResult['PROPERTIES']['HOW_TO_GET']['VALUE'] as $key=> $Item){?>
                            <div class="issue-card__item">
                                <div class="issue-card-item">
                                    <div class="issue-card-item__container">
                                        <div class="issue-card-item__num"><?echo ($key+1)?></div>
                                        <div class="issue-card-item__text-wrapper">
                                            <div class="issue-card-item__text">
                                                <?if ($arResult['PROPERTIES']['HOW_TO_GET']['VALUE'][$key]):?>
                                                    <div class="issue-card-item__title"><?echo ($arResult['PROPERTIES']['HOW_TO_GET']['VALUE'][$key]);?></div>
                                                <?endif;?>
                                                <?if ($arResult['PROPERTIES']['HOW_TO_GET']['DESCRIPTION'][$key]):?>
                                                    <div class="issue-card-item__description"><?echo($arResult['PROPERTIES']['HOW_TO_GET']['DESCRIPTION'][$key]);?></div>
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
    </section>
<?php endif; ?>

<?php if($arResult['DETAIL_TEXT']):?>
    <div class="section section_default">
        <div class="wrapper wrapper_default">
            <div class="content">
                <h2 class="h2 section__title section__title__offset"><?echo ($arResult['PROPERTIES']['DETAIL_HEADER']['VALUE']);?></h2>
                <?php echo htmlspecialchars_decode($arResult['DETAIL_TEXT']);?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if(!empty($arResult['PROPERTIES']['TABLES']['VALUE'])):?>
<div class="section section_default">
    <div class="wrapper wrapper_default">
        <div class="faq-w">

            <?php foreach ($arResult['PROPERTIES']['TABLES']['VALUE'] as $num => $html):?>
                <div class="toggle-w toggle-w_b-offset toggle-w_light">
                    <div class="toggle-w__header">
                        <span class="toggle-w__title h4 title title_light">
                            <?php echo $arResult['PROPERTIES']['TABLES']['DESCRIPTION'][$num];?>
                        </span>
                        <i class="toggle-w__arrow"></i>
                    </div>
                    <div class="toggle-w__content">
                        <?php echo htmlspecialchars_decode($html['TEXT']);?>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>

</div>
<?php endif; ?>


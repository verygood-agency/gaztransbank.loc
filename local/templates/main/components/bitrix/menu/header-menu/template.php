<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <nav itemscope itemtype="http://schema.org/SiteNavigationElement" class="nav header__sections">
        <meta itemprop="name" content="Главное меню">
        <?
        foreach($arResult as $arItem):
            if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
        ?>
            <?if($arItem["SELECTED"]):?>
                <a itemprop="url" href="<?=$arItem["LINK"]?>" class="header__section active"><span itemprop="name"><?=$arItem["TEXT"]?></span></a>
            <?else:?>
                <a itemprop="url" href="<?=$arItem["LINK"]?>" class="header__section"><span itemprop="name"><?=$arItem["TEXT"]?></span></a>
            <?endif?>
        <?endforeach?>
    </nav>
<?endif?>
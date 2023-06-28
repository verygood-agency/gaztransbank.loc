<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php

$elements = [];
$lastFirstLevelItem = 0;

foreach($arResult as $i => $arItem){
    
    if ($arItem['DEPTH_LEVEL'] == 1) {
        $lastFirstLevelItem = $i;
        $arItem['ELEMENTS'] = [];
        $elements[$i] = $arItem;
    } else {
        $elements[$lastFirstLevelItem]['ELEMENTS'][] = $arItem;
    }
}
?>
<nav itemscope itemtype="http://schema.org/SiteNavigationElement">
    <meta itemprop="name" content="Вторичное меню">
    <ul itemprop="about" itemscope itemtype="http://schema.org/ItemList" class="header-menu">
        <?
        foreach($elements as $key=>$link){
        ?>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ItemList">
                <a itemprop="url" <?if ($link["PARAMS"]["HREF"] != "N") {?>href="<?=$link['LINK'];?>"<?}?> class="header-menu__link">
                    <span itemprop="name">
                        <?=$link['TEXT'];?>
                    </span>
                </a>
                <? if(!empty($link['ELEMENTS'])){?>
                    <div itemprop="itemListElement" itemscope itemtype="http://schema.org/ItemList" class="header-sub">
                        <div class="header-sub__content">
                           <?foreach($link['ELEMENTS'] as $sublink){?>
                                <a itemprop="url" href="<?=$sublink['LINK'];?>" class="header-sub__link">
                                    <span itemprop="name">
                                        <?=$sublink['TEXT'];?>
                                    </span>
                                </a>
                            <?}?>
                        </div>
                    </div>
                <?}?>
            </li>
        <?}?>
    </ul>
</nav>

<!--
<pre>
    <?print_r($elements);?>
</pre>-->

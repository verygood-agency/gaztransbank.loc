<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<?php
$items = [];
$lastNum = 0;
$lastNumSecond = 0;

foreach ($arResult as $num => $arItem) {
    if ($arItem["DEPTH_LEVEL"] == 1) {
        $items[$num] = $arItem;
        $lastNum = $num;
    }

    if ($arItem["DEPTH_LEVEL"] == 2) {
        $lastNumSecond = $num;
        $items[$lastNum]['CHILDREN'][$num] = $arItem;
    }

    if ($arItem["DEPTH_LEVEL"] == 3) {
        $items[$lastNum]['CHILDREN'][$lastNumSecond]['CHILDREN'][$num] = $arItem;
    }
}
?>
<ul>

<?
foreach($items as $arItem):
?>
    <li>
	    <?if($arItem["SELECTED"]):?>
		    <a href="<?=$arItem["LINK"]?>" class="active"><?=$arItem["TEXT"]?></a>

            <?php if(array_key_exists('CHILDREN', $arItem)): ?>
                <ul>
                    <?php foreach ($arItem['CHILDREN'] as $child): ?>
                        <li>
                            <a
                                href="<?=$child["LINK"]?>"
                                <?php if($arItem["SELECTED"]):?> class="active" <?php endif; ?>
                            ><?=$child["TEXT"]?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
	    <?else:?>
		    <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
	    <?endif?>



    </li>

<?endforeach?>
</ul>
<?endif?>

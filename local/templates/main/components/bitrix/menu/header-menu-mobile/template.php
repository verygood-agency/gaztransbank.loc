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
<ul class="mobile-nav">

<?
foreach($items as $arItem):
?>
    <li>
	    <?if($arItem["SELECTED"]):?>
		    <a href="<?=$arItem["LINK"]?>" class="active"><?=$arItem["TEXT"]?></a>

            <?php if(array_key_exists('CHILDREN', $arItem)): ?>
                <?$APPLICATION->IncludeComponent("bitrix:menu", "header-menu-mobile-2", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "2",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "single",	// Тип меню для первого уровня
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                    false
                );?>
            <?php endif; ?>
	    <?else:?>
		    <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
	    <?endif?>



    </li>

<?endforeach?>
</ul>
<?endif?>

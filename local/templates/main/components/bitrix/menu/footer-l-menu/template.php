<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav class="footer-l">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
		continue;
?>
    <a href="<?=$arItem["LINK"]?>" class="footer-l__link"><?=$arItem["TEXT"]?></a>
<?endforeach?>
</nav>
<?endif?>

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$this->SetViewTarget('META-IMAGE');

    //og:title
    if ($APPLICATION->GetPageProperty("title")){?>
        <meta property="og:title" content="<?=$APPLICATION->GetPageProperty("title")?>" />
        <meta name="twitter:title" content="<?=$APPLICATION->GetPageProperty("title")?>" />
    <?} else {?>
        <meta property="og:title" content="<?=$APPLICATION->GetTitle(false)?> — ООО КБ «ГТ банк»" />
        <meta name="twitter:title" content="<?=$APPLICATION->GetTitle(false)?> — ООО КБ «ГТ банк»" />
    <?};

    //og:image
    if ($arResult["ITEMS"]):
        foreach($arResult["ITEMS"] as $arItem){
            if (count($arResult["ITEMS"])==1 || count($arResult["ITEMS"])>1 && $arItem["CODE"] <> "/"):
                if ($arItem["DISPLAY_PROPERTIES"]["OG"]["FILE_VALUE"]["SRC"]) {
                    ?>
                    <meta property="og:image" content="https://<?=$_SERVER['HTTP_HOST']?><?echo $arItem["DISPLAY_PROPERTIES"]["OG"]["FILE_VALUE"]["SRC"];?>" />
                    <meta property="og:image:alt" content="<?=$arItem["NAME"]?>. ООО КБ «ГТ банк»" />
                    <meta property="og:image:width" content="<?=$arItem["DISPLAY_PROPERTIES"]["OG"]["FILE_VALUE"]["WIDTH"]?>">
                    <meta property="og:image:height" content="<?=$arItem["DISPLAY_PROPERTIES"]["OG"]["FILE_VALUE"]["HEIGHT"]?>">
                    <?
                }
                if ($arItem["DISPLAY_PROPERTIES"]["VK"]["FILE_VALUE"]["SRC"]) {
                    ?>
                    <meta property="vk:image" content="https://<?=$_SERVER['HTTP_HOST']?><?echo $arItem["DISPLAY_PROPERTIES"]["VK"]["FILE_VALUE"]["SRC"];?>" />
                    <meta property="vk:image:alt" content="<?=$arItem["NAME"]?>. ООО КБ «ГТ банк»" />
                    <meta property="vk:image:width" content="<?=$arItem["DISPLAY_PROPERTIES"]["VK"]["FILE_VALUE"]["WIDTH"]?>">
                    <meta property="vk:image:height" content="<?=$arItem["DISPLAY_PROPERTIES"]["VK"]["FILE_VALUE"]["HEIGHT"]?>">
                    <?
                }
                if ($arItem["DISPLAY_PROPERTIES"]["FACEBOOK"]["FILE_VALUE"]["SRC"]) {
                    ?>
                    <meta property="fb:image" content="https://<?=$_SERVER['HTTP_HOST']?><?echo $arItem["DISPLAY_PROPERTIES"]["FACEBOOK"]["FILE_VALUE"]["SRC"];?>" />
                    <meta property="fb:image:alt" content="<?=$arItem["NAME"]?>. ООО КБ «ГТ банк»" />
                    <meta property="fb:image:width" content="<?=$arItem["DISPLAY_PROPERTIES"]["FACEBOOK"]["FILE_VALUE"]["WIDTH"]?>">
                    <meta property="fb:image:height" content="<?=$arItem["DISPLAY_PROPERTIES"]["FACEBOOK"]["FILE_VALUE"]["HEIGHT"]?>">
                    <?
                }
                if ($arItem["DISPLAY_PROPERTIES"]["TWITTER"]["FILE_VALUE"]["SRC"]) {
                    ?>
                    <meta name="twitter:image" content="https://<?=$_SERVER['HTTP_HOST']?><?echo $arItem["DISPLAY_PROPERTIES"]["TWITTER"]["FILE_VALUE"]["SRC"];?>" />
                    <meta name="twitter:image:alt" content="<?=$arItem["NAME"]?>. ООО КБ «ГТ банк»" />
                    <?
                }
            endif;
        }
    endif;

$this->EndViewTarget();
?>


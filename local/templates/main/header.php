<?php

global $APPLICATION;

use Bitrix\Main\Page\Asset;
use Local\Utils\Settings;
CJSCore::Init(array('ajax'));
CUtil::InitJSCore(array('ajax'));

//Ссылка для разных разделов сайта
$internetBankLink = Settings::get('index-internet-bank-link');
if(strpos($APPLICATION->GetCurPage(), '/biznesu/') !== false) {
    $internetBankLink = Settings::get('biznesu-internet-bank-link');
}
if(strpos($APPLICATION->GetCurPage(), '/o-banke/') !== false) {
    $internetBankLink = Settings::get('about-internet-bank-link');
}

//Телефон для разных городов
$phoneBank = Settings::get('phone');
if (city()['NAME'] == "Новороссийск") {
    $phoneBank = Settings::get('phoneNovorossiysk');
}

//die($internetBankLink);
?><!DOCTYPE html>
<html lang="ru">

<head itemscope itemtype="http://schema.org/WPHeader">
    <meta charset="utf-8">

    <?//Компонент задаёт значение title
    $APPLICATION->IncludeComponent(
        "bitrix:breadcrumb",
        "title",
        Array(
            "PATH" => "",
            "SITE_ID" => "s1",
            "START_FROM" => "1"
        )
    );
    ?>

    <title itemprop="headline"><?=$APPLICATION->ShowTitle()?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta name="twitter:card" content="summary" />
    <!--<meta name="twitter:site" content="" />-->
    <meta property="og:url" content="https://<?=$_SERVER['HTTP_HOST']?><?=$APPLICATION->GetCurPage()?>" />

    <?if (  (strpos($APPLICATION->GetCurPage() ,'/chastnym-litsam/') !== FALSE && $APPLICATION->GetCurPage() <> '/chastnym-litsam/tarify-i-dokumenty/') ||
            (strpos($APPLICATION->GetCurPage() ,'/biznesu/') !== FALSE  && $APPLICATION->GetCurPage() <> '/biznesu/bank-client/' && $APPLICATION->GetCurPage() <> "/biznesu/")
         ) {
        echo ('<meta property="og:type" content="product" />');
    } else if (strpos($APPLICATION->GetCurPage() ,'/o-banke/news/') !== FALSE || strpos($APPLICATION->GetCurPage() ,'/aktsii/') !== FALSE) {
        echo ('<meta property="og:type" content="article" />');
    } else {
        echo ('<meta property="og:type" content="website" />');
    }?>

    <?//Отложенная функция задачи description, og:description и twitter:description
    $APPLICATION->AddBufferContent('ShowDescription');

    function ShowDescription()
    {
        global $APPLICATION;
        if (empty($APPLICATION->GetMeta("description"))) {
            return (
                '<meta itemprop="description" name="description" content="' . $APPLICATION->GetTitle(false) . '. ООО КБ «ГТ банк» - кредиты и вклады, ипотека, дебетовые, кредитные карты и другие банковские услуги для физических лиц. Полный комплекс расчетно-кассового обслуживания юридических лиц и индивидуальных предпринимателей в рублях и иностранной валюте." />'.
                '<meta property="og:description" content="'. $APPLICATION->GetTitle(false). '. ООО КБ «ГТ банк» - кредиты и вклады, ипотека, дебетовые, кредитные карты и другие банковские услуги для физических лиц. Полный комплекс расчетно-кассового обслуживания юридических лиц и индивидуальных предпринимателей в рублях и иностранной валюте." />'.
                '<meta name="twitter:description" content="'. $APPLICATION->GetTitle(false). '. ООО КБ «ГТ банк» - кредиты и вклады, ипотека, дебетовые, кредитные карты и другие банковские услуги для физических лиц. Полный комплекс расчетно-кассового обслуживания юридических лиц и индивидуальных предпринимателей в рублях и иностранной валюте." />'
            );
        } else {
            if (empty($APPLICATION->GetPageProperty("description"))) {
                return (
                    '<meta property="og:description" content="'. $APPLICATION->GetTitle(false). '. ООО КБ «ГТ банк» - кредиты и вклады, ипотека, дебетовые, кредитные карты и другие банковские услуги для физических лиц. Полный комплекс расчетно-кассового обслуживания юридических лиц и индивидуальных предпринимателей в рублях и иностранной валюте." />'.
                    '<meta name="twitter:description" content="'. $APPLICATION->GetTitle(false). '. ООО КБ «ГТ банк» - кредиты и вклады, ипотека, дебетовые, кредитные карты и другие банковские услуги для физических лиц. Полный комплекс расчетно-кассового обслуживания юридических лиц и индивидуальных предпринимателей в рублях и иностранной валюте." />'
                );
            } else {
                return (
                    '<meta property="og:description" content="' . $APPLICATION->GetPageProperty("description"). '" />'.
                    '<meta name="twitter:description" content="'. $APPLICATION->GetPageProperty("description"). '" />'
                );
            }
        }
    }
    ?>

    <?$APPLICATION->ShowViewContent('META-IMAGE');?>

    <?if ($_REQUEST['currency'] || $_REQUEST['type'] || $_REQUEST['sum'] || $_REQUEST['day'] || $_REQUEST['has'] || $_REQUEST['city1'] || $_REQUEST['section'] || $_REQUEST['id'] || $_REQUEST['q'] || $_REQUEST['how']) {
        echo ('<link rel="canonical" href="https://' . $_SERVER['HTTP_HOST'] . $APPLICATION->GetCurPage() . '" />');
    }?>

    <link type="image/x-icon" rel="shortcut icon" href="/favicon.ico">
    <link type="image/png" sizes="16x16" rel="icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-16x16.png">
    <link type="image/png" sizes="32x32" rel="icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/favicon-32x32.png">

    <link type="image/png" sizes="192x192" rel="icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/android-chrome-192x192.png">
    <link type="image/png" sizes="512x512" rel="icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/android-chrome-512x512.png">

    <link sizes="180x180" rel="apple-touch-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/apple-touch-icon.png">

    <link color="#ffffff" rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/safari-pinned-tab.svg">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/mstile-144x144.png">
    <meta name="msapplication-square70x70logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/mstile-70x70.png">
    <meta name="msapplication-square150x150logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/mstile-150x150.png">
    <meta name="msapplication-wide310x150logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/mstile-310x310.png">
    <meta name="msapplication-square310x310logo" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/mstile-310x150.png">
    <meta name="application-name" content="ООО КБ «ГТ банк»">
    <meta name="msapplication-config" content="<?=SITE_TEMPLATE_PATH?>/images/favicon/browserconfig.xml">

    <link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/images/favicon/site.webmanifest">
    <meta name="theme-color" content="#ffffff">

    <script src="https://cdn.polyfill.io/v3/polyfill.min.js?features=default,Array.prototype.includes,Array.prototype.find"></script>
    <?
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/last.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/styles.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/new-style.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/bvi.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/magnific-popup.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/datepicker.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/bank-guarantee.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/sitemap.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/monets-patch.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/select2.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/jquery.fancybox.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/app.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/custom.css");

    //Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery-3.5.1.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery-3.6.3.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/swiper.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/wNumb.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/nouislider.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/sameElementsHeight.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/nice-select2.js");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/svgxuse.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery-1.12.4.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/bvi.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/js.cookie.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.inputmask.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.matchHeight-min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/main.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.magnific-popup.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.form.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/sweetalert.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/datepicker.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/custom.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/forms.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/city.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/select2.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/app.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/email.js");
?>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
      (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
      (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

      ym(57270994, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
      });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/57270994" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-57W58BH');</script>
    <!-- End Google Tag Manager -->

    <?$APPLICATION->ShowHead()?>
</head>
<body>
   <div id="panelka">
    <?$APPLICATION->ShowPanel();?>
   </div>
    <header class="header">
        <div class="wrapper header__wrapper">
            <a href="/" class="header-logo">
                <img class="header-logo__pic" src="<?=SITE_TEMPLATE_PATH?>/images/logo.svg" width="160" height="70.047" alt="<?=$APPLICATION->ShowTitle(false)?>. ООО КБ «ГТ банк»">
            </a>
            <div class="header__content">
                <div class="header__top">

                    <?$APPLICATION->IncludeComponent("bitrix:menu", "header-menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                0 => "",
                            ),
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        ),
                        false
                    );?>

                    <nav class="support-nav">
                        <?php /*<a href="#city-select" class="support-nav__link iconed iconed_center inline-popup">
                            <svg class="iconed__ico header__ico iconed__ico_r-default header__telegram-ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#telegram-ico"></use>
                            </svg>
                            <span class="iconed__title support-nav__title">
                                <?php echo city()['NAME'];?>
                            </span>
                        </a>*/ ?>
                        <a href="/o-banke/otdeleniya-i-bankomats/" class="support-nav__link iconed iconed_center">
                            <svg class="iconed__ico header__ico iconed__ico_r-default header__ballon-ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#ballon-ico"></use>
                            </svg>
                            <span class="iconed__title support-nav__title">
                                Отделения и банкоматы
                            </span>
                        </a>
                        <a href="#" class="support-nav__link iconed iconed_center bvi-open">
                            <svg class="iconed__ico header__ico iconed__ico_r-default header__eye-ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#eye-ico"></use>
                            </svg>
                            <span class="iconed__title support-nav__title">
                                Версия для слабовидящих
                            </span>
                        </a>
                        <a href="tel:<?php echo clear_phone($phoneBank); ?>" class="support-nav__link iconed iconed_center">
                            <svg class="iconed__ico header__phone-ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#phone-ico"></use>
                            </svg>
                        </a>
                        <a href="/search/" class="support-nav__link iconed iconed_center">
                            <svg class="iconed__ico header__search-ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#search-ico"></use>
                            </svg>
                        </a>
                    </nav>
                </div>
                <div class="header__bottom">
                  <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "secondary-menu",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => array(""),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "single",
                        "USE_EXT" => "Y"
                    )
                );?>
                    <a href="<?php echo $internetBankLink; ?>" target="_blank" class="btn btn-bordered btn-bordered_blue">
                        <span class="btn__title">
                            Интернет-Банк
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <header class="mobile nst-component nst-is-collapsed">
        <div class="mobile__header">
            <a href="/" class="mobile__logo">
                <img src="<?=SITE_TEMPLATE_PATH?>/images/m-logo.svg" width="65" height="28.266" alt="<?=$APPLICATION->ShowTitle(false)?>. ООО КБ «ГТ банк»">
            </a>
            <button class="mobile__btn nst-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="toggle-container content nst-content">
            <div class="mobile__content">
                <?$APPLICATION->IncludeComponent("bitrix:menu", "header-menu-mobile", Array(
                    "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                        "CHILD_MENU_TYPE" => "single",	// Тип меню для остальных уровней
                        "DELAY" => "N",	// Откладывать выполнение шаблона меню
                        "MAX_LEVEL" => "3",	// Уровень вложенности меню
                        "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                            0 => "",
                        ),
                        "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                        "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                        "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                        "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                        "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                    ),
                    false
                );?>

                <div class="mobile-loc">
                    <div class="mobile-city">
                        <?php /*<a href="#city-select" class="mobile-loc__item mobile-city__link iconed iconed_center inline-popup">
                            <svg class="loc-arrow-ico mobile-loc__ico iconed__ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#loc-arrow-ico">
                                </use>
                            </svg>
                            <span class="mobile-city__title">
                                <?php echo city()['NAME'];?>
                            </span>
                        </a>*/ ?>
                        <a href="/o-banke/otdeleniya-i-bankomats/" class="mobile-loc__item mobile-city__link iconed iconed_center">
                            <svg class="mobile-ballon-ico mobile-loc__ico iconed__ico">
                                <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#ballon-ico">
                                </use>
                            </svg>
                            <span class="mobile-city__title">
                                Отделения и банкоматы
                            </span>
                        </a>
                    </div>
                    <a href="#" class=""></a>
                </div>

                <div class="mobile-user">
                    <a href="tel:<?php echo clear_phone($phoneBank); ?>" class="mobile-user__link">
                        <svg class="loc-phone-ico iconed__ico">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#phone-ico">
                            </use>
                        </svg>
                    </a>
                    <a href="/search/" class="mobile-user__link">
                        <svg class="loc-search-ico  iconed__ico">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#search-ico">
                            </use>
                        </svg>
                    </a>
                    <a href="#" class="mobile-user__link bvi-open">
                        <svg class="loc-eye-ico iconed__ico">
                            <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#eye-ico">
                            </use>
                        </svg>
                    </a>
                </div>

                <div class="mobile-btn">
                    <a href="<?php echo $internetBankLink; ?>" class="btn btn-bordered btn-bordered_blue">
                        <span class="btn__title">
                            Интернет-Банк
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <?
        if ($APPLICATION->GetCurPage() != "/chastnym-litsam/bankovskie-karty/") {
            $APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "navigation",
                Array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            );
        }
        ?>

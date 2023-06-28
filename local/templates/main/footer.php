<?if ($APPLICATION->GetCurPage() <> '/chastnym-litsam/edinaya-biometricheskaya-sistema/uik-ok/' &&
      $APPLICATION->GetCurPage() <> '/chastnym-litsam/edinaya-biometricheskaya-sistema/uik-error/' &&
      $APPLICATION->GetCurPage() <> '/biznesu/salary-project/' &&
      $APPLICATION->GetCurPage() <> '/biznesu/rko-new/' &&
      $APPLICATION->GetCurPage() <> '/biznesu/ved/' &&
      stripos($APPLICATION->GetCurPage(), '/chastnym-litsam/bankovskie-karty/') === false &&
      $APPLICATION->GetCurPage() <> '/biznesu/lizing/'
      ) {
  $url = $APPLICATION->GetCurPage(false);
  $arrFilter = array(
    "NAME" => $url
  );

  $APPLICATION->IncludeComponent("bitrix:news.list", "bottom-baner", array(
    "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "AJAX_MODE" => "N",    // Включить режим AJAX
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "N",    // Включить подгрузку стилей
    "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "N",    // Учитывать права доступа
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_TYPE" => "A",    // Тип кеширования
    "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
    "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
    "DISPLAY_DATE" => "Y",    // Выводить дату элемента
    "DISPLAY_NAME" => "Y",    // Выводить название элемента
    "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
    "FIELD_CODE" => array(    // Поля
      0 => "CODE",
      1 => "NAME",
      2 => "PREVIEW_PICTURE",
      3 => "DETAIL_PICTURE",
      4 => "",
    ),
    "FILTER_NAME" => "arrFilter",    // Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
    "IBLOCK_ID" => getiblockIdByCode("bottom-baners"),    // Код информационного блока
    "IBLOCK_TYPE" => "content",    // Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
    "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT" => "20",    // Количество новостей на странице
    "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
    "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
    "PAGER_TITLE" => "Новости",    // Название категорий
    "PARENT_SECTION" => "",    // ID раздела
    "PARENT_SECTION_CODE" => "",    // Код раздела
    "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "PROPERTY_CODE" => array(    // Свойства
      0 => "LINK",
      1 => "",
      2 => "",
    ),
    "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
    "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
    "SET_STATUS_404" => "N",    // Устанавливать статус 404
    "SET_TITLE" => "N",    // Устанавливать заголовок страницы
    "SHOW_404" => "N",    // Показ специальной страницы
    "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
    "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
    "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
    "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
  ),
    false
  );
}?>

<?if ($APPLICATION->GetCurPage() == '/' || $APPLICATION->GetCurPage() == '/biznesu/' || $APPLICATION->GetCurPage() == '/o-banke/' || $APPLICATION->GetCurPage() == '/chastnym-litsam/vklady/') {?>
    <div class="section section_white section_t-middle section_b-offset">
        <div class="wrapper wrapper_default">
            <h2 class="h2 section__title title title_bold">Новости</h2>
            <?$APPLICATION->IncludeComponent("bitrix:news.list", "news-slider", Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
                "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
                "AJAX_MODE" => "N",    // Включить режим AJAX
                "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
                "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
                "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
                "AJAX_OPTION_STYLE" => "N",    // Включить подгрузку стилей
                "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
                "CACHE_GROUPS" => "N",    // Учитывать права доступа
                "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
                "CACHE_TYPE" => "A",    // Тип кеширования
                "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
                "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
                "DISPLAY_DATE" => "Y",    // Выводить дату элемента
                "DISPLAY_NAME" => "Y",    // Выводить название элемента
                "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
                "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
                "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
                "FIELD_CODE" => array(    // Поля
                    0 => "NAME",
                    1 => "DATE_ACTIVE_FROM",
                    2 => "DATE_CREATE",
                    3 => "",
                ),
                "FILTER_NAME" => "",    // Фильтр
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
                "IBLOCK_ID" => getiblockIdByCode("news"),    // Код информационного блока
                "IBLOCK_TYPE" => "about",    // Тип информационного блока (используется только для проверки)
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
                "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
                "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
                "NEWS_COUNT" => "20",    // Количество новостей на странице
                "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
                "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
                "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
                "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
                "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
                "PAGER_TITLE" => "Новости",    // Название категорий
                "PARENT_SECTION" => "",    // ID раздела
                "PARENT_SECTION_CODE" => "",    // Код раздела
                "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
                "PROPERTY_CODE" => array(    // Свойства
                    0 => "",
                    1 => "",
                ),
                "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
                "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
                "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
                "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
                "SET_STATUS_404" => "N",    // Устанавливать статус 404
                "SET_TITLE" => "N",    // Устанавливать заголовок страницы
                "SHOW_404" => "N",    // Показ специальной страницы
                "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
                "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
                "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
                "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
                "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
            ),
                false
            );?>
            <div class="btn-wrapper">
                <a href="/o-banke/news/" class="link more-link">
                    Все новости
                </a>
            </div>
        </div>
    </div>
<?}?>
</main>
<footer class="footer">
        <div class="footer__row">
            <div class="wrapper wrapper_default">
                <div class="footer__content">
                    <? use Local\Utils\Settings;

                    $APPLICATION->IncludeComponent("bitrix:menu", "footer-menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                0 => "",
                            ),
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "footer",	// Тип меню для первого уровня
                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        ),
                        false
                    );?>
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer-m-menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                0 => "",
                            ),
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "footerM",	// Тип меню для первого уровня
                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        ),
                        false
                    );?>
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "footer-l-menu", Array(
                        "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                            "CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
                            "DELAY" => "N",	// Откладывать выполнение шаблона меню
                            "MAX_LEVEL" => "1",	// Уровень вложенности меню
                            "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                                0 => "",
                            ),
                            "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                            "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                            "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                            "ROOT_MENU_TYPE" => "footerL",	// Тип меню для первого уровня
                            "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                        ),
                        false
                    );?>
                    <div class="footer-nav">
                        <div class="footer-nav__content">
                            <div class="footer-phone footer-phone_offset">
                                <span class="footer-phone__title title title_block">
                                    <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/includes/help-phone-text.php"
                                    )); ?>
                                </span>
                                <a href="tel:<?php echo clear_phone($phoneBank); ?>" class="footer-phone__numb">
                                    <?php echo $phoneBank; ?>
                                </a>
                            </div>
                            <div class="footer-call">
                                <a href="/feedback" class="btn footer-btn">
                                    <span class="btn__title">
                                        Задать вопрос
                                    </span>
                                </a>
                                <a href="/feedback-corruption" class="btn footer-btn">
                                        <span class="btn__title">
                                            Линия доверия
                                        </span>
                                </a>
                                <a href="/faq/" class="btn footer-btn">
                                    <span class="btn__title">
                                        Частые вопросы<br>
                                        и ответы на них
                                    </span>
                                </a>
                            </div>
                            <a href="#" class="footer-nav__eye iconed iconed_center bvi-open ">
                                <svg class="iconed__ico header__ico iconed__ico_r-default header__eye-ico">
                                    <use xlink:href="<?=SITE_TEMPLATE_PATH?>/images/icons.svg#eye-ico"></use>
                                </svg>
                                <span class="iconed__title support-nav__title">
                                    Версия для слабовидящих
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="wrapper wrapper_default">
                <div class="footer__content">
                    <div class="gen-links">
                        <a href="/" class="footer-logo">
                            <img class="footer-logo__pic" src="<?=SITE_TEMPLATE_PATH?>/images/footer-logo.svg" width="140" height="64" loading="lazy" alt="<?=$APPLICATION->ShowTitle(false)?>. ООО КБ «ГТ банк»">
                        </a>
                    </div>
                    <div class="footer-copy">
                        <span class="footer-copy__title">
                            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/includes/copyright-1.php"
                            )); ?>
                        </span>
                        <span class="footer-copy__title">
                            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/includes/copyright-2.php"
                            )); ?>
                        </span>
                    </div>
                    <div class="footer-nav">
                        <div class="footer-nav__content footer-nav__content_full">
                          <span class="wf light">Поддержка и развитие сайта - </span>
                          <a href="https://very-good.ru/" target="_blank" class="wf light">very-good.ru</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?if (!htmlspecialchars($_COOKIE["cookies_policy"])) {?>
      <div id="cookie" class="cookie">
        <div class="cookie__container">
          <div class="cookie__content">
            <div class="cookie__text">
              Мы используем cookies для улучшения работы нашего сайта и большего удобства его использования.<br>
              Продолжая использовать сайт, Вы выражаете свое согласие на обработку файлов cookies, а также подтверждаете факт ознакомления с <a href="/policy/" style="text-decoration: underline">условиями обработки персональных данных</a>.<br>
              Вы можете ограничить или полностью запретить сбор и обработку cookies в настройках вашего браузера.
            </div>
            <a id="cookiebtn" class="btn btn_box btn_red">Согласен</a>
          </div>
        </div>
      </div>

      <script>
        function setCookie(name, value, days) {
          let expires = "";
          if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
          }
          document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        document.getElementById("cookiebtn").addEventListener('click', function () {
          setCookie('cookies_policy', 'true', 365);
          $('#cookie').remove();
        });
      </script>
    <?}?>

    <?php /*<div class="popup popup-small mfp-hide city-popup city-popup-js" id="city-select">
       <div class="popup__header">
            <h2 class="popup__title">
                Выберите город
            </h2>
       </div>
       <div class="popup__content">
           <div class="city-popup__links">
               <?php foreach (cities() as $city): ?>
                   <a href="#" data-id="<?php echo $city['ID']; ?>" class="city-popup__link city-link-js <?php echo ($city['ID'] == city()['ID']) ? 'active' : ''; ?>">
                      <?php echo $city['NAME']; ?>
                   </a>
               <?php endforeach; ?>
           </div>
           <a href="#" class="btn btn__default btn_blue city-close-js">
               <span class="btn__title">Выбрать</span>
           </a>
       </div>
    </div>

    <?php if(\Local\Cities\City::showPopup()): ?>
        <script>
            $(document).ready(function() {
                $.magnificPopup.open({
                    items: {
                        src: '#city-select',
                        type: 'inline'
                    }
                });
            })
        </script>
    <?php endif; */ ?>

    <?
    $arrFilter = Array(
        "CODE" => Array($APPLICATION->GetCurPage(false), "/"),
    );
    ?>
    <?$APPLICATION->IncludeComponent("bitrix:news.list", "meta-image", Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
        "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
        "AJAX_MODE" => "N",    // Включить режим AJAX
        "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
        "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
        "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
        "AJAX_OPTION_STYLE" => "N",    // Включить подгрузку стилей
        "CACHE_FILTER" => "N",    // Кешировать при установленном фильтре
        "CACHE_GROUPS" => "N",    // Учитывать права доступа
        "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
        "CACHE_TYPE" => "A",    // Тип кеширования
        "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
        "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
        "DISPLAY_BOTTOM_PAGER" => "Y",    // Выводить под списком
        "DISPLAY_DATE" => "Y",    // Выводить дату элемента
        "DISPLAY_NAME" => "Y",    // Выводить название элемента
        "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
        "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
        "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
        "FIELD_CODE" => array(    // Поля
            0 => "NAME",
            1 => "PREVIEW_PICTURE",
            2 => "",
        ),
        "FILTER_NAME" => "arrFilter",    // Фильтр
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
        "IBLOCK_ID" => getiblockIdByCode("meta-image"),    // Код информационного блока
        "IBLOCK_TYPE" => "content",    // Тип информационного блока (используется только для проверки)
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
        "INCLUDE_SUBSECTIONS" => "N",    // Показывать элементы подразделов раздела
        "MESSAGE_404" => "",    // Сообщение для показа (по умолчанию из компонента)
        "NEWS_COUNT" => "20",    // Количество новостей на странице
        "PAGER_BASE_LINK_ENABLE" => "N",    // Включить обработку ссылок
        "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
        "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
        "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
        "PAGER_TEMPLATE" => ".default",    // Шаблон постраничной навигации
        "PAGER_TITLE" => "Новости",    // Название категорий
        "PARENT_SECTION" => "",    // ID раздела
        "PARENT_SECTION_CODE" => "",    // Код раздела
        "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
        "PROPERTY_CODE" => array(    // Свойства
            0 => "OG",
            1 => "VK",
            2 => "FACEBOOK",
            3 => "TWITTER",
            4 => "",
        ),
        "SET_BROWSER_TITLE" => "N",    // Устанавливать заголовок окна браузера
        "SET_LAST_MODIFIED" => "N",    // Устанавливать в заголовках ответа время модификации страницы
        "SET_META_DESCRIPTION" => "N",    // Устанавливать описание страницы
        "SET_META_KEYWORDS" => "N",    // Устанавливать ключевые слова страницы
        "SET_STATUS_404" => "N",    // Устанавливать статус 404
        "SET_TITLE" => "N",    // Устанавливать заголовок страницы
        "SHOW_404" => "N",    // Показ специальной страницы
        "SORT_BY1" => "ACTIVE_FROM",    // Поле для первой сортировки новостей
        "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
        "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
        "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
        "STRICT_SECTION_CHECK" => "N",    // Строгая проверка раздела для показа списка
    ),
        false
    );
    ?>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-V23BM495WM"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-V23BM495WM');
  </script>
</body>

</html>
<?php

function dd($data)
{
    global $APPLICATION;
    $APPLICATION->RestartBuffer();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    die();
}

if (!function_exists('cities')) {
    /**
     * Берем города из базы.
     */
    function cities()
    {
        return \Local\Cities\City::get();
    }
}

if (!function_exists('city')) {
    /**
     * Берем города из базы.
     */
    function city()
    {
        return \Local\Cities\City::city();
    }
}

// get currencies
use Bitrix\Highloadblock\HighloadBlockTable;

function get_tarifs()
{
    echo "<div id='tarifs_container'></div>";
    echo "<script src='/local/templates/main/js/tarifs.js'></script>";
}

function get_tarifs_html()
{
    $html = file_get_contents('https://apex.gaztransbank.ru/apex/gtb/htmlrates2021');
    $html = substr($html, $l = strpos($html, '<main class="main">'), strpos($html, '</main>') - $l);
    $html = str_ireplace('<main class="main">', '', $html);
    $html = str_ireplace('<div class="section rating-section section_default section_gray section_last">', '', $html);
    $html = str_ireplace('<div class="wrapper wrapper_default">', '', $html);
    $html = str_lreplace('</div>', '', $html);
    $html = str_lreplace('</div>', '', $html);
    $html = $html. "<script>$('.box-header__notif').text($('.box-header__notif').text().replace( /\b\d\d:\d\d\b:\d\d\b/ , ''));</script>";
    return htmlspecialchars_decode($html);
}

function price_format($num)
{
    return number_format($num, 0, '.', ' ');
}

function get_tarifs_table($id)
{
    $class = getHBlockEntityById('VkladTarifsTables');

    $res = $class::getList([
        'filter' => ['UF_VKLAD_ID' => $id],
        "order" => ["UF_SORT"=>"ASC"],
    ]);

    $items = [];
    while ($item = $res->fetch()) {
        $items[$item['UF_TARIF']][] = $item;
    }

    return $items;
}

function get_deposits_table()
{
    $class = getHBlockEntityById('DepositsTables');

    $res = $class::getList([
        "order" => ["UF_SORT"=>"ASC"],
    ]);

    $items = [];
    while ($item = $res->fetch()) {
        $items[$item['UF_NAME']][] = $item;
    }

    return $items;
}

function getHBlockEntityById($highloadCode) {
    CModule::IncludeModule('highloadblock');
    $entity = HighloadBlockTable::compileEntity($highloadCode);
    $hl_data_class =  $entity->getDataClass();

    return $hl_data_class;
}

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

if (!function_exists('view')) {
    function view($path, $compactParams = []) {
        $path = implode('/', explode('.', $path)).'.php';

        if (!empty($compactParams)) {
            extract($compactParams);
        }

        ob_start();
            include $_SERVER['DOCUMENT_ROOT']."/local/views/".$path;
        return ob_get_clean();
    }
}

if (!function_exists('get_section_by_code'))
{
    function get_section_by_code($iblockId, $code, $arOrder = ['NAME' => 'ASC']): array
    {
        CModule::IncludeModule('iblock');

        $res = CIBlockSection::GetList($arOrder, [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y',
            'CODE' => $code,
        ]);

        return $res->Fetch();
    }
}


if (!function_exists('get_sections'))
{
    function get_sections($iblockId, $arOrder = ['NAME' => 'ASC']): array
    {
        CModule::IncludeModule('iblock');

        $res = CIBlockSection::GetList($arOrder, [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y'
        ]);

        $sections = [];
        while ($arSection = $res->Fetch()) {
            $sections[$arSection['ID']] = $arSection;
        }

        return $sections;
    }
}

if (!function_exists('get_elements'))
{
    function get_elements($iblockId, $arOrder = ['NAME' => 'ASC']): array
    {
        CModule::IncludeModule('iblock');

        $res = CIBlockElement::GetList($arOrder, [
            'IBLOCK_ID' => $iblockId,
            'ACTIVE' => 'Y'
        ]);

        $elements = [];
        while ($arElement = $res->Fetch()) {
            $elements[$arElement['ID']] = $arElement;
        }

        return $elements;
    }
}

if (!function_exists('resize')) {
    /**
     * resize($id,$width,$height) - обертка над ResizeImageGet.
     *
     * @param id - айди картинки
     * @param width - нужная ширина
     * @param height - нужная высота
     * @param method - вид обрезки, по умолчанию BX_RESIZE_IMAGE_EXACT
     * @param quality - качеств новой фотки, по умолчанию 70
     * return string (file src)
     **/
    function resize($id, $width, $height, $method = BX_RESIZE_IMAGE_EXACT, $quality = 70, $filters = false)
    {
        $img = CFile::ResizeImageGet($id, array('width' => $width, 'height' => $height), $method, true, $filters, false, $quality);

        return $img['src'];
    }
}

if (!function_exists('dump')) {
    /**
     * @var - array of variable to print
     *        print  input in pre wrapper
     **/
    function dump($var)
    {
        echo "<pre style='display:none'>";
        print_r($var);
        echo '</pre>';
    }
}

if (!function_exists('dump2')) {
    /**
     * @var - array of variable to print
     *        print  input in pre wrapper
     **/
    function dump2($var)
    {
        echo "<pre>";
        print_r($var);
        echo '</pre>';
    }
}

if (!function_exists('clear_phone')) {
    /**
     * Функция пиводит телефон к формату +79995552255.
     *
     * @param string $phone
     *
     * @return string
     */
    function clear_phone($phone)
    {
        return str_replace(['(', ')', '-', ' '], '', $phone);
    }
}

if (!function_exists('plural_form')) {
    /**
     * Склонение числительных.
     *
     * @param [type] $number
     * @param [type] $after
     */
    function plural_form($number, $after)
    {
        echo plural_form_return($number, $after);
    }
}

if (!function_exists('plural_form_return')) {
    /**
     * Склонение числительных.
     *
     * @param [type] $number
     * @param [type] $after
     */
    function plural_form_return($number, $after)
    {
        $cases = array(2, 0, 1, 1, 1, 2);
        return $number.' '.$after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
    }
}

/*
 * ID инфоблока по его коду
 */
if (!function_exists('getIblockIdByCode')) {
    function getIblockIdByCode($code)
    {
        $cacheTime = 36000;
        $obCache = new CPHPCache();
        $cachePath = '/iblock_custom_cache/';
        $cacheId = 'iblockCode'.$code;

        if ($obCache->InitCache($cacheTime, $cacheId, $cachePath)) {
            $id = $obCache->GetVars();
        } else {
            CModule::IncludeModule('iblock');
            $res = CIBlock::GetList(
                array(),
                array(
                    'CODE' => $code,
                ),
                true
            );
            if ($ar_res = $res->Fetch()) {
                $id = $ar_res['ID'];
            } else {
                $id = false;
                $obCache->AbortDataCache();
            }
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cachePath);
            $CACHE_MANAGER->RegisterTag($cacheId);
            $CACHE_MANAGER->EndTagCache();
            if ($obCache->StartDataCache()) {
                $obCache->EndDataCache($id);
            }
        }

        return $id;
    }
}

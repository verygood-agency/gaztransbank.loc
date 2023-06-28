<?php


namespace Local\Cities;


class City
{
    protected static $cities = null;
    protected static $city = null;
    protected static $auto = false;

    public static function init()
    {
        $cities = self::get();

        if($_COOKIE['city'] && isset($cities[$_COOKIE['city']])) {
            self::$city = $cities[$_COOKIE['city']];
        } else {
            // self::$auto = true;
            self::$city = current($cities);
            self::setCity(self::$city['id']);
        }
    }

    public static function setCity($id)
    {
        setcookie(
            'city',
            $id,
            time()+60*60*24*365,
            "/",
            $_SERVER['HTTP_HOST'],
            true,
            true
        );
    }

    public static function showPopup()
    {
        return self::$auto;
    }

    public static function get()
    {
        if (self::$cities === null) {
            self::$cities = self::query();
        }

        return self::$cities;
    }

    public static function city()
    {
        if (self::$city === null) {
            self::init();
        }

        return self::$city;
    }

    public static function query()
    {
        $iblockId=getIblockIdByCode("cities");

        $cacheTime = 3600;
        $cacheId = 'cities1';
        $cachePath = '/all_cities_path/';
        $obCache = new \CPHPCache();

        if ($obCache->InitCache($cacheTime, $cacheId, $cachePath)) {
            $result = $obCache->GetVars();
        } else {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($cachePath);
            $CACHE_MANAGER->RegisterTag('iblock_id_'.$iblockId);
            \CModule::IncludeModule('iblock');
            $arFilter = [
                "IBLOCK_ID" => $iblockId,
                "ACTIVE"=>"Y"
            ];

            $result=self::fetch($arFilter);
            $CACHE_MANAGER->EndTagCache();
            if ($obCache->StartDataCache()) {
                $obCache->EndDataCache($result);
            }
        }
        return $result;
    }

    public static function fetch($arFilter)
    {
        $resItem = \CIBlockElement::GetList(
            ["SORT" => "ASC"],
            $arFilter,
            false,
            false,
            ['ID', 'NAME']
        );

        while ($arCity = $resItem->Fetch()) {
            $result[$arCity['ID']] = $arCity;
        }
        return $result;
    }
}

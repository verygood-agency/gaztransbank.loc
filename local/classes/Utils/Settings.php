<?php


namespace Local\Utils;


class Settings
{
    private static $instance;
    private $settings = [];

    private function __construct()
    {
        $class = getHBlockEntityById('Settings');

        $result = $class::getList([]);

        while ($arRow = $result->fetch()) {
            $this->settings[$arRow['UF_CODE']] = $arRow['UF_VALUE'];
        }
    }

    private static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function get(string $code)
    {
        return self::getInstance()->getByCode($code);
    }

    public function getByCode(string $code)
    {
        if (isset($this->settings[$code])) {
            return $this->settings[$code];
        }

        return null;
    }
}

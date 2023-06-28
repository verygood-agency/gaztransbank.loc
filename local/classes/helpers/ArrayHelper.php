<?php

namespace Local\helpers;

/**
 * ArrayHelper добавляет дополнительный функционал для работы с массивами.
 * Class ArrayHelper
 */
class ArrayHelper
{
    /**
     * Возвращает массив ключей массива
     *
     * @param array $array
     * @return array
     */
    public static function getKeys($array)
    {
        if (Type::isArrayable($array)) {
            return array_keys($array);
        }

        return [];
    }

    /**
     * Возвращает значения массива с новыми ключами
     * @param array $array
     * @return array
     */
    public static function getValues($array)
    {
        if (Type::isArrayable($array)) {
            return array_values($array);
        }

        return [];
    }

    public static function isIndexed($array, $consecutive = false)
    {
        if (!is_array($array)) {
            return false;
        }

        if (empty($array)) {
            return true;
        }

        if ($consecutive) {
            return array_keys($array) === range(0, count($array) - 1);
        } else {
            foreach ($array as $key => $value) {
                if (!is_int($key)) {
                    return false;
                }
            }
            return true;
        }
    }
}

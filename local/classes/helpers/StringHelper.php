<?php

namespace Local\helpers;

class StringHelper
{
    /**
     * Заменяет ключи массива rules на значения этих ключей в строке string.
     * @param string $string Строка, в которой необходимо произвести замену.
     * @param array $rules Правила замены.
     * Вид: [Что заменять => На что заменять]
     * @param null $count Количество замен.
     * @return string Строка, с замененными частями.
     */
    public static function replace($string, $rules, &$count = null) {
        $string = Type::toString($string);

        if (Type::isArrayable($rules)) {
            return str_replace(
                ArrayHelper::getKeys($rules),
                ArrayHelper::getValues($rules),
                $string,
                $count
            );
        }

        return $string;
    }
}

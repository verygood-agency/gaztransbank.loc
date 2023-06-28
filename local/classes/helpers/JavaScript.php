<?php

namespace Local\helpers;

class JavaScript
{
    /**
     * Превращяет объект PHP в объект JavaScript
     *
     * @param mixed $object
     * @param bool $strict
     * @return string
     */
    public static function toObject($object, $strict = false)
    {
        if ((Type::isNumeric($object) && !$strict) || (Type::isNumber($object) && $strict)) {
            return $object;
        } elseif (Type::isString($object)) {
            $string = Type::toString($object);
            $string = StringHelper::replace($string, [
                "\xe2\x80\xa9" => ' ',
                "\\" => '\\\\',
                "'" => '\\\'',
                "\"" => '\\"',
                "\r" => '\\r',
                "\n" => '\\n',
                "\t" => '\\t',
                "\xe2\x80\xa8" => '\\r\\n'
            ]);

            return '\'' . $string . '\'';
        } else if (Type::isBoolean($object)) {
            return $object ? 'true' : 'false';
        } else if (Type::isArray($object) || Type::isObject($object)) {
            if (Type::isObject($object))
                $object = get_object_vars($object);

            if (ArrayHelper::isIndexed($object, true)) {
                $result = '[';
                $first = true;

                foreach ($object as $entry) {
                    if (!$first)
                        $result .= ', ';

                    $result .= static::toObject($entry, $strict);

                    if ($first) $first = false;
                }

                $result .= ']';

                return $result;
            } else {
                $result = '{';
                $first = true;

                foreach ($object as $key => $entry) {
                    if (!$first)
                        $result .= ', ';

                    $result .= static::toObject(Type::toString($key), true).': '.static::toObject($entry, $strict);

                    if ($first) $first = false;
                }

                $result .= '}';

                return $result;
            }
        }

        return 'null';
    }

    public static function JSEscape($s)
    {
        static $aSearch = array("\xe2\x80\xa9", "\\", "'", "\"", "\r\n", "\r", "\n", "\xe2\x80\xa8", "*/", "</");
        static $aReplace = array(" ", "\\\\", "\\'", '\\"', "\n", "\n", "\\n", "\\n", "*\\/", "<\\/");
        $val = str_replace($aSearch, $aReplace, $s);
        return $val;
    }
}
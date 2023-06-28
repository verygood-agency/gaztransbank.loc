<?php

namespace Local\helpers;

class Component
{
    protected static $identifier = 0;

    public static function getIdentifier()
    {
        return static::$identifier;
    }

    public static function setIdentifier($identifier)
    {
        $identifier = intval($identifier);

        if ($identifier < 0)
            $identifier = 0;

        static::$identifier = $identifier;
    }

    public static function getId($id, $prefix = null)
    {
        if (empty($id))
            return null;

        $replacing = '/[^A-Za-z0-9_-]+/';
        $beginning = '/^[A-Za-z]/';

        $id = preg_replace($replacing, '-', $id);

        if (!empty($prefix)) {
            $prefix = preg_replace($replacing, '-', $prefix);

            if (!preg_match($beginning, $prefix))
                $prefix = 'i'.$prefix;
        } else if (!preg_match($beginning, $id)) {
            $prefix = 'i';
        }

        if (!empty($prefix))
            $id = $prefix.'-'.$id;

        return $id;
    }

    public static function getUniqueId($prefix = null, $addition = null)
    {
        if (empty($prefix))
            $prefix = 'i';

        $result = $prefix.'-'.static::$identifier;

        if (!empty($addition)) {
            $result = static::getId($addition, $result);
        } else {
            $result = static::getId($result);
        }

        static::$identifier++;
        return $result;
    }

    public static function getComponentUniqueId($component, $prefix = true, $length = 12)
    {
        return self::getUniqueId(null, self::_getComponentUniqueId($component, $prefix, $length));
    }

    protected static function _getComponentUniqueId($component, $prefix = true, $length = 12)
    {
        $sId = null;

        if ($length < 1)
            return $sId;

        if ($component instanceof \CBitrixComponent || $component instanceof \CBitrixComponentTemplate)
        {
            $sId = $component->randString($length);
        }
        else
        {
            return $sId;
        }

        if ($prefix)
        {
            if ($component instanceof \CBitrixComponent)
            {
                $sId = $component->getName().'-'.$sId;
            }
            else
            {
                $sId = $component->getComponent()->getName().'.'.$component->GetName().'.'.$sId;
                $sId = self::getUniqueId(null, $sId);
            }
        }

        return $sId;
    }
}
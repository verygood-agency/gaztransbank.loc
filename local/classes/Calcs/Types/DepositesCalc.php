<?php

namespace Local\Calcs\Types;

class DepositesCalc
{
    private $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public static function calc($sum, $percent, $days)
    {
        return ($sum * $percent * $days / (date('L') ? 366 : 365) ) / 100;
    }
}

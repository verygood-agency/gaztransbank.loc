<?php


namespace Local\Calcs\Types;


class GuaranteeCalc
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
        $percent = $percent / 100;

        return ($sum * $percent / 365 * $days);
    }
}

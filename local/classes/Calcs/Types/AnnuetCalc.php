<?php


namespace Local\Calcs\Types;


class AnnuetCalc
{
    public function getTitle()
    {
        return 'Аннуитентный';
    }

    public function calc($sum, $percent, $months)
    {
        $percent = $percent / 100 / 12;

        return round(
            $sum * ( ($percent * pow((1 + $percent), $months)) / (pow((1 + $percent), $months) - 1 ) )
        );

    }
}

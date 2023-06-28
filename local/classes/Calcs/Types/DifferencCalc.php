<?php


namespace Local\Calcs\Types;


class DifferencCalc
{
    public function getTitle()
    {
        return 'Дифференцированный';
    }

    public static function calc($sum, $gotPercent, $months)
    {
        $deptPart = $sum / $months;
        $percent = $gotPercent / 100 / 12;
        $percentPart = $sum * $percent;
        $monthlyPay = intval($deptPart + $percentPart);

        return $monthlyPay;
    }
}

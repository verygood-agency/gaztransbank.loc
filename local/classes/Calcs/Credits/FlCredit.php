<?php


namespace Local\Calcs\Credits;

use Local\Calcs\Types\AnnuetCalc;
//use Local\Calcs\Types\DifferencCalc;

class FlCredit extends AbstractCreditCalc
{

    public function getAvailableMethods(): array
    {
        return [
            'annuet' => new AnnuetCalc(),
            //'differenc' => new DifferencCalc(),
        ];
    }

    public function getCalcName(): string
    {
        return AbstractCreditCalc::$elementID;
    }
}

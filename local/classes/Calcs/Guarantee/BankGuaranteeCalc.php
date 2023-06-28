<?php


namespace Local\Calcs\Guarantee;


use Local\Calcs\Types\GuaranteeCalc;

class BankGuaranteeCalc extends AbstractGuaranteeCalc
{

    public function getAvailableMethods(): array
    {
        return [
            'contracts' => new GuaranteeCalc('На исполнение контракта'),
            'participate' => new GuaranteeCalc('На участие'),
        ];
    }

    public function getCalcName(): string
    {
        return 'bank_guarantee';
    }

    public function calc(array $data): array
    {
        $percent = $this->getPercent($data);
        $minSum = $this->getMinPrice($data);
        $calc = $this->getAvailableMethods()[$this->type];
        $sum = $calc->calc($data['sum'], $percent, $data['days']);

        if($sum < $minSum) {
            $sum = $minSum;
        }

        return [
            'percent' => $percent,
            'price' => $sum
        ];
    }
}

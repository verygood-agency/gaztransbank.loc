<?php

namespace Local\Calcs\Deposits;

use Local\Calcs\Types\DepositesCalc;

class DepositeCalc extends AbstractDepositeCalc
{

    public function getAvailableMethods(): array
    {
        return [
            'UR' => new DepositesCalc('Юридическое лицо'),
            'IP' => new DepositesCalc('ИП'),
        ];
    }

    public function getCalcName(): string
    {
        return 'deposite';
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

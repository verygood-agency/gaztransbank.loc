<?php

namespace Local\Calcs\Deposits;

use Local\Calcs\AbstractCalc;

abstract class AbstractDepositeCalc extends AbstractCalc
{
    public function __construct(string $highloadCode, $day = null, $type = null)
    {
        if(!$type) {
            $type = $this->getDefaultAvailableMethod();
        }

        $this->type = $type;

        parent::__construct($highloadCode, $day);
    }

    protected function getDefaultAvailableMethod(): string
    {
        return array_key_first($this->getAvailableMethods());
    }

    public function getEnums(): array
    {
        return [
            'UF_TYPE'
        ];
    }

    public function getListFilter(): array
    {
        return [
            'UF_TYPE' => $this->enums['UF_TYPE'][$this->type],
        ];
    }

    public function getTerms(): array
    {
        return [
            'start' => min($this->days),
            'end' => max($this->days),
        ];
    }
}

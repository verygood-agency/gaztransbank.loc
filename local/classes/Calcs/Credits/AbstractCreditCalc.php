<?php


namespace Local\Calcs\Credits;


use Local\Calcs\AbstractCalc;
use Local\Calcs\Types\AnnuetCalc;
use Local\Calcs\Types\DifferencCalc;

abstract class AbstractCreditCalc extends AbstractCalc
{
    protected $type;
    static $elementID;

    public function __construct(string $highloadCode, $day = null, $type = null, $elementID = null)
    {
        if(!$type) {
            $type = $this->getDefaultAvailableMethod();
        }

        $this->type = $type;
        self::$elementID = $elementID;

        parent::__construct($highloadCode, $day);
    }

    public function getEnums(): array
    {
        return [
            'UF_TYPE',
            'UF_CREDIT',
        ];
    }

    public function getListFilter(): array
    {
        return [
            //'UF_CREDIT' => $this->enums['UF_CREDIT'][$this->getCalcName()],
            'UF_CREDIT' => $this->getCalcName(),
            'UF_TYPE' => $this->enums['UF_TYPE'][$this->type],
        ];
    }

    abstract public function getAvailableMethods(): array;

    protected function getDefaultAvailableMethod(): string
    {
        return array_key_first($this->getAvailableMethods());
    }

    public function getTerms(): array
    {
        $years = [];

        foreach ($this->days as $day) {
            $year = ceil($day / 365);
            $years[] = plural_form_return($year, ['год', 'года', 'лет']);
        }

        return $years;
    }

    public function calc(array $data): array
    {
        $percent = $this->getPercent($data);
        $calc = $this->getAvailableMethods()[$this->type];
        $monthlyPay = $calc->calc($data['sum'], $percent, $data['months']);

        return [
            'percent' => $percent,
            'monthlyPay' => $monthlyPay
        ];
    }
}

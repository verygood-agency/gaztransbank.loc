<?php


namespace Local\Calcs;


use CModule;
use CUserFieldEnum;
use Local\Calcs\Credits\FlCredit;
use Local\Calcs\Deposits\DepositeCalc;
use Local\Calcs\Guarantee\BankGuaranteeCalc;

abstract class AbstractCalc implements Calc
{
    protected $highloadCode;
    protected $class;
    protected $enums;

    protected $day;
    protected $days;
    protected $maxSums = [];
    protected $percents = [];
    protected $minPrices = [];

    public function __construct(
        string $highloadCode,
        $day = null
    )
    {
        CModule::IncludeModule('iblock');

        $this->day = $day;
        $this->highloadCode = $highloadCode;

        $class = getHBlockEntityById($this->highloadCode);

        $this->getEnumsFromDB();

        $res = $class::getList([
            'filter' => $this->getListFilter(),
            "order" => ["UF_START_SUM"=>"ASC", 'UF_DAYS' => 'ASC'],
        ]);

        while ($item = $res->fetch()) {
            $this->days[$item['UF_DAYS']] = $item['UF_DAYS'];
            if(!$this->maxSums[$item['UF_DAYS']]) {
                $this->maxSums[$item['UF_DAYS']] = $item['UF_END_SUM'];
            } elseif ($this->maxSums[$item['UF_DAYS']] < $item['UF_END_SUM']) {
                $this->maxSums[$item['UF_DAYS']] = $item['UF_END_SUM'];
            }
            $this->percents[$item['UF_DAYS']][$item['UF_START_SUM']] = $item['UF_PERCENT'];

            if(array_key_exists('UF_MIN_PRICE', $item)) {
                $this->minPrices[$item['UF_DAYS']][$item['UF_START_SUM']] = $item['UF_MIN_PRICE'];
            }
        }

        if(!$this->day) {
            $this->day = current($this->days);
        }
    }

    public static function make($calcName, ...$params): self
    {
        switch ($calcName) {
            case 'fl_credit': $calc = new FlCredit('CreditCalc', ...$params); break;
            case 'bank_guarantee': $calc = new BankGuaranteeCalc('Guarantees', ...$params); break;
            case 'deposite': $calc = new DepositeCalc('DepositsCalc', ...$params); break;
        }

        return $calc;
    }

    abstract public function getEnums(): array;
    abstract public function getListFilter(): array;

    protected function getEnumsFromDB()
    {
        foreach ($this->getEnums() as $enum) {
            $rsEnum = CUserFieldEnum::GetList([], ["USER_FIELD_NAME"=>$enum]);
            while ($arEnum = $rsEnum->Fetch()) {
                $this->enums[$enum][$arEnum['XML_ID']] = $arEnum['ID'];
            }
        }
    }

    public function getPercent(array $data): float
    {
        $sum = $data['sum'];

        $startDay = $this->getStartDay();

        $startSum = 0;
        foreach ($this->percents[$startDay] as $s => $v) {
            if ($s <= $sum) {
                $startSum = $s;
            }
        }

        return floatval($this->percents[$startDay][$startSum]);
    }

    protected function getMinPrice(array $data): int
    {
        $sum = $data['sum'];

        $startDay = $this->getStartDay();

        $startSum = 0;
        foreach ($this->minPrices[$startDay] as $s => $v) {
            if ($s <= $sum) {
                $startSum = $s;
            }
        }

        return floatval($this->minPrices[$startDay][$startSum]);
    }

    public function getMaxSum(): int
    {
        return (int) $this->maxSums[$this->getStartDay()];
    }

    public function getMinSum(): int
    {
        $sums = array_keys($this->percents[$this->getStartDay()]);

        return (int) min($sums);
    }

    protected function getStartDay()
    {
        $startDay = current($this->days);
        foreach ($this->percents as $d => $v) {
            if ($d <= $this->day) {
                $startDay = $d;
            }
        }

        return $startDay;
    }
}

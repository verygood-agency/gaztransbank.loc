<?php


namespace Local\Calcs;


interface Calc
{
    public function getTerms(): array;
    public function getAvailableMethods(): array;
    public function getMaxSum(): int;
    public function getMinSum(): int;
    public function getCalcName();
    public function getPercent(array $data): float;
    public function calc(array $data): array;
}

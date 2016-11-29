<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 29.11.16
 * Time: 23:20
 */

namespace mleczakm\RSTMoney;


class Currency implements CurrencyInterface
{
    private $code;

    public function __construct(string $code)
    {

        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}
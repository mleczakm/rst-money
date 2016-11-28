<?php

namespace mleczakm\RSTMoney;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 28.11.16
 * Time: 21:36
 */
interface CurrencyConverterInterface
{

    public function convert($amount, CurrencyInterface $from, CurrencyInterface $to, $roundMode = Round::UP);
}
<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 28.11.16
 * Time: 21:41
 */

namespace mleczakm\RSTMoney;


interface CurrencyInterface
{
    public function getCode() : string;
}
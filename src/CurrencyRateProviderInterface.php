<?php
/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 28.11.16
 * Time: 21:42
 */

namespace mleczakm\RSTMoney;


interface CurrencyRateProviderInterface
{

    public function getRate(CurrencyInterface $from, CurrencyInterface $to, \DateTime $date = null);
}
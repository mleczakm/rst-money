<?php

namespace mleczakm\RSTMoney;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 28.11.16
 * Time: 21:35
 */
class CurrencyConverter implements CurrencyConverterInterface
{
    const SUPPORTED_CURRENCIES = ['PLN', 'EUR', 'USD'];
    /**
     * @var CurrencyRateProviderInterface
     */
    private $currencyRateProvider;

    public function __construct(CurrencyRateProviderInterface $currencyRateProvider)
    {
        $this->currencyRateProvider = $currencyRateProvider;
    }

    public function convert(float $amount, CurrencyInterface $from, CurrencyInterface $to, $roundMode = Round::UP): float
    {
        if (!in_array($from->getCode(), self::SUPPORTED_CURRENCIES) || !in_array($to->getCode(), self::SUPPORTED_CURRENCIES))
            throw new UnsupportedCurrencyException();

        return $this->round($amount * $this->currencyRateProvider->getRate($from, $to, new \DateTime()), 2, $roundMode);
    }

    private function round($number, $precision, $roundMode = Round::UP)
    {
        if ($roundMode === Round::UP)
            return $this->ceil($number, $precision);
        elseif ($roundMode === Round::DOWN)
            return $this->floor($number, $precision);

        throw new UnsupportedRoundModeException();
    }

    private function ceil($value, $places = 0)
    {
        $mult = pow(10, $places);

        return ceil($value * $mult) / $mult;
    }

    private function floor($value, $places = 0)
    {
        $mult = pow(10, $places);

        return floor($value * $mult) / $mult;
    }
}
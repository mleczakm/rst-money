<?php
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 28.11.16
 * Time: 21:46
 */
class CurrencyConverterTest extends TestCase
{
    private $currencyConverter;

    public function testSupportedCurrencies($from, $to)
    {

        $this->assertTrue(is_float($this->currencyConverter->convert(1, $from, $to)));
    }

    public function testUnsupportedCurrencies($from, $to)
    {

        $this->expectException(\mleczakm\RSTMoney\UnsupportedCurrencyException::class);
        $this->currencyConverter->convert(1, $from, $to);
    }

    protected function setUp()
    {
        $this->currencyConverter = new \mleczakm\RSTMoney\CurrencyConverter();
        parent::setUp();
    }

}
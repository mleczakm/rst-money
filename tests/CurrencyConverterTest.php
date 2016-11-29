<?php
use mleczakm\RSTMoney\Currency;
use mleczakm\RSTMoney\CurrencyConverter;
use mleczakm\RSTMoney\Round;
use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: mleczakm
 * Date: 28.11.16
 * Time: 21:46
 */
class CurrencyConverterTest extends TestCase
{
    /** @var CurrencyConverter */
    private $currencyConverter;

    /**
     * @dataProvider supportedCurrencies
     */
    public function testSupportedCurrencies($from, $to)
    {

        $this->assertTrue(is_float($this->currencyConverter->convert(1, $from, $to)));
    }

    public function supportedCurrencies()
    {
        $supportedCurrencies = array_map(function($isoCode){
            return new Currency($isoCode);
        }, CurrencyConverter::SUPPORTED_CURRENCIES);

        foreach($supportedCurrencies as $i)
            foreach ($supportedCurrencies as $j)
                if($j !== $i)
                    yield [$i, $j];
    }

    public function testUnsupportedCurrencies()
    {

        $this->expectException(\mleczakm\RSTMoney\UnsupportedCurrencyException::class);
        $this->currencyConverter->convert(1, new Currency(''), new Currency(''));
    }

    public function testConverting(){

        $this->assertEquals(4.13, $this->currencyConverter->convert(1, new Currency('PLN'), new Currency('EUR')));

        $this->assertEquals(4.12, $this->currencyConverter->convert(1, new Currency('PLN'), new Currency('EUR'), Round::DOWN));
    }

    protected function setUp()
    {
        $currencyRatioProviderMock = $this->createMock(\mleczakm\RSTMoney\CurrencyRateProviderInterface::class);
        $currencyRatioProviderMock
            ->method('getRate')
            ->willReturn(4.12345);

        $this->currencyConverter = new CurrencyConverter($currencyRatioProviderMock);
        parent::setUp();
    }

}
<?php

use Bingewave\BingewavePhpSdk\BingeWaveSDK;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function givenSdk(): BingeWaveSDK
    {
        return new BingeWaveSDK();
    }
}
<?php

namespace Imposter\Client\Imposter\Prediction\CallTime;

class AtMostTest extends \PHPUnit\Framework\TestCase
{
    public function checkProvider()
    {
        return [
            [0, 0, false],
            [1, 1, false],
            [1, 0, true],
            [0, 1, false],
        ];
    }

    /**
     * @test
     * @dataProvider checkProvider
     * @param mixed $times
     * @param mixed $expectedTimes
     * @param mixed $expectedException
     */
    public function check($times, $expectedTimes, $expectedException)
    {
        $callTime     = new \Imposter\Client\Imposter\Prediction\CallTime\AtMost($expectedTimes, new \Imposter\Common\Model\Mock(1));
        $hasException = false;

        try {
            $callTime->check($times);
        } catch (\Exception $e) {
            $hasException = true;
        }

        self::assertSame($expectedException, $hasException);
    }
}

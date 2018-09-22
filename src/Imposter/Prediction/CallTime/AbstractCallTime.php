<?php
declare(strict_types=1);


namespace Imposter\Imposter\Prediction\CallTime;

use Imposter\Model\Mock;

/**
 * Class AbstractCallTime
 * @package Imposter\Imposter\Prediction\CallTime
 */
abstract class AbstractCallTime
{
    /**
     * @var int
     */
    protected $times;

    /**
     * @var Mock
     */
    protected $mock;

    /**
     * Equals constructor.
     * @param int $times
     * @param Mock $mock
     */
    public function __construct(int $times, Mock $mock)
    {
        $this->times = $times;
        $this->mock  = $mock;
    }

    /**
     * @param int $times
     * @return void
     */
    abstract public function check(int $times);
}

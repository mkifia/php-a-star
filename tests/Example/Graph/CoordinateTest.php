<?php

namespace JMGQ\AStar\Tests\Example\Graph;

use JMGQ\AStar\Example\Graph\Coordinate;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase
{
    public function validPointProvider(): array
    {
        $PHP_INT_MIN = ~PHP_INT_MAX;

        return [
            [3, 4],
            [0, 3],
            ['1', '2'],
            ['2', 2],
            [$PHP_INT_MIN, PHP_INT_MAX],
            [-1, 3],
            ['-2', -8],
            [4, -7],
        ];
    }

    public function invalidPointProvider(): array
    {
        return [
            [4, null],
            [null, 2],
            ['a', 2],
            [[], false],
        ];
    }

    /**
     * @dataProvider validPointProvider
     */
    public function testShouldSetValidPoint($x, $y): void
    {
        $expectedX = (int) $x;
        $expectedY = (int) $y;

        $sut = new Coordinate($x, $y);

        $this->assertSame($expectedX, $sut->getX());
        $this->assertSame($expectedY, $sut->getY());
    }

    /**
     * @dataProvider invalidPointProvider
     */
    public function testShouldNotSetInvalidPoint($x, $y): void
    {
        $this->expectException(\TypeError::class);

        new Coordinate($x, $y);
    }

    /**
     * @dataProvider validPointProvider
     */
    public function testShouldGenerateAnId($x, $y): void
    {
        $expectedId = $x . 'x' . $y;

        $sut = new Coordinate($x, $y);

        $this->assertSame($expectedId, $sut->getId());
    }
}
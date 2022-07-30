<?php

namespace App\Tests;


use PHPUnit\Framework\TestCase;


class NumbersTest extends TestCase
{
    /**
     * @dataProvider numbersProvider
     *
     * @param int $a
     * @param int $b
     * @param int $result
     * @return void
     */
    public function testNumbers($a, $b, $result): void
    {
        $this->assertSame($result,$a + $b);
    }

    public function numbersProvider()
    {
        return [
            [1, 3, 4],
            [7, 2, 9],
            [0, 5, 5],
            [4, 3, 7],
            [9, 1, 10],
        ];
    }
}

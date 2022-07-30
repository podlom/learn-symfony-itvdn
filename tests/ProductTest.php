<?php

namespace App\Tests;


use PHPUnit\Framework\TestCase;


class ProductTest extends TestCase
{
    public function testSomething(): void
    {
        // $this->assertTrue(true);

        $a = 1;
        $b = 2;
        $c = $a + $b;

        $this->assertEquals(3, $c);
    }
}

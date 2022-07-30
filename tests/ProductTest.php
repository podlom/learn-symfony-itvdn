<?php

namespace App\Tests;


use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;
use App\Entity\Product;


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

    public function testAddProduct(): void
    {
        $entityManager = $this->createMock(ObjectManager::class);

        $product = new Product();
        $product->setName('Tested Product Name');
        $product->setDescription('Tested Product Description');
        $product->setPrice(75);
        $product->setAuthor('Taras from PHPUnit');

        $entityManager->persist($product);
        $entityManager->flush();

        $this->assertSame('Tested Product Name', $product->getName());
    }
}
